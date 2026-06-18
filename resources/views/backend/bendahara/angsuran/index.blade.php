@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Rincian Angsuran</h1>
        <a href="{{ route('bendahara.pinjaman.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center p-3" role="alert">
            <div class="stat text-danger bg-danger-light p-2 rounded-circle me-3 d-flex align-items-center justify-content-center">
                <i class="align-middle" data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="grow">
                <h5 class="fw-bold text-danger mb-0 text-uppercase small tracking-wider">Gagal</h5>
                <span class="text-muted small">{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center p-3" role="alert">
            <div class="stat text-success bg-success-light p-2 rounded-circle me-3 d-flex align-items-center justify-content-center">
                <i class="align-middle" data-feather="check-circle" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="grow">
                <h5 class="fw-bold text-success mb-0 text-uppercase small tracking-wider">Berhasil</h5>
                <span class="text-muted small">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABLE ANGSURAN -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <table id="datatables-angsuran" class="table table-striped w-100">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Anggota</th>
                                <th>Angsuran Ke</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Pinjaman</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th width="15%">Verifikasi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($angsurans as $item)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $item->anggota->nama ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->angsuran_ke }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->sisa_pinjaman, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tgl_bayar)->format('d-m-Y') }}
                                    </td>

                                    <td>

                                        @if($item->status_verifikasi == 'pending')

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @elseif($item->status_verifikasi == 'verified')

                                            <span class="badge bg-success">
                                                Dibayar
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @endif

                                    </td>

                                    <!-- AKSI -->
                                    <td>

                                        @if($item->status_verifikasi == 'pending')

                                            <form action="{{ route('bendahara.angsuran.bayar', $item->id) }}"
                                                method="POST"
                                                class="d-inline">

                                                @csrf

                                                <button type="submit"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm('Konfirmasi pembayaran angsuran?')">

                                                    <i class="fas fa-check"></i>
                                                    Terima Bayar

                                                </button>

                                            </form>

                                        @else

                                            <span class="text-muted">
                                                Selesai
                                            </span>

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
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Angsuran</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="layers"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $angsurans->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Keseluruhan</span>
                        <span class="text-muted text-nowrap ms-1">Rekam Data</span>
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
                        {{ $angsurans->where('status_verifikasi','pending')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-warning-light text-warning">Menunggu</span>
                        <span class="text-muted text-nowrap ms-1">Verifikasi</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Sudah Dibayar</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $angsurans->where('status_verifikasi','verified')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Verified</span>
                        <span class="text-muted text-nowrap ms-1">Selesai</span>
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

    $("#datatables-angsuran").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush