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
        }
        
        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s;
            font-weight: 500;
            position: relative;
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
        
        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3.5rem 0;
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,218.7C672,224,768,160,864,138.7C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .hero-content h1 {
            animation: fadeInDown 1s ease;
        }
        
        .hero-content p {
            animation: fadeInUp 1s ease;
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
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
            transition: transform 0.3s ease;
        }
        
        .mission:hover, .vision:hover {
            transform: translateY(-3px);
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
            position: relative;
        }
        
        .team-member:hover {
            transform: translateY(-5px);
        }
        
        .team-img {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            position: relative;
            overflow: hidden;
        }
        
        .team-img::after {
            content: '';
            position: absolute;
            width: 150%;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(45deg) translateY(-50px);
            animation: shine 3s infinite linear;
        }
        
        .team-info {
            padding: 1.5rem;
            text-align: center;
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
            justify-content: center;
        }
        
        .social-links a {
            color: var(--primary-color);
            font-size: 1.2rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #f8f9fa;
        }
        
        .social-links a:hover {
            color: white;
            background-color: var(--primary-color);
            transform: translateY(-3px);
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
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
            transform: translateX(5px);
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
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: rotate(15deg) scale(1.1);
        }
        
        .feature-content h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }
        
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background-color: var(--secondary-color);
            transform: translateY(-5px);
        }
        
        /* ===== ANIMATIONS ===== */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shine {
            from {
                left: -100%;
            }
            to {
                left: 100%;
            }
        }
        
        /* ===== FOOTER STYLES ===== */
        .footer {
            background-color: #2d3748;
            color: white;
            padding: 40px 0 20px;
            margin-top: 2rem;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: #1a56db;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #e5e7eb;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
        }
        
        .footer-links a:hover {
            color: #1a56db;
            padding-left: 5px;
        }
        
        .contact-info {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        
        .contact-info i {
            margin-right: 10px;
            color: #1a56db;
            min-width: 20px;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background-color: #1a56db;
            transform: translateY(-3px);
        }
        
        .opening-hours {
            margin-bottom: 15px;
        }
        
        .opening-hours div {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }
        
        .footer-bottom {
            max-width: 1200px;
            margin: 30px auto 0;
            padding: 20px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
            
            .footer-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .footer-section h3 {
                font-size: 1.3rem;
            }
            
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 40px;
                height: 40px;
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
            <li><a href="/home">Beranda</a></li>
            <li><a href="/kalender">Kalender Perkuliahan</a></li>
            <li><a href="/peminjaman">Daftar Peminjaman</a></li>
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
                            <h4>Ahmad Miftahul Huda</h4>
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
                            <h4>Muhammad Ferdiy Ariyanto</h4>
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
                            <h4>Najwa Khadijah</h4>
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
                            <h4>M.Riki Aditya</h4>
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
                            <h4>M.Dimas Aprianto</h4>
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

    <!-- Back to top button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

   <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-tine di Program Studi Teknologi Informasi.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/ti.politala?igsh=MXY4MTc3NGZjeHR2MQ=="><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.youtube.com/@teknikinformatikapolitala8620"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Link Cepat</h3>
                <ul class="footer-links">
                    <li><a href="/home">Beranda</a></li>
                    <li><a href="/kalender">Kalender Perkuliahan</a></li>
                    <li><a href="/about">Tentang</a></li>
                    <li><a href="/">Syarat & Ketentuan</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Kontak Kami</h3>
                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Jl. Ahmad Yani No.Km.06, Kec. Pelaihari, Kabupaten Tanah Laut, Kalimantan Selatan</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <span>(0512) 2021065</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <span>peminjaman@example.ac.id</span>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Jam Operasional</h3>
                <div class="opening-hours">
                    <div>
                        <span>Senin - Kamis:</span>
                        <span>08:00 - 16:00</span>
                    </div>
                    <div>
                        <span>Jumat:</span>
                        <span>08:00 - 16:00</span>
                    </div>
                    <div>
                        <span>Sabtu & Minggu:</span>
                        <span>Tutup</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 Sistem Peminjaman Sarana Prasarana - Program Studi Teknologi Informasi Politeknik Negeri Tanah Laut. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Back to top button functionality
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });
        
        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Animation on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.about-card, .feature-card, .team-member');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (elementPosition < screenPosition) {
                    element.style.opacity = 1;
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Initialize elements for animation
        document.querySelectorAll('.about-card, .feature-card, .team-member').forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>