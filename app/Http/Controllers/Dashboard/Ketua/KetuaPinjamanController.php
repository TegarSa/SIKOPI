<?php

namespace App\Http\Controllers\Dashboard\Ketua;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Transaksi;

class KetuaPinjamanController extends Controller
{
    /**
     * Daftar pengajuan pinjaman
     */
    public function index()
    {
        $pinjaman = Pinjaman::with('anggota')
            ->latest()
            ->get();

        return view(
            'backend.ketua.pinjaman.index',
            compact('pinjaman')
        );
    }

    /**
     * Detail pinjaman
     */
    public function show($id)
    {
        $pinjaman = Pinjaman::with([
            'anggota',
            'angsuran'
        ])->findOrFail($id);

        return view('backend.ketua.pinjaman.show', compact(
            'pinjaman'
        ));
    }

    /**
     * Approve pinjaman
     */
    public function approve($id)
    {
        DB::beginTransaction();
        try {
            $pinjaman = Pinjaman::findOrFail($id);

            $saldoTerakhir = Transaksi::latest('id')->value('saldo_setelah') ?? 0;
            if ($saldoTerakhir < $pinjaman->jumlah_pinjaman) {
                return redirect()->back()->with('error', 'Saldo koperasi tidak mencukupi.');
            }

            if ($pinjaman->status != 'pending') {
                return redirect()->back()->with('error', 'Pinjaman sudah diverifikasi.');
            }

            $pinjaman->update([
                'status' => 'approved',
                'is_dicairkan' => 0, 
                'tgl_disetujui' => now(),
                'approved_by' => auth()->id(),
            ]);

            if (Angsuran::where('pinjaman_id', $pinjaman->id)->exists()) {
                return redirect()->back()->with('error', 'Angsuran sudah pernah dibuat.');
            }

            $tanggalMulai = Carbon::now();
            for ($i = 1; $i <= $pinjaman->tenor_bulan; $i++) {
                $jatuhTempo = $tanggalMulai->copy()->addMonthsNoOverflow($i);
                $sisaPinjamanBerjalan = $pinjaman->total_kewajiban - ($pinjaman->angsuran_perbulan * ($i - 1));

                Angsuran::create([
                    'pinjaman_id'       => $pinjaman->id,
                    'anggota_id'        => $pinjaman->anggota_id,
                    'angsuran_ke'       => $i,
                    'jumlah_bayar'      => $pinjaman->angsuran_perbulan,
                    'sisa_pinjaman'     => $sisaPinjamanBerjalan,
                    'tgl_bayar'         => $jatuhTempo->format('Y-m-d'),
                    'status_verifikasi' => 'pending',
                    'verified_by'       => null,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pinjaman disetujui ketua. Menunggu bendahara melakukan transfer pencairan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Reject pinjaman
     */
    public function reject($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status != 'pending') {
            return redirect()->back()
                ->with('error', 'Pinjaman sudah diverifikasi.');
        }

        $pinjaman->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        return redirect()->back()
            ->with('success', 'Pinjaman ditolak.');
    }
}
