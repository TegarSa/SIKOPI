<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Transaksi;

class FrontController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count(); 

        $totalKas = Transaksi::latest('id')->value('saldo_setelah') ?? 0;

        $totalKategori = Transaksi::distinct('kategori')->count('kategori') ?? 0;

        return view('frontend.homepage', compact('totalAnggota', 'totalKas', 'totalKategori')); 
    }

    public function about()
    {
        return view('frontend.about');
    }
}