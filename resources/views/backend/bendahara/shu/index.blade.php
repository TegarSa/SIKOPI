@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3">Sisa Hasil Usaha (SHU)</h1>

        <a href="{{ route('shu.create') }}" class="btn btn-primary">
            + Generate SHU
        </a>
    </div>

    {{-- ================= TABLE SHU ================= --}}
    <div class="card">

        <div class="card-body">

            <table id="datatables-shu" class="table table-striped w-100">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Total Laba</th>
                        <th>% SHU</th>
                        <th>Total Dibagikan</th>
                        <th>Dibuat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($shu as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->periode_awal)->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse($item->periode_akhir)->format('d M Y') }}
                            </td>

                            <td>
                                Rp {{ number_format($item->total_laba,0,',','.') }}
                            </td>

                            <td>
                                {{ $item->persentase_shu }}%
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    Rp {{ number_format($item->total_dibagikan,0,',','.') }}
                                </span>
                            </td>

                            <td>
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>

                            <td>

                                <a href="{{ route('shu.show', $item->id) }}"
                                   class="btn btn-info btn-sm">

                                    Detail

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <div class="row mb-3">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total SHU Generated</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="award"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $shu->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Periode</span>
                        <span class="text-muted text-nowrap ms-1">Telah Dihitung</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Dana Dibagikan</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="gift"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($shu->sum('total_dibagikan'),0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Alokasi SHU</span>
                        <span class="text-muted text-nowrap ms-1">Hak Anggota</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Volume Transaksi Diolah</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-info bg-info-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="activity"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($shu->sum('total_laba'),0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-info-light text-info">Kumulatif</span>
                        <span class="text-muted text-nowrap ms-1">Simpanan & Jasa Pinjaman</span>
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

    $("#datatables-shu").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush