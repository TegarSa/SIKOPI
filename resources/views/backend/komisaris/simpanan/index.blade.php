@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Daftar Simpanan</h1>
    </div>

    <!-- TABLE SIMPANAN -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <table id="datatables-simpanan" class="table table-striped w-100">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Anggota</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($simpanans as $item)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $item->anggota->nama ?? '-' }}
                                    </td>

                                    <td>
                                        @if($item->jenis == 'pokok')
                                            <span class="badge bg-primary">Pokok</span>
                                        @elseif($item->jenis == 'wajib')
                                            <span class="badge bg-warning text-dark">Wajib</span>
                                        @else
                                            <span class="badge bg-info">Sukarela</span>
                                        @endif
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tgl_transaksi)->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        @if($item->status_verifikasi == 'pending')
                                            <span class="badge bg-secondary">Pending</span>
                                        @elseif($item->status_verifikasi == 'verified')
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Simpanan</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="archive"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($simpanans->sum('jumlah'), 0, ',', '.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Akumulasi</span>
                        <span class="text-muted text-nowrap ms-1">Total Dana Masuk</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Pending</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-warning bg-warning-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $simpanans->where('status','pending')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-warning-light text-warning">Menunggu</span>
                        <span class="text-muted text-nowrap ms-1">Verifikasi Admin</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Verified</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $simpanans->where('status','verified')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Disetujui</span>
                        <span class="text-muted text-nowrap ms-1">Sudah Valid</span>
                    </div>
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

    $("#datatables-simpanan").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush