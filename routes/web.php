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
use App\Exports\FeedbackExport; // Add this line
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
use App\Http\Controllers\Admin\SPKController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\NotificationController;

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

    // Statistik
    $totalRuangan = Ruangan::count();
    $availableRuangan = Ruangan::whereRaw("LOWER(COALESCE(status, '')) = ?", ['tersedia'])->count();
    $maintenanceRuangan = Ruangan::whereRaw("LOWER(COALESCE(status, '')) IN (?, ?)", ['maintenance', 'perbaikan'])->count();
    $occupiedRuangan = max(0, $totalRuangan - $availableRuangan - $maintenanceRuangan);
    $totalProjectors = Projector::count();

    return view('home', compact(
        'ruangan',
        'slotwaktu',
        'projectors',
        'totalRuangan',
        'availableRuangan',
        'occupiedRuangan',
        'totalProjectors'
    ));
})->name('home');
Route::view('/about', 'about')->name('about');
use App\Http\Controllers\KalenderController;

Route::view('/kalender', 'kalender');
Route::get('/kalender/events', [KalenderController::class, 'events'])->name('kalender.events');
Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender.index');
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
    // Statistik
    $totalRuangan = Ruangan::count();
    $availableRuangan = Ruangan::whereRaw("LOWER(COALESCE(status, '')) = ?", ['tersedia'])->count();
    // hitung maintenance / perbaikan
    $maintenanceRuangan = Ruangan::whereRaw("LOWER(COALESCE(status, '')) IN (?, ?)", ['maintenance', 'perbaikan'])->count();
    $occupiedRuangan = max(0, $totalRuangan - $availableRuangan - $maintenanceRuangan);
    $totalProjectors = Projector::count();

    return view('home', compact(
        'ruangan',
        'slotwaktu',
        'projectors',
        'totalRuangan',
        'availableRuangan',
        'occupiedRuangan',
        'totalProjectors'
    ));
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

// Routes for 2FA verification
Route::get('/admin/2fa/verify', [App\Http\Controllers\Admin\Google2FAController::class, 'showVerifyForm'])->name('admin.2fa.verify');
Route::post('/admin/2fa/verify', [App\Http\Controllers\Admin\Google2FAController::class, 'verify']);

// ================================
// AUTHENTIKASI ADMIN
// ================================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});


// ================================
// HALAMAN DASHBOARD USER (split for RBAC)
// ================================

// Route group for Mahasiswa and Dosen
Route::middleware(['auth', 'role:Mahasiswa,Dosen'])->group(function () {
    Route::get('/dashboard', [PeminjamanController::class, 'index'])->name('user.dashboard'); // Redirect user dashboard to their loans
    // User Feedback CRUD
    Route::resource('user/feedback', App\Http\Controllers\User\FeedbackController::class)->names('user.feedback');
});

// Route group for Administrator
Route::middleware(['auth', 'role:Administrator,Admin,Superadmin'])->group(function () {
    Route::get('/admin/dashboard-main', [AdminController::class, 'dashboard'])->name('dashboard'); // Keep old dashboard name if needed
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
});

// ================================
// ADMIN ROUTES
// ================================

Route::middleware(['auth', 'role:Administrator,Admin,Superadmin', '2fa.verified'])->prefix('admin')->group(function () {

    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/verify', [App\Http\Controllers\Admin\UserController::class, 'verify'])->name('verify');
    });

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // --- EKSPORT EXCEL FEEDBACK ---
    Route::get('/feedback/export', function (Request $request) {
        return Excel::download(new FeedbackExport($request), 'feedback.xlsx');
    })->name('admin.feedback.export');

    // Feedback
    Route::resource('feedback', FeedbackController::class)->names('admin.feedback');

    // Projector & Barangs
    Route::resource('projectors', ProjectorController::class)->except(['show']);
    Route::resource('barangs', \App\Http\Controllers\Admin\BarangController::class)->except(['show']);

    // Jadwal Perkuliahan
    Route::resource('jadwal-perkuliahan', JadwalPerkuliahanController::class);
    Route::post('/jadwal-perkuliahan/import', [JadwalPerkuliahanController::class, 'import'])->name('jadwal-perkuliahan.import');
    Route::get('/template', [JadwalPerkuliahanController::class, 'downloadTemplate'])->name('template');
    Route::post('/jadwal-perkuliahan/delete-all', [JadwalPerkuliahanController::class, 'deleteAll'])->name('jadwal-perkuliahan.delete-all');
    Route::get('/jadwal-perkuliahan/export', [JadwalPerkuliahanController::class, 'export'])->name('jadwal-perkuliahan.export');

    // Ruangan, Mata Kuliah, Slot Waktu
    Route::resource('ruangan', RuanganController::class)->names('admin.ruangan');
    Route::post('/ruangan/import', [RuanganController::class, 'import'])->name('ruangan.import');

    Route::resource('slotwaktu', SlotWaktuController::class)->names('admin.slotwaktu');
    Route::post('/slotwaktu/import', [SlotWaktuController::class, 'import'])->name('slotwaktu.import');

    Route::resource('mata_kuliah', MataKuliahController::class);
    Route::post('/mata_kuliah/import', [MataKuliahController::class, 'import'])->name('mata_kuliah.import');
    Route::get('/mata_kuliah/export', [MataKuliahController::class, 'export'])->name('mata_kuliah.export');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\PengaturanController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings/profile', [App\Http\Controllers\Admin\PengaturanController::class, 'updateProfile'])->name('admin.settings.profile');
    Route::post('/settings/password', [App\Http\Controllers\Admin\PengaturanController::class, 'updatePassword'])->name('admin.settings.password');
    Route::post('/settings/security', [App\Http\Controllers\Admin\PengaturanController::class, 'updateSecurity'])->name('admin.settings.security');
    Route::post('/settings/notifications', [App\Http\Controllers\Admin\PengaturanController::class, 'updateNotifications'])->name('admin.settings.notifications');
    Route::post('/settings/system', [App\Http\Controllers\Admin\PengaturanController::class, 'updateSystemSettings'])->name('admin.settings.system');

    // 2FA Routes
    Route::post('/settings/2fa/setup', [App\Http\Controllers\Admin\Google2FAController::class, 'setup'])->name('admin.2fa.setup');
    Route::post('/settings/2fa/activate', [App\Http\Controllers\Admin\Google2FAController::class, 'activate'])->name('admin.2fa.activate');
    Route::post('/settings/2fa/disable', [App\Http\Controllers\Admin\Google2FAController::class, 'disable'])->name('admin.2fa.disable');

    // Kelas & Mahasiswa
    Route::resource('kelas', KelasController::class)->names('admin.kelas');
    Route::post('/kelas/{kela}/import-mahasiswa', [KelasController::class, 'importMahasiswa'])->name('admin.kelas.importMahasiswa');
    Route::get('/kelas/{kela}/mahasiswa/export', [KelasController::class, 'exportMahasiswa'])->name('admin.kelas.mahasiswa.export');
    Route::delete('/kelas/{kela_id}/mahasiswa/destroy-all', [MahasiswaController::class, 'destroyAllByKelas'])->name('admin.kelas.mahasiswa.destroyAll');
    Route::get('/kelas/{kelas}/mahasiswa/search', [MahasiswaController::class, 'searchByKelas'])->name('admin.kelas.mahasiswa.search');
    Route::get('/kelas/{kelas}/detail', [MahasiswaController::class, 'showDetailWithSearch'])->name('admin.kelas.detail.search');

    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // Route Dosen
    Route::resource('dosen', \App\Http\Controllers\Admin\DosenController::class);
    Route::post('/dosen/import', [\App\Http\Controllers\Admin\DosenController::class, 'import'])->name('dosen.import');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/notifications/all', [NotificationController::class, 'all'])->name('admin.notifications.all');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllAsRead');
    Route::post('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('admin.notifications.clearAll');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');

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
        Route::put('/{id}/approve', [AdminController::class, 'approvePengembalian'])->name('admin.pengembalian.approve');
        Route::put('/{id}/reject', [AdminController::class, 'rejectPengembalian'])->name('admin.pengembalian.reject');
        Route::put('/{id}', [AdminController::class, 'updatePengembalian'])->name('admin.pengembalian.update');
        Route::put('/{id}/kembalikan', [AdminController::class, 'prosesPengembalian'])->name('admin.pengembalian.kembalikan');
        Route::delete('/{id}', [AdminController::class, 'destroyPengembalian'])->name('admin.pengembalian.destroy');
    });

    // Laporan
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/data', [AdminController::class, 'getReportData'])->name('admin.laporan.data');
    Route::get('/laporan/export', [AdminController::class, 'exportLaporan'])->name('admin.laporan.export');

    Route::prefix('riwayat')->group(function () {
        Route::get('/', [AdminController::class, 'riwayat'])->name('admin.riwayat');
        Route::put('/{id}', [AdminController::class, 'updateRiwayat'])->name('admin.riwayat.update');
        Route::delete('/{id}', [AdminController::class, 'destroyRiwayat'])->name('admin.riwayat.destroy');
    });

    Route::get('/riwayat/export', function (Request $request) {
        return Excel::download(new RiwayatExport($request), 'riwayat_peminjaman.xlsx');
    })->name('admin.riwayat.export');

    // --- RBAC & LOG AUDIT ---
    Route::get('/audit-logs', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('admin.audit-logs.index');
    Route::get('/rbac', [\App\Http\Controllers\Admin\RbacController::class, 'index'])->name('admin.rbac.index');
    Route::post('/rbac/sync', [\App\Http\Controllers\Admin\RbacController::class, 'syncAll'])->name('admin.rbac.sync');
    Route::post('/rbac/assign-role', [\App\Http\Controllers\Admin\RbacController::class, 'assignRole'])->name('admin.rbac.assignRole');
});

// ================================
// ENDPOINT PENGUJIAN RBAC (TESTING)
// ================================
Route::get('/test-rbac', function () {
    $user = auth()->user();
    if (!$user) {
        return response()->json(['status' => 'unauthenticated', 'message' => 'Silakan login terlebih dahulu.'], 401);
    }
    return response()->json([
        'status' => 'success',
        'message' => 'Integrasi RBAC Berhasil Berjalan di PINTER!',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'peran_db' => $user->peran,
            'spatie_roles' => $user->getRoleNames(),
            'spatie_permissions' => $user->getAllPermissions()->pluck('name'),
        ]
    ]);
})->middleware('auth')->name('test.rbac');

Route::get('/test-perm-admin', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BERHASIL: Anda lolos verifikasi permission [manage users]!'
    ]);
})->middleware(['auth', 'permission:manage users']);

Route::get('/test-perm-peminjaman', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BERHASIL: Anda lolos verifikasi permission [create peminjaman]!'
    ]);
})->middleware(['auth', 'permission:create peminjaman']);

Route::get('/test-perm-check', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BERHASIL: Anda lolos verifikasi permission [check transactions] (Checker/Admin)!'
    ]);
})->middleware(['auth', 'permission:check transactions']);

Route::get('/test-perm-approve', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BERHASIL: Anda lolos verifikasi permission [approve transactions] (Approver/Admin)!'
    ]);
})->middleware(['auth', 'permission:approve transactions']);

// ================================
// ROUTES UNTUK USER
// ================================

Route::middleware(['auth', 'role:Mahasiswa,Dosen'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/profile', [App\Http\Controllers\User\UserProfileController::class, 'index'])->name('user.profile.index');
        Route::put('/profile', [App\Http\Controllers\User\UserProfileController::class, 'update'])->name('user.profile.update');
        Route::get('/settings', [App\Http\Controllers\User\SettingsController::class, 'index'])->name('user.settings.index');
        Route::put('/settings', [App\Http\Controllers\User\SettingsController::class, 'update'])->name('user.settings.update');
    });

    Route::get('user/feedback/create/{peminjaman}', [App\Http\Controllers\User\FeedbackController::class, 'create'])->name('user.feedback.create_with_peminjaman');

    Route::middleware('verified.user')->prefix('peminjaman')->group(function () {
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
        Route::post('/ajukan/{id}', [PeminjamanController::class, 'ajukanPengembalian'])->name('pengembalian.ajukan');
    });
});


Route::middleware(['auth', 'role:Administrator', '2fa.verified'])
    ->prefix('admin')
    ->group(function () {

        /* =========================
       AHP (BOBOT KRITERIA)
    ========================= */
        Route::get('/ahp-settings', [AHPController::class, 'index'])
            ->name('admin.ahp.settings');

        Route::post('/ahp-settings', [AHPController::class, 'store'])
            ->name('admin.ahp.settings.save');

        /* =========================
       SPK UTAMA (PEMINJAMAN ASLI)
    ========================= */
        Route::get('/spk', [SPKController::class, 'index'])
            ->name('admin.spk.index');

        Route::post('/spk/scores', [SPKController::class, 'storeScores'])
            ->name('admin.spk.scores.save');
    });
