@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Dashboard</strong> SIKOPI</h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            <a href="{{ route('dashboard.export.pdf') }}" class="btn btn-light bg-white me-2">Laporan Rekap Koperasi (PDF)</a>
            <a href="{{ route('dashboard.export.csv') }}" class="btn btn-primary">Data Transaksi (CSV)</a>
        </div>
    </div>

    <div class="row">
       <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Anggota</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3 fw-bold">{{ $totalAnggota }}</h1>
                                <div class="mb-0">
                                    <span class="badge bg-success-light text-success">Aktif</span>
                                    <span class="text-muted text-nowrap">Terdaftar</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Simpanan</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-success">
                                            <i class="align-middle" data-feather="archive"></i>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-1 mb-3 fw-bold text-dark">
                                    Rp {{ number_format($totalSimpanan, 0, ',', '.') }}
                                </h4>
                                <div class="mb-0">
                                    <span class="badge bg-success-light text-success">Verified</span>
                                    <span class="text-muted text-nowrap">Data Tercatat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Pinjaman Aktif</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-warning">
                                            <i class="align-middle" data-feather="credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3 fw-bold">{{ $totalPinjamanAktif }}</h1>
                                <div class="mb-0">
                                    <span class="badge bg-warning-light text-warning">Approved</span>
                                    <span class="text-muted text-nowrap">Berjalan</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Saldo Kas</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-danger">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-1 mb-3 fw-bold text-dark">
                                    Rp {{ number_format($saldoKas, 0, ',', '.') }}
                                </h4>
                                <div class="mb-0">
                                    <span class="badge bg-info-light text-info">Sistem</span>
                                    <span class="text-muted text-nowrap">Saldo Akhir</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-7 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Grafik Transaksi Bulanan</h5>
                </div>
                <div class="card-body py-1">
                    <div class="chart chart-sm w-100">
                        <canvas id="chartTransaksi"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

    <div class="col-12 col-md-6 col-xxl-4 d-flex order-1 order-xxl-3">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Rekap Aktivitas Sistem</h5>
            </div>
            <div class="card-body d-flex">

                <div class="align-self-center w-100">
                    <div class="py-2">
                        <div class="chart chart-xs" style="max-height: 140px; margin: 0 auto;">
                            <canvas id="chartPie"></canvas>
                        </div>
                    </div>

                    <table class="table mb-0 mt-2">
                        <tbody>
                            <tr>
                                <td>Simpanan Tercatat</td>
                                <td class="text-end fw-bold text-muted">
                                    Rp {{ number_format($totalKategoriSimpanan,0,',','.') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Pinjaman Tercatat</td>
                                <td class="text-end fw-bold text-muted">
                                    Rp {{ number_format($totalKategoriPinjaman,0,',','.') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Angsuran Tercatat</td>
                                <td class="text-end fw-bold text-muted">
                                    Rp {{ number_format($totalKategoriAngsuran,0,',','.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 col-xxl-8 d-flex">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">5 Transaksi Terbaru</h5>
            </div>
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pengguna</th>
                                <th class="d-none d-xl-table-cell">Kategori</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($transaksiTerbaru as $item)
                            <tr>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td class="fw-semibold text-dark">
                                    {{ $item->anggota->nama ?? '-' }}
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    @if($item->kategori == 'simpanan')
                                        <span class="badge bg-success-light text-success">Simpanan</span>
                                    @elseif($item->kategori == 'pinjaman')
                                        <span class="badge bg-danger-light text-danger">Pinjaman</span>
                                    @else
                                        <span class="badge bg-info-light text-info">Angsuran</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-dark">
                                    Rp {{ number_format($item->jumlah,0,',','.') }}
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

</div>
@endsection

@push('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    new Chart(document.getElementById("chartTransaksi"), {
        type: "line",
        data: {
            labels: [
                @foreach($grafikBulanan as $item)
                    "Bulan {{ $item->bulan }}",
                @endforeach
            ],
            datasets: [
                {
                    label: "Dana Masuk",
                    fill: true,
                    backgroundColor: "rgba(59, 125, 221, 0.05)",
                    borderColor: "#3b7ddd",
                    data: [
                        @foreach($grafikBulanan as $item)
                            {{ $item->masuk }},
                        @endforeach
                    ]
                },
                {
                    label: "Dana Keluar",
                    fill: true,
                    backgroundColor: "rgba(217, 83, 79, 0.05)",
                    borderColor: "#d9534f",
                    data: [
                        @foreach($grafikBulanan as $item)
                            {{ $item->keluar }},
                        @endforeach
                    ]
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        borderDash: [3, 3]
                    }
                }
            }
        }
    });

    new Chart(document.getElementById("chartPie"), {
        type: "pie",
        data: {
            labels: ["Simpanan", "Pinjaman", "Angsuran"],
            datasets: [{
                data: [
                    {{ $totalKategoriSimpanan }},
                    {{ $totalKategoriPinjaman }},
                    {{ $totalKategoriAngsuran }}
                ],
                backgroundColor: [
                    "#3b7ddd",
                    "#fcb92c",
                    "#dc3545"
                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush