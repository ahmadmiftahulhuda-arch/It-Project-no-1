<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - Sistem Manajemen Peminjaman</title>
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

        .stat-icon.completed {
            background: #66bb6a;
        }

        .stat-icon.cancelled {
            background: #ef5350;
        }

        .stat-icon.ongoing {
            background: #ffb74d;
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
            padding: 0.45em 0.9em;
            border-radius: 18px;
            font-size: 0.82rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid transparent;
        }

        .status-selesai {
            background: #e9ecef;
            color: #495057;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-berlangsung {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-terlambat {
            background: #ffebee;
            color: #c62828;
        }

        /* Ensure Terlambat badge shows red even when combined with other badge classes */
        .badge.status-terlambat,
        .status-badge.status-terlambat {
            background: #ffebee;
            color: #c62828;
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

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-belum-dikembalikan,
        .status-belum_dikembalikan {
            background-color: #fff8e1;
            color: #ff8f00;
            border-color: #ffecb5;
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

        .btn-edit-custom {
            background: #ffc107;
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
        .btn-info-custom:hover,
        .btn-edit-custom:hover {
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

        /* Timeline untuk riwayat */
        .timeline-item {
            border-left: 3px solid var(--primary);
            padding-left: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 0;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--primary);
        }

        .timeline-date {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .timeline-content {
            background: var(--bg-light);
            padding: 15px;
            border-radius: 6px;
            border: 1px solid var(--border-light);
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

        body.dark-mode .search-bar input,
        body.dark-mode .filter-group input,
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

        body.dark-mode .page-title p {
            color: var(--text-light);
        }

        body.dark-mode .stat-info p {
            color: var(--text-light);
        }

        body.dark-mode .filter-group label {
            color: var(--text-dark);
        }

        body.dark-mode .timeline-content {
            background: #2a2a2a;
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
            <!-- Menu Utama - DIPERBAIKI -->
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
                    <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item">
                        <i class="fas fa-hand-holding"></i>
                        <span>Peminjaman</span>
                    </a>
                    <a href="/admin/pengembalian" class="dropdown-item">
                        <i class="fas fa-undo"></i>
                        <span>Pengembalian</span>
                    </a>
                    <a href="/admin/riwayat" class="dropdown-item active">
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
                    <a href="{{ route('barangs.index') }}" class="dropdown-item active">
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
            <form id="searchForm" method="GET" action="{{ route('admin.riwayat') }}" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari riwayat peminjaman..."
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
                <h1>Riwayat Peminjaman</h1>
                <p>Lihat dan kelola riwayat peminjaman barang Lab Teknologi Informasi</p>
            </div>
            <div class="action-buttons">
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="completed-count">{{ $completedCount ?? 0 }}</h3>
                    <p>Selesai</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon cancelled">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="cancelled-count">{{ $cancelledCount ?? 0 }}</h3>
                    <p>Dibatalkan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon ongoing">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3 id="ongoing-count">{{ $ongoingCount ?? 0 }}</h3>
                    <p>Berlangsung</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-list-alt"></i>
                </div>
                <div class="stat-info">
                    <h3 id="total-count">{{ $totalCount ?? 0 }}</h3>
                    <p>Total Riwayat</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form id="filterForm" method="GET" action="{{ route('admin.riwayat') }}">
                <div class="filter-grid">

                    <div class="filter-group">
                        <label for="status_filter">Status Peminjaman</label>
                        <select id="status_filter" name="status" class="form-select">
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
                        <select id="ruang_filter" name="ruangan_id" class="form-select">
                            <option value="">Semua Ruang</option>
                            @if (isset($ruangans) && $ruangans->count())
                                @foreach ($ruangans as $r)
                                    <option value="{{ $r->id }}"
                                        {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>
                                        {{ $r->nama_ruangan }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="projector_filter">Proyektor</label>
                        <select id="projector_filter" name="projector_id" class="form-select">
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

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.riwayat') }}" class="btn btn-outline btn-sm">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    </div>

                    {{-- Tombol Export --}}
                    <a href="{{ route('admin.riwayat.export', request()->query()) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-file-export"></i> Ekspor
                    </a>
                </div>
            </form>
        </div>

        <!-- Tabs untuk tampilan berbeda -->
        <ul class="nav nav-tabs mb-4" id="viewTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="table-tab" data-bs-toggle="tab" data-bs-target="#table-view"
                    type="button" role="tab">
                    <i class="fas fa-table me-1"></i> Tabel
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="timeline-tab" data-bs-toggle="tab" data-bs-target="#timeline-view"
                    type="button" role="tab">
                    <i class="fas fa-stream me-1"></i> Timeline
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="viewTabsContent">
            <!-- Table View -->
            <div class="tab-pane fade show active" id="table-view" role="tabpanel">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Peminjam</th>
                                    <th>Dosen Pengampu</th>
                                    <th>Tanggal</th>
                                    <th>Ruang</th>
                                    <th>Proyektor</th>
                                    <th>Keperluan</th>
                                    <th>Status Peminjaman</th>
                                    <th>Status Pengembalian</th>
                                    <th>Aksi</th>
                                <tr>
                                <td colspan="10" class="empty-state">
                            <tbody id="riwayat-table-body">
                                @forelse($riwayat as $item)
                                    @php
                                        // Tentukan apakah peminjaman sedang berlangsung
                                        $isToday = \Carbon\Carbon::parse($item->tanggal)->isToday();
                                        $isOngoing = $isToday && $item->status == 'disetujui';
                                        // Tentukan pengembalian dan keterlambatan lebih awal untuk dipakai di beberapa kolom
                                        $pj = $item->pengembalian ?? null;
                                        $isLate = false;
                                        try {
                                            // Compute booking end datetime using waktu_selesai when available
                                            $end = $item->waktu_selesai ? \Carbon\Carbon::parse($item->tanggal . ' ' . $item->waktu_selesai) : \Carbon\Carbon::parse($item->tanggal)->endOfDay();
                                            if ($pj && $pj->tanggal_pengembalian) {
                                                $isLate = \Carbon\Carbon::parse($pj->tanggal_pengembalian)->greaterThan($end);
                                            }
                                        } catch (\Exception $e) {
                                            $isLate = false;
                                        }

                                        $duePassed = false;
                                        try {
                                            $end = $item->waktu_selesai ? \Carbon\Carbon::parse($item->tanggal . ' ' . $item->waktu_selesai) : \Carbon\Carbon::parse($item->tanggal)->endOfDay();
                                            $duePassed = !$pj && \Carbon\Carbon::now()->greaterThan($end) && $item->status == 'disetujui';
                                        } catch (\Exception $e) {
                                            $duePassed = false;
                                        }
                                    @endphp

                                    <tr data-status="{{ $item->status }}" data-id="{{ $item->id }}"
                                        class="{{ $isOngoing ? 'today-indicator' : '' }}"
                                        data-waktu-mulai="{{ $item->display_waktu_mulai ?? ($item->waktu_mulai ?? '') }}"
                                        data-waktu-selesai="{{ $item->display_waktu_selesai ?? ($item->waktu_selesai ?? '') }}"
                                        data-waktu-pengembalian="{{ optional($item->pengembalian)->tanggal_pengembalian ? \Carbon\Carbon::parse(optional($item->pengembalian)->tanggal_pengembalian)->format('H:i') : '' }}">
                                        <td>{{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2"
                                                    style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                    {{ substr($item->user->name ?? 'G', 0, 1) }}
                                                </div>
                                                {{ $item->user->name ?? 'Guest' }}
                                            </div>
                                        </td>
                                        <td>{{ $item->dosen->nama_dosen ?? '-' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            <br>
                                            <small class="text-muted">
                                                {{ $item->display_waktu_mulai ?? ($item->waktu_mulai ?? '-') }}
                                                -
                                                {{ $item->display_waktu_selesai ?? ($item->waktu_selesai ?? '-') }}
                                            </small>
                                        </td>
                                        <td>{{ $item->ruangan->nama_ruangan ?? $item->ruang }}</td>
                                        <td>
                                            @if ($item->projector)
                                                <div>
                                                    <strong>{{ $item->projector->kode_proyektor ?? 'ID:' . $item->projector->id }}</strong>
                                                    <div class="text-muted small">{{ $item->projector->merk ?? '' }}
                                                        {{ $item->projector->model ?? '' }}</div>
                                                </div>
                                            @else
                                                <span class="badge bg-secondary">Tidak</span>
                                            @endif
                                        </td>
                                        <td title="{{ $item->keperluan }}">
                                            {{ \Illuminate\Support\Str::limit($item->keperluan, 40) }}
                                        </td>
                                        <td>
                                            @if ($isOngoing)
                                                <span class="badge status-badge status-berlangsung">
                                                    <i class="fas fa-play-circle me-1"></i> Berlangsung
                                                </span>
                                            @elseif($item->status == 'selesai')
                                                <span class="badge status-badge status-selesai">
                                                    <i class="fas fa-check-double me-1"></i> Selesai
                                                </span>
                                            @elseif($item->status == 'disetujui')
                                                @if ($duePassed)
                                                    <span class="badge status-badge status-terlambat">
                                                        <i class="fas fa-exclamation-circle me-1"></i> Terlambat
                                                    </span>
                                                @else
                                                    <span class="badge status-badge status-disetujui">
                                                        <i class="fas fa-check-circle me-1"></i> Disetujui
                                                    </span>
                                                @endif
                                            @elseif($item->status == 'ditolak')
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
                                            @if ($pj)
                                                @php $pjStatus = $pj->status; @endphp
                                                @if (in_array($pjStatus, ['verified','disetujui']))
                                                    <span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui</span>
                                                @elseif (in_array($pjStatus, ['pending']))
                                                    <span class="badge status-menunggu"><i class="fas fa-clock me-1"></i> Menunggu Verifikasi</span>
                                                @elseif (in_array($pjStatus, ['rejected','ditolak']))
                                                    <span class="badge status-ditolak"><i class="fas fa-times-circle me-1"></i> Ditolak</span>
                                                @elseif (in_array($pjStatus, ['overdue','terlambat']))
                                                    <span class="badge status-terlambat"><i class="fas fa-exclamation-circle me-1"></i> Terlambat</span>
                                                @elseif ($isLate)
                                                    <span class="badge status-terlambat"><i class="fas fa-exclamation-circle me-1"></i> Terlambat</span>
                                                @else
                                                    <span class="badge status-badge">{{ ucfirst(str_replace('_',' ',$pjStatus)) }}</span>
                                                @endif
                                            @else
                                                {{-- Tidak ada pengembalian yang tercatat untuk peminjaman ini --}}
                                                @if ($duePassed)
                                                    <span class="badge status-terlambat"><i class="fas fa-exclamation-circle me-1"></i> Terlambat</span>
                                                @elseif($item->status == 'selesai')
                                                    <span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui</span>
                                                @else
                                                    <span class="badge status-belum-dikembalikan"><i class="fas fa-box-open me-1"></i> Belum Dikembalikan</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 action-buttons">
                                                <!-- Tombol Detail -->
                                                <button class="btn btn-info-custom btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal" data-id="{{ $item->id }}"
                                                    data-peminjam="{{ $item->user->name ?? 'Guest' }}"
                                                    data-dosen="{{ $item->dosen->nama_dosen ?? '' }}"
                                                    data-dosen-nip="{{ $item->dosen_nip ?? '' }}"
                                                    data-tanggal="{{ $item->tanggal }}"
                                                    data-waktu-mulai="{{ $item->display_waktu_mulai ?? ($item->waktu_mulai ?? '') }}"
                                                    data-waktu-selesai="{{ $item->display_waktu_selesai ?? ($item->waktu_selesai ?? '') }}"
                                                    data-ruang="{{ $item->ruangan->nama_ruangan ?? $item->ruang }}"
                                                    data-projector-id="{{ $item->projector->id ?? '' }}"
                                                    data-projector-label="{{ $item->projector ? $item->projector->kode_proyektor . ' - ' . ($item->projector->merk ?? '') : 'Tidak' }}"
                                                    data-keperluan="{{ $item->keperluan }}"
                                                    data-status="{{ $item->status }}"
                                                    data-status-pengembalian="{{ optional($item->pengembalian)->status ?? '' }}"
                                                    data-tanggal-pengembalian="{{ optional($item->pengembalian)->tanggal_pengembalian ?? '' }}"
                                                    data-waktu-pengembalian="{{ optional($item->pengembalian)->tanggal_pengembalian ? \Carbon\Carbon::parse(optional($item->pengembalian)->tanggal_pengembalian)->format('H:i') : '' }}"
                                                    data-keterangan="{{ $item->catatan ?? '-' }}">
                                                    <i class="fas fa-eye me-1"></i> Detail
                                                </button>

                                                <!-- Tombol Edit -->
                                                <button class="btn btn-edit-custom btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" data-id="{{ $item->id }}"
                                                    data-peminjam="{{ $item->user->name ?? 'Guest' }}"
                                                    data-tanggal="{{ $item->tanggal }}"
                                                    data-ruangan-id="{{ $item->ruangan_id }}"
                                                    data-projector-id="{{ $item->projector_id }}"
                                                    data-waktu_mulai="{{ $item->waktu_mulai }}"
                                                    data-waktu_selesai="{{ $item->waktu_selesai }}"
                                                    data-keperluan="{{ $item->keperluan }}"
                                                    data-status="{{ $item->status }}"
                                                    data-status-pengembalian="{{ optional($item->pengembalian)->status }}"
                                                    data-tanggal-pengembalian="{{ optional($item->pengembalian)->tanggal_pengembalian }}"
                                                    data-catatan="{{ $item->catatan }}">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <button class="btn btn-danger-custom btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="{{ $item->id }}"
                                                    data-peminjam="{{ $item->user->name ?? 'Guest' }}"
                                                    data-tanggal="{{ $item->tanggal }}">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>

                                                <!-- Tombol Cetak dihilangkan per baris (dipindah ke modal jika perlu) -->
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="empty-state">
                                            <i class="fas fa-inbox"></i><br>
                                            Belum ada data riwayat peminjaman
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if ($riwayat->hasPages())
                    <div class="pagination-container">
                        <nav>
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($riwayat->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Sebelumnya</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $riwayat->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Sebelumnya</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($riwayat->getUrlRange(1, $riwayat->lastPage()) as $page => $url)
                                    @if ($page == $riwayat->currentPage())
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
                                @if ($riwayat->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $riwayat->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Selanjutnya</a>
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
            </div>

            <!-- Timeline View -->
            <div class="tab-pane fade" id="timeline-view" role="tabpanel">
                <div class="table-container p-4">
                    @forelse($riwayat as $item)
                        @php
                            $isToday = \Carbon\Carbon::parse($item->tanggal)->isToday();
                            $isOngoing = $isToday && $item->status == 'disetujui';
                        @endphp

                        <div class="timeline-item">
                            <div class="timeline-date">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </div>
                            <div class="timeline-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Peminjam:</strong> {{ $item->user->name ?? 'Guest' }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Ruang:</strong> {{ $item->ruang }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Proyektor:</strong> {{ $item->proyektor ? 'Ya' : 'Tidak' }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Status:</strong>
                                        @if ($isOngoing)
                                            <span class="badge status-badge status-berlangsung">
                                                <i class="fas fa-play-circle me-1"></i> Berlangsung
                                            </span>
                                        @elseif($item->status == 'selesai')
                                            <span class="badge status-badge status-selesai">
                                                <i class="fas fa-check-double me-1"></i> Selesai
                                            </span>
                                        @elseif($item->status == 'disetujui')
                                            <span class="badge status-badge status-disetujui">
                                                <i class="fas fa-check-circle me-1"></i> Disetujui
                                            </span>
                                        @elseif($item->status == 'ditolak')
                                            <span class="badge status-badge status-ditolak">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="badge status-badge status-menunggu">
                                                <i class="fas fa-clock me-1"></i> Menunggu
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Status Pengembalian:</strong>
                                        @php $pj = $item->pengembalian ?? null; @endphp
                                        @if($pj)
                                            @php $pjStatus = $pj->status; @endphp
                                            @if(in_array($pjStatus, ['verified','disetujui']))
                                                <span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui</span>
                                            @elseif(in_array($pjStatus, ['pending']))
                                                <span class="badge status-menunggu"><i class="fas fa-clock me-1"></i> Menunggu Verifikasi</span>
                                            @elseif(in_array($pjStatus, ['rejected','ditolak']))
                                                <span class="badge status-ditolak"><i class="fas fa-times-circle me-1"></i> Ditolak</span>
                                            @elseif(in_array($pjStatus, ['overdue','terlambat']))
                                                <span class="badge status-terlambat"><i class="fas fa-exclamation-circle me-1"></i> Terlambat</span>
                                            @else
                                                <span class="badge status-badge">{{ ucfirst(str_replace('_',' ',$pjStatus)) }}</span>
                                            @endif
                                        @else
                                            @if(
                                                (!optional($item->pengembalian)->status && \Carbon\Carbon::parse($item->tanggal)->lt(\Carbon\Carbon::now()) && $item->status == 'disetujui')
                                            )
                                                <span class="badge status-terlambat"><i class="fas fa-exclamation-circle me-1"></i> Terlambat</span>
                                            @elseif($item->status == 'selesai')
                                                <span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui</span>
                                            @else
                                                <span class="badge status-belum-dikembalikan"><i class="fas fa-box-open me-1"></i> Belum Dikembalikan</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-12 mt-2">
                                        <strong>Keperluan:</strong> {{ $item->keperluan }}
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="d-flex gap-2 action-buttons">
                                            <button class="btn btn-info-custom btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" data-id="{{ $item->id }}"
                                                data-peminjam="{{ $item->user->name ?? 'Guest' }}"
                                                data-tanggal="{{ $item->tanggal }}"
                                                data-ruang="{{ $item->ruangan->nama_ruangan ?? $item->ruang }}"
                                                data-ruangan-id="{{ $item->ruangan_id }}"
                                                data-projector-id="{{ $item->projector->id ?? '' }}"
                                                data-waktu_mulai="{{ $item->waktu_mulai ?? '' }}"
                                                data-waktu_selesai="{{ $item->waktu_selesai ?? '' }}"
                                                data-projector-label="{{ $item->projector ? $item->projector->kode_proyektor . ' - ' . ($item->projector->merk ?? '') : 'Tidak' }}"
                                                data-keperluan="{{ $item->keperluan }}"
                                                data-status="{{ $item->status }}"
                                                data-status-pengembalian="{{ optional($item->pengembalian)->status ?? '' }}"
                                                data-tanggal-pengembalian="{{ optional($item->pengembalian)->tanggal_pengembalian ?? '' }}"
                                                data-keterangan="{{ $item->catatan ?? '-' }}">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </button>
                                            <button class="btn btn-edit-custom btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{ $item->id }}"
                                                data-peminjam="{{ $item->user->name ?? 'Guest' }}"
                                                data-tanggal="{{ $item->tanggal }}"
                                                data-ruangan-id="{{ $item->ruangan_id }}"
                                                data-projector-id="{{ $item->projector_id }}"
                                                data-waktu_mulai="{{ $item->waktu_mulai }}"
                                                data-waktu_selesai="{{ $item->waktu_selesai }}"
                                                data-keperluan="{{ $item->keperluan }}"
                                                data-status="{{ $item->status }}"
                                                data-status-pengembalian="{{ optional($item->pengembalian)->status }}"
                                                data-tanggal-pengembalian="{{ optional($item->pengembalian)->tanggal_pengembalian }}"
                                                data-catatan="{{ $item->catatan }}">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>
                                            <button class="btn btn-danger-custom btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $item->id }}"
                                                data-peminjam="{{ $item->user->name ?? 'Guest' }}"
                                                data-tanggal="{{ $item->tanggal }}">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                            <!-- Tombol Cetak dihilangkan per item -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i><br>
                            Belum ada data riwayat peminjaman
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Modal Detail Riwayat -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel"><i class="fas fa-eye me-2"></i> Detail Riwayat
                            Peminjaman</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Peminjam</label>
                                <p id="detail_peminjam"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Dosen Pengampu</label>
                                <p id="detail_dosen"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Peminjaman</label>
                                <p id="detail_tanggal"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ruang</label>
                                <p id="detail_ruang"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Proyektor</label>
                                <p id="detail_proyektor"></p>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Keperluan</label>
                                <p id="detail_keperluan"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status Peminjaman</label>
                                <p id="detail_status"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status Pengembalian</label>
                                <p id="detail_status_pengembalian"></p>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Keterangan</label>
                                <p id="detail_keterangan"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="cetakDetail()">
                            <i class="fas fa-print me-1"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Riwayat -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit me-2"></i> Edit Riwayat
                                Peminjaman</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Peminjam</label>
                                    <input type="text" class="form-control" id="edit_peminjam" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Peminjaman</label>
                                    <input type="date" class="form-control" id="edit_tanggal" name="tanggal"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Ruangan</label>
                                    <select class="form-select" id="edit_ruangan_id" name="ruangan_id" required>
                                        <option value="">-- Pilih Ruangan --</option>
                                        @foreach ($ruangans as $ruangan)
                                            <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Proyektor</label>
                                    <select class="form-select" id="edit_projector_id" name="projector_id">
                                        <option value="">-- Tidak Ada --</option>
                                        @foreach ($projectors as $projector)
                                            <option value="{{ $projector->id }}">{{ $projector->kode_proyektor }} -
                                                {{ $projector->merk ?? '' }} {{ $projector->model ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Keperluan</label>
                                    <textarea class="form-control" id="edit_keperluan" name="keperluan" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status Pengembalian</label>
                                    <select class="form-select" id="edit_pengembalian_status"
                                        name="pengembalian_status">
                                        <option value="">-- Tidak Ada Pengembalian --</option>
                                        <option value="pending">Menunggu</option>
                                        <option value="verified">Disetujui</option>
                                        <option value="rejected">Ditolak</option>
                                        <option value="overdue">Terlambat</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Pengembalian</label>
                                    <input type="date" class="form-control" id="edit_tanggal_pengembalian"
                                        name="tanggal_pengembalian">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status Peminjaman</label>
                                    <select class="form-select" id="edit_status" name="status" required>
                                        <option value="pending">Menunggu</option>
                                        <option value="disetujui">Disetujui</option>
                                        <option value="berlangsung">Berlangsung</option>
                                        <option value="ditolak">Ditolak</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="edit_waktu_mulai"
                                        name="waktu_mulai">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="edit_waktu_selesai"
                                        name="waktu_selesai">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Catatan</label>
                                    <textarea class="form-control" id="edit_catatan" name="catatan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Riwayat -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-trash me-2"></i> Hapus
                                Riwayat Peminjaman</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus riwayat peminjaman ini?</p>
                            <div class="alert alert-warning">
                                <strong>Peminjam:</strong> <span id="delete_peminjam"></span><br>
                                <strong>Tanggal:</strong> <span id="delete_tanggal"></span>
                            </div>
                            <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Hapus
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
            const searchInputs = document.querySelectorAll('input[name="search"]');

            searchInputs.forEach(input => {
                input.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        console.log('Auto-submitting search:', this.value);
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

            // Handler untuk modal detail
            const detailModal = document.getElementById('detailModal');
            if (detailModal) {
                detailModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const peminjam = button.getAttribute('data-peminjam');
                    const tanggal = button.getAttribute('data-tanggal');
                    const ruang = button.getAttribute('data-ruang');
                    const proyektor = button.getAttribute('data-projector-label') || button.getAttribute(
                        'data-proyektor');
                    const waktuMulai = button.getAttribute('data-waktu-mulai');
                    const waktuSelesai = button.getAttribute('data-waktu-selesai');
                    const waktuPengembalian = button.getAttribute('data-waktu-pengembalian');
                    const keperluan = button.getAttribute('data-keperluan');
                    const status = button.getAttribute('data-status');
                    const statusPengembalian = button.getAttribute('data-status-pengembalian');
                    const keterangan = button.getAttribute('data-keterangan');
                    const dosen = button.getAttribute('data-dosen');

                    // Isi data detail (tanggal + waktu)
                    document.getElementById('detail_peminjam').textContent = peminjam;
                    document.getElementById('detail_dosen').textContent = dosen || '-';
                    document.getElementById('detail_tanggal').textContent = formatDate(tanggal) + (waktuMulai ? ' ' + formatTime(waktuMulai) : '');
                    document.getElementById('detail_ruang').textContent = ruang;
                    document.getElementById('detail_proyektor').textContent = proyektor;
                    document.getElementById('detail_keperluan').textContent = keperluan;

                    // Tampilkan juga waktu jatuh tempo / pengembalian jika ada
                    if (waktuSelesai) {
                        const el = document.getElementById('detail_tanggal');
                        el.innerHTML += '<br><small class="text-muted">Slot: ' + formatTime(waktuMulai) + ' - ' + formatTime(waktuSelesai) + '</small>';
                    }

                    // Format status peminjaman
                    let statusText = '';
                    if (status === 'selesai') {
                        statusText =
                            '<span class="badge status-selesai"><i class="fas fa-check-double me-1"></i> Selesai</span>';
                    } else if (status === 'disetujui') {
                        statusText =
                            '<span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui</span>';
                    } else if (status === 'berlangsung') {
                        statusText =
                            '<span class="badge status-berlangsung"><i class="fas fa-play-circle me-1"></i> Berlangsung</span>';
                    } else if (status === 'ditolak') {
                        statusText =
                            '<span class="badge status-ditolak"><i class="fas fa-times-circle me-1"></i> Ditolak</span>';
                    } else {
                        statusText =
                            '<span class="badge status-menunggu"><i class="fas fa-clock me-1"></i> Menunggu</span>';
                    }
                    document.getElementById('detail_status').innerHTML = statusText;

                    // Format status pengembalian (gunakan nilai DB canonical)
                    let statusPengembalianText = '';
                    const pj = (statusPengembalian || '').toString().toLowerCase();
                    if (pj === 'verified' || pj === 'disetujui') {
                        statusPengembalianText = '<span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui' + (waktuPengembalian ? ' (' + formatTime(waktuPengembalian) + ')' : '') + '</span>';
                    } else if (pj === 'pending' || pj === 'menunggu') {
                        statusPengembalianText = '<span class="badge status-menunggu"><i class="fas fa-clock me-1"></i> Menunggu Verifikasi' + (waktuPengembalian ? ' (' + formatTime(waktuPengembalian) + ')' : '') + '</span>';
                    } else if (pj === 'rejected' || pj === 'ditolak') {
                        statusPengembalianText = '<span class="badge status-ditolak"><i class="fas fa-times-circle me-1"></i> Ditolak' + (waktuPengembalian ? ' (' + formatTime(waktuPengembalian) + ')' : '') + '</span>';
                    } else if (pj === 'overdue' || pj === 'terlambat') {
                        statusPengembalianText = '<span class="badge status-terlambat"><i class="fas fa-exclamation-circle me-1"></i> Terlambat' + (waktuPengembalian ? ' (' + formatTime(waktuPengembalian) + ')' : '') + '</span>';
                    } else if (waktuPengembalian) {
                        statusPengembalianText = '<span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Dikembalikan (' + formatTime(waktuPengembalian) + ')</span>';
                    } else {
                        statusPengembalianText = '<span class="badge status-belum-dikembalikan"><i class="fas fa-box-open me-1"></i> Belum Dikembalikan</span>';
                    }
                    document.getElementById('detail_status_pengembalian').innerHTML = statusPengembalianText;

                    document.getElementById('detail_keterangan').textContent = keterangan || '-';
                });
            }

            // Handler untuk modal edit
            const editModal = document.getElementById('editModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const peminjam = button.getAttribute('data-peminjam');
                    const tanggal = button.getAttribute('data-tanggal');
                    const ruanganId = button.getAttribute('data-ruangan-id') || button.getAttribute('data-ruang-id') || button.getAttribute('data-ruang');
                    const projectorId = button.getAttribute('data-projector-id') || button.getAttribute('data-projector') || '';
                    const waktuMulai = button.getAttribute('data-waktu_mulai') || button.getAttribute('data-waktu-mulai') || '';
                    const waktuSelesai = button.getAttribute('data-waktu_selesai') || button.getAttribute('data-waktu-selesai') || '';
                    let statusPengembalian = button.getAttribute('data-status-pengembalian') || button.getAttribute('data-status_pengembalian') || '';
                    const tanggalPengembalian = button.getAttribute('data-tanggal-pengembalian') || button.getAttribute('data-tanggal_pengembalian') || '';
                    const keperluan = button.getAttribute('data-keperluan') || button.getAttribute('data-keperluan') || '';
                    const status = button.getAttribute('data-status') || '';
                    const catatan = button.getAttribute('data-catatan') || button.getAttribute('data-keterangan') || '';

                    // Normalize display value 'terlambat' to DB-safe 'overdue' for the select
                    if (statusPengembalian === 'terlambat') {
                        statusPengembalian = 'overdue';
                    }

                    // Update form action URL
                    const form = document.getElementById('editForm');
                    form.action = `/admin/riwayat/${id}`;

                    // Normalize date to YYYY-MM-DD for input[type=date]
                    function normalizeDateForInput(d) {
                        if (!d) return '';
                        // If already in YYYY-MM-DD format, return as-is
                        if (/^\d{4}-\d{2}-\d{2}$/.test(d)) return d;
                        // Try parsing with Date
                        const parsed = new Date(d);
                        if (!isNaN(parsed)) return parsed.toISOString().split('T')[0];
                        // Fallback: try common US format MM/DD/YYYY
                        const parts = d.split('/');
                        if (parts.length === 3) {
                            const mm = parts[0].padStart(2, '0');
                            const dd = parts[1].padStart(2, '0');
                            const yyyy = parts[2];
                            return `${yyyy}-${mm}-${dd}`;
                        }
                        return '';
                    }

                    // Normalize time to HH:MM (24-hour) for input[type=time]
                    function normalizeTimeForInput(t) {
                        if (!t) return '';
                        t = t.trim();
                        // If contains AM/PM, convert
                        const ampmMatch = t.match(/(\d{1,2}:\d{2})(?:[:\d{2}]*)?\s*(AM|PM)/i);
                        if (ampmMatch) {
                            let [ , timePart, ampm ] = ampmMatch;
                            let [hh, mm] = timePart.split(':').map(s => parseInt(s, 10));
                            if (ampm.toUpperCase() === 'PM' && hh < 12) hh += 12;
                            if (ampm.toUpperCase() === 'AM' && hh === 12) hh = 0;
                            return `${String(hh).padStart(2,'0')}:${String(mm).padStart(2,'0')}`;
                        }
                        // If time includes seconds like 15:30:00, strip seconds
                        const secMatch = t.match(/^(\d{1,2}:\d{2}):\d{2}$/);
                        if (secMatch) return secMatch[1].padStart(5, '0');
                        // If already HH:MM or H:MM, pad
                        const simpleMatch = t.match(/^(\d{1,2}:\d{2})$/);
                        if (simpleMatch) {
                            const [hh, mm] = simpleMatch[1].split(':').map(s => s.padStart(2,'0'));
                            return `${hh}:${mm}`;
                        }
                        // Last resort: try parsing as Date and extract time
                        const dt = new Date(`1970-01-01T${t}`);
                        if (!isNaN(dt)) return dt.toTimeString().slice(0,5);
                        return '';
                    }

                    // Isi data form
                    document.getElementById('edit_peminjam').value = peminjam;
                    document.getElementById('edit_tanggal').value = normalizeDateForInput(tanggal);
                    document.getElementById('edit_ruangan_id').value = ruanganId || '';
                    document.getElementById('edit_projector_id').value = projectorId || '';
                    document.getElementById('edit_waktu_mulai').value = normalizeTimeForInput(waktuMulai) || '';
                    document.getElementById('edit_waktu_selesai').value = normalizeTimeForInput(waktuSelesai) || '';
                    document.getElementById('edit_pengembalian_status').value = statusPengembalian || '';
                    document.getElementById('edit_tanggal_pengembalian').value = tanggalPengembalian || '';
                    document.getElementById('edit_keperluan').value = keperluan;
                    document.getElementById('edit_catatan').value = catatan || '';

                    // Handle status peminjaman
                    let statusValue = status;
                    const today = new Date().toISOString().split('T')[0];

                    // Jika status adalah disetujui dan tanggal hari ini, tampilkan sebagai berlangsung
                    if (status === 'disetujui' && tanggal === today) {
                        statusValue = 'berlangsung';
                    }
                    document.getElementById('edit_status').value = statusValue;

                    // Debug log
                    console.log('Data yang akan diisi:', {
                        id,
                        peminjam,
                        tanggal,
                        ruanganId,
                        projectorId,
                        keperluan,
                        status,
                        catatan,
                        selectedStatus: statusValue
                    });
                });
            }

            // Handler untuk modal hapus
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const peminjam = button.getAttribute('data-peminjam');
                    const tanggal = button.getAttribute('data-tanggal');

                    // Update form action URL
                    const form = document.getElementById('deleteForm');
                    form.action = `/admin/riwayat/${id}`;

                    // Isi data konfirmasi
                    document.getElementById('delete_peminjam').textContent = peminjam;
                    document.getElementById('delete_tanggal').textContent = formatDate(tanggal);
                });
            }

            // Format tanggal
            function formatDate(dateString) {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
            }

            // Format waktu sederhana (HH:mm)
            function formatTime(timeString) {
                if (!timeString) return '-';
                if (typeof timeString !== 'string') return String(timeString);
                if (timeString.indexOf(':') > -1) {
                    const parts = timeString.split(':');
                    return parts[0].padStart(2, '0') + ':' + parts[1].padStart(2, '0');
                }
                try {
                    const d = new Date(timeString);
                    return d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                } catch (e) {
                    return timeString;
                }
            }

            // Fungsi cetak riwayat
            function cetakRiwayat(id) {
                console.log('Mencetak riwayat dengan ID:', id);
                // Implementasi cetak riwayat
                alert(`Fitur cetak untuk riwayat ID ${id} akan segera tersedia!`);
            }

            function cetakDetail() {
                console.log('Mencetak detail riwayat');
                // Implementasi cetak detail
                alert('Fitur cetak detail akan segera tersedia!');
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
                        'disetujui': 'Disetujui',
                        'ditolak': 'Ditolak',
                        'pending': 'Menunggu',
                        'selesai': 'Selesai',
                        'berlangsung': 'Berlangsung'
                    } [urlParams.get('status')] || urlParams.get('status');
                    activeFilters.push(`Status: ${statusText}`);
                }
                if (urlParams.get('date_from') || urlParams.get('date_to')) {
                    const dateFrom = urlParams.get('date_from') || '';
                    const dateTo = urlParams.get('date_to') || '';
                    activeFilters.push(`Periode: ${dateFrom} - ${dateTo}`);
                }

                if (activeFilters.length > 0) {
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

            // Panggil fungsi saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                showActiveFilters();

                // Debug: Tampilkan jumlah data yang difilter
                const tableRows = document.querySelectorAll('tbody tr');
                console.log('Jumlah data yang ditampilkan:', tableRows.length);

                // Terapkan dark mode jika sebelumnya diaktifkan
                if (localStorage.getItem('darkMode') === 'enabled') {
                    document.body.classList.add('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                }
            });
        </script>
    </div>
</body>

</html>
