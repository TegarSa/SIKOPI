@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">Kelola Staff</h1>
    </div>

    <!-- TABLE USER -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        Tambah Staff
                    </a>
                </div>

                <div class="card-body">

                    <table id="datatables-users" class="table table-striped w-100">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($users as $user)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <img
                                            src="{{ $user->photo_profile
                                                ? asset('assets/photo_profile/' . $user->photo_profile)
                                                : asset('assets/img/Default.jpeg') }}"
                                            class="rounded"
                                            width="45"
                                            height="45"
                                            style="object-fit: cover;">
                                    </td>

                                    <td>{{ $user->name }}</td>

                                    <td>{{ $user->email }}</td>

                                    <td>
                                        @switch($user->role)

                                            @case('admin')
                                                <span class="badge bg-danger">
                                                    Admin
                                                </span>
                                            @break

                                            @case('ketua')
                                                <span class="badge bg-primary">
                                                    Ketua
                                                </span>
                                            @break

                                            @case('sekretaris')
                                                <span class="badge bg-info">
                                                    Sekretaris
                                                </span>
                                            @break

                                            @case('bendahara')
                                                <span class="badge bg-warning text-dark">
                                                    Bendahara
                                                </span>
                                            @break

                                            @case('komisaris')
                                                <span class="badge bg-dark">
                                                    Komisaris
                                                </span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">
                                                    {{ $user->role }}
                                                </span>

                                        @endswitch
                                    </td>

                                    <td>
                                        @if($user->status == 'aktif')
                                            <span class="badge bg-success">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus pengguna ini?')">

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

                        <h1 class="mt-1 mb-3">{{ $users->count() }}</h1>

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

    $("#datatables-users").DataTable({
        responsive: true,
        pageLength: 10
    });

});
</script>

@endpush