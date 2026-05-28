@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">List Staff</h1>
    </div>

    <!-- TABLE -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        Tambah Staff
                    </a>
                </div>

                <div class="card-body">
                    <table id="datatables-staff" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Institution</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $staff->photo_profile
                                            ? asset('assets/photo_profile/' . $staff->photo_profile)
                                            : asset('assets/img/Default.jpeg') }}"
                                            class="rounded" width="45">
                                    </td>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>{{ $staff->institution }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $staff->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $staff->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus staff ini?')">
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

    <!-- STAFF + CALENDAR -->
    <div class="row">

        <!-- KIRI : STAFF -->
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Staff</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="users"></i>
                                </div>
                            </div>
                        </div>

                        <h1 class="mt-1 mb-3">{{ $staffs->count() }}</h1>

                        <div class="mb-0">
                            <span class="badge badge-success-light">
                                <i class="mdi mdi-arrow-bottom-right"></i> Aktif
                            </span>
                            <span class="text-muted">Total staff aktif</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-actions float-end">
                            <div class="dropdown position-relative">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <i class="align-middle" data-feather="more-horizontal"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Real-Time</h5>
                    </div>
                    <div class="card-body px-4">
                        <div id="world_map" style="height:165px;"></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- KANAN : CALENDAR -->
        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <div class="dropdown position-relative">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title mb-0">Calendar</h5>
                </div>

                <div class="card-body pt-2 pb-3">
                    <div class="chart chart-sm">
                        <div id="datetimepicker-dashboard"></div>
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
    $("#datatables-staff").DataTable({
        responsive: true
    });
});
</script>
@endpush
