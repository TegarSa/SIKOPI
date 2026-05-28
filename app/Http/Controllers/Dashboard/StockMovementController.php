<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockMovementController extends Controller
{
    /* =====================================================
     | 1. PERGERAKAN STOK (LOG / RIWAYAT)
     ===================================================== */
    public function index()
    {
        $movements = StockMovement::with('product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.stock_movements.index', compact('movements'));
    }

    /* =====================================================
     | 2. STOK MASUK
     ===================================================== */
    public function createIn()
    {
        $products = Product::orderBy('name')->get();

        return view('backend.stock_movements.in.create', compact('products'));
    }

    public function storeIn(Request $request)
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1',
            'description'  => 'nullable|string',
        ]);

        StockMovement::create([
            'product_id'    => $request->product_id,
            'movement_type' => 'IN',
            'reference_type'=> 'MANUAL',
            'quantity'      => $request->quantity,
            'description'   => $request->description,
        ]);

        return redirect()
            ->route('stock.movements.index')
            ->with('success', 'Stok berhasil ditambahkan');
    }

    /* =====================================================
     | 3. STOK KELUAR
     ===================================================== */
    public function createOut()
    {
        $products = Product::orderBy('name')->get();

        return view('backend.stock_movements.out.create', compact('products'));
    }

    public function storeOut(Request $request)
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1',
            'description'  => 'nullable|string',
        ]);

        StockMovement::create([
            'product_id'    => $request->product_id,
            'movement_type' => 'OUT',
            'reference_type'=> 'MANUAL',
            'quantity'      => $request->quantity,
            'description'   => $request->description,
        ]);

        return redirect()
            ->route('stock.movements.index')
            ->with('success', 'Stok berhasil dikurangi');
    }
}
