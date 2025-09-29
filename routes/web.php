<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/home', function () {
    return view('home');
})->name('home');   // kasih nama 'home'

Route::get('/about', function () {
    return view('about');
})->name('about'); 

// ✅ Google Auth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// ✅ CSS Assets
Route::get('/style.css', function () {
    $path = resource_path('css/style.css');
    $content = File::get($path);

    return Response::make($content, 200, [
        'Content-Type' => 'text/css'
    ]);
});

Route::get('/css/login.css', function () {
    $path = resource_path('css/login.css');
    $content = File::get($path);

    return Response::make($content, 200, [
        'Content-Type' => 'text/css'
    ]);
});

Route::get('/', function () {
    return view('home');
})->name('dashboard');

// ✅ Halaman bebas diakses (public)
Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/kalender', function () {
    return view('kalender');
});

Route::get('/peminjaman', function () {
    return view('peminjaman');
});

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/post', function () {
    return view('post');
});

Route::get('/syaratdanketentuan', function () {
    return view('syaratdanketentuan');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/login', function () {
    return view('auth.login');  // otomatis ke resources/views/auth/login.blade.php
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard'); // Redirect ke dashboard
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
});

// ✅ Halaman dashboard admin
Route::get('/admin/login', function () {
    return view('admin/login');
});
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
});
Route::get('/admin/item', function () {
    return view('admin/item');
});
Route::get('/admin/peminjaman', function () {
    return view('admin/peminjaman');
});
Route::get('/admin/pengembalian', function () {
    return view('admin/pengembalian');
});
Route::get('/admin/pengguna', function () {
    return view('admin/pengguna');
});
Route::get('/admin/laporan', function () {
    return view('admin/laporan');
});
Route::get('/admin/pengaturan', function () {
    return view('admin/pengaturan');
});

// ✅ Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});
// ✅ Password Reset Routes (Tambahkan ini)
Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

// ✅ Hanya user login yang bisa akses
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Tambahkan route admin lainnya di sini
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

// Fallback route untuk menangani 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::get('/dashboard', function () {
    return view('home'); // arahkan ke home.blade.php
})->middleware('auth')->name('dashboard');