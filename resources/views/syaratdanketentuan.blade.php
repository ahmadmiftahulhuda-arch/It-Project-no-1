<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan Peminjaman Sarpas</title>
    <style>:root {
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
        
        main {
            flex: 2;
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        aside {
            flex: 1;
        }
        
        .info-box {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .info-box h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-color);
        }
        
        .contact-info {
            list-style: none;
        }
        
        .contact-info li {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
        }
        
        .contact-info i {
            margin-right: 0.5rem;
            color: var(--secondary-color);
            width: 20px;
            text-align: center;
        }
        
        .section {
            margin-bottom: 2.5rem;
        }
        
        .section h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-color);
        }
        
        .section ol, .section ul {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .section li {
            margin-bottom: 0.8rem;
        }
        
        .important-note {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            border-radius: 0 4px 4px 0;
        }
        
        .warning-note {
            background-color: #ffebee;
            border-left: 4px solid var(--accent-color);
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            border-radius: 0 4px 4px 0;
        }
        
        .btn {
            display: inline-block;
            background-color: var(--secondary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #2980b9;
        }
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }
        
        .btn-outline:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
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
        
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            transition: all 0.3s;
        }
        
        .btn-sm:hover {
            transform: translateY(-2px);
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
    </style>
</head>
<body>
     <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <a href="#" class="logo">
            <i class="fas fa-building"></i>SarPras TI
        </a>
        <ul>
            <li><a href="/home">Beranda</a></li>
            <li><a href="/kalender">Kalender Perkuliahan</a></li>
            <li><a href="/peminjaman1">Daftar Peminjaman</a></li>
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
                <h1 class="display-4 fw-bold">Syarat dan Ketentuan Peminjaman</h1>
                <p class="lead"></p>
            </div>
        </div>
    </section>

    
    <div class="container">
        <div class="content">
            <main>
                <div class="section">
                    <h2>Persyaratan Umum</h2>
                    <ol>
                        <li>Peminjam harus merupakan anggota resmi dari institusi/organisasi yang berwenang.</li>
                        <li>Peminjam harus memiliki tujuan yang jelas dan dapat dipertanggungjawabkan atas penggunaan sarana dan prasarana.</li>
                        <li>Peminjam harus mengisi formulir permohonan peminjaman secara lengkap dan benar.</li>
                        <li>Peminjam harus menunjukkan kartu identitas yang masih berlaku pada saat pengajuan permohonan.</li>
                        <li>Untuk peminjaman tertentu, mungkin diperlukan surat pengantar dari institusi terkait.</li>
                    </ol>
                </div>
                
                <div class="section">
                    <h2>Prosedur Peminjaman</h2>
                    <ol>
                        <li>Peminjam mengajukan permohonan secara online atau offline minimal 3 hari kerja sebelum tanggal peminjaman.</li>
                        <li>Petugas akan memverifikasi kelengkapan dan kebenaran data permohonan.</li>
                        <li>Peminjam akan menerima konfirmasi persetujuan atau penolakan permohonan dalam waktu 2×24 jam.</li>
                        <li>Untuk permohonan yang disetujui, peminjam harus melakukan penandatanganan perjanjian peminjaman.</li>
                        <li>Peminjam dapat mengambil barang yang dipinjam pada waktu yang telah disepakati.</li>
                    </ol>
                </div>
                
                <div class="section">
                    <h2>Hak dan Kewajiban Peminjam</h2>
                    <h3>Hak Peminjam:</h3>
                    <ul>
                        <li>Menggunakan sarana dan prasarana sesuai dengan peruntukannya.</li>
                        <li>Mendapatkan bantuan teknis sesuai dengan ketersediaan.</li>
                        <li>Mengajukan keluhan atau saran terkait layanan peminjaman.</li>
                    </ul>
                    
                    <h3>Kewajiban Peminjam:</h3>
                    <ul>
                        <li>Menggunakan sarana dan prasarana dengan hati-hati dan bertanggung jawab.</li>
                        <li>Mengembalikan sarana dan prasarana dalam kondisi baik sesuai dengan keadaan awal.</li>
                        <li>Mengganti kerusakan atau kehilangan yang terjadi selama masa peminjaman.</li>
                        <li>Mengembalikan barang yang dipinjam tepat waktu sesuai perjanjian.</li>
                        <li>Mematuhi semua peraturan dan tata tertib yang berlaku.</li>
                    </ul>
                </div>
                
                <div class="section">
                    <h2>Sanksi dan Denda</h2>
                    <ol>
                        <li>Keterlambatan pengembalian akan dikenakan denda sebesar Rp 50.000 per hari untuk setiap item (disesuaikan dengan jenis barang).</li>
                        <li>Kerusakan akibat kelalaian peminjam akan dikenakan biaya perbaikan sesuai dengan tingkat kerusakan.</li>
                        <li>Kehilangan barang yang dipinjam wajib diganti dengan barang yang sama atau setara.</li>
                        <li>Penyalahgunaan sarana dan prasarana dapat dikenakan sanksi berupa pembatasan atau pencabutan hak peminjaman.</li>
                    </ol>
                    
                    <div class="warning-note">
                        <p><strong>Peringatan:</strong> Pelanggaran berat dapat dilaporkan kepada pihak berwajib untuk ditindaklanjuti secara hukum.</p>
                    </div>
                </div>
                
                <div class="section">
                    <h2>Ketentuan Lainnya</h2>
                    <ol>
                        <li>Pihak pengelola berhak membatalkan peminjaman jika terdapat force majeure atau keadaan darurat.</li>
                        <li>Pihak pengelola berhak melakukan perubahan terhadap syarat dan ketentuan dengan pemberitahuan sebelumnya.</li>
                        <li>Semua sengkata yang timbul akan diselesaikan secara musyawarah untuk mufakat.</li>
                    </ol>
                    
                    <div class="important-note">
                        <p><strong>Catatan Penting:</strong> Dengan menyetujui syarat dan ketentuan ini, peminjam dianggap telah membaca, memahami, dan menyetujui semua ketentuan yang berlaku.</p>
                    </div>
                </div>
            </main>

    <!-- Back to top button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>
    
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Layanan peminjaman alat dan barang untuk mendukung kegiatan akademik dan non-akademik di lingkungan sekolah/kampus.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Link Cepat</h3>
                <ul class="footer-links">
                    <li><a href="/home">Beranda</a></li>
                    <li><a href="/kalender">Kalender Perkuliahan</a></li>
                    <li><a href="/about">Tentang</a></li>
                    <li><a href="/syaratdanketentuan">Syarat & Ketentuan</a></li>
                    <li><a href="/faq">FAQ</a></li>
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
            <p>&copy; 2023 Sistem Peminjaman Alat - Nama Sekolah/Kampus. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>