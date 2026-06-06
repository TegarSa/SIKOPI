<?php

namespace App\Http\Controllers\Dashboard\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Shu;
use App\Models\ShuDetail;
use App\Models\Transaksi;
use App\Models\Anggota;
use PDF;

class ShuController extends Controller
{
    /**
     * INDEX SHU
     */
    public function index()
    {
        $shu = Shu::with('details.anggota')
            ->latest()
            ->get();

        return view('backend.bendahara.shu.index', compact('shu'));
    }

    /**
     * FORM GENERATE SHU
     */
    public function create()
    {
        return view('backend.bendahara.shu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_awal'   => 'required|date',
            'periode_akhir'  => 'required|date',
            // 'persentase_shu' dihapus karena sudah otomatis
        ]);

        $cek = Shu::where('periode_awal', $request->periode_awal)
            ->where('periode_akhir', $request->periode_akhir)
            ->exists();

        if ($cek) {
            return back()->with('error', 'SHU periode tersebut sudah pernah dibuat.');
        }

        DB::beginTransaction();

        try {
            // 1. Ambil total simpanan yang masuk
            $totalSimpanan = Transaksi::whereBetween('created_at', [
                $request->periode_awal,
                $request->periode_akhir
            ])
            ->where('kategori', 'simpanan')
            ->where('jenis', 'masuk')
            ->sum('jumlah');

            // 2. Ambil total bunga pinjaman (Pendapatan Riil dari Jasa)
            $totalBungaPinjaman = \App\Models\Pinjaman::whereBetween('tgl_disetujui', [
                $request->periode_awal,
                $request->periode_akhir
            ])
            ->where('status', 'approved')
            ->sum(DB::raw('total_kewajiban - jumlah_pinjaman'));

            // 3. Hitung Alokasi SHU sesuai Aturan Otomatis
            $shuSimpanan = $totalSimpanan * 0.10; // 10% dari simpanan
            $shuPinjaman = $totalBungaPinjaman * 0.50; // 50% dari bunga pinjaman

            $totalDibagikan = $shuSimpanan + $shuPinjaman;

            // Logika representasi Total Laba/Pendapatan Kotor yang diolah:
            // Agar logis, Total Laba mencerminkan nilai total sebelum dikalikan rate masing-masing
            $totalLabaBruto = $totalSimpanan + $totalBungaPinjaman; 

            // Hitung rata-rata persentase realisasi SHU untuk disimpan ke database (opsional untuk tampilan tabel)
            $persentaseEfektif = $totalLabaBruto > 0 ? ($totalDibagikan / $totalLabaBruto) * 100 : 0;

            // Simpan data master SHU
            $shu = Shu::create([
                'periode_awal'    => $request->periode_awal,
                'periode_akhir'   => $request->periode_akhir,
                'total_laba'      => $totalLabaBruto, // Sekarang nilainya pasti lebih besar dari yang dibagikan
                'persentase_shu'  => round($persentaseEfektif, 2), // Otomatis terisi persentase riilnya
                'total_dibagikan' => $totalDibagikan,
                'created_by'      => auth()->id(),
            ]);

            $anggotas = Anggota::all();

            foreach ($anggotas as $anggota) {
                // total simpanan per anggota
                $simpananAnggota = Transaksi::where('anggota_id', $anggota->id)
                    ->whereBetween('created_at', [$request->periode_awal, $request->periode_akhir])
                    ->where('kategori', 'simpanan')
                    ->where('jenis', 'masuk')
                    ->sum('jumlah');

                // total bunga pinjaman per anggota
                $bungaPinjamanAnggota = \App\Models\Pinjaman::where('anggota_id', $anggota->id)
                    ->whereBetween('tgl_disetujui', [$request->periode_awal, $request->periode_akhir])
                    ->where('status', 'approved')
                    ->sum(DB::raw('total_kewajiban - jumlah_pinjaman'));

                // Pembagian proporsional
                $bagianSimpanan = $totalSimpanan > 0 ? ($simpananAnggota / $totalSimpanan) * $shuSimpanan : 0;
                $bagianPinjaman = $totalBungaPinjaman > 0 ? ($bungaPinjamanAnggota / $totalBungaPinjaman) * $shuPinjaman : 0;

                $jumlahShu = $bagianSimpanan + $bagianPinjaman;

                ShuDetail::create([
                    'shu_id'      => $shu->id,
                    'anggota_id'  => $anggota->id,
                    'jumlah_shu'  => $jumlahShu,
                ]);
            }

            DB::commit();
            return redirect()->route('shu.index')->with('success', 'SHU berhasil digenerate otomatis.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * DETAIL SHU
     */
    public function show($id)
    {
        $shu = Shu::with('details.anggota')
            ->findOrFail($id);

        return view('backend.bendahara.shu.show', compact('shu'));
    }

    public function pdf($id)
    {
        $shu = Shu::with('details.anggota')->findOrFail($id);

        $pdf = PDF::loadView('backend.bendahara.shu.pdf', compact('shu'));

        return $pdf->download('laporan-shu-'.$shu->id.'.pdf');
    }

    public function komisarisIndex()
    {
        $shu = Shu::with('details.anggota')
            ->latest()
            ->get();

        return view(
            'backend.komisaris.shu.index',
            compact('shu')
        );
    }

    public function komisarisShow($id)
    {
        $shu = Shu::with('details.anggota')
            ->findOrFail($id);

        return view(
            'backend.komisaris.shu.show',
            compact('shu')
        );
    }

    public function csv($id)
    {
        $shu = Shu::with('details.anggota')->findOrFail($id);
        
        // Tentukan nama file CSV
        $fileName = 'laporan-shu-' . $shu->id . '-' . date('Ymd-His') . '.csv';
        
        // Header HTTP untuk memaksa browser mengunduh file
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Proses streaming response menggunakan callback agar hemat memori server
        $callback = function() use($shu) {
            $file = fopen('php://output', 'w');
            
            // 1. Tulis Metadata/Judul SHU di baris atas CSV
            fputcsv($file, ['LAPORAN DETAIL SISA HASIL USAHA (SHU)']);
            fputcsv($file, ['Periode', \Carbon\Carbon::parse($shu->periode_awal)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($shu->periode_akhir)->format('d M Y')]);
            fputcsv($file, ['Total Laba', $shu->total_laba]);
            fputcsv($file, ['Persentase SHU', $shu->persentase_shu . '%']);
            fputcsv($file, ['Total Dibagikan', $shu->total_dibagikan]);
            fputcsv($file, []); // Baris kosong pembatas
            
            // 2. Tulis Header Tabel Data Utama
            fputcsv($file, ['No', 'Nama Anggota', 'SHU Diterima']);

            // 3. Looping baris isi data detail anggota
            foreach ($shu->details as $index => $detail) {
                fputcsv($file, [
                    $index + 1,
                    $detail->anggota->nama ?? '-',
                    $detail->jumlah_shu
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}