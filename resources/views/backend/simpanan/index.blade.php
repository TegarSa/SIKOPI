@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Kelola Simpanan</h1>
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

    <!-- TABLE SIMPANAN -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('simpanan.create') }}" class="btn btn-primary">
                        Tambah Simpanan
                    </a>
                </div>

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
                                <th width="15%">Aksi</th>
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

                                    <td>
                                        @if($item->status_verifikasi == 'pending')
                                            <a href="{{ route('simpanan.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        @endif

                                        <form action="{{ route('simpanan.destroy', $item->id) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf

                                            <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data simpanan ini?')">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

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