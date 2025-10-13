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
        
    /* ===== FAQ ===== */
    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 20px;
    }
    .search-box {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 16px;
      margin-bottom: 20px;
    }
    .faq-section {
      background: linear-gradient(to right, #2a5ee8, #5166f0);
      color: white;
      padding: 12px 20px;
      border-radius: 10px 10px 0 0;
      margin-top: 25px;
      font-weight: bold;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .faq-item {
      background: #fff;
      border-bottom: 1px solid #eee;
      cursor: pointer;
      padding: 16px 20px;
      font-size: 16px;
      font-weight: bold;
      position: relative;
    }
    .faq-item::after {
      content: "▾";
      position: absolute;
      right: 20px;
      font-size: 16px;
      transition: transform 0.3s;
    }
    .faq-item.active::after {
      transform: rotate(180deg);
    }
    .faq-answer {
      display: none;
      padding: 14px 20px;
      background: #f0f6ff;
      font-size: 15px;
      border-left: 4px solid #2a5ee8;
      margin: 0 0 10px 0;
      border-radius: 4px;
      line-height: 1.6;
    }
    .faq-item.active + .faq-answer {
      display: block;
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

  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar" id="navbar">
    <a href="#" class="logo">SarPras TI</a>
    <ul>
      <li><a href="/home">Beranda</a></li>
      <li><a href="/kalender">Kalender Perkuliahan</a></li>
      <li><a href="/peminjaman1">Daftar Peminjaman</a></li>
      <li><a href="/about">Tentang</a></li>
      <li>
        <a href="/login" class="btn-warning">
          <i class="fa-solid fa-right-to-bracket"></i>Login
        </a>
      </li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-content">
      <h1 class="display-4 fw-bold">Frequently Asked Questions (FAQ)</h1>
      <p class="lead">Temukan jawaban dari pertanyaan umum terkait peminjaman sarana dan prasarana</p>
    </div>
  </section>

  <!-- FAQ CONTENT -->
  <div class="container">
    <input type="text" id="search" class="search-box" placeholder="Cari pertanyaan atau jawaban...">

    <!-- Umum -->
    <div class="faq-section">❓ Umum</div>
    <div class="faq-item">Apa itu sistem peminjaman sarana dan prasarana Prodi TI?</div>
    <div class="faq-answer">Sistem ini adalah layanan online untuk mempermudah mahasiswa dan dosen dalam mengajukan peminjaman fasilitas sarana dan prasarana di Prodi Teknologi Informasi.</div>
    <div class="faq-item">Siapa saja yang dapat menggunakan layanan ini?</div>
    <div class="faq-answer">Layanan ini dapat digunakan oleh seluruh civitas akademika Prodi Teknologi Informasi, termasuk mahasiswa, dosen, dan staf.</div>
    <div class="faq-item">Apa saja fasilitas/sarana yang bisa dipinjam melalui sistem ini?</div>
    <div class="faq-answer">Fasilitas yang dapat dipinjam antara lain: ruang kelas, laboratorium, proyektor, laptop, dan perangkat pendukung lainnya.</div>

    <!-- Akun & Akses -->
    <div class="faq-section">🔑 Akun & Akses</div>
    <div class="faq-item">Bagaimana cara mendaftar/mengakses sistem peminjaman?</div>
    <div class="faq-answer">Pengguna dapat mengakses sistem dengan login menggunakan akun yang telah terdaftar atau mendaftar melalui halaman registrasi.</div>
    <div class="faq-item">Apa yang harus dilakukan jika lupa password akun?</div>
    <div class="faq-answer">Jika lupa password, pengguna dapat menggunakan fitur "Lupa Password" untuk mengatur ulang kata sandi.</div>
    <div class="faq-item">Apakah bisa login menggunakan akun kampus (SSO)?</div>
    <div class="faq-answer">Ya, sistem ini mendukung login menggunakan akun Single Sign-On (SSO) kampus.</div>

    <!-- Proses Peminjaman -->
    <div class="faq-section">📋 Proses Peminjaman</div>
    <div class="faq-item">Bagaimana cara melakukan peminjaman sarana/prasarana?</div>
    <div class="faq-answer">Pengguna memilih fasilitas yang tersedia, mengisi formulir peminjaman, lalu mengajukan permohonan melalui sistem.</div>
    <div class="faq-item">Apakah ada batasan jumlah barang yang bisa dipinjam?</div>
    <div class="faq-answer">Ya, terdapat batasan jumlah barang sesuai dengan kebijakan prodi dan ketersediaan fasilitas.</div>
    <div class="faq-item">Apakah saya bisa melakukan peminjaman untuk orang lain?</div>
    <div class="faq-answer">Tidak, peminjaman hanya berlaku untuk pemilik akun yang mengajukan.</div>
    <div class="faq-item">Bagaimana cara membatalkan peminjaman yang sudah diajukan?</div>
    <div class="faq-answer">Pengguna dapat membatalkan permohonan melalui menu "Riwayat Peminjaman" selama permohonan belum disetujui.</div>

    <!-- Jadwal & Durasi -->
    <div class="faq-section">⏰ Jadwal & Durasi</div>
    <div class="faq-item">Berapa lama maksimal durasi peminjaman?</div>
    <div class="faq-answer">Maksimal durasi peminjaman adalah 1 minggu, kecuali ada izin khusus dari pengelola.</div>
    <div class="faq-item">Bagaimana jika saya ingin memperpanjang waktu peminjaman?</div>
    <div class="faq-answer">Pengguna harus mengajukan perpanjangan melalui sistem sebelum masa peminjaman berakhir.</div>
    <div class="faq-item">Apa yang terjadi jika saya telat mengembalikan fasilitas?</div>
    <div class="faq-answer">Keterlambatan pengembalian dapat dikenakan sanksi sesuai aturan prodi, termasuk pembatasan peminjaman berikutnya.</div>

    <!-- Persetujuan & Aturan -->
    <div class="faq-section">📌 Persetujuan & Aturan</div>
    <div class="faq-item">Siapa yang menyetujui permohonan peminjaman?</div>
    <div class="faq-answer">Permohonan peminjaman disetujui oleh admin atau pengelola fasilitas Prodi TI.</div>
    <div class="faq-item">Berapa lama proses persetujuan biasanya berlangsung?</div>
    <div class="faq-answer">Proses persetujuan biasanya memerlukan waktu 1–2 hari kerja.</div>
    <div class="faq-item">Apa saja aturan penggunaan sarana dan prasarana?</div>
    <div class="faq-answer">Aturan meliputi penggunaan secara bijak, menjaga kebersihan, serta mengembalikan fasilitas dalam kondisi baik.</div>
    <div class="faq-item">Apakah ada sanksi jika sarana rusak/hilang saat digunakan?</div>
    <div class="faq-answer">Ya, pengguna wajib mengganti atau memperbaiki fasilitas yang rusak/hilang sesuai kebijakan prodi.</div>

    <!-- Teknis & Kendala -->
    <div class="faq-section">⚙️ Teknis & Kendala</div>
    <div class="faq-item">Bagaimana jika terjadi error pada sistem saat melakukan peminjaman?</div>
    <div class="faq-answer">Pengguna dapat mencoba refresh halaman, atau melaporkan kendala ke admin sistem.</div>
    <div class="faq-item">Siapa yang bisa dihubungi jika ada masalah dengan fasilitas yang dipinjam?</div>
    <div class="faq-answer">Hubungi admin atau petugas laboratorium yang bertanggung jawab terhadap fasilitas tersebut.</div>
    <div class="faq-item">Bagaimana cara melaporkan kerusakan pada fasilitas?</div>
    <div class="faq-answer">Laporan kerusakan dapat disampaikan melalui menu "Laporan" di sistem atau langsung kepada pengelola.</div>

    <!-- Kontak & Bantuan -->
    <div class="faq-section">☎️ Kontak & Bantuan</div>
    <div class="faq-item">Dimana saya bisa mendapatkan informasi lebih lanjut?</div>
    <div class="faq-answer">Informasi lebih lanjut dapat diperoleh melalui website resmi Prodi Teknologi Informasi atau admin pengelola.</div>
    <div class="faq-item">Apakah ada kontak admin/pengelola yang bisa dihubungi langsung?</div>
    <div class="faq-answer">Ya, admin dapat dihubungi melalui email: peminjaman@example.ac.id atau nomor telepon resmi prodi.</div>
  </div>

  <!-- Footer -->
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
            <p>&copy; 2025 Sistem Peminjaman Sarana Prasarana - Program Studi Teknologi Informasi Politeknik Negeri Tanah Laut. All Rights Reserved.</p>
        </div>
    </footer>

  <script>
    // Toggle FAQ
    document.querySelectorAll('.faq-item').forEach(item => {
      item.addEventListener('click', () => {
        item.classList.toggle('active');
      });
    });

    // Search FAQ
    document.getElementById('search').addEventListener('keyup', function () {
      let filter = this.value.toLowerCase();
      document.querySelectorAll('.faq-item, .faq-answer').forEach(el => {
        if (el.textContent.toLowerCase().includes(filter)) {
          el.style.display = '';
        } else {
          el.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>
