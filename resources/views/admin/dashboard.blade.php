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
            --success: #2ecc71;
            --warning: #f39c12;
            --info: #3498db;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --background: #f9f9f9;
            --sidebar: #2c3e50;
            --card: #ffffff;
            --text: #333333;
            --text-light: #777777;
            --border: #dddddd;
            --sidebar-width: 260px;
        }

        .dark-mode {
            --primary: #4a6fa5;
            --secondary: #5d7ba6;
            --background: #1e272e;
            --sidebar: #1a2530;
            --card: #2d3436;
            --text: #f5f6fa;
            --text-light: #dcdde1;
            --border: #353b48;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            transition: all 0.3s ease;
        }

        .container {
            display: flex;
            min-height: 100vh;
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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            background-color: var(--card);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--background);
            border-radius: 20px;
            padding: 8px 15px;
            width: 300px;
        }

        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            color: var(--text);
            width: 100%;
            margin-left: 10px;
        }

        .user-actions {
            display: flex;
            align-items: center;
        }

        .notification-btn, .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--background);
            margin-left: 10px;
            cursor: pointer;
            position: relative;
        }

        .notification-btn::after {
            content: '3';
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-left: 15px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--info));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 10px;
        }

        /* Dashboard Content */
        .dashboard-title {
            margin-bottom: 20px;
        }

        .dashboard-title h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .dashboard-title p {
            color: var(--text-light);
            margin-top: 5px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background-color: var(--card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .bg-primary { background-color: rgba(52, 152, 219, 0.15); color: var(--primary); }
        .bg-success { background-color: rgba(46, 204, 113, 0.15); color: #2ecc71; }
        .bg-warning { background-color: rgba(241, 196, 15, 0.15); color: #f39c12; }
        .bg-danger { background-color: rgba(231, 76, 60, 0.15); color: #e74c3c; }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .stat-change {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 0.85rem;
        }

        .positive { color: #2ecc71; }
        .negative { color: #e74c3c; }

        /* Charts and Tables */
        .charts-tables {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .chart-container, .table-container {
            background-color: var(--card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Chart Placeholder */
        .chart-placeholder {
            height: 250px;
            background: linear-gradient(45deg, var(--background), var(--card));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .data-table th {
            color: var(--text-light);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-available { background-color: rgba(46, 204, 113, 0.15); color: #2ecc71; }
        .status-pending { background-color: rgba(241, 196, 15, 0.15); color: #f39c12; }
        .status-borrowed { background-color: rgba(52, 152, 219, 0.15); color: var(--primary); }

        /* Recent Activity */
        .activity-container {
            background-color: var(--card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .activity-time {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar-header h2, .menu-item span, .menu-section {
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
                margin-left: 80px;
            }
            
            .charts-tables {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-bar {
                width: 100%;
                margin-bottom: 15px;
            }
            
            .user-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .menu-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1100;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: var(--primary);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .chart-container,
        .table-container,
        .activity-container,
        .stat-card,
        .search-bar input {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar - DIPERBAIKI agar konsisten -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h2>Lab TIK</h2>
            </div>

            <div class="sidebar-menu">
                <!-- Menu Utama -->
                <div class="menu-section">Menu Utama</div>
                <a href="/admin/dashboard" class="menu-item active">
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
                <a href="/admin/pengguna" class="menu-item">
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

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari barang, peminjam, atau lainnya...">
                </div>
                
                <div class="user-actions">
                    <div class="notification-btn">
                        <i class="fas fa-bell"></i>
                    </div>
                    
                    <div class="theme-toggle" id="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </div>
                    
                    <div class="user-profile">
                        <div class="user-avatar">AD</div>
                        <div>
                            <div>Admin Lab</div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">Teknologi Informasi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Title -->
            <div class="dashboard-title">
                <h1>Dashboard Peminjaman Barang</h1>
                <p>Selamat datang! Kelola peminjaman barang di Lab Teknologi Informasi dengan mudah.</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">142</div>
                            <div class="stat-label">Total Barang</div>
                        </div>
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-laptop"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>12 barang baru bulan ini</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">38</div>
                            <div class="stat-label">Sedang Dipinjam</div>
                        </div>
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>5% dari minggu lalu</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">24</div>
                            <div class="stat-label">Permintaan Peminjaman</div>
                        </div>
                        <div class="stat-icon bg-danger">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-change negative">
                        <i class="fas fa-arrow-up"></i>
                        <span>3 menunggu persetujuan</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">97%</div>
                            <div class="stat-label">Barang Tersedia</div>
                        </div>
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>2% lebih baik dari bulan lalu</span>
                    </div>
                </div>
            </div>

            <!-- Charts and Tables -->
            <div class="charts-tables">
                <div class="chart-container">
                    <div class="section-header">
                        <div class="section-title">Statistik Peminjaman</div>
                        <a href="#" class="view-all">Lihat Laporan</a>
                    </div>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-bar" style="font-size: 2rem; margin-right: 10px;"></i>
                        Grafik Statistik Peminjaman Barang
                    </div>
                </div>
                
                <div class="table-container">
                    <div class="section-header">
                        <div class="section-title">Peminjaman Terbaru</div>
                        <a href="#" class="view-all">Lihat Semua</a>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Peminjam</th>
                                <th>Barang</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rina Dewi</td>
                                <td>Laptop Gaming</td>
                                <td>12 Nov 2023</td>
                                <td><span class="status status-borrowed">Dipinjam</span></td>
                            </tr>
                            <tr>
                                <td>Ahmad Surya</td>
                                <td>Oculus Quest 2</td>
                                <td>11 Nov 2023</td>
                                <td><span class="status status-pending">Menunggu</span></td>
                            </tr>
                            <tr>
                                <td>Maya Januari</td>
                                <td>Raspberry Pi 4</td>
                                <td>10 Nov 2023</td>
                                <td><span class="status status-available">Dikembalikan</span></td>
                            </tr>
                            <tr>
                                <td>David Kim</td>
                                <td>Kamera DSLR</td>
                                <td>9 Nov 2023</td>
                                <td><span class="status status-borrowed">Dipinjam</span></td>
                            </tr>
                            <tr>
                                <td>Sarah Johnson</td>
                                <td>Tablet Graphic</td>
                                <td>8 Nov 2023</td>
                                <td><span class="status status-available">Dikembalikan</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="activity-container">
                <div class="section-header">
                    <div class="section-title">Aktivitas Terkini</div>
                    <a href="#" class="view-all">Lihat Semua</a>
                </div>
                
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon bg-primary">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Rina Dewi meminjam Laptop Gaming</div>
                            <div class="activity-time">2 menit yang lalu</div>
                        </div>
                    </li>
                    
                    <li class="activity-item">
                        <div class="activity-icon bg-success">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Maya Januari mengembalikan Raspberry Pi 4</div>
                            <div class="activity-time">45 menit yang lalu</div>
                        </div>
                    </li>
                    
                    <li class="activity-item">
                        <div class="activity-icon bg-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Stok Laptop Gaming hampir habis</div>
                            <div class="activity-time">3 jam yang lalu</div>
                        </div>
                    </li>
                    
                    <li class="activity-item">
                        <div class="activity-icon bg-danger">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Barang baru ditambahkan: Drone DJI Mavic</div>
                            <div class="activity-time">5 jam yang lalu</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>

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
        
        // Terapkan dark mode jika sebelumnya diaktifkan
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
    </script>
</body>
</html>