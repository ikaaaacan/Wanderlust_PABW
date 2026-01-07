@extends('layouts.ptw_master')

@section('content')

    <div class="profile-container">

        <div class="header-row">
            <a href="{{ route('profil.ptw') }}" class="btn-back">&lt; Go Back</a>
            
            <h2 class="page-title">Edit Profile</h2>
        </div>

        <form action="{{ route('profil.ptw.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="profile-card">
                
                <div class="profile-section section-personal">
                    <div class="profile-layout">
                        <div class="profile-image-wrapper">
                            <div class="image-circle">
                                <img id="preview-user" src="{{ asset($user->foto_profil) }}" alt="User Photo">
                            </div>
                            <button type="button" class="btn-change-photo" onclick="document.getElementById('input-user-photo').click()">
                                Change Photo
                            </button>
                            <input type="file" name="foto_profil" id="input-user-photo" hidden onchange="previewImage(this, 'preview-user')">
                        </div>

                        <div class="profile-info form-area">
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="nama" class="form-control" placeholder="{{ $user->nama }}">
                            </div>

                            <div class="form-group">
                                <label>Position</label> <input type="text" name="jabatan" class="form-control" placeholder="{{ $ptw->jabatan ?? 'Masukan Jabatan' }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="nomor_telepon" class="form-control" placeholder="{{ $user->nomor_telepon ?? '08...' }}">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="profile-section section-organization">
                    <div class="profile-layout">
                        <div class="profile-image-wrapper">
                            <div class="image-circle">
                                @if($ptw->foto_organisasi)
                                    <img id="preview-org" src="{{ asset($ptw->foto_organisasi) }}" alt="Org Logo">
                                @else
                                    <img id="preview-org" src="{{ asset('images/logos/default_logo.png') }}" alt="Default">
                                @endif
                            </div>
                            <button type="button" class="btn-change-photo" onclick="document.getElementById('input-org-photo').click()">
                                Change Photo
                            </button>
                            <input type="file" name="foto_organisasi" id="input-org-photo" hidden onchange="previewImage(this, 'preview-org')">
                        </div>

                        <div class="profile-info form-area">
                            
                            <div class="form-group">
                                <label>Organization Name</label>
                                <input type="text" name="nama_organisasi" class="form-control" placeholder="{{ $ptw->nama_organisasi }}">
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="alamat_bisnis" class="form-control" rows="3" placeholder="{{ $ptw->alamat_bisnis ?? 'Alamat Lengkap...' }}"></textarea>
                            </div>

                            <div class="document-upload-row">
                                <div class="upload-wrapper">
                                    <input type="file" name="siu" id="input-siu" hidden onchange="updateFileName(this, 'label-siu')">
                                    <button type="button" class="btn-upload-doc" onclick="document.getElementById('input-siu').click()">
                                        Upload Legal Document (SIUP)
                                    </button>
                                    <span id="label-siu" class="file-label"></span>
                                </div>

                                <div class="upload-wrapper">
                                    <input type="file" name="npwp" id="input-npwp" hidden onchange="updateFileName(this, 'label-npwp')">
                                    <button type="button" class="btn-upload-doc" onclick="document.getElementById('input-npwp').click()">
                                        Upload Business Document (NPWP)
                                    </button>
                                    <span id="label-npwp" class="file-label"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="action-footer">
                <button type="submit" class="btn-save-main">Save Profile</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function updateFileName(input, labelId) {
            if (input.files && input.files[0]) {
                document.getElementById(labelId).innerText = "File: " + input.files[0].name;
            }
        }
    </script>

@endsection