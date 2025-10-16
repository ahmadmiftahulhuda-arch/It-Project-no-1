<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Barang - Lab TIK</title>
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
            <a href="/admin/dashboard" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.peminjaman.index') }}" class="menu-item">
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
            <a href="/admin/feedback" class="menu-item active">
                <i class="fas fa-comment"></i>
                <span>Feedback</span>
            </a>
            <a href="/admin/projectors" class="menu-item">
                <i class="fas fa-video"></i>
                <span>Proyektor</span>
            </a>
            <a href="/admin/jadwal-perkuliahan" class="menu-item">
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
                <input type="text" placeholder="Cari feedback...">
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
            <div class="action-buttons">
                <button class="btn btn-outline">
                    <i class="fas fa-file-export"></i> Ekspor
                </button>
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
        <div class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="search">Cari Feedback</label>
                    <input type="text" id="search" name="search" placeholder="Cari...">
                </div>
                <div class="filter-group">
                    <label for="status_filter">Status</label>
                    <select id="status_filter" name="status">
                        <option value="">Semua Status</option>
                        <option value="published">Dipublikasikan</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="rating_filter">Rating</label>
                    <select id="rating_filter" name="rating">
                        <option value="">Semua Rating</option>
                        <option value="5">5 Bintang</option>
                        <option value="4">4 Bintang</option>
                        <option value="3">3 Bintang</option>
                        <option value="2">2 Bintang</option>
                        <option value="1">1 Bintang</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="date_filter">Tanggal Feedback</label>
                    <input type="date" id="date_filter" name="date">
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-filter me-1"></i> Terapkan Filter
                </button>
                <a href="/admin/feedback" class="btn btn-outline btn-sm">
                    <i class="fas fa-refresh me-1"></i> Reset
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Peminjam</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Detail Feedback</th>
                            <th>Rating</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedback as $item)
                        <tr>
                            <td>FB{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td title="Saran: {{ $item->saran_perbaikan ?? '-' }}">
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
                                    <button class="btn btn-warning-custom btn-sm" onclick="openEditModal('{{ $item->id }}', '{{ $item->judul }}', '{{ $item->kategori }}', `{{ addslashes($item->detail_feedback) }}`, `{{ addslashes($item->saran_perbaikan) }}`, '{{ $item->rating }}', '{{ $item->status }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('feedback.destroy', ['feedback' => $item->id]) }}" method="POST" class="d-inline">
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

        <!-- Modal Edit Feedback -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Edit Feedback</h2>
                    <span class="close-btn" onclick="closeEditModal()">&times;</span>
                </div>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" id="editJudul" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" id="editKategori" class="form-control" required>
                            <option value="Fasilitas Ruangan">Fasilitas Ruangan</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <option value="Layanan Staff">Layanan Staff</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Detail Feedback</label>
                        <textarea name="detail_feedback" id="editDetailFeedback" class="form-control" maxlength="1000" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Saran Perbaikan</label>
                        <textarea name="saran_perbaikan" id="editSaranPerbaikan" class="form-control" maxlength="1000"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Rating</label>
                        <select name="rating" id="editRating" class="form-control" required>
                            <option value="1">1 ★</option>
                            <option value="2">2 ★★</option>
                            <option value="3">3 ★★★</option>
                            <option value="4">4 ★★★★</option>
                            <option value="5">5 ★★★★★</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status Publikasi</label>
                        <div class="status-radio-group">
                            <label class="radio-label">
                                <input type="radio" name="status" value="Dipublikasikan" id="statusPublished">
                                <span class="radio-custom"></span>
                                Dipublikasikan
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="status" value="Draft" id="statusDraft">
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
        </div>

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

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

            // Modal Functions
            function openEditModal(id, judul, kategori, detail_feedback, saran_perbaikan, rating, status) {
                // Set form action dengan URL yang benar
                document.getElementById('editForm').action = "/admin/feedback/" + id;
                
                // Isi form fields
                document.getElementById('editJudul').value = judul;
                document.getElementById('editKategori').value = kategori;
                document.getElementById('editDetailFeedback').value = detail_feedback;
                document.getElementById('editSaranPerbaikan').value = saran_perbaikan;
                document.getElementById('editRating').value = rating;

                // Set status radio button
                if (status === "Dipublikasikan") {
                    document.getElementById('statusPublished').checked = true;
                } else {
                    document.getElementById('statusDraft').checked = true;
                }

                // Tampilkan modal
                document.getElementById('editModal').style.display = "flex";
            }

            function closeEditModal() {
                document.getElementById('editModal').style.display = "none";
            }

            // Character count for modal
            document.addEventListener('DOMContentLoaded', function() {
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