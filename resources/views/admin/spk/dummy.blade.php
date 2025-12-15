@php
    $criteria = $criteria ?? [];
    $alternatifList = $alternatifList ?? [];
    $matrixX = $matrixX ?? null;
    $matrixR = $matrixR ?? null;
    $hasil = $hasil ?? null;
    $ranking = $ranking ?? null;
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Dummy - SAW</title>
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

        .table-bordered {
            border: 1px solid var(--border-light);
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid var(--border-light);
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

        body.dark-mode .table-bordered {
            border-color: var(--border-light);
        }

        body.dark-mode .table-bordered th,
        body.dark-mode .table-bordered td {
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        .alert-custom {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid var(--info);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        body.dark-mode .info-box {
            background: #2a2a2a;
            border-left: 4px solid var(--info);
        }

        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-weight: bold;
            margin-right: 10px;
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
                <h1>SPK Dummy - Metode SAW</h1>
                <p>Simulasi perhitungan SAW dengan data dummy untuk pengujian sistem</p>
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
            <p class="mb-0 small">Gunakan fitur ini untuk menguji sistem dengan data dummy sebelum menerapkan pada data
                peminjaman sebenarnya. Input 13 baris data sesuai format dan hitung perankingan SAW.</p>
        </div>

        <!-- BAGIAN A: BOBOT AHP -->
        <div class="card-custom">
            <h2 class="section-title">
                <i class="fas fa-weight-hanging"></i>
                A. Bobot Kriteria (Hasil AHP)
            </h2>

            <div class="table-responsive">
                <table class="table table-bordered table-spk align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criteria as $c)
                            @if (in_array($c->kode, ['K1', 'K2', 'K3', 'K4', 'K5']))
                                <tr>
                                    <td class="text-center fw-bold">{{ $c->kode }}</td>
                                    <td>{{ $c->nama }}</td>
                                    <td class="text-center">
                                        @if (strtolower($c->tipe) === 'benefit')
                                            <span class="badge bg-success">Benefit</span>
                                        @else
                                            <span class="badge bg-warning">Cost</span>
                                        @endif
                                    </td>
                                    <td class="text-center fw-bold">{{ number_format((float) $c->bobot, 6) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2 text-muted small">
                <i class="fas fa-info-circle me-1"></i>
                Normalisasi: Benefit = x/max, Cost = min/x
            </div>
        </div>

        <!-- BAGIAN B: STEP 0 - INPUT ALTERNATIF -->
        <div class="card-custom">
            <h2 class="section-title">
                <i class="fas fa-edit"></i>
                B. STEP 0 — Input Alternatif (13 baris sesuai Excel)
            </h2>

            <form method="GET" action="{{ route('admin.spk.dummy') }}">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle bg-white">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width:280px">Nama</th>
                                <th style="min-width:140px">Keperluan (K1)</th>
                                <th style="min-width:160px">Tanggal Pinjam (K2)</th>
                                <th style="min-width:140px">Jam (K3)</th>
                                <th style="min-width:180px">Catatan Riwayat (K4)</th>
                                <th style="min-width:180px">Sarana Prasarana (K5)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 13; $i++)
                                <tr>
                                    <td class="text-start">
                                        <input type="text" name="nilai[{{ $i }}][nama]"
                                            class="form-control" placeholder="Contoh: Dosen 1 / Mahasiswa 8"
                                            value="{{ request("nilai.$i.nama") }}" required>
                                    </td>

                                    <td>
                                        <input type="number" step="0.01" min="0"
                                            name="nilai[{{ $i }}][K1]" class="form-control text-center"
                                            value="{{ request("nilai.$i.K1") }}" placeholder="ex: 1-5">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                            name="nilai[{{ $i }}][K2]" class="form-control text-center"
                                            value="{{ request("nilai.$i.K2") }}" placeholder="ex: 1">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                            name="nilai[{{ $i }}][K3]" class="form-control text-center"
                                            value="{{ request("nilai.$i.K3") }}" placeholder="ex: 480">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                            name="nilai[{{ $i }}][K4]" class="form-control text-center"
                                            value="{{ request("nilai.$i.K4") }}" placeholder="ex: 1 / 0.5">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                            name="nilai[{{ $i }}][K5]" class="form-control text-center"
                                            value="{{ request("nilai.$i.K5") }}" placeholder="ex: 1 / 2">
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-primary btn-lg">
                        <i class="fas fa-calculator me-2"></i>Hitung SAW (STEP 1–5)
                    </button>
                </div>
            </form>
        </div>

        <!-- HASIL SAW -->
        @if (isset($matrixX))
            <!-- STEP 1 - MATRIX KEPUTUSAN -->
            <div class="card-custom">
                <h2 class="section-title">
                    <i class="fas fa-table"></i>
                    STEP 1 — Matriks Keputusan (X)
                </h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-spk align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">K1</th>
                                <th class="text-center">K2</th>
                                <th class="text-center">K3</th>
                                <th class="text-center">K4</th>
                                <th class="text-center">K5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matrixX as $row)
                                <tr>
                                    <td class="text-start">{{ $row['nama'] }}</td>
                                    <td class="text-center">{{ $row['K1'] }}</td>
                                    <td class="text-center">{{ $row['K2'] }}</td>
                                    <td class="text-center">{{ $row['K3'] }}</td>
                                    <td class="text-center">{{ $row['K4'] }}</td>
                                    <td class="text-center">{{ $row['K5'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- STEP 2 - MATRIX NORMALISASI -->
            <div class="card-custom">
                <h2 class="section-title">
                    <i class="fas fa-chart-bar"></i>
                    STEP 2 — Matriks Normalisasi (R)
                </h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-spk align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">K1</th>
                                <th class="text-center">K2</th>
                                <th class="text-center">K3</th>
                                <th class="text-center">K4</th>
                                <th class="text-center">K5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matrixR as $row)
                                <tr>
                                    <td class="text-start">{{ $row['nama'] }}</td>
                                    <td class="text-center">{{ number_format((float) $row['K1'], 6) }}</td>
                                    <td class="text-center">{{ number_format((float) $row['K2'], 6) }}</td>
                                    <td class="text-center">{{ number_format((float) $row['K3'], 6) }}</td>
                                    <td class="text-center">{{ number_format((float) $row['K4'], 6) }}</td>
                                    <td class="text-center">{{ number_format((float) $row['K5'], 6) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- STEP 3 - NILAI PREFERENSI -->
            <div class="card-custom">
                <h2 class="section-title">
                    <i class="fas fa-star"></i>
                    STEP 3 — Nilai Preferensi (V)
                </h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-spk align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $h)
                                <tr>
                                    <td class="text-start">{{ $h['nama'] }}</td>
                                    <td class="text-center fw-bold">{{ number_format((float) $h['preferensi'], 6) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- STEP 4 - RANKING PRIORITAS -->
            <div class="card-custom">
                <h2 class="section-title">
                    <i class="fas fa-trophy"></i>
                    STEP 4 — Ranking Prioritas
                </h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-spk align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Rank</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Nilai Preferensi</th>
                                <th class="text-center">Status Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ranking as $i => $r)
                                <tr>
                                    <td class="text-center fw-bold">
                                        <div class="rank-circle @if ($i < 3) top-rank @endif">
                                            {{ $i + 1 }}
                                        </div>
                                    </td>
                                    <td class="text-start">{{ $r['nama'] }}</td>
                                    <td class="text-center fw-bold">{{ number_format((float) $r['preferensi'], 6) }}
                                    </td>
                                    <td class="text-center">
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
            .badge-priority {
                font-size: 0.8rem;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
