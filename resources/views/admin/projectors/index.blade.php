<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TI - Manajemen Proyektor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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

        /* Dark Mode Variables */
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
            border: none;
        }

        .notification-btn:hover,
        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .dark-mode .notification-btn,
        .dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        .dark-mode .notification-btn:hover,
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

        /* Page Title */
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
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(59, 89, 152, 0.3);
            color: white;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 6px;
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

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 1px solid var(--border-light);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .dark-mode .stat-card {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-card.active {
            border: 2px solid var(--primary);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: white;
            opacity: 0.9;
        }

        .stat-icon.total { background: var(--primary); }
        .stat-icon.tersedia { background: #66bb6a; }
        .stat-icon.dipinjam { background: #ffb74d; }
        .stat-icon.rusak { background: #ef5350; }

        .stat-info h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-info p {
            margin: 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Table Container */
        .table-container {
            background: var(--bg-card);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .dark-mode .table-container {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table Header dengan Filter */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: end;
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-light);
            background: var(--bg-light);
            flex-wrap: wrap;
            gap: 15px;
        }

        .dark-mode .table-header {
            background: #252525;
            border-color: var(--border-light);
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .table-filters {
            display: flex;
            gap: 12px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 140px;
        }

        .filter-group label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-light);
            white-space: nowrap;
        }

        .filter-group select,
        .filter-group input {
            padding: 8px 12px;
            border: 1px solid var(--border-light);
            border-radius: 6px;
            background: var(--bg-card);
            font-size: 0.85rem;
            color: var(--text-dark);
            transition: all 0.3s;
            width: 100%;
            height: 38px;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .dark-mode .filter-group select,
        .dark-mode .filter-group input {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            align-items: end;
            height: 38px;
        }

        .filter-actions .btn {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            font-size: 0.85rem;
        }

        /* Table */
        .table {
            margin: 0;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .table thead th {
            background: var(--bg-light);
            border-bottom: 2px solid var(--border-light);
            font-weight: 600;
            padding: 15px;
            text-align: left;
            color: var(--dark);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .dark-mode .table thead th {
            background: #252525;
            color: var(--dark);
            border-color: var(--border-light);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-dark);
            background: var(--bg-card);
        }

        .table tbody tr {
            transition: all 0.3s;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background: var(--bg-light);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .table tbody tr:hover {
            background: #2a2a2a;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Status Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-block;
        }

        .status-tersedia {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .dark-mode .status-tersedia {
            background: #1b5e20;
            color: #a5d6a7;
        }

        .status-dipinjam {
            background: #fff8e1;
            color: #ff8f00;
        }

        .dark-mode .status-dipinjam {
            background: #5d4037;
            color: #ffcc80;
        }

        .status-rusak {
            background: #ffebee;
            color: #c62828;
        }

        .dark-mode .status-rusak {
            background: #b71c1c;
            color: #ffcdd2;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .btn-warning-custom {
            background: #ff9800;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-warning-custom:hover {
            background: #f57c00;
            transform: translateY(-1px);
            color: white;
            box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);
        }

        .btn-danger-custom {
            background: #f44336;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-danger-custom:hover {
            background: #d32f2f;
            transform: translateY(-1px);
            color: white;
            box-shadow: 0 2px 5px rgba(244, 67, 54, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
            background: var(--bg-card);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--text-light);
            opacity: 0.7;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding: 20px 0;
        }

        .pagination {
            margin: 0;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-item .page-link {
            color: var(--primary);
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .page-item .page-link:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .page-item.disabled .page-link {
            color: var(--text-light);
            background: var(--bg-light);
            border-color: var(--border-light);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .dark-mode .page-item .page-link {
            background: var(--bg-card);
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        .dark-mode .page-item .page-link:hover {
            background: var(--primary);
            color: white;
        }

        .dark-mode .page-item.disabled .page-link {
            background: #2a2a2a;
            color: var(--text-light);
        }

        /* Success Message dengan Auto-hide */
        .alert-auto-hide {
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 6px;
            margin-top: 20px;
            border: 1px solid #c3e6cb;
            position: relative;
            animation: slideIn 0.3s ease-out;
        }

        .dark-mode .alert-auto-hide {
            background: #1b5e20;
            color: #e8f5e8;
            border-color: #2e7d32;
        }

        .alert-auto-hide.hiding {
            animation: slideOut 0.3s ease-in;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        /* Info Jumlah Data */
        .data-info {
            text-align: center;
            margin: 20px 0;
            color: var(--text-light);
            font-size: 0.9rem;
            padding: 12px;
            background: var(--bg-light);
            border-radius: 6px;
            border: 1px solid var(--border-light);
        }

        .data-info strong {
            color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .table-filters {
                gap: 10px;
            }
            
            .filter-group {
                min-width: 130px;
            }
        }

        @media (max-width: 992px) {
            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            
            .table-filters {
                gap: 8px;
            }
            
            .filter-group {
                min-width: 120px;
            }
        }

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

            .stats-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .table-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
                padding: 15px;
            }

            .table-filters {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .filter-group {
                min-width: auto;
                width: 100%;
            }

            .filter-actions {
                width: 100%;
                justify-content: stretch;
            }

            .filter-actions .btn {
                flex: 1;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .pagination {
                gap: 3px;
            }

            .page-item .page-link {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }
            
            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .page-title h1 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 10px;
            }
            
            .header {
                margin-bottom: 15px;
            }
            
            .stats-container {
                margin-bottom: 20px;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                margin-right: 12px;
            }
            
            .stat-info h3 {
                font-size: 1.5rem;
            }
            
            .table {
                font-size: 0.8rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 8px 6px;
            }
            
            .btn-warning-custom,
            .btn-danger-custom {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
            
            .pagination-container {
                padding: 15px 0;
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .table-container,
        .stat-card,
        .table thead th,
        .table tbody td,
        .page-link,
        .search-bar input,
        .filter-group select,
        .filter-group input,
        .table {
            transition: all 0.3s ease;
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
            <h2>Sarpras Politala</h2>
        </div>

        <div class="sidebar-menu">
            <a href="/admin/dashboard" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fas fa-hand-holding"></i>
                <span>Peminjaman</span>
            </a>
            <a href="/admin/pengembalian" class="menu-item">
                <i class="fas fa-undo"></i>
                <span>Pengembalian</span>
            </a>
            <a href="/admin/riwayat" class="menu-item">
                <i class="fas fa-history"></i>
                <span>Riwayat Peminjaman</span>
            </a>
            <a href="/admin/feedback" class="menu-item">
                <i class="fas fa-comment"></i>
                <span>Feedback</span>
            </a>
            <a href="{{ route('projectors.index') }}" class="menu-item active">
                <i class="fas fa-video"></i>
                <span>Proyektor</span>
            </a>
            <a href="/admin/jadwalperkuliahan" class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Jadwal Perkuliahan</span>
            </a>
            <a href="/admin/ruangan" class="menu-item">
                <i class="fas fa-door-open"></i>
                <span>Ruangan</span>
            </a>
            <a href="/admin/slotwaktu" class="menu-item">
                <i class="fas fa-clock"></i>
                <span>Slot Waktu</span>
            </a>
            <a href="/admin/matakuliah" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Matakuliah</span>
            </a>
            <a href="/admin/kelas" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Kelas</span>
            </a>
            <a href="/admin/pengguna" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Pengguna</span>
            </a>
            <a href="/admin/laporan" class="menu-item">
                <i class="fas fa-chart-bar"></i>
                <span>Statistik</span>
            </a>
            <a href="/admin/pengaturan" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari kode/merk/model..." id="globalSearch">
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
                <h1>Manajemen Proyektor</h1>
                <p>Kelola data proyektor Lab Teknologi Informasi</p>
            </div>
            <div>
                <a href="{{ route('projectors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Proyektor
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card {{ !request('status') ? 'active' : '' }}" onclick="filterByStatus('')">
                <div class="stat-icon total">
                    <i class="fas fa-video"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalCount ?? 0 }}</h3>
                    <p>Total Proyektor</p>
                </div>
            </div>
            <div class="stat-card {{ request('status') == 'tersedia' ? 'active' : '' }}" onclick="filterByStatus('tersedia')">
                <div class="stat-icon tersedia">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $tersediaCount ?? 0 }}</h3>
                    <p>Tersedia</p>
                </div>
            </div>
            <div class="stat-card {{ request('status') == 'dipinjam' ? 'active' : '' }}" onclick="filterByStatus('dipinjam')">
                <div class="stat-icon dipinjam">
                    <i class="fas fa-hand-holding"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $dipinjamCount ?? 0 }}</h3>
                    <p>Dipinjam</p>
                </div>
            </div>
            <div class="stat-card {{ request('status') == 'rusak' ? 'active' : '' }}" onclick="filterByStatus('rusak')">
                <div class="stat-icon rusak">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $rusakCount ?? 0 }}</h3>
                    <p>Rusak</p>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <!-- Table Header dengan Filter -->
            <div class="table-header">
                <div class="table-title">
                    Daftar Proyektor
                </div>
                <form id="filterForm" method="GET" action="{{ route('projectors.index') }}" class="table-filters">
                    <div class="filter-group">
                        <label for="search">Cari</label>
                        <input type="text" id="search" name="search" placeholder="Kode/Merk/Model" 
                               value="{{ request('search') }}">
                    </div>
                    <div class="filter-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="rusak" {{ request('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="merk">Merk</label>
                        <select id="merk" name="merk">
                            <option value="">Semua Merk</option>
                            @foreach($merks as $merk)
                                <option value="{{ $merk }}" {{ request('merk') == $merk ? 'selected' : '' }}>{{ $merk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="sort">Urutkan</label>
                        <select id="sort" name="sort">
                            <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="kode" {{ request('sort') == 'kode' ? 'selected' : '' }}>Kode A-Z</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary" style="padding: 8px 15px;">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                    <div class="filter-group">
                        <label>&nbsp;</label>
                        <a href="{{ route('projectors.index') }}" class="btn btn-outline" style="padding: 8px 15px;">
                            <i class="fas fa-refresh"></i> Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="150">Kode Proyektor</th>
                            <th width="120">Merk</th>
                            <th width="120">Model</th>
                            <th width="100">Status</th>
                            <th>Keterangan</th>
                            <th width="120">Tanggal Dibuat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projectors as $projector)
                            <tr>
                                <td>{{ $loop->iteration + ($projectors->currentPage() - 1) * $projectors->perPage() }}</td>
                                <td><strong>{{ $projector->kode_proyektor }}</strong></td>
                                <td>{{ $projector->merk }}</td>
                                <td>{{ $projector->model }}</td>
                                <td>
                                    @if($projector->status == 'tersedia')
                                        <span class="badge status-tersedia">Tersedia</span>
                                    @elseif($projector->status == 'dipinjam')
                                        <span class="badge status-dipinjam">Dipinjam</span>
                                    @else
                                        <span class="badge status-rusak">Rusak</span>
                                    @endif
                                </td>
                                <td>
                                    <span title="{{ $projector->keterangan }}">
                                        {{ Str::limit($projector->keterangan, 50) ?: '-' }}
                                    </span>
                                </td>
                                <td>{{ $projector->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('projectors.edit', $projector->id) }}" class="btn-warning-custom">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('projectors.destroy', $projector->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger-custom" onclick="return confirm('Hapus proyektor {{ $projector->kode_proyektor }}?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">
                                    <i class="fas fa-video"></i><br>
                                    @if(request()->anyFilled(['search', 'status', 'merk']))
                                        Tidak ada data proyektor yang sesuai dengan filter
                                    @else
                                        Belum ada data proyektor
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($projectors->hasPages())
        <div class="pagination-container">
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if($projectors->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Sebelumnya</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $projectors->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Sebelumnya</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($projectors->getUrlRange(1, $projectors->lastPage()) as $page => $url)
                        @if($page == $projectors->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($projectors->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $projectors->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Selanjutnya</a>
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

        <!-- Info Jumlah Data -->
        <div style="text-align: center; margin-top: 15px; color: var(--text-light); font-size: 0.9rem;">
            Menampilkan {{ $projectors->firstItem() ?? 0 }} - {{ $projectors->lastItem() ?? 0 }} dari {{ $projectors->total() }} data
        </div>

        <!-- Success Message dengan Auto-hide -->
        @if(session('success'))
            <div class="alert-auto-hide" id="successAlert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Dark Mode
        const themeToggle = document.getElementById('theme-toggle');
        
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('darkMode', 'enabled');
            } else {
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        themeToggle.addEventListener('click', toggleDarkMode);

        // Load saved theme preference
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }

            // Auto-hide success message setelah 3 detik
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('hiding');
                    setTimeout(() => {
                        successAlert.remove();
                    }, 300);
                }, 3000);
            }

            // Set nilai global search dari filter search
            const searchValue = document.getElementById('search').value;
            document.getElementById('globalSearch').value = searchValue;
        });

        // Auto submit filter changes
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('merk').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('sort').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        // Auto submit search dengan debounce
        let searchTimeout;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 800);
        });

        // Global search
        document.getElementById('globalSearch').addEventListener('input', function() {
            document.getElementById('search').value = this.value;
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 800);
        });

        // Filter dari stats cards
        function filterByStatus(status) {
            document.getElementById('status').value = status;
            document.getElementById('filterForm').submit();
        }

        // Toggle sidebar on mobile
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>