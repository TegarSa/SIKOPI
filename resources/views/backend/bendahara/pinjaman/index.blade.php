@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Data Pinjaman Aktif</h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center p-3" role="alert">
            <div class="stat text-danger bg-danger-light p-2 rounded-circle me-3 d-flex align-items-center justify-content-center">
                <i class="align-middle" data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="grow">
                <h5 class="fw-bold text-danger mb-0 text-uppercase small tracking-wider">Pencairan Gagal</h5>
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
                <h5 class="fw-bold text-success mb-0 text-uppercase small tracking-wider">Pencairan Berhasil</h5>
                <span class="text-muted small">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <table id="datatables-pinjaman" class="table table-striped w-100">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Anggota</th>
                                <th>Pinjaman</th>
                                <th>Tenor</th>
                                <th>Bunga</th>
                                <th>Angsuran/Bulan</th>
                                <th width="20%">Status Pencairan</th>
                                <th width="10%">Detail</th>
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
                                    {{-- REVISI LOGIKA: MEMASTIKAN IS_DICAIRKAN BERFUNGSI SEBAGAI SAKLAR UTAMA TOMBOL --}}
                                    @if($item->is_dicairkan == 1 || $item->status == 'lunas')
                                        {{-- Jika sudah ditransfer, TOMBOL DI-HIDDEN & diganti badge hijau ini --}}
                                        <span class="badge bg-success p-2 shadow-sm fs-6 d-inline-flex align-items-center">
                                            <i class="align-middle me-1" data-feather="check-circle" style="width:14px; height:14px;"></i> Dana Dicairkan
                                        </span>
                                    
                                    @elseif($item->status == 'approved' && $item->is_dicairkan == 0)
                                        {{-- Jika baru di-approve ketua & belum ditransfer bendahara --}}
                                        <form action="{{ route('bendahara.pinjaman.cairkan', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning text-dark fw-bold shadow-sm p-2 px-3 align-middle" style="font-size: 12px;" onclick="return confirm('Apakah Anda yakin sudah mentransfer dana ini ke rekening anggota?')">
                                                <i class="align-middle me-1" data-feather="send" style="width:14px; height:14px;"></i> Transfer & Cairkan
                                            </button>
                                        </form>

                                    @elseif($item->status == 'pending')
                                        <span class="badge bg-secondary p-2">Menunggu Validasi Ketua</span>
                                    
                                    @else
                                        <span class="badge bg-danger p-2">Ditolak</span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('bendahara.pinjaman.detail', $item->id) }}"
                                        class="btn btn-secondary btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

    {{-- BAGIAN CARD STATISTIK DIBAWAH --}}
    <div class="row mb-3">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Pinjaman Aktif</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="activity"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $totalPinjamanAktif }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Approved</span>
                        <span class="text-muted text-nowrap ms-1">Sedang Berjalan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Angsuran</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="repeat"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $totalAngsuran }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Lancar</span>
                        <span class="text-muted text-nowrap ms-1">Transaksi Masuk</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Nilai Pinjaman</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-danger bg-danger-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($totalNilaiPinjaman, 0, ',', '.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-danger-light text-danger">Outstanding</span>
                        <span class="text-muted text-nowrap ms-1">Total Dana Keluar</span>
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