<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan Peminjaman Sarpas</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .breadcrumb {
            background-color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .breadcrumb-content {
            display: flex;
            list-style: none;
        }
        
        .breadcrumb-content li {
            margin-right: 0.5rem;
        }
        
        .breadcrumb-content li:after {
            content: ">";
            margin-left: 0.5rem;
            color: #777;
        }
        
        .breadcrumb-content li:last-child:after {
            content: "";
        }
        
        .breadcrumb-content a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .breadcrumb-content a:hover {
            text-decoration: underline;
        }
        
        .content {
            display: flex;
            gap: 2rem;
            margin-bottom: 3rem;
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
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
            margin-bottom: 1.5rem;
        }
        
        .footer-section h3 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        
        .footer-bottom {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Syarat dan Ketentuan Peminjaman</h1>
            <p class="subtitle">Sarana dan Prasarana (Sarpas)</p>
        </div>
    </header>
    
    <div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb-content">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Layanan</a></li>
                <li>Peminjaman Sarpas</li>
            </ul>
        </div>
    </div>
    
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
                
                <div class="action-buttons">
                    <a href="#" class="btn">Ajukan Peminjaman</a>
                    <a href="#" class="btn btn-outline">Download Formulir</a>
                </div>
            </main>
            
            <aside>
                <div class="info-box">
                    <h3>Informasi Kontak</h3>
                    <ul class="contact-info">
                        <li><i>📞</i> (021) 1234-5678</li>
                        <li><i>✉️</i> sarpas@example.com</li>
                        <li><i>🏢</i> Gedung Utama, Lantai 3</li>
                        <li><i>🕒</i> Senin - Jumat, 08:00 - 16:00</li>
                    </ul>
                </div>
                
                <div class="info-box">
                    <h3>Dokumen yang Diperlukan</h3>
                    <ul>
                        <li>Formulir Peminjaman</li>
                        <li>Fotokopi KTP/Kartu Identitas</li>
                        <li>Surat Pengantar (jika diperlukan)</li>
                        <li>Proposal Kegiatan (untuk peminjaman besar)</li>
                    </ul>
                </div>
                
                <div class="info-box">
                    <h3>Status Peminjaman</h3>
                    <p>Periksa status permohonan peminjaman Anda dengan memasukkan kode referensi.</p>
                    <form>
                        <input type="text" placeholder="Masukkan kode referensi" style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px;">
                        <button type="submit" class="btn" style="width: 100%;">Cek Status</button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
    
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
                    <li><a href="#">Kalender Perkuliahan</a></li>
                    <li><a href="#">Tentang</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
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
            <p>&copy; 2023 Sistem Peminjaman Alat - Nama Sekolah/Kampus. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>