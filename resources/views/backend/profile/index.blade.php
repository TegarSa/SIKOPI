@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-4">

    <div class="row d-flex" style="align-items: stretch;">
        <div class="col-md-4 d-flex">
            <div class="card shadow-sm mb-4 flex-fill">
                <div class="card-body text-center">
                    <img src="{{ auth()->user()->photo_profile 
                                ? asset('assets/photo_profile/' . auth()->user()->photo_profile) 
                                : asset('assets/img/Default.png') }}" 
                        alt="Profile Picture" 
                        class="rounded-circle mb-3" 
                        width="120" 
                        height="120">
                    <h5 class="fw-bold">{{ auth()->user()->name }}</h5>
                    <p class="text-muted text-uppercase small">{{ auth()->user()->role }}</p>
                    <hr>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            Account Settings
                        </a>
                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"></form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 d-flex">
            <div class="card shadow-sm flex-fill">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Public Info</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Profile Photo</label>
                            <div class="col-sm-9">
                                <input type="file" name="photo_profile" class="form-control @error('photo_profile') is-invalid @enderror">
                                @error('photo_profile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(auth()->user()->photo_profile)
                                    <img src="{{ asset('assets/photo_profile/' . auth()->user()->photo_profile) }}" alt="Profile Photo" class="rounded mt-2" width="100">
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- SEED KOLOM USERNAME BARU --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', auth()->user()->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Role</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-uppercase" value="{{ auth()->user()->role }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Status Akun</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-uppercase" value="{{ auth()->user()->status ?? 'Aktif' }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label fw-semibold">Password Baru</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin mengubah password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection