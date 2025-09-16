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
        }
        
        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .navbar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .btn-logout {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        /* ===== DASHBOARD LAYOUT ===== */
        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 76px);
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem 0;
            transition: all 0.3s;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.3s;
            gap: 10px;
        }
        
        .sidebar-menu a:hover, 
        .sidebar-menu a.active {
            background-color: rgba(59, 89, 152, 0.1);
            color: var(--primary-color);
            border-left: 4px solid var(--primary-color);
        }
        
        .sidebar-menu a i {
            width: 20px;
            text-align: center;
        }
        
        /* Main Content Area */
        .main-content {
            flex: 1;
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .welcome-text {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        
        /* Dashboard Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
            gap: 1rem;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-icon.blue {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        
        .stat-icon.green {
            background: linear-gradient(135deg, var(--success-color), #20c997);
        }
        
        .stat-icon.orange {
            background: linear-gradient(135deg, var(--warning-color), #fd7e14);
        }
        
        .stat-icon.red {
            background: linear-gradient(135deg, var(--danger-color), #e83e8c);
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 0.2rem;
        }
        
        .stat-info p {
            color: #6c757d;
            margin: 0;
        }
        
        /* Peminjaman Terbaru */
        .section-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #eaeaea;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            background-color: #f8f9fa;
            color: var(--primary-color);
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
        }
        
        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-completed {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .btn-action {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-view {
            background-color: #e9ecef;
            color: var(--dark-color);
        }
        
        .btn-view:hover {
            background-color: #dee2e6;
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
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        
        .action-card h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .action-card p {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* Calendar Widget */
        .calendar-widget {
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
            gap: 5px;
        }
        
        .calendar-day {
            text-align: center;
            padding: 10px 0;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .calendar-date {
            text-align: center;
            padding: 8px 0;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .calendar-date:hover {
            background-color: #e9ecef;
        }
        
        .calendar-date.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .calendar-date.has-event {
            position: relative;
        }
        
        .calendar-date.has-event::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: var(--accent-color);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                padding: 1rem 0;
            }
            
            .sidebar-menu {
                display: flex;
                overflow-x: auto;
                padding: 0 1rem;
            }
            
            .sidebar-menu li {
                margin-bottom: 0;
                margin-right: 10px;
                white-space: nowrap;
            }
            
            .sidebar-menu a {
                border-left: none;
                border-bottom: 3px solid transparent;
                padding: 10px 15px;
            }
            
            .sidebar-menu a:hover, 
            .sidebar-menu a.active {
                border-left: none;
                border-bottom: 3px solid var(--primary-color);
            }
        }
        
        @media (max-width: 768px) {
            .navbar ul {
                display: none;
            }
            
            .navbar .user-menu {
                margin-left: auto;
            }
            
            .stats-cards, .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/dashboard" class="logo">
            <i class="fas fa-building"></i>SarPras TI
        </a>
        <ul>
            <li><a href="/home">Beranda</a></li>
            <li><a href="/kalender">Kalender</a></li>
            <li><a href="/peminjaman">Peminjaman</a></li>
            <li><a href="/bantuan">Bantuan</a></li>
        </ul>
        <div class="user-menu">
            <div class="user-info">
                <div class="user-avatar">DW</div>
                <div class="user-details">
                    <div class="user-name">Diana Wijaya</div>
                    <div class="user-role">Mahasiswa</div>
                </div>
            </div>
            <button class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </nav>

    <!-- Dashboard Layout -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="/dashboard" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="/peminjaman/baru"><i class="fas fa-plus-circle"></i> Ajukan Peminjaman</a></li>
                <li><a href="/peminjaman/aktif"><i class="fas fa-clock"></i> Peminjaman Aktif</a></li>
                <li><a href="/peminjaman/riwayat"><i class="fas fa-history"></i> Riwayat Peminjaman</a></li>
                <li><a href="/fasilitas"><i class="fas fa-door-open"></i> Daftar Fasilitas</a></li>
                <li><a href="/profil"><i class="fas fa-user"></i> Profil Saya</a></li>
                <li><a href="/bantuan"><i class="fas fa-question-circle"></i> Bantuan</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
                <div class="date-display">Selasa, 17 Oktober 2023</div>
            </div>

            <p class="welcome-text">Selamat datang, <strong>Diana Wijaya</strong>! Berikut adalah ringkasan aktivitas peminjaman Anda.</p>

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>Peminjaman Aktif</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Peminjaman Selesai</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-info">
                        <h3>2</h3>
                        <p>Menunggu Persetujuan</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>1</h3>
                        <p>Peminjaman Ditolak</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <h2 class="section-title">
                <i class="fas fa-bolt"></i> Akses Cepat
            </h2>
            
            <div class="quick-actions">
                <div class="action-card" onclick="location.href='/peminjaman/baru'">
                    <div class="action-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h4>Ajukan Peminjaman</h4>
                    <p>Ajukan permohonan peminjaman fasilitas baru</p>
                </div>
                
                <div class="action-card" onclick="location.href='/kalender'">
                    <div class="action-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <h4>Lihat Kalender</h4>
                    <p>Cek ketersediaan fasilitas di tanggal tertentu</p>
                </div>
                
                <div class="action-card" onclick="location.href='/fasilitas'">
                    <div class="action-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <h4>Daftar Fasilitas</h4>
                    <p>Lihat informasi detail tentang fasilitas</p>
                </div>
                
                <div class="action-card" onclick="location.href='/panduan'">
                    <div class="action-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h4>Panduan</h4>
                    <p>Pelajari cara menggunakan sistem</p>
                </div>
            </div>

            <!-- Peminjaman Terbaru -->
            <div class="card">
                <div class="card-header">
                    <span>Peminjaman Terbaru</span>
                    <a href="/peminjaman/aktif" class="btn-action btn-view">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fasilitas</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ruangan R101</td>
                                    <td>20 Okt 2023</td>
                                    <td>10:00 - 12:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td><a href="#" class="btn-action btn-view">Detail</a></td>
                                </tr>
                                <tr>
                                    <td>Proyektor LCD 01</td>
                                    <td>18 Okt 2023</td>
                                    <td>13:00 - 15:00</td>
                                    <td><span class="status-badge status-pending">Menunggu</span></td>
                                    <td><a href="#" class="btn-action btn-view">Detail</a></td>
                                </tr>
                                <tr>
                                    <td>Laboratorium Jaringan</td>
                                    <td>22 Okt 2023</td>
                                    <td>08:00 - 10:00</td>
                                    <td><span class="status-badge status-approved">Disetujui</span></td>
                                    <td><a href="#" class="btn-action btn-view">Detail</a></td>
                                </tr>
                                <tr>
                                    <td>Laptop Gaming 05</td>
                                    <td>19 Okt 2023</td>
                                    <td>14:00 - 16:00</td>
                                    <td><span class="status-badge status-rejected">Ditolak</span></td>
                                    <td><a href="#" class="btn-action btn-view">Detail</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Calendar and Notifications -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span>Kalender Peminjaman</span>
                        </div>
                        <div class="card-body">
                            <div class="calendar-widget">
                                <div class="calendar-header">
                                    <h5>Oktober 2023</h5>
                                    <div>
                                        <button class="btn-action btn-view"><i class="fas fa-chevron-left"></i></button>
                                        <button class="btn-action btn-view"><i class="fas fa-chevron-right"></i></button>
                                    </div>
                                </div>
                                <div class="calendar-grid">
                                    <div class="calendar-day">Min</div>
                                    <div class="calendar-day">Sen</div>
                                    <div class="calendar-day">Sel</div>
                                    <div class="calendar-day">Rab</div>
                                    <div class="calendar-day">Kam</div>
                                    <div class="calendar-day">Jum</div>
                                    <div class="calendar-day">Sab</div>
                                    
                                    <!-- Calendar dates would be generated dynamically in a real app -->
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
                                    
                                    <div class="calendar-date">15</div>
                                    <div class="calendar-date">16</div>
                                    <div class="calendar-date active">17</div>
                                    <div class="calendar-date has-event">18</div>
                                    <div class="calendar-date">19</div>
                                    <div class="calendar-date has-event">20</div>
                                    <div class="calendar-date">21</div>
                                    
                                    <div class="calendar-date has-event">22</div>
                                    <div class="calendar-date">23</div>
                                    <div class="calendar-date">24</div>
                                    <div class="calendar-date">25</div>
                                    <div class="calendar-date">26</div>
                                    <div class="calendar-date">27</div>
                                    <div class="calendar-date">28</div>
                                    
                                    <div class="calendar-date">29</div>
                                    <div class="calendar-date">30</div>
                                    <div class="calendar-date">31</div>
                                    <div class="calendar-date"></div>
                                    <div class="calendar-date"></div>
                                    <div class="calendar-date"></div>
                                    <div class="calendar-date"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <span>Notifikasi Terbaru</span>
                        </div>
                        <div class="card-body">
                            <div class="notification-list">
                                <div class="notification-item">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6>Peminjaman Disetujui</h6>
                                        <small>1 jam lalu</small>
                                    </div>
                                    <p>Peminjaman Ruangan R101 pada 20 Okt 2023 telah disetujui.</p>
                                </div>
                                <div class="notification-item">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6>Pengingat Peminjaman</h6>
                                        <small>5 jam lalu</small>
                                    </div>
                                    <p>Peminjaman Laboratorium Jaringan akan berlangsung besok pukul 08:00.</p>
                                </div>
                                <div class="notification-item">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6>Pemberitahuan Sistem</h6>
                                        <small>1 hari lalu</small>
                                    </div>
                                    <p>Sistem akan down untuk maintenance pada Minggu, 22 Okt pukul 23:00 - 02:00.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to handle logout
        document.querySelector('.btn-logout').addEventListener('click', function() {
            if(confirm('Apakah Anda yakin ingin logout?')) {
                window.location.href = '/login';
            }
        });
        
        // Update date display
        function updateDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date();
            document.querySelector('.date-display').textContent = today.toLocaleDateString('id-ID', options);
        }
        
        // Initialize date on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateDate();
        });
    </script>
</body>
</html>