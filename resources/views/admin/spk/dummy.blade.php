@php
    $dummyRankings = $dummyRankings ?? collect();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Dummy - AHP & SAW</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3b5998;
            --secondary: #6d84b4;
            --success: #4caf50;
            --info: #2196f3;
            --warning: #ff9800;
            --danger: #f44336;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
            --sidebar-width: 250px;
            --text-light: #6c757d;
            --text-dark: #495057;
            --bg-light: #f5f8fa;
            --bg-card: #ffffff;
            --border-light: #e9ecef;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .dark-mode .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .sidebar-logo {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
            flex-shrink: 0;
        }

        .dropdown-custom {
            margin-bottom: 5px;
        }

        .dropdown-toggle-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            cursor: pointer;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            font-weight: 600;
        }

        .dropdown-toggle-custom:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .dropdown-toggle-custom i:last-child {
            transition: transform 0.3s;
            margin-left: auto;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .dropdown-toggle-custom[aria-expanded="true"] {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid white;
        }

        .dropdown-toggle-custom[aria-expanded="true"] i:last-child {
            transform: rotate(180deg);
        }

        .dropdown-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .dropdown-items.show {
            max-height: 500px;
        }

        .dropdown-item {
            padding: 10px 20px 10px 40px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            position: relative;
        }

        .dropdown-item:hover,
        .dropdown-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: 1px solid var(--border-light);
        }

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-light);
            border-radius: 30px;
            outline: none;
            transition: all 0.3s;
            background-color: var(--bg-light);
        }

        .search-bar input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-btn,
        .theme-toggle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-dark);
        }

        .notification-btn:hover,
        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title h1 {
            color: var(--dark);
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .page-title p {
            color: var(--text-light);
            margin: 0;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(59, 89, 152, 0.3);
        }

        .card-custom {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary);
        }

        .table-spk th {
            background-color: var(--primary);
            color: #fff;
            text-align: center;
        }

        .badge-priority {
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h2,
            .dropdown-toggle-custom span {
                display: none;
            }

            .dropdown-toggle-custom {
                justify-content: center;
                padding: 15px;
            }

            .dropdown-toggle-custom i {
                margin-right: 0;
            }

            .dropdown-toggle-custom i:last-child {
                display: none;
            }

            .dropdown-items {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
            }

            .search-bar {
                width: 100%;
            }

            .result-container {
                grid-template-columns: 1fr;
            }

            .matrix-table input {
                width: 60px;
            }
        }

        body.dark-mode {
            --bg-light: #121212;
            --bg-card: #1e1e1e;
            --text-dark: #e0e0e0;
            --text-light: #a0a0a0;
            --border-light: #333;
            --dark: #f0f0f0;
        }

        body.dark-mode .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }

        body.dark-mode .header,
        body.dark-mode .card-custom {
            background: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .table-spk th {
            background: var(--primary);
            color: white;
        }

        body.dark-mode .notification-btn,
        body.dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        body.dark-mode .search-bar input {
            background: #2a2a2a;
            border-color: #555;
            color: var(--text-dark);
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid var(--info);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .info-box.dark-mode {
            background: #2a2a2a;
            border-left: 4px solid var(--info);
        }

        .alert-custom {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h2>Admin TI</h2>
        </div>

        <div class="sidebar-menu">
            <!-- Menu Utama -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menuUtama" aria-expanded="false" aria-controls="menuUtama">
                    <span>Menu Utama</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="menuUtama">
                    <a href="/admin/dashboard" class="dropdown-item">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Peminjaman -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#peminjamanMenu" aria-expanded="false" aria-controls="peminjamanMenu">
                    <span>Manajemen Peminjaman</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="peminjamanMenu">
                    <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item">
                        <i class="fas fa-hand-holding"></i>
                        <span>Peminjaman</span>
                    </a>
                    <a href="/admin/pengembalian" class="dropdown-item">
                        <i class="fas fa-undo"></i>
                        <span>Pengembalian</span>
                    </a>
                    <a href="/admin/riwayat" class="dropdown-item">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Peminjaman</span>
                    </a>
                    <a href="/admin/feedback" class="dropdown-item">
                        <i class="fas fa-comment"></i>
                        <span>Feedback</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Aset -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#asetMenu" aria-expanded="false" aria-controls="asetMenu">
                    <span>Manajemen Aset</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="asetMenu">
                    <a href="{{ route('projectors.index') }}" class="dropdown-item">
                        <i class="fas fa-video"></i>
                        <span>Proyektor</span>
                    </a>
                    <a href="{{ route('barangs.index') }}" class="dropdown-item">
                        <i class="fas fa-box"></i>
                        <span>Barang</span>
                    </a>
                    <a href="/admin/ruangan" class="dropdown-item">
                        <i class="fas fa-door-open"></i>
                        <span>Ruangan</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Akademik -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#akademikMenu" aria-expanded="false" aria-controls="akademikMenu">
                    <span>Manajemen Akademik</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="akademikMenu">
                    <a href="/admin/jadwal-perkuliahan" class="dropdown-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Perkuliahan</span>
                    </a>
                    <a href="/admin/slotwaktu" class="dropdown-item">
                        <i class="fas fa-clock"></i>
                        <span>Slot Waktu</span>
                    </a>
                    <a href="/admin/mata_kuliah" class="dropdown-item">
                        <i class="fas fa-book"></i>
                        <span>Matakuliah</span>
                    </a>
                    <a href="/admin/kelas" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Kelas</span>
                    </a>
                    <a href="/admin/dosen" class="dropdown-item">
                        <i class="fas fa-user-tie"></i>
                        <span>Dosen</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Pengguna -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#penggunaMenu" aria-expanded="false" aria-controls="penggunaMenu">
                    <span>Manajemen Pengguna</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="penggunaMenu">
                    <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                        <i class="fas fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                </div>
            </div>

            <!-- Laporan & Pengaturan -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#laporanMenu" aria-expanded="false" aria-controls="laporanMenu">
                    <span>Laporan & Pengaturan</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="laporanMenu">
                    <a href="/admin/laporan" class="dropdown-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistik</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="dropdown-item">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            </div>

            <!-- Sistem Pendukung Keputusan -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#spkMenu" aria-expanded="false" aria-controls="spkMenu">
                    <span>Sistem TPK</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="spkMenu">
                    <a href="{{ route('admin.spk.index') }}" class="dropdown-item">
                        <i class="fas fa-sliders-h"></i>
                        <span>AHP & SAW</span>
                    </a>
                    <a href="{{ route('admin.spk.dummy') }}" class="dropdown-item active">
                        <i class="fas fa-file-excel"></i>
                        <span>SPK Dummy</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari menu...">
            </div>

            <div class="user-actions">
                <div class="notification-btn">
                    <i class="fas fa-bell"></i>
                </div>

                <div class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </div>

                <div class="user-profile">
                    <div class="user-avatar">A</div>
                    <div>
                        <div>Admin Lab</div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">Teknologi Informasi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title -->
        <div class="page-title">
            <div>
                <h1>SPK Dummy (Simulasi Excel & SAW)</h1>
                <p>Import data dummy dan simulasi perhitungan SAW untuk pengujian sistem</p>
            </div>
        </div>

        {{-- ALERT SUCCESS / ERROR --}}
        @if (session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-custom alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Info Box -->
        <div class="info-box">
            <h6 class="mb-2"><i class="fas fa-info-circle me-2 text-info"></i>Fitur SPK Dummy</h6>
            <p class="mb-0 small">Gunakan fitur ini untuk menguji sistem dengan data dummy dari Excel sebelum menerapkan pada data peminjaman sebenarnya.</p>
        </div>

        <!-- BAGIAN A: IMPORT DATA DUMMY -->
        <div class="card-custom">
            <h2 class="section-title">
                <i class="fas fa-upload"></i>
                A. Import Data Dummy dari Excel
            </h2>

            <p class="text-muted mb-3">
                Upload file Excel dengan data dummy untuk simulasi perhitungan SAW.
            </p>

            <form action="{{ route('admin.spk.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="fileInput" class="form-label">File Excel (.xlsx, .xls)</label>
                        <input type="file" name="file" id="fileInput" class="form-control" accept=".xlsx,.xls" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-file-import me-2"></i>Import Data
                        </button>
                    </div>
                </div>

                <div class="mt-3">
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-file-excel me-2 text-success"></i>
                        Format Excel yang Diperlukan:
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-bordered small">
                            <thead class="table-light">
                                <tr>
                                    <th>Kolom A</th>
                                    <th>Kolom B</th>
                                    <th>Kolom C</th>
                                    <th>Kolom D</th>
                                    <th>Kolom E</th>
                                    <th>Kolom F</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>nama</strong></td>
                                    <td><strong>keperluan</strong></td>
                                    <td><strong>tanggal_pinjam</strong></td>
                                    <td><strong>jam</strong></td>
                                    <td><strong>catatan_riwayat</strong></td>
                                    <td><strong>sarana_prasarana</strong></td>
                                </tr>
                                <tr class="text-muted">
                                    <td>John Doe</td>
                                    <td>perkuliahan</td>
                                    <td>2024-01-15</td>
                                    <td>08:00</td>
                                    <td>baik</td>
                                    <td>ruangan+proyektor</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <!-- BAGIAN B: DATA DUMMY -->
        @if ($dummyRankings->count())
        <div class="card-custom">
            <h2 class="section-title">
                <i class="fas fa-database"></i>
                B. Data Dummy yang Diimport
            </h2>

            <p class="text-muted mb-3">
                Data berikut telah dikonversi ke nilai kriteria sesuai aturan sistem.
            </p>

            <div class="table-responsive">
                <table class="table table-bordered table-spk align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th class="text-center">K1<br><small>Keperluan</small></th>
                            <th class="text-center">K2<br><small>Tanggal Pinjam</small></th>
                            <th class="text-center">K3<br><small>Jam (menit)</small></th>
                            <th class="text-center">K4<br><small>Catatan Riwayat</small></th>
                            <th class="text-center">K5<br><small>Sarana Prasarana</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dummyRankings as $i => $d)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>
                                    <strong>{{ $d->nama }}</strong>
                                    @if($d->keperluan)
                                        <br><small class="text-muted">{{ $d->keperluan }}</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $d->k1 }}</span>
                                </td>
                                <td class="text-center">
                                    {{ $d->k2 }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $d->k3 }}</span>
                                </td>
                                <td class="text-center">
                                    @if($d->k4 == 1)
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($d->k4 == 0.5)
                                        <span class="badge bg-warning">Cukup</span>
                                    @else
                                        <span class="badge bg-danger">Buruk</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($d->k5 == 2)
                                        <span class="badge bg-success">Ruang + Proyektor</span>
                                    @else
                                        <span class="badge bg-secondary">Ruang Saja</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- BAGIAN C: HASIL RANKING SAW -->
        <div class="card-custom">
            <h2 class="section-title">
                <i class="fas fa-ranking-star"></i>
                C. Hasil Perankingan SAW (Dummy Data)
            </h2>

            <p class="text-muted mb-3">
                Urutan prioritas berdasarkan nilai preferensi tertinggi dari perhitungan SAW.
            </p>

            @php
                $rankingSAW = $dummyRankings->sortByDesc('nilai_preferensi')->values();
                $maxPreferensi = $rankingSAW->first() ? $rankingSAW->first()->nilai_preferensi : 1;
                // Jika nilai preferensi maksimum adalah 0, set ke 1 untuk menghindari division by zero
                if ($maxPreferensi == 0) {
                    $maxPreferensi = 1;
                }
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">Peringkat</th>
                            <th>Nama</th>
                            <th class="text-center">Nilai Preferensi</th>
                            <th class="text-center">Status Prioritas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankingSAW as $i => $d)
                            <tr>
                                <td class="text-center fw-bold" style="width: 80px;">
                                    <div class="rank-circle @if($i < 3) top-rank @endif">
                                        {{ $i + 1 }}
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ $d->nama }}</strong>
                                    @if($d->keperluan)
                                        <br><small class="text-muted">{{ $d->keperluan }}</small>
                                    @endif
                                </td>
                                <td class="text-center fw-bold" style="width: 150px;">
                                    <div class="score-display">
                                        {{ number_format($d->nilai_preferensi, 4) }}
                                    </div>
                                </td>
                                <td class="text-center" style="width: 150px;">
                                    @if ($i === 0)
                                        <span class="badge bg-success badge-priority py-2 px-3">
                                            <i class="fas fa-trophy me-1"></i> Prioritas Utama
                                        </span>
                                    @elseif($i < 3)
                                        <span class="badge bg-info badge-priority py-2 px-3">
                                            <i class="fas fa-star me-1"></i> Prioritas Tinggi
                                        </span>
                                    @else
                                        <span class="badge bg-secondary badge-priority py-2 px-3">
                                            Prioritas Normal
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($rankingSAW->count() > 0)
            <div class="mt-4 p-3 bg-light border rounded">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-chart-line me-2 text-primary"></i>
                    Visualisasi Ranking
                </h6>
                <div class="ranking-visualization">
                    @foreach ($rankingSAW->take(5) as $i => $d)
                        <div class="d-flex align-items-center mb-2">
                            <div class="rank-number me-3" style="width: 30px;">#{{ $i+1 }}</div>
                            <div class="flex-grow-1">
                                <div class="progress" style="height: 25px;">
                                    @php
                                        // PERBAIKAN: Hindari division by zero
                                        $percentage = $maxPreferensi > 0 ? ($d->nilai_preferensi / $maxPreferensi) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar 
                                        @if($i==0) bg-success
                                        @elseif($i<3) bg-info
                                        @else bg-secondary @endif" 
                                        role="progressbar" 
                                        style="width: {{ $percentage }}%"
                                        aria-valuenow="{{ $d->nilai_preferensi }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="{{ $maxPreferensi }}">
                                        <span class="ms-2">{{ number_format($d->nilai_preferensi, 3) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ms-3" style="width: 120px;">
                                <small class="text-muted">{{ $d->nama }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @else
        <div class="card-custom">
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-file-excel fa-4x text-muted"></i>
                </div>
                <h4 class="mb-3">Belum ada data dummy</h4>
                <p class="text-muted mb-4">Import file Excel untuk mulai simulasi perhitungan SAW dengan data dummy.</p>
                <a href="#import-section" class="btn btn-primary">
                    <i class="fas fa-upload me-2"></i>Import Data Dummy
                </a>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle theme
        const themeToggle = document.getElementById('theme-toggle');
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('darkMode', 'enabled');
                
                // Update info box for dark mode
                document.querySelectorAll('.info-box').forEach(box => {
                    box.classList.add('dark-mode');
                });
            } else {
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('darkMode', 'disabled');
                
                // Remove dark mode from info box
                document.querySelectorAll('.info-box').forEach(box => {
                    box.classList.remove('dark-mode');
                });
            }
        });

        // Terapkan dark mode jika sebelumnya diaktifkan
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            document.querySelectorAll('.info-box').forEach(box => {
                box.classList.add('dark-mode');
            });
        }

        // File input preview
        const fileInput = document.getElementById('fileInput');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                if (fileName) {
                    const nextSibling = e.target.nextElementSibling;
                    if (nextSibling && nextSibling.classList.contains('form-label')) {
                        nextSibling.textContent = `File dipilih: ${fileName}`;
                        nextSibling.classList.add('text-success');
                    }
                }
            });
        }

        // Smooth scroll to import section
        document.querySelectorAll('a[href="#import-section"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('.card-custom:first-of-type').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add rank circle styling
        const style = document.createElement('style');
        style.textContent = `
            .rank-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #e9ecef;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                margin: 0 auto;
            }
            .top-rank {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            .score-display {
                font-size: 1.2rem;
                color: var(--primary);
            }
            .ranking-visualization .progress {
                border-radius: 12px;
                overflow: hidden;
            }
            .ranking-visualization .progress-bar {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                padding-left: 10px;
                font-weight: 600;
                border-radius: 12px;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>