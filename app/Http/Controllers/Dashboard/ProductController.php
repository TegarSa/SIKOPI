<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::withSum([
            'stockMovements as stock' => function ($q) {
                $q->select(DB::raw("
                    SUM(
                        CASE
                            WHEN movement_type = 'IN' THEN quantity
                            WHEN movement_type = 'OUT' THEN -quantity
                            ELSE 0
                        END
                    )
                "));
            }
        ], 'quantity')
        ->orderBy('name')
        ->get();

        return view('backend.persediaan.products.index', compact('products'));
    }
    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('backend.persediaan.products.create');
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'sku'        => 'required|string|max:100|unique:products,sku',
            'category'   => 'nullable|string|max:100',
            'unit'       => 'required|string|max:50',
            'price'      => 'required|numeric|min:0',
            'min_stock'  => 'nullable|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('backend.persediaan.products.edit', compact('product'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'sku'        => 'required|string|max:100|unique:products,sku,' . $product->id,
            'category'   => 'nullable|string|max:100',
            'unit'       => 'required|string|max:50',
            'price'      => 'required|numeric|min:0',
            'min_stock'  => 'nullable|integer|min:0',
        ]);

        $product->update($request->all());

        return redirect()
            ->route('.products.index')
            ->with('success', 'Product berhasil diperbarui');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil dihapus');
    }
}
