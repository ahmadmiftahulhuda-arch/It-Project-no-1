<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

// ✅ Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

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