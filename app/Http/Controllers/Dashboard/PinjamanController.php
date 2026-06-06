<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjamans = Pinjaman::with('anggota')
            ->latest()
            ->get();

        return view('backend.pinjaman.index', compact('pinjamans'));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', 'aktif')->get();

        return view('backend.pinjaman.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id'        => 'required|exists:anggotas,id',
            'jenis_pinjaman'    => 'required|in:konsumtif,darurat',
            'jumlah_pinjaman'   => 'required|numeric|min:1',
            'tenor_bulan'       => 'required|integer|min:1',
            'keterangan'        => 'nullable|string',
        ]);

        // Atur aturan batas maksimal tenor dan rate bunga secara mutlak di backend
        if ($validated['jenis_pinjaman'] === 'konsumtif') {
            $bunga = 6;
            $maxTenor = 36;
        } else {
            $bunga = 2;
            $maxTenor = 12;
        }

        // Validasi batasan tenor sesuai aturan jenis pinjaman
        if ($validated['tenor_bulan'] > $maxTenor) {
            return redirect()->back()->withInput()->with('error', "Tenor maksimal untuk pinjaman {$validated['jenis_pinjaman']} adalah {$maxTenor} bulan.");
        }

        $pinjamanAktif = Pinjaman::where('anggota_id', $validated['anggota_id'])
            ->where('status', 'approved')
            ->where('sisa_pinjaman', '>', 0)
            ->exists();

        if ($pinjamanAktif) {
            return redirect()->back()->withInput()->with('error', 'Anggota masih memiliki pinjaman aktif.');
        }

        $jumlahPinjaman = $validated['jumlah_pinjaman'];
        $tenor          = $validated['tenor_bulan'];

        // Rumus bunga flat tahunan/periodik sesuai code awal kamu
        $totalBunga = ($jumlahPinjaman * $bunga / 100) * ($tenor / 12);
        $totalKewajiban = $jumlahPinjaman + $totalBunga;
        $angsuranPerbulan = $totalKewajiban / $tenor;

        Pinjaman::create([
            'anggota_id'         => $validated['anggota_id'],
            'jenis_pinjaman'     => $validated['jenis_pinjaman'],
            'jumlah_pinjaman'    => $jumlahPinjaman,
            'tenor_bulan'        => $tenor,
            'bunga_flat'         => $bunga, // Otomatis tersimpan 6 atau 2
            'total_kewajiban'    => $totalKewajiban,
            'angsuran_perbulan'  => $angsuranPerbulan,
            'sisa_pinjaman'      => $totalKewajiban,
            'status'             => 'pending',
            'tgl_pengajuan'      => now(),
            'keterangan'         => $validated['keterangan'] ?? null,
        ]);

        return redirect()->route('pinjaman.index')->with('success', 'Pengajuan pinjaman berhasil dibuat.');
    }

    public function edit($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $anggotas = Anggota::where('status', 'aktif')->get();

        return view('backend.pinjaman.edit', compact('pinjaman', 'anggotas'));
    }

    public function update(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $validated = $request->validate([
            'anggota_id'        => 'required|exists:anggotas,id',
            'jenis_pinjaman'    => 'required|in:konsumtif,darurat',
            'jumlah_pinjaman'   => 'required|numeric|min:1',
            'tenor_bulan'       => 'required|integer|min:1',
            'keterangan'        => 'nullable|string',
        ]);

        if ($validated['jenis_pinjaman'] === 'konsumtif') {
            $bunga = 6;
            $maxTenor = 36;
        } else {
            $bunga = 2;
            $maxTenor = 12;
        }

        if ($validated['tenor_bulan'] > $maxTenor) {
            return redirect()->back()->withInput()->with('error', "Tenor maksimal untuk pinjaman {$validated['jenis_pinjaman']} adalah {$maxTenor} bulan.");
        }

        $pinjamanAktif = Pinjaman::where('anggota_id', $validated['anggota_id'])
            ->where('status', 'approved')
            ->where('sisa_pinjaman', '>', 0)
            ->where('id', '!=', $id)
            ->exists();

        if ($pinjamanAktif) {
            return redirect()->back()->withInput()->with('error', 'Anggota masih memiliki pinjaman aktif.');
        }

        $jumlahPinjaman = $validated['jumlah_pinjaman'];
        $tenor          = $validated['tenor_bulan'];

        $totalBunga = ($jumlahPinjaman * $bunga / 100) * ($tenor / 12);
        $totalKewajiban = $jumlahPinjaman + $totalBunga;
        $angsuranPerbulan = $totalKewajiban / $tenor;

        $pinjaman->update([
            'anggota_id'         => $validated['anggota_id'],
            'jenis_pinjaman'     => $validated['jenis_pinjaman'],
            'jumlah_pinjaman'    => $jumlahPinjaman,
            'tenor_bulan'        => $tenor,
            'bunga_flat'         => $bunga,
            'total_kewajiban'    => $totalKewajiban,
            'angsuran_perbulan'  => $angsuranPerbulan,
            'sisa_pinjaman'      => $totalKewajiban,
            'keterangan'         => $validated['keterangan'] ?? null,
        ]);

        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status != 'pending') {
            return redirect()
                ->back()
                ->with('error', 'Pinjaman yang sudah diverifikasi tidak dapat dihapus.');
        }

        $pinjaman->delete();

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Pinjaman berhasil dihapus.');
    }

    public function detail($id)
    {
        $pinjaman = Pinjaman::with([
            'anggota',
            'angsuran'
        ])->findOrFail($id);

        if ($pinjaman->status != 'approved') {

            return redirect()
                ->route('pinjaman.index')
                ->with(
                    'error',
                    'Pinjaman belum disetujui ketua.'
                );
        }

        return view(
            'backend.angsuran.index',
            compact('pinjaman')
        );
    }

    public function komisarisIndex()
    {
        $pinjaman = Pinjaman::with('anggota')
            ->latest()
            ->get();

        return view(
            'backend.komisaris.pinjaman.index',
            compact('pinjaman')
        );
    }

    public function komisarisDetail($id)
    {
        $pinjaman = Pinjaman::with([
            'anggota',
            'angsuran'
        ])->findOrFail($id);

        return view(
            'backend.komisaris.pinjaman.show',
            compact('pinjaman')
        );
    }
}