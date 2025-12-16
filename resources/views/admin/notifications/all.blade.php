<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin TI - Semua Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Base styles from settings/index.blade.php */
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

        /* Dark Mode Variables - copied for consistency */
        .dark-mode {
            --primary: #4a6fa5;
            --secondary: #5d7ba6;
            --light: #1a1d23;
            --dark: #f0f0f0;
            --bg-light: #121212;
            --bg-card: #1e1e1e;
            --text-dark: #e0e0e0;
            --text-light: #a0a0a0;
            --border-light: #333;
            --gray: #8b8b8b;
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

        /* Dropdown Menu Styles - Tanpa Icon Dropdown */
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

        /* ============================
           IMPROVED HEADER STYLES
           ============================ */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid var(--border-light);
        }

        .dark-mode .header {
            background: var(--bg-card);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            z-index: 2;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-light);
            border-radius: 30px;
            outline: none;
            transition: all 0.3s;
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .search-bar input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .dark-mode .search-bar input {
            background-color: #2a2a2a;
            border-color: var(--border-light);
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

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
            border: none;
        }

        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        .dark-mode .theme-toggle:hover {
            background: #3a3a3a;
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

        /* Dark Mode for Header Dropdown */
        .dark-mode .dropdown-menu {
            background-color: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .dropdown-menu .dropdown-item {
            color: var(--text-dark);
        }

        .dark-mode .dropdown-menu .dropdown-item:hover,
        .dark-mode .dropdown-menu .dropdown-item:focus {
            background-color: var(--primary);
            color: white;
        }

        .dark-mode .dropdown-menu .dropdown-divider {
            border-color: var(--border-light);
        }

        /* ============================
           IMPROVED PAGE TITLE
           ============================ */
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding: 0 5px;
        }

        .page-title h1 {
            color: var(--dark);
            margin-bottom: 5px;
            font-weight: 700;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-title p {
            color: var(--text-light);
            margin: 0;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(59, 89, 152, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 89, 152, 0.3);
            color: white;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* ============================
           NOTIFICATION PAGE SPECIFIC STYLES
           ============================ */
        .notification-page-content {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-light);
        }

        .dark-mode .notification-page-content {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
        }

        /* Notification Header */
        .notification-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-light);
        }

        .notification-page-header h2 {
            color: var(--dark);
            margin: 0;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
        }

        /* Notification List */
        .notification-list-full {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 600px;
            overflow-y: auto;
        }

        .notification-list-full::-webkit-scrollbar {
            width: 6px;
        }

        .notification-list-full::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 3px;
        }

        .notification-list-full::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 3px;
        }

        .notification-list-full::-webkit-scrollbar-thumb:hover {
            background: var(--gray);
        }

        /* Notification Item */
        .notification-item {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            position: relative;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background-color: rgba(59, 89, 152, 0.05);
            transform: translateX(5px);
        }

        .dark-mode .notification-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .notification-item.unread {
            background-color: rgba(59, 89, 152, 0.08);
            border-left: 4px solid var(--primary);
        }

        .dark-mode .notification-item.unread {
            background-color: rgba(59, 89, 152, 0.15);
        }

        /* Notification Icon */
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.1rem;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .notification-icon.info {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1976d2;
        }

        .notification-icon.success {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
        }

        .notification-icon.warning {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #f57c00;
        }

        .notification-icon.danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #d32f2f;
        }

        /* Notification Content */
        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
            font-size: 0.95rem;
            line-height: 1.4;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .notification-message {
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .notification-time {
            font-size: 0.75rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Notification Actions */
        .notification-item-actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .notification-item-actions .btn {
            padding: 5px 12px;
            font-size: 0.8rem;
        }

        /* Empty State */
        .notification-empty {
            padding: 60px 20px;
            text-align: center;
            color: var(--text-light);
        }

        .notification-empty i {
            font-size: 3.5rem;
            margin-bottom: 20px;
            opacity: 0.5;
            color: var(--primary);
        }

        .notification-empty h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .notification-empty p {
            margin: 0;
            font-size: 0.95rem;
            max-width: 300px;
            margin: 0 auto;
        }

        /* Filter Tabs */
        .notification-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-light);
        }

        .notification-tab {
            padding: 8px 16px;
            border-radius: 8px;
            background: transparent;
            border: 1px solid var(--border-light);
            color: var(--text-light);
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .notification-tab:hover {
            background-color: rgba(59, 89, 152, 0.05);
            color: var(--primary);
        }

        .notification-tab.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-color: transparent;
        }

        /* Badge */
        .notification-badge {
            background: linear-gradient(135deg, #ff4757, #ff3838);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 8px;
        }

        /* Status Indicator */
        .notification-status {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
            position: absolute;
            top: 20px;
            right: 20px;
            opacity: 0.8;
        }

        .notification-item.read .notification-status {
            opacity: 0.3;
        }

        /* Loading State */
        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-light);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ============================
           RESPONSIVE STYLES
           ============================ */
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

            .menu-item i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 70px;
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .search-bar {
                width: 100%;
            }

            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-title h1 {
                font-size: 1.5rem;
            }

            .notification-page-content {
                padding: 20px;
            }

            .notification-page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .notification-actions {
                width: 100%;
                justify-content: flex-end;
            }

            .notification-item {
                padding: 15px;
            }

            .notification-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 10px;
            }

            .notification-page-content {
                padding: 15px;
            }

            .notification-item {
                flex-direction: column;
                gap: 10px;
                padding: 12px;
            }

            .notification-title {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification-tabs {
                flex-wrap: wrap;
            }

            .notification-tab {
                flex: 1;
                min-width: calc(50% - 5px);
                text-align: center;
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .notification-page-content,
        .notification-item,
        .btn {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Notification Toast Container -->
    <div class="notification-toast-container"></div>
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
                </button>
                <div class="dropdown-items collapse" id="spkMenu">
                    <a href="{{ route('admin.spk.index') }}" class="dropdown-item">
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
                <input type="text" placeholder="Cari notifikasi..." id="searchNotifications">
            </div>

            <div class="user-actions">
                <div class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </div>

                <!-- User Profile -->
                <div class="dropdown">
                    <button class="user-profile dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">
                        <div class="user-avatar">
                            @auth
                                {{ substr(auth()->user()->name, 0, 1) }}
                            @elseif(isset($user) && $user)
                                {{ substr($user->name, 0, 1) }}
                            @else
                                A
                            @endauth
                        </div>
                        <div>
                            <div style="color: var(--text-dark);">
                                @auth
                                    {{ auth()->user()->name }}
                                @elseif(isset($user) && $user)
                                    {{ $user->name }}
                                @else
                                    Administrator
                                @endauth
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                                @auth
                                    {{ auth()->user()->peran ?? auth()->user()->role ?? 'Admin' }}
                                @elseif(isset($user) && $user)
                                    {{ $user->peran ?? $user->role ?? 'Admin' }}
                                @else
                                    Admin
                                @endauth
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><h6 class="dropdown-header">Selamat Datang, @auth {{ auth()->user()->name }} @else Pengguna @endauth</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}#profile"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
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
                <h1>Semua Notifikasi</h1>
                <p>Kelola dan pantau semua notifikasi sistem</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline" id="markAllReadBtn">
                    <i class="fas fa-check-double"></i> Tandai Semua Dibaca
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>



        <div class="notification-page-content">
            <!-- Notification Header -->
            <div class="notification-page-header">
                <h2>
                    <i class="fas fa-bell me-2"></i>Notifikasi Terbaru
                </h2>
                <div class="notification-actions">
                    <button class="btn btn-outline btn-sm" id="refreshNotifications">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                    <button class="btn btn-outline btn-sm" id="clearNotifications">
                        <i class="fas fa-trash"></i> Hapus Semua
                    </button>
                </div>
            </div>

            <!-- Notification List -->
            <ul class="notification-list-full" id="notificationList">
                @forelse ($notifications as $notif)
                    <li class="notification-item unread" 
                        data-id="{{ $notif['id'] }}"
                        data-read="false"
                        data-important="false"
                        onclick="window.location.href='{{ $notif['url'] }}'">
                        <div class="notification-icon {{ $notif['type'] }}">
                            <i class="fas {{ $notif['icon'] }}"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">
                                <span>{{ $notif['title'] }}</span>
                            </div>
                            <div class="notification-message">{{ $notif['message'] }}</div>
                            <div class="notification-time">
                                <i class="far fa-clock"></i>
                                <span>{{ $notif['time'] }}</span>
                            </div>
                        </div>
                        <div class="notification-status"></div>
                    </li>
                @empty
                    <div class="notification-empty">
                        <i class="fas fa-bell-slash"></i>
                        <h3>Tidak Ada Notifikasi</h3>
                        <p>Semua notifikasi telah ditangani. Anda akan mendapatkan notifikasi baru saat ada aktivitas.</p>
                    </div>
                @endforelse
            </ul>

            <!-- Loading Spinner (hidden by default) -->
            <div class="loading-spinner" id="loadingSpinner" style="display: none;">
                <div class="spinner"></div>
                <p>Memuat notifikasi...</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown toggles
            const dropdownToggle = document.querySelectorAll('.dropdown-toggle-custom');
            dropdownToggle.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const target = document.querySelector(this.dataset.bsTarget);
                    if (target) {
                        const isShown = target.classList.contains('show');
                        this.setAttribute('aria-expanded', !isShown);
                        if (isShown) {
                            target.classList.remove('show');
                        } else {
                            target.classList.add('show');
                        }
                    }
                });
            });

            // Theme Toggle
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    document.body.classList.toggle('dark-mode');
                    const icon = themeToggle.querySelector('i');
                    if (document.body.classList.contains('dark-mode')) {
                        icon.classList.remove('fa-moon');
                        icon.classList.add('fa-sun');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        icon.classList.remove('fa-sun');
                        icon.classList.add('fa-moon');
                        localStorage.setItem('theme', 'light');
                    }
                });
            }

            // Apply saved theme
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
                if (themeToggle) {
                    const icon = themeToggle.querySelector('i');
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                }
            }

            // Search functionality
            const searchInput = document.getElementById('searchNotifications');
            const notificationItems = document.querySelectorAll('.notification-item');
            if(searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    
                    notificationItems.forEach(item => {
                        const title = item.querySelector('.notification-content .notification-title span').textContent.toLowerCase();
                        const message = item.querySelector('.notification-message').textContent.toLowerCase();
                        
                        if (title.includes(searchTerm) || message.includes(searchTerm)) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }

            // Refresh notifications
            const refreshBtn = document.getElementById('refreshNotifications');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', function() {
                    location.reload();
                });
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Function to show toast notifications
            function showToast(message, type = 'info') {
                const toastContainer = document.querySelector('.notification-toast-container');
                if (!toastContainer) {
                    const newContainer = document.createElement('div');
                    newContainer.classList.add('notification-toast-container');
                    document.body.appendChild(newContainer);
                }

                const toast = document.createElement('div');
                toast.className = `notification-toast ${type}`;
                toast.innerHTML = `
                    <div class="toast-header">
                        <div class="toast-icon ${type}">
                            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'times-circle' : 'info-circle'}"></i>
                        </div>
                        <strong class="me-auto toast-title">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                        <button type="button" class="btn-close toast-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">${message}</div>
                `;

                document.querySelector('.notification-toast-container').appendChild(toast);

                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();
            }

            // Mark All As Read functionality
            const markAllReadBtn = document.getElementById('markAllReadBtn');
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', async function() {
                    if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                        try {
                            const response = await fetch('{{ route('admin.notifications.markAllAsRead') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            });
                            const data = await response.json();
                            if (response.ok) {
                                document.querySelectorAll('.notification-item').forEach(item => {
                                    item.classList.add('read');
                                    item.classList.remove('unread');
                                    item.querySelector('.notification-status')?.remove(); // Remove status indicator
                                });
                                showToast(data.message, 'success');
                                // Optionally reload to reflect changes fully
                                setTimeout(() => location.reload(), 1000); 
                            } else {
                                showToast(data.message || 'Gagal menandai semua notifikasi sebagai dibaca.', 'danger');
                            }
                        } catch (error) {
                            console.error('Error marking all as read:', error);
                            showToast('Terjadi kesalahan saat menandai semua notifikasi.', 'danger');
                        }
                    }
                });
            }

            // Clear All Notifications functionality
            const clearAllNotificationsBtn = document.getElementById('clearNotifications');
            if (clearAllNotificationsBtn) {
                clearAllNotificationsBtn.addEventListener('click', async function() {
                    if (confirm('Hapus semua notifikasi? Tindakan ini tidak dapat dibatalkan.')) {
                        try {
                            const response = await fetch('{{ route('admin.notifications.clearAll') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            });
                            const data = await response.json();
                            if (response.ok) {
                                const notificationList = document.getElementById('notificationList');
                                if (notificationList) {
                                    notificationList.innerHTML = `
                                        <div class="notification-empty">
                                            <i class="fas fa-bell-slash"></i>
                                            <h3>Tidak Ada Notifikasi</h3>
                                            <p>Semua notifikasi telah dihapus.</p>
                                        </div>
                                    `;
                                }
                                showToast(data.message, 'info');
                            } else {
                                showToast(data.message || 'Gagal menghapus semua notifikasi.', 'danger');
                            }
                        } catch (error) {
                            console.error('Error clearing all notifications:', error);
                            showToast('Terjadi kesalahan saat menghapus semua notifikasi.', 'danger');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>