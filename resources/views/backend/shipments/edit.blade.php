@extends('backend.layouts.index')

@section('title', 'Edit Pengiriman')

@section('content')
<div class="container-fluid p-0">

    {{-- Header --}}
    <div class="mb-3">
        <h1 class="h3">
            <i class="fas fa-edit me-2"></i> Edit Pengiriman
        </h1>
    </div>

    {{-- Card --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('shipments.update', $shipment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Pengiriman</label>
                        <input type="date"
                                name="shipment_date"
                                class="form-control"
                                value="{{ old('shipment_date', $shipment->shipment_date) }}"
                                required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tujuan Pengiriman</label>
                        <input type="text"
                                name="destination"
                                class="form-control"
                                value="{{ old('destination', $shipment->destination) }}"
                                required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Stok</label>
                        <select name="inventory_type" class="form-select" required>
                            <option value="Masuk" {{ $shipment->inventory_type == 'Masuk' ? 'selected' : '' }}>
                                Masuk
                            </option>
                            <option value="Keluar" {{ $shipment->inventory_type == 'Keluar' ? 'selected' : '' }}>
                                Keluar
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text"
                                name="product_name"
                                class="form-control"
                                value="{{ old('product_name', $shipment->product_name) }}"
                                required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number"
                                name="quantity"
                                class="form-control"
                                value="{{ old('quantity', $shipment->quantity) }}"
                                min="1"
                                required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kota</label>
                        <input type="text"
                                name="city"
                                class="form-control"
                                value="{{ old('city', $shipment->city) }}"
                                required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Armada</label>
                        <input type="text"
                                name="armada"
                                class="form-control"
                                value="{{ old('armada', $shipment->armada) }}"
                                required>
                    </div>

                </div>

                <div class="mt-3 text-end">
                    <a href="{{ route('shipments.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
