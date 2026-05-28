@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Tambah Supplier</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-12">
            <div class="card">

                <div class="card-header align-items-center">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <a href="{{ route('supplier.index') }}" class="btn btn-warning">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('supplier.store') }}" method="POST">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Nama Supplier</label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama supplier"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- CONTACT --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Contact Person</label>
                            <div class="col-sm-10">
                                <input type="text" name="contact"
                                    class="form-control @error('contact') is-invalid @enderror"
                                    placeholder="Nama PIC / kontak"
                                    value="{{ old('contact') }}">
                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ADDRESS --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Alamat supplier">{{ old('address') }}</textarea>
                                @error('address')
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
                                    placeholder="Email supplier"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- PHONE --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">No. Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Nomor telepon"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

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
