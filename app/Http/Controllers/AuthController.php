<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->status != 'aktif') {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun tidak aktif.'
                ]);
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('backend.dashboard', compact('user'));
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('backend.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];

        if ($request->hasFile('photo_profile')) {

            $file = $request->file('photo_profile');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('assets/photo_profile'), $filename);

            if ($user->photo_profile && file_exists(public_path('assets/photo_profile/' . $user->photo_profile))) {

                @unlink(public_path('assets/photo_profile/' . $user->photo_profile));
            }

            $user->photo_profile = $filename;
        }

        if ($request->filled('password')) {

            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }
}