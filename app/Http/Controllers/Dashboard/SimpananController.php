<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpananController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with('anggota')->latest()->get();

        return view('backend.simpanan.index', compact('simpanans'));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', 'aktif')->get();

        return view('backend.simpanan.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis' => 'required|in:pokok,wajib,sukarela',
            'jumlah' => 'required|numeric',
            'tgl_bayar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Simpanan::create([
            'anggota_id' => $validated['anggota_id'],
            'jenis' => $validated['jenis'],
            'jumlah' => $validated['jumlah'],
            'tgl_bayar' => $validated['tgl_bayar'],
            'status_verifikasi' => 'pending',
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()
            ->route('simpanan.index')
            ->with('success', 'Simpanan berhasil diajukan.');
    }

    public function edit($id)
    {
        $simpanan = Simpanan::findOrFail($id);

        if ($simpanan->status_verifikasi == 'verified') {
            return redirect()
                ->route('simpanan.index')
                ->with('error', 'Simpanan yang sudah diverifikasi tidak dapat diubah.');
        }

        $anggotas = Anggota::all();

        return view('backend.simpanan.edit', compact(
            'simpanan',
            'anggotas'
        ));
    }

    public function update(Request $request, $id)
    {
        $simpanan = Simpanan::findOrFail($id);

        if ($simpanan->status_verifikasi == 'verified') {
            return redirect()
                ->route('simpanan.index')
                ->with('error', 'Simpanan yang sudah diverifikasi tidak dapat diubah.');
        }

        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis' => 'required|in:pokok,wajib,sukarela',
            'jumlah' => 'required|numeric',
            'tgl_bayar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $simpanan->update($validated);

        return redirect()
            ->route('simpanan.index')
            ->with('success', 'Simpanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $simpanan->delete();

        return redirect()
            ->route('simpanan.index')
            ->with('success', 'Simpanan berhasil dihapus.');
    }

    public function komisarisIndex()
    {
        $simpanans = Simpanan::with('anggota')
            ->latest()
            ->get();

        return view(
            'backend.komisaris.simpanan.index',
            compact('simpanans')
        );
    }
}