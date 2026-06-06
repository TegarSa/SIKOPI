<?php

namespace App\Http\Controllers\Dashboard\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use App\Models\Transaksi;
use Carbon\Carbon;

class BendaharaPinjamanController extends Controller
{
    public function index()
    {
        $pinjaman = Pinjaman::with('anggota')
            ->latest()
            ->get();

        $totalPinjamanAktif = $pinjaman
            ->where('status', 'approved')
            ->count();

        $totalAngsuran = Angsuran::count();

        $totalNilaiPinjaman = $pinjaman
            ->where('status', 'approved')
            ->sum('jumlah_pinjaman');

        return view(
            'backend.bendahara.pinjaman.index',
            compact(
                'pinjaman',
                'totalPinjamanAktif',
                'totalAngsuran',
                'totalNilaiPinjaman'
            )
        );
    }

    public function detail($id)
    {
        $pinjaman = Pinjaman::with('anggota')->findOrFail($id);

        $angsurans = Angsuran::with([
            'anggota',
            'pinjaman'
        ])
        ->where('pinjaman_id', $id)
        ->orderBy('angsuran_ke')
        ->get();

        return view(
            'backend.bendahara.angsuran.index',
            compact('pinjaman', 'angsurans')
        );
    }
}