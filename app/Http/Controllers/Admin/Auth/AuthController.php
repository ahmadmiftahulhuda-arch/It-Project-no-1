<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Tampilkan form login admin
     */
    public function showLoginForm()
    {
        return view('admin.auth.index');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|ends_with:@politala.ac.id',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.ends_with' => 'Email admin harus menggunakan domain @politala.ac.id',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Authenticate using the users provider (users table)
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah.'
            ])->withInput($request->only('email', 'remember'));
        }

        // Ambil instance user yang terautentikasi (dari tabel `users` melalui provider)
        $user = Auth::user();

        // Check if 2FA is enabled
        if ($user->two_factor_enabled) {
            // Set a session flag to indicate that 2FA verification is pending
            $request->session()->put('2fa_in_progress', true);
            // Redirect to the 2FA verification page
            return redirect()->route('admin.2fa.verify');
        }

        // Invalidate semua session lain untuk user ini (1 akun 1 device)
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $request->session()->getId())
            ->delete();

        // Pastikan akun memiliki akses admin (cek kolom 'peran')
        $isAdmin = false;
        if (isset($user->peran) && str_contains(strtolower($user->peran), 'admin')) {
            $isAdmin = true;
        }

        if (!$isAdmin) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun tidak memiliki akses admin.'
            ])->withInput($request->only('email', 'remember'));
        }

        // Cek apakah akun aktif (jika ada kolom status)
        if (isset($user->status)) {
            $statusNormalized = strtolower(trim($user->status));
            $activeValues = ['active', 'aktif', '1', 'true', 'yes'];
            if (!in_array($statusNormalized, $activeValues, true)) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun tidak aktif. Silakan hubungi administrator.'
                ])->withInput($request->only('email', 'remember'));
            }
        }

        // Regenerasi session setelah login berhasil
        $request->session()->regenerate();

        // Log aktivitas (opsional) — hanya jika helper tersedia
        if (function_exists('activity')) {
            \activity('auth')
                ->performedOn($user)
                ->log('Admin logged in');
        }

        return redirect()->intended(route('admin.dashboard'))->with('success', 'Login berhasil!');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        // Log aktivitas sebelum logout (opsional)
        if (Auth::check() && function_exists('activity')) {
            \activity('auth')
                ->performedOn(Auth::user())
                ->log('Admin logged out');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Get the guard to be used during authentication.
     */
    protected function guard()
    {
        return Auth::guard();
    }
}