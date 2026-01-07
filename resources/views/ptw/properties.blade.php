@extends('layouts.ptw_master')

@section('content')

<div class="properties-container">
    
    <div class="action-bar">
        <a href="{{ route('add.property.ptw') }}" class="btn-add-new">
            + Add New Property
        </a>

        <form action="{{ route('properties.ptw') }}" method="GET" class="search-filter-form">
            
            <input type="text" name="search" class="search-input" 
                   placeholder="Search Property..." 
                   value="{{ request('search') }}">

            <select name="category" class="category-select" onchange="this.form.submit()">
                <option value="">Category</option> @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="property-list">
        
        @forelse($properties as $prop)
            <div class="property-card">
                <div class="card-image">
                    @php
                        $thumbnail = $prop->fotoTempatWisata->where('urutan', 1)->first();
                        $imgSrc = $thumbnail ? $thumbnail->foto_wisata : ($prop->fotoTempatWisata->first()->foto_wisata ?? null);
                    @endphp

                    @if($imgSrc)
                        <img src="{{ Str::startsWith($imgSrc, 'http') ? $imgSrc : asset($imgSrc) }}" alt="{{ $prop->nama_wisata }}">
                    @else
                        <img src="{{ asset('images/default_venue.jpg') }}" alt="No Image">
                    @endif
                </div>

                <div class="card-info">
                    <h3 class="prop-name">{{ $prop->nama_wisata }}</h3>
                    
                    <div class="prop-details">
                        <span class="detail-time">
                            {{ \Carbon\Carbon::parse($prop->waktu_buka)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($prop->waktu_tutup)->format('H:i') }}
                        </span>
                        <span class="detail-separator">|</span>
                        <span class="detail-cat">{{ $prop->jenis_wisata }}</span>
                    </div>

                    <div class="prop-tickets">
                        <i class="fas fa-ticket-alt"></i> 
                        
                        <span>
                            {{ $prop->tiketTempatWisata->sum('jumlah') }} tickets total
                        </span>
                    </div>
                </div>

                <div class="card-actions">
                    <a href="{{ route('properties.ptw.tickets', $prop->id_wisata) }}" class="btn-action btn-tickets">
                        Tickets
                    </a>

                    <a href="{{ route('properties.ptw.edit', $prop->id_wisata) }}" class="btn-action btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('properties.ptw.destroy', $prop->id_wisata) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this property?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>No properties found. Try adding new one!</p>
            </div>
        @endforelse

    </div>

</div>

@endsection