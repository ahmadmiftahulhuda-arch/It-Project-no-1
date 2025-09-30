<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Lab TIK</title>
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

        /* Settings Section */
        .settings-container {
            display: grid;
            grid-template-columns: 1fr 3fr;
            gap: 20px;
        }

        .settings-sidebar {
            background-color: var(--card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }

        .settings-nav {
            list-style: none;
        }

        .settings-nav-item {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .settings-nav-item:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .settings-nav-item.active {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--primary);
            font-weight: 500;
        }

        .settings-nav-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .settings-content {
            background-color: var(--card);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .settings-section {
            margin-bottom: 30px;
        }

        .settings-section:last-child {
            margin-bottom: 0;
        }

        .settings-section h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
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
            border-radius: 8px;
            border: 1px solid var(--border);
            background-color: var(--background);
            color: var(--text);
            transition: all 0.3s;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }

        .toggle-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .toggle-container:last-child {
            border-bottom: none;
        }

        .toggle-label {
            display: flex;
            flex-direction: column;
        }

        .toggle-label span:first-child {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .toggle-label span:last-child {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--background);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 2px solid var(--border);
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .danger-zone {
            border: 1px solid var(--accent);
            border-radius: 8px;
            padding: 20px;
            background-color: rgba(231, 76, 60, 0.05);
        }

        .danger-zone h4 {
            color: var(--accent);
            margin-bottom: 15px;
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
            
            .settings-container {
                grid-template-columns: 1fr;
            }
            
            .settings-sidebar {
                display: none;
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
            
            .form-row {
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
                <a href="/admin/pengembalian" class="menu-item">
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
                <a href="/admin/pengaturan" class="menu-item active">
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
                    <input type="text" placeholder="Cari pengaturan...">
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
                    <h1>Pengaturan Sistem</h1>
                    <p>Kelola pengaturan akun dan preferensi sistem</p>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-outline">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="settings-container">
                <!-- Settings Sidebar -->
                <div class="settings-sidebar">
                    <ul class="settings-nav">
                        <li class="settings-nav-item active" data-target="profile">
                            <i class="fas fa-user"></i> Profil Akun
                        </li>
                        <li class="settings-nav-item" data-target="preferences">
                            <i class="fas fa-sliders-h"></i> Preferensi
                        </li>
                        <li class="settings-nav-item" data-target="notifications">
                            <i class="fas fa-bell"></i> Notifikasi
                        </li>
                        <li class="settings-nav-item" data-target="security">
                            <i class="fas fa-shield-alt"></i> Keamanan
                        </li>
                        <li class="settings-nav-item" data-target="system">
                            <i class="fas fa-cog"></i> Pengaturan Sistem
                        </li>
                        <li class="settings-nav-item" data-target="backup">
                            <i class="fas fa-database"></i> Backup & Pemulihan
                        </li>
                    </ul>
                </div>

                <!-- Settings Panels -->
                <div class="settings-content">
                    <!-- Profile Settings -->
                    <div id="profile-settings" class="settings-panel">
                        <div class="settings-section">
                            <h3>Informasi Profil</h3>
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <i class="fas fa-user" style="font-size: 2.5rem; color: #ccc;"></i>
                                </div>
                                <div class="avatar-actions">
                                    <button class="btn btn-outline">
                                        <i class="fas fa-upload"></i> Unggah Foto
                                    </button>
                                    <button class="btn btn-outline">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName">Nama Depan</label>
                                    <input type="text" id="firstName" value="Admin">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Nama Belakang</label>
                                    <input type="text" id="lastName" value="Lab">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" value="admin.lab@tik.university.edu">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="tel" id="phone" value="+62 812 3456 7890">
                            </div>
                            
                            <div class="form-group">
                                <label for="department">Jurusan</label>
                                <select id="department">
                                    <option value="tik" selected>Teknologi Informasi dan Komputer</option>
                                    <option value="ti">Teknik Informatika</option>
                                    <option value="si">Sistem Informasi</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea id="bio" rows="4">Administrator Laboratorium TIK Universitas</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Preferences Settings -->
                    <div id="preferences-settings" class="settings-panel" style="display: none;">
                        <div class="settings-section">
                            <h3>Tampilan & Bahasa</h3>
                            
                            <div class="form-group">
                                <label for="language">Bahasa</label>
                                <select id="language">
                                    <option value="id" selected>Bahasa Indonesia</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="timezone">Zona Waktu</label>
                                <select id="timezone">
                                    <option value="wib" selected>WIB (UTC+7)</option>
                                    <option value="wita">WITA (UTC+8)</option>
                                    <option value="wit">WIT (UTC+9)</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="date-format">Format Tanggal</label>
                                <select id="date-format">
                                    <option value="dd-mm-yyyy" selected>DD-MM-YYYY</option>
                                    <option value="mm-dd-yyyy">MM-DD-YYYY</option>
                                    <option value="yyyy-mm-dd">YYYY-MM-DD</option>
                                </select>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Mode Gelap</span>
                                    <span>Ubah tampilan menjadi mode gelap</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="dark-mode-toggle">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Compact Mode</span>
                                    <span>Tampilkan lebih banyak konten di layar</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings -->
                    <div id="notifications-settings" class="settings-panel" style="display: none;">
                        <div class="settings-section">
                            <h3>Preferensi Notifikasi</h3>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Notifikasi Email</span>
                                    <span>Aktifkan notifikasi melalui email</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Notifikasi Browser</span>
                                    <span>Tampilkan notifikasi di browser</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Peminjaman Baru</span>
                                    <span>Notifikasi ketika ada peminjaman baru</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Pengembalian Barang</span>
                                    <span>Notifikasi ketika barang dikembalikan</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Barang Rusak</span>
                                    <span>Notifikasi ketika ada laporan kerusakan</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Pengingat Waktu</span>
                                    <span>Notifikasi pengingat waktu peminjaman</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div id="security-settings" class="settings-panel" style="display: none;">
                        <div class="settings-section">
                            <h3>Keamanan Akun</h3>
                            
                            <div class="form-group">
                                <label for="current-password">Password Saat Ini</label>
                                <input type="password" id="current-password">
                            </div>
                            
                            <div class="form-group">
                                <label for="new-password">Password Baru</label>
                                <input type="password" id="new-password">
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm-password">Konfirmasi Password Baru</label>
                                <input type="password" id="confirm-password">
                            </div>
                            
                            <button class="btn btn-primary">
                                <i class="fas fa-key"></i> Perbarui Password
                            </button>
                        </div>
                        
                        <div class="settings-section">
                            <h3>Autentikasi Dua Faktor</h3>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Autentikasi 2FA</span>
                                    <span>Tingkatkan keamanan akun dengan autentikasi dua faktor</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <p style="margin-top: 15px; font-size: 0.9rem; color: var(--text-light);">
                                <i class="fas fa-info-circle"></i> Dengan mengaktifkan 2FA, Anda akan diminta untuk memasukkan kode verifikasi setiap kali login.
                            </p>
                        </div>
                        
                        <div class="settings-section">
                            <h3>Sesi Aktif</h3>
                            <p style="margin-bottom: 15px; color: var(--text-light);">Anda saat ini login perangkat ini. Jika Anda mengenali perangkat lain yang tidak dikenal, segera hapus sesi tersebut.</p>
                            
                            <div style="background-color: var(--background); padding: 15px; border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 500;">Windows 10 • Chrome Browser</div>
                                        <div style="font-size: 0.85rem; color: var(--text-light);">Jakarta, Indonesia • Sekarang</div>
                                    </div>
                                    <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.85rem;">
                                        <i class="fas fa-times"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Settings -->
                    <div id="system-settings" class="settings-panel" style="display: none;">
                        <div class="settings-section">
                            <h3>Pengaturan Umum Sistem</h3>
                            
                            <div class="form-group">
                                <label for="system-name">Nama Sistem</label>
                                <input type="text" id="system-name" value="Sistem Manajemen Lab TIK">
                            </div>
                            
                            <div class="form-group">
                                <label for="max-loan">Maksimal Peminjaman (hari)</label>
                                <input type="number" id="max-loan" value="7" min="1" max="30">
                            </div>
                            
                            <div class="form-group">
                                <label for="max-items">Maksimal Item per Peminjaman</label>
                                <input type="number" id="max-items" value="5" min="1" max="20">
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Maintenance Mode</span>
                                    <span>Nonaktifkan akses pengguna ke sistem</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="settings-section">
                            <h3>Pengaturan Peminjaman</h3>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Persetujuan Otomatis</span>
                                    <span>Izinkan peminjaman disetujui secara otomatis</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Notifikasi Denda</span>
                                    <span>Kirim notifikasi ketika peminjaman terlambat</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <label for="fine-amount">Jumlah Denda per Hari (Rp)</label>
                                <input type="number" id="fine-amount" value="5000" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Backup Settings -->
                    <div id="backup-settings" class="settings-panel" style="display: none;">
                        <div class="settings-section">
                            <h3>Backup Data</h3>
                            
                            <div class="form-group">
                                <label for="backup-frequency">Frekuensi Backup Otomatis</label>
                                <select id="backup-frequency">
                                    <option value="daily">Harian</option>
                                    <option value="weekly" selected>Mingguan</option>
                                    <option value="monthly">Bulanan</option>
                                    <option value="none">Nonaktif</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="backup-time">Waktu Backup</label>
                                <input type="time" id="backup-time" value="02:00">
                            </div>
                            
                            <div class="form-group">
                                <label for="backup-retention">Retensi Backup (hari)</label>
                                <input type="number" id="backup-retention" value="30" min="1" max="365">
                            </div>
                            
                            <div class="form-row">
                                <button class="btn btn-outline">
                                    <i class="fas fa-download"></i> Backup Sekarang
                                </button>
                                <button class="btn btn-outline">
                                    <i class="fas fa-upload"></i> Pulihkan Data
                                </button>
                            </div>
                        </div>
                        
                        <div class="settings-section">
                            <h3>Riwayat Backup</h3>
                            
                            <div style="background-color: var(--background); padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 500;">Backup_2023_09_12.zip</div>
                                        <div style="font-size: 0.85rem; color: var(--text-light);">12 Sep 2023, 02:00 • 45.2 MB</div>
                                    </div>
                                    <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.85rem;">
                                        <i class="fas fa-download"></i> Unduh
                                    </button>
                                </div>
                            </div>
                            
                            <div style="background-color: var(--background); padding: 15px; border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 500;">Backup_2023_09_05.zip</div>
                                        <div style="font-size: 0.85rem; color: var(--text-light);">5 Sep 2023, 02:00 • 44.8 MB</div>
                                    </div>
                                    <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.85rem;">
                                        <i class="fas fa-download"></i> Unduh
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-section danger-zone">
                            <h4>Hapus Semua Data</h4>
                            <p style="margin-bottom: 15px;">Tindakan ini tidak dapat dibatalkan. Semua data sistem akan dihapus permanen.</p>
                            <button class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus Semua Data
                            </button>
                        </div>
                    </div>
                </div>
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

    // Settings navigation
    document.addEventListener('DOMContentLoaded', function() {
        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
        
        // Settings navigation functionality
        const navItems = document.querySelectorAll('.settings-nav-item');
        const panels = document.querySelectorAll('.settings-panel');
        
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                
                // Remove active class from all items
                navItems.forEach(navItem => {
                    navItem.classList.remove('active');
                });
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Hide all panels
                panels.forEach(panel => {
                    panel.style.display = 'none';
                });
                
                // Show target panel
                document.getElementById(`${target}-settings`).style.display = 'block';
            });
        });
        
        // Dark mode toggle in preferences
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        if (localStorage.getItem('darkMode') === 'enabled') {
            darkModeToggle.checked = true;
        }
        
        darkModeToggle.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });
    });
</script>
</body>
</html>