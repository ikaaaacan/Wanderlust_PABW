@extends('layouts.ptw_master')

@section('content')

<div class="add-container">
    <div class="header-row">
        <a href="{{ route('properties.ptw.tickets', $property->id_wisata) }}" class="btn-back">&lt; Go Back</a>
        <h2 class="page-title">Add New Ticket</h2>
    </div>

    <form action="{{ route('tickets.ptw.store', $property->id_wisata) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-card">
            
            <div class="form-row three-col">
                <div class="form-group">
                    <label>Ticket Name</label>
                    <input type="text" name="nama_tiket" class="form-control" required placeholder="Your Ticket Name">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="harga" class="form-control" required placeholder="Input price">
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="jumlah" class="form-control" required placeholder="Input stock">
                </div>
            </div>

            <div class="form-group">
                <label>Ticket Description</label>
                <textarea name="deskripsi" class="form-control" rows="4" required placeholder="Ticket description"></textarea>
            </div>

            <div class="form-group">
                <label>Images</label>
                <div class="ticket-image-upload">
                    <div class="image-box single" onclick="document.getElementById('ticket-file').click()" style="width: 150px; height: 150px;">
                        <input type="file" name="foto_tiket" id="ticket-file" hidden onchange="previewGridImage(this, 'preview-ticket')">
                        <img id="preview-ticket" class="preview-img" style="display: none;">
                        <span class="placeholder-text" id="text-ticket">Ticket Image</span>
                    </div>
                    <span class="help-text-inline" style="color: white; font-style: italic; margin-left: 15px;">
                        Please add a relevant image for this ticket.
                    </span>
                </div>
            </div>

            <div class="footer-actions right">
                <button type="submit" class="btn-save-final">Save</button>
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