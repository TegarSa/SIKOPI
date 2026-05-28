<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderByDesc('created_at')->get();
        return view('backend.pengadaan.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('backend.pengadaan.supplier.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.pengadaan.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus');
    }

}
