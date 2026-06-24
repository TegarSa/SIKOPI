<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('backend.users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah pengguna
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Menyimpan pengguna baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:6',
            'role'          => 'required|in:admin,komisaris,ketua,sekretaris,bendahara',
            'status'        => 'required|in:aktif,nonaktif',
            'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoName = null;

        if ($request->hasFile('photo_profile')) {

            $file = $request->file('photo_profile');
            $photoName = time() . '_' . $file->getClientOriginalName();

            $destination = $_SERVER['DOCUMENT_ROOT'] . '/assets/photo_profile';

            if (!file_exists($destination)) {
                mkdir($destination, 0775, true);
            }

            $file->move($destination, $photoName);
        }

        User::create([
            'name'          => $validated['name'],
            'username' => $validated['username'],
            'email'         => $validated['email'],
            'password'      => Hash::make($validated['password']),
            'role'          => $validated['role'],
            'status'        => $validated['status'],
            'photo_profile' => $photoName,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pengguna
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update pengguna
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'password'      => 'nullable|string|min:6',
            'role' => 'required|in:admin,komisaris,ketua,sekretaris,bendahara',
            'status'        => 'required|in:aktif,nonaktif',
            'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo_profile')) {

            $file = $request->file('photo_profile');
            $photoName = time() . '_' . $file->getClientOriginalName();

            $destination = $_SERVER['DOCUMENT_ROOT'] . '/assets/photo_profile';

            if (!file_exists($destination)) {
                mkdir($destination, 0775, true);
            }

            // delete old file
            if ($user->photo_profile && file_exists($destination . '/' . $user->photo_profile)) {
                unlink($destination . '/' . $user->photo_profile);
            }

            // move file
            $file->move($destination, $photoName);

            $user->photo_profile = $photoName;
        }


        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->status = $validated['status'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (
            $user->photo_profile &&
            file_exists(
                public_path(
                    'assets/photo_profile/' .
                    $user->photo_profile
                )
            )
        ) {
            unlink(
                public_path(
                    'assets/photo_profile/' .
                    $user->photo_profile
                )
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}