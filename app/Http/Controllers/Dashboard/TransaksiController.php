<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;

        $query = Transaksi::with('anggota');

        if (!empty($kategori) && $kategori != 'semua') {
            $query->where('kategori', $kategori);
        }

        $transaksis = $query
            ->latest()
            ->get();

        $totalKas = Transaksi::latest('id')
            ->value('saldo_setelah') ?? 0;

        $totalMasuk = Transaksi::where('jenis', 'masuk')
            ->sum('jumlah');

        $totalKeluar = Transaksi::where('jenis', 'keluar')
            ->sum('jumlah');

        return view(
            'backend.transaksi.index',
            compact(
                'transaksis',
                'totalKas',
                'totalMasuk',
                'totalKeluar',
                'kategori'
            )
        );
    }

    public function summary()
    {
        $totalMasuk = Transaksi::where('jenis', 'masuk')->sum('jumlah');
        $totalKeluar = Transaksi::where('jenis', 'keluar')->sum('jumlah');

        $saldoAkhir = $totalMasuk - $totalKeluar;

        $perKategori = Transaksi::selectRaw('kategori, SUM(jumlah) as total')
            ->groupBy('kategori')
            ->get();

        $perBulan = Transaksi::selectRaw("
                MONTH(created_at) as bulan,
                SUM(CASE WHEN jenis='masuk' THEN jumlah ELSE 0 END) as masuk,
                SUM(CASE WHEN jenis='keluar' THEN jumlah ELSE 0 END) as keluar
            ")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return [
            'total_masuk' => $totalMasuk,
            'total_keluar' => $totalKeluar,
            'saldo_akhir' => $saldoAkhir,
            'per_kategori' => $perKategori,
            'per_bulan' => $perBulan,
        ];
    }

    public function bendaharaIndex()
    {
        $transaksi = Transaksi::with('anggota')
            ->latest()
            ->get();

        $summary = $this->summary();

        return view('backend.bendahara.transaksi.index', compact('transaksi', 'summary'));
    }

    public function komisarisIndex(Request $request)
    {
        $kategori = $request->kategori;

        $query = Transaksi::with('anggota');

        if (!empty($kategori) && $kategori != 'semua') {
            $query->where('kategori', $kategori);
        }

        $transaksis = $query
            ->latest()
            ->get();

        $totalKas = Transaksi::latest('id')
            ->value('saldo_setelah') ?? 0;

        $totalMasuk = Transaksi::where('jenis', 'masuk')
            ->sum('jumlah');

        $totalKeluar = Transaksi::where('jenis', 'keluar')
            ->sum('jumlah');

        return view(
            'backend.komisaris.transaksi.index',
            compact(
                'transaksis',
                'totalKas',
                'totalMasuk',
                'totalKeluar',
                'kategori'
            )
        );
    }
}