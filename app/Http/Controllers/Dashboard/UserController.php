<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Tampilkan daftar staff
    public function index()
    {
        $staffs = User::where('role', 'staff')->get();
        $totalStaffs = $staffs->count();
        return view('backend.users.index', compact('staffs'));
    }

    // Tampilkan form tambah staff
    public function create()
    {
        return view('backend.users.create');
    }

    // Simpan staff baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'institution' => 'nullable|string|max:255',
        ]);

        $staff = new User();
        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->password = Hash::make($validated['password']);
        $staff->role = 'staff';
        $staff->institution = $validated['institution'] ?? null;
        $staff->save();

        return redirect()->route('admin.users.index')->with('success', 'Staff berhasil ditambahkan');
    }

    // Tampilkan form edit staff
    public function edit($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('backend.users.edit', compact('staff'));
    }

    // Update data staff
    public function update(Request $request, $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$staff->id}",
            'password' => 'nullable|string|min:6',
            'institution' => 'nullable|string|max:255',
        ]);

        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->institution = $validated['institution'] ?? null;

        if ($request->filled('password')) {
            $staff->password = Hash::make($validated['password']);
        }

        $staff->save();

        return redirect()->route('admin.users.index')->with('success', 'Staff berhasil diupdate');
    }

    // Hapus staff
    public function destroy($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.users.index')->with('success', 'Staff berhasil dihapus');
    }
}
