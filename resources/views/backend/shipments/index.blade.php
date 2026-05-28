@extends('backend.layouts.index')

@section('title', 'Daftar Pengiriman')

@section('content')
<div class="container-fluid p-0">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">
            <i class="fas fa-truck me-2"></i> Daftar Pengiriman
        </h1>
        @canCrud
        <a href="{{ route('shipments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Pengiriman
        </a>
        @endcanCrud
    </div>

    {{-- Card --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table id="shipmentTable"
                    class="table table-bordered table-striped table-hover align-middle mb-0 w-100">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Tujuan</th>
                            <th>Status</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Kota</th>
                            <th>Armada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($shipments as $shipment)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($shipment->shipment_date)->format('d-m-Y') }}
                            </td>
                            <td>{{ $shipment->destination }}</td>
                            <td class="text-center">
                                @if ($shipment->inventory_type === 'Masuk')
                                    <span class="badge bg-success">Masuk</span>
                                @else
                                    <span class="badge bg-danger">Keluar</span>
                                @endif
                            </td>
                            <td>{{ $shipment->product_name }}</td>
                            <td class="text-center">{{ $shipment->quantity }}</td>
                            <td>{{ $shipment->city }}</td>
                            <td>{{ $shipment->armada }}</td>
                            <td class="text-center">
                                @canCrud
                                <a href="{{ route('shipments.edit', $shipment->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('shipments.destroy', $shipment->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcanCrud
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="fas fa-truck-loading fa-lg mb-2"></i><br>
                                Data pengiriman belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    $('#shipmentTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        responsive: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "‹",
                next: "›"
            }
        }
    });
});
</script>
@endpush
