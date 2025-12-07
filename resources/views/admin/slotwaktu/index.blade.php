<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManajemenWaktu - Sistem Manajemen Peminjaman</title>
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

        /* PERBAIKAN: Dark Mode for Header Dropdown */
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#akademikMenu" aria-expanded="true" aria-controls="akademikMenu">
                    <span>Manajemen Akademik</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse show" id="akademikMenu">
                    <a href="/admin/jadwal-perkuliahan" class="dropdown-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Perkuliahan</span>
                    </a>
                    <a href="/admin/slotwaktu" class="dropdown-item active">
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
                    <a href="{{ route('admin.users.index') }}" class="dropdown-item">
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
                    <a href="/admin/pengaturan" class="dropdown-item">
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
            <form id="searchForm" method="GET" action="{{ route('admin.slotwaktu.index') }}" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="cari" placeholder="Cari slot waktu berdasarkan jam..." value="{{ request('cari') }}">
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
                <h1>Manajemen Waktu</h1>
                <p>Kelola data waktu penggunaan ruangan secara efisien</p>
            </div>
            <div class="action-buttons">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSlotWaktuModal">
                    <i class="fas fa-plus"></i> Tambah Slot Waktu
                </button>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="filter-section">
            <form id="filterForm" method="GET" action="{{ route('admin.slotwaktu.index') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="search">Cari Berdasarkan Jam</label>
                        <input type="text" id="search" name="cari" placeholder="Contoh: 08:00" value="{{ request('cari') }}">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-filter me-1"></i> Terapkan Filter
                    </button>
                    <a href="{{ route('admin.slotwaktu.index') }}" class="btn btn-outline btn-sm">
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
                            <th>ID Slot Waktu</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="slotwaktu-table-body">
                        @forelse ($slotwaktu as $slot)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $slot->id_slot }}</td>
                                <td>{{ $slot->waktu }}</td>
                                <td>
                                    <div class="d-flex gap-2 action-buttons">
                                        <button class="btn btn-warning-custom btn-sm edit-slotwaktu" 
                                                data-id="{{ $slot->id }}"
                                                data-id_slot="{{ $slot->id_slot }}"
                                                data-waktu="{{ $slot->waktu }}">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>
                                        <form action="{{ route('admin.slotwaktu.destroy', $slot->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus slot waktu ini?')" class="btn btn-danger-custom btn-sm">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    <i class="fas fa-clock"></i><br>
                                    Tidak ada slot waktu ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah Slot Waktu -->
        <div class="modal fade" id="tambahSlotWaktuModal" tabindex="-1" aria-labelledby="tambahSlotWaktuModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahSlotWaktuModalLabel">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Slot Waktu Baru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahSlotWaktuForm" action="{{ route('admin.slotwaktu.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="tambah_id_slot" class="form-label">
                                    <i class="fas fa-hashtag me-1"></i>ID Slot <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="tambah_id_slot" name="id_slot" 
                                       class="form-control @error('id_slot') is-invalid @enderror" 
                                       value="{{ old('id_slot') }}" required 
                                       placeholder="Masukkan ID Slot">
                                @error('id_slot')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="tambah_waktu" class="form-label">
                                    <i class="fas fa-clock me-1"></i>Waktu <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="tambah_waktu" name="waktu" 
                                       class="form-control @error('waktu') is-invalid @enderror" 
                                       value="{{ old('waktu') }}" required 
                                       placeholder="Contoh: 07:30">
                                @error('waktu')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: HH:MM (24 jam)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Slot Waktu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Slot Waktu -->
        <div class="modal fade" id="editSlotWaktuModal" tabindex="-1" aria-labelledby="editSlotWaktuModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSlotWaktuModalLabel">
                            <i class="fas fa-edit me-2"></i>Edit Slot Waktu
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editSlotWaktuForm" action="" method="POST">
                        @csrf 
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="edit_id_slot" class="form-label">
                                    <i class="fas fa-hashtag me-1"></i>ID Slot <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="edit_id_slot" name="id_slot" 
                                       class="form-control @error('id_slot') is-invalid @enderror" 
                                       required readonly>
                                @error('id_slot')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">ID Slot tidak dapat diubah</small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="edit_waktu" class="form-label">
                                    <i class="fas fa-clock me-1"></i>Waktu <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="edit_waktu" name="waktu" 
                                       class="form-control @error('waktu') is-invalid @enderror" 
                                       required placeholder="Contoh: 07:00">
                                @error('waktu')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: HH:MM (24 jam)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Perbarui Slot Waktu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

            // Auto-submit form search ketika mengetik (dengan debounce)
            let searchTimeout;
            const searchInputs = document.querySelectorAll('input[name="cari"]');

            searchInputs.forEach(input => {
                input.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        console.log('Auto-submitting search:', this.value);
                        // Submit form yang sesuai
                        const form = this.closest('form');
                        if (form) {
                            form.submit();
                        }
                    }, 800);
                });
            });

            // Edit slot waktu modal
            const editButtons = document.querySelectorAll('.edit-slotwaktu');
            const editModal = new bootstrap.Modal(document.getElementById('editSlotWaktuModal'));
            const editForm = document.getElementById('editSlotWaktuForm');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const id_slot = this.getAttribute('data-id_slot');
                    const waktu = this.getAttribute('data-waktu');
                    
                    // Set form action
                    editForm.action = `/admin/slotwaktu/${id}`;
                    
                    // Set form values
                    document.getElementById('edit_id_slot').value = id_slot;
                    document.getElementById('edit_waktu').value = waktu;
                    
                    // Show modal
                    editModal.show();
                });
            });

            // Validasi format waktu untuk modal tambah
            const tambahWaktuInput = document.getElementById('tambah_waktu');
            tambahWaktuInput.addEventListener('blur', function() {
                validateTimeFormat(this);
            });

            // Validasi format waktu untuk modal edit
            const editWaktuInput = document.getElementById('edit_waktu');
            editWaktuInput.addEventListener('blur', function() {
                validateTimeFormat(this);
            });

            function validateTimeFormat(inputElement) {
                const timePattern = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
                if (inputElement.value && !timePattern.test(inputElement.value)) {
                    inputElement.style.borderColor = '#dc3545';
                    inputElement.title = 'Format waktu harus HH:MM (contoh: 07:30)';
                } else {
                    inputElement.style.borderColor = '';
                    inputElement.title = '';
                }
            }

            // Terapkan dark mode jika sebelumnya diaktifkan
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }
        </script>
    </div>
</body>
</html>