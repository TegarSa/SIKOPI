@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3 d-flex justify-content-between align-items-center">

        <h1 class="h3 d-inline align-middle">
            Rincian Angsuran
        </h1>

        <a href="{{ url()->previous() }}"
           class="btn btn-secondary btn-sm shadow-sm">

            <i class="fas fa-arrow-left me-1"></i>
            Kembali

        </a>

    </div>

    <div class="row mb-3">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Nama Anggota</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="user"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        {{ $pinjaman->anggota->nama ?? '-' }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Peminjam</span>
                        <span class="text-muted text-nowrap ms-1">Identitas Anggota</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Pinjaman</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="credit-card"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($pinjaman->jumlah_pinjaman,0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Pokok</span>
                        <span class="text-muted text-nowrap ms-1">Jumlah Dana Didapat</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Status Pengajuan</h5>
                        </div>
                        <div class="col-auto">
                            @if($pinjaman->status == 'approved' || $pinjaman->status == 'aktif')
                                <div class="stat text-success bg-success-light p-2 rounded-circle">
                                    <i class="align-middle" data-feather="check-circle"></i>
                                </div>
                            @elseif($pinjaman->status == 'pending')
                                <div class="stat text-warning bg-warning-light p-2 rounded-circle">
                                    <i class="align-middle" data-feather="clock"></i>
                                </div>
                            @else
                                <div class="stat text-danger bg-danger-light p-2 rounded-circle">
                                    <i class="align-middle" data-feather="x-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-3 mb-2">
                        @if($pinjaman->status == 'approved')
                            <span class="badge bg-success fs-5 px-3 py-1">Approved</span>
                        @elseif($pinjaman->status == 'pending')
                            <span class="badge bg-warning text-dark fs-5 px-3 py-1">Pending</span>
                        @else
                            <span class="badge bg-secondary fs-5 px-3 py-1">{{ ucfirst($pinjaman->status) }}</span>
                        @endif
                    </div>
                    <div class="mb-0">
                        <span class="text-muted text-nowrap">Kondisi Berkas Saat Ini</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <table id="datatables-angsuran"
                           class="table table-striped w-100">

                        <thead>

                            <tr>
                                <th width="5%">No</th>
                                <th>Angsuran Ke</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Pinjaman</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($pinjaman->angsuran as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->angsuran_ke }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->jumlah_bayar,0,',','.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->sisa_pinjaman,0,',','.') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->tgl_bayar)->format('d-m-Y') }}
                                </td>

                                <td>

                                    @if($item->status_verifikasi == 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Belum Dibayar
                                        </span>

                                    @elseif($item->status_verifikasi == 'verified')

                                        <span class="badge bg-success">
                                            Sudah Dibayar
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Ditolak
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
                        {{ $pinjaman->angsuran->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Tenor</span>
                        <span class="text-muted text-nowrap ms-1">Total Masa Cicilan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Belum Dibayar</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-warning bg-warning-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $pinjaman->angsuran->where('status_verifikasi','pending')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-warning-light text-warning">Pending</span>
                        <span class="text-muted text-nowrap ms-1">Tagihan Berjalan</span>
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
                        {{ $pinjaman->angsuran->where('status_verifikasi','verified')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Lunas</span>
                        <span class="text-muted text-nowrap ms-1">Telah Diverifikasi</span>
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