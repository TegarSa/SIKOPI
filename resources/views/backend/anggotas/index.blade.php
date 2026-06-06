@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Kelola Data Anggota</h1>
    </div>

    <!-- TABLE ANGGOTA -->
    <div class="row">
        <div class="col-12">

            <div class="card">

                <!-- HEADER BUTTON -->
                <div class="card-header text-end">

                    <button type="button"
                            class="btn btn-success me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#importCsvModal">

                        <i class="fas fa-file-csv"></i>
                        Import CSV

                    </button>

                    <a href="{{ route('anggota.create') }}"
                       class="btn btn-primary">

                        <i class="fas fa-plus"></i>
                        Tambah Anggota

                    </a>

                </div>

                <!-- TABLE -->
                <div class="card-body">

                    <table id="datatables-anggota"
                           class="table table-striped w-100">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Anggota</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>No HP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($anggotas as $anggota)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grid_data ?? $anggota->no_anggota }}</td>
                                    <td>{{ $anggota->nama }}</td>
                                    <td>{{ $anggota->nip ?? '-' }}</td>
                                    <td>{{ $anggota->jabatan ?? '-' }}</td>
                                    <td>{{ $anggota->unit_kerja ?? '-' }}</td>
                                    <td>{{ $anggota->no_hp ?? '-' }}</td>
                                    <td>
                                        @if($anggota->status == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('anggota.edit', $anggota->id) }}"
                                        class="btn btn-info btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('anggota.destroy', $anggota->id) }}"
                                            method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted text-uppercase fs-6 fw-bold">Total Anggota</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary bg-primary-light p-2 rounded-circle">
                                <i class="align-middle" data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 fw-bold text-dark">
                        {{ $anggotas->count() }}
                    </h1>
                    <div class="mb-0">
                        <span class="badge bg-primary-light text-primary">Aktif</span>
                        <span class="text-muted text-nowrap ms-1">Jumlah Anggota Koperasi</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 d-flex">
            <div class="card flex-fill border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-3 pb-0">
                    <h5 class="card-title mb-0 text-muted text-uppercase fs-6 fw-bold">Informasi Data Anggota</h5>
                </div>
                <div class="card-body py-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="stat text-info bg-info-light p-2 rounded-circle d-none d-sm-flex align-items-center justify-content-center">
                            <i class="align-middle" data-feather="info" style="width: 20px; height: 20px;"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 lh-base">
                                Modul ini digunakan untuk mengelola data master anggota koperasi secara terpusat. 
                                Setiap data yang terdaftar dalam modul ini akan digunakan sebagai acuan utama 
                                dalam menjalankan seluruh transaksi simpanan, pinjaman, maupun angsuran di dalam sistem SIKOPI.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ================= MODAL IMPORT CSV ================= -->
<div class="modal fade" id="importCsvModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog">

        <form action="{{ route('anggota.import') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Import CSV Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="file"
                           name="file"
                           class="form-control"
                           accept=".csv"
                           required>

                    <small class="text-muted d-block mt-2">
                        Format CSV:
                        <br>
                        no_anggota,nama,nip,jabatan,unit_kerja,no_hp,alamat,tgl_masuk,status
                    </small>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-success">
                        Import
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection

@push('js')

<script src="{{ asset('backend/js/datatables.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    if ($.fn.DataTable.isDataTable("#datatables-anggota")) {
        $("#datatables-anggota").DataTable().destroy();
    }

    $("#datatables-anggota").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush