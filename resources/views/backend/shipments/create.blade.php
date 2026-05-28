@extends('backend.layouts.index')

@section('title', 'Tambah Pengiriman')

@section('content')
<div class="container-fluid p-0">

    {{-- Header --}}
    <div class="mb-3">
        <h1 class="h3">
            <i class="fas fa-truck me-2"></i> Tambah Pengiriman
        </h1>
    </div>

    {{-- Card --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('shipments.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Pengiriman</label>
                        <input type="date"
                               name="shipment_date"
                               class="form-control @error('shipment_date') is-invalid @enderror"
                               value="{{ old('shipment_date') }}"
                               required>
                        @error('shipment_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tujuan Pengiriman</label>
                        <input type="text"
                               name="destination"
                               class="form-control @error('destination') is-invalid @enderror"
                               value="{{ old('destination') }}"
                               placeholder="Gudang / Toko / Customer"
                               required>
                        @error('destination')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Stok</label>
                        <select name="inventory_type"
                                class="form-select @error('inventory_type') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih --</option>
                            <option value="Masuk" {{ old('inventory_type') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="Keluar" {{ old('inventory_type') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                        @error('inventory_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text"
                               name="product_name"
                               class="form-control @error('product_name') is-invalid @enderror"
                               value="{{ old('product_name') }}"
                               required>
                        @error('product_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number"
                               name="quantity"
                               class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity') }}"
                               min="1"
                               required>
                        @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kota</label>
                        <input type="text"
                               name="city"
                               class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city') }}"
                               required>
                        @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Armada</label>
                        <input type="text"
                               name="armada"
                               class="form-control @error('armada') is-invalid @enderror"
                               value="{{ old('armada') }}"
                               placeholder="Truk / Pick Up / Ekspedisi"
                               required>
                        @error('armada')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mt-3 text-end">
                    <a href="{{ route('shipments.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
