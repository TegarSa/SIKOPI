@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Daftar Produk</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header text-end">
                    @canCrud
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        Tambah Produk
                    </a>
                    @endcanCrud
                </div>

                <div class="card-body">
                    <table id="datatables-responsive" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>SKU</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->category ?? '-' }}</td>
                                    <td>{{ $product->unit }}</td>

                                    {{-- STOK (hasil hitung) --}}
                                    <td>
                                        @php
                                            $stock = $product->stock ?? 0;
                                        @endphp

                                        <span class="badge
                                            {{ $stock <= $product->min_stock ? 'bg-danger' : 'bg-success' }}">
                                            {{ $stock }}
                                        </span>
                                    </td>

                                    <td>
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        @canCrud
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-info btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus produk ini?')">
                                                Delete
                                            </button>
                                        </form>
                                        @endcanCrud
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="{{ asset('backend/js/datatables.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $("#datatables-responsive").DataTable({
            responsive: true
        });
    });
</script>
@endpush
