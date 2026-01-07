@extends('layouts.ptw_master')

@section('content')

<div class="add-container">
    <div class="header-row">
        <a href="{{ route('properties.ptw') }}" class="btn-back">&lt; Go Back</a>
        <h2 class="page-title">Add New Property</h2>
    </div>

    <form action="{{ route('add.property.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-card">
            
            <div class="form-row">
                <div class="form-group half">
                    <label>Property Name</label>
                    <input type="text" name="nama_wisata" class="form-control" 
                           value="{{ old('nama_wisata') }}" required placeholder="Your Property Name">
                </div>
                <div class="form-group half">
                    <label>Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Property Address</label>
                <input type="text" name="alamat_wisata" class="form-control" 
                       value="{{ old('alamat_wisata') }}" required placeholder="Your Property Address">
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Opening Hour</label>
                    <input type="time" name="waktu_buka" class="form-control" 
                           value="{{ old('waktu_buka') }}" required>
                </div>
                <div class="form-group half">
                    <label>Closing Hour</label>
                    <input type="time" name="waktu_tutup" class="form-control" 
                           value="{{ old('waktu_tutup') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Property Description</label>
                <textarea name="deskripsi" class="form-control" rows="4" required placeholder="Your Property Description">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-group">
                <label>Images</label>
                <div class="image-grid">
                    @for($i = 0; $i < 6; $i++)
                        <div class="image-box" onclick="document.getElementById('file-{{ $i }}').click()">
                            <input type="file" name="foto_wisata[]" id="file-{{ $i }}" hidden onchange="previewGridImage(this, 'preview-{{ $i }}')">
                            
                            <img id="preview-{{ $i }}" class="preview-img" style="display: none;">
                            <span class="placeholder-text" id="text-{{ $i }}">Image {{ $i + 1 }}</span>
                        </div>
                    @endfor
                </div>
                <p class="help-text">Please add up to 6 relevant images of your place.</p>
            </div>

            <div class="ticket-section">
                <label>Ticket(s)</label>
                <p class="info-text-italic">
                    You can add tickets after you add this property.
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
                document.getElementById(imgId).src = e.target.result;
                document.getElementById(imgId).style.display = 'block';
                var textId = imgId.replace('preview-', 'text-');
                document.getElementById(textId).style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection