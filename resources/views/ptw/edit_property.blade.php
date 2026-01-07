@extends('layouts.ptw_master')

@section('content')

<div class="add-container">
    <div class="header-row">
        <a href="{{ route('properties.ptw') }}" class="btn-back">&lt; Go Back</a>
        <h2 class="page-title">Edit Property</h2>
    </div>

    <form action="{{ route('properties.ptw.update', $property->id_wisata) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-card">
            
            <div class="form-row">
                <div class="form-group half">
                    <label>Property Name</label>
                    <input type="text" name="nama_wisata" class="form-control" 
                           value="{{ old('nama_wisata', $property->nama_wisata) }}" placeholder="Your Property Name">
                </div>
                <div class="form-group half">
                    <label>Category</label>
                    <select name="category" class="form-control">
                        <option value="">Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ (old('category', $property->jenis_wisata) == $cat) ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Property Address</label>
                <input type="text" name="alamat_wisata" class="form-control" 
                       value="{{ old('alamat_wisata', $property->alamat_wisata) }}" placeholder="Your Property Address">
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Opening Hour</label>
                    <input type="time" name="waktu_buka" class="form-control" 
                           value="{{ old('waktu_buka', \Carbon\Carbon::parse($property->waktu_buka)->format('H:i')) }}">
                </div>
                <div class="form-group half">
                    <label>Closing Hour</label>
                    <input type="time" name="waktu_tutup" class="form-control" 
                           value="{{ old('waktu_tutup', \Carbon\Carbon::parse($property->waktu_tutup)->format('H:i')) }}">
                </div>
            </div>

            <div class="form-group">
                <label>Property Description</label>
                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Your Property Description">{{ old('deskripsi', $property->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label>Images</label>
                <div class="image-grid">
                    @for($i = 0; $i < 6; $i++)
                        @php
                            // Ambil foto berdasarkan urutan (i+1)
                            $currentPhoto = $property->fotoTempatWisata->where('urutan', $i + 1)->first();
                            $imgUrl = $currentPhoto ? (Str::startsWith($currentPhoto->foto_wisata, 'http') ? $currentPhoto->foto_wisata : asset($currentPhoto->foto_wisata)) : null;
                        @endphp

                        <div class="image-box" onclick="document.getElementById('file-{{ $i }}').click()">
                            <input type="file" name="foto_wisata[{{ $i }}]" id="file-{{ $i }}" hidden onchange="previewGridImage(this, 'preview-{{ $i }}')">
                            
                            <img id="preview-{{ $i }}" src="{{ $imgUrl ?? '' }}" class="preview-img" style="{{ $imgUrl ? 'display:block' : 'display:none' }}">
                            
                            <span class="placeholder-text" id="text-{{ $i }}" style="{{ $imgUrl ? 'display:none' : 'display:block' }}">
                                Image {{ $i + 1 }}
                            </span>
                        </div>
                    @endfor
                </div>
                <p class="help-text">Click on an image box to replace/add photo.</p>
            </div>

            <div class="ticket-section">
                <label>Ticket(s)</label>
                <p class="info-text-italic">
                    You can edit the ticket in the ticket menu.
                </p>
                
                <div class="footer-actions right">
                    <button type="submit" class="btn-save-final">Save</button>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function previewGridImage(input, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.getElementById(imgId);
                img.src = e.target.result;
                img.style.display = 'block';
                
                // Sembunyikan text placeholder
                var textId = imgId.replace('preview-', 'text-');
                document.getElementById(textId).style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection