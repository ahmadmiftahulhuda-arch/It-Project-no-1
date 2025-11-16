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

        /* User Card Styles */
        .user-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: 1px solid var(--border-light);
            border-radius: 10px;
            background: var(--bg-card);
        }

        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .user-details .detail-item {
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 8px;
        }

        .user-details .detail-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .card-title {
            font-size: 1.1rem;
            color: var(--text-dark);
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Modal backdrop transparency - HITAM TRANSPARAN TANPA BLUR */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7) !important;
            opacity: 1 !important;
        }

        .modal-backdrop.fade {
            opacity: 0 !important;
        }

        .modal-backdrop.show {
            opacity: 1 !important;
        }

        .modal {
            backdrop-filter: none !important;
        }

        .modal-content {
            background-color: var(--bg-card);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: var(--text-dark);
        }

        /* Dark mode support */
        body.dark-mode .modal-content {
            background-color: #2d3748;
            color: #ffffff;
        }

        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: #4a5568;
        }

        body.dark-mode .btn-close {
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
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        body.dark-mode .header {
            background: #1e1e1e;
            border-color: #333;
        }

        body.dark-mode .card {
            background: #1e1e1e;
            border-color: #333;
            color: #e0e0e0;
        }

        body.dark-mode .card-title {
            color: #e0e0e0;
        }

        body.dark-mode .text-muted {
            color: #a0a0a0 !important;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #2a2a2a;
            border-color: #333;
            color: #ffffff;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background: #2a2a2a;
            border-color: #4299e1;
            color: #ffffff;
        }

        /* Loading spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            
            <!-- Manajemen Peminjaman - DROPDOWN -->
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
            
            <!-- Manajemen Aset - DROPDOWN -->
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
            
            <!-- Manajemen Akademik - DROPDOWN -->
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
            
            <!-- Manajemen Pengguna - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#penggunaMenu" aria-expanded="true" aria-controls="penggunaMenu">
                    <span>Manajemen Pengguna</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse show" id="penggunaMenu">
                    <a href="/admin/pengguna" class="dropdown-item active">
                        <i class="fas fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                </div>
            </div>
            
            <!-- Laporan & Pengaturan - DROPDOWN -->
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
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari pengguna..." id="globalSearchHeader">
            </div>

            <div class="user-actions">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                </button>

                <button class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="user-profile">
                    <div class="user-avatar">A</div>
                    <div>
                        <div>Admin Lab</div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">Teknologi Informasi</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Manajemen Pengguna</h1>
                    <p class="text-muted mb-0">Kelola data pengguna sistem Lab Teknologi Informasi</p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openCreateModal()">
                        <i class="fas fa-plus me-2"></i>Tambah Pengguna
                    </button>
                </div>
            </div>

            <!-- Alert Messages -->
            <div id="alertContainer">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>

            <!-- Users Grid -->
            <div class="row g-4" id="usersGrid">
                @if(isset($users) && count($users) > 0)
                    @foreach($users as $user)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="card user-card h-100 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="card-title mb-1 fw-bold">{{ $user->nama }}</h6>
                                            @if($user->nim)
                                                <p class="text-muted small mb-2">{{ $user->nim }}</p>
                                            @endif
                                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                                            <p class="text-primary small mb-0">
                                                <i class="fab fa-whatsapp me-1"></i>{{ $user->no_hp ?? '-' }}
                                            </p>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary border-0" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item" onclick="openEditModal({{ $user->id }})">
                                                        <i class="fas fa-edit me-2"></i>Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->nama }}')">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="user-details">
                                        <div class="detail-item mb-2">
                                            <span class="badge {{ $user->peran == 'Admin Lab' ? 'bg-danger' : ($user->peran == 'Asisten' ? 'bg-primary' : 'bg-success') }}">
                                                {{ $user->peran }}
                                            </span>
                                        </div>
                                        
                                        <div class="detail-item mb-2">
                                            <small class="text-muted">Jurusan:</small>
                                            <div class="fw-medium">{{ $user->jurusan ?? '-' }}</div>
                                        </div>

                                        <div class="detail-item mb-2">
                                            <small class="text-muted">Status:</small>
                                            <div>
                                                <span class="badge {{ $user->status === 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                                    <i class="fas fa-circle me-1 small"></i>{{ $user->status }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <small class="text-muted">Bergabung:</small>
                                            <div class="fw-medium">
                                                {{ $user->tanggal_bergabung ? \Carbon\Carbon::parse($user->tanggal_bergabung)->format('d M Y') : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pt-0">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-primary btn-sm flex-fill" onclick="openEditModal({{ $user->id }})">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm flex-fill" onclick="confirmDelete({{ $user->id }}, '{{ $user->nama }}')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="card text-center py-5">
                            <div class="card-body">
                                <div class="text-muted">
                                    <i class="fas fa-users fa-3x mb-3"></i>
                                    <h4>Belum ada data pengguna</h4>
                                    <p class="mb-4">Mulai dengan menambahkan pengguna baru ke sistem</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openCreateModal()">
                                        <i class="fas fa-plus me-2"></i>Tambah Pengguna Pertama
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination Info -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan <strong>{{ count($users ?? []) }}</strong> pengguna
                </div>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleModalClose()"></button>
                </div>
                <form id="userForm" method="POST">
                    @csrf
                    <div id="formMethod"></div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                    <div class="invalid-feedback" id="namaError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback" id="emailError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim">
                                    <div class="invalid-feedback" id="nimError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP (WhatsApp)</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp">
                                    <div class="invalid-feedback" id="no_hpError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jurusan" name="jurusan" required>
                                        <option value="">Pilih Jurusan</option>
                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                        <option value="Teknik Komputer">Teknik Komputer</option>
                                        <option value="Teknik Elektro">Teknik Elektro</option>
                                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                                    </select>
                                    <div class="invalid-feedback" id="jurusanError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="peran" class="form-label">Peran <span class="text-danger">*</span></label>
                                    <select class="form-select" id="peran" name="peran" required>
                                        <option value="">Pilih Peran</option>
                                        <option value="Admin Lab">Admin Lab</option>
                                        <option value="Asisten">Asisten</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                    </select>
                                    <div class="invalid-feedback" id="peranError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                    <div class="invalid-feedback" id="statusError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" required>
                                    <div class="invalid-feedback" id="tanggal_bergabungError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="passwordFields">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="invalid-feedback" id="passwordError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="row d-none" id="changePasswordSection">
                            <div class="col-12">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="changePassword">
                                    <label class="form-check-label" for="changePassword">
                                        Ubah Password
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleModalClose()">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span id="submitBtnText">Simpan</span>
                            <div class="loading-spinner d-none" id="submitSpinner"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserName"></strong>?</p>
                    <p class="text-danger">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Global variables
    let currentEditId = null;
    let deleteUserId = null;
    let userModal = null;

    // Initialize when document is ready
    $(document).ready(function() {
        initializeEventListeners();
        // Initialize modal instance
        userModal = new bootstrap.Modal(document.getElementById('userModal'));
        
        // Initialize theme
        initializeTheme();
    });

    function initializeEventListeners() {
        // Toggle password fields when change password checkbox is clicked
        $('#changePassword').on('change', function() {
            if (this.checked) {
                $('#passwordFields').removeClass('d-none');
                $('#password').prop('required', true);
                $('#password_confirmation').prop('required', true);
            } else {
                $('#passwordFields').addClass('d-none');
                $('#password').prop('required', false);
                $('#password_confirmation').prop('required', false);
                $('#password').val('');
                $('#password_confirmation').val('');
            }
        });

        // Reset form ketika modal ditutup - PERBAIKAN: Gunakan event Bootstrap yang benar
        $('#userModal').on('hidden.bs.modal', function () {
            resetForm();
        });

        // Form submission handler
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            submitUserForm();
        });

        // Confirm delete handler
        $('#confirmDeleteBtn').on('click', function() {
            deleteUser(deleteUserId);
        });

        // Global search
        $('#globalSearchHeader').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            filterUsers(searchTerm);
        });

        // Theme toggle
        $('#theme-toggle').on('click', function() {
            toggleTheme();
        });
    }

    // Fungsi untuk menangani penutupan modal
    function handleModalClose() {
        // Reset form dan tutup modal dengan benar
        resetForm();
        if (userModal) {
            userModal.hide();
        }
    }

    function filterUsers(searchTerm) {
        const userCards = document.querySelectorAll('.col-xl-3.col-lg-4.col-md-6');
        
        userCards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            if (cardText.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function resetForm() {
        $('#userForm')[0].reset();
        clearFormErrors();
        $('#passwordFields').removeClass('d-none');
        $('#changePasswordSection').addClass('d-none');
        $('#changePassword').prop('checked', false);
        $('#password').prop('required', true);
        $('#password_confirmation').prop('required', true);
        $('#submitBtn').prop('disabled', false);
        $('#submitBtnText').text('Simpan');
        $('#submitSpinner').addClass('d-none');
        
        // Reset form action dan method
        $('#userForm').attr('action', "{{ route('pengguna.store') }}");
        $('#formMethod').html('');
        currentEditId = null;
    }

    function openCreateModal() {
        resetForm();
        $('#userModalLabel').text('Tambah Pengguna Baru');
        
        const today = new Date().toISOString().split('T')[0];
        $('#tanggal_bergabung').val(today);
        $('#status').val('Aktif');
        
        // Show modal menggunakan instance Bootstrap
        if (userModal) {
            userModal.show();
        }
    }

    function openEditModal(userId) {
        currentEditId = userId;
        
        // Reset form dulu
        resetForm();
        
        // Set action URL untuk update
        $('#userModalLabel').text('Edit Pengguna');
        $('#formMethod').html('@method("PUT")');
        $('#userForm').attr('action', `/admin/pengguna/${userId}`);
        
        // Sembunyikan password fields untuk edit
        $('#passwordFields').addClass('d-none');
        $('#changePasswordSection').removeClass('d-none');
        $('#password').prop('required', false);
        $('#password_confirmation').prop('required', false);
        
        // Coba ambil data user via AJAX
        fetchUserData(userId);
    }

    function fetchUserData(userId) {
        const submitBtn = $('#submitBtn');
        const submitBtnText = $('#submitBtnText');
        const submitSpinner = $('#submitSpinner');
        
        submitBtnText.text('Loading...');
        submitSpinner.removeClass('d-none');
        submitBtn.prop('disabled', true);

        $.ajax({
            url: `/admin/pengguna/${userId}/edit`,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            timeout: 5000,
            success: function(response) {
                if (response.user) {
                    populateEditForm(response.user);
                } else if (response.data) {
                    populateEditForm(response.data);
                } else {
                    // Jika tidak ada data, coba dengan data dari HTML
                    populateWithLocalData(userId);
                }
                showModal();
            },
            error: function(xhr, status, error) {
                // Fallback: coba populate dengan data yang ada di HTML
                populateWithLocalData(userId);
                showModal();
            }
        });
    }

    function populateWithLocalData(userId) {
        // Cari user data dari card yang ada
        const userCard = $(`[onclick*="openEditModal(${userId})"]`).closest('.user-card');
        if (userCard.length) {
            const userName = userCard.find('.card-title').text().trim();
            const userNim = userCard.find('.text-muted.small').first().text().trim();
            const userEmail = userCard.find('.text-muted.small').eq(1).text().trim();
            const userNoHp = userCard.find('.text-primary.small').text().replace('', '').trim();
            const userJurusan = userCard.find('.fw-medium').first().text().trim();
            const userPeran = userCard.find('.badge').first().text().trim();
            const userStatus = userCard.find('.badge').last().text().trim();
            
            $('#nama').val(userName);
            $('#email').val(userEmail);
            $('#nim').val(userNim);
            $('#no_hp').val(userNoHp);
            $('#jurusan').val(userJurusan);
            $('#peran').val(userPeran);
            $('#status').val(userStatus);
        }
    }

    function populateEditForm(user) {
        // Populate form fields
        $('#nama').val(user.nama || '');
        $('#email').val(user.email || '');
        $('#nim').val(user.nim || '');
        $('#no_hp').val(user.no_hp || '');
        $('#jurusan').val(user.jurusan || '');
        $('#peran').val(user.peran || '');
        $('#status').val(user.status || '');
        $('#tanggal_bergabung').val(user.tanggal_bergabung || '');
        
        clearFormErrors();
    }

    function showModal() {
        resetSubmitButton();
        // Show modal menggunakan instance Bootstrap
        if (userModal) {
            userModal.show();
        }
    }

    function resetSubmitButton() {
        $('#submitBtn').prop('disabled', false);
        $('#submitBtnText').text('Simpan Perubahan');
        $('#submitSpinner').addClass('d-none');
    }

    function submitUserForm() {
        const submitBtn = $('#submitBtn');
        const submitBtnText = $('#submitBtnText');
        const submitSpinner = $('#submitSpinner');
        
        submitBtnText.text('Menyimpan...');
        submitSpinner.removeClass('d-none');
        submitBtn.prop('disabled', true);

        const form = $('#userForm')[0];
        const url = $('#userForm').attr('action');
        const method = $('#userForm').find('input[name="_method"]').val() || 'POST';

        // Validasi form sebelum submit
        if (!form.checkValidity()) {
            form.reportValidity();
            resetSubmitButton();
            return;
        }

        // Submit form secara normal (bukan AJAX) untuk menghindari CORS issues
        form.submit();
    }

    function confirmDelete(userId, userName) {
        deleteUserId = userId;
        $('#deleteUserName').text(userName);
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    function deleteUser(userId) {
        // Create a form for deletion
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/pengguna/${userId}`;
        form.style.display = 'none';

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Add method spoofing for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    }

    function clearFormErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
    }

    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        $('#alertContainer').html(alertHtml);
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }

    // Theme functions
    function initializeTheme() {
        const savedTheme = localStorage.getItem('darkMode');
        if (savedTheme === 'enabled') {
            document.body.classList.add('dark-mode');
            $('#theme-toggle').html('<i class="fas fa-sun"></i>');
        }
    }

    function toggleTheme() {
        document.body.classList.toggle('dark-mode');

        if (document.body.classList.contains('dark-mode')) {
            $('#theme-toggle').html('<i class="fas fa-sun"></i>');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            $('#theme-toggle').html('<i class="fas fa-moon"></i>');
            localStorage.setItem('darkMode', 'disabled');
        }
    }

    // Auto-hide alerts after 5 seconds
    $(document).ready(function() {
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
</body>
</html>