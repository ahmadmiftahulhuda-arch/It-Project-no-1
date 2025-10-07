<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Peminjaman Sarana Prasarana</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            color: #333;
            line-height: 1.6;
            scroll-behavior: smooth;
        }
        
        /* ===== NAVBAR STYLES ===== */
        .navbar {
            background-color: var(--primary-color);
            padding: 0.8rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.5rem 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        
        .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .logo i {
            margin-right: 10px;
            transition: transform 0.3s;
        }
        
        .logo:hover i {
            transform: rotate(-10deg);
        }
        
        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            align-items: center;
        }
        
        .navbar ul li {
            margin-left: 1.2rem;
            position: relative;
        }
        
        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s;
            font-weight: 500;
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .navbar ul li a i {
            margin-right: 0.5rem;
        }
        
        .navbar ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .navbar ul li a:hover::after, 
        .navbar ul li a.active::after {
            width: 70%;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .dropdown-item {
            padding: 0.7rem 1rem;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item i {
            width: 20px;
            margin-right: 0.7rem;
        }
        
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-warning::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.5s ease;
        }
        
        .btn-warning:hover::before {
            left: 100%;
        }
        
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        /* ===== USER DASHBOARD STYLES ===== */
        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 76px);
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .user-profile {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }
        
        .user-info h4 {
            color: var(--primary-color);
            margin-bottom: 0.2rem;
        }
        
        .user-info p {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: #495057;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .sidebar-menu a i {
            margin-right: 0.8rem;
            width: 20px;
            text-align: center;
        }
        
        .sidebar-menu a:hover, 
        .sidebar-menu a.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            background-color: #f5f8fa;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .welcome-text h1 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .welcome-text p {
            color: #6c757d;
        }
        
        .date-filter {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .date-filter select {
            padding: 0.5rem;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1.2rem;
        }
        
        .stat-icon.pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: var(--warning-color);
        }
        
        .stat-icon.approved {
            background-color: rgba(40, 167, 69, 0.2);
            color: var(--success-color);
        }
        
        .stat-icon.rejected {
            background-color: rgba(220, 53, 69, 0.2);
            color: var(--danger-color);
        }
        
        .stat-icon.total {
            background-color: rgba(59, 89, 152, 0.2);
            color: var(--primary-color);
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 0.2rem;
        }
        
        .stat-info p {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* Peminjaman Table */
        .peminjaman-section {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            color: var(--primary-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .peminjaman-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .peminjaman-table th,
        .peminjaman-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        .peminjaman-table th {
            background-color: #f8f9fa;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .peminjaman-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: var(--warning-color);
        }
        
        .status-approved {
            background-color: rgba(40, 167, 69, 0.2);
            color: var(--success-color);
        }
        
        .status-rejected {
            background-color: rgba(220, 53, 69, 0.2);
            color: var(--danger-color);
        }
        
        .status-completed {
            background-color: rgba(108, 117, 125, 0.2);
            color: #6c757d;
        }
        
        .action-btn {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-block;
            margin-right: 0.5rem;
        }
        
        .btn-view {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-cancel {
            background-color: var(--danger-color);
            color: white;
        }
        
        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .action-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }
        
        .action-card h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .action-card p {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        /* Calendar Preview */
        .calendar-preview {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }
        
        .calendar-day {
            text-align: center;
            padding: 0.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .calendar-date {
            text-align: center;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
        }
        
        .calendar-date:hover {
            background-color: #f8f9fa;
        }
        
        .calendar-date.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .calendar-date.has-booking {
            position: relative;
        }
        
        .calendar-date.has-booking::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: var(--success-color);
            border-radius: 50%;
            bottom: 3px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        /* Form Styles */
        .form-section {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        /* Profile Styles */
        .profile-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            margin-right: 1.5rem;
        }
        
        .profile-info h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .profile-info p {
            color: #6c757d;
        }
        
        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .detail-item {
            margin-bottom: 1rem;
        }
        
        .detail-item label {
            display: block;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.3rem;
        }
        
        .detail-item p {
            color: #495057;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 4px;
            margin: 0;
        }
        
        /* Settings Styles */
        .settings-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .settings-section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .settings-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .settings-section h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Modal Styles */
        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        
        /* Content Pages */
        .content-page {
            display: none;
        }
        
        .content-page.active {
            display: block;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                padding: 1rem;
            }
            
            .sidebar-menu {
                display: flex;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .sidebar-menu li {
                margin-bottom: 0;
                margin-right: 0.5rem;
            }
            
            .sidebar-menu a {
                white-space: nowrap;
            }
            
            .user-profile {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar ul li {
                margin: 0.3rem;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-avatar {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .main-content {
                padding: 1rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .navbar ul li a span {
                display: none;
            }
            
            .navbar ul li a i {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <a href="/home" class="logo">
            <i class="fas fa-building"></i>SarPras TI
        </a>
        <ul>
            <li><a href="#" data-page="home"><i class="fas fa-home"></i> <span>Beranda</span></a></li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-calendar-alt"></i> <span>Kalender</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-page="kalender-perkuliahan"><i class="fas fa-school"></i> Kalender Perkuliahan</a></li>
                    <li><a class="dropdown-item" href="#" data-page="kalender-peminjaman"><i class="fas fa-calendar-days"></i> Kalender Peminjaman</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-hand-holding"></i> <span>Peminjaman</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-page="ajukan-peminjaman"><i class="fas fa-plus-circle"></i> Ajukan Peminjaman</a></li>
                    <li><a class="dropdown-item" href="#" data-page="riwayat-peminjaman"><i class="fas fa-history"></i> Riwayat Peminjaman</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-info-circle"></i> <span>Informasi</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-page="informasi-ti"><i class="fas fa-laptop-code"></i> Informasi TI</a></li>
                    <li><a class="dropdown-item" href="#" data-page="tentang"><i class="fas fa-question-circle"></i> Tentang Sistem</a></li>
                </ul>
            </li>
            <li>
                <div class="dropdown">
                    <a href="#" class="btn-warning dropdown-toggle" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> <span>Dimas Aprianto</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#" data-page="profil"><i class="fa-solid fa-user me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#" data-page="pengaturan"><i class="fa-solid fa-gear me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-profile">
                <div class="user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="user-info">
                    <h4>M. Dimas Aprianto</h4>
                    <p>Mahasiswa TI - 202410001</p>
                </div>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="#" data-page="home" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a href="#" data-page="ajukan-peminjaman"><i class="fa-solid fa-calendar-plus"></i> Ajukan Peminjaman</a></li>
                <li><a href="#" data-page="riwayat-peminjaman"><i class="fa-solid fa-list"></i> Riwayat Peminjaman</a></li>
                <li><a href="#" data-page="kalender-peminjaman"><i class="fa-solid fa-calendar-days"></i> Kalender Saya</a></li>
                <li><a href="#" data-page="profil"><i class="fa-solid fa-user"></i> Profil Saya</a></li>
                <li><a href="#" data-page="pengaturan"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Dashboard Home Page -->
            <div id="home" class="content-page active">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Selamat Datang, Dimas!</h1>
                        <p>Kelola peminjaman sarana prasarana dengan mudah</p>
                    </div>
                    
                    <div class="date-filter">
                        <select class="form-select">
                            <option>Hari Ini</option>
                            <option>Minggu Ini</option>
                            <option>Bulan Ini</option>
                            <option selected>Semua</option>
                        </select>
                    </div>
                </div>
                
                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Menunggu Persetujuan</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon approved">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>12</h3>
                            <p>Disetujui</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon rejected">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class="stat-info">
                            <h3>2</h3>
                            <p>Ditolak</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon total">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <div class="stat-info">
                            <h3>19</h3>
                            <p>Total Peminjaman</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-door-open"></i>
                        </div>
                        <h4>Pinjam Ruangan</h4>
                        <p>Ajukan peminjaman ruangan untuk kegiatan akademik</p>
                        <a href="#" data-page="ajukan-peminjaman" class="btn btn-primary btn-sm">Ajukan Sekarang</a>
                    </div>
                    
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-projector"></i>
                        </div>
                        <h4>Pinjam Proyektor</h4>
                        <p>Pinjam proyektor untuk presentasi dan pembelajaran</p>
                        <a href="#" data-page="ajukan-peminjaman" class="btn btn-primary btn-sm">Ajukan Sekarang</a>
                    </div>
                    
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-laptop"></i>
                        </div>
                        <h4>Pinjam Perangkat</h4>
                        <p>Pinjam perangkat TI untuk keperluan akademik</p>
                        <a href="#" data-page="ajukan-peminjaman" class="btn btn-primary btn-sm">Ajukan Sekarang</a>
                    </div>
                </div>
                
                <!-- Peminjaman Terbaru Section -->
                <div class="peminjaman-section">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-clock-rotate-left"></i> Peminjaman Terbaru</h3>
                        <a href="#" data-page="riwayat-peminjaman" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="peminjaman-table">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Nama Barang/Ruangan</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fa-solid fa-door-open"></i> Ruangan</td>
                                    <td>Lab. Jaringan Komputer</td>
                                    <td>15 Sep 2025</td>
                                    <td>08:00 - 10:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-projector"></i> Proyektor</td>
                                    <td>Proyektor Epson</td>
                                    <td>16 Sep 2025</td>
                                    <td>13:00 - 15:00</td>
                                    <td><span class="status-badge status-pending">Menunggu</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                        <a href="#" class="action-btn btn-cancel">Batal</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-laptop"></i> Perangkat</td>
                                    <td>Laptop ASUS ROG</td>
                                    <td>14 Sep 2025</td>
                                    <td>10:00 - 12:00</td>
                                    <td><span class="status-badge status-rejected">Ditolak</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-door-open"></i> Ruangan</td>
                                    <td>Ruang Rapat TI</td>
                                    <td>18 Sep 2025</td>
                                    <td>09:00 - 11:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-projector"></i> Proyektor</td>
                                    <td>Proyektor BenQ</td>
                                    <td>20 Sep 2025</td>
                                    <td>14:00 - 16:00</td>
                                    <td><span class="status-badge status-pending">Menunggu</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                        <a href="#" class="action-btn btn-cancel">Batal</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Calendar Preview -->
                <div class="calendar-preview">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-calendar-days"></i> Kalender Peminjaman</h3>
                        <a href="#" data-page="kalender-peminjaman" class="btn btn-outline-primary btn-sm">Lihat Lengkap</a>
                    </div>
                    
                    <div class="calendar-header">
                        <h4>September 2025</h4>
                    </div>
                    
                    <div class="calendar-grid">
                        <div class="calendar-day">Min</div>
                        <div class="calendar-day">Sen</div>
                        <div class="calendar-day">Sel</div>
                        <div class="calendar-day">Rab</div>
                        <div class="calendar-day">Kam</div>
                        <div class="calendar-day">Jum</div>
                        <div class="calendar-day">Sab</div>
                        
                        <!-- Empty days -->
                        <div class="calendar-date"></div>
                        <div class="calendar-date">1</div>
                        <div class="calendar-date">2</div>
                        <div class="calendar-date">3</div>
                        <div class="calendar-date">4</div>
                        <div class="calendar-date">5</div>
                        <div class="calendar-date">6</div>
                        
                        <div class="calendar-date">7</div>
                        <div class="calendar-date">8</div>
                        <div class="calendar-date">9</div>
                        <div class="calendar-date">10</div>
                        <div class="calendar-date">11</div>
                        <div class="calendar-date">12</div>
                        <div class="calendar-date">13</div>
                        
                        <div class="calendar-date">14</div>
                        <div class="calendar-date active">15</div>
                        <div class="calendar-date has-booking">16</div>
                        <div class="calendar-date">17</div>
                        <div class="calendar-date has-booking">18</div>
                        <div class="calendar-date">19</div>
                        <div class="calendar-date has-booking">20</div>
                        
                        <div class="calendar-date">21</div>
                        <div class="calendar-date">22</div>
                        <div class="calendar-date">23</div>
                        <div class="calendar-date">24</div>
                        <div class="calendar-date">25</div>
                        <div class="calendar-date">26</div>
                        <div class="calendar-date">27</div>
                        
                        <div class="calendar-date">28</div>
                        <div class="calendar-date">29</div>
                        <div class="calendar-date">30</div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                    </div>
                </div>
            </div>
            
            <!-- Ajukan Peminjaman Page -->
            <div id="ajukan-peminjaman" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Ajukan Peminjaman</h1>
                        <p>Isi formulir untuk mengajukan peminjaman sarana prasarana</p>
                    </div>
                </div>
                
                <div class="form-section">
                    <form id="peminjaman-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenisPeminjaman">Jenis Peminjaman</label>
                                    <select class="form-select" id="jenisPeminjaman" required>
                                        <option value="">Pilih Jenis Peminjaman</option>
                                        <option value="ruangan">Ruangan</option>
                                        <option value="proyektor">Proyektor</option>
                                        <option value="perangkat">Perangkat TI</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="itemPeminjaman">Pilih Barang/Ruangan</label>
                                    <select class="form-select" id="itemPeminjaman" required>
                                        <option value="">Pilih Barang/Ruangan</option>
                                        <option value="lab-jarkom">Lab. Jaringan Komputer</option>
                                        <option value="lab-multimedia">Lab. Multimedia</option>
                                        <option value="ruang-rapt">Ruang Rapat TI</option>
                                        <option value="proyektor-eps">Proyektor Epson</option>
                                        <option value="proyektor-benq">Proyektor BenQ</option>
                                        <option value="laptop-asus">Laptop ASUS ROG</option>
                                        <option value="laptop-lenovo">Laptop Lenovo ThinkPad</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="tanggalPeminjaman">Tanggal Peminjaman</label>
                                    <input type="date" class="form-control" id="tanggalPeminjaman" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="waktuMulai">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="waktuMulai" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="waktuSelesai">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="waktuSelesai" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="keperluan">Keperluan Peminjaman</label>
                                    <textarea class="form-control" id="keperluan" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="keterangan">Keterangan Tambahan (Opsional)</label>
                            <textarea class="form-control" id="keterangan" rows="2"></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <button type="reset" class="btn btn-secondary me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Riwayat Peminjaman Page -->
            <div id="riwayat-peminjaman" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Riwayat Peminjaman</h1>
                        <p>Lihat semua riwayat peminjaman yang telah Anda ajukan</p>
                    </div>
                    
                    <div class="date-filter">
                        <select class="form-select">
                            <option>Hari Ini</option>
                            <option>Minggu Ini</option>
                            <option>Bulan Ini</option>
                            <option selected>Semua</option>
                        </select>
                    </div>
                </div>
                
                <div class="peminjaman-section">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-history"></i> Semua Riwayat Peminjaman</h3>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2"><i class="fa-solid fa-download"></i> Ekspor</button>
                            <button class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="peminjaman-table">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Nama Barang/Ruangan</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fa-solid fa-door-open"></i> Ruangan</td>
                                    <td>Lab. Jaringan Komputer</td>
                                    <td>15 Sep 2025</td>
                                    <td>08:00 - 10:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-projector"></i> Proyektor</td>
                                    <td>Proyektor Epson</td>
                                    <td>16 Sep 2025</td>
                                    <td>13:00 - 15:00</td>
                                    <td><span class="status-badge status-pending">Menunggu</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                        <a href="#" class="action-btn btn-cancel">Batal</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-laptop"></i> Perangkat</td>
                                    <td>Laptop ASUS ROG</td>
                                    <td>14 Sep 2025</td>
                                    <td>10:00 - 12:00</td>
                                    <td><span class="status-badge status-rejected">Ditolak</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-door-open"></i> Ruangan</td>
                                    <td>Ruang Rapat TI</td>
                                    <td>18 Sep 2025</td>
                                    <td>09:00 - 11:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-projector"></i> Proyektor</td>
                                    <td>Proyektor BenQ</td>
                                    <td>20 Sep 2025</td>
                                    <td>14:00 - 16:00</td>
                                    <td><span class="status-badge status-pending">Menunggu</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                        <a href="#" class="action-btn btn-cancel">Batal</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-door-open"></i> Ruangan</td>
                                    <td>Lab. Multimedia</td>
                                    <td>10 Sep 2025</td>
                                    <td>13:00 - 15:00</td>
                                    <td><span class="status-badge status-completed">Selesai</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-laptop"></i> Perangkat</td>
                                    <td>Laptop Lenovo ThinkPad</td>
                                    <td>05 Sep 2025</td>
                                    <td>10:00 - 12:00</td>
                                    <td><span class="status-badge status-completed">Selesai</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <!-- Kalender Perkuliahan Page -->
            <div id="kalender-perkuliahan" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Kalender Perkuliahan</h1>
                        <p>Jadwal perkuliahan dan akademik Program Studi Teknologi Informasi</p>
                    </div>
                    
                    <div class="date-filter">
                        <select class="form-select">
                            <option>Semester Ganjil 2025/2026</option>
                            <option>Semester Genap 2024/2025</option>
                            <option>Semester Ganjil 2024/2025</option>
                        </select>
                    </div>
                </div>
                
                <div class="calendar-preview">
                    <div class="calendar-header">
                        <h4>September 2025</h4>
                    </div>
                    
                    <div class="calendar-grid">
                        <div class="calendar-day">Min</div>
                        <div class="calendar-day">Sen</div>
                        <div class="calendar-day">Sel</div>
                        <div class="calendar-day">Rab</div>
                        <div class="calendar-day">Kam</div>
                        <div class="calendar-day">Jum</div>
                        <div class="calendar-day">Sab</div>
                        
                        <!-- Empty days -->
                        <div class="calendar-date"></div>
                        <div class="calendar-date">1</div>
                        <div class="calendar-date">2</div>
                        <div class="calendar-date">3</div>
                        <div class="calendar-date">4</div>
                        <div class="calendar-date">5</div>
                        <div class="calendar-date">6</div>
                        
                        <div class="calendar-date">7</div>
                        <div class="calendar-date">8</div>
                        <div class="calendar-date">9</div>
                        <div class="calendar-date">10</div>
                        <div class="calendar-date">11</div>
                        <div class="calendar-date">12</div>
                        <div class="calendar-date">13</div>
                        
                        <div class="calendar-date">14</div>
                        <div class="calendar-date active">15</div>
                        <div class="calendar-date has-booking">16</div>
                        <div class="calendar-date">17</div>
                        <div class="calendar-date has-booking">18</div>
                        <div class="calendar-date">19</div>
                        <div class="calendar-date has-booking">20</div>
                        
                        <div class="calendar-date">21</div>
                        <div class="calendar-date">22</div>
                        <div class="calendar-date">23</div>
                        <div class="calendar-date">24</div>
                        <div class="calendar-date">25</div>
                        <div class="calendar-date">26</div>
                        <div class="calendar-date">27</div>
                        
                        <div class="calendar-date">28</div>
                        <div class="calendar-date">29</div>
                        <div class="calendar-date">30</div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                    </div>
                </div>
                
                <div class="peminjaman-section mt-4">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-calendar-days"></i> Jadwal Penting</h3>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="peminjaman-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 Sep 2025</td>
                                    <td>Awal Semester Ganjil 2025/2026</td>
                                    <td>Perkuliahan dimulai</td>
                                </tr>
                                <tr>
                                    <td>15 Sep 2025</td>
                                    <td>Ujian Tengah Semester</td>
                                    <td>UTS untuk semua mata kuliah</td>
                                </tr>
                                <tr>
                                    <td>1 Okt 2025</td>
                                    <td>Batas Pengajuan Judul Skripsi</td>
                                    <td>Untuk mahasiswa semester akhir</td>
                                </tr>
                                <tr>
                                    <td>15 Okt 2025</td>
                                    <td>Seminar Proposal</td>
                                    <td>Jadwal seminar proposal skripsi</td>
                                </tr>
                                <tr>
                                    <td>1 Nov 2025</td>
                                    <td>Ujian Akhir Semester</td>
                                    <td>UAS untuk semua mata kuliah</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Kalender Peminjaman Page -->
            <div id="kalender-peminjaman" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Kalender Peminjaman</h1>
                        <p>Lihat jadwal peminjaman sarana prasarana yang telah Anda ajukan</p>
                    </div>
                    
                    <div class="date-filter">
                        <select class="form-select">
                            <option>September 2025</option>
                            <option>Oktober 2025</option>
                            <option>November 2025</option>
                            <option>Desember 2025</option>
                        </select>
                    </div>
                </div>
                
                <div class="calendar-preview">
                    <div class="calendar-header">
                        <h4>September 2025</h4>
                    </div>
                    
                    <div class="calendar-grid">
                        <div class="calendar-day">Min</div>
                        <div class="calendar-day">Sen</div>
                        <div class="calendar-day">Sel</div>
                        <div class="calendar-day">Rab</div>
                        <div class="calendar-day">Kam</div>
                        <div class="calendar-day">Jum</div>
                        <div class="calendar-day">Sab</div>
                        
                        <!-- Empty days -->
                        <div class="calendar-date"></div>
                        <div class="calendar-date">1</div>
                        <div class="calendar-date">2</div>
                        <div class="calendar-date">3</div>
                        <div class="calendar-date">4</div>
                        <div class="calendar-date">5</div>
                        <div class="calendar-date">6</div>
                        
                        <div class="calendar-date">7</div>
                        <div class="calendar-date">8</div>
                        <div class="calendar-date">9</div>
                        <div class="calendar-date">10</div>
                        <div class="calendar-date">11</div>
                        <div class="calendar-date">12</div>
                        <div class="calendar-date">13</div>
                        
                        <div class="calendar-date">14</div>
                        <div class="calendar-date active">15</div>
                        <div class="calendar-date has-booking">16</div>
                        <div class="calendar-date">17</div>
                        <div class="calendar-date has-booking">18</div>
                        <div class="calendar-date">19</div>
                        <div class="calendar-date has-booking">20</div>
                        
                        <div class="calendar-date">21</div>
                        <div class="calendar-date">22</div>
                        <div class="calendar-date">23</div>
                        <div class="calendar-date">24</div>
                        <div class="calendar-date">25</div>
                        <div class="calendar-date">26</div>
                        <div class="calendar-date">27</div>
                        
                        <div class="calendar-date">28</div>
                        <div class="calendar-date">29</div>
                        <div class="calendar-date">30</div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                        <div class="calendar-date"></div>
                    </div>
                </div>
                
                <div class="peminjaman-section mt-4">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-list"></i> Peminjaman Bulan Ini</h3>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="peminjaman-table">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Nama Barang/Ruangan</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fa-solid fa-door-open"></i> Ruangan</td>
                                    <td>Lab. Jaringan Komputer</td>
                                    <td>15 Sep 2025</td>
                                    <td>08:00 - 10:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-projector"></i> Proyektor</td>
                                    <td>Proyektor Epson</td>
                                    <td>16 Sep 2025</td>
                                    <td>13:00 - 15:00</td>
                                    <td><span class="status-badge status-pending">Menunggu</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                        <a href="#" class="action-btn btn-cancel">Batal</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-door-open"></i> Ruangan</td>
                                    <td>Ruang Rapat TI</td>
                                    <td>18 Sep 2025</td>
                                    <td>09:00 - 11:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-projector"></i> Proyektor</td>
                                    <td>Proyektor BenQ</td>
                                    <td>20 Sep 2025</td>
                                    <td>14:00 - 16:00</td>
                                    <td><span class="status-badge status-pending">Menunggu</span></td>
                                    <td>
                                        <a href="#" class="action-btn btn-view">Detail</a>
                                        <a href="#" class="action-btn btn-cancel">Batal</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Profil Page -->
            <div id="profil" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Profil Saya</h1>
                        <p>Kelola informasi profil akun Anda</p>
                    </div>
                </div>
                
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="profile-info">
                            <h3>M. Dimas Aprianto</h3>
                            <p>Mahasiswa Program Studi Teknologi Informasi</p>
                            <p class="text-muted">NIM: 202410001</p>
                        </div>
                    </div>
                    
                    <div class="profile-details">
                        <div>
                            <div class="detail-item">
                                <label>Nama Lengkap</label>
                                <p>M. Dimas Aprianto</p>
                            </div>
                            <div class="detail-item">
                                <label>NIM</label>
                                <p>202410001</p>
                            </div>
                            <div class="detail-item">
                                <label>Program Studi</label>
                                <p>Teknologi Informasi</p>
                            </div>
                            <div class="detail-item">
                                <label>Angkatan</label>
                                <p>2024</p>
                            </div>
                        </div>
                        
                        <div>
                            <div class="detail-item">
                                <label>Email</label>
                                <p>dimas.aprianto@student.example.ac.id</p>
                            </div>
                            <div class="detail-item">
                                <label>Nomor Telepon</label>
                                <p>081234567890</p>
                            </div>
                            <div class="detail-item">
                                <label>Alamat</label>
                                <p>Jl. Contoh Alamat No. 123, Kota Contoh</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-primary" data-page="pengaturan"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profil</button>
                    </div>
                </div>
                
                <div class="peminjaman-section">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-chart-bar"></i> Statistik Peminjaman</h3>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon total">
                                <i class="fa-solid fa-list"></i>
                            </div>
                            <div class="stat-info">
                                <h3>19</h3>
                                <p>Total Peminjaman</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon approved">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="stat-info">
                                <h3>12</h3>
                                <p>Disetujui</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon pending">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="stat-info">
                                <h3>5</h3>
                                <p>Menunggu</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon rejected">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div class="stat-info">
                                <h3>2</h3>
                                <p>Ditolak</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pengaturan Page -->
            <div id="pengaturan" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Pengaturan Akun</h1>
                        <p>Kelola preferensi dan keamanan akun Anda</p>
                    </div>
                </div>
                
                <div class="settings-card">
                    <div class="settings-section">
                        <h4><i class="fa-solid fa-user"></i> Informasi Profil</h4>
                        
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namaLengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" value="M. Dimas Aprianto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nim">NIM</label>
                                        <input type="text" class="form-control" id="nim" value="202410001" disabled>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" value="dimas.aprianto@student.example.ac.id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon">Nomor Telepon</label>
                                        <input type="tel" class="form-control" id="telepon" value="081234567890">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="2">Jl. Contoh Alamat No. 123, Kota Contoh</textarea>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="settings-section">
                        <h4><i class="fa-solid fa-lock"></i> Keamanan Akun</h4>
                        
                        <form>
                            <div class="form-group">
                                <label for="passwordLama">Password Lama</label>
                                <input type="password" class="form-control" id="passwordLama">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="passwordBaru">Password Baru</label>
                                        <input type="password" class="form-control" id="passwordBaru">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="konfirmasiPassword">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="konfirmasiPassword">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="settings-section">
                        <h4><i class="fa-solid fa-bell"></i> Notifikasi</h4>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="notifEmail" checked>
                            <label class="form-check-label" for="notifEmail">Email Notifikasi</label>
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="notifWhatsApp" checked>
                            <label class="form-check-label" for="notifWhatsApp">WhatsApp Notifikasi</label>
                        </div>
                        
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="notifPengingat" checked>
                            <label class="form-check-label" for="notifPengingat">Pengingat Peminjaman</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Informasi TI Page -->
            <div id="informasi-ti" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Informasi Teknologi Informasi</h1>
                        <p>Informasi terkini seputar Program Studi Teknologi Informasi</p>
                    </div>
                </div>
                
                <div class="peminjaman-section">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-newspaper"></i> Berita Terkini</h3>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Workshop Pemrograman Python</h5>
                                    <p class="card-text">Program Studi TI akan menyelenggarakan workshop pemrograman Python untuk mahasiswa semester 3 pada tanggal 25 September 2025.</p>
                                    <p class="text-muted"><small><i class="fa-solid fa-calendar me-1"></i> 25 September 2025</small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Penambahan Fasilitas Lab. Multimedia</h5>
                                    <p class="card-text">Lab. Multimedia telah dilengkapi dengan 10 unit komputer spesifikasi tinggi dan perangkat multimedia terbaru untuk mendukung kegiatan perkuliahan.</p>
                                    <p class="text-muted"><small><i class="fa-solid fa-calendar me-1"></i> 20 September 2025</small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Kerjasama dengan Perusahaan Teknologi</h5>
                                    <p class="card-text">Program Studi TI menjalin kerjasama dengan perusahaan teknologi ternama untuk program magang dan penelitian bersama.</p>
                                    <p class="text-muted"><small><i class="fa-solid fa-calendar me-1"></i> 15 September 2025</small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Seminar Nasional Teknologi Informasi</h5>
                                    <p class="card-text">Program Studi TI akan mengadakan seminar nasional dengan tema "Digital Transformation in Education" pada tanggal 10 Oktober 2025.</p>
                                    <p class="text-muted"><small><i class="fa-solid fa-calendar me-1"></i> 10 Oktober 2025</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="peminjaman-section mt-4">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fa-solid fa-users"></i> Dosen & Staf</h3>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="peminjaman-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Bidang Keahlian</th>
                                    <th>Kontak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Prof. Dr. Ahmad Santoso, M.Kom.</td>
                                    <td>Ketua Program Studi</td>
                                    <td>Artificial Intelligence</td>
                                    <td>ahmad.santoso@example.ac.id</td>
                                </tr>
                                <tr>
                                    <td>Dr. Siti Rahayu, M.T.</td>
                                    <td>Dosen</td>
                                    <td>Data Science</td>
                                    <td>siti.rahayu@example.ac.id</td>
                                </tr>
                                <tr>
                                    <td>Budi Prasetyo, M.Kom.</td>
                                    <td>Dosen</td>
                                    <td>Web Development</td>
                                    <td>budi.prasetyo@example.ac.id</td>
                                </tr>
                                <tr>
                                    <td>Dewi Anggraeni, M.T.</td>
                                    <td>Dosen</td>
                                    <td>Network Security</td>
                                    <td>dewi.anggraeni@example.ac.id</td>
                                </tr>
                                <tr>
                                    <td>Rina Wijayanti, S.Kom.</td>
                                    <td>Administrasi</td>
                                    <td>-</td>
                                    <td>rina.wijayanti@example.ac.id</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Tentang Sistem Page -->
            <div id="tentang" class="content-page">
                <div class="dashboard-header">
                    <div class="welcome-text">
                        <h1>Tentang Sistem</h1>
                        <p>Informasi tentang sistem peminjaman sarana prasarana</p>
                    </div>
                </div>
                
                <div class="profile-card">
                    <h3 class="mb-4">Sistem Peminjaman Sarana Prasarana TI</h3>
                    
                    <p>Sistem ini dikembangkan untuk memudahkan proses peminjaman sarana dan prasarana yang dimiliki oleh Program Studi Teknologi Informasi. Dengan sistem ini, mahasiswa dan dosen dapat mengajukan peminjaman secara online, memantau status peminjaman, dan melihat jadwal ketersediaan sarana prasarana.</p>
                    
                    <h4 class="mt-4">Fitur Utama</h4>
                    <ul>
                        <li>Pengajuan peminjaman sarana prasarana secara online</li>
                        <li>Penjadwalan dan kalender peminjaman</li>
                        <li>Notifikasi status peminjaman</li>
                        <li>Riwayat peminjaman</li>
                        <li>Manajemen informasi pengguna</li>
                    </ul>
                    
                    <h4 class="mt-4">Sarana yang Tersedia</h4>
                    <ul>
                        <li>Ruangan (Lab. Jaringan, Lab. Multimedia, Ruang Rapat)</li>
                        <li>Proyektor</li>
                        <li>Laptop dan komputer</li>
                        <li>Perangkat pendukung lainnya</li>
                    </ul>
                    
                    <div class="mt-4">
                        <h4>Kontak Pengembang</h4>
                        <p>Jika Anda mengalami kendala atau memiliki pertanyaan mengenai sistem ini, silakan hubungi:</p>
                        <p>
                            <strong>Tim Pengembang TI</strong><br>
                            Email: support.ti@example.ac.id<br>
                            Telepon: (021) 1234-5678
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Booking Details -->
    <div class="modal fade" id="bookingDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Detail content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Sample function to show booking details
        function showBookingDetails(bookingId) {
            // In a real application, you would fetch this data from an API
            const modal = new bootstrap.Modal(document.getElementById('bookingDetailModal'));
            const modalBody = document.querySelector('#bookingDetailModal .modal-body');
            
            // Sample content
            modalBody.innerHTML = `
                <div class="booking-details">
                    <h6>Informasi Peminjaman</h6>
                    <table class="table table-sm">
                        <tr>
                            <th width="120">Jenis</th>
                            <td>Ruangan</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>Lab. Jaringan Komputer</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>15 September 2025</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>08:00 - 10:00</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="status-badge status-approved">Disetujui</span></td>
                        </tr>
                        <tr>
                            <th>Keperluan</th>
                            <td>Praktikum Jaringan Komputer</td>
                        </tr>
                    </table>
                </div>
            `;
            
            modal.show();
        }
        
        // Add event listeners to view buttons
        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                // In a real app, you would pass the actual booking ID
                showBookingDetails(123);
            });
        });
        
        // Page Navigation System
        document.addEventListener('DOMContentLoaded', function() {
            // Get all navigation links
            const navLinks = document.querySelectorAll('a[data-page]');
            
            // Handle navigation click
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetPage = this.getAttribute('data-page');
                    
                    // Hide all content pages
                    document.querySelectorAll('.content-page').forEach(page => {
                        page.classList.remove('active');
                    });
                    
                    // Show the target page
                    document.getElementById(targetPage).classList.add('active');
                    
                    // Update active state in sidebar
                    document.querySelectorAll('.sidebar-menu a').forEach(menuItem => {
                        menuItem.classList.remove('active');
                    });
                    
                    // Set active state for current page in sidebar
                    const correspondingSidebarItem = document.querySelector(`.sidebar-menu a[data-page="${targetPage}"]`);
                    if (correspondingSidebarItem) {
                        correspondingSidebarItem.classList.add('active');
                    }
                    
                    // Update page title
                    const pageTitle = document.getElementById(targetPage).querySelector('h1');
                    if (pageTitle) {
                        document.title = pageTitle.textContent + ' - Sistem Peminjaman Sarana Prasarana';
                    }
                });
            });
            
            // Handle form submissions
            document.getElementById('peminjaman-form').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Peminjaman berhasil diajukan! Silakan tunggu persetujuan.');
                // In a real application, you would send the form data to a server here
            });
        });
    </script>
</body>
</html>