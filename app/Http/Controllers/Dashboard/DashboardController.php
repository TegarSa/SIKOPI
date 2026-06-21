<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Transaksi;

use Illuminate\Support\Facades\Response;
use PDF; 

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();

        $totalSimpanan = Simpanan::where('status_verifikasi', 'verified')
            ->sum('jumlah');

        $totalPinjamanAktif = Pinjaman::where('status', 'approved')
            ->count();

        $saldoKas = Transaksi::latest('id')
            ->value('saldo_setelah') ?? 0;

        $totalKategoriSimpanan = Simpanan::where('status_verifikasi', 'verified')
            ->sum('jumlah');

        $totalKategoriPinjaman = Pinjaman::where('status', 'approved')
            ->sum('jumlah_pinjaman');

        $totalKategoriAngsuran = Transaksi::where('kategori', 'angsuran')
            ->sum('jumlah');

        $grafikBulanan = Transaksi::selectRaw("
                MONTH(created_at) as bulan,
                SUM(CASE WHEN jenis='masuk' THEN jumlah ELSE 0 END) as masuk,
                SUM(CASE WHEN jenis='keluar' THEN jumlah ELSE 0 END) as keluar
            ")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $transaksiTerbaru = Transaksi::with('anggota')
            ->latest()
            ->limit(5)
            ->get();

        return view('backend.index', compact(
            'totalAnggota',
            'totalSimpanan',
            'totalPinjamanAktif',
            'saldoKas',
            'totalKategoriSimpanan',
            'totalKategoriPinjaman',
            'totalKategoriAngsuran',
            'grafikBulanan',
            'transaksiTerbaru'
        ));
    }

    // EXPORT PDF (LAPORAN RINGKAS)
    public function exportPdf()
    {
        $data = $this->getReportData();

        $pdf = PDF::loadView('backend.pdf', $data);

        return $pdf->download('laporan-koperasi-sikopi.pdf');
    }

    // EXPORT CSV (DATA TRANSAKSI)
    public function exportCsv()
    {
        $transaksi = Transaksi::with('anggota')->latest()->get();

        $filename = "data-transaksi-koperasi.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($transaksi) {
            $file = fopen('php://output', 'w');

            // header CSV
            fputcsv($file, [
                'Tanggal',
                'Anggota',
                'Kategori',
                'Jenis',
                'Jumlah',
                'Saldo Setelah'
            ]);

            foreach ($transaksi as $t) {
                fputcsv($file, [
                    $t->created_at->format('Y-m-d'),
                    $t->anggota->nama ?? '-',
                    $t->kategori,
                    $t->jenis,
                    $t->jumlah,
                    $t->saldo_setelah
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    // DATA GLOBAL LAPORAN (REUSE)
    private function getReportData()
    {
        return [
            'totalAnggota' => Anggota::count(),

            'totalSimpanan' => Simpanan::where('status_verifikasi', 'verified')
                ->sum('jumlah'),

            'totalPinjamanAktif' => Pinjaman::where('status', 'approved')
                ->count(),

            'saldoKas' => Transaksi::latest('id')
                ->value('saldo_setelah') ?? 0,

            'totalKategoriSimpanan' => Simpanan::where('status_verifikasi', 'verified')
                ->sum('jumlah'),

            'totalKategoriPinjaman' => Pinjaman::where('status', 'approved')
                ->sum('jumlah_pinjaman'),

            'totalKategoriAngsuran' => Transaksi::where('kategori', 'angsuran')
                ->sum('jumlah'),

            'transaksiTerbaru' => Transaksi::with('anggota')
                ->latest()
                ->limit(10)
                ->get(),
        ];
    }
}