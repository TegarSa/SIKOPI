@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">
            Riwayat Transaksi
        </h1>
    </div>

   <div class="row mb-3">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Kas</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="wallet"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($totalKas, 0, ',', '.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Realtime</span>
                        <span class="text-muted text-nowrap ms-1">Posisi Kas Akhir</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Dana Masuk</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="arrow-down-left"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Cash In</span>
                        <span class="text-muted text-nowrap ms-1">Total Dana Diterima</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Dana Keluar</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-danger bg-danger-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="arrow-up-right"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-danger-light text-danger">Cash Out</span>
                        <span class="text-muted text-nowrap ms-1">Total Dana Keluar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <form method="GET"
                          action="{{ route('transaksi.index') }}">

                        <div class="row">

                            <div class="col-md-4">

                                <select name="kategori"
                                        class="form-select">

                                    <option value="semua">
                                        Semua Kategori
                                    </option>

                                    <option value="simpanan"
                                        {{ $kategori == 'simpanan' ? 'selected' : '' }}>
                                        Simpanan
                                    </option>

                                    <option value="pinjaman"
                                        {{ $kategori == 'pinjaman' ? 'selected' : '' }}>
                                        Pinjaman
                                    </option>

                                    <option value="angsuran"
                                        {{ $kategori == 'angsuran' ? 'selected' : '' }}>
                                        Angsuran
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-2">

                                <button type="submit"
                                        class="btn btn-primary">

                                    Filter

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <table id="datatables-transaksi"
                           class="table table-striped w-100">

                        <thead>

                            <tr>

                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Anggota</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Saldo Setelah</th>
                                <th>Keterangan</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($transaksis as $item)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        {{ $item->anggota->nama ?? '-' }}
                                    </td>

                                    <td>

                                        @if($item->jenis == 'masuk')

                                            <span class="badge bg-success">
                                                Masuk
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Keluar
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($item->kategori == 'simpanan')

                                            <span class="badge bg-primary">
                                                Simpanan
                                            </span>

                                        @elseif($item->kategori == 'pinjaman')

                                            <span class="badge bg-warning text-dark">
                                                Pinjaman
                                            </span>

                                        @else

                                            <span class="badge bg-info">
                                                Angsuran
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->saldo_setelah, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ $item->keterangan }}
                                    </td>

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

    $("#datatables-transaksi").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush