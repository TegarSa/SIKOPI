<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
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
            'institution' => 'required|string|max:255',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->institution = $validated['institution'];

        if ($request->hasFile('photo_profile')) {
            $file = $request->file('photo_profile');
            $filename = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // simpan langsung tanpa resize
            $file->move(public_path('assets/photo_profile'), $filename);

            // hapus foto lama
            if ($user->photo_profile && file_exists(public_path('assets/photo_profile/' . $user->photo_profile))) {
                @unlink(public_path('assets/photo_profile/' . $user->photo_profile));
            }

            $user->photo_profile = $filename;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
    }

}
