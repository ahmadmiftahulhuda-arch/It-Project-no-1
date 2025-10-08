<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pengguna; // <-- Ditambahkan

class AuthController extends Controller
{
    // tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek peran pengguna dari tabel 'penggunas'
            $user = Auth::user();
            $pengguna = Pengguna::where('email', $user->email)->first();

            // Arahkan berdasarkan peran
            if ($pengguna && $pengguna->peran === 'Admin') {
                return redirect()->intended('/admin/dashboard'); // Arahkan ke dashboard admin
            } 

            return redirect()->intended('/'); // Arahkan ke halaman utama untuk user biasa
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // tampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
