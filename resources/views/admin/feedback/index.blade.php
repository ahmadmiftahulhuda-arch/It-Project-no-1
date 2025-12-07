<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Barang - Lab TIK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .status-menunggu {
            background: #fff8e1;
            color: #ff8f00;
        }

        .status-disetujui {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-ditolak {
            background: #ffebee;
            color: #c62828;
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
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: var(--bg-card);
            border-radius: 12px;
            width: 600px;
            max-width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-light);
        }

        .close-btn {
            cursor: pointer;
            font-size: 24px;
            color: var(--text-light);
        }

        .close-btn:hover {
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .char-count {
            text-align: right;
            font-size: 12px;
            color: var(--text-light);
            margin-top: 5px;
        }

        .status-radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
        }

        .radio-label input {
            display: none;
        }

        .radio-custom {
            width: 18px;
            height: 18px;
            border: 2px solid var(--border-light);
            border-radius: 50%;
            margin-right: 8px;
            position: relative;
            transition: all 0.3s ease;
        }

        .radio-label input:checked + .radio-custom {
            border-color: var(--primary);
            background: var(--primary);
        }

        .radio-label input:checked + .radio-custom::after {
            content: '';
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-light);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: var(--border-light);
            color: var(--text-dark);
        }

        .btn-cancel:hover {
            background: #bdc3c7;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary);
        }

        /* Star Rating */
        .star-rating {
            display: flex;
            gap: 5px;
            font-size: 24px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .star-rating .star {
            color: #ddd;
            transition: color 0.3s, transform 0.2s;
        }

        .star-rating .star:hover {
            transform: scale(1.2);
        }

        .star-rating .star.active {
            color: #ffc107;
        }

        .rating-stars {
            margin-bottom: 10px;
        }

        /* Alert */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        /* Spinner */
        .spinner-border {
            width: 3rem;
            height: 3rem;
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

            .modal-content {
                width: 95%;
                margin: 10px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .form-actions .btn {
                width: 100%;
                margin-bottom: 10px;
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
                    <a href="/admin/feedback" class="dropdown-item active">
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
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari feedback...">
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
                <h1>Manajemen Feedback</h1>
                <p>Kelola feedback dari pengguna Lab Teknologi Informasi</p>
            </div>

        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="stat-info">
                    <h3 id="total-feedback">{{ $totalFeedback ?? 0 }}</h3>
                    <p>Total Feedback</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon approved">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                    <h3 id="average-rating">{{ number_format($averageRating ?? 0, 1) }}</h3>
                    <p>Rating Rata-rata</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="published-count">{{ $published ?? 0 }}</h3>
                    <p>Dipublikasikan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rejected">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-info">
                    <h3 id="draft-count">{{ $draft ?? 0 }}</h3>
                    <p>Draft</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <form id="filterForm" method="GET" action="{{ route('admin.feedback.index') }}" class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="search">Cari Feedback</label>
                    <input type="text" id="search" name="search" placeholder="Cari..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label for="status_filter">Status</label>
                    <select id="status_filter" name="status">
                        <option value="">Semua Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="rating_filter">Rating</label>
                    <select id="rating_filter" name="rating">
                        <option value="">Semua Rating</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="date_filter">Tanggal Feedback</label>
                    <input type="date" id="date_filter" name="date" value="{{ request('date') }}">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="d-flex gap-2">
                    <button type="button" id="resetFilter" class="btn btn-outline">
                        <i class="fas fa-refresh me-1"></i> Reset
                    </button>
                </div>
                <a href="{{ route('admin.feedback.export', request()->query()) }}" class="btn btn-outline">
                    <i class="fas fa-file-export"></i> Ekspor
                </a>
            </div>
        </form>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="feedbackTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Peminjam</th>
                            <th>Kategori</th>
                            <th>Detail Feedback</th>
                            <th>Rating</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="feedbackTableBody">
                        @foreach($feedback as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>
                                {{ \Illuminate\Support\Str::limit($item->detail_feedback ?? '-', 50) }}
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $item->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                                <small class="text-muted">({{ $item->rating }})</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td>
                                @if($item->status == 'Dipublikasikan')
                                    <span class="badge status-disetujui">Dipublikasikan</span>
                                @else
                                    <span class="badge status-menunggu">Draft</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 action-buttons">
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-warning-custom btn-sm" 
                                            onclick="showEditModal(
                                                {{ $item->id }},
                                                '{{ $item->peminjaman->user->name ?? '-' }}',
                                                '{{ $item->kategori }}',
                                                `{{ addslashes($item->detail_feedback) }}`,
                                                {{ $item->rating }},
                                                '{{ $item->status }}'
                                            )">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.feedback.destroy', ['feedback' => $item->id]) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger-custom btn-sm" onclick="return confirm('Yakin mau hapus feedback ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $feedback->links() }}
        </div>

        <!-- Modal Edit Feedback -->
        <div id="editModal" class="modal">
            <!-- Modal content akan diisi oleh JavaScript -->
        </div>

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Theme Toggle
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

            // =============================================
            // FUNGSI UTAMA EDIT MODAL
            // =============================================

            // Fungsi untuk menampilkan modal edit tanpa AJAX
            function showEditModal(id, namaPeminjam, kategori, detailFeedback, rating, status) {
                // Escape karakter khusus untuk HTML
                const escapeHtml = (text) => {
                    return text
                        .replace(/&/g, "&amp;")
                        .replace(/</g, "&lt;")
                        .replace(/>/g, "&gt;")
                        .replace(/"/g, "&quot;")
                        .replace(/'/g, "&#039;");
                };

                // Buat modal content
                const modalContent = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Edit Feedback</h2>
                            <span class="close-btn" onclick="closeEditModal()">&times;</span>
                        </div>

                        <form id="editForm" method="POST" action="/admin/feedback/${id}">
                            @csrf
                            @method('PUT')
                            
                            <!-- Hidden input untuk ID -->
                            <input type="hidden" name="id" id="editId" value="${id}">

                            <div class="form-group">
                                <label>Peminjam</label>
                                <input type="text" class="form-control" value="${escapeHtml(namaPeminjam)}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" id="editKategori" class="form-control" required>
                                    <option value="Fasilitas Ruangan" ${kategori === 'Fasilitas Ruangan' ? 'selected' : ''}>Fasilitas Ruangan</option>
                                    <option value="Kebersihan" ${kategori === 'Kebersihan' ? 'selected' : ''}>Kebersihan</option>
                                    <option value="Layanan Staff" ${kategori === 'Layanan Staff' ? 'selected' : ''}>Layanan Staff</option>
                                    <option value="Lainnya" ${kategori === 'Lainnya' ? 'selected' : ''}>Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Detail Feedback</label>
                                <textarea name="detail_feedback" id="editDetailFeedback" class="form-control" maxlength="1000" rows="4" required>${escapeHtml(detailFeedback)}</textarea>
                                <div class="char-count">
                                    <span id="charCountModal">${detailFeedback.length}</span>/1000 karakter
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Rating</label>
                                <div class="rating-stars">
                                    <div class="star-rating" id="starRating">
                                        <span class="star" data-value="1">★</span>
                                        <span class="star" data-value="2">★</span>
                                        <span class="star" data-value="3">★</span>
                                        <span class="star" data-value="4">★</span>
                                        <span class="star" data-value="5">★</span>
                                    </div>
                                </div>
                                <select name="rating" id="editRating" class="form-control" required style="display: none;">
                                    <option value="1" ${rating == 1 ? 'selected' : ''}>1 ★</option>
                                    <option value="2" ${rating == 2 ? 'selected' : ''}>2 ★★</option>
                                    <option value="3" ${rating == 3 ? 'selected' : ''}>3 ★★★</option>
                                    <option value="4" ${rating == 4 ? 'selected' : ''}>4 ★★★★</option>
                                    <option value="5" ${rating == 5 ? 'selected' : ''}>5 ★★★★★</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status Publikasi</label>
                                <div class="status-radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="status" value="Dipublikasikan" id="statusPublished" ${status === "Dipublikasikan" ? 'checked' : ''}>
                                        <span class="radio-custom"></span>
                                        Dipublikasikan
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="status" value="Draft" id="statusDraft" ${status === "Draft" ? 'checked' : ''}>
                                        <span class="radio-custom"></span>
                                        Draft
                                    </label>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                `;
                
                // Tampilkan modal
                const modal = document.getElementById('editModal');
                modal.innerHTML = modalContent;
                modal.style.display = "flex";
                
                // Setup event listeners
                setupModalListeners(rating);
            }

            // Setup event listeners untuk modal
            function setupModalListeners(initialRating) {
                // Character count
                const detailTextarea = document.getElementById('editDetailFeedback');
                if (detailTextarea) {
                    detailTextarea.addEventListener('input', function() {
                        const charCount = document.getElementById('charCountModal');
                        if (charCount) {
                            charCount.textContent = this.value.length;
                        }
                    });
                }
                
                // Star rating
                const stars = document.querySelectorAll('.star-rating .star');
                const ratingInput = document.getElementById('editRating');
                
                if (stars.length && ratingInput) {
                    // Set initial rating
                    updateStarRating(initialRating);
                    
                    stars.forEach(star => {
                        star.addEventListener('click', function() {
                            const value = this.getAttribute('data-value');
                            ratingInput.value = value;
                            updateStarRating(value);
                        });
                        
                        star.addEventListener('mouseover', function() {
                            const value = this.getAttribute('data-value');
                            updateStarRating(value);
                        });
                    });
                    
                    // Reset rating saat mouse leave
                    const starRatingDiv = document.querySelector('.star-rating');
                    if (starRatingDiv) {
                        starRatingDiv.addEventListener('mouseleave', function() {
                            const currentRating = parseInt(ratingInput.value);
                            updateStarRating(currentRating);
                        });
                    }
                }
                
                // Form submission
                const editForm = document.getElementById('editForm');
                if (editForm) {
                    editForm.addEventListener('submit', async function(e) {
                        e.preventDefault();
                        
                        // Validasi form
                        if (!validateForm()) {
                            return;
                        }
                        
                        const formData = new FormData(this);
                        
                        try {
                            // Tampilkan loading
                            const submitBtn = this.querySelector('button[type="submit"]');
                            const originalText = submitBtn.innerHTML;
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                            submitBtn.disabled = true;
                            
                            const response = await fetch(this.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: formData
                            });
                            
                            if (response.ok) {
                                const result = await response.json();
                                alert('Feedback berhasil diperbarui!');
                                closeEditModal();
                                location.reload();
                            } else {
                                const errorData = await response.json();
                                let errorMessage = errorData.message || 'Gagal memperbarui feedback';
                                if (response.status === 422 && errorData.errors) {
                                    // Collect all error messages from the 'errors' object
                                    const errorMessages = Object.values(errorData.errors).flat();
                                    errorMessage = errorMessages.join('\n');
                                }
                                throw new Error(errorMessage);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menyimpan perubahan: ' + error.message);
                            
                            // Reset button
                            const submitBtn = editForm.querySelector('button[type="submit"]');
                            submitBtn.innerHTML = 'Simpan Perubahan';
                            submitBtn.disabled = false;
                        }
                    });
                }
            }

            // Validasi form
            function validateForm() {
                const detailFeedback = document.getElementById('editDetailFeedback').value.trim();
                if (detailFeedback.length === 0) {
                    alert('Detail feedback harus diisi');
                    return false;
                }
                
                if (detailFeedback.length > 1000) {
                    alert('Detail feedback maksimal 1000 karakter');
                    return false;
                }
                
                return true;
            }

            // Fungsi untuk update star rating visual
            function updateStarRating(rating) {
                const stars = document.querySelectorAll('.star-rating .star');
                if (stars.length) {
                    stars.forEach(star => {
                        const starValue = parseInt(star.getAttribute('data-value'));
                        if (starValue <= rating) {
                            star.classList.add('active');
                            star.style.color = '#ffc107';
                        } else {
                            star.classList.remove('active');
                            star.style.color = '#ddd';
                        }
                    });
                }
            }

            // Fungsi untuk menutup modal
            function closeEditModal() {
                document.getElementById('editModal').style.display = "none";
                document.getElementById('editModal').innerHTML = '';
            }

            // =============================================
            // FILTER DAN PENCARIAN (SERVER-SIDE)
            // =============================================
            const filterForm = document.getElementById('filterForm');
            const searchInputHeader = document.getElementById('searchInput'); // Header search input
            const searchInputForm = document.getElementById('search'); // Form search input
            const statusFilter = document.getElementById('status_filter');
            const ratingFilter = document.getElementById('rating_filter');
            const dateFilter = document.getElementById('date_filter');
            const resetFilterButton = document.getElementById('resetFilter');

            // Function to submit the form
            function submitFilterForm() {
                filterForm.submit();
            }

            // Auto-submit on change for selects and date
            statusFilter.addEventListener('change', submitFilterForm);
            ratingFilter.addEventListener('change', submitFilterForm);
            dateFilter.addEventListener('change', submitFilterForm);

            // Auto-submit on input for text search (with a small delay)
            let searchTimeout;
            searchInputForm.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(submitFilterForm, 500); // Submit after 500ms of inactivity
            });

            // Handle header search input
            searchInputHeader.addEventListener('input', () => {
                searchInputForm.value = searchInputHeader.value; // Sync header search with form search
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(submitFilterForm, 500); // Submit after 500ms of inactivity
            });

            // Reset Filter functionality
            resetFilterButton.addEventListener('click', () => {
                searchInputForm.value = '';
                searchInputHeader.value = ''; // Also clear header search
                statusFilter.value = '';
                ratingFilter.value = '';
                dateFilter.value = '';
                submitFilterForm();
            });

            // =============================================
            // INITIALIZATION
            // =============================================

            // Initialize saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                // Terapkan dark mode jika sebelumnya diaktifkan
                if (localStorage.getItem('darkMode') === 'enabled') {
                    document.body.classList.add('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                }
                
                // Tutup modal saat klik di luar modal
                window.addEventListener('click', function(event) {
                    const modal = document.getElementById('editModal');
                    if (event.target === modal) {
                        closeEditModal();
                    }
                });
                
                // Tutup modal dengan tombol ESC
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeEditModal();
                    }
                });
            });
        </script>
    </div>
</body>
</html>