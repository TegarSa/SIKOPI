@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Edit Produk</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-12">
            <div class="card">

                <div class="card-header align-items-center">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <a href="{{ route('products.index') }}" class="btn btn-warning">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NAMA PRODUK --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- SKU --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">SKU</label>
                            <div class="col-sm-10">
                                <input type="text" name="sku"
                                    value="{{ old('sku', $product->sku) }}"
                                    class="form-control @error('sku') is-invalid @enderror">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- KATEGORI --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" name="category"
                                    value="{{ old('category', $product->category) }}"
                                    class="form-control @error('category') is-invalid @enderror">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- SATUAN --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" name="unit"
                                    value="{{ old('unit', $product->unit) }}"
                                    class="form-control @error('unit') is-invalid @enderror">
                                @error('unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- HARGA --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Harga Satuan</label>
                            <div class="col-sm-10">
                                <input type="number" name="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- MIN STOCK --}}
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end">Minimal Stok</label>
                            <div class="col-sm-10">
                                <input type="number" name="min_stock"
                                    value="{{ old('min_stock', $product->min_stock) }}"
                                    class="form-control @error('min_stock') is-invalid @enderror">
                                @error('min_stock')
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
