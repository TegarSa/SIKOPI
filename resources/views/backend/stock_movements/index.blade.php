@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Pergerakan Stok</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header text-end">
                    @canCrud
                    <a href="{{ route('stock.in.create') }}" class="btn btn-success btn-sm">
                        Stok Masuk
                    </a>
                    <a href="{{ route('stock.out.create') }}" class="btn btn-danger btn-sm">
                        Stok Keluar
                    </a>
                    @endcanCrud
                </div>

                <div class="card-body">
                    <table id="datatables-responsive" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Produk</th>
                                <th>SKU</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Referensi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movements as $movement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $movement->created_at->format('d-m-Y H:i') }}</td>
                                    <td>{{ $movement->product->name }}</td>
                                    <td>{{ $movement->product->sku }}</td>

                                    {{-- JENIS --}}
                                    <td>
                                        <span class="badge 
                                            {{ $movement->movement_type == 'IN' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $movement->movement_type }}
                                        </span>
                                    </td>

                                    {{-- JUMLAH --}}
                                    <td>{{ $movement->quantity }}</td>

                                    {{-- REFERENSI --}}
                                    <td>
                                        {{ $movement->reference_type ?? '-' }}
                                        @if($movement->reference_id)
                                            #{{ $movement->reference_id }}
                                        @endif
                                    </td>

                                    {{-- KETERANGAN --}}
                                    <td>{{ $movement->description ?? '-' }}</td>
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
            responsive: true,
            order: [[1, 'desc']]
        });
    });
</script>
@endpush
