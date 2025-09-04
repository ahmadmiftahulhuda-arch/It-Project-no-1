<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman - Sarpras TI</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
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
            width: 100%;
        }
        
        /* ===== FILTER SECTION ===== */
        .filter-section {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* ===== STATS CARDS ===== */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .stat-icon.pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .stat-icon.approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .stat-icon.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .stat-icon.completed {
            background-color: #e2e3e5;
            color: #383d41;
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* ===== TABLE STYLES ===== */
        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
            overflow-x: auto;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .table-title {
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .loans-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .loans-table th {
            background-color: #f8f9fa;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        
        .loans-table td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        .loans-table tr:hover {
            background-color: #f8f9fa;
        }
        
        /* ===== STATUS BADGES ===== */
        .status-badge {
            padding: 0.4em 0.8em;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
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
            background-color: #e2e3e5;
            color: #383d41;
        }
        
        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        /* ===== PAGINATION ===== */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* ===== MODAL STYLES ===== */
        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 1rem 1.5rem;
        }
        
        .modal-title {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-close {
            filter: invert(1);
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
            
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
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
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
            
            .pagination-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .footer-section {
                flex: 0 0 100%;
            }
        }
        
        @media (max-width: 576px) {
            .loans-table {
                font-size: 0.875rem;
            }
            
            .loans-table th, 
            .loans-table td {
                padding: 0.75rem 0.5rem;
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
            <li><a href="/peminjaman" class="active">Daftar Peminjaman</a></li>
            <li><a href="/berita">Berita</a></li>
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
                    <li class="breadcrumb-item active" aria-current="page">Daftar Peminjaman</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title"><i class="fa-solid fa-clipboard-list"></i> Daftar Peminjaman</h1>
                <p class="page-description">Kelola semua permintaan peminjaman sarana dan prasarana di sini</p>
            </div>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLoanModal">
                <i class="fa-solid fa-plus"></i> Ajukan Peminjaman
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="stat-value">8</div>
                <div class="stat-label">Peminjaman Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon approved">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <div class="stat-value">12</div>
                <div class="stat-label">Peminjaman Disetujui</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rejected">
                    <i class="fa-solid fa-times-circle"></i>
                </div>
                <div class="stat-value">3</div>
                <div class="stat-label">Peminjaman Ditolak</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon completed">
                    <i class="fa-solid fa-check-double"></i>
                </div>
                <div class="stat-value">15</div>
                <div class="stat-label">Peminjaman Selesai</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="fa-solid fa-filter"></i> Filter Peminjaman</h3>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="statusFilter" class="form-label">Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                        <option value="completed">Selesai</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="dateFilter" class="form-label">Tanggal</label>
                    <select class="form-select" id="dateFilter">
                        <option value="">Semua Tanggal</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="typeFilter" class="form-label">Jenis</label>
                    <select class="form-select" id="typeFilter">
                        <option value="">Semua Jenis</option>
                        <option value="room">Ruangan</option>
                        <option value="projector">Proyektor</option>
                        <option value="lab">Laboratorium</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button class="btn btn-secondary w-100">
                        <i class="fa-solid fa-filter"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Loans Table -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title"><i class="fa-solid fa-table-list"></i> Daftar Peminjaman</h3>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary">
                        <i class="fa-solid fa-download"></i> Ekspor
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="fa-solid fa-print"></i> Cetak
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="loans-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Peminjam</th>
                            <th>Item</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#PJN001</td>
                            <td>Budi Santoso</td>
                            <td>Lab Komputer 1</td>
                            <td>12 Sep 2025</td>
                            <td>08:00 - 10:00</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary">Detail</button>
                                    <button class="btn btn-sm btn-outline-danger">Batalkan</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#PJN002</td>
                            <td>Siti Rahayu</td>
                            <td>Proyektor EPSON 001</td>
                            <td>13 Sep 2025</td>
                            <td>10:00 - 12:00</td>
                            <td><span class="status-badge status-approved">Disetujui</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary">Detail</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#PJN003</td>
                            <td>Ahmad Fauzi</td>
                            <td>Ruang Kelas A</td>
                            <td>14 Sep 2025</td>
                            <td>13:00 - 15:00</td>
                            <td><span class="status-badge status-rejected">Ditolak</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary">Detail</button>
                                    <button class="btn btn-sm btn-outline-success">Ajukan Ulang</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#PJN004</td>
                            <td>Dewi Anggraini</td>
                            <td>Lab Jaringan</td>
                            <td>15 Sep 2025</td>
                            <td>08:00 - 12:00</td>
                            <td><span class="status-badge status-completed">Selesai</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary">Detail</button>
                                    <button class="btn btn-sm btn-outline-info">Ulasan</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#PJN005</td>
                            <td>Rizky Pratama</td>
                            <td>Proyektor BENQ 002</td>
                            <td>16 Sep 2025</td>
                            <td>14:00 - 16:00</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary">Detail</button>
                                    <button class="btn btn-sm btn-outline-danger">Batalkan</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    Menampilkan 1 hingga 5 dari 38 entri
                </div>
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
    </div>

    <!-- Add Loan Modal -->
    <div class="modal fade" id="addLoanModal" tabindex="-1" aria-labelledby="addLoanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLoanModalLabel"><i class="fa-solid fa-plus"></i> Ajukan Peminjaman Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="loanType" class="form-label">Jenis Peminjaman</label>
                                <select class="form-select" id="loanType" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="room">Ruangan</option>
                                    <option value="projector">Proyektor</option>
                                    <option value="lab">Laboratorium</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="loanItem" class="form-label">Pilih Item</label>
                                <select class="form-select" id="loanItem" required>
                                    <option value="">Pilih Item</option>
                                    <option value="room1">Lab Komputer 1</option>
                                    <option value="room2">Lab Komputer 2</option>
                                    <option value="room3">Ruang Kelas A</option>
                                    <option value="projector1">Proyektor EPSON 001</option>
                                    <option value="projector2">Proyektor BENQ 002</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="loanDate" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="loanDate" required>
                            </div>
                            <div class="col-md-3">
                                <label for="startTime" class="form-label">Waktu Mulai</label>
                                <input type="time" class="form-control" id="startTime" required>
                            </div>
                            <div class="col-md-3">
                                <label for="endTime" class="form-label">Waktu Selesai</label>
                                <input type="time" class="form-control" id="endTime" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="loanPurpose" class="form-label">Tujuan Peminjaman</label>
                            <textarea class="form-control" id="loanPurpose" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="loanNotes" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="loanNotes" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Ajukan Peminjaman</button>
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