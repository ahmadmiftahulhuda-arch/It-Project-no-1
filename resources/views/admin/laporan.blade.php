<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Statistik - Admin Lab TI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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

        .dropdown-items .dropdown-item {
            padding: 10px 20px 10px 40px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            position: relative;
        }

        .dropdown-items .dropdown-item:hover,
        .dropdown-items .dropdown-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        .dropdown-items .dropdown-item i {
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

        /* Button Styles */
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
            color: white;
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

        .btn-success {
            background: var(--success);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(76, 175, 80, 0.2);
            color: white;
        }

        .btn-success:hover {
            background: #388e3c;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
        }

        /* Filter Section */
        .filter-section {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .filter-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-light);
            border-radius: 4px;
            outline: none;
            transition: all 0.3s;
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .filter-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 1px solid var(--border-light);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: white;
            opacity: 0.9;
        }

        .stat-icon.primary {
            background: var(--primary);
        }

        .stat-icon.success {
            background: var(--success);
        }

        .stat-icon.warning {
            background: var(--warning);
        }

        .stat-icon.danger {
            background: var(--danger);
        }

        .stat-info h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .stat-info p {
            margin: 0;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .stat-change {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Recent Activity */
        .activity-container {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            margin-bottom: 20px;
        }

        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-light);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            color: white;
            font-size: 1rem;
        }

        .activity-icon.primary {
            background: var(--primary);
        }

        .activity-icon.success {
            background: var(--success);
        }

        .activity-icon.warning {
            background: var(--warning);
        }

        .activity-icon.purple {
            background: #9b59b6;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .activity-desc {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .activity-time {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

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

            .menu-item {
                justify-content: center;
                padding: 15px;
            }

            .menu-item i,
            .dropdown-toggle-custom i:first-child {
                margin-right: 0;
            }

            .dropdown-toggle-custom {
                justify-content: center;
                padding: 15px;
            }

            .dropdown-toggle-custom i:last-child {
                display: none;
            }

            .dropdown-items .dropdown-item {
                padding: 10px 15px;
                justify-content: center;
            }

            .dropdown-items .dropdown-item span {
                display: none;
            }

            .dropdown-items .dropdown-item i {
                margin-right: 0;
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

            .stats-container {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .action-buttons {
                width: 100%;
                display: flex;
                gap: 10px;
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
        body.dark-mode .filter-section,
        body.dark-mode .stat-card,
        body.dark-mode .chart-card,
        body.dark-mode .activity-container {
            background: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .search-bar input,
        body.dark-mode .filter-group select {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        body.dark-mode .notification-btn,
        body.dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        body.dark-mode .page-title h1 {
            color: var(--text-dark);
        }

        body.dark-mode .section-title {
            color: var(--text-dark);
        }

        body.dark-mode .filter-group label {
            color: var(--text-dark);
        }

        body.dark-mode .activity-desc {
            color: var(--text-light);
        }

        body.dark-mode .dropdown-menu {
            background-color: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .dropdown-menu .dropdown-item {
            color: var(--text-dark);
        }

        body.dark-mode .dropdown-menu .dropdown-item:hover,
        body.dark-mode .dropdown-menu .dropdown-item:focus {
            background-color: var(--primary);
            color: white;
        }

        body.dark-mode .dropdown-menu .dropdown-divider {
            border-color: var(--border-light);
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama" aria-expanded="false" aria-controls="menuUtama">
                    <span>Menu Utama</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="menuUtama">
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
            
            <!-- Manajemen Peminjaman -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#peminjamanMenu" aria-expanded="false" aria-controls="peminjamanMenu">
                    <span>Manajemen Peminjaman</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="peminjamanMenu">
                    <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item">
                        <i class="fas fa-hand-holding"></i>
                        <span>Peminjaman</span>
                    </a>
                    <a href="{{ route('admin.pengembalian') }}" class="dropdown-item">
                        <i class="fas fa-undo"></i>
                        <span>Pengembalian</span>
                    </a>
                    <a href="{{ route('admin.riwayat') }}" class="dropdown-item">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Peminjaman</span>
                    </a>
                    <a href="{{ route('admin.feedback.index') }}" class="dropdown-item">
                        <i class="fas fa-comment"></i>
                        <span>Feedback</span>
                    </a>
                </div>
            </div>
            
            <!-- Manajemen Aset -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#asetMenu" aria-expanded="false" aria-controls="asetMenu">
                    <span>Manajemen Aset</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="asetMenu">
                    <a href="{{ route('projectors.index') }}" class="dropdown-item">
                        <i class="fas fa-video"></i>
                        <span>Proyektor</span>
                    </a>
                    <a href="{{ route('admin.ruangan.index') }}" class="dropdown-item">
                        <i class="fas fa-door-open"></i>
                        <span>Ruangan</span>
                    </a>
                </div>
            </div>
            
            <!-- Manajemen Akademik -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#akademikMenu" aria-expanded="false" aria-controls="akademikMenu">
                    <span>Manajemen Akademik</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="akademikMenu">
                    <a href="{{ route('jadwal-perkuliahan.index') }}" class="dropdown-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Perkuliahan</span>
                    </a>
                    <a href="{{ route('admin.slotwaktu.index') }}" class="dropdown-item">
                        <i class="fas fa-clock"></i>
                        <span>Slot Waktu</span>
                    </a>
                    <a href="{{ route('mata_kuliah.index') }}" class="dropdown-item">
                        <i class="fas fa-book"></i>
                        <span>Matakuliah</span>
                    </a>
                    <a href="{{ route('admin.kelas.index') }}" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Kelas</span>
                    </a>
                </div>
            </div>
            
            <!-- Manajemen Pengguna -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#penggunaMenu" aria-expanded="false" aria-controls="penggunaMenu">
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#laporanMenu" aria-expanded="true" aria-controls="laporanMenu">
                    <span>Laporan & Pengaturan</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse show" id="laporanMenu">
                    <a href="{{ route('admin.laporan') }}" class="dropdown-item active">
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
                    <a href="{{ route('admin.ahp.settings') }}" class="dropdown-item">
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
            <form class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari laporan...">
            </form>

            <div class="user-actions">
                <div class="notification-btn">
                    <i class="fas fa-bell"></i>
                </div>

                <div class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </div>

                <div class="dropdown">
                    <button class="user-profile dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">
                        <div class="user-avatar">
                            @auth
                                {{ substr(auth()->user()->name, 0, 1) }}
                            @else
                                A
                            @endauth
                        </div>
                        <div>
                            <div style="color: var(--text-dark);">
                                @auth
                                    {{ auth()->user()->name }}
                                @else
                                    Administrator
                                @endauth
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                                @auth
                                    {{ auth()->user()->peran ?? 'Admin' }}
                                @else
                                    Admin
                                @endauth
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><h6 class="dropdown-header">Selamat Datang, @auth {{ auth()->user()->name }} @else Pengguna @endauth</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog me-2"></i> Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Title -->
        <div class="page-title">
            <div>
                <h1>Laporan & Statistik</h1>
                <p>Analisis data dan statistik penggunaan Laboratorium Teknologi Informasi</p>
            </div>
            <div class="action-buttons">
                <button class="btn btn-outline" id="printBtn">
                    <i class="fas fa-print me-1"></i> Cetak
                </button>
                <button class="btn btn-primary" id="exportBtn">
                    <i class="fas fa-file-export me-1"></i> Ekspor
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="report-type">Jenis Laporan</label>
                    <select id="report-type">
                        <option value="peminjaman">Laporan Peminjaman</option>
                        <option value="penggunaan">Laporan Penggunaan</option>
                        <option value="inventaris">Laporan Inventaris</option>
                        <option value="pengguna">Laporan Pengguna</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="date-range">Rentang Waktu</label>
                    <select id="date-range">
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                        <option value="quarter">Kuartal Ini</option>
                        <option value="year">Tahun Ini</option>
                        <option value="custom">Kustom</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="department">Jurusan</label>
                    <select id="department">
                        <option value="">Semua Jurusan</option>
                        <option value="ti">Teknik Informatika</option>
                        <option value="si">Sistem Informasi</option>
                        <option value="tk">Teknik Komputer</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="generate-btn">&nbsp;</label>
                    <button class="btn btn-success" id="generateBtn" style="width: 100%; height: 41px;">
                        <i class="fas fa-sync-alt me-1"></i> Generate Laporan
                    </button>
                </div>
            </div>
        </div>

                <!-- Stats Cards -->

                <div class="stats-container">

                    <!-- Stat cards will be dynamically generated here -->

                </div>

                <!-- Charts Section -->

                <div class="charts-grid">

                    <div class="chart-card">

                        <div class="chart-header">

                            <div class="section-title" id="monthlyChartTitle">Statistik Peminjaman Bulanan</div>

                            <select id="yearSelect" style="padding: 8px 12px; border-radius: 4px; border: 1px solid var(--border-light); background: var(--bg-light); color: var(--text-dark); font-size: 0.9rem;">

                                @foreach($years as $year)

                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="chart-container">

                            <canvas id="monthlyChart"></canvas>

                        </div>

                    </div>

                    <div class="chart-card">

                        <div class="chart-header">

                            <div class="section-title" id="distributionChartTitle">Distribusi Peminjaman</div>

                        </div>

                        <div class="chart-container">

                            <canvas id="distributionChart"></canvas>

                        </div>

                    </div>

                </div>

        

                <!-- Recent Activity -->

                <div class="activity-container">

                    <div class="chart-header">

                        <div class="section-title">Aktivitas Terbaru</div>

                        <a href="{{ route('admin.riwayat') }}" class="view-all">Lihat Semua</a>

                    </div>

                    <ul class="activity-list" id="recentActivityList">

                        <!-- Activity items will be populated by JavaScript -->

                    </ul>

                </div>

            </div>

            <div class="menu-toggle" id="menu-toggle">

                <i class="fas fa-bars"></i>

            </div>

            <!-- Bootstrap JS -->

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <script>

                let monthlyChart, distributionChart;

                // Initialize when document is ready

                $(document).ready(function() {

                    initializeEventListeners();

                    initializeTheme();

                    // Generate report on page load

                    generateReport();

                });

                function initializeEventListeners() {

                    $('#theme-toggle').on('click', toggleTheme);

                    $('#menu-toggle').on('click', toggleSidebar);

                    $('#printBtn').on('click', () => window.print());

                    $('#exportBtn').on('click', exportReport);

                    $('#generateBtn').on('click', generateReport);

                    $('#yearSelect').on('change', generateReport);

                    $('#report-type').on('change', generateReport);

                }

                function initializeTheme() {

                    if (localStorage.getItem('darkMode') === 'enabled') {

                        document.body.classList.add('dark-mode');

                        $('#theme-toggle').html('<i class="fas fa-sun"></i>');

                    }

                }

                function toggleTheme() {

                    document.body.classList.toggle('dark-mode');

                    const isDarkMode = document.body.classList.contains('dark-mode');

                    localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');

                    $('#theme-toggle').html(isDarkMode ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>');

                    updateChartColors();

                }

                function toggleSidebar() {

                    // Implement sidebar toggle logic if needed, especially for mobile

                }

                function updateUI(data) {

                    const uiConfig = data.uiConfig;

                    const stats = data.stats;

        

                    // 1. Update Stats Cards dynamically

                    const statsContainer = $('.stats-container');

                    statsContainer.empty(); // Clear existing cards

                    const icons = ['fa-hand-holding', 'fa-laptop', 'fa-users', 'fa-times-circle'];

                    const colors = ['primary', 'success', 'warning', 'danger'];

                    let i = 0;

                    for (const key in stats) {

                        const title = uiConfig.stat_titles[i] || key;

                        const value = stats[key];

                        const icon = icons[i % icons.length];

                        const color = colors[i % colors.length];

        

                        const statCardHtml = `

                            <div class="stat-card">

                                <div class="stat-icon ${color}">

                                    <i class="fas ${icon}"></i>

                                </div>

                                <div class="stat-info">

                                    <h3>${value}</h3>

                                    <p>${title}</p>

                                </div>

                            </div>

                        `;

                        statsContainer.append(statCardHtml);

                        i++;

                    }

                     // 2. Update Chart Titles

                    $('#monthlyChartTitle').text(uiConfig.chart_titles[0]);

                    $('#distributionChartTitle').text(uiConfig.chart_titles[1]);

        

        

                    // 3. Update Recent Activity

                    const activityList = $('#recentActivityList');

                    activityList.empty();

                    if (data.recentActivity && data.recentActivity.length > 0) {

                        data.recentActivity.forEach(item => {

                            let iconClass = 'primary';

                            if (item.status === 'selesai' || item.status === 'disetujui') iconClass = 'success';

                            if (item.status === 'ditolak') iconClass = 'danger';

                            if (item.status === 'pending') iconClass = 'warning';

                            const activityHtml = `

                                <li class="activity-item">

                                    <div class="activity-icon ${iconClass}"><i class="fas fa-hand-holding"></i></div>

                                    <div class="activity-content">

                                        <div class="activity-title">${item.title}</div>

                                        <div class="activity-desc">${item.description}</div>

                                        <div class="activity-time">${item.time}</div>

                                    </div>

                                </li>`;

                            activityList.append(activityHtml);

                        });

                    } else {

                        activityList.append('<li class="text-center p-3 text-muted">Tidak ada aktivitas terbaru.</li>');

                    }

        

                    // 4. Update Charts

                    const isDarkMode = document.body.classList.contains('dark-mode');

                    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');

                    if (monthlyChart) {

                        monthlyChart.destroy();

                    }

                    monthlyChart = new Chart(monthlyCtx, {

                        type: 'bar',

                        data: {

                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],

                            datasets: [{

                                label: 'Jumlah',

                                data: data.monthlyChart,

                                backgroundColor: isDarkMode ? 'rgba(59, 89, 152, 0.7)' : 'rgba(59, 89, 152, 0.8)',

                                borderColor: isDarkMode ? 'rgba(59, 89, 152, 0.9)' : 'rgba(59, 89, 152, 1)',

                                borderWidth: 1,

                                borderRadius: 4

                            }]

                        },

                        options: getChartOptions()

                    });

        

                    const distributionCtx = document.getElementById('distributionChart').getContext('2d');

                    if (distributionChart) {

                        distributionChart.destroy();

                    }

                    distributionChart = new Chart(distributionCtx, {

                        type: 'doughnut',

                        data: {

                            labels: data.distributionChart.labels,

                            datasets: [{

                                data: data.distributionChart.data,

                                backgroundColor: ['rgba(59, 89, 152, 0.8)', 'rgba(76, 175, 80, 0.8)', 'rgba(255, 152, 0, 0.8)', 'rgba(155, 89, 182, 0.8)'],

                                borderColor: isDarkMode ? 'rgba(30, 30, 30, 0.8)' : 'rgba(255, 255, 255, 0.8)',

                                borderWidth: 2,

                                hoverOffset: 15

                            }]

                        },

                        options: getDoughnutChartOptions()

                    });

        

                    updateChartColors();

                }

        

                function getChartOptions() {

                    const isDarkMode = document.body.classList.contains('dark-mode');

                    return {

                        responsive: true,

                        maintainAspectRatio: false,

                        scales: {

                            y: {

                                beginAtZero: true,

                                grid: { color: isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)' },

                                ticks: { color: isDarkMode ? '#a0a0a0' : '#495057' }

                            },

                            x: {

                                grid: { display: false },

                                ticks: { color: isDarkMode ? '#a0a0a0' : '#495057' }

                            }

                        },

                        plugins: {

                            legend: { display: false },

                            tooltip: getTooltipOptions()

                        }

                    };

                }

                function getDoughnutChartOptions() {

                    const isDarkMode = document.body.classList.contains('dark-mode');

                    return {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {

                                position: 'bottom',

                                labels: {

                                    color: isDarkMode ? '#a0a0a0' : '#495057',

                                    padding: 20,

                                    usePointStyle: true,

                                    pointStyle: 'circle'

                                }

                            },

                            tooltip: getTooltipOptions()

                        }

                    };

                }

                function getTooltipOptions() {

                    const isDarkMode = document.body.classList.contains('dark-mode');

                    return {

                        backgroundColor: isDarkMode ? 'rgba(30, 30, 30, 0.9)' : 'rgba(255, 255, 255, 0.9)',

                        titleColor: isDarkMode ? '#fff' : '#000',

                        bodyColor: isDarkMode ? '#fff' : '#000',

                        borderColor: isDarkMode ? '#333' : '#ddd',

                        borderWidth: 1

                    };

                }

                function updateChartColors() {

                    const chartOptions = getChartOptions();

                    const doughnutOptions = getDoughnutChartOptions();

                    if (monthlyChart) {

                        const isDarkMode = document.body.classList.contains('dark-mode');

                        monthlyChart.options = chartOptions;

                        monthlyChart.data.datasets[0].backgroundColor = isDarkMode ? 'rgba(59, 89, 152, 0.7)' : 'rgba(59, 89, 152, 0.8)';

                        monthlyChart.data.datasets[0].borderColor = isDarkMode ? 'rgba(59, 89, 152, 0.9)' : 'rgba(59, 89, 152, 1)';

                        monthlyChart.update();

                    }

                    if (distributionChart) {

                        const isDarkMode = document.body.classList.contains('dark-mode');

                        distributionChart.options = doughnutOptions;

                        distributionChart.data.datasets[0].borderColor = isDarkMode ? 'rgba(30, 30, 30, 0.8)' : 'rgba(255, 255, 255, 0.8)';

                        distributionChart.update();

                    }

                }

                function generateReport() {

                    const reportType = $('#report-type').val();

                    const dateRange = $('#date-range').val();

                    const department = $('#department').val();

                    const year = $('#yearSelect').val();

                    const btn = $('#generateBtn');

                    const originalHtml = btn.html();

                    btn.html('<i class="fas fa-spinner fa-spin me-1"></i> Generating...');

                    btn.prop('disabled', true);

                    const url = `{{ route('admin.laporan.data') }}?report_type=${reportType}&date_range=${dateRange}&department=${department}&year=${year}`;

                    fetch(url, {

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                            'Accept': 'application/json'

                        }

                    })

                    .then(response => {

                        if (!response.ok) {

                            throw new Error('Network response was not ok');

                        }

                        return response.json();

                    })

                    .then(data => {

                        updateUI(data);

                        btn.html(originalHtml);

                        btn.prop('disabled', false);

                    })

                    .catch(error => {

                        console.error('Error fetching report data:', error);

                        alert('Gagal memuat data laporan. Silakan coba lagi.');

                        btn.html(originalHtml);

                        btn.prop('disabled', false);

                    });

                }

                function exportReport() {

                    const reportType = $('#report-type').val();

                    const dateRange = $('#date-range').val();

                    const department = $('#department').val();

                    const year = $('#yearSelect').val();

                    

                    // Note: You need to create a route and controller method for this export.

                    // For example: Route::get('/admin/laporan/export', [AdminController::class, 'exportReport'])->name('admin.laporan.export');

                    const exportUrl = `{{ route('admin.laporan') }}/export?report_type=${reportType}&date_range=${dateRange}&department=${department}&year=${year}`;

                    

                    alert(`Fungsi ekspor belum diimplementasikan di backend. URL yang akan digunakan: ${exportUrl}`);

                    // window.location.href = exportUrl; // Uncomment this line when backend is ready

                }

            </script>

        </body>

        </html>

        

        