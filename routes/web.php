<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\PeminjamanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProjectorController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\JadwalPerkuliahanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\SlotWaktuController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PenggunaController;
// ================================
// HALAMAN UMUM (PUBLIC ROUTES)
// ================================
Route::get('/', fn() => view('home'))->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/kalender', 'kalender');
Route::view('/peminjaman', 'peminjaman');
Route::view('/berita', 'berita');
Route::view('/post', 'post');
Route::view('/syaratdanketentuan', 'syaratdanketentuan');
Route::view('/faq', 'faq');

// ================================
// AUTHENTIKASI DAN GOOGLE LOGIN
// ================================
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset
Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

// ================================
// HALAMAN LOGIN DAN DASHBOARD
// ================================
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

// ================================
// ADMIN ROUTES
// ================================
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Feedback
    Route::resource('feedback', FeedbackController::class);

    // Projector
    Route::resource('projectors', ProjectorController::class);

    // Jadwal Perkuliahan
    Route::resource('jadwal-perkuliahan', JadwalPerkuliahanController::class);
    Route::post('/jadwal-perkuliahan/import', [JadwalPerkuliahanController::class, 'import'])->name('jadwal-perkuliahan.import');
    Route::get('/template', [JadwalPerkuliahanController::class, 'downloadTemplate'])->name('template');
    Route::post('/jadwal-perkuliahan/delete-all', [JadwalPerkuliahanController::class, 'deleteAll'])->name('jadwal-perkuliahan.delete-all');

    // Ruangan, Mata Kuliah, Slot Waktu
    Route::resource('ruangan', RuanganController::class);
    Route::resource('mata_kuliah', MataKuliahController::class);
    Route::resource('slotwaktu', SlotWaktuController::class);

    // Kelas & Mahasiswa
    Route::resource('kelas', KelasController::class);
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // Admin Peminjaman, Pengembalian, Riwayat
    Route::prefix('peminjaman')->group(function () {
        Route::get('/', [AdminController::class, 'peminjaman'])->name('admin.peminjaman.index');
        Route::post('/', [AdminController::class, 'store'])->name('admin.peminjaman.store');
        Route::put('/{id}/approve', [AdminController::class, 'approve'])->name('admin.peminjaman.approve');
        Route::put('/{id}/reject', [AdminController::class, 'reject'])->name('admin.peminjaman.reject');
        Route::put('/{id}/complete', [AdminController::class, 'complete'])->name('admin.peminjaman.complete');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.peminjaman.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.peminjaman.destroy');
    });

    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [AdminController::class, 'pengembalian'])->name('admin.pengembalian');
        Route::post('/', [AdminController::class, 'storePengembalian'])->name('admin.pengembalian.store');
        Route::put('/{id}/kembalikan', [AdminController::class, 'prosesPengembalian'])->name('admin.pengembalian.kembalikan');
        Route::delete('/{id}', [AdminController::class, 'destroyPengembalian'])->name('admin.pengembalian.destroy');
    });

    Route::prefix('riwayat')->group(function () {
        Route::get('/', [AdminController::class, 'riwayat'])->name('admin.riwayat');
        Route::put('/{id}', [AdminController::class, 'updateRiwayat'])->name('admin.riwayat.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.riwayat.destroy');
    });
});
//routes pengguna
Route::prefix('admin')->group(function () {
    Route::resource('pengguna', PenggunaController::class);
});

// ================================
// ROUTES UNTUK USER
// ================================



// Feedback Routes for User
Route::prefix('user/feedback')->middleware('auth')->group(function () {
    Route::get('/create', [FeedbackController::class, 'createForUser'])->name('user.feedback.create');
    Route::post('/', [FeedbackController::class, 'storeForUser'])->name('user.feedback.store');
});

Route::prefix('peminjaman')->group(function () {
    Route::get('/', [PeminjamanController::class, 'index'])->name('user.peminjaman.index');
    Route::get('/create', [PeminjamanController::class, 'create'])->name('user.peminjaman.create');
    Route::post('/', [PeminjamanController::class, 'store'])->name('user.peminjaman.store');
    Route::get('/{id}', [PeminjamanController::class, 'show'])->name('user.peminjaman.show');
    Route::get('/{id}/edit', [PeminjamanController::class, 'edit'])->name('user.peminjaman.edit');
    Route::put('/{id}', [PeminjamanController::class, 'update'])->name('user.peminjaman.update');
    Route::delete('/{id}', [PeminjamanController::class, 'destroy'])->name('user.peminjaman.destroy');
    Route::get('/riwayat/user', [PeminjamanController::class, 'riwayat'])->name('user.peminjaman.riwayat');
});

Route::prefix('pengembalian')->group(function () {
    Route::get('/', [PeminjamanController::class, 'pengembalianUser'])->name('user.pengembalian.index');
    Route::get('/{id}', [PeminjamanController::class, 'showPengembalian'])->name('user.pengembalian.show');
    Route::post('/{id}/ajukan', [PeminjamanController::class, 'ajukanPengembalian'])->name('user.pengembalian.ajukan');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ruangan', RuanganController::class);
});