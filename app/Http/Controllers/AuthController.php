<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        $messages = [
            'required' => 'Semua field wajib diisi dan diselesaikan.',
        ];

        // --- ATTRIBUTES LAMA (TURNSTILE) ---
        // $attributes = [
        //     'username' => 'username',
        //     'password' => 'password',
        //     'cf-turnstile-response' => 'verifikasi keamanan',
        // ];

        $attributes = [
            'username'     => 'username',
            'password'     => 'password',
            'captcha_code' => 'verifikasi keamanan',
        ];

        // --- VALIDASI LAMA (TURNSTILE) ---
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required',
        //     'password' => 'required',
        //     'cf-turnstile-response' => 'required',
        // ], $messages, $attributes);

        $validator = Validator::make($request->all(), [
            'username'     => 'required',
            'password'     => 'required',
            'captcha_code' => 'required',
        ], $messages, $attributes);

        if ($validator->fails()) {
            $failedFieldsCount = count($validator->failed());

            if ($failedFieldsCount >= 2) {
                return back()->withErrors(['all' => 'Semua field wajib diisi dan diselesaikan.'])->withInput();
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        $throttleKey = Str::transliterate(Str::lower($request->input('username')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'auth' => "Terlalu banyak percobaan login. Silakan coba lagi dalam $seconds detik."
                ]);
        }

        // ==========================================
        // VERIFIKASI CAPTCHA ANGKA ACAK (CUSTOM)
        // ==========================================
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $sessionCaptcha = $_SESSION['custom_captcha'] ?? null;
        $userCaptcha    = strtolower(trim($request->input('captcha_code')));

        if (!$sessionCaptcha || $userCaptcha !== $sessionCaptcha) {
            unset($_SESSION['custom_captcha']);

            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'captcha' => 'Kode verifikasi keamanan (CAPTCHA) salah. Silakan coba lagi.'
                ]);
        }

        // Hapus session captcha setelah berhasil agar tidak bisa dipakai ulang
        unset($_SESSION['custom_captcha']);

        // ==========================================
        // VERIFIKASI LAMA (CLOUDFLARE TURNSTILE)
        // ==========================================
        // $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
        //     'secret'   => env('TURNSTILE_SECRET_KEY'),
        //     'response' => $request->input('cf-turnstile-response'),
        //     'remoteip' => $request->ip(),
        // ]);
        //
        // $captchaResult = $response->json();
        //
        // if (!$captchaResult['success']) {
        //     return back()
        //         ->withInput($request->only('username'))
        //         ->withErrors([
        //             'captcha' => 'Verifikasi keamanan gagal atau kadaluwarsa. Silakan coba lagi.'
        //         ]);
        // }

        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->status != 'aktif') {
                Auth::logout();
                return back()->withErrors([
                    'status' => 'Akun Anda tidak aktif. Silakan hubungi admin.'
                ]);
            }

            RateLimiter::clear($throttleKey);

            return redirect()->route('dashboard');
        }

        RateLimiter::hit($throttleKey, 60);

        $attemptsLeft = RateLimiter::retriesLeft($throttleKey, 5);

        return back()
            ->withInput($request->only('username'))
            ->withErrors([
                'auth' => "Username atau password salah. Sisa percobaan: $attemptsLeft kali.",
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
            $photoName = time().'_'.$file->getClientOriginalName();

            $destination = $_SERVER['DOCUMENT_ROOT'].'/assets/photo_profile';

            if (!file_exists($destination)) {
                mkdir($destination, 0775, true);
            }

            if ($user->photo_profile && file_exists($destination.'/'.$user->photo_profile)) {
                unlink($destination.'/'.$user->photo_profile);
            }

            $file->move($destination, $photoName);

            $user->photo_profile = $photoName;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }
}