<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    // tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // proses login - 1 akun hanya untuk 1 device
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Invalidate semua session lain untuk user ini (1 akun 1 device)
            // Query tabel sessions dan hapus session lain yang memiliki user_id yang sama
            DB::table('sessions')
                ->where('user_id', $user->id)
                ->where('id', '!=', $request->session()->getId())
                ->delete();
            
            // Regenerate session token untuk keamanan
            $request->session()->regenerate();

            // Log aktivitas login (jika package activity sudah install)
            if (function_exists('activity')) {
                activity()
                    ->performedOn($user)
                    ->withProperties([
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                    ])
                    ->log('Login');
            }

            if (strtolower($user->peran) === 'administrator' || strtolower($user->peran) === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        $user = Auth::user();
        $isAdmin = false;

        // Check if the user is an admin before logging out
        if ($user && isset($user->peran) && str_contains(strtolower($user->peran), 'admin')) {
            $isAdmin = true;
        }
        
        // Log activity if available
        if (function_exists('activity') && $user) {
            activity()
                ->performedOn($user)
                ->withProperties([
                    'ip_address' => $request->ip(),
                ])
                ->log('Logout');
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect based on the role
        if ($isAdmin) {
            return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
        }

        return redirect('/login');
    }

    // tampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Tampilkan form untuk memasukkan email (lupa password)
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Kirim email reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // Tampilkan form reset password (dengan token)
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Proses reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Login user setelah reset
                Auth::login($user);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('home')->with('status', __($status));
        }

        return back()->withErrors(['email' => [__($status)]]);
    }

    // proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verified' => false,
        ]);

        Auth::login($user);

        $emailDomain = substr(strrchr($user->email, "@"), 1);

        if ($emailDomain === 'mhs.politala.ac.id' || $emailDomain === 'politala.ac.id') {
            return redirect('/home');
        }

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
