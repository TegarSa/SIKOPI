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

    // Logika pembuatan pengajuan pinjaman
    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id'        => 'required|exists:anggotas,id',
            'jenis_pinjaman'    => 'required|in:konsumtif,darurat',
            'jumlah_pinjaman'   => 'required|numeric|min:1',
            'tenor_bulan'       => 'required|integer|min:1',
            'keterangan'        => 'nullable|string',
        ]);

        // Menentukan bunga tahunan dan batas maksimal tenor sesuai jenis pinjaman
        if ($validated['jenis_pinjaman'] === 'konsumtif') {
            $bungaTahunan = 6;   // 0,5% per bulan = 6% per tahun
            $maxTenor = 36;
        } else {
            $bungaTahunan = 24;  // 2% per bulan = 24% per tahun
            $maxTenor = 12;
        }

        // Validasi maksimal tenor
        if ($validated['tenor_bulan'] > $maxTenor) {
            return redirect()->back()->withInput()->with(
                'error',
                "Tenor maksimal untuk pinjaman {$validated['jenis_pinjaman']} adalah {$maxTenor} bulan."
            );
        }

        // Cek apakah anggota masih memiliki pinjaman aktif
        $pinjamanAktif = Pinjaman::where('anggota_id', $validated['anggota_id'])
            ->where('status', 'approved')
            ->where('sisa_pinjaman', '>', 0)
            ->exists();

        if ($pinjamanAktif) {
            return redirect()->back()->withInput()->with('error', 'Anggota masih memiliki pinjaman aktif.');
        }

        $jumlahPinjaman = $validated['jumlah_pinjaman'];
        $tenor = $validated['tenor_bulan'];

        // Menghitung bunga berdasarkan bunga tahunan
        $totalBunga = ($jumlahPinjaman * $bungaTahunan / 100) * ($tenor / 12);

        // Menghitung total yang harus dibayar
        $totalKewajiban = $jumlahPinjaman + $totalBunga;

        // Menghitung angsuran setiap bulan
        $angsuranPerbulan = $totalKewajiban / $tenor;

        Pinjaman::create([
            'anggota_id'         => $validated['anggota_id'],
            'jenis_pinjaman'     => $validated['jenis_pinjaman'],
            'jumlah_pinjaman'    => $jumlahPinjaman,
            'tenor_bulan'        => $tenor,
            'bunga_flat'         => $bungaTahunan, // Disimpan sebagai bunga tahunan (6% atau 24%)
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

    // Logika perubahan data pinjaman
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

        // Menentukan bunga tahunan dan batas maksimal tenor sesuai jenis pinjaman
        if ($validated['jenis_pinjaman'] === 'konsumtif') {
            $bungaTahunan = 6;   // 0,5% per bulan = 6% per tahun
            $maxTenor = 36;
        } else {
            $bungaTahunan = 24;  // 2% per bulan = 24% per tahun
            $maxTenor = 12;
        }

        // Validasi maksimal tenor
        if ($validated['tenor_bulan'] > $maxTenor) {
            return redirect()->back()->withInput()->with(
                'error',
                "Tenor maksimal untuk pinjaman {$validated['jenis_pinjaman']} adalah {$maxTenor} bulan."
            );
        }

        // Cek apakah anggota masih memiliki pinjaman aktif selain data yang sedang diedit
        $pinjamanAktif = Pinjaman::where('anggota_id', $validated['anggota_id'])
            ->where('status', 'approved')
            ->where('sisa_pinjaman', '>', 0)
            ->where('id', '!=', $id)
            ->exists();

        if ($pinjamanAktif) {
            return redirect()->back()->withInput()->with('error', 'Anggota masih memiliki pinjaman aktif.');
        }

        $jumlahPinjaman = $validated['jumlah_pinjaman'];
        $tenor = $validated['tenor_bulan'];

        // Menghitung bunga berdasarkan bunga tahunan
        $totalBunga = ($jumlahPinjaman * $bungaTahunan / 100) * ($tenor / 12);

        // Menghitung total yang harus dibayar
        $totalKewajiban = $jumlahPinjaman + $totalBunga;

        // Menghitung angsuran setiap bulan
        $angsuranPerbulan = $totalKewajiban / $tenor;

        $pinjaman->update([
            'anggota_id'         => $validated['anggota_id'],
            'jenis_pinjaman'     => $validated['jenis_pinjaman'],
            'jumlah_pinjaman'    => $jumlahPinjaman,
            'tenor_bulan'        => $tenor,
            'bunga_flat'         => $bungaTahunan, // Disimpan sebagai bunga tahunan (6% atau 24%)
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