<?php

namespace App\Http\Controllers\Dashboard\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Transaksi;

class BendaharaAngsuranController extends Controller
{
    /**
     * List angsuran
     */
    public function index()
    {
        $angsurans = Angsuran::with([
            'anggota',
            'pinjaman'
        ])
        ->latest()
        ->get();

        return view(
            'backend.bendahara.angsuran.index',
            compact('angsurans')
        );
    }

    /**
     * Fitur Bendahara Konfirmasi Transfer Uang ke Anggota
     */
    public function konfirmasiTransfer($pinjamanId)
    {
        DB::beginTransaction();
        try {
            $pinjaman = Pinjaman::findOrFail($pinjamanId);

            if ($pinjaman->is_dicairkan == 1) {
                return redirect()->back()->with('error', 'Pinjaman ini sudah pernah dicairkan.');
            }

            $saldoTerakhir = Transaksi::latest('id')->value('saldo_setelah') ?? 0;
            if ($saldoTerakhir < $pinjaman->jumlah_pinjaman) {
                return redirect()->back()->with('error', 'Gagal cairkan! Saldo kas koperasi saat ini tidak mencukupi.');
            }

            $pinjaman->update([
                'is_dicairkan' => 1
            ]);

            $saldoBaru = $saldoTerakhir - $pinjaman->jumlah_pinjaman;
            Transaksi::create([
                'anggota_id'    => $pinjaman->anggota_id,
                'jenis'         => 'keluar',
                'kategori'      => 'pinjaman',
                'reference_id'  => $pinjaman->id,
                'jumlah'        => $pinjaman->jumlah_pinjaman,
                'saldo_setelah' => $saldoBaru,
                'keterangan'    => 'Pencairan Dana oleh Bendahara untuk Pinjaman ',
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Konfirmasi transfer berhasil disimpan. Kas koperasi resmi terpotong.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Bayar angsuran
     */
    public function bayar($id)
    {
        DB::beginTransaction();

        try {

            $angsuran = Angsuran::findOrFail($id);

            if ($angsuran->status_verifikasi != 'pending') {

                return redirect()->back()
                    ->with('error', 'Angsuran sudah diproses.');
            }

            $pinjaman = Pinjaman::findOrFail(
                $angsuran->pinjaman_id
            );

            /*
            |--------------------------------------------------------------------------
            | Verifikasi Angsuran
            |--------------------------------------------------------------------------
            */

            $angsuran->update([
                'status_verifikasi' => 'verified',
                'verified_by'       => auth()->id(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Sisa Pinjaman
            |--------------------------------------------------------------------------
            */

            $sisaBaru = $pinjaman->sisa_pinjaman - $angsuran->jumlah_bayar;

            if ($sisaBaru < 0) {
                $sisaBaru = 0;
            }

            $pinjaman->update([
                'sisa_pinjaman' => $sisaBaru,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Jika Lunas
            |--------------------------------------------------------------------------
            */

            if ($sisaBaru <= 0) {

                $pinjaman->update([
                    'status' => 'lunas'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Catat Transaksi
            |--------------------------------------------------------------------------
            */

            $saldoTerakhir = Transaksi::latest('id')
                ->value('saldo_setelah') ?? 0;

            $saldoBaru = $saldoTerakhir + $angsuran->jumlah_bayar;

            Transaksi::create([
                'anggota_id'    => $angsuran->anggota_id,
                'jenis'         => 'masuk',
                'kategori'      => 'angsuran',
                'reference_id'  => $angsuran->id,
                'jumlah'        => $angsuran->jumlah_bayar,
                'saldo_setelah' => $saldoBaru,
                'keterangan'    => 'Pembayaran Angsuran Ke-' . $angsuran->angsuran_ke,
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Pembayaran angsuran berhasil diverifikasi.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}