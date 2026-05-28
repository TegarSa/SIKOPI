@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Tambah Staff</h1>
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
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Nama Staff</label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama staff"
                                    value="{{ old('name') }}">
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
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email staff"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="********">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- INSTITUTION --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Institution</label>
                            <div class="col-sm-10">
                                <input type="text" name="institution"
                                    class="form-control @error('institution') is-invalid @enderror"
                                    placeholder="Institusi / departemen"
                                    value="{{ old('institution') }}">
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ROLE (hidden default staff) --}}
                        <input type="hidden" name="role" value="staff">

                        {{-- BUTTON --}}
                        <div class="mb-3 row">
                            <div class="col-sm-10 ms-sm-auto">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
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
