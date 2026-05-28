<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\SupplierController;
use App\Http\Controllers\Dashboard\PurchaseOrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ShipmentsController;
use App\Http\Controllers\Dashboard\StockMovementController;
use App\Http\Controllers\Dashboard\StockSummaryController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['cek_login:admin,staff,manager'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::prefix('/supplier')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::post('/delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    Route::prefix('/purchase-order')->group(function () {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('po.index');
        Route::get('/create', [PurchaseOrderController::class, 'create'])->name('po.create');
        Route::post('/store', [PurchaseOrderController::class, 'store'])->name('po.store');
        Route::get('/edit/{id}', [PurchaseOrderController::class, 'edit'])->name('po.edit');
        Route::put('/update/{id}', [PurchaseOrderController::class, 'update'])->name('po.update');
    });

    Route::prefix('/persediaan')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/edit/{barang}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/update/{barang}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/delete/{barang}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::prefix('/shipments')->group(function () {
        Route::get('/', [ShipmentsController::class, 'index'])->name('shipments.index');
        Route::get('/create', [ShipmentsController::class, 'create'])->name('shipments.create');
        Route::post('/store', [ShipmentsController::class, 'store'])->name('shipments.store');
        Route::get('/edit/{shipment}', [ShipmentsController::class, 'edit'])->name('shipments.edit');
        Route::post('/update/{shipment}', [ShipmentsController::class, 'update'])->name('shipments.update');
        Route::post('/delete/{shipment}', [ShipmentsController::class, 'destroy'])->name('shipments.destroy');
        Route::get('/tracking', [ShipmentsController::class, 'allTracking'])->name('shipments.tracking');
    });

    Route::prefix('/stock-report')->group(function () {
        Route::get('list', [StockSummaryController::class, 'index'])->name('list');
        Route::get('report', [StockSummaryController::class, 'report'])->name('report');
    });

    Route::prefix('/stock')->group(function () {
        // 1. PERGERAKAN STOK (LOG)
        Route::get('/movements', [StockMovementController::class, 'index'])
            ->name('stock.movements.index');

        // 2. STOK MASUK
        Route::get('/in/create', [StockMovementController::class, 'createIn'])
            ->name('stock.in.create');
        Route::post('/in/store', [StockMovementController::class, 'storeIn'])
            ->name('stock.in.store');

        // 3. STOK KELUAR
        Route::get('/out/create', [StockMovementController::class, 'createOut'])
            ->name('stock.out.create');
        Route::post('/out/store', [StockMovementController::class, 'storeOut'])
            ->name('stock.out.store');
    });

});

Route::middleware(['cek_login:admin'])->prefix('dashboard/admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});