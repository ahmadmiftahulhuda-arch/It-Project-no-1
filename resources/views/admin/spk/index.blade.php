@php
    $peminjamans = $peminjamans ?? [];
    $scores = $scores ?? [];
    $rankings = $rankings ?? [];
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Peminjaman - AHP & SAW</title>
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

        .ahp-container,
        .spk-container,
        .ranking-container {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 30px;
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

        .matrix-container {
            overflow-x: auto;
            margin-bottom: 30px;
        }

        .matrix-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .matrix-table th {
            background: var(--primary);
            color: white;
            padding: 15px;
            font-weight: 600;
            text-align: center;
            border: none;
        }

        .matrix-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid var(--border-light);
            background: white;
        }

        .matrix-table .criteria-header {
            background: #f0f4ff;
            font-weight: 600;
            color: var(--dark);
            border: none;
        }

        .matrix-table input {
            width: 80px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s;
        }

        .matrix-table input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.1);
            outline: none;
        }

        .result-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .result-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            text-align: center;
        }

        .result-card .result-value {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .result-card .result-label {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0;
        }

        .result-card.success .result-value {
            color: var(--success);
        }

        .result-card.warning .result-value {
            color: var(--warning);
        }

        .result-card.danger .result-value {
            color: var(--danger);
        }

        .eigenvector-container {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            margin-top: 30px;
        }

        .eigenvector-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark);
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 10px;
        }

        .eigenvector-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .eigenvector-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 8px;
            background: #f8f9fa;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .eigenvector-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .eigenvector-label {
            font-weight: 500;
            color: var(--dark);
        }

        .eigenvector-value {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
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
        body.dark-mode .ahp-container,
        body.dark-mode .spk-container,
        body.dark-mode .ranking-container,
        body.dark-mode .result-card,
        body.dark-mode .eigenvector-container {
            background: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .matrix-table {
            background: #2a2a2a;
        }

        body.dark-mode .matrix-table td {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        body.dark-mode .matrix-table th {
            background: var(--primary);
            color: white;
        }

        body.dark-mode .matrix-table .criteria-header {
            background: #3a3a3a;
            color: var(--text-dark);
        }

        body.dark-mode .matrix-table input {
            background: #3a3a3a;
            border-color: #555;
            color: var(--text-dark);
        }

        body.dark-mode .eigenvector-item {
            background: #2a2a2a;
        }

        body.dark-mode .eigenvector-item:hover {
            background: #3a3a3a;
        }

        body.dark-mode .notification-btn,
        body.dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
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
                    <a href="{{ route('admin.spk.index') }}" class="dropdown-item active">
                        <i class="fas fa-sliders-h"></i>
                        <span>AHP & SAW</span>
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
                <h1>SPK Peminjaman Ruang & Proyektor</h1>
                <p>Integrasi AHP (Bobot Kriteria) & SAW (Perankingan Peminjaman)</p>
            </div>
        </div>

        {{-- ALERT SUCCESS / ERROR --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- BAGIAN A: AHP – Bobot Kriteria -->
        <div class="ahp-container">
            <h2 class="section-title">
                <i class="fas fa-sliders-h"></i>
                A. Pengaturan Bobot Kriteria (AHP)
            </h2>

            <p class="text-muted mb-3">
                Lengkapi matriks perbandingan berpasangan antar kriteria. Nilai akan digunakan sebagai bobot
                pada metode SAW untuk menentukan prioritas peminjaman.
            </p>

            <form method="POST" action="{{ route('admin.ahp.settings.save') }}">
                @csrf

                <div class="matrix-container">
                    <table class="matrix-table">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                @foreach ($criteria as $c)
                                    <th>{{ $c->kode }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($criteria as $i => $rowCriteria)
                                <tr>
                                    <td class="criteria-header">
                                        {{ $rowCriteria->kode }} - {{ $rowCriteria->nama }}
                                    </td>
                                    @foreach ($criteria as $j => $colCriteria)
                                        <td>
                                            @if ($i === $j)
                                                <input type="number"
                                                    name="matrix[{{ $i }}][{{ $j }}]"
                                                    value="1.00" step="0.01" readonly
                                                    style="background-color: #f0f0f0;">
                                            @else
                                                <input type="number"
                                                    name="matrix[{{ $i }}][{{ $j }}]"
                                                    step="any" min="0.111"
                                                    value="{{ old("matrix.$i.$j", $i === $j ? 1 : '') }}"
                                                    {{ $i === $j ? 'readonly' : 'required' }}>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-calculator me-2"></i>Hitung AHP & Simpan Bobot
                    </button>
                </div>
            </form>

            <!-- Hasil Perhitungan AHP -->
            @if (session('matrix'))
                <div class="mt-5">
                    <h3 class="section-title">
                        <i class="fas fa-chart-bar"></i>
                        Hasil Perhitungan AHP
                    </h3>

                    <!-- Result Cards -->
                    <div class="result-container">
                        <div class="result-card success">
                            <div class="result-label">Consistency Ratio (CR)</div>
                            <div class="result-value">{{ number_format(session('CR'), 4) }}</div>
                            <small class="text-muted">
                                @if (session('CR') < 0.1)
                                    <span class="text-success">✓ Konsisten</span>
                                @else
                                    <span class="text-danger">✗ Tidak Konsisten</span>
                                @endif
                            </small>
                        </div>

                        <div class="result-card warning">
                            <div class="result-label">Consistency Index (CI)</div>
                            <div class="result-value">{{ number_format(session('CI'), 4) }}</div>
                            <small class="text-muted">Indeks Konsistensi</small>
                        </div>

                        <div class="result-card">
                            <div class="result-label">λ Max</div>
                            <div class="result-value">{{ number_format(session('lambdaMax'), 4) }}</div>
                            <small class="text-muted">Nilai Eigen Maksimum</small>
                        </div>

                        <div class="result-card {{ session('status') == 'KONSISTEN' ? 'success' : 'danger' }}">
                            <div class="result-label">Status</div>
                            <div class="result-value">
                                @if (session('status') == 'KONSISTEN')
                                    <i class="fas fa-check-circle"></i>
                                @else
                                    <i class="fas fa-exclamation-circle"></i>
                                @endif
                            </div>
                            <small class="text-muted">{{ session('status') }}</small>
                        </div>
                    </div>

                    <!-- Eigenvector -->
                    @if (session('eigenvector'))
                        <div class="eigenvector-container">
                            <h4 class="eigenvector-title">
                                <i class="fas fa-weight-hanging me-2"></i>
                                Eigenvector (Bobot Prioritas Kriteria)
                            </h4>
                            <ul class="eigenvector-list">
                                @foreach (session('eigenvector') as $index => $ev)
                                    <li class="eigenvector-item">
                                        <span class="eigenvector-label">
                                            {{ $criteria->get($index)->kode }} - {{ $criteria[$index]->nama }}
                                        </span>
                                        <span class="eigenvector-value">
                                            {{ round($ev, 8) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Matrix yang diinput -->
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <i class="fas fa-table me-2"></i>
                            Matrix Perbandingan yang Diinput
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        @foreach ($criteria as $c)
                                            <th class="text-center">{{ $c->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('matrix') as $i => $row)
                                        <tr>
                                            <th class="text-center">
                                                {{ $criteria[$i]->kode }}
                                            </th>
                                            @foreach ($row as $value)
                                                <td class="text-center">{{ number_format($value, 4) }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tooltip Petunjuk Pengisian --}}
            <div class="mt-3 p-3 bg-light border rounded">
                <h6><i class="fas fa-info-circle me-2 text-primary"></i>Petunjuk Pengisian Nilai AHP:</h6>
                <small class="text-muted d-block mb-1">• Nilai 1: Kedua kriteria sama penting</small>
                <small class="text-muted d-block mb-1">• Nilai 3: Kriteria baris sedikit lebih penting dari
                    kolom</small>
                <small class="text-muted d-block mb-1">• Nilai 5: Kriteria baris lebih penting</small>
                <small class="text-muted d-block mb-1">• Nilai 7: Kriteria baris sangat lebih penting</small>
                <small class="text-muted d-block mb-1">• Nilai 9: Kriteria baris mutlak lebih penting</small>
                <small class="text-muted">• Nilai genap (2,4,6,8): nilai kompromi antara skala di atas</small>
            </div>
        </div>

        <!-- BAGIAN B: INPUT PENILAIAN PEMINJAMAN (SPK) -->
        <!-- Filter Tanggal -->
        <div class="mb-3">
            <label for="filter-date" class="form-label">Filter Tanggal Peminjaman</label>
            <form method="GET" action="{{ route('admin.spk.index') }}">
                <input type="date" id="filter-date" class="form-control" name="filter_date"
                    value="{{ old('filter_date', $filterDate) }}" onchange="this.form.submit()">
            </form>
        </div>

        <div class="spk-container">
            <h2 class="section-title">
                <i class="fas fa-list-check"></i>
                B. Penilaian Alternatif Peminjaman (SPK)
            </h2>

            <p class="text-muted mb-3">
                Berikan nilai setiap peminjaman berdasarkan kriteria yang ada.
                Nilai ini akan dinormalisasi dan dikalikan bobot (hasil AHP) untuk perankingan SAW.
            </p>

            <form action="{{ route('admin.spk.scores.save') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered table-spk align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Keperluan (K1)</th>
                                <th>Tanggal Pinjam (K2)</th>
                                <th>Jam (K3)</th>
                                <th>Catatan Riwayat (K4)</th>
                                <th>Sarana Prasarana (K5)</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($peminjamans as $p)
                                @php
                                    // ======================
                                    // K1 KEPERLUAN (DARI TEKS USER)
                                    // ======================
                                    $mapKeperluan = [
                                        'perkuliahan' => 5,
                                        'kelas pengganti' => 4,
                                        'seminar' => 3,
                                        'pkl' => 3,
                                        'proposal' => 3,
                                        'ujikom' => 3,
                                        'mentoring' => 2,
                                        'belajar' => 2,
                                        'konsultasi' => 1,
                                        'uas' => 1,
                                    ];

                                    $k1 = 1;
                                    foreach ($mapKeperluan as $key => $val) {
                                        if (str_contains(strtolower($p->keperluan), $key)) {
                                            $k1 = $val;
                                            break;
                                        }
                                    }

                                    // ======================
                                    // K2 TANGGAL (SESUAI EXCEL)
                                    // ======================
                                    $k2 = 1;

                                    // ======================
                                    // K3 JAM → menit dari jam input
                                    // ======================
                                    $jamInput = \Carbon\Carbon::parse($p->created_at);
                                    $k3 = $jamInput->hour * 60 + $jamInput->minute;

                                    // ======================
                                    // K4 CATATAN RIWAYAT (DARI FEEDBACK)
                                    // ======================
                                    $k4 = 1; // default
                                    if ($p->feedback) {
                                        if ($p->feedback->rating === 'cukup') {
                                            $k4 = 0.5;
                                        }
                                        if ($p->feedback->rating === 'buruk') {
                                            $k4 = 0;
                                        }
                                    }

                                    // ======================
                                    // K5 SARANA PRASARANA
                                    // ======================
                                    $k5 = $p->ruangan && $p->projector ? 2 : 1;
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    {{-- Nama --}}
                                    <td>{{ $p->user->name }}</td>

                                    {{-- K1 Keperluan --}}
                                    <td class="text-center">
                                        {{ $k1 }}
                                        <input type="hidden" name="scores[{{ $p->id }}][K1]"
                                            value="{{ $k1 }}">
                                    </td>

                                    {{-- K2 Tanggal --}}
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}
                                        <input type="hidden" name="scores[{{ $p->id }}][K2]"
                                            value="{{ $k2 }}">
                                    </td>

                                    {{-- K3 Jam (dalam menit) --}}
                                    <td class="text-center">
                                        {{ $k3 }} menit
                                        <input type="hidden" name="scores[{{ $p->id }}][K3]"
                                            value="{{ $k3 }}">
                                    </td>

                                    {{-- K4 Catatan Riwayat --}}
                                    <td class="text-center">
                                        {{ $k4 }}
                                        <input type="hidden" name="scores[{{ $p->id }}][K4]"
                                            value="{{ $k4 }}">
                                    </td>

                                    {{-- K5 Sarana Prasarana --}}
                                    <td class="text-center">
                                        {{ $k5 }}
                                        <input type="hidden" name="scores[{{ $p->id }}][K5]"
                                            value="{{ $k5 }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if (count($peminjamans))
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Penilaian & Hitung SAW
                        </button>
                    </div>
                @endif
            </form>
            {{-- PETUNJUK KONVERSI NILAI SPK --}}
            <div class="mt-4 p-3 bg-light border rounded">
                <h6 class="fw-bold mb-2">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    Petunjuk Konversi Nilai SPK
                </h6>

                <ul class="mb-0 small text-muted">
                    <li>
                        <strong>K3 – Jam (Cost):</strong>
                        Jam dikonversi ke menit dengan rumus
                        <code>HH:MM → (HH × 60) + MM</code>.
                        Semakin kecil nilai, semakin diprioritaskan.
                    </li>

                    <li>
                        <strong>K1 – Keperluan:</strong>
                        <ul>
                            <li>Perkuliahan = 5</li>
                            <li>Kelas Pengganti = 4</li>
                            <li>Seminar / TA / PKL / Proposal / Ujikom = 3</li>
                            <li>Mentoring / Belajar Bersama = 2</li>
                            <li>Konsultasi KRS / UAS / UTS = 1</li>
                        </ul>
                    </li>

                    <li>
                        <strong>K5 – Sarana Prasarana:</strong>
                        <ul>
                            <li>Ruangan + Proyektor = 2</li>
                            <li>Ruangan saja = 1</li>
                        </ul>
                    </li>

                    <li>
                        <strong>K4 – Catatan Riwayat:</strong>
                        <ul>
                            <li>Baik = 1</li>
                            <li>Kurang Baik = 0.5</li>
                        </ul>
                    </li>

                    <li>
                        <strong>K2 – Tanggal Pinjam:</strong>
                        Semua peminjaman diberi nilai <strong>1</strong>.
                    </li>
                </ul>
            </div>

        </div>

<!-- BAGIAN C: HASIL RANKING SAW -->
<div class="ranking-container">
    <h2 class="section-title">
        <i class="fas fa-ranking-star"></i>
        C. Hasil Perankingan Peminjaman (SAW)
    </h2>

    <p class="text-muted mb-3">
        Tabel berikut menampilkan nilai preferensi dan urutan prioritas peminjaman
        berdasarkan metode SAW dengan bobot dari AHP.
    </p>

    @if (!empty($rankings) && count($rankings) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th class="text-center">Peringkat</th>
                        <th>Kode Peminjaman</th>
                        <th>Peminjam</th>
                        <th>Ruang / Proyektor</th>
                        <th>Tanggal & Jam</th>
                        <th class="text-center">Nilai Preferensi</th>
                        <th class="text-center">Status Prioritas</th>
                        <th>Detail Perhitungan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankings as $idx => $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $idx + 1 }}</td>
                            <td>{{ $item->kode_peminjaman ?? 'PMJ-' . $item->id }}</td>
                            <td>{{ $item->user->name ?? ($item->nama_peminjam ?? '-') }}</td>
                            <td>
                                <strong>Ruang:</strong>
                                {{ $item->ruangan->nama_ruangan ?? '-' }}<br>
                                <strong>Proyektor:</strong>
                                {{ $item->projector->kode_proyektor ?? '-' }}
                            </td>
                            <td>
                                <strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}<br>
                                <strong>Jam:</strong>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                            </td>
                            <td class="text-center fw-bold">
                                {{ number_format($item->nilai_preferensi, 4) ?? '0' }}
                            </td>
                            <td class="text-center">
                                @if ($idx === 0)
                                    <span class="badge bg-success badge-priority">
                                        Prioritas Utama
                                    </span>
                                @elseif($idx < 3)
                                    <span class="badge bg-info badge-priority">
                                        Prioritas Tinggi
                                    </span>
                                @else
                                    <span class="badge bg-secondary badge-priority">
                                        Prioritas Normal
                                    </span>
                                @endif
                            </td>
                            <td>
                                <!-- Show calculation details -->
                                <button class="btn btn-info btn-sm" data-bs-toggle="collapse" data-bs-target="#details-{{ $item->id }}">
                                    Lihat Detail
                                </button>
                                <div id="details-{{ $item->id }}" class="collapse mt-2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <th>Nilai</th>
                                                <th>Normalisasi</th>
                                                <th>Bobot</th>
                                                <th>Nilai x Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($calculationDetails[$item->id] as $detail)
                                                <tr>
                                                    <td>{{ $detail['criterion'] }}</td>
                                                    <td>{{ $detail['nilai'] }}</td>
                                                    <td>{{ number_format($detail['normalisasi'], 4) }}</td>
                                                    <td>{{ number_format($detail['bobot'], 4) }}</td>
                                                    <td>{{ number_format($detail['nilai_bobot'], 4) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info mb-0">
            <i class="fas fa-info-circle me-2"></i>
            Belum ada hasil perankingan. Silakan isi penilaian pada bagian B dan klik
            <strong>"Simpan Penilaian & Hitung SAW"</strong>.
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
                } else {
                    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                    localStorage.setItem('darkMode', 'disabled');
                }
            });

            // Terapkan dark mode jika sebelumnya diaktifkan
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }

            // Auto-fill reciprocal values untuk matrix AHP
            const matrixInputs = document.querySelectorAll('.matrix-table input[type="number"]');

            matrixInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const name = this.name;
                    const matches = name.match(/matrix\[(\d+)\]\[(\d+)\]/);

                    if (matches) {
                        const row = parseInt(matches[1]);
                        const col = parseInt(matches[2]);

                        if (row !== col) {
                            const reciprocalInput = document.querySelector(
                                `input[name="matrix[${col}][${row}]"]`
                            );
                            if (reciprocalInput && this.value !== '') {
                                const value = parseFloat(this.value);
                                if (value > 0) {
                                    reciprocalInput.value = (1 / value).toFixed(8);
                                }
                            }
                        }
                    }
                });
            });

            // Validasi AHP matrix
            const ahpForm = document.querySelector('.ahp-container form');
            ahpForm.addEventListener('submit', function(e) {
                let isValid = true;
                const inputs = this.querySelectorAll('input[type="number"]:not([readonly])');

                inputs.forEach(input => {
                    if (input.value === '' || isNaN(parseFloat(input.value))) {
                        isValid = false;
                        input.style.borderColor = 'var(--danger)';
                    } else {
                        input.style.borderColor = '';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Harap isi semua nilai perbandingan matriks AHP!');
                }
            });
        </script>
</body>

</html>
