@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3">Laporan Transaksi</h1>
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
                        Rp {{ number_format($summary['saldo_akhir'], 0, ',', '.') }}
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
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Masuk</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success bg-success-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="arrow-down-left"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($summary['total_masuk'], 0, ',', '.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-success-light text-success">Dana Masuk</span>
                        <span class="text-muted text-nowrap ms-1">Periode Terpilih</span>
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
                    <h1 class="mt-1 mb-3 fw-bold text-dark fs-3">
                        Rp {{ number_format($summary['total_keluar'], 0, ',', '.') }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-danger-light text-danger">Dana Keluar</span>
                        <span class="text-muted text-nowrap ms-1">Periode Terpilih</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TABLE (TENGAH) ================= --}}
    <div class="card mt-3">

        <div class="card-header">
            Riwayat Transaksi
        </div>

        <div class="card-body">

            <table class="table table-striped w-100" id="datatables-transaksi">

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
                                <span class="badge bg-{{ $t->jenis == 'masuk' ? 'success' : 'danger' }}">
                                    {{ $t->jenis }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $t->keterangan }}</td>
                            <td>{{ $t->created_at->format('d-m-Y') }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    {{-- ================= CHART (BAWAH) ================= --}}
    <div class="row mt-3">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Cashflow Bulanan
                </div>
                <div class="card-body">
                    <div style="position: relative; height:300px;">
                        <canvas id="cashflowChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Komposisi Transaksi
                </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ asset('backend/js/datatables.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    $("#datatables-transaksi").DataTable({
        responsive: true,
        pageLength: 10
    });

    const cashflowCtx = document.getElementById('cashflowChart');

    new Chart(cashflowCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($summary['per_bulan']->pluck('bulan')) !!},
            datasets: [
                {
                    label: 'Masuk',
                    data: {!! json_encode($summary['per_bulan']->pluck('masuk')) !!},
                    borderColor: '#2fb575',
                    backgroundColor: 'rgba(47, 181, 117, 0.1)',
                    fill: true,
                    tension: 0.2
                },
                {
                    label: 'Keluar',
                    data: {!! json_encode($summary['per_bulan']->pluck('keluar')) !!},
                    borderColor: '#e56767',
                    backgroundColor: 'rgba(229, 103, 103, 0.1)',
                    fill: true,
                    tension: 0.2
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    const kategoriCtx = document.getElementById('kategoriChart');

    new Chart(kategoriCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($summary['per_kategori']->pluck('kategori')->map(function($item){ return ucfirst($item); })) !!},
            datasets: [{
                data: {!! json_encode($summary['per_kategori']->pluck('total')) !!},
                backgroundColor: [
                    '#4fc3f7', // Simpanan
                    '#ffb74d', // Pinjaman
                    '#f06292', // Angsuran
                    '#ba68c8',
                    '#4db6ac'
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 15,
                        padding: 15
                    }
                }
            }
        }
    });

});
</script>

@endpush