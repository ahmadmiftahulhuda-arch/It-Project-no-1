<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\GoogleAuthController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);


// ✅ CSS
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
Route::get('/home', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});

// ✅ Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// ✅ Hanya user login yang bisa akses
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return "Selamat datang di dashboard!";
    });
});
