<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Sarpras TI</title>
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
        
        /* ===== BREADCRUMB ===== */
        .breadcrumb-container {
            background-color: #e9ecef;
            padding: 1rem 0;
        }
        
        .breadcrumb {
            margin-bottom: 0;
            padding: 0 1rem;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 2rem 1rem;
            flex: 1;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .page-description {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        
        /* ===== NEWS GRID ===== */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .news-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .news-content {
            padding: 1.5rem;
        }
        
        .news-date {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .news-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            line-height: 1.4;
        }
        
        .news-excerpt {
            color: #495057;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .news-category {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background-color: #e9ecef;
            color: #495057;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .news-category.important {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .news-category.update {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .news-category.event {
            background-color: #d4edda;
            color: #155724;
        }
        
        /* ===== FEATURED NEWS ===== */
        .featured-news {
            margin-bottom: 3rem;
        }
        
        .featured-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
        }
        
        @media (min-width: 992px) {
            .featured-card {
                flex-direction: row;
                height: 350px;
            }
        }
        
        .featured-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        @media (min-width: 992px) {
            .featured-image {
                width: 50%;
                height: 100%;
            }
        }
        
        .featured-content {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .featured-date {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .featured-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            line-height: 1.3;
        }
        
        .featured-excerpt {
            color: #495057;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        /* ===== NEWS CATEGORIES ===== */
        .categories-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .categories-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .categories-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
        }
        
        .category-btn {
            padding: 0.5rem 1rem;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            color: #495057;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .category-btn:hover, 
        .category-btn.active {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        /* ===== PAGINATION ===== */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
        
        /* ===== NEWSLETTER SECTION ===== */
        .newsletter-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 12px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 3rem;
            text-align: center;
        }
        
        .newsletter-title {
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .newsletter-text {
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
        
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }
        
        @media (max-width: 576px) {
            .newsletter-form {
                flex-direction: column;
            }
        }
        
        /* ===== SIDEBAR ===== */
        .sidebar {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .sidebar-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }
        
        .recent-news-item {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .recent-news-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .recent-news-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 1rem;
        }
        
        .recent-news-content {
            flex: 1;
        }
        
        .recent-news-title {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
            line-height: 1.3;
        }
        
        .recent-news-date {
            color: #6c757d;
            font-size: 0.75rem;
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
            
            .news-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
            
            .news-grid {
                grid-template-columns: 1fr;
            }
            
            .newsletter-form {
                flex-direction: column;
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
            <li><a href="/berita" class="active">Berita</a></li>
            <li><a href="/about">Tentang</a></li>
            <li>
                <a href="/login" class="btn-warning">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            </li>
        </ul>
    </nav>

    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title"><i class="fa-solid fa-newspaper"></i> Berita & Informasi Terbaru</h1>
            <p class="page-description">Dapatkan informasi terkini seputar kegiatan, pengumuman, dan perkembangan di Program Studi Teknologi Informasi</p>
        </div>

        <div class="row">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                <!-- Categories Filter -->
                <div class="categories-section">
                    <h3 class="categories-title"><i class="fa-solid fa-tags"></i> Kategori Berita</h3>
                    <div class="categories-list">
                        <a href="#" class="category-btn active">Semua</a>
                        <a href="#" class="category-btn">Pengumuman</a>
                        <a href="#" class="category-btn">Kegiatan</a>
                        <a href="#" class="category-btn">Prestasi</a>
                        <a href="#" class="category-btn">Beasiswa</a>
                        <a href="#" class="category-btn">Lowongan</a>
                    </div>
                </div>

                <!-- Featured News -->
                <div class="featured-news">
                    <div class="featured-card">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" alt="Featured News" class="featured-image">
                        <div class="featured-content">
                            <div class="news-category important">Penting</div>
                            <div class="featured-date"><i class="fa-regular fa-calendar"></i> 12 September 2025</div>
                            <h2 class="featured-title">Pembaruan Sistem Peminjaman Sarana Prasarana Versi 2.0</h2>
                            <p class="featured-excerpt">Sistem peminjaman sarana prasarana telah diperbarui dengan fitur-fitur terbaru untuk memudahkan proses peminjaman dan pengelolaan fasilitas. Simak perubahan dan peningkatan yang ada...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- News Grid -->
                <div class="news-grid">
                    <!-- News Card 1 -->
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="News Image" class="news-image">
                        <div class="news-content">
                            <div class="news-date"><i class="fa-regular fa-calendar"></i> 10 September 2025</div>
                            <div class="news-category update">Update</div>
                            <h3 class="news-title">Jadwal Penggunaan Lab Komputer Semester Ganjil 2025/2026</h3>
                            <p class="news-excerpt">Berikut adalah jadwal terbaru penggunaan lab komputer untuk semester ganjil tahun akademik 2025/2026. Perhatikan perubahan jadwal dari sebelumnya...</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- News Card 2 -->
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="News Image" class="news-image">
                        <div class="news-content">
                            <div class="news-date"><i class="fa-regular fa-calendar"></i> 8 September 2025</div>
                            <div class="news-category event">Event</div>
                            <h3 class="news-title">Seminar Nasional Teknologi Informasi 2025: "Digital Transformation in Education"</h3>
                            <p class="news-excerpt">Program Studi Teknologi Informasi akan menyelenggarakan Seminar Nasional dengan tema Digital Transformation in Education pada tanggal 25 September 2025...</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- News Card 3 -->
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1559028012-481c04fa702d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="News Image" class="news-image">
                        <div class="news-content">
                            <div class="news-date"><i class="fa-regular fa-calendar"></i> 5 September 2025</div>
                            <div class="news-category">Pengumuman</div>
                            <h3 class="news-title">Penerimaan Proposal Penelitian Dosen Muda Tahun 2025</h3>
                            <p class="news-excerpt">Dibuka kesempatan bagi dosen muda untuk mengajukan proposal penelitian tahun 2025. Pendaftaran dibuka hingga tanggal 30 September 2025...</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- News Card 4 -->
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="News Image" class="news-image">
                        <div class="news-content">
                            <div class="news-date"><i class="fa-regular fa-calendar"></i> 3 September 2025</div>
                            <div class="news-category">Prestasi</div>
                            <h3 class="news-title">Mahasiswa TI Raih Juara 1 Hackathon Nasional 2025</h3>
                            <p class="news-excerpt">Tim mahasiswa Program Studi Teknologi Informasi berhasil meraih juara 1 dalam kompetisi Hackathon Nasional 2025 yang diselenggarakan di Jakarta...</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- News Card 5 -->
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1582573618381-c9a77c31f6b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="News Image" class="news-image">
                        <div class="news-content">
                            <div class="news-date"><i class="fa-regular fa-calendar"></i> 1 September 2025</div>
                            <div class="news-category">Beasiswa</div>
                            <h3 class="news-title">Pembukaan Beasiswa Prestasi Akademik Semester Ganjil 2025/2026</h3>
                            <p class="news-excerpt">Dibuka pendaftaran beasiswa prestasi akademik untuk semester ganjil tahun akademik 2025/2026. Segera daftarkan diri Anda sebelum tanggal 15 September 2025...</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- News Card 6 -->
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" alt="News Image" class="news-image">
                        <div class="news-content">
                            <div class="news-date"><i class="fa-regular fa-calendar"></i> 29 Agustus 2025</div>
                            <div class="news-category">Lowongan</div>
                            <h3 class="news-title">Lowongan Magang untuk Mahasiswa TI di Perusahaan Teknologi Terkemuka</h3>
                            <p class="news-excerpt">Tersedia lowongan magang bagi mahasiswa Program Studi Teknologi Informasi di perusahaan teknologi terkemuka. Persiapkan diri Anda dan segera ajukan aplikasi...</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Sebelumnya</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Selanjutnya</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Newsletter Subscription -->
                <div class="newsletter-section">
                    <h3 class="newsletter-title">Berlangganan Newsletter</h3>
                    <p class="newsletter-text">Dapatkan update terbaru langsung ke email Anda. Jangan lewatkan informasi penting seputar kegiatan dan pengumuman.</p>
                    <form class="newsletter-form">
                        <input type="email" class="form-control me-2" placeholder="Alamat email Anda" required>
                        <button type="submit" class="btn btn-light mt-2 mt-md-0">Berlangganan</button>
                    </form>
                </div>

                <!-- Recent News -->
                <div class="sidebar">
                    <h3 class="sidebar-title"><i class="fa-solid fa-clock-rotate-left"></i> Berita Terbaru</h3>
                    
                    <div class="recent-news-item">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Recent News" class="recent-news-image">
                        <div class="recent-news-content">
                            <h4 class="recent-news-title">Lowongan Magang untuk Mahasiswa TI</h4>
                            <div class="recent-news-date">29 Agustus 2025</div>
                        </div>
                    </div>
                    
                    <div class="recent-news-item">
                        <img src="https://images.unsplash.com/photo-1582573618381-c9a77c31f6b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Recent News" class="recent-news-image">
                        <div class="recent-news-content">
                            <h4 class="recent-news-title">Pembukaan Beasiswa Prestasi Akademik</h4>
                            <div class="recent-news-date">1 September 2025</div>
                        </div>
                    </div>
                    
                    <div class="recent-news-item">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Recent News" class="recent-news-image">
                        <div class="recent-news-content">
                            <h4 class="recent-news-title">Mahasiswa TI Raih Juara 1 Hackathon</h4>
                            <div class="recent-news-date">3 September 2025</div>
                        </div>
                    </div>
                    
                    <div class="recent-news-item">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="Recent News" class="recent-news-image">
                        <div class="recent-news-content">
                            <h4 class="recent-news-title">Seminar Nasional Teknologi Informasi 2025</h4>
                            <div class="recent-news-date">8 September 2025</div>
                        </div>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="sidebar">
                    <h3 class="sidebar-title"><i class="fa-solid fa-hashtag"></i> Tag Populer</h3>
                    <div class="categories-list">
                        <a href="#" class="category-btn">#Beasiswa</a>
                        <a href="#" class="category-btn">#Seminar</a>
                        <a href="#" class="category-btn">#Prestasi</a>
                        <a href="#" class="category-btn">#Magang</a>
                        <a href="#" class="category-btn">#LabKomputer</a>
                        <a href="#" class="category-btn">#Peminjaman</a>
                        <a href="#" class="category-btn">#SistemBaru</a>
                        <a href="#" class="category-btn">#Teknologi</a>
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
                    <a href="#">Kalender</a>
                    <a href="#">Peminjaman</a>
                    <a href="#">Berita</a>
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