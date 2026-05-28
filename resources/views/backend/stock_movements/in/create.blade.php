@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Stok Masuk</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-12">
            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('stock.movements.index') }}" class="btn btn-warning">
                        Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('stock.in.store') }}" method="POST">
                        @csrf

                        {{-- PRODUK --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Produk</label>
                            <div class="col-sm-10">
                                <select name="product_id" class="form-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }} ({{ $product->sku }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" name="quantity"
                                    class="form-control"
                                    min="1"
                                    required>
                            </div>
                        </div>

                        {{-- KETERANGAN --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="description"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Contoh: Stok awal / Pembelian manual"></textarea>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="mb-3 row">
                            <div class="col-sm-10 ms-sm-auto">
                                <button type="submit" class="btn btn-success">
                                    Simpan Stok Masuk
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
