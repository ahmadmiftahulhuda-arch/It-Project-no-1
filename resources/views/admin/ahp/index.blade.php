<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan AHP - Sistem Manajemen Peminjaman</title>
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

        .menu-section {
            padding: 0 15px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 600;
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

        .menu-item span {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Dropdown Menu Styles */
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

        .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
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

        /* Page Title */
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

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* AHP Container */
        .ahp-container {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            margin-bottom: 30px;
        }

        .ahp-title {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ahp-title i {
            color: var(--primary);
        }

        /* Matrix Table */
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

        /* Result Cards */
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

        /* Eigenvector List */
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

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h2,
            .menu-item span,
            .dropdown-toggle-custom span {
                display: none;
            }

            .menu-item,
            .dropdown-toggle-custom {
                justify-content: center;
                padding: 15px;
            }

            .menu-item i,
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

        /* Dark Mode */
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

        body.dark-mode .page-title h1 {
            color: var(--text-dark);
        }

        body.dark-mode .page-title p {
            color: var(--text-light);
        }

        .menu-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            display: none;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }
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
                    <a href="/admin/pengaturan" class="dropdown-item">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan Sistem</span>
                    </a>
                </div>
            </div>
            <!-- Sistem Pendukung Keputusan -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#spkMenu" aria-expanded="true" aria-controls="spkMenu">
                    <span>Sistem TPK</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse show" id="spkMenu">
                    <a href="{{ route('admin.ahp.settings') }}" class="dropdown-item active">
                        <i class="fas fa-sliders-h"></i>
                        <span>Pengaturan AHP</span>
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
                <h1>Pengaturan AHP</h1>
                <p>Analytic Hierarchy Process - Pairwise Comparison untuk Sistem Pendukung Keputusan</p>
            </div>
        </div>

        <!-- AHP Container -->
        <div class="ahp-container">
            <h2 class="ahp-title">
                <i class="fas fa-sliders-h"></i>
                Pairwise Comparison Matrix
            </h2>

            <form method="POST" action="{{ route('admin.ahp.settings.save') }}">
                @csrf

                <div class="matrix-container">
                    <table class="matrix-table">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>K1</th>
                                <th>K2</th>
                                <th>K3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 3; $i++)
                                <tr>
                                    <td class="criteria-header">K{{ $i+1 }}</td>
                                    @for ($j = 0; $j < 3; $j++)
                                        <td>
                                            @if ($i == $j)
                                                <input type="number" name="matrix[{{$i}}][{{$j}}]" 
                                                       value="1.00" step="0.01" readonly 
                                                       style="background-color: #f0f0f0;">
                                            @else
                                                <input type="number" name="matrix[{{$i}}][{{$j}}]" 
                                                       step="0.01" required 
                                                       placeholder="0.00">
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-calculator me-2"></i>Hitung AHP
                    </button>
                </div>
            </form>

            <!-- Hasil Perhitungan -->
            @if (session('matrix'))
                <div class="mt-5">
                    <h2 class="ahp-title">
                        <i class="fas fa-chart-bar"></i>
                        Hasil Perhitungan AHP
                    </h2>

                    <!-- Result Cards -->
                    <div class="result-container">
                        <div class="result-card success">
                            <div class="result-label">Consistency Ratio (CR)</div>
                            <div class="result-value">{{ number_format(session('CR'), 4) }}</div>
                            <small class="text-muted">
                                @if(session('CR') < 0.1)
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

                        <div class="result-card {{ session('status') == 'Konsisten' ? 'success' : 'danger' }}">
                            <div class="result-label">Status</div>
                            <div class="result-value">
                                @if(session('status') == 'Konsisten')
                                    <i class="fas fa-check-circle"></i>
                                @else
                                    <i class="fas fa-exclamation-circle"></i>
                                @endif
                            </div>
                            <small class="text-muted">{{ session('status') }}</small>
                        </div>
                    </div>

                    <!-- Eigenvector -->
                    <div class="eigenvector-container">
                        <h3 class="eigenvector-title">
                            <i class="fas fa-weight-hanging me-2"></i>
                            Eigenvector (Bobot Prioritas)
                        </h3>
                        <ul class="eigenvector-list">
                            @foreach (session('eigenvector') as $index => $ev)
                                <li class="eigenvector-item">
                                    <span class="eigenvector-label">K{{ $index + 1 }}</span>
                                    <span class="eigenvector-value">{{ number_format($ev, 4) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Matrix yang diinput -->
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <i class="fas fa-table me-2"></i>
                            Matrix yang Diinput
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @for ($i = 0; $i < 3; $i++)
                                            <th class="text-center">K{{ $i+1 }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(session('matrix') as $i => $row)
                                        <tr>
                                            <th class="text-center">K{{ $i+1 }}</th>
                                            @foreach($row as $value)
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
        </div>

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
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

            // Toggle sidebar on mobile
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.querySelector('.sidebar');

            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });

            // Auto-fill reciprocal values
            const matrixInputs = document.querySelectorAll('.matrix-table input[type="number"]');
            
            matrixInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const name = this.name;
                    const matches = name.match(/matrix\[(\d+)\]\[(\d+)\]/);
                    
                    if (matches) {
                        const row = parseInt(matches[1]);
                        const col = parseInt(matches[2]);
                        
                        // Skip diagonal
                        if (row !== col) {
                            const reciprocalInput = document.querySelector(`input[name="matrix[${col}][${row}]"]`);
                            if (reciprocalInput && this.value !== '') {
                                const value = parseFloat(this.value);
                                if (value > 0) {
                                    reciprocalInput.value = (1 / value).toFixed(2);
                                }
                            }
                        }
                    }
                });
            });

            // Validate matrix values on submit
            document.querySelector('form').addEventListener('submit', function(e) {
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
                    alert('Harap isi semua nilai perbandingan!');
                }
            });

            // Terapkan dark mode jika sebelumnya diaktifkan
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }

            // Tooltip untuk nilai perbandingan
            const tooltipInfo = `
                <div class="mt-3 p-3 bg-light border rounded">
                    <h6><i class="fas fa-info-circle me-2 text-primary"></i>Petunjuk Pengisian:</h6>
                    <small class="text-muted d-block mb-1">• Nilai 1: Kedua kriteria sama penting</small>
                    <small class="text-muted d-block mb-1">• Nilai 3: Kriteria sedikit lebih penting</small>
                    <small class="text-muted d-block mb-1">• Nilai 5: Kriteria lebih penting</small>
                    <small class="text-muted d-block mb-1">• Nilai 7: Kriteria sangat penting</small>
                    <small class="text-muted d-block mb-1">• Nilai 9: Kriteria mutlak lebih penting</small>
                    <small class="text-muted">• Nilai genap (2,4,6,8): Nilai antara</small>
                </div>
            `;

            // Add tooltip after matrix table
            const matrixContainer = document.querySelector('.matrix-container');
            if (matrixContainer) {
                matrixContainer.insertAdjacentHTML('afterend', tooltipInfo);
            }
        </script>
    </div>
</body>
</html>