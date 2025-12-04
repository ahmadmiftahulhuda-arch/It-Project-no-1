<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\PeminjamanController;
use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Exports\RiwayatExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
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
use App\Models\Ruangan;
use App\Models\SlotWaktu;
use App\Models\Projector;
use App\Http\Controllers\Admin\AHPController;

// ================================
// HALAMAN UMUM (PUBLIC ROUTES)
// ================================


Route::get('/', function () {
    // Ambil hanya ruangan yang statusnya 'tersedia' (case-insensitive)
    $ruangan = Ruangan::with('jadwals')
        ->whereRaw("LOWER(COALESCE(status, '')) = ?", ['tersedia'])
        ->get();

    $slotwaktu = SlotWaktu::all();
    $projectors = Projector::whereRaw("LOWER(COALESCE(status, '')) = ?", ['tersedia'])->get();

    return view('home', compact('ruangan', 'slotwaktu', 'projectors'));
})->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/kalender', 'kalender');
Route::view('/peminjaman1', 'peminjaman1');
Route::view('/berita', 'berita');
Route::view('/post', 'post');
Route::view('/syaratdanketentuan', 'syaratdanketentuan');
Route::view('/faq', 'faq');
Route::get('/home', function () {
    $ruangan = Ruangan::with('jadwals')
        ->whereRaw("LOWER(COALESCE(status, '')) = ?", ['tersedia'])
        ->get();

    $slotwaktu = SlotWaktu::all();

    $projectors = Projector::whereRaw("LOWER(COALESCE(status, '')) = ?", ['tersedia'])->get();

    return view('home', compact('ruangan', 'slotwaktu', 'projectors'));
});


// ================================
// AUTHENTIKASI DAN GOOGLE LOGIN
// ================================
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

    // User Feedback CRUD
    Route::resource('user/feedback', App\Http\Controllers\User\FeedbackController::class)->names('user.feedback');
});

// ================================
// ADMIN ROUTES
// ================================

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/verify', [App\Http\Controllers\Admin\UserController::class, 'verify'])->name('verify');
    });

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Admin authentication (login/logout)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Feedback
    Route::resource('feedback', FeedbackController::class);

    // Projector 
    Route::resource('projectors', ProjectorController::class)->except(['show']);

    // Jadwal Perkuliahan
    Route::resource('jadwal-perkuliahan', JadwalPerkuliahanController::class);
    Route::post('/jadwal-perkuliahan/import', [JadwalPerkuliahanController::class, 'import'])->name('jadwal-perkuliahan.import');
    Route::get('/template', [JadwalPerkuliahanController::class, 'downloadTemplate'])->name('template');
    Route::post('/jadwal-perkuliahan/delete-all', [JadwalPerkuliahanController::class, 'deleteAll'])->name('jadwal-perkuliahan.delete-all');

    // Ruangan, Mata Kuliah, Slot Waktu
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('slotwaktu', App\Http\Controllers\SlotWaktuController::class);
    });
    Route::resource('ruangan', RuanganController::class);
    Route::resource('mata_kuliah', MataKuliahController::class);
    Route::resource('slotwaktu', SlotWaktuController::class);

    // Kelas & Mahasiswa
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kelas', KelasController::class);
        Route::post('/kelas/{kela}/import-mahasiswa', [KelasController::class, 'importMahasiswa'])->name('kelas.importMahasiswa');
        Route::post('/kelas/delete-all', [KelasController::class, 'deleteAll'])->name('kelas.delete-all');
    });
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

    // --- EKSPORT EXCEL PEMINJAMAN ---
    Route::get('/peminjaman-export', function () {
        return Excel::download(new PeminjamanExport, 'data_peminjaman.xlsx');
    })->name('admin.peminjaman.export');

    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [AdminController::class, 'pengembalian'])->name('admin.pengembalian');
        Route::post('/', [AdminController::class, 'storePengembalian'])->name('admin.pengembalian.store');
        Route::put('/{id}/kembalikan', [AdminController::class, 'prosesPengembalian'])
            ->name('admin.pengembalian.kembalikan');
        Route::delete('/{id}', [AdminController::class, 'destroyPengembalian'])
            ->name('admin.pengembalian.destroy');
    });

    Route::prefix('riwayat')->group(function () {
        Route::get('/', [AdminController::class, 'riwayat'])->name('admin.riwayat');
        Route::put('/{id}', [AdminController::class, 'updateRiwayat'])->name('admin.riwayat.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.riwayat.destroy');
    });
    Route::get('/riwayat/export', function (Request $request) {
        return Excel::download(new RiwayatExport($request), 'riwayat_peminjaman.xlsx');
    })->name('admin.riwayat.export');
});

// ================================
// ROUTES UNTUK USER
// ================================

// Feedback Routes for User
Route::prefix('user/feedback')->middleware('auth')->group(function () {
    Route::get('/', [FeedbackController::class, 'indexForUser'])->name('user.feedback.index');
    Route::get('/create', [FeedbackController::class, 'createForUser'])->name('user.feedback.create');
    Route::post('/', [FeedbackController::class, 'storeForUser'])->name('user.feedback.store');
});
// Rute untuk menampilkan form feedback untuk peminjaman tertentu
Route::get('/peminjaman/{peminjaman}/feedback', [FeedbackController::class, 'create'])->name('feedback.create');

// Rute untuk menyimpan data feedback
Route::post('/peminjaman/{peminjaman}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::prefix('peminjaman')->middleware('auth')->group(function () {
    Route::get('/', [PeminjamanController::class, 'index'])->name('user.peminjaman.index');
    Route::get('/create', [PeminjamanController::class, 'create'])->name('user.peminjaman.create');
    Route::post('/', [PeminjamanController::class, 'store'])->name('user.peminjaman.store');
    Route::get('/{id}', [PeminjamanController::class, 'show'])->name('user.peminjaman.show');
    Route::get('/{id}/edit', [PeminjamanController::class, 'edit'])->name('user.peminjaman.edit');
    Route::put('/{id}', [PeminjamanController::class, 'update'])->name('user.peminjaman.update');
    Route::delete('/{id}', [PeminjamanController::class, 'destroy'])->name('user.peminjaman.destroy');
    Route::get('/riwayat/user', [PeminjamanController::class, 'riwayat'])->name('user.peminjaman.riwayat');
});

Route::prefix('pengembalian')->middleware('auth')->group(function () {

    Route::get('/', [PeminjamanController::class, 'pengembalianUser'])->name('user.pengembalian.index');

    Route::post('/ajukan/{id}', [PeminjamanController::class, 'ajukanPengembalian'])->name('pengembalian.ajukan');

    // Halaman index pengembalian
    Route::get('/pengembalian', [AdminController::class, 'pengembalian'])
        ->name('admin.pengembalian');

    // Proses tambah pengembalian
    Route::post('/pengembalian', [AdminController::class, 'storePengembalian'])
        ->name('admin.pengembalian.store');

    // Edit pengembalian
    Route::get('/pengembalian/{id}/edit', [AdminController::class, 'editPengembalian'])
        ->name('admin.pengembalian.edit');

    // Update pengembalian
    Route::put('/pengembalian/{id}', [AdminController::class, 'updatePengembalian'])
        ->name('admin.pengembalian.update');

    // Approve pengembalian
    Route::put('/pengembalian/{id}/approve', [AdminController::class, 'approvePengembalian'])
        ->name('admin.pengembalian.approve');

    // Reject pengembalian
    Route::put('/pengembalian/{id}/reject', [AdminController::class, 'rejectPengembalian'])
        ->name('admin.pengembalian.reject');
});

Route::prefix('admin')->group(function () {

    Route::get('/ahp-settings', [AHPController::class, 'index'])
        ->name('admin.ahp.settings');

    Route::post('/ahp-settings', [AHPController::class, 'store'])
        ->name('admin.ahp.settings.save');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ruangan', RuanganController::class);
});
