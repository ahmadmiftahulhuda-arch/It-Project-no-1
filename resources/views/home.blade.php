<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Sarana Prasarana</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        
        .navbar ul li a:hover, 
        .navbar ul li a.active {
            background-color: rgba(255, 255, 255, 0.15);
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
        }
        
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            transform: translateY(-2px);
        }
        
        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3.5rem 0;
            margin-bottom: 2.5rem;
            text-align: center;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero-buttons {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .btn-hero {
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        
        .btn-hero-primary {
            background-color: white;
            color: var(--primary-color);
            border: none;
        }
        
        .btn-hero-primary:hover {
            background-color: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-hero-outline {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }
        
        .btn-hero-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 0 1rem;
            flex: 1;
        }
        
        .section-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #eaeaea;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* ===== CALENDAR STYLES ===== */
        .calendar-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 1.8rem;
            margin-bottom: 2.5rem;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .calendar table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .calendar th {
            color: var(--primary-color);
            text-align: center;
            padding: 0.8rem;
            font-weight: 600;
        }
        
        .calendar td {
            text-align: center;
            padding: 0.8rem;
            position: relative;
            border-radius: 8px;
            transition: background-color 0.2s;
        }
        
        .calendar td:hover {
            background-color: #f5f8fa;
        }
        
        .status-indicators {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1.8rem;
        }
        
        .status-indicator {
            display: flex;
            align-items: center;
        }
        
        .status-color {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
        }
        
        .available {
            background-color: #28a745;
        }
        
        .occupied {
            background-color: #dc3545;
        }
        
        .projector-occupied {
            background-color: #ffc107;
        }
        
        /* ===== DASHBOARD STYLES ===== */
        .dashboard-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 1.8rem;
            margin-bottom: 2rem;
            height: 100%;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }
        
        .stats-card h5 {
            color: #495057;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .stats-card .display-6 {
            color: var(--primary-color);
            font-weight: 700;
        }
        
        .stats-card p {
            color: #6c757d;
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .updated-time {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0.8rem;
        }
        
        /* ===== ROOM CARDS ===== */
        .room-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            border-top: 4px solid #28a745;
        }
        
        .room-card.occupied {
            border-top: 4px solid #dc3545;
        }
        
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .room-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        .available-status {
            background-color: #d4edda;
            color: #155724;
        }
        
        .occupied-status {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .room-card h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            padding-right: 80px;
        }
        
        .room-features {
            color: #6c757d;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        
        /* ===== PROJECTOR TABLE ===== */
        .projector-table-container {
            overflow-x: auto;
        }
        
        .projector-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            min-width: 300px;
        }
        
        .projector-table th {
            background-color: #f8f9fa;
            padding: 0.8rem;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        
        .projector-table td {
            padding: 0.8rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        .projector-table tr:hover {
            background-color: #f8f9fa;
        }
        
        .badge {
            padding: 0.4em 0.6em;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 4px;
        }
        
        /* ===== FOOTER STYLES ===== */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: space-between;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
        }
        
        .footer h5 {
            color: #fff;
            margin-bottom: 1.2rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: var(--primary-color);
        }
        
        .quick-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 0.7rem;
            transition: color 0.3s;
        }
        
        .quick-links a:hover {
            color: white;
        }
        
        .footer p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .footer i {
            width: 20px;
            margin-top: 4px;
        }
        
        .copyright {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
            width: 100%;
        }
        
        /* ===== RESPONSIVE ADJUSTMENTS ===== */
        @media (max-width: 992px) {
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar ul li {
                margin: 0.3rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero {
                width: 80%;
            }
            
            .footer-section {
                flex: 0 0 48%;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .logo {
                margin-bottom: 1rem;
            }
            
            .hero-section {
                padding: 2.5rem 0;
            }
            
            .calendar-container, 
            .dashboard-card {
                padding: 1.2rem;
            }
            
            .footer-section {
                flex: 0 0 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-building"></i>SarPras TI
        </div>
        <ul>
            <li><a href="/home" class="active">Beranda</a></li>
            <li><a href="/kalender">Kalender Perkuliahan</a></li>
            <li><a href="/peminjaman">Daftar Peminjaman</a></li>
            <li><a href="/berita">Berita</a></li>
            <li><a href="/about">Tentang</a></li>
            <li>
                <a href="/login" class="btn-warning">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            </li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold">Sistem Peminjaman Sarana Prasarana</h1>
                <p class="lead">Kelola dan pantau ketersediaan ruangan serta proyektor secara real-time</p>
                <div class="hero-buttons">
                    <a href="#" class="btn btn-hero btn-hero-primary">Lihat Ketersediaan</a>
                    <a href="#" class="btn btn-hero btn-hero-outline">Peminjaman Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <div class="row">
            <!-- Calendar Section -->
            <div class="col-lg-8">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <h3 class="section-title">
                            <i class="fa-solid fa-calendar-days"></i> Kalender Interaktif
                        </h3>
                    </div>
                    <p>Lihat jadwal penggunaan ruangan dan proyektor secara real-time</p>
                    
                    <h4 class="my-3">September 2025</h4>
                    <div class="calendar">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sen</th>
                                    <th>Sel</th>
                                    <th>Rab</th>
                                    <th>Kam</th>
                                    <th>Jum</th>
                                    <th>Sab</th>
                                    <th>Min</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>16</td>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                </tr>
                                <tr>
                                    <td>29</td>
                                    <td>30</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="status-indicators">
                        <div class="status-indicator">
                            <div class="status-color available"></div>
                            <span>Ruangan Kosong</span>
                        </div>
                        <div class="status-indicator">
                            <div class="status-color occupied"></div>
                            <span>Ruangan Terpakai</span>
                        </div>
                        <div class="status-indicator">
                            <div class="status-color projector-occupied"></div>
                            <span>Proyektor Terpakai</span>
                        </div>
                    </div>
                </div>
                
                <!-- Room Details Section -->
                <h3 class="section-title">
                    <i class="fa-solid fa-door-open"></i> Detail Ruangan
                </h3>
                <p>Informasi lengkap ketersediaan ruangan</p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="room-card">
                            <div class="room-status available-status">Kosong</div>
                            <h4>Lab Komputer 1</h4>
                            <p class="text-muted">Kapasitas: 30 orang</p>
                            <p class="room-features">30 PC. Proyektor. AC</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="room-card">
                            <div class="room-status available-status">Kosong</div>
                            <h4>Lab Komputer 2</h4>
                            <p class="text-muted">Kapasitas: 25 orang</p>
                            <p class="room-features">25 PC. Proyektor. AC</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="room-card occupied">
                            <div class="room-status occupied-status">Terpakai</div>
                            <h4>Ruang Kelas A</h4>
                            <p class="text-muted">Kapasitas: 40 orang</p>
                            <p class="room-features">Whiteboard. Proyektor. AC</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="room-card occupied">
                            <div class="room-status occupied-status">Terpakai</div>
                            <h4>Lab Jaringan</h4>
                            <p class="text-muted">Kapasitas: 20 orang</p>
                            <p class="room-features">Router, Switch, Proyektor</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Section -->
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <h3 class="section-title">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard Real-time
                    </h3>
                    <p>Informasi terkini ketersediaan sarana prasarana</p>
                    
                    <div class="updated-time">Diperbarui 2 menit lalu</div>
                    <div class="stats-card">
                        <h5>Ruangan Kosong</h5>
                        <p class="display-6">12</p>
                        <p>dari 18 ruangan tersedia</p>
                    </div>
                    
                    <div class="updated-time">Diperbarui 1 menit lalu</div>
                    <div class="stats-card">
                        <h5>Ruangan Terpakai</h5>
                        <p class="display-6">6</p>
                        <p>sedang digunakan</p>
                    </div>
                    
                    <div class="updated-time">Diperbarui 30 detik lalu</div>
                    <div class="stats-card">
                        <h5>Proyektor Terpakai</h5>
                        <p class="display-6">4</p>
                        <p>dari 8 proyektor</p>
                    </div>
                </div>
                
                <!-- Projector Status -->
                <div class="dashboard-card">
                    <h3 class="section-title">
                        <i class="fa-solid fa-projector"></i> Status Proyektor
                    </h3>
                    <p>Status dan lokasi proyektor saat ini</p>
                    
                    <div class="projector-table-container">
                        <table class="projector-table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Status</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PROJ-001</td>
                                    <td><span class="badge bg-success">Tersedia</span></td>
                                    <td>Gudang</td>
                                </tr>
                                <tr>
                                    <td>PROJ-002</td>
                                    <td><span class="badge bg-danger">Terpakai</span></td>
                                    <td>Lab Komputer 2</td>
                                </tr>
                                <tr>
                                    <td>PROJ-003</td>
                                    <td><span class="badge bg-success">Tersedia</span></td>
                                    <td>Gudang</td>
                                </tr>
                                <tr>
                                    <td>PROJ-004</td>
                                    <td><span class="badge bg-danger">Terpakai</span></td>
                                    <td>Ruang Seminar</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="#" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>Prodi Teknologi Informasi</h5>
                    <p>Sistem Peminjaman Sarana Prasarana</p>
                    <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-time di Program Studi Teknologi Informasi.</p>
                </div>
                <div class="footer-section quick-links">
                    <h5>Link Cepat</h5>
                    <a href="#">Beranda</a>
                    <a href="#">Ruangan</a>
                    <a href="#">Proyektor</a>
                    <a href="#">Panduan</a>
                </div>
                <div class="footer-section">
                    <h5>Kontak</h5>
                    <p><i class="fa-solid fa-phone"></i> (021) 7918-1234</p>
                    <p><i class="fa-solid fa-envelope"></i> info@ti.university.ac.id</p>
                    <p><i class="fa-solid fa-location-dot"></i> Gedung Teknologi Informasi</p>
                </div>
            </div>
            <div class="copyright">
                <p>© 2025 Program Studi Teknologi Informasi. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>