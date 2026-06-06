<?php

namespace App\Http\Controllers\Dashboard\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Simpanan;
use App\Models\Transaksi;

class BendaharaSimpananController extends Controller
{
    public function index()
    {
        $simpanan = Simpanan::with('anggota')
            ->latest()
            ->get();

        return view('backend.bendahara.simpanan.index', compact('simpanan'));
    }

    public function approve($id)
    {
        DB::beginTransaction();

        try {

            $simpanan = Simpanan::findOrFail($id);

            if ($simpanan->status_verifikasi != 'pending') {
                return redirect()->back()
                    ->with('error', 'Data sudah diverifikasi.');
            }

            $simpanan->update([
                'status_verifikasi' => 'verified',
                'verified_by' => auth()->id(),
            ]);

            $saldoTerakhir = Transaksi::latest('id')->value('saldo_setelah') ?? 0;

            $saldoBaru = $saldoTerakhir + $simpanan->jumlah;

            Transaksi::create([
                'anggota_id'    => $simpanan->anggota_id,
                'jenis'         => 'masuk',
                'kategori'      => 'simpanan',
                'reference_id'  => $simpanan->id,
                'jumlah'        => $simpanan->jumlah,
                'saldo_setelah' => $saldoBaru,
                'keterangan'    => 'Simpanan ' . $simpanan->jenis,
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Simpanan berhasil diverifikasi.');

        } catch (\Exception $e) {

    DB::rollBack();

    dd($e->getMessage());
}
    }

    public function reject($id)
    {
        $simpanan = Simpanan::findOrFail($id);

        if ($simpanan->status_verifikasi != 'pending') {
            return redirect()->back()
                ->with('error', 'Data sudah diverifikasi.');
        }

        $simpanan->update([
            'status_verifikasi' => 'rejected',
            'verified_by' => auth()->id(),
        ]);

        return redirect()->back()
            ->with('success', 'Simpanan ditolak.');
    }
}