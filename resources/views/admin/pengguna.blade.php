<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Lab TIK</title>
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

        .btn-danger {
            background-color: var(--accent);
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
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

        /* Users Table */
        .users-table-container {
            background-color: var(--card);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th {
            background-color: var(--background);
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--text-light);
            border-bottom: 1px solid var(--border);
        }

        .users-table td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
        }

        .users-table tr:last-child td {
            border-bottom: none;
        }

        .users-table tr:hover {
            background-color: var(--background);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .table-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--info));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
        }

        .user-name {
            font-weight: 500;
        }

        .user-id {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .user-role {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .role-admin {
            background-color: rgba(231, 76, 60, 0.15);
            color: var(--accent);
        }

        .role-staff {
            background-color: rgba(46, 204, 113, 0.15);
            color: var(--success);
        }

        .role-student {
            background-color: rgba(52, 152, 219, 0.15);
            color: var(--primary);
        }

        .user-status {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .status-active {
            background-color: var(--success);
        }

        .status-inactive {
            background-color: var(--text-light);
        }

        .table-actions {
            display: flex;
            gap: 8px;
        }

        .table-actions .btn {
            padding: 6px 10px;
            font-size: 0.85rem;
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
            
            .form-row {
                grid-template-columns: 1fr;
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
            
            .users-table {
                display: block;
                overflow-x: auto;
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
                <a href="/admin/pengembalian" class="menu-item">
                    <i class="fas fa-undo"></i>
                    <span>Pengembalian</span>
                </a>
                <a href="/admin/pengguna" class="menu-item active">
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
                    <input type="text" placeholder="Cari pengguna...">
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
                    <h1>Manajemen Pengguna</h1>
                    <p>Kelola data pengguna sistem Lab Teknologi Informasi</p>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-outline">
                        <i class="fas fa-file-export"></i> Ekspor
                    </button>
                    <button class="btn btn-primary" id="btn-add-user">
                        <i class="fas fa-plus"></i> Tambah Pengguna
                    </button>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="role">Peran Pengguna</label>
                        <select id="role">
                            <option value="">Semua Peran</option>
                            <option value="admin">Administrator</option>
                            <option value="staff">Staf Lab</option>
                            <option value="student">Mahasiswa</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="status-filter">Status</label>
                        <select id="status-filter">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="sort">Urutkan</label>
                        <select id="sort">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="name">Nama</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="department">Jurusan</label>
                        <select id="department">
                            <option value="">Semua Jurusan</option>
                            <option value="ti">Teknik Informatika</option>
                            <option value="si">Sistem Informasi</option>
                            <option value="tk">Teknik Komputer</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="users-table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Peran</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="table-user-avatar">AD</div>
                                    <div>
                                        <div class="user-name">Admin Lab</div>
                                        <div class="user-id">admin@labtik.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="user-role role-admin">Administrator</span></td>
                            <td>-</td>
                            <td>
                                <div class="user-status">
                                    <div class="status-indicator status-active"></div>
                                    <span>Aktif</span>
                                </div>
                            </td>
                            <td>12 Jan 2022</td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-outline">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="table-user-avatar">RS</div>
                                    <div>
                                        <div class="user-name">Rina Susanti</div>
                                        <div class="user-id">2010114001</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="user-role role-staff">Staf Lab</span></td>
                            <td>Teknik Informatika</td>
                            <td>
                                <div class="user-status">
                                    <div class="status-indicator status-active"></div>
                                    <span>Aktif</span>
                                </div>
                            </td>
                            <td>15 Mar 2023</td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-outline">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="table-user-avatar">AS</div>
                                    <div>
                                        <div class="user-name">Ahmad Surya</div>
                                        <div class="user-id">2010114023</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="user-role role-student">Mahasiswa</span></td>
                            <td>Sistem Informasi</td>
                            <td>
                                <div class="user-status">
                                    <div class="status-indicator status-active"></div>
                                    <span>Aktif</span>
                                </div>
                            </td>
                            <td>20 Agu 2023</td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-outline">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="table-user-avatar">DW</div>
                                    <div>
                                        <div class="user-name">Dewi Wulandari</div>
                                        <div class="user-id">2010114056</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="user-role role-student">Mahasiswa</span></td>
                            <td>Teknik Informatika</td>
                            <td>
                                <div class="user-status">
                                    <div class="status-indicator status-inactive"></div>
                                    <span>Non-Aktif</span>
                                </div>
                            </td>
                            <td>05 Feb 2023</td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-outline">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="table-user-avatar">BS</div>
                                    <div>
                                        <div class="user-name">Budi Santoso</div>
                                        <div class="user-id">2010114089</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="user-role role-student">Mahasiswa</span></td>
                            <td>Teknik Komputer</td>
                            <td>
                                <div class="user-status">
                                    <div class="status-indicator status-active"></div>
                                    <span>Aktif</span>
                                </div>
                            </td>
                            <td>10 Sep 2023</td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-outline">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

    <!-- Add User Modal -->
    <div class="modal" id="add-user-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Pengguna Baru</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="user-name">Nama Lengkap</label>
                        <input type="text" id="user-name" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label for="user-email">Email / NIM</label>
                        <input type="text" id="user-email" placeholder="Email atau NIM">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="user-role">Peran Pengguna</label>
                        <select id="user-role">
                            <option value="student">Mahasiswa</option>
                            <option value="staff">Staf Lab</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user-department">Jurusan</label>
                        <select id="user-department">
                            <option value="">Pilih Jurusan</option>
                            <option value="ti">Teknik Informatika</option>
                            <option value="si">Sistem Informasi</option>
                            <option value="tk">Teknik Komputer</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="user-password">Kata Sandi</label>
                        <input type="password" id="user-password" placeholder="Masukkan kata sandi">
                    </div>
                    <div class="form-group">
                        <label for="user-confirm-password">Konfirmasi Kata Sandi</label>
                        <input type="password" id="user-confirm-password" placeholder="Konfirmasi kata sandi">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="user-status">Status</label>
                    <select id="user-status">
                        <option value="active">Aktif</option>
                        <option value="inactive">Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancel-add-user">Batal</button>
                <button class="btn btn-primary" id="confirm-add-user">Simpan Pengguna</button>
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
        const addUserModal = document.getElementById('add-user-modal');
        const addUserBtn = document.getElementById('btn-add-user');
        const cancelAddUserBtn = document.getElementById('cancel-add-user');
        const closeModalBtn = document.querySelector('.modal-close');
        
        addUserBtn.addEventListener('click', () => {
            addUserModal.style.display = 'flex';
        });
        
        const closeModal = () => {
            addUserModal.style.display = 'none';
        };
        
        cancelAddUserBtn.addEventListener('click', closeModal);
        closeModalBtn.addEventListener('click', closeModal);
        
        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === addUserModal) {
                closeModal();
            }
        });
        
        // Confirm add user
        const confirmAddUserBtn = document.getElementById('confirm-add-user');
        confirmAddUserBtn.addEventListener('click', () => {
            alert('Pengguna baru berhasil ditambahkan!');
            closeModal();
        });
        
        // Terapkan dark mode jika sebelumnya diaktifkan
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
    </script>
</body>
</html>