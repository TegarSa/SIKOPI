@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Kelola Pinjaman</h1>
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

    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('pinjaman.create') }}"
                       class="btn btn-primary">
                        Tambah Pinjaman
                    </a>
                </div>

                <div class="card-body">

                    <table id="datatables-pinjaman"
                           class="table table-striped w-100">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Anggota</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Tenor</th>
                                <th>Progress</th>
                                <th>Angsuran/Bulan</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($pinjamans as $item)

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

                                        {{ $item->angsuran->where('status_verifikasi', 'verified')->count() }}
                                        /
                                        {{ $item->tenor_bulan }}

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

                                        @elseif($item->status == 'aktif')

                                            <span class="badge bg-primary">
                                                Aktif
                                            </span>

                                        @elseif($item->status == 'lunas')

                                            <span class="badge bg-info">
                                                Lunas
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tgl_pengajuan)->format('d-m-Y') }}
                                    </td>

                                    <td>

                                        @if($item->status == 'approved')

                                        <a href="{{ route('pinjaman.detail',$item->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                        </a>

                                        @endif

                                        @if($item->status == 'pending')

                                            {{-- EDIT --}}
                                            <a href="{{ route('pinjaman.edit', $item->id) }}"
                                               class="btn btn-info btn-sm">

                                                <i class="fas fa-pen"></i>

                                            </a>

                                            {{-- HAPUS --}}
                                            <form action="{{ route('pinjaman.destroy', $item->id) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Hapus data pinjaman?')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        @else

                                            <span class="text-muted">
                                                Terkunci
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
        <div class="col-md-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Pengajuan</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="file-text"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $pinjamans->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Berkas</span>
                        <span class="text-muted text-nowrap ms-1">Masuk Sistem</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 d-flex">
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
                        {{ $pinjamans->where('status','pending')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-warning-light text-warning">Menunggu</span>
                        <span class="text-muted text-nowrap ms-1">Review Admin</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Aktif</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-info bg-info-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="activity"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $pinjamans->where('status','aktif')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-info-light text-info">Berjalan</span>
                        <span class="text-muted text-nowrap ms-1">Belum Lunas</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Lunas</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $pinjamans->where('status','lunas')->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Selesai</span>
                        <span class="text-muted text-nowrap ms-1">Tanggung Jawab</span>
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