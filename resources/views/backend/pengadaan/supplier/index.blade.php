@extends('backend.layouts.index')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="align-middle h3 d-inline">List Supplier</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            @canCrud
                            <a href="{{ route('supplier.create') }}" class="btn btn-primary">
                                Tambah Supplier
                            </a>
                            @endcanCrud
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatables-responsive" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->contact }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>
                                        @canCrud
                                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('supplier.destroy', $supplier->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcanCrud
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
@endsection

@push('js')
<script src="{{ asset('backend/js/datatables.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $("#datatables-responsive").DataTable({
            responsive: true
        });
    });
</script>
@endpush
