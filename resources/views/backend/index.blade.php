@php
    use App\Models\Shipment;
    use App\Models\StockMovement;
    use App\Models\Supplier;
    use App\Models\PurchaseOrder;

    // 1. Pengiriman dalam perjalanan
    $shipmentsOnDelivery = Shipment::where('status', 'on_delivery')->count();

    // 2. Total stock barang (status = IN)
    $totalStock = StockMovement::where('movement_type', 'IN')->sum('quantity');

    // 3. Total supplier aktif
    $totalSuppliers = Supplier::count();

    // 4. Purchase order berjalan (misal status = pending / in_progress)
    $purchaseOrders = PurchaseOrder::count();
@endphp

@extends('backend.layouts.index')

@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Analytics</strong> Dashboard</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a>
                <a href="#" class="btn btn-primary">New Project</a>
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
                                            <h5 class="card-title">Pengiriman</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $shipmentsOnDelivery }}</h1>
                                    <div class="mb-0">
                                         <span class="badge badge-success-light">
                                            <i class="mdi mdi-arrow-bottom-right"></i> +4.8%
                                        </span>
                                        <span class="text-muted">Dalam perjalanan</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Stock Barang</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="archive"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalStock }}</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-success-light">
                                            <i class="mdi mdi-arrow-bottom-right"></i> +5.2%
                                        </span>
                                        <span class="text-muted">Total stok barang</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Supplier</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalSuppliers }}</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-danger-light">
                                            <i class="mdi mdi-arrow-bottom-right"></i> -3.6%
                                        </span>
                                        <span class="text-muted">Supplier aktif</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Purchase Orders</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $purchaseOrders }}</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-danger-light">
                                            <i class="mdi mdi-arrow-bottom-right"></i> -6.6%
                                        </span>
                                        <span class="text-muted">PO berjalan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <div class="float-end">
                            <form class="row g-2">
                                <div class="col-auto">
                                    <select class="form-select form-select-sm bg-light border-0">
                                        <option>Jan</option>
                                        <option value="1">Feb</option>
                                        <option value="2">Mar</option>
                                        <option value="3">Apr</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <input type="text" class="form-control form-control-sm bg-light rounded-2 border-0"
                                        style="width: 100px;" placeholder="Search..">
                                </div>
                            </form>
                        </div>
                        <h5 class="card-title mb-0">Recent Movement</h5>
                    </div>
                    <div class="card-body pt-2 pb-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-dashboard-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-xxl-4 d-flex order-1 order-xxl-3">
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
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Status Pengiriman</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie"></canvas>
                                </div>
                            </div>

                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-circle text-primary fa-fw"></i> Dalam Pengiriman <span
                                                class="badge badge-success-light">+12%</span></td>
                                        <td class="text-end">30</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-warning fa-fw"></i> Pending <span
                                                class="badge badge-danger-light">-3%</span></td>
                                        <td class="text-end">31</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-danger fa-fw"></i> Selesai </td>
                                        <td class="text-end">19</td>
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
                        <h5 class="card-title mb-0">Stok Barang Terlaris / Item Paling Banyak Keluar</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
