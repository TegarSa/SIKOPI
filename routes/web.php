<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AnggotaController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\SimpananController;
use App\Http\Controllers\Dashboard\PinjamanController;
use App\Http\Controllers\Dashboard\AngsuranController;
use App\Http\Controllers\Dashboard\TransaksiController;
use App\Http\Controllers\Dashboard\Ketua\KetuaPinjamanController;
use App\Http\Controllers\Dashboard\Bendahara\ShuController;
use App\Http\Controllers\Dashboard\Bendahara\LaporanKeuanganController;
use App\Http\Controllers\Dashboard\Bendahara\BendaharaSimpananController;
use App\Http\Controllers\Dashboard\Bendahara\BendaharaPinjamanController;
use App\Http\Controllers\Dashboard\Bendahara\BendaharaAngsuranController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/about', [FrontController::class, 'about'])->name('about');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['cek_login:admin,komisaris,sekretaris,bendahara,ketua'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/export/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');
    Route::get('/export/csv', [DashboardController::class, 'exportCsv'])->name('dashboard.export.csv');

    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::middleware(['cek_login:admin'])->prefix('dashboard/admin')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

});

Route::middleware(['cek_login:komisaris,ketua'])->prefix('dashboard/komisaris')->group(function () {
    
    Route::get('/anggota', [AnggotaController::class, 'komisarisIndex'])->name('komisaris.anggota.index');
    Route::get('/simpanan', [SimpananController::class, 'komisarisIndex'])->name('komisaris.simpanan.index');
    Route::get('/pinjaman', [PinjamanController::class, 'komisarisIndex'])->name('komisaris.pinjaman.index');
    Route::get('/pinjaman/{id}', [PinjamanController::class, 'komisarisDetail'])->name('komisaris.pinjaman.detail');
    Route::get('/transaksi', [TransaksiController::class, 'komisarisIndex'])->name('komisaris.transaksi.index');
    Route::get('/shu', [ShuController::class, 'komisarisIndex'])->name('komisaris.shu.index');
    Route::get('/shu/{id}', [ShuController::class, 'komisarisShow'])->name('komisaris.shu.show');

});

Route::middleware(['cek_login:ketua'])->prefix('dashboard/ketua')->group(function () {

    Route::get('/pinjaman', [KetuaPinjamanController::class, 'index'])->name('ketua.pinjaman.index');
    Route::get('/pinjaman/{id}', [KetuaPinjamanController::class, 'show'])->name('ketua.pinjaman.show');
    Route::post('/pinjaman/{id}/approve', [KetuaPinjamanController::class, 'approve'])->name('ketua.pinjaman.approve');
    Route::post('/pinjaman/{id}/reject', [KetuaPinjamanController::class, 'reject'])->name('ketua.pinjaman.reject');

});

Route::middleware(['cek_login:sekretaris'])->prefix('dashboard/sekretaris')->group(function () {

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::post('/anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    Route::post('/anggota/import', [AnggotaController::class, 'import'])->name('anggota.import');

    Route::get('/simpanan', [SimpananController::class, 'index'])->name('simpanan.index');
    Route::get('/simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
    Route::post('/simpanan/store', [SimpananController::class, 'store'])->name('simpanan.store');
    Route::get('/simpanan/edit/{id}', [SimpananController::class, 'edit'])->name('simpanan.edit');
    Route::put('/simpanan/update/{id}', [SimpananController::class, 'update'])->name('simpanan.update');
    Route::post('/simpanan/delete/{id}', [SimpananController::class, 'destroy'])->name('simpanan.destroy');

    Route::get('/pinjaman', [PinjamanController::class, 'index'])->name('pinjaman.index');
    Route::get('/pinjaman/create', [PinjamanController::class, 'create'])->name('pinjaman.create');
    Route::post('/pinjaman/store', [PinjamanController::class, 'store'])->name('pinjaman.store');
    Route::get('/pinjaman/edit/{id}', [PinjamanController::class, 'edit'])->name('pinjaman.edit');
    Route::put('/pinjaman/update/{id}', [PinjamanController::class, 'update'])->name('pinjaman.update');
    Route::post('/pinjaman/delete/{id}', [PinjamanController::class, 'destroy'])->name('pinjaman.destroy');

    Route::get('/pinjaman/detail/{id}',[PinjamanController::class, 'detail'])->name('pinjaman.detail');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

});

Route::middleware(['cek_login:bendahara'])->prefix('dashboard/bendahara')->group(function () {

    Route::get('/simpanan', [BendaharaSimpananController::class, 'index'])->name('bendahara.simpanan.index');
    Route::post('/simpanan/approve/{id}', [BendaharaSimpananController::class, 'approve'])->name('bendahara.simpanan.approve');
    Route::post('/simpanan/reject/{id}', [BendaharaSimpananController::class, 'reject'])->name('bendahara.simpanan.reject');

    Route::get('/pinjaman', [BendaharaPinjamanController::class, 'index'])->name('bendahara.pinjaman.index');
    Route::post('/pinjaman/{id}/cairkan', [BendaharaAngsuranController::class, 'konfirmasiTransfer'])->name('bendahara.pinjaman.cairkan');

    Route::get('/pinjaman/detail/{id}',[BendaharaPinjamanController::class, 'detail'])->name('bendahara.pinjaman.detail');
    Route::post('/angsuran/bayar/{id}', [BendaharaAngsuranController::class, 'bayar'])->name('bendahara.angsuran.bayar');

    Route::get('/transaksi', [TransaksiController::class, 'bendaharaIndex'])->name('bendahara.transaksi.index');

    Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])->name('bendahara.laporan.index');

    Route::get('/shu', [ShuController::class, 'index'])->name('shu.index');
    Route::get('/shu/create', [ShuController::class, 'create'])->name('shu.create');
    Route::post('/shu/store', [ShuController::class, 'store'])->name('shu.store');
    Route::get('/shu/detail/{id}', [ShuController::class, 'show'])->name('shu.show');
    Route::get('/shu/pdf/{id}', [ShuController::class, 'pdf'])->name('shu.pdf');
    Route::get('/bendahara/shu/{id}/csv', [ShuController::class, 'csv'])->name('shu.csv');

});