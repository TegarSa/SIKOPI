@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Edit Supplier</h1>
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
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Nama Supplier</label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                    value="{{ old('name', $supplier->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
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
                                    value="{{ old('contact', $supplier->contact) }}"
                                    class="form-control @error('contact') is-invalid @enderror">
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
                                    rows="3">{{ old('address', $supplier->address) }}</textarea>
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
                                    value="{{ old('email', $supplier->email) }}"
                                    class="form-control @error('email') is-invalid @enderror">
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
                                    value="{{ old('phone', $supplier->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

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
