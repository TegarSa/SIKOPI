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
            <a href="{{ route('komisaris.shu.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </div>

    {{-- ================= SUMMARY ================= --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Laba</h5>
                    <h3>
                        Rp {{ number_format($shu->total_laba,0,',','.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Persentase SHU</h5>
                    <h3>{{ $shu->persentase_shu }}%</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Dibagikan</h5>
                    <h3>
                        Rp {{ number_format($shu->total_dibagikan,0,',','.') }}
                    </h3>
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