<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Barang - Lab TIK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3b5998;
            --secondary: #6d84b4;
            --success: #4caf50;
            --info: #2196f3;
            --warning: #ff9800;
            --danger: #f44336;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
            --sidebar-width: 260px;
            --text-light: #6c757d;
            --text-dark: #495057;
            --bg-light: #f5f8fa;
            --bg-card: #ffffff;
            --border-light: #e9ecef;
        }

        .dark-mode {
            --bg-light: #121212;
            --bg-card: #1e1e1e;
            --text-dark: #e0e0e0;
            --text-light: #a0a0a0;
            --border-light: #333;
            --dark: #f0f0f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles - Warna diubah seperti kode pertama */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            transition: all 0.3s ease;
            overflow-y: auto;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .sidebar-logo {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
        }

        /* Scrollbar styling untuk sidebar */
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        .menu-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
            flex-shrink: 0;
            font-size: 18px;
        }

        .menu-item span {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        /* Header Styles - Dipertahankan dari kode kedua */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            background-color: var(--bg-card);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid var(--border-light);
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--bg-light);
            border-radius: 20px;
            padding: 8px 15px;
            width: 300px;
        }

        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            color: var(--text-dark);
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
            background-color: var(--bg-light);
            margin-left: 10px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
            color: var(--text-dark);
        }

        .notification-btn::after {
            content: '3';
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background-color: var(--danger);
            color: white;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-btn:hover,
        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
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
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 10px;
        }

        /* Dashboard Content */
        .dashboard-title {
            margin-bottom: 20px;
        }

        .dashboard-title h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .dashboard-title p {
            color: var(--text-light);
            margin-top: 5px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background-color: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border-light);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .bg-primary { background-color: rgba(59, 89, 152, 0.15); color: var(--primary); }
        .bg-success { background-color: rgba(76, 175, 80, 0.15); color: var(--success); }
        .bg-warning { background-color: rgba(255, 152, 0, 0.15); color: var(--warning); }
        .bg-danger { background-color: rgba(244, 67, 54, 0.15); color: var(--danger); }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Table Styles */
        .table-container {
            background-color: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            margin-bottom: 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-light);
        }

        .data-table th {
            color: var(--text-light);
            font-weight: 600;
            font-size: 0.9rem;
            background: var(--bg-light);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tbody tr {
            transition: all 0.3s;
        }

        .data-table tbody tr:hover {
            background: var(--bg-light);
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-available { background-color: rgba(46, 204, 113, 0.15); color: var(--success); }
        .status-pending { background-color: rgba(241, 196, 15, 0.15); color: var(--warning); }
        .status-borrowed { background-color: rgba(52, 152, 219, 0.15); color: var(--primary); }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: var(--bg-card);
            border-radius: 12px;
            width: 600px;
            max-width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-light);
        }

        .close-btn {
            cursor: pointer;
            font-size: 24px;
            color: var(--text-light);
        }

        .close-btn:hover {
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .char-count {
            text-align: right;
            font-size: 12px;
            color: var(--text-light);
            margin-top: 5px;
        }

        .status-radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
        }

        .radio-label input {
            display: none;
        }

        .radio-custom {
            width: 18px;
            height: 18px;
            border: 2px solid var(--border-light);
            border-radius: 50%;
            margin-right: 8px;
            position: relative;
            transition: all 0.3s ease;
        }

        .radio-label input:checked + .radio-custom {
            border-color: var(--primary);
            background: var(--primary);
        }

        .radio-label input:checked + .radio-custom::after {
            content: '';
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-light);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: var(--border-light);
            color: var(--text-dark);
        }

        .btn-cancel:hover {
            background: #bdc3c7;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary);
        }

        /* Button Styles untuk aksi di header */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
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
            
            .stats-grid {
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

        /* Dark Mode */
        body.dark-mode .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }

        body.dark-mode .header,
        body.dark-mode .stat-card,
        body.dark-mode .table-container {
            background: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .data-table th {
            background: #252525;
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .data-table tbody tr {
            border-color: var(--border-light);
        }

        body.dark-mode .data-table tbody tr:hover {
            background: #2a2a2a;
        }

        body.dark-mode .search-bar input {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        body.dark-mode .notification-btn,
        body.dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        body.dark-mode .dashboard-title h1 {
            color: var(--text-dark);
        }

        body.dark-mode .dashboard-title p {
            color: var(--text-light);
        }

        body.dark-mode .stat-label {
            color: var(--text-light);
        }

        .menu-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar - Warna diubah seperti kode pertama -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h2>Admin TI</h2>
            </div>
            
            <div class="sidebar-menu">
                <a href="/admin/dashboard" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/peminjaman" class="menu-item">
                    <i class="fas fa-hand-holding"></i>
                    <span>Peminjaman</span>
                </a>
                <a href="/admin/pengembalian" class="menu-item">
                    <i class="fas fa-undo"></i>
                    <span>Pengembalian</span>
                </a>
                <a href="/admin/riwayat" class="menu-item">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Peminjaman</span>
                </a>
                <a href="/admin/feedback" class="menu-item active">
                    <i class="fas fa-comment"></i>
                    <span>Feedback</span>
                </a>
                <a href="/admin/proyektor" class="menu-item">
                    <i class="fas fa-projector"></i>
                    <span>Proyektor</span>
                </a>
                <a href="/admin/jadwalperkuliahan" class="menu-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Jadwal Perkuliahan</span>
                </a>
                <a href="/admin/ruangan" class="menu-item">
                    <i class="fas fa-door-open"></i>
                    <span>Ruangan</span>
                </a>
                <a href="/admin/slotwaktu" class="menu-item">
                    <i class="fas fa-clock"></i>
                    <span>Slot Waktu</span>
                </a>
                <a href="/admin/mata_kuliah" class="menu-item">
                    <i class="fas fa-book"></i>
                    <span>Matakuliah</span>
                </a>
                <a href="/admin/kelas" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Kelas</span>
                </a>
                <a href="/admin/pengguna" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
                <a href="/admin/laporan" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistik</span>
                </a>
                <a href="/admin/pengaturan" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header - Dipertahankan dari kode kedua -->
            <div class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari barang, peminjam, atau lainnya...">
                </div>
                
                <div class="user-actions">
                    <div class="notification-btn">
                        <i class="fas fa-bell"></i>
                    </div>
                    
                    <div class="theme-toggle" id="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </div>
                    
                    <div class="user-profile">
                        <div class="user-avatar">A</div>
                        <div>
                            <div>Admin Lab</div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">Teknologi Informasi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback Page - Konten asli dipertahankan -->
            <div class="dashboard-title">
                <h1>Manajemen Feedback</h1>
                <p>Kelola feedback dari pengguna Lab Teknologi Informasi</p>
            </div>

            <!-- Feedback Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">5</div>
                            <div class="stat-label">Total Feedback</div>
                        </div>
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">4.2</div>
                            <div class="stat-label">Rating Rata-rata</div>
                        </div>
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">4</div>
                            <div class="stat-label">Dipublikasikan</div>
                        </div>
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">1</div>
                            <div class="stat-label">Draft</div>
                        </div>
                        <div class="stat-icon bg-danger">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="header" style="margin-top:20px; margin-bottom:10px;">
                <div class="search-bar" style="width: 300px;">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari feedback...">
                </div>
                <select style="padding: 8px 12px; border-radius: 6px; border: 1px solid var(--border-light); background: var(--bg-card); color: var(--text-dark);">
                    <option>Semua Status</option>
                    <option>Dipublikasikan</option>
                    <option>Draft</option>
                </select>
                <button class="btn btn-primary" style="padding:8px 15px;">
                    <i class="fas fa-download"></i> Ekspor
                </button>
            </div>

            <!-- Daftar Feedback -->
            <div class="table-container">
                <div class="section-header">
                    <div class="section-title">Daftar Feedback</div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Feedback</th>
                            <th>Peminjam</th>
                            <th>Komentar</th>
                            <th>Barang</th>
                            <th>Rating</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedback as $item)
                        <tr>
                            <td>FB{{ str_pad($item->id_feedback, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $item->peminjaman->nama ?? '-' }}</td>
                            <td>{{ $item->komentar ?? '-' }}</td> <!-- ambil atribut komentar -->
                            <td>{{ $item->peminjaman->barang->nama_barang ?? '-' }}</td>
                            <td>⭐ {{ $item->rating }}</td>
                          
                            <td>{{ \Carbon\Carbon::parse($item->tgl_feedback)->format('d M Y') }}</td>
                            <td>
                                <span class="status {{ $item->status == 'Dipublikasikan' ? 'status-available' : 'status-pending' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="javascript:void(0)" 
                                   onclick="openEditModal('{{ $item->id_feedback }}', `{{ addslashes($item->komentar) }}`, '{{ $item->rating }}', '{{ $item->status }}')">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('feedback.destroy', $item->id_feedback) }}" method="POST" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" style="border:none;background:none;color:red;" onclick="return confirm('Yakin mau hapus feedback ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Edit Feedback -->
            <div id="editModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Edit Feedback</h2>
                        <span class="close-btn" onclick="closeEditModal()">&times;</span>
                    </div>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Komentar *</label>
                            <textarea name="komentar" id="editKomentar" class="form-control" maxlength="500" required></textarea>
                            <div class="char-count">
                                <span id="editCharCount">0</span>/500 karakter
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Rating *</label>
                            <select name="rating" id="editRating" class="form-control" required>
                                <option value="1">1 ★</option>
                                <option value="2">2 ★★</option>
                                <option value="3">3 ★★★</option>
                                <option value="4">4 ★★★★</option>
                                <option value="5">5 ★★★★★</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status Publikasi</label>
                            <div class="status-radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="status" value="Dipublikasikan" id="statusPublished">
                                    <span class="radio-custom"></span>
                                    Dipublikasikan
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="status" value="Draft" id="statusDraft">
                                    <span class="radio-custom"></span>
                                    Draft
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <script>
        // Theme Toggle
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

        // Modal Functions
        function openEditModal(id, komentar, rating, status) {
            console.log('Data received:', {id, komentar, rating, status});
            
            // Set form action dengan URL yang benar
            document.getElementById('editForm').action = "/admin/feedback/" + id;
            
            // Isi form fields
            document.getElementById('editKomentar').value = komentar;
            document.getElementById('editRating').value = rating;
            document.getElementById('editCharCount').textContent = komentar.length;

            // Set status radio button
            document.getElementById('statusPublished').checked = false;
            document.getElementById('statusDraft').checked = false;
            
            if (status === "Dipublikasikan") {
                document.getElementById('statusPublished').checked = true;
            } else {
                document.getElementById('statusDraft').checked = true;
            }

            // Tampilkan modal
            document.getElementById('editModal').style.display = "flex";
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = "none";
        }

        // Character count for modal
        document.addEventListener('DOMContentLoaded', function() {
            const editKomentar = document.getElementById('editKomentar');
            const editCharCount = document.getElementById('editCharCount');
            
            if (editKomentar && editCharCount) {
                editKomentar.addEventListener('input', function() {
                    editCharCount.textContent = this.value.length;
                });
            }

            // Terapkan dark mode jika sebelumnya diaktifkan
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }
        });
    </script>
</body>
</html>