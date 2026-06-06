<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar anggota
     */
    public function index()
    {
        $anggotas = Anggota::latest()->get();

        return view('backend.anggotas.index', compact('anggotas'));
    }

    /**
     * Menampilkan form tambah anggota
     */
    public function create()
    {
        return view('backend.anggotas.create');
    }

    /**
     * Menyimpan anggota baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_anggota' => 'required|string|max:255|unique:anggotas,no_anggota',
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'tgl_masuk' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Anggota::create($validated);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit anggota
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('backend.anggotas.edit', compact('anggota'));
    }

    /**
     * Update anggota
     */
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validated = $request->validate([
            'no_anggota' => 'required|string|max:255|unique:anggotas,no_anggota,' . $anggota->id,
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'tgl_masuk' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $anggota->update($validated);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Menghapus anggota
     */
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }

     // IMPORT CSV FULL
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();

        $data = array_map('str_getcsv', file($path));

        // Hapus header CSV
        $header = array_shift($data);

        DB::beginTransaction();

        try {
            foreach ($data as $row) {

                // pastikan tidak kosong
                if (!isset($row[0])) continue;

                Anggota::updateOrCreate(
                    [
                        'no_anggota' => $row[0],
                    ],
                    [
                        'nama'        => $row[1] ?? null,
                        'nip'         => $row[2] ?? null,
                        'jabatan'     => $row[3] ?? null,
                        'unit_kerja'  => $row[4] ?? null,
                        'no_hp'       => $row[5] ?? null,
                        'alamat'      => $row[6] ?? null,
                        'tgl_masuk'   => isset($row[7]) ? Carbon::parse($row[7]) : null,
                        'status'      => $row[8] ?? 'aktif',
                    ]
                );
            }

            DB::commit();

            return redirect()
                ->route('anggota.index')
                ->with('success', 'Import CSV berhasil');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()
                ->route('anggota.index')
                ->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function komisarisIndex()
    {
        $anggotas = Anggota::latest()->get();

        return view(
            'backend.komisaris.anggota.index',
            compact('anggotas')
        );
    }
}