@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Laporan Stok Gudang</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <table id="datatables-summary" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>SKU</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Stok Akhir</th>
                                <th>Min Stok</th>
                                <th>Status</th>
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

                                    <td>
                                        <span class="badge {{ $product->stock <= $product->min_stock ? 'bg-danger' : 'bg-success' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>

                                    <td>{{ $product->min_stock }}</td>
                                    <td>{{ $product->status }}</td>
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
        $("#datatables-summary").DataTable({
            responsive: true
        });
    });
</script>
@endpush
