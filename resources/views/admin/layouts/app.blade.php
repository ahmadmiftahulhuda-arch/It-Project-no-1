<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            --bg-light: #121212; /* Latar belakang body/main content */
            --bg-card: #1e1e1e; /* Latar belakang CARD (kontras) */
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
            display: flex; 
            transition: all 0.3s ease;
        }

      /* Sidebar Styles - DIPERBAIKI agar konsisten */
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

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width)); 
        }

        /* Header Styles */
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
            transition: all 0.3s ease;
        }

        .dark-mode .header {
            background: var(--bg-card);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Search Bar */
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
            color: var(--text-dark);
        }

        /* User Actions */
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
        }

        /* === Gaya Khusus Halaman Konten (Untuk Detail Kelas) === */

        /* Card Styling Modern & Dark Mode Fix */
        .card {
            border-radius: 12px !important; 
            transition: all 0.3s ease;
            background-color: var(--bg-card);
            border: 1px solid var(--border-light);
        }

        .dark-mode .card {
            background-color: #1e1e1e !important; /* Latar belakang card: #1e1e1e */
            border: 1px solid #2a2a2a !important; /* Border card: lebih terang dari latar body */
        }
        
        .dark-mode .card-header {
            background-color: var(--bg-card) !important;
            border-color: #2a2a2a !important; /* Border di header card */
        }

        /* Page Title & Button Styling */
        .page-title i {
            opacity: 0.9;
        }

        .btn {
            border-radius: 8px !important; 
        }
        
        /* Tombol Kembali (btn-outline-secondary) Dark Mode Fix */
        .dark-mode .btn-outline-secondary {
            color: var(--text-dark);
            border-color: var(--text-light);
        }

        .dark-mode .btn-outline-secondary:hover {
            background-color: #2a2a2a;
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Badge for Student Count */
        .bg-success-soft {
            background-color: rgba(76, 175, 80, 0.1) !important;
        }

        .dark-mode .bg-success-soft {
            background-color: rgba(76, 175, 80, 0.2) !important;
        }

        /* Table Enhancements */
        .table thead th {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-bottom: 2px solid var(--border-light);
        }

        .table tbody td {
            font-size: 0.95rem;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .table-head-modern {
            background-color: var(--bg-light) !important; 
        }

        /* PERBAIKAN DARK MODE UTAMA UNTUK TEKS DAN GARIS TABEL */
        
        /* Memastikan teks di sel tabel selalu terang di Dark Mode */
        .dark-mode table tbody tr td {
            color: var(--text-dark) !important; 
        }

        .dark-mode .table thead th {
            color: var(--text-light) !important; 
            border-bottom: 2px solid #2a2a2a !important; /* Garis header */
        }
        .dark-mode .table-head-modern {
            background-color: #1a1a1a !important; /* Header tabel agar kontras dengan body */
        }
        
        /* Garis pemisah antar baris */
        .dark-mode .table-hover > tbody > tr {
             border-bottom: 1px solid #2a2a2a !important; 
        }
        .dark-mode .table-hover > tbody > tr:hover > * {
            --bs-table-accent-bg: rgba(255, 255, 255, 0.05);
            color: var(--text-dark) !important;
        }

        /* DARK MODE - ELEMEN UMUM */
        .dark-mode .modal-content {
            background-color: var(--bg-card);
            color: var(--text-dark);
        }
        .dark-mode .btn-close {
            filter: invert(1); 
        }
        .text-dark-mode-aware {
            color: var(--text-dark) !important;
        }
        .dark-mode .text-secondary {
            color: var(--text-light) !important; 
        }
        
        /* Badge Program Studi Styling */
        .program-studi-badge {
            font-size: 0.85rem;
            padding: 0.5em 0.75em;
            border-radius: 50px;
            background-color: var(--primary); 
            color: white;
            display: inline-block;
            white-space: nowrap;
            transition: all 0.3s ease;
        }
        .dark-mode .program-studi-badge {
            background-color: #3f5d91 !important; 
            color: #e0e0e0 !important;
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
                <div class="menu-section">Menu Utama</div>
                <a href="/admin/dashboard" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <!-- Manajemen Peminjaman -->
                <div class="menu-section">Manajemen Peminjaman</div>
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
                <a href="/admin/feedback" class="menu-item">
                    <i class="fas fa-comment"></i>
                    <span>Feedback</span>
                </a>
                
                <!-- Manajemen Aset -->
                <div class="menu-section">Manajemen Aset</div>
                <a href="{{ route('projectors.index') }}" class="menu-item">
                    <i class="fas fa-video"></i>
                    <span>Proyektor</span>
                </a>
                <a href="/admin/ruangan" class="menu-item">
                    <i class="fas fa-door-open"></i>
                    <span>Ruangan</span>
                </a>
                
                <!-- Manajemen Akademik -->
                <div class="menu-section">Manajemen Akademik</div>
                <a href="/admin/jadwal-perkuliahan" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Jadwal Perkuliahan</span>
                </a>
                <a href="/admin/slotwaktu" class="menu-item">
                    <i class="fas fa-clock"></i>
                    <span>Slot Waktu</span>
                </a>
                <a href="/admin/mata_kuliah" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span>Matakuliah</span>
                </a>
                <a href="/admin/kelas" class="menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Kelas</span>
                </a>
                
                <!-- Manajemen Pengguna -->
                <div class="menu-section">Manajemen Pengguna</div>
                <a href="/admin/pengguna" class="menu-item active">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
                
                <!-- Laporan & Pengaturan -->
                <div class="menu-section">Laporan & Pengaturan</div>
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

    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari..." id="globalSearchHeader">
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
        
        <div class="container-fluid">
            @yield('content')
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
        });
        
        // Menambahkan kelas 'active' pada item menu yang sesuai dengan URL saat ini
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(item => {
                const itemHref = item.getAttribute('href').replace(/\/$/, "");
                const pathToCheck = currentPath.replace(/\/$/, "");

                if (itemHref === pathToCheck) {
                    item.classList.add('active');
                } else if (pathToCheck.startsWith(itemHref) && itemHref !== '/admin/dashboard' && itemHref !== '/') {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>     