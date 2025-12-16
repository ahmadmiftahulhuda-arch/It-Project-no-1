<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman - Sistem Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
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

        /* Sidebar Styles - DIPERBAIKI dengan dropdown yang rapi */
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

        /* Dropdown Menu Styles - DIPERBAIKI */
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

        .stat-icon.pending {
            background: #ffb74d;
        }

        .stat-icon.approved {
            background: #66bb6a;
        }

        .stat-icon.rejected {
            background: #ef5350;
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

        /* Status Badges */
        .badge {
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .status-badge {
            padding: 0.45em 0.9em;
            border-radius: 18px;
            font-size: 0.82rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid transparent;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .status-disetujui,
        .status-dikembalikan {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .status-terlambat {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-selesai {
            background: #e9ecef;
            color: #495057;
        }

        .status-berlangsung {
            background: #e3f2fd;
            color: #1565c0;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-success-custom {
            background: #4caf50;
            color: white;
        }

        .btn-danger-custom {
            background: #f44336;
            color: white;
        }

        .btn-warning-custom {
            background: #ff9800;
            color: white;
        }

        .btn-info-custom {
            background: #2196f3;
            color: white;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-link {
            color: var(--primary);
            border: 1px solid var(--border-light);
            padding: 8px 15px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* Modal */
        .modal-header {
            background: var(--primary);
            color: white;
            border-bottom: none;
        }

        .btn-close-white {
            filter: invert(1);
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
        body.dark-mode .table-container {
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

        /* Make inputs, selects and form controls dark in dark mode (stronger) */
        body.dark-mode .form-control,
        body.dark-mode .form-select,
        body.dark-mode .filter-group select,
        body.dark-mode .search-bar input,
        body.dark-mode input[type="text"],
        body.dark-mode select {
            background: #2a2a2a !important;
            border-color: var(--border-light) !important;
            color: var(--text-dark) !important;
        }

        /* Force table elements dark */
        body.dark-mode .table,
        body.dark-mode .table thead,
        body.dark-mode .table tbody,
        body.dark-mode .table th,
        body.dark-mode .table td,
        body.dark-mode .table tr {
            background-color: transparent !important;
            color: var(--text-dark) !important;
        }

        body.dark-mode .table tbody td {
            background: transparent !important;
            color: var(--text-dark) !important;
            border-color: var(--border-light) !important;
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

        body.dark-mode .filter-group label {
            color: var(--text-dark);
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

            <!-- Manajemen Peminjaman - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#peminjamanMenu" aria-expanded="false" aria-controls="peminjamanMenu">
                    <span>Manajemen Peminjaman</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="peminjamanMenu">
                    <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item active">
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

            <!-- Manajemen Aset - DROPDOWN -->
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

            <!-- Manajemen Akademik - DROPDOWN -->
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

            <!-- Manajemen Pengguna - DROPDOWN -->
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

            <!-- Laporan & Pengaturan - DROPDOWN -->
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
                    <a href="/admin/settings" class="dropdown-item">
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
            <form id="searchForm" method="GET" action="{{ route('admin.peminjaman.index') }}" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari peminjaman..."
                    value="{{ request('search') }}">
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
                    <button class="user-profile dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">
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
                        <li>
                            <h6 class="dropdown-header">Selamat Datang, @auth {{ auth()->user()->name }}
                                @else
                                Pengguna @endauth
                            </h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i
                                    class="fas fa-user-circle me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i
                                    class="fas fa-cog me-2"></i> Pengaturan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
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
                <h1>Dashboard Peminjaman</h1>
                <p>Kelola proses peminjaman barang Lab Teknologi Informasi</p>
            </div>
            </button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fas fa-plus"></i> Tambah Peminjaman
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3 id="pending-count">{{ $pendingCount ?? 0 }}</h3>
                    <p>Menunggu Persetujuan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon approved">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="approved-count">{{ $approvedCount ?? 0 }}</h3>
                    <p>Disetujui</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rejected">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="rejected-count">{{ $rejectedCount ?? 0 }}</h3>
                    <p>Ditolak</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-list-alt"></i>
                </div>
                <div class="stat-info">
                    <h3 id="total-count">{{ $totalCount ?? 0 }}</h3>
                    <p>Total Peminjaman</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form id="filterForm" method="GET" action="{{ route('admin.peminjaman.index') }}">
                <div class="filter-grid">

                    <div class="filter-group">
                        <label for="status_filter">Status Peminjaman</label>
                        <select id="status_filter" name="status" class="form-select js-choice">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>
                                Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="ruang_filter">Ruang</label>
                        <select id="ruang_filter" name="ruangan_id" class="form-select js-choice">
                            <option value="">Semua Ruang</option>
                            @foreach ($ruangan as $r)
                                <option value="{{ $r->id }}"
                                    {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="projector_filter">Proyektor</label>
                        <select id="projector_filter" name="projector_id" class="form-select js-choice">
                            <option value="">Semua Proyektor</option>
                            @if (isset($projectors) && $projectors->count())
                                @foreach ($projectors as $p)
                                    <option value="{{ $p->id }}"
                                        {{ request('projector_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->kode_proyektor ?? 'P-' . $p->id }} - {{ $p->merk ?? '' }}
                                        {{ $p->model ?? '' }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="date_filter">Tanggal Peminjaman</label>
                        <input type="date" id="date_filter" name="date" value="{{ request('date') }}">
                    </div>

                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">

                    <!-- Tombol kiri (Reset) -->
                    <div class="d-flex gap-2">

                        <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-outline btn-sm">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    </div>

                    <!-- Tombol kanan (Ekspor) -->
                    <a href="{{ route('admin.peminjaman.export') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-file-export me-1"></i> Ekspor
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
                            <th>Peminjam</th>
                            <th>Tanggal & Waktu</th>
                            <th>Ruang</th>
                            <th>Proyektor</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="peminjaman-table-body">
                        @forelse($peminjamans as $peminjaman)
                            @php
                                $tanggal = \Carbon\Carbon::parse($peminjaman->tanggal);
                                $now = \Carbon\Carbon::now();
                                $isOngoing = $peminjaman->is_ongoing;
                            @endphp

                            <tr data-status="{{ $peminjaman->status }}" data-ruang="{{ $peminjaman->ruang }}"
                                data-tanggal="{{ \Carbon\Carbon::parse($peminjaman->tanggal)->format('d M Y') }}"
                                data-tanggal-iso="{{ $peminjaman->tanggal }}"
                                data-waktu-mulai="{{ $peminjaman->display_waktu_mulai ?? ($peminjaman->waktu_mulai ?? '') }}"
                                data-waktu-selesai="{{ $peminjaman->display_waktu_selesai ?? ($peminjaman->waktu_selesai ?? '') }}"
                                data-id="{{ $peminjaman->id }}" class="{{ $isOngoing ? 'table-success' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold">{{ $peminjaman->user->name ?? 'Guest' }}</div>
                                            <small class="text-muted">{{ $peminjaman->user->nim ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <i class="fas fa-calendar-day text-primary me-1"></i>
                                        {{ $tanggal->format('d M Y') }}
                                    </div>
                                    <div>
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $peminjaman->display_waktu_mulai ?? ($peminjaman->waktu_mulai ?? '08:00') }}
                                            -
                                            {{ $peminjaman->display_waktu_selesai ?? ($peminjaman->waktu_selesai ?? '17:00') }}
                                        </span>
                                    </div>
                                    {{-- debug info removed --}}
                                </td>
                                <td>
                                    <i class="fas fa-door-open text-info me-1"></i>
                                    {{ $peminjaman->ruangan->nama_ruangan ?? $peminjaman->ruang }}
                                </td>
                                <td>
                                    @if ($peminjaman->projector)
                                        <div>
                                            <strong>{{ $peminjaman->projector->kode_proyektor ?? 'ID:' . $peminjaman->projector->id }}</strong>
                                            <div class="text-muted small">{{ $peminjaman->projector->merk ?? '' }}
                                                {{ $peminjaman->projector->model ?? '' }}</div>
                                        </div>
                                    @else
                                        <span class="badge bg-secondary">Tidak</span>
                                    @endif
                                </td>
                                <td>
                                    @php $pjStatus = optional($peminjaman->pengembalian)->status; @endphp

                                        @if ($peminjaman->status == 'disetujui' && $isOngoing)
                                            <span class="badge status-badge status-berlangsung">
                                                <i class="fas fa-play-circle me-1"></i> Berlangsung
                                            </span>
                                        @elseif ($peminjaman->status == 'selesai')
                                            <span class="badge status-badge status-selesai">
                                                <i class="fas fa-check-double me-1"></i> Selesai
                                            </span>
                                        @elseif ($peminjaman->status == 'disetujui')
                                            <span class="badge status-badge status-disetujui">
                                                <i class="fas fa-check-circle me-1"></i> Disetujui
                                            </span>
                                        @elseif($peminjaman->status == 'ditolak')
                                            <span class="badge status-badge status-ditolak">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="badge status-badge status-menunggu">
                                                <i class="fas fa-clock me-1"></i> Menunggu
                                            </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 action-buttons">
                                        @if ($peminjaman->status == 'pending')
                                            <form action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <button type="submit" class="btn btn-success-custom btn-sm">
                                                    <i class="fas fa-check me-1"></i> Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.peminjaman.reject', $peminjaman->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <button type="submit" class="btn btn-danger-custom btn-sm">
                                                    <i class="fas fa-times me-1"></i> Tolak
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Detail -->
                                        <button class="btn btn-info-custom btn-sm view-detail"
                                            data-id="{{ $peminjaman->id }}"
                                            data-peminjam="{{ $peminjaman->user->name ?? 'Guest' }}"
                                            data-nim="{{ $peminjaman->user->nim ?? '-' }}"
                                            data-email="{{ $peminjaman->user->email ?? '-' }}"
                                            data-no-hp="{{ $peminjaman->user->no_hp ?? '-' }}"
                                            data-dosen="{{ $peminjaman->dosen->nama_dosen ?? '' }}"
                                            data-dosen-nip="{{ $peminjaman->dosen_nip ?? '' }}"
                                            data-tanggal="{{ $tanggal->format('d M Y') }}"
                                            data-waktu-mulai="{{ $peminjaman->waktu_mulai ?? '08:00' }}"
                                            data-waktu-selesai="{{ $peminjaman->waktu_selesai ?? '17:00' }}"
                                            data-ruangan-id="{{ $peminjaman->ruangan_id ?? '' }}"
                                            data-ruang="{{ $peminjaman->ruangan->nama_ruangan ?? $peminjaman->ruang }}"
                                            data-projector-id="{{ $peminjaman->projector_id ?? '' }}"
                                            data-projector-label="{{ $peminjaman->projector ? $peminjaman->projector->kode_proyektor . ' - ' . ($peminjaman->projector->merk ?? '') : 'Tidak' }}"
                                            data-keperluan="{{ $peminjaman->keperluan }}"
                                            data-status="{{ $peminjaman->status }}"
                                            data-is-ongoing="{{ $isOngoing ? 'true' : 'false' }}">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </button>

                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning-custom btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-id="{{ $peminjaman->id }}"
                                            data-peminjam="{{ $peminjaman->user->name ?? 'Guest' }}"
                                            data-nim="{{ $peminjaman->user->nim ?? '' }}"
                                            data-email="{{ $peminjaman->user->email ?? '' }}"
                                            data-no-hp="{{ $peminjaman->user->no_hp ?? '' }}"
                                            data-dosen="{{ $peminjaman->dosen->nama_dosen ?? '' }}"
                                            data-dosen-nip="{{ $peminjaman->dosen_nip ?? '' }}"
                                            data-tanggal="{{ $peminjaman->tanggal }}"
                                            data-waktu-mulai="{{ $peminjaman->waktu_mulai }}"
                                            data-waktu-selesai="{{ $peminjaman->waktu_selesai }}"
                                            data-ruangan-id="{{ $peminjaman->ruangan_id ?? '' }}"
                                            data-ruang="{{ $peminjaman->ruangan->nama_ruangan ?? $peminjaman->ruang }}"
                                            data-projector-id="{{ $peminjaman->projector_id ?? '' }}"
                                            data-projector-label="{{ $peminjaman->projector ? $peminjaman->projector->kode_proyektor . ' - ' . ($peminjaman->projector->merk ?? '') : '0' }}"
                                            data-keperluan="{{ $peminjaman->keperluan }}"
                                            data-status="{{ $peminjaman->status }}">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custom btn-sm">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">
                                    <i class="fas fa-inbox"></i><br>
                                    Belum ada data peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($peminjamans->hasPages())
            <div class="pagination-container">
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($peminjamans->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Sebelumnya</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $peminjamans->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Sebelumnya</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($peminjamans->getUrlRange(1, $peminjamans->lastPage()) as $page => $url)
                            @if ($page == $peminjamans->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($peminjamans->hasMorePages())
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $peminjamans->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Selanjutnya</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Selanjutnya</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif

        <!-- Modal Detail Peminjaman -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel"><i class="fas fa-info-circle me-2"></i> Detail
                            Peminjaman</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <!-- Konten akan diisi oleh JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Peminjaman -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit me-2"></i> Edit Peminjaman
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_peminjam" class="form-label">Nama Peminjam</label>
                                    <input type="text" class="form-control" id="edit_peminjam" name="peminjam"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="edit_nim" name="nim"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="edit_email" name="email"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="edit_tanggal" name="tanggal"
                                        required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Waktu Mulai</label>
                                    <select class="form-select" id="edit_waktu_mulai" name="waktu_mulai" required>
                                        <option value="">-- Pilih Waktu Mulai --</option>
                                        @foreach ($slotwaktu as $slot)
                                            <option value="{{ $slot->waktu }}">{{ $slot->waktu }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Waktu Selesai</label>
                                    <select class="form-select" id="edit_waktu_selesai" name="waktu_selesai"
                                        required>
                                        <option value="">-- Pilih Waktu Selesai --</option>
                                        @foreach ($slotwaktu as $slot)
                                            <option value="{{ $slot->waktu }}">{{ $slot->waktu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_ruangan_id" class="form-label">Ruang</label>
                                    <select class="form-select" id="edit_ruangan_id" name="ruangan_id" required>
                                        <option value="">-- Pilih Ruang --</option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}">
                                                {{ $r->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_projector_id" class="form-label">Proyektor</label>
                                    <select name="projector_id" class="form-select" id="edit_projector_id">
                                        <option value="">-- Tidak Ada Proyektor --</option>
                                        @if (isset($projectors) && $projectors->count())
                                            @foreach ($projectors as $p)
                                                <option value="{{ $p->id }}">
                                                    {{ $p->kode_proyektor ?? 'P-' . $p->id }} - {{ $p->merk ?? '' }}
                                                    {{ $p->model ?? '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_dosen_nip" class="form-label">Dosen Pengampu</label>
                                    <select name="dosen_nip" class="form-select" id="edit_dosen_nip">
                                        <option value="">-- Tidak Ada --</option>
                                        @if (isset($dosens) && $dosens->count())
                                            @foreach ($dosens as $d)
                                                <option value="{{ $d->nip }}">{{ $d->nama_dosen }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_status" class="form-label">Status</label>
                                    <select name="status" class="form-select" id="edit_status">
                                        <option value="pending" selected>Menunggu</option>
                                        <option value="disetujui">Disetujui</option>
                                        <option value="ditolak">Ditolak</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                    <div id="edit_is_ongoing_container" style="margin-top:8px; display:none;">
                                        <span id="edit_is_ongoing_badge"
                                            class="badge status-badge status-berlangsung">
                                            <i class="fas fa-play-circle me-1"></i> Berlangsung
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="edit_keperluan" class="form-label">Keperluan</label>
                                    <textarea class="form-control" id="edit_keperluan" name="keperluan" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Peminjaman -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-plus me-2"></i> Tambah Peminjaman</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.peminjaman.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">

                                <!-- PEMINJAM -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Nama Peminjam</label>
                                    <input type="text" name="peminjam" class="form-control"
                                        placeholder="Masukkan nama peminjam" required>
                                    <small class="text-muted">Admin akan mencari user berdasarkan nama ini.</small>
                                </div>

                                <!-- TANGGAL -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Waktu Mulai</label>
                                    <select class="form-select" id="edit_waktu_mulai" name="waktu_mulai" required>
                                        <option value="">-- Pilih Waktu Mulai --</option>
                                        @foreach ($slotwaktu as $slot)
                                            <option value="{{ $slot->waktu }}">{{ $slot->waktu }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Waktu Selesai</label>
                                    <select class="form-select" id="edit_waktu_selesai" name="waktu_selesai"
                                        required>
                                        <option value="">-- Pilih Waktu Selesai --</option>
                                        @foreach ($slotwaktu as $slot)
                                            <option value="{{ $slot->waktu }}">{{ $slot->waktu }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- RUANG -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ruang</label>
                                    <select name="ruangan_id" class="form-select" required>
                                        <option value="">-- Pilih Ruang --</option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- PROYEKTOR -->
                                <div class="col-md-6 mb-3">
                                    <label for="projector_id" class="form-label">Proyektor</label>
                                    <select name="projector_id" class="form-select" id="projector_id">
                                        <option value="">-- Tidak Ada Proyektor --</option>
                                        @if (isset($projectors) && $projectors->count())
                                            @foreach ($projectors as $p)
                                                <option value="{{ $p->id }}">
                                                    {{ $p->kode_proyektor ?? 'P-' . $p->id }} - {{ $p->merk ?? '' }}
                                                    {{ $p->model ?? '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="dosen_nip" class="form-label">Dosen Pengampu</label>
                                    <select name="dosen_nip" class="form-select" id="dosen_nip">
                                        <option value="">-- Tidak Ada --</option>
                                        @if (isset($dosens) && $dosens->count())
                                            @foreach ($dosens as $d)
                                                <option value="{{ $d->nip }}">{{ $d->nama_dosen }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- STATUS -->
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select" id="status">
                                        <option value="pending" selected>Menunggu</option>
                                        <option value="disetujui">Disetujui</option>
                                        <option value="ditolak">Ditolak</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>

                                <!-- KEPERLUAN -->
                                <div class="col-12 mb-3">
                                    <label class="form-label">Keperluan</label>
                                    <textarea name="keperluan" class="form-control" rows="3" required></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
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

            // waktu
            function formatJamMenit(waktu) {
                if (!waktu) return '-';
                // jika format HH:mm:ss → ambil HH:mm
                if (waktu.length >= 5) {
                    return waktu.substring(0, 5);
                }
                return waktu;
            }

            // Auto-submit form search ketika mengetik (dengan debounce)
            let searchTimeout;
            const searchInputs = document.querySelectorAll('.search-bar input[name="search"]');

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

            // Auto-submit filter ketika perubahan select box
            const filterSelects = document.querySelectorAll('#filterForm select');
            filterSelects.forEach(select => {
                select.addEventListener('change', function() {
                    console.log('Filter changed:', this.name, this.value);
                    document.getElementById('filterForm').submit();
                });
            });

            // Tangani date filter change
            const dateFilter = document.getElementById('date_filter');
            if (dateFilter) {
                dateFilter.addEventListener('change', function() {
                    console.log('Date filter changed:', this.value);
                    document.getElementById('filterForm').submit();
                });
            }

            // Handler untuk modal detail
            const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
            const viewDetailButtons = document.querySelectorAll('.view-detail');

            viewDetailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const peminjam = this.getAttribute('data-peminjam');
                    const nim = this.getAttribute('data-nim');
                    const email = this.getAttribute('data-email');
                    const noHp = this.getAttribute('data-no-hp');
                    const tanggal = this.getAttribute('data-tanggal');
                    const dosen = this.getAttribute('data-dosen');
                    const dosenNip = this.getAttribute('data-dosen-nip');
                    const waktuMulai = this.getAttribute('data-waktu-mulai');
                    const waktuSelesai = this.getAttribute('data-waktu-selesai');
                    const ruang = this.getAttribute('data-ruang');
                    const proyektorLabel = this.getAttribute('data-projector-label');
                    const keperluan = this.getAttribute('data-keperluan');
                    const status = this.getAttribute('data-status');
                    const isOngoing = this.getAttribute('data-is-ongoing') === 'true';

                    let statusBadge = '';
                    if (isOngoing) {
                        statusBadge =
                            '<span class="badge status-badge status-berlangsung"><i class="fas fa-play-circle me-1"></i> Berlangsung</span>';
                    } else {
                        switch (status) {
                            case 'disetujui':
                                statusBadge =
                                    '<span class="badge status-badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui</span>';
                                break;
                            case 'selesai':
                                statusBadge =
                                    '<span class="badge status-badge status-selesai"><i class="fas fa-check-double me-1"></i> Selesai</span>';
                                break;
                            case 'ditolak':
                                statusBadge =
                                    '<span class="badge status-badge status-ditolak"><i class="fas fa-times-circle me-1"></i> Ditolak</span>';
                                break;
                            default:
                                statusBadge =
                                    '<span class="badge status-badge status-menunggu"><i class="fas fa-clock me-1"></i> Menunggu</span>';
                        }
                    }

                    const modalContent = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-user me-2"></i>Informasi Peminjam</h6>
                                <p><strong>Nama:</strong> ${peminjam}</p>
                                <p><strong>NIM:</strong> ${nim || '-'}</p>
                                <p><strong>Email:</strong> ${email || '-'}</p>
                                <p><strong>No. HP:</strong> ${noHp || '-'}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar me-2"></i>Informasi Peminjaman</h6>
                                <p><strong>Tanggal:</strong> ${tanggal}</p>                              
<p><strong>Waktu:</strong> ${formatJamMenit(waktuMulai)} - ${formatJamMenit(waktuSelesai)}</p>
                                <p><strong>Ruang:</strong> ${ruang}</p>
                                <p><strong>Proyektor:</strong> ${proyektorLabel}</p>
                                <p><strong>Dosen Pengampu:</strong> ${dosen || '-'}</p>
                                <p><strong>Status:</strong> ${statusBadge}</p>
                            </div>
                            <div class="col-12 mt-3">
                                <h6><i class="fas fa-clipboard-list me-2"></i>Keperluan</h6>
                                <p>${keperluan}</p>
                            </div>
                        </div>
                    `;

                    document.getElementById('modalBody').innerHTML = modalContent;
                    detailModal.show();
                });
            });

            // Handler untuk modal edit
            const editModal = document.getElementById('editModal');
            if (editModal) {
                function normalizeDateForInput(dateStr) {
                    if (!dateStr) return '';
                    // If already YYYY-MM-DD, return as is
                    if (/^\d{4}-\d{2}-\d{2}$/.test(dateStr)) return dateStr;
                    // Try common formats: DD/MM/YYYY or MM/DD/YYYY or DD-MM-YYYY
                    let parts;
                    if (dateStr.indexOf('/') !== -1) parts = dateStr.split('/');
                    else if (dateStr.indexOf('-') !== -1) parts = dateStr.split('-');
                    else return '';

                    // If parts[0] is 4 -> already YYYY-MM-DD-like
                    if (parts[0].length === 4) return parts.join('-');

                    // If ambiguous (MM/DD/YYYY or DD/MM/YYYY), try to detect by value >12
                    let d = parts[0],
                        m = parts[1],
                        y = parts[2];
                    if (parseInt(d, 10) > 12) {
                        // d is day
                        return `${y.padStart(4,'0')}-${m.padStart(2,'0')}-${d.padStart(2,'0')}`;
                    }
                    // else assume MM/DD/YYYY -> convert to YYYY-MM-DD
                    return `${y.padStart(4,'0')}-${d.padStart(2,'0')}-${m.padStart(2,'0')}`;
                }

                function normalizeTimeForInput(timeStr) {
                    if (!timeStr) return '';
                    // If already HH:MM (24h), return
                    if (/^\d{2}:\d{2}$/.test(timeStr)) return timeStr;
                    // Handle formats like 03:00 PM or 3:00 PM
                    const m = timeStr.match(/(\d{1,2}):(\d{2})\s*(AM|PM)/i);
                    if (m) {
                        let hh = parseInt(m[1], 10);
                        const mm = m[2];
                        const ampm = m[3].toUpperCase();
                        if (ampm === 'PM' && hh < 12) hh += 12;
                        if (ampm === 'AM' && hh === 12) hh = 0;
                        return `${String(hh).padStart(2,'0')}:${mm}`;
                    }
                    // Fallback: try to extract digits
                    const simple = timeStr.match(/(\d{1,2}):(\d{2})/);
                    return simple ? `${String(simple[1]).padStart(2,'0')}:${simple[2]}` : '';
                }

                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const peminjam = button.getAttribute('data-peminjam');
                    const nim = button.getAttribute('data-nim');
                    const email = button.getAttribute('data-email');
                    const noHp = button.getAttribute('data-no-hp');
                    const tanggal = button.getAttribute('data-tanggal');
                    const waktuMulai = button.getAttribute('data-waktu-mulai');
                    const waktuSelesai = button.getAttribute('data-waktu-selesai');
                    const ruanganId = button.getAttribute('data-ruangan-id');
                    const dosenNip = button.getAttribute('data-dosen-nip');
                    const projectorId = button.getAttribute('data-projector-id');
                    const keperluan = button.getAttribute('data-keperluan');
                    const status = button.getAttribute('data-status');
                    const isOngoing = button.getAttribute('data-is-ongoing') === 'true';

                    // Update form action
                    const form = document.getElementById('editForm');
                    form.action = `/admin/peminjaman/${id}`;

                    // Isi form dengan data yang ada (gunakan edit_ prefixed IDs)
                    document.getElementById('edit_peminjam').value = peminjam;
                    document.getElementById('edit_nim').value = nim;
                    document.getElementById('edit_email').value = email;
                    // Normalize date and time for HTML inputs
                    try {
                        document.getElementById('edit_tanggal').value = normalizeDateForInput(tanggal);
                    } catch (e) {
                        document.getElementById('edit_tanggal').value = '';
                    }
                    document.getElementById('edit_waktu_mulai').value = waktuMulai?.substring(0, 5) || '';
                    document.getElementById('edit_waktu_selesai').value = waktuSelesai?.substring(0, 5) || '';

                    // Set ruangan_id langsung dari data attribute
                    const ruanganSelect = document.getElementById('edit_ruangan_id');
                    if (ruanganId && ruanganId !== '') {
                        ruanganSelect.value = ruanganId;
                    } else {
                        ruanganSelect.value = '';
                    }

                    document.getElementById('edit_keperluan').value = keperluan;
                    document.getElementById('edit_status').value = status;

                    // Toggle 'Berlangsung' badge if this peminjaman is ongoing
                    const ongoingContainer = document.getElementById('edit_is_ongoing_container');
                    if (isOngoing) {
                        ongoingContainer.style.display = 'block';
                    } else {
                        ongoingContainer.style.display = 'none';
                    }

                    // Set projector berdasarkan ID
                    const projectorSelect = document.getElementById('edit_projector_id');
                    if (projectorId && projectorId !== '') {
                        projectorSelect.value = projectorId;
                    } else {
                        projectorSelect.value = '';
                    }

                    // Set dosen select
                    const dosenSelect = document.getElementById('edit_dosen_nip');
                    if (dosenSelect) {
                        dosenSelect.value = dosenNip || '';
                    }
                });
            }

            // Konfirmasi untuk semua aksi (kecuali form filter dan search)
            document.querySelectorAll('form').forEach(form => {
                if (form.id !== 'filterForm' && form.id !== 'searchForm') {
                    form.addEventListener('submit', function(e) {
                        const button = this.querySelector('button[type="submit"]');
                        const actionText = button.textContent.trim();

                        if (!confirm(`Apakah Anda yakin ingin ${actionText.toLowerCase()} peminjaman ini?`)) {
                            e.preventDefault();
                        }
                    });
                }
            });

            // Terapkan dark mode jika sebelumnya diaktifkan
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }

            // Tampilkan parameter filter yang aktif
            function showActiveFilters() {
                const urlParams = new URLSearchParams(window.location.search);
                const activeFilters = [];

                if (urlParams.get('search')) {
                    activeFilters.push(`Pencarian: "${urlParams.get('search')}"`);
                }
                if (urlParams.get('status')) {
                    const statusText = {
                        'pending': 'Menunggu',
                        'disetujui': 'Disetujui',
                        'ditolak': 'Ditolak',
                        'selesai': 'Selesai'
                    } [urlParams.get('status')] || urlParams.get('status');
                    activeFilters.push(`Status: ${statusText}`);
                }
                if (urlParams.get('date')) {
                    activeFilters.push(`Tanggal: ${urlParams.get('date')}`);
                }
                if (urlParams.get('ruang')) {
                    activeFilters.push(`Ruang: ${urlParams.get('ruang')}`);
                }

                if (activeFilters.length > 0) {
                    // Hapus alert existing jika ada
                    const existingAlert = document.querySelector('.filter-alert');
                    if (existingAlert) {
                        existingAlert.remove();
                    }

                    const filterInfo = document.createElement('div');
                    filterInfo.className = 'alert alert-info alert-dismissible fade show mt-3 filter-alert';
                    filterInfo.innerHTML = `
                        <strong>Filter Aktif:</strong> ${activeFilters.join(', ')}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    document.querySelector('.filter-section').appendChild(filterInfo);
                }
            }

            // Client-side: update badges to 'Berlangsung' when local time is inside booking window
            function updateOngoingBadges() {
                const rows = document.querySelectorAll('tbody tr[data-tanggal-iso]');
                const now = new Date();

                rows.forEach(row => {
                    const tanggalIso = row.getAttribute('data-tanggal-iso');
                    const waktuMulai = row.getAttribute('data-waktu-mulai') || '';
                    const waktuSelesai = row.getAttribute('data-waktu-selesai') || '';

                    if (!tanggalIso || !waktuMulai || !waktuSelesai) return;

                    // build local Date objects
                    const [y, m, d] = tanggalIso.split('-').map(Number);
                    const parseTime = (t) => {
                        const parts = t.split(':').map(Number);
                        return {
                            h: parts[0] || 0,
                            min: parts[1] || 0
                        };
                    };

                    const s = parseTime(waktuMulai);
                    const e = parseTime(waktuSelesai);
                    const start = new Date(y, m - 1, d, s.h, s.min, 0);
                    const end = new Date(y, m - 1, d, e.h, e.min, 59);

                    const isOngoing = now >= start && now <= end;

                    // Only switch to 'Berlangsung' client-side when server status is 'disetujui'
                    const rowStatus = (row.getAttribute('data-status') || '').toLowerCase();
                    if (rowStatus !== 'disetujui') return;

                    // Prefer the status column badge to avoid overwriting the time-range badge
                    const badge = row.querySelector('.status-badge') || row.querySelector('span.badge');
                    if (!badge) return;

                    if (isOngoing) {
                        // update visual only if not already 'Berlangsung'
                        if (!/Berlangsung/i.test(badge.textContent)) {
                            // keep status-badge classes for styling consistency
                            badge.innerHTML = '<i class="fas fa-play-circle me-1"></i> Berlangsung';
                            badge.className = 'badge status-badge status-berlangsung';
                        }
                    } else {
                        // optional: do nothing — server render keeps canonical statuses
                    }
                });
            }

            // Panggil fungsi saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                showActiveFilters();

                // Update badges on load and every minute
                updateOngoingBadges();
                setInterval(updateOngoingBadges, 60000);

                // Debug: Tampilkan jumlah data yang difilter
                const tableRows = document.querySelectorAll('tbody tr');
                console.log('Jumlah data yang ditampilkan:', tableRows.length);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.js-choice').forEach(function(el) {
                    new Choices(el, {
                        searchEnabled: true,
                        shouldSort: false,
                        position: 'bottom',
                        itemSelectText: '',
                    });
                });
            });
        </script>
    </div>
</body>

</html>
