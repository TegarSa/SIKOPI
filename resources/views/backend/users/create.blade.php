@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

```
<div class="mb-3">
    <h1 class="align-middle h3 d-inline">Tambah Staff</h1>
</div>

<div class="row justify-content-center">

    <div class="col-12">

        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-warning">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.users.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    {{-- FOTO PROFIL --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">
                            Foto Profil
                        </label>

                        <div class="col-sm-10">

                            <input type="file"
                                   name="photo_profile"
                                   class="form-control @error('photo_profile') is-invalid @enderror">

                            @error('photo_profile')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">
                            Nama
                        </label>

                        <div class="col-sm-10">

                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Masukkan nama staff"
                                   value="{{ old('name') }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- USERNAME --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">
                            Username
                        </label>

                        <div class="col-sm-10">

                            <input type="text"
                                   name="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Masukkan username staff"
                                   value="{{ old('username') }}">

                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">
                            Email
                        </label>

                        <div class="col-sm-10">

                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Masukkan email"
                                   value="{{ old('email') }}">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">
                            Password
                        </label>

                        <div class="col-sm-10">

                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Masukkan password">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- ROLE --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">
                            Role
                        </label>

                        <div class="col-sm-10">

                            <select name="role"
                                    class="form-select @error('role') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Role --
                                </option>

                                <option value="admin"
                                    {{ old('role') == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="ketua"
                                    {{ old('role') == 'ketua' ? 'selected' : '' }}>
                                    Ketua
                                </option>

                                <option value="sekretaris"
                                    {{ old('role') == 'sekretaris' ? 'selected' : '' }}>
                                    Sekretaris
                                </option>

                                <option value="bendahara"
                                    {{ old('role') == 'bendahara' ? 'selected' : '' }}>
                                    Bendahara
                                </option>

                                <option value="komisaris"
                                    {{ old('role') == 'komisaris' ? 'selected' : '' }}>
                                    Komisaris
                                </option>

                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">
                            Status
                        </label>

                        <div class="col-sm-10">

                            <select name="status"
                                    class="form-select @error('status') is-invalid @enderror">

                                <option value="aktif"
                                    {{ old('status') == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="nonaktif"
                                    {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>

                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <div class="mb-3 row">

                        <div class="col-sm-10 ms-sm-auto">

                            <button type="submit"
                                    class="btn btn-primary">
                                Simpan
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
```

</div>
@endsection
