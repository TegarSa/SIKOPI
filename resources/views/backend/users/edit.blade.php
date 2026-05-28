@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Edit Staff</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-12">
            <div class="card">

                <div class="card-header align-items-center">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-warning">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- PHOTO --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Photo</label>
                            <div class="col-sm-10">
                                <input type="file" name="photo_profile" class="form-control">
                                @if($staff->photo_profile)
                                    <img src="{{ asset('assets/photo_profile/' . $staff->photo_profile) }}" 
                                         alt="Photo" class="rounded mt-2" width="100">
                                @endif
                            </div>
                        </div>

                        {{-- NAME --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" 
                                       value="{{ old('name', $staff->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email"
                                       value="{{ old('email', $staff->email) }}"
                                       class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- INSTITUTION --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Institution</label>
                            <div class="col-sm-10">
                                <input type="text" name="institution"
                                       value="{{ old('institution', $staff->institution) }}"
                                       class="form-control @error('institution') is-invalid @enderror">
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti">
                            </div>
                        </div>

                        {{-- ROLE (readonly, staff) --}}
                        <input type="hidden" name="role" value="staff">

                        {{-- BUTTON --}}
                        <div class="mb-3 row">
                            <div class="col-sm-10 ms-sm-auto">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
