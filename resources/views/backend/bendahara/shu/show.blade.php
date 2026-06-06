@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="h3">Detail SHU</h1>
            <p class="text-muted mb-0">
                Periode:
                {{ \Carbon\Carbon::parse($shu->periode_awal)->format('d M Y') }}
                -
                {{ \Carbon\Carbon::parse($shu->periode_akhir)->format('d M Y') }}
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('shu.csv', $shu->id) }}" class="btn btn-success d-inline-flex align-items-center gap-1">
                <i class="align-middle" data-feather="file-text" style="width: 14px; height: 14px;"></i> Export CSV
            </a>
            
            <a href="{{ route('shu.pdf', $shu->id) }}" class="btn btn-danger">
                Export PDF
            </a>

            <a href="{{ route('shu.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </div>

    <div class="row mb-3">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Laba</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($shu->total_laba,0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Hasil Usaha</span>
                        <span class="text-muted text-nowrap ms-1">Acuan Dasar SHU</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Persentase SHU</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-warning bg-warning-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="percent"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $shu->persentase_shu }}%
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-warning-light text-warning">Alokasi</span>
                        <span class="text-muted text-nowrap ms-1">Porsi Bagi Hasil</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Dibagikan</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="pie-chart"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($shu->total_dibagikan,0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Selesai</span>
                        <span class="text-muted text-nowrap ms-1">Siap Didistribusikan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TABLE DETAIL ================= --}}
    <div class="card mt-3">

        <div class="card-body">

            <table class="table table-striped" id="datatables-shu-detail">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>SHU Diterima</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($shu->details as $detail)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $detail->anggota->nama ?? '-' }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    Rp {{ number_format($detail->jumlah_shu,0,',','.') }}
                                </span>
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection

@push('js')

<script src="{{ asset('backend/js/datatables.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    $("#datatables-shu-detail").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush