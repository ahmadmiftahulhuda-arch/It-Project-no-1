<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login admin
    public function showLoginForm()
    {
        return view('admin.auth.index');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Pastikan user memiliki peran admin
            if (isset($user->peran) && strtolower($user->peran) === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // jika bukan admin, logout dan beri pesan
            Auth::logout();
            return back()->withErrors(['email' => 'Akun tidak memiliki akses admin.'])->withInput();
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
