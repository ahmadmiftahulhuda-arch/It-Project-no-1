<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Admin Lab TI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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

        .btn-warning {
            background: var(--warning);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(255, 152, 0, 0.2);
            color: white;
        }

        .btn-warning:hover {
            background: #e68900;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 152, 0, 0.3);
            color: white;
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

        .stat-icon.active {
            background: #66bb6a;
        }

        .stat-icon.total {
            background: var(--primary);
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
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-light);
            border-radius: 4px;
            outline: none;
            transition: all 0.3s;
            background-color: var(--bg-light);
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        /* Table */
        .table-container {
            background: var(--bg-card);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid var(--border-light);
            font-weight: 600;
            color: var(--dark);
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: var(--border-light);
        }

        .table tbody tr {
            transition: all 0.3s;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-success-custom {
            background: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-danger-custom {
            background: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-warning-custom {
            background: #ff9800;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-info-custom {
            background: #2196f3;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-success-custom:hover,
        .btn-danger-custom:hover,
        .btn-warning-custom:hover,
        .btn-info-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        /* Modal Compact Styles */
        .modal-md {
            max-width: 500px;
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-light);
            padding: 1.2rem 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid var(--border-light);
            padding: 1.2rem 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .form-control {
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h2,
            .menu-item span {
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
        }

        /* Dark Mode */
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
        body.dark-mode .stat-card,
        body.dark-mode .filter-section,
        body.dark-mode .table-container,
        body.dark-mode .modal-content {
            background: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .table thead th {
            background: #252525;
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .table tbody tr {
            border-color: var(--border-light);
        }

        body.dark-mode .table tbody tr:hover {
            background: #2a2a2a;
        }

        body.dark-mode .search-bar input,
        body.dark-mode .filter-group input,
        body.dark-mode .filter-group select,
        body.dark-mode .form-control {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        body.dark-mode .form-group input:read-only {
            background-color: #333;
            color: #a0a0a0;
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

        body.dark-mode .stat-info p {
            color: var(--text-light);
        }

        body.dark-mode .filter-group label,
        body.dark-mode .form-label {
            color: var(--text-dark);
        }

        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
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
                    <a href="/admin/dashboard" class="dropdown-item">
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#asetMenu" aria-expanded="false" aria-controls="asetMenu">
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#akademikMenu" aria-expanded="false" aria-controls="akademikMenu">
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
                </div>
            </div>
            
            <!-- Manajemen Pengguna -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#penggunaMenu" aria-expanded="false" aria-controls="penggunaMenu">
                    <span>Manajemen Pengguna</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="penggunaMenu">
                    <a href="{{ route('admin.users.index') }}" class="dropdown-item active">
                        <i class="fas fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                </div>
            </div>
            
            <!-- Laporan & Pengaturan -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#laporanMenu" aria-expanded="false" aria-controls="laporanMenu">
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
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <form id="searchForm" method="GET" action="{{ route('admin.users.index') }}" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" name="cari" placeholder="Cari pengguna berdasarkan nama atau email..." value="{{ request('cari') }}" autocomplete="off">
                <button type="submit" style="display: none;"></button>
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
                <h1>Manajemen Pengguna</h1>
                <p>Kelola data pengguna sistem Lab Teknologi Informasi</p>
            </div>
            <div class="action-buttons">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openCreateModal()">
                    <i class="fas fa-plus"></i> Tambah Pengguna
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form id="filterForm" method="GET" action="{{ route('admin.users.index') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="search">Cari Berdasarkan Nama atau Email</label>
                        <input type="text" id="search" name="cari" placeholder="Contoh: Budi atau budi@email.com" 
                               value="{{ request('cari') }}">
                    </div>
                    <div class="filter-group">
                        <label for="role_filter">Peran Pengguna</label>
                        <select id="role_filter" name="peran">
                            <option value="Semua" {{ request('peran') == 'Semua' || !request('peran') ? 'selected' : '' }}>Semua Peran</option>
                            <option value="Administrator" {{ request('peran') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                            <option value="Mahasiswa" {{ request('peran') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Dosen" {{ request('peran') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="status_filter">Status Pengguna</label>
                        <select id="status_filter" name="status">
                            <option value="Semua" {{ request('status') == 'Semua' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="verifikasi_filter">Status Verifikasi</label>
                        <select id="verifikasi_filter" name="verifikasi">
                            <option value="Semua" {{ request('verifikasi') == 'Semua' || !request('verifikasi') ? 'selected' : '' }}>Semua Status</option>
                            <option value="Terverifikasi" {{ request('verifikasi') == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="Belum" {{ request('verifikasi') == 'Belum' ? 'selected' : '' }}>Belum Terverifikasi</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-filter me-1"></i> Terapkan Filter
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-refresh me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Verifikasi Akun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        @if(isset($users) && count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $loop->index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->peran == 'Administrator' ? 'bg-warning' : ($user->peran == 'Dosen' ? 'bg-info' : 'bg-success') }}">
                                            {{ $user->peran ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $user->status === 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                            <i class="fas fa-circle me-1 small"></i>{{ $user->status ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($user->verified)
                                            <span class="badge bg-success">Terverifikasi</span>
                                        @else
                                            <span class="badge bg-warning">Belum Terverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            @if (!$user->verified)
                                                <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success-custom btn-sm" title="Verifikasi">
                                                        <i class="fas fa-check-circle me-1"></i> Verifikasi
                                                    </button>
                                                </form>
                                            @endif
                                            <button class="btn btn-warning-custom btn-sm edit-user" 
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-nim="{{ $user->nim }}"
                                                    data-no_hp="{{ $user->no_hp }}"
                                                    data-peran="{{ $user->peran }}"
                                                    data-status="{{ $user->status }}"
                                                    data-tanggal_bergabung="{{ $user->tanggal_bergabung ?? $user->created_at->format('Y-m-d') }}"
                                                    title="Edit">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus pengguna ini?')" class="btn btn-danger-custom btn-sm" title="Hapus">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-users"></i><br>
                                    Tidak ada pengguna ditemukan
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="p-3 d-flex justify-content-end">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>

        <!-- Modal Tambah/Edit Pengguna -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">
                            <i class="fas fa-user-plus me-2"></i>Tambah Pengguna Baru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="userForm" action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div id="formMethod"></div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="name" name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" required 
                                       placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="email" name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" required 
                                       placeholder="Masukkan alamat email">
                                @error('email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div id="passwordFields">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-1"></i>Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               required 
                                               placeholder="Masukkan password">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock me-1"></i>Konfirmasi Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" name="password_confirmation" 
                                               class="form-control" 
                                               required 
                                               placeholder="Konfirmasi password">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="nim" class="form-label">
                                    <i class="fas fa-id-card me-1"></i>NIM
                                </label>
                                <input type="text" id="nim" name="nim" 
                                       class="form-control @error('nim') is-invalid @enderror" 
                                       value="{{ old('nim') }}" 
                                       placeholder="Masukkan NIM">
                                @error('nim')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="no_hp" class="form-label">
                                    <i class="fas fa-phone me-1"></i>Nomor HP
                                </label>
                                <input type="text" id="no_hp" name="no_hp" 
                                       class="form-control @error('no_hp') is-invalid @enderror" 
                                       value="{{ old('no_hp') }}" 
                                       placeholder="Masukkan nomor HP">
                                @error('no_hp')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="peran" class="form-label">
                                    <i class="fas fa-user-tag me-1"></i>Peran <span class="text-danger">*</span>
                                </label>
                                <select id="peran" name="peran" 
                                        class="form-control @error('peran') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Peran</option>
                                    <option value="Administrator" {{ old('peran') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                    <option value="Mahasiswa" {{ old('peran') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    <option value="Dosen" {{ old('peran') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                                </select>
                                @error('peran')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="status" class="form-label">
                                    <i class="fas fa-circle me-1"></i>Status <span class="text-danger">*</span>
                                </label>
                                <select id="status" name="status" 
                                        class="form-control @error('status') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="verified" class="form-label">
                                    <i class="fas fa-check-circle me-1"></i>Status Verifikasi
                                </label>
                                <select id="verified" name="verified" class="form-control">
                                    <option value="1">Terverifikasi</option>
                                    <option value="0">Belum Terverifikasi</option>
                                </select>
                            </div>

                            <div class="form-group mb-3" id="tanggalBergabungField">
                                <label for="tanggal_bergabung" class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i>Tanggal Bergabung
                                </label>
                                <input type="date" id="tanggal_bergabung" name="tanggal_bergabung" 
                                       class="form-control @error('tanggal_bergabung') is-invalid @enderror" 
                                       value="{{ old('tanggal_bergabung') }}" 
                                       placeholder="Tanggal bergabung">
                                @error('tanggal_bergabung')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Global variables
    let currentEditId = null;
    let userModal = null;

    // Initialize when document is ready
    $(document).ready(function() {
        userModal = new bootstrap.Modal(document.getElementById('userModal'));
        initializeEventListeners();
        initializeTheme();
    });

    function initializeEventListeners() {
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            submitUserForm();
        });

        // Use event delegation for edit buttons since the table content can be dynamic
        $('#users-table-body').on('click', '.edit-user', function() {
            const userId = $(this).data('id');
            openEditModal(userId);
        });

        // Event listeners for filter changes to submit the form
        $('#role_filter, #status_filter, #verifikasi_filter').on('change', function() {
            $('#filterForm').submit();
        });

        // For delete confirmation, ensure it targets the form dynamically if needed
        $('body').on('submit', '.action-buttons form', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                e.preventDefault();
            }
        });

        $('#theme-toggle').on('click', function() {
            toggleTheme();
        });

        // Toggle password visibility
        $('#togglePassword').on('click', function() {
            const passwordInput = $('#password');
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });

        $('#togglePasswordConfirmation').on('click', function() {
            const passwordConfirmationInput = $('#password_confirmation');
            const type = passwordConfirmationInput.attr('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    }

    function resetForm() {
        $('#userForm')[0].reset();
        $('#userForm').attr('action', "{{ route('admin.users.store') }}");
        $('#formMethod').html(''); // Clear _method field
        $('#userModalLabel').html('<i class="fas fa-user-plus me-2"></i>Tambah Pengguna Baru');
        $('#passwordFields').show();
        $('#password').prop('required', true);
        $('#password_confirmation').prop('required', true);
        // Reset eye icon to fa-eye and input type to password
        $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
        $('#password').attr('type', 'password');
        $('#togglePasswordConfirmation i').removeClass('fa-eye-slash').addClass('fa-eye');
        $('#password_confirmation').attr('type', 'password');
        currentEditId = null;
        // Clear validation errors
        $('.error-message').text('');
        $('.is-invalid').removeClass('is-invalid');
    }

    function openCreateModal() {
        resetForm();
        userModal.show();
    }

    function openEditModal(userId) {
        currentEditId = userId;
        resetForm(); // Reset form first to clear previous data and errors
        
        $('#userModalLabel').html('<i class="fas fa-edit me-2"></i>Edit Pengguna');
        $('#userForm').attr('action', `/admin/users/${userId}`);
        $('#formMethod').html('<input type="hidden" name="_method" value="PUT">');
        
        $('#passwordFields').hide(); // Hide password fields for edit by default
        $('#password').prop('required', false);
        $('#password_confirmation').prop('required', false);
        
        fetchUserData(userId);
    }

    function fetchUserData(userId) {
        $.ajax({
            url: `/admin/users/${userId}/edit`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.data) {
                    populateEditForm(response.data);
                    userModal.show();
                } else {
                    alert('Gagal memuat data pengguna.');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data pengguna.');
            }
        });
    }

    function populateEditForm(user) {
        $('#name').val(user.name || '');
        $('#email').val(user.email || '');
        $('#nim').val(user.nim || '');
        $('#no_hp').val(user.no_hp || '');
        $('#peran').val(user.peran || '');
        $('#status').val(user.status || '');
        $('#verified').val(user.verified ? '1' : '0');
        
        // Populate tanggal_bergabung, format to YYYY-MM-DD for input type="date"
        if (user.tanggal_bergabung) {
            $('#tanggal_bergabung').val(user.tanggal_bergabung.substring(0, 10)); 
        } else if (user.created_at) { // Fallback to created_at if tanggal_bergabung is null
            $('#tanggal_bergabung').val(user.created_at.substring(0, 10));
        } else {
            $('#tanggal_bergabung').val('');
        }
    }

    function submitUserForm() {
        const form = $('#userForm');
        const url = form.attr('action');
        let formData = new FormData(form[0]);

        // Clear previous validation errors
        $('.error-message').text('');
        $('.is-invalid').removeClass('is-invalid');

        $.ajax({
            url: url,
            type: 'POST', // Always POST for Laravel AJAX, method spoofing is done via _method
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                userModal.hide();
                alert(response.success || 'Operasi berhasil!'); // Show success message
                window.location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Validation errors
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        // Dynamically find the input by ID, assuming ID matches name
                        const inputElement = $('#' + key);
                        if(inputElement.length === 0) { // Fallback for nested attributes or special cases
                            inputElement = $('[name="' + key + '"]');
                        }
                        inputElement.addClass('is-invalid').closest('.form-group').find('.error-message').text(value[0]);
                    });
                } else if (xhr.responseJSON && xhr.responseJSON.error) {
                    alert(xhr.responseJSON.error); // Show general error message from server
                } else {
                    console.error('AJAX Error:', xhr.responseText);
                    alert('Terjadi kesalahan yang tidak terduga. Silakan periksa konsol browser untuk detail.');
                }
            }
        });
    }

    function initializeTheme() {
        const savedTheme = localStorage.getItem('darkMode');
        if (savedTheme === 'enabled') {
            document.body.classList.add('dark-mode');
            $('#theme-toggle').html('<i class="fas fa-sun"></i>');
        }
    }

    function toggleTheme() {
        document.body.classList.toggle('dark-mode');
        let theme = 'disabled';
        let icon = '<i class="fas fa-moon"></i>';
        if (document.body.classList.contains('dark-mode')) {
            theme = 'enabled';
            icon = '<i class="fas fa-sun"></i>';
        }
        localStorage.setItem('darkMode', theme);
        $('#theme-toggle').html(icon);
    }

    // Submit search only when user presses Enter or Space (keyup so the character is present)
    $(document).ready(function() {
        $('#searchInput').on('keyup', function(e) {
            // Only submit on Enter press for the header search bar
            if (e.key === 'Enter') {
                $('#searchForm').submit();
            }
        });
    });
</script>
</body> 
</html>