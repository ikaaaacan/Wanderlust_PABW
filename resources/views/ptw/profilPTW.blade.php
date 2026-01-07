@extends('layouts.ptw_master')

@section('content')

    <div class="profile-container">
        <h2 class="page-title">Profile Page</h2>

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
                        <input type="file" id="input-user-photo" hidden onchange="previewImage(this, 'preview-user')">
                    </div>

                    <div class="profile-info">
                        <h2 class="info-name">{{ $user->nama }}</h2>
                        <p class="info-job">{{ $ptw->jabatan ?? 'Jabatan Belum Diisi' }}</p>
                        
                        <div class="info-divider"></div>

                        <div class="info-detail">
                            <span class="label">Email:</span> {{ $user->email }}
                        </div>
                        <div class="info-detail">
                            <span class="label">Phone:</span> {{ $user->nomor_telepon ?? '-' }}
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
                                <img id="preview-org" src="{{ asset('images/logos/default_logo.png') }}" alt="Default Logo">
                            @endif
                        </div>
                        <button type="button" class="btn-change-photo" onclick="document.getElementById('input-org-photo').click()">
                            Change Photo
                        </button>
                        <input type="file" id="input-org-photo" hidden onchange="previewImage(this, 'preview-org')">
                    </div>

                    <div class="profile-info">
                        <h2 class="info-name">{{ $ptw->nama_organisasi }}</h2>
                        <p class="info-address">{{ $ptw->alamat_bisnis }}</p>
                        
                        <div class="info-divider"></div>

                        <div class="document-buttons">
                            @if($ptw->siu)
                                <a href="{{ asset($ptw->siu) }}" target="_blank" class="btn-doc">
                                    View Legal Document
                                </a>
                            @else
                                <button class="btn-doc disabled" disabled>No Legal Doc</button>
                            @endif

                            @if($ptw->npwp)
                                <a href="{{ asset($ptw->npwp) }}" target="_blank" class="btn-doc">
                                    View Business Document
                                </a>
                            @else
                                <button class="btn-doc disabled" disabled>No Business Doc</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="action-footer">
            <a href="{{ route('profil.ptw.edit') }}" class="btn-edit-main">Edit Profile</a>
        </div>
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
    </script>

@endsection