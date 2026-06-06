@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3">Laporan Keuangan</h1>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-4">
                    <select name="bulan" class="form-control">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                Bulan {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="tahun" class="form-control"
                           value="{{ $tahun }}" placeholder="Tahun">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Masuk</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="arrow-down-left"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-success fs-3">
                        Rp {{ number_format($totalMasuk,0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Dana Masuk</span>
                        <span class="text-muted text-nowrap ms-1">Simpanan & Angsuran</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Keluar</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-danger bg-danger-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="arrow-up-right"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-danger fs-3">
                        Rp {{ number_format($totalKeluar,0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-danger-light text-danger">Dana Keluar</span>
                        <span class="text-muted text-nowrap ms-1">Pinjaman & Penarikan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Saldo Akhir</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="wallet"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-primary fs-3">
                        Rp {{ number_format($saldo,0,',','.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Kas Aktif</span>
                        <span class="text-muted text-nowrap ms-1">Posisi Keuangan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TABLE (TENGAH) ================= --}}
    <div class="card mt-3">
        <div class="card-header">Detail Transaksi</div>
        <div class="card-body">
            <table class="table table-striped w-100" id="datatables-laporan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->anggota->nama ?? '-' }}</td>
                            <td>{{ ucfirst($t->kategori) }}</td>
                            <td>
                                @if($t->jenis == 'masuk')
                                    <span class="badge bg-success">Masuk</span>
                                @else
                                    <span class="badge bg-danger">Keluar</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($t->jumlah,0,',','.') }}</td>
                            <td>{{ $t->keterangan }}</td>
                            <td>{{ $t->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= CHART BERGANTI GAYA (BAWAH) ================= --}}
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Perbandingan Cashflow Bulan Ini</div>
                <div class="card-body">
                    <div style="position: relative; height:300px;">
                        <canvas id="cashflowChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Kategori Transaksi Terbanyak</div>
                <div class="card-body">
                    <div style="position: relative; height:300px;">
                        <canvas id="kategoriChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="{{ asset('backend/js/datatables.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    $("#datatables-laporan").DataTable({
        responsive: true,
        pageLength: 10
    });

    // ================= NEW CASHFLOW CHART (BAR BERDAMPINGAN) =================
    const cashflowCtx = document.getElementById('cashflowChart');
    new Chart(cashflowCtx, {
        type: 'bar',
        data: {
            labels: ['Uang Masuk vs Keluar'],
            datasets: [
                {
                    label: 'Total Masuk',
                    data: [{{ $totalMasuk }}],
                    backgroundColor: '#2fb575',
                    borderRadius: 5
                },
                {
                    label: 'Total Keluar',
                    data: [{{ $totalKeluar }}],
                    backgroundColor: '#e56767',
                    borderRadius: 5
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // ================= NEW KATEGORI CHART (HORIZONTAL BAR) =================
    const kategoriCtx = document.getElementById('kategoriChart');
    new Chart(kategoriCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($kategori->pluck('kategori')->map(function($item){ return ucfirst($item); })) !!},
            datasets: [{
                label: 'Total Nominal',
                data: {!! json_encode($kategori->pluck('total')) !!},
                backgroundColor: '#4fc3f7',
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y', // Membuat bar memanjang ke samping (Horizontal)
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Sembunyikan label atas karena informasinya sudah ada di sisi kiri
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>
@endpush