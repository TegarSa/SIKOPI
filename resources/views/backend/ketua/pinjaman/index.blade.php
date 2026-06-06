@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">
            Verifikasi Pinjaman
        </h1>
    </div>

    <div class="row">

        <div class="col-12">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center p-3" role="alert">
                    <div class="stat text-danger bg-danger-light p-2 rounded-circle me-3 d-flex align-items-center justify-content-center">
                        <i class="align-middle" data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="grow">
                        <h5 class="fw-bold text-danger mb-0 text-uppercase small tracking-wider">Persetujuan Gagal</h5>
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
                        <h5 class="fw-bold text-success mb-0 text-uppercase small tracking-wider">Persetujuan Berhasil</h5>
                        <span class="text-muted small">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">

                <div class="card-body">

                    <table id="datatables-pinjaman"
                           class="table table-striped w-100">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Anggota</th>
                                <th>Pinjaman</th>
                                <th>Tenor</th>
                                <th>Bunga</th>
                                <th>Angsuran/Bulan</th>
                                <th>Status</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($pinjaman as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->anggota->nama ?? '-' }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $item->tenor_bulan }} Bulan
                                </td>

                                <td>
                                    {{ $item->bunga_flat }}%
                                </td>

                                <td>
                                    Rp {{ number_format($item->angsuran_perbulan, 0, ',', '.') }}
                                </td>

                                <td>

                                    @if($item->status == 'pending')

                                        <span class="badge bg-secondary">
                                            Pending
                                        </span>

                                    @elseif($item->status == 'approved')

                                        <span class="badge bg-success">
                                            Approved
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{-- DETAIL --}}
                                    <a href="{{ route('ketua.pinjaman.show', $item->id) }}"
                                       class="btn btn-secondary btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- APPROVE / REJECT --}}
                                    @if($item->status == 'pending')

                                        <div class="dropdown d-inline">

                                            <button
                                                class="btn btn-primary btn-sm dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">

                                                Aksi

                                            </button>

                                            <ul class="dropdown-menu">

                                                <li>

                                                    <form action="{{ route('ketua.pinjaman.approve', $item->id) }}"
                                                          method="POST">

                                                        @csrf

                                                        <button type="submit"
                                                                class="dropdown-item text-success">

                                                            ✔ Approve

                                                        </button>

                                                    </form>

                                                </li>

                                                <li>

                                                    <form action="{{ route('ketua.pinjaman.reject', $item->id) }}"
                                                          method="POST">

                                                        @csrf

                                                        <button type="submit"
                                                                class="dropdown-item text-danger">

                                                            ✖ Reject

                                                        </button>

                                                    </form>

                                                </li>

                                            </ul>

                                        </div>

                                    @else

                                        <span class="badge bg-success">
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
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Pending</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-warning bg-warning-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $pinjaman->where('status','pending')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-warning-light text-warning">Menunggu</span>
                        <span class="text-muted text-nowrap ms-1">Review Admin</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Approved</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $pinjaman->where('status','approved')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Disetujui</span>
                        <span class="text-muted text-nowrap ms-1">Berkas Valid</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Rejected</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-danger bg-danger-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="x-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $pinjaman->where('status','rejected')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-danger-light text-danger">Ditolak</span>
                        <span class="text-muted text-nowrap ms-1">Tidak Sesuai</span>
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

    $("#datatables-pinjaman").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush