<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Barang - Lab TIK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --accent: #e74c3c;
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
        }

        .dark-mode {
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

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar);
            color: white;
            transition: all 0.3s ease;
            overflow-y: auto;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            margin-left: 10px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .sidebar-logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(45deg, var(--primary), var(--info));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.2s;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid var(--primary);
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 20px;
            transition: all 0.3s ease;
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
            background-color: var(--accent);
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

        /* Page Title */
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .page-title p {
            color: var(--text-light);
            margin-top: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
        }

        .btn-warning {
            background-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: #e67e22;
        }

        /* Filter Section */
        .filter-section {
            background-color: var(--card);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .filter-group select, .filter-group input {
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background-color: var(--background);
            color: var(--text);
        }

        /* Returns Grid */
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .item-card {
            background-color: var(--card);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .item-content {
            padding: 20px;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .item-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-category {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .item-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-returned {
            background-color: rgba(46, 204, 113, 0.15);
            color: var(--success);
        }

        .status-late {
            background-color: rgba(231, 76, 60, 0.15);
            color: var(--accent);
        }

        .status-pending {
            background-color: rgba(241, 196, 15, 0.15);
            color: var(--warning);
        }

        .item-details {
            margin-bottom: 15px;
        }

        .item-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .item-meta span {
            color: var(--text-light);
        }

        .item-meta strong {
            color: var(--text);
        }

        .item-actions {
            display: flex;
            gap: 10px;
        }

        .item-actions .btn {
            flex: 1;
            justify-content: center;
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination-btn {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--card);
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid var(--border);
        }

        .pagination-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-btn:hover:not(.active) {
            background-color: var(--background);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: var(--card);
            border-radius: 12px;
            width: 500px;
            max-width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.5rem;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-light);
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background-color: var(--background);
            color: var(--text);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .modal-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Condition Assessment */
        .condition-assessment {
            margin: 20px 0;
            padding: 15px;
            background-color: var(--background);
            border-radius: 8px;
        }

        .condition-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        .condition-option {
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .condition-option:hover, .condition-option.selected {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar-header h2, .menu-item span {
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
            
            .items-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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
            
            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .items-grid {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .condition-options {
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h2>Lab TIK</h2>
            </div>
            
            <div class="sidebar-menu">
                <a href="/admin/dashboard" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/item" class="menu-item">
                    <i class="fas fa-box"></i>
                    <span>Inventaris Barang</span>
                </a>
                <a href="/admin/peminjaman" class="menu-item">
                    <i class="fas fa-hand-holding"></i>
                    <span>Peminjaman</span>
                </a>
                <a href="/admin/pengembalian" class="menu-item active">
                    <i class="fas fa-undo"></i>
                    <span>Pengembalian</span>
                <a href="/admin/feedback" class="menu-item">
                    <i class="fas fa-comment-dots"></i>
                    <span>Feedback</span>
                </a>
                </a>
                <a href="/admin/pengguna" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
                <a href="/admin/laporan" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan</span>
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
                    <input type="text" placeholder="Cari pengembalian...">
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

            <!-- Page Title -->
            <div class="page-title">
                <div>
                    <h1>Pengembalian Barang</h1>
                    <p>Kelola proses pengembalian barang Lab Teknologi Informasi</p>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-outline">
                        <i class="fas fa-file-export"></i> Ekspor
                    </button>
                    <button class="btn btn-primary" id="btn-process-return">
                        <i class="fas fa-undo"></i> Proses Pengembalian
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="status">Status Pengembalian</label>
                        <select id="status">
                            <option value="">Semua Status</option>
                            <option value="returned">Dikembalikan</option>
                            <option value="late">Terlambat</option>
                            <option value="pending">Menunggu Konfirmasi</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="date">Tanggal Pengembalian</label>
                        <input type="date" id="date">
                    </div>
                    <div class="filter-group">
                        <label for="borrower">Peminjam</label>
                        <input type="text" id="borrower" placeholder="Nama peminjam...">
                    </div>
                    <div class="filter-group">
                        <label for="sort">Urutkan</label>
                        <select id="sort">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="borrower">Nama Peminjam</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Returns List -->
            <div class="items-grid">
                <!-- Return 1 -->
                <div class="item-card">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <div class="item-title">Pengembalian #RTN001</div>
                                <div class="item-category">Oculus Quest 2</div>
                            </div>
                            <span class="item-status status-returned">Dikembalikan</span>
                        </div>
                        <div class="item-details">
                            <div class="item-meta">
                                <span>Peminjam:</span>
                                <strong>Ahmad Rizki (2010114001)</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Pinjam:</span>
                                <strong>12 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Kembali:</span>
                                <strong>19 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Kondisi:</span>
                                <strong>Baik</strong>
                            </div>
                        </div>
                        <div class="item-actions">
                            <button class="btn btn-outline">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-primary">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Return 2 -->
                <div class="item-card">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <div class="item-title">Pengembalian #RTN002</div>
                                <div class="item-category">Laptop Gaming ASUS ROG</div>
                            </div>
                            <span class="item-status status-late">Terlambat</span>
                        </div>
                        <div class="item-details">
                            <div class="item-meta">
                                <span>Peminjam:</span>
                                <strong>Dewi Lestari (2010114025)</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Pinjam:</span>
                                <strong>5 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Kembali:</span>
                                <strong>15 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Denda:</span>
                                <strong>Rp 50.000</strong>
                            </div>
                        </div>
                        <div class="item-actions">
                            <button class="btn btn-outline">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-warning">
                                <i class="fas fa-money-bill"></i> Bayar Denda
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Return 3 -->
                <div class="item-card">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <div class="item-title">Pengembalian #RTN003</div>
                                <div class="item-category">Kamera DSLR Canon</div>
                            </div>
                            <span class="item-status status-pending">Menunggu Konfirmasi</span>
                        </div>
                        <div class="item-details">
                            <div class="item-meta">
                                <span>Peminjam:</span>
                                <strong>Budi Santoso (2010114050)</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Pinjam:</span>
                                <strong>15 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Kembali:</span>
                                <strong>22 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Status:</span>
                                <strong>Perlu Pengecekan</strong>
                            </div>
                        </div>
                        <div class="item-actions">
                            <button class="btn btn-outline">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-success" data-id="RTN003">
                                <i class="fas fa-check"></i> Konfirmasi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Return 4 -->
                <div class="item-card">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <div class="item-title">Pengembalian #RTN004</div>
                                <div class="item-category">Raspberry Pi 4</div>
                            </div>
                            <span class="item-status status-returned">Dikembalikan</span>
                        </div>
                        <div class="item-details">
                            <div class="item-meta">
                                <span>Peminjam:</span>
                                <strong>Citra Ayu (2010114080)</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Pinjam:</span>
                                <strong>1 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Kembali:</span>
                                <strong>8 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Kondisi:</span>
                                <strong>Baik</strong>
                            </div>
                        </div>
                        <div class="item-actions">
                            <button class="btn btn-outline">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-primary">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <div class="pagination-btn">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="pagination-btn active">1</div>
                <div class="pagination-btn">2</div>
                <div class="pagination-btn">3</div>
                <div class="pagination-btn">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <div class="pagination-btn">10</div>
                <div class="pagination-btn">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Return Modal -->
    <div class="modal" id="process-return-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Proses Pengembalian Barang</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="loan-id">ID Peminjaman</label>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" id="loan-id" placeholder="Cari ID peminjaman...">
                    </div>
                </div>
                
                <div id="loan-details" style="display: none;">
                    <div class="form-group">
                        <h3>Detail Peminjaman</h3>
                        <div class="item-details">
                            <div class="item-meta">
                                <span>Peminjam:</span>
                                <strong>Ahmad Rizki (2010114001)</strong>
                            </div>
                            <div class="item-meta">
                                <span>Barang:</span>
                                <strong>Oculus Quest 2</strong>
                            </div>
                            <div class="item-meta">
                                <span>Tanggal Pinjam:</span>
                                <strong>12 Nov 2023</strong>
                            </div>
                            <div class="item-meta">
                                <span>Jatuh Tempo:</span>
                                <strong>19 Nov 2023</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="return-date">Tanggal Pengembalian</label>
                        <input type="date" id="return-date" value="2023-11-19">
                    </div>
                    
                    <div class="condition-assessment">
                        <label>Kondisi Barang</label>
                        <div class="condition-options">
                            <div class="condition-option selected">Baik</div>
                            <div class="condition-option">Ringan</div>
                            <div class="condition-option">Berat</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Catatan</label>
                        <textarea id="notes" rows="3" placeholder="Tambahkan catatan tentang kondisi barang..."></textarea>
                    </div>
                    
                    <div class="form-group" id="fine-section" style="display: none;">
                        <label for="fine-amount">Jumlah Denda</label>
                        <input type="text" id="fine-amount" value="Rp 0" disabled>
                        <small style="color: var(--accent);">* Pengembalian terlambat dikenakan denda Rp 10.000/hari</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancel-process">Batal</button>
                <button class="btn btn-primary" id="confirm-return" disabled>Konfirmasi Pengembalian</button>
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
        
        // Modal functionality
        const processReturnModal = document.getElementById('process-return-modal');
        const processReturnBtn = document.getElementById('btn-process-return');
        const cancelProcessBtn = document.getElementById('cancel-process');
        const closeModalBtn = document.querySelector('.modal-close');
        
        processReturnBtn.addEventListener('click', () => {
            processReturnModal.style.display = 'flex';
        });
        
        const closeModal = () => {
            processReturnModal.style.display = 'none';
        };
        
        cancelProcessBtn.addEventListener('click', closeModal);
        closeModalBtn.addEventListener('click', closeModal);
        
        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === processReturnModal) {
                closeModal();
            }
        });
        
        // Condition selection
        const conditionOptions = document.querySelectorAll('.condition-option');
        conditionOptions.forEach(option => {
            option.addEventListener('click', () => {
                conditionOptions.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
            });
        });
        
        // Simulate loan search
        const loanIdInput = document.getElementById('loan-id');
        const loanDetails = document.getElementById('loan-details');
        const confirmReturnBtn = document.getElementById('confirm-return');
        
        loanIdInput.addEventListener('input', () => {
            if (loanIdInput.value.length > 3) {
                loanDetails.style.display = 'block';
                confirmReturnBtn.disabled = false;
            } else {
                loanDetails.style.display = 'none';
                confirmReturnBtn.disabled = true;
            }
        });
        
        // Confirm return buttons
        const confirmButtons = document.querySelectorAll('.btn-success');
        confirmButtons.forEach(button => {
            button.addEventListener('click', () => {
                const returnId = button.getAttribute('data-id');
                alert(`Pengembalian ${returnId} berhasil dikonfirmasi!`);
                button.innerHTML = '<i class="fas fa-check"></i> Dikonfirmasi';
                button.classList.remove('btn-success');
                button.classList.add('btn-primary');
                button.disabled = true;
                
                // Update status text
                const statusElement = button.closest('.item-card').querySelector('.item-status');
                statusElement.textContent = 'Dikembalikan';
                statusElement.className = 'item-status status-returned';
            });
        });
        
        // Terapkan dark mode jika sebelumnya diaktifkan
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
    </script>
</body>
</html>