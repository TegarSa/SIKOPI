<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentTrackingLog;
use App\Models\Product;
use Illuminate\Support\Str;

class ShipmentsController extends Controller
{
    public function index()
    {
        $shipments = Shipment::latest()->with('product')->get();
        return view('backend.shipments.index', compact('shipments'));
    }

    public function create()
    {
        $products = Product::all();
        return view('backend.shipments.create', compact('products'));
    }

    // Menampilkan semua tracking log
    public function allTracking()
    {
        $logs = ShipmentTrackingLog::with('shipment')
            ->orderBy('logged_at', 'desc')
            ->get();

        $shipment = null; // tidak ada shipment spesifik
        return view('backend.shipments.tracking', compact('logs', 'shipment'));
    }

    // Menampilkan tracking log untuk shipment tertentu
    public function tracking($id)
    {
        $shipment = Shipment::findOrFail($id);

        $logs = ShipmentTrackingLog::where('shipment_id', $id)
                    ->orderBy('logged_at', 'desc')
                    ->get();

        return view('backend.shipments.tracking', compact('shipment', 'logs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipment_date'   => 'required|date',
            'destination'     => 'required|string|max:255',
            'inventory_type'  => 'required|in:Masuk,Keluar',
            'product_id'      => 'required|exists:products,id',
            'quantity'        => 'required|integer|min:1',
            'city'            => 'required|string|max:100',
            'armada'          => 'required|string|max:100',
            'notes'           => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi stok jika keluar
        if ($request->inventory_type === 'Keluar' && $product->stok_akhir < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi'])->withInput();
        }

        // Generate nomor pengiriman unik
        $shipmentNumber = 'SHP-' . strtoupper(Str::random(8));

        // Simpan shipment dan ambil instance
        $shipment = Shipment::create([
            'shipment_number' => $shipmentNumber,
            'shipment_date'   => $request->shipment_date,
            'destination'     => $request->destination,
            'inventory_type'  => $request->inventory_type,
            'product_id'      => $product->id,
            'product_name'    => $product->nama_produk,
            'quantity'        => $request->quantity,
            'city'            => $request->city,
            'armada'          => $request->armada,
            'status'          => 'on_delivery',
            'notes'           => $request->notes,
        ]);

        // Tambahkan tracking log otomatis
        ShipmentTrackingLog::create([
            'shipment_id' => $shipment->id,
            'status'      => 'on_delivery', // status awal
            'description' => 'Shipment dibuat dan siap dikirim',
            'logged_at'   => now(),
        ]);

        // Update stok produk
        if ($request->inventory_type === 'Masuk') {
            $product->stok_akhir += $request->quantity;
        } else {
            $product->stok_akhir -= $request->quantity;
        }
        $product->save();

        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil ditambahkan');
    }

    public function edit(Shipment $shipment)
    {
        $products = Product::all();
        return view('backend.shipments.edit', compact('shipment', 'products'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'shipment_date'   => 'required|date',
            'destination'     => 'required|string|max:255',
            'inventory_type'  => 'required|in:Masuk,Keluar',
            'product_id'      => 'required|exists:products,id',
            'quantity'        => 'required|integer|min:1',
            'city'            => 'required|string|max:100',
            'armada'          => 'required|string|max:100',
            'status'          => 'required|string',
            'notes'           => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Kembalikan stok lama
        if ($shipment->inventory_type === 'Masuk') {
            $product->stok_akhir -= $shipment->quantity;
        } else {
            $product->stok_akhir += $shipment->quantity;
        }

        // Validasi stok baru jika keluar
        if ($request->inventory_type === 'Keluar' && $product->stok_akhir < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi'])->withInput();
        }

        // Update stok baru
        if ($request->inventory_type === 'Masuk') {
            $product->stok_akhir += $request->quantity;
        } else {
            $product->stok_akhir -= $request->quantity;
        }
        $product->save();

        // Update shipment
        $shipment->update([
            'shipment_date'   => $request->shipment_date,
            'destination'     => $request->destination,
            'inventory_type'  => $request->inventory_type,
            'product_id'      => $product->id,
            'product_name'    => $product->nama_produk,
            'quantity'        => $request->quantity,
            'city'            => $request->city,
            'armada'          => $request->armada,
            'status'          => $request->status,
            'notes'           => $request->notes,
        ]);

        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil diperbarui');
    }

    public function destroy(Shipment $shipment)
    {
        $product = Product::find($shipment->product_id);
        if ($product) {
            if ($shipment->inventory_type === 'Masuk') {
                $product->stok_akhir -= $shipment->quantity;
            } else {
                $product->stok_akhir += $shipment->quantity;
            }
            $product->save();
        }

        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil dihapus');
    }
}
