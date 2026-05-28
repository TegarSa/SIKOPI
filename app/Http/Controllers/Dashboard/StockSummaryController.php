<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockSummaryController extends Controller
{
    public function index()
    {
        $products = Product::with('stockMovements')->get();

        $products->each(function($product) {
            $product->stock_in_total = $product->stockMovements()
                ->where('movement_type', 'in')
                ->sum('quantity');

            $product->stock_out_total = $product->stockMovements()
                ->where('movement_type', 'out')
                ->sum('quantity');

            $product->stock_akhir = $product->stock_in_total - $product->stock_out_total;
        });


        return view('backend.persediaan.daftarstok.index', compact('products'));
    }

    public function report()
    {
        $products = Product::all(); // cukup ambil semua produk


        foreach ($products as $product) {
            $in  = StockMovement::where('product_id', $product->id)
                    ->where('movement_type', 'IN')
                    ->sum('quantity');

            $out = StockMovement::where('product_id', $product->id)
                    ->where('movement_type', 'OUT')
                    ->sum('quantity');

            $product->stock = $in - $out;
            $product->status = $product->stock <= $product->min_stock ? 'Menipis' : 'Aman';
        }

        return view('backend.stock_movements.report_stok.index', compact('products'));
    }
}
