@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Tambah Produk</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-12">
            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-warning">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf

                        {{-- NAMA PRODUK --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        {{-- SKU --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">SKU</label>
                            <div class="col-sm-10">
                                <input type="text" name="sku" class="form-control" required>
                            </div>
                        </div>

                        {{-- KATEGORI --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" name="category" class="form-control">
                            </div>
                        </div>

                        {{-- SATUAN --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" name="unit" class="form-control" placeholder="pcs / kg / roll" required>
                            </div>
                        </div>

                        {{-- HARGA --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Harga Satuan</label>
                            <div class="col-sm-10">
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>

                        {{-- MIN STOCK --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Minimal Stok</label>
                            <div class="col-sm-10">
                                <input type="number" name="min_stock" class="form-control" value="0">
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="mb-3 row">
                            <div class="col-sm-10 ms-sm-auto">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Produk
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
