<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - Sistem Peminjaman Sarana Prasarana</title>
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
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 0 1rem;
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
        
        /* ===== ABOUT STYLES ===== */
        .about-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-bottom: 2.5rem;
        }
        
        .mission-vision {
            display: flex;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .mission, .vision {
            flex: 1;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }
        
        .team-section {
            margin: 3rem 0;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .team-member {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
        }
        
        .team-member:hover {
            transform: translateY(-5px);
        }
        
        .team-img {
            height: 200px;
            background-color: #6d84b4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
        }
        
        .team-info {
            padding: 1.5rem;
        }
        
        .team-info h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .team-info p {
            color: #6c757d;
            margin-bottom: 1rem;
        }
        
        .social-links {
            display: flex;
            gap: 0.8rem;
        }
        
        .social-links a {
            color: var(--primary-color);
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: var(--secondary-color);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .feature-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            border-left: 4px solid var(--primary-color);
        }
        
        .feature-icon {
            background-color: var(--primary-color);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        
        .feature-content h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        /* ===== FOOTER STYLES ===== */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }
        
        .footer h5 {
            color: #fff;
            margin-bottom: 1.2rem;
            font-weight: 600;
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
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .footer i {
            width: 20px;
        }
        
        .copyright {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
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
            
            .mission-vision {
                flex-direction: column;
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
            
            .about-card {
                padding: 1.5rem;
            }
            
            .team-grid {
                grid-template-columns: 1fr;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
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
            <li><a href="/home">Beranda</a></li>
            <li><a href="/kalender">Kalender Perkuliahan</a></li>
            <li><a href="/peminjaman">Daftar Peminjaman</a></li>
            <li><a href="/berita">Berita</a></li>
            <li><a href="/about" class="active">Tentang</a></li>
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
                <h1 class="display-4 fw-bold">Tentang Sistem Peminjaman</h1>
                <p class="lead">Mengenal lebih dalam tentang platform pengelolaan sarana prasarana kami</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <div class="about-card">
            <h3 class="section-title">
                <i class="fa-solid fa-circle-info"></i> Tentang Sistem
            </h3>
            <p>Sistem Peminjaman Sarana Prasarana merupakan platform digital yang dikembangkan khusus untuk Program Studi Teknologi Informasi. Sistem ini memungkinkan pengelolaan dan pemantauan ketersediaan ruangan serta proyektor secara real-time, sehingga proses peminjaman dapat dilakukan dengan lebih efisien dan terorganisir.</p>
            
            <p>Dikembangkan dengan teknologi terkini, sistem ini memberikan kemudahan bagi seluruh civitas akademika Program Studi Teknologi Informasi untuk mengakses informasi ketersediaan sarana prasarana kapan saja dan di mana saja.</p>
        </div>
        
        <div class="about-card">
            <h3 class="section-title">
                <i class="fa-solid fa-bullseye"></i> Misi & Visi
            </h3>
            
            <div class="mission-vision">
                <div class="mission">
                    <h4><i class="fa-solid fa-flag"></i> Misi</h4>
                    <p>Menyediakan platform digital yang efisien untuk pengelolaan sarana prasarana, meningkatkan transparansi ketersediaan fasilitas, dan mendukung proses belajar mengajar yang lebih efektif di lingkungan Program Studi Teknologi Informasi.</p>
                </div>
                
                <div class="vision">
                    <h4><i class="fa-solid fa-eye"></i> Visi</h4>
                    <p>Menjadi sistem pengelolaan sarana prasarana terdepan yang mendukung transformasi digital di lingkungan pendidikan tinggi, khususnya dalam pengoptimalan penggunaan resources yang tersedia.</p>
                </div>
            </div>
        </div>
        
        <div class="about-card">
            <h3 class="section-title">
                <i class="fa-solid fa-star"></i> Keunggulan Sistem
            </h3>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Real-time Tracking</h4>
                        <p>Memantau ketersediaan ruangan dan proyektor secara real-time dengan update informasi setiap menit.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Kalender Interaktif</h4>
                        <p>Fitur kalender yang memudahkan pengguna melihat jadwal penggunaan fasilitas dalam periode waktu tertentu.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Notifikasi Otomatis</h4>
                        <p>Sistem notifikasi yang mengingatkan pengguna tentang jadwal peminjaman dan pengembalian fasilitas.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-mobile-screen"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Responsive Design</h4>
                        <p>Antarmuka yang responsif dan dapat diakses dengan optimal melalui berbagai perangkat dan ukuran layar.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Laporan & Analitik</h4>
                        <p>Fitur pelaporan yang membantu pengelola dalam menganalisis penggunaan sarana prasarana.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Keamanan Data</h4>
                        <p>Sistem keamanan multi-level yang menjamin kerahasiaan dan keamanan data pengguna.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="about-card">
            <div class="team-section">
                <h3 class="section-title">
                    <i class="fa-solid fa-people-group"></i> Tim Pengembang
                </h3>
                <p>Tim dedikasi yang berada di balik pengembangan dan pemeliharaan sistem ini.</p>
                
                <div class="team-grid">
                    <div class="team-member">
                        <div class="team-img">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="team-info">
                            <h4>Dr. Ahmad Santoso, M.Kom.</h4>
                            <p>Project Leader</p>
                            <div class="social-links">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="team-img">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="team-info">
                            <h4>Maya Wijaya, S.Kom.</h4>
                            <p>Full-stack Developer</p>
                            <div class="social-links">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="team-img">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="team-info">
                            <h4>Rizky Pratama, S.T.</h4>
                            <p>UI/UX Designer</p>
                            <div class="social-links">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="team-img">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="team-info">
                            <h4>Budi Setiawan, M.T.I.</h4>
                            <p>Database Administrator</p>
                            <div class="social-links">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="about-card">
            <h3 class="section-title">
                <i class="fa-solid fa-history"></i> Sejarah Pengembangan
            </h3>
            <p>Sistem Peminjaman Sarana Prasarana pertama kali dikembangkan pada tahun 2023 sebagai respons terhadap kebutuhan akan pengelolaan fasilitas yang lebih efisien di Program Studi Teknologi Informasi. Versi awal sistem ini diluncurkan pada Januari 2024 setelah melalui proses pengembangan selama enam bulan.</p>
            
            <p>Sejak peluncuran pertamanya, sistem terus mengalami penyempurnaan dan penambahan fitur berdasarkan masukan dari pengguna. Hingga saat ini, sistem telah digunakan oleh lebih dari 500 pengguna aktif yang terdiri dari dosen, staff, dan mahasiswa Program Studi Teknologi Informasi.</p>
            
            <p>Pengembangan sistem akan terus dilakukan untuk menyesuaikan dengan kebutuhan yang berkembang dan kemajuan teknologi terbaru, dengan komitmen untuk selalu memberikan layanan terbaik bagi civitas akademika Program Studi Teknologi Informasi.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h5>Prodi Teknologi Informasi</h5>
                    <p>Sistem Peminjaman Sarana Prasarana</p>
                    <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-time di Program Studi Teknologi Informasi.</p>
                </div>
                <div class="col-md-3 quick-links">
                    <h5>Link Cepat</h5>
                    <a href="/home">Beranda</a>
                    <a href="/about">Tentang</a>
                    <a href="/peminjaman">Peminjaman</a>
                    <a href="/berita">Berita</a>
                </div>
                <div class="col-md-4">
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