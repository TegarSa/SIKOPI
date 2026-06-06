@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Tambah Anggota</h1>
    </div>

    <div class="row justify-content-center">

        <div class="col-12">

            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="{{ route('anggota.index') }}"
                               class="btn btn-warning">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('anggota.store') }}"
                          method="POST">

                        @csrf

                        {{-- STATUS DEFAULT AKTIF --}}
                        <input type="hidden"
                               name="status"
                               value="aktif">

                        {{-- NO ANGGOTA --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                No Anggota <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       name="no_anggota"
                                       class="form-control @error('no_anggota') is-invalid @enderror"
                                       placeholder="Masukkan nomor anggota"
                                       value="{{ old('no_anggota') }}">

                                @error('no_anggota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- NAMA --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                Nama <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       name="nama"
                                       class="form-control @error('nama') is-invalid @enderror"
                                       placeholder="Masukkan nama anggota"
                                       value="{{ old('nama') }}">

                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- NIP --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                NIP
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       name="nip"
                                       class="form-control @error('nip') is-invalid @enderror"
                                       placeholder="Masukkan NIP"
                                       value="{{ old('nip') }}">

                                @error('nip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- JABATAN --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                Jabatan
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       name="jabatan"
                                       class="form-control @error('jabatan') is-invalid @enderror"
                                       placeholder="Masukkan jabatan"
                                       value="{{ old('jabatan') }}">

                                @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- UNIT KERJA --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                Unit Kerja
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       name="unit_kerja"
                                       class="form-control @error('unit_kerja') is-invalid @enderror"
                                       placeholder="Masukkan unit kerja"
                                       value="{{ old('unit_kerja') }}">

                                @error('unit_kerja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- NO HP --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                No HP
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       name="no_hp"
                                       class="form-control @error('no_hp') is-invalid @enderror"
                                       placeholder="Masukkan nomor HP"
                                       value="{{ old('no_hp') }}">

                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- TANGGAL MASUK --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                Tanggal Masuk
                            </label>

                            <div class="col-sm-10">

                                <input type="date"
                                       name="tgl_masuk"
                                       class="form-control @error('tgl_masuk') is-invalid @enderror"
                                       value="{{ old('tgl_masuk') }}">

                                @error('tgl_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        {{-- ALAMAT --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">
                                Alamat
                            </label>

                            <div class="col-sm-10">

                                <textarea name="alamat"
                                          rows="4"
                                          class="form-control @error('alamat') is-invalid @enderror"
                                          placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>

                                @error('alamat')
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

</div>

@endsection