<?php

namespace App\Http\Controllers\Dashboard\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER (BULAN & TAHUN)
        |--------------------------------------------------------------------------
        */
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $transaksi = Transaksi::with('anggota')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RINGKASAN UTAMA
        |--------------------------------------------------------------------------
        */
        $totalMasuk = Transaksi::where('jenis', 'masuk')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('jumlah');

        $totalKeluar = Transaksi::where('jenis', 'keluar')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('jumlah');

        $saldo = $totalMasuk - $totalKeluar;

        /*
        |--------------------------------------------------------------------------
        | KATEGORI TRANSAKSI
        |--------------------------------------------------------------------------
        */
        $kategori = Transaksi::selectRaw('kategori, SUM(jumlah) as total')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('kategori')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | CASHFLOW BULANAN (1 TAHUN)
        |--------------------------------------------------------------------------
        */
        $cashflow = Transaksi::selectRaw("
                MONTH(created_at) as bulan,
                SUM(CASE WHEN jenis='masuk' THEN jumlah ELSE 0 END) as masuk,
                SUM(CASE WHEN jenis='keluar' THEN jumlah ELSE 0 END) as keluar
            ")
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view('backend.bendahara.laporan.index', [
            'transaksi'   => $transaksi,
            'totalMasuk'  => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldo'       => $saldo,
            'kategori'    => $kategori,
            'cashflow'    => $cashflow,
            'bulan'       => $bulan,
            'tahun'       => $tahun,
        ]);
    }
}