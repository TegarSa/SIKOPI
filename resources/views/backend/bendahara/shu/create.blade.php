@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3">Generate SHU</h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center p-3" role="alert">
            <div class="stat text-danger bg-danger-light p-2 rounded-circle me-3 d-flex align-items-center justify-content-center">
                <i class="align-middle" data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="grow">
                <h5 class="fw-bold text-danger mb-0 text-uppercase small tracking-wider">Kalkulasi Gagal</h5>
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
                <h5 class="fw-bold text-success mb-0 text-uppercase small tracking-wider">Kalkulasi Berhasil</h5>
                <span class="text-muted small">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">

        <div class="card-body">

            <form action="{{ route('shu.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Periode Awal</label>
                        <input type="date" name="periode_awal" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Periode Akhir</label>
                        <input type="date" name="periode_akhir" class="form-control" required>
                    </div>
                </div>

                <div class="card bg-light border-start border-success border-4 mb-4 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-start gap-3">
                            <div class="stat text-success bg-success-light p-2 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="align-middle" data-feather="sliders" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-success mb-1 text-uppercase small tracking-wider">Kalkulasi Otomatis Sistem</h5>
                                <p class="text-muted small mb-0">
                                    Sesuai dengan ketetapan anggaran koperasi, persentase pembagian SHU dikunci secara sistem:
                                </p>
                                <ul class="small text-dark fw-bold mt-2 mb-0">
                                    <li>Alokasi Hak dari Simpanan Anggota: <span class="text-success">10%</span></li>
                                    <li>Alokasi Hak dari Jasa/Bunga Pinjaman: <span class="text-success">50%</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-light border-start border-info border-4 mb-4 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-start gap-3">
                            <div class="stat text-info bg-info-light p-2 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="align-middle" data-feather="info" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-info mb-1 text-uppercase small tracking-wider">Informasi Sumber Data</h5>
                                <p class="text-muted small mb-2">Sisa Hasil Usaha (SHU) secara otomatis akan dikalkulasi berdasarkan akumulasi data periode yang dipilih:</p>
                                <ul class="list-unstyled mb-0 row g-2">
                                    <div class="col-sm-6">
                                        <li class="d-flex align-items-center gap-2 small text-dark fw-medium">
                                            <i class="align-middle text-success" data-feather="plus-circle" style="width: 14px; height: 14px;"></i>
                                            Total Simpanan Masuk
                                        </li>
                                    </div>
                                    <div class="col-sm-6">
                                        <li class="d-flex align-items-center gap-2 small text-dark fw-medium">
                                            <i class="align-middle text-success" data-feather="plus-circle" style="width: 14px; height: 14px;"></i>
                                            Total Jasa/Bunga Pinjaman (Approved)
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('shu.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Generate SHU</button>
                </div>
            </form>

        </div>

    </div>

</div>
@endsection