@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3 d-flex justify-content-between align-items-center">

        <h1 class="h3 d-inline align-middle">
            Detail Pinjaman
        </h1>

        <a href="{{ route('ketua.pinjaman.index') }}"
           class="btn btn-secondary btn-sm">

            <i class="fas fa-arrow-left"></i>
            Kembali

        </a>

    </div>

    {{-- INFORMASI PINJAMAN --}}
    <div class="row match-height">

        <div class="col-md-6 mb-4">

            <div class="card h-100 shadow-sm">

                <div class="card-header bg-transparent border-0 pb-0 pt-4 px-4">
                    <h5 class="card-title mb-0 text-primary fw-bold">
                        <i class="align-middle me-2 fas fa-user-circle fa-lg text-muted"></i> Data Anggota
                    </h5>
                </div>

                <div class="card-body px-4 py-3">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                            <span class="text-muted fw-medium">No Anggota</span>
                            <span class="text-end fw-bold text-dark">{{ $pinjaman->anggota->no_anggota }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                            <span class="text-muted fw-medium">Nama Anggota</span>
                            <span class="text-end fw-semibold">{{ $pinjaman->anggota->nama }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                            <span class="text-muted fw-medium">Jabatan</span>
                            <span class="text-end text-secondary">{{ $pinjaman->anggota->jabatan ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-0">
                            <span class="text-muted fw-medium">Unit Kerja</span>
                            <span class="text-end text-secondary">{{ $pinjaman->anggota->unit_kerja ?? '-' }}</span>
                        </li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card h-100 shadow-sm">

                <div class="card-header bg-transparent border-0 pb-0 pt-4 px-4">
                    <h5 class="card-title mb-0 text-primary fw-bold">
                        <i class="align-middle me-2 fas fa-wallet fa-lg text-muted"></i> Informasi Pinjaman
                    </h5>
                </div>

                <div class="card-body px-4 py-3">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                            <span class="text-muted fw-medium">Jumlah Pinjaman</span>
                            <span class="text-end fw-bold text-success fs-5">Rp {{ number_format($pinjaman->jumlah_pinjaman,0,',','.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                            <span class="text-muted fw-medium">Tenor</span>
                            <span class="text-end badge bg-info-light text-info px-2 py-1 fw-semibold">{{ $pinjaman->tenor_bulan }} Bulan</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                            <span class="text-muted fw-medium">Bunga Flat</span>
                            <span class="text-end fw-semibold text-danger">{{ $pinjaman->bunga_flat }}%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                            <span class="text-muted fw-medium">Total Kewajiban</span>
                            <span class="text-end fw-bold text-dark">Rp {{ number_format($pinjaman->total_kewajiban,0,',','.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                            <span class="text-muted fw-medium">Angsuran / Bulan</span>
                            <span class="text-end fw-bold text-primary">Rp {{ number_format($pinjaman->angsuran_perbulan,0,',','.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted fw-medium">Tanggal Pengajuan</span>
                            <span class="text-end text-secondary">{{ \Carbon\Carbon::parse($pinjaman->tgl_pengajuan)->format('d-m-Y') }}</span>
                        </li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

    {{-- TABEL ANGSURAN --}}
    <div class="card">

        <div class="card-header">
            <h5 class="card-title mb-0">
                Jadwal Angsuran
            </h5>
        </div>

        <div class="card-body">

            <table id="datatables-angsuran"
                   class="table table-striped w-100">

                <thead>

                    <tr>
                        <th>No</th>
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

                        <td>{{ $item->angsuran_ke }}</td>

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

                            @if($item->status_verifikasi == 'verified')

                                <span class="badge bg-success">
                                    Sudah Dibayar
                                </span>

                            @else

                                <span class="badge bg-warning text-dark">
                                    Belum Dibayar
                                </span>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    {{-- TOMBOL APPROVE REJECT --}}
    @if($pinjaman->status == 'pending')

    <div class="card">

        <div class="card-body text-end">

            <form action="{{ route('ketua.pinjaman.reject', $pinjaman->id) }}"
                  method="POST"
                  class="d-inline">

                @csrf

                <button type="submit"
                        class="btn btn-danger">

                    Reject

                </button>

            </form>

            <form action="{{ route('ketua.pinjaman.approve', $pinjaman->id) }}"
                  method="POST"
                  class="d-inline">

                @csrf

                <button type="submit"
                        class="btn btn-success">

                    Approve

                </button>

            </form>

        </div>

    </div>

    @endif

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