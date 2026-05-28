<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Product; // diganti dari Item
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with(['supplier', 'items.product']) // item diganti product
            ->orderByDesc('created_at')
            ->get();

        return view('backend.pengadaan.po.index', compact('purchaseOrders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all(); // diganti dari Item::all()

        return view('backend.pengadaan.po.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'product_id.*' => 'required', // diganti dari item_id.*
            'quantity.*' => 'required|numeric|min:1',
            'price.*' => 'required|numeric|min:1',
        ]);

        $po = PurchaseOrder::create([
            'supplier_id' => $request->supplier_id,
            'user_id' => auth()->id(),
            'po_number' => 'PO-' . time(),
            'po_date' => now(),
            'status' => $request->status ?? 'draft',
            'total_price' => 0,
        ]);


        $total = 0;

        foreach ($request->product_id as $index => $productId) {
            $qty = $request->quantity[$index];
            $price = $request->price[$index]; 
            $subTotal = $price; 

            PurchaseOrderItem::create([
                'po_id' => $po->id,
                'product_id' => $productId,
                'quantity' => $qty,
                'price' => $price / $qty, 
                'sub_total' => $subTotal,
            ]);
        }
        $total = $po->items->sum('sub_total'); 
        $po->update(['total_price' => $total]);


        $po->update(['total_price' => $total]);

        return redirect()->route('po.index')->with('success', 'Purchase Order berhasil dibuat');
    }

    public function edit($id)
    {
        $po = PurchaseOrder::with('items.product')->findOrFail($id); // item diganti product
        $suppliers = Supplier::all();
        $products = Product::all(); // diganti dari Item::all()

        return view('backend.pengadaan.po.edit', compact('po', 'suppliers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draft,approved,shipped,completed,canceled',
            'quantity.*' => 'required|numeric|min:1',
        ]);

        $po = PurchaseOrder::with('items.product')->findOrFail($id);

        $total = 0;

        foreach ($po->items as $index => $item) {
            $qty = $request->quantity[$index];
            $subTotal = $item->product->price * $qty; // harga asli produk
            $item->update([
                'quantity' => $qty,
                'sub_total' => $subTotal,
                'price' => $item->product->price, // pastikan tetap harga per unit
            ]);
        }
        
        $po->update([
            'status' => $request->status,
            'total_price' => $po->items->sum('sub_total'),
        ]);


        return redirect()->route('po.index')->with('success', 'Purchase Order berhasil diperbarui');
    }

}
