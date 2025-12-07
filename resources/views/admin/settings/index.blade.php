<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TI - Pengaturan Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            --sidebar-width: 250px;
            --text-light: #6c757d;
            --text-dark: #495057;
            --bg-light: #f5f8fa;
            --bg-card: #ffffff;
            --border-light: #e9ecef;
        }

        /* Dark Mode Variables */
        .dark-mode {
            --primary: #4a6fa5;
            --secondary: #5d7ba6;
            --light: #1a1d23;
            --dark: #f0f0f0;
            --bg-light: #121212;
            --bg-card: #1e1e1e;
            --text-dark: #e0e0e0;
            --text-light: #a0a0a0;
            --border-light: #333;
            --gray: #8b8b8b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Sidebar Styles - SAMA PERSIS */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .dark-mode .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
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

        .menu-section {
            padding: 0 15px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 600;
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
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
            flex-shrink: 0;
        }

        .menu-item span {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Dropdown Menu Styles */
        .dropdown-custom {
            margin-bottom: 5px;
        }

        .dropdown-toggle-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            cursor: pointer;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            font-weight: 600;
        }

        .dropdown-toggle-custom:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .dropdown-toggle-custom i:last-child {
            transition: transform 0.3s;
            margin-left: auto;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .dropdown-toggle-custom[aria-expanded="true"] {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid white;
        }

        .dropdown-toggle-custom[aria-expanded="true"] i:last-child {
            transform: rotate(180deg);
        }

        .dropdown-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .dropdown-items.show {
            max-height: 500px;
        }

        .dropdown-item {
            padding: 10px 20px 10px 40px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            position: relative;
        }

        .dropdown-item:hover,
        .dropdown-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        /* Header - SAMA PERSIS DENGAN REFERENSI */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid var(--border-light);
        }

        .dark-mode .header {
            background: var(--bg-card);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            z-index: 2;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-light);
            border-radius: 30px;
            outline: none;
            transition: all 0.3s;
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .search-bar input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .dark-mode .search-bar input {
            background-color: #2a2a2a;
            border-color: var(--border-light);
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-btn,
        .theme-toggle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-dark);
            border: none;
        }

        .notification-btn:hover,
        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .dark-mode .notification-btn,
        .dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        .dark-mode .notification-btn:hover,
        .dark-mode .theme-toggle:hover {
            background: #3a3a3a;
            color: var(--primary);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Page Title - SAMA PERSIS DENGAN REFERENSI */
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding: 0 5px;
        }

        .page-title h1 {
            color: var(--dark);
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .page-title p {
            color: var(--text-light);
            margin: 0;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(59, 89, 152, 0.3);
            color: white;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-success {
            background: var(--success);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(76, 175, 80, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-success:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
            color: white;
        }

        /* Settings Container */
        .settings-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 25px;
        }

        /* Settings Sidebar */
        .settings-sidebar {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-light);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .dark-mode .settings-sidebar {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
        }

        .settings-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .settings-nav-item {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            color: var(--text-dark);
            border: 1px solid transparent;
        }

        .settings-nav-item:hover {
            background-color: rgba(59, 89, 152, 0.1);
            color: var(--primary);
            border-color: rgba(59, 89, 152, 0.2);
        }

        .settings-nav-item.active {
            background-color: rgba(59, 89, 152, 0.15);
            color: var(--primary);
            font-weight: 600;
            border-color: rgba(59, 89, 152, 0.3);
        }

        .settings-nav-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }

        /* Settings Content */
        .settings-content {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-light);
        }

        .dark-mode .settings-content {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
        }

        .settings-panel {
            display: none;
        }

        .settings-panel.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Settings Section */
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
            border-bottom: 2px solid var(--border-light);
            color: var(--dark);
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-group .form-control {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid var(--border-light);
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-group .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
            outline: none;
        }

        .dark-mode .form-group .form-control {
            background-color: #2a2a2a;
            border-color: var(--border-light);
        }

        /* Toggle Switch */
        .toggle-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-light);
        }

        .toggle-container:last-child {
            border-bottom: none;
        }

        .toggle-label {
            flex: 1;
        }

        .toggle-label span:first-child {
            display: block;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .toggle-label span:last-child {
            display: block;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
            margin-left: 15px;
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

        /* Form Row */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Danger Zone */
        .danger-zone {
            border: 2px solid var(--danger);
            border-radius: 10px;
            padding: 25px;
            background-color: rgba(244, 67, 54, 0.05);
            margin-top: 30px;
        }

        .dark-mode .danger-zone {
            background-color: rgba(244, 67, 54, 0.1);
        }

        .danger-zone h4 {
            color: var(--danger);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Alert Styles */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .dark-mode .alert-success {
            background-color: #1b5e20;
            color: #e8f5e8;
            border-color: #2e7d32;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .dark-mode .alert-danger {
            background-color: #c62828;
            color: #ffebee;
            border-color: #b71c1c;
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-block;
        }

        .badge-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .dark-mode .badge-success {
            background: #1b5e20;
            color: #a5d6a7;
        }

        .badge-warning {
            background: #fff8e1;
            color: #ff8f00;
        }

        .dark-mode .badge-warning {
            background: #5d4037;
            color: #ffcc80;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .settings-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .settings-sidebar {
                position: static;
                top: auto;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h2,
            .menu-item span,
            .dropdown-toggle-custom span {
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
                margin-left: 70px;
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .search-bar {
                width: 100%;
            }

            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-title h1 {
                font-size: 1.5rem;
            }

            .settings-content {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 10px;
            }

            .settings-content {
                padding: 15px;
            }

            .toggle-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .toggle-switch {
                align-self: flex-start;
                margin-left: 0;
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .settings-sidebar,
        .settings-content,
        .form-control,
        .btn,
        .alert {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Sidebar - SAMA PERSIS DENGAN REFERENSI -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h2>Admin TI</h2>
        </div>

        <div class="sidebar-menu">
            <!-- Menu Utama -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menuUtama" aria-expanded="false" aria-controls="menuUtama">
                    <span>Menu Utama</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="menuUtama">
                    <a href="/admin/dashboard" class="dropdown-item">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Peminjaman -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#peminjamanMenu" aria-expanded="false" aria-controls="peminjamanMenu">
                    <span>Manajemen Peminjaman</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="peminjamanMenu">
                    <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item">
                        <i class="fas fa-hand-holding"></i>
                        <span>Peminjaman</span>
                    </a>
                    <a href="/admin/pengembalian" class="dropdown-item">
                        <i class="fas fa-undo"></i>
                        <span>Pengembalian</span>
                    </a>
                    <a href="/admin/riwayat" class="dropdown-item">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Peminjaman</span>
                    </a>
                    <a href="/admin/feedback" class="dropdown-item">
                        <i class="fas fa-comment"></i>
                        <span>Feedback</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Aset -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#asetMenu" aria-expanded="false" aria-controls="asetMenu">
                    <span>Manajemen Aset</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="asetMenu">
                    <a href="{{ route('projectors.index') }}" class="dropdown-item">
                        <i class="fas fa-video"></i>
                        <span>Proyektor</span>
                    </a>
                    <a href="/admin/ruangan" class="dropdown-item">
                        <i class="fas fa-door-open"></i>
                        <span>Ruangan</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Akademik -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#akademikMenu" aria-expanded="false" aria-controls="akademikMenu">
                    <span>Manajemen Akademik</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="akademikMenu">
                    <a href="/admin/jadwal-perkuliahan" class="dropdown-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Perkuliahan</span>
                    </a>
                    <a href="/admin/slotwaktu" class="dropdown-item">
                        <i class="fas fa-clock"></i>
                        <span>Slot Waktu</span>
                    </a>
                    <a href="/admin/mata_kuliah" class="dropdown-item">
                        <i class="fas fa-book"></i>
                        <span>Matakuliah</span>
                    </a>
                    <a href="/admin/kelas" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Kelas</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Pengguna -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#penggunaMenu" aria-expanded="false" aria-controls="penggunaMenu">
                    <span>Manajemen Pengguna</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="penggunaMenu">
                    <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                        <i class="fas fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                </div>
            </div>

            <!-- Laporan & Pengaturan - AKTIF -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#laporanMenu" aria-expanded="true" aria-controls="laporanMenu">
                    <span>Laporan & Pengaturan</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse show" id="laporanMenu">
                    <a href="/admin/laporan" class="dropdown-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistik</span>
                    </a>
                    <a href="/admin/pengaturan" class="dropdown-item active">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan Sistem</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header - SAMA PERSIS DENGAN REFERENSI -->
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari pengaturan..." id="searchSettings">
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

        <!-- Page Title - SAMA PERSIS DENGAN REFERENSI -->
        <div class="page-title">
            <div>
                <h1>Pengaturan Sistem</h1>
                <p>Kelola pengaturan sistem, preferensi, dan konfigurasi lainnya</p>
            </div>
            <div class="page-title-actions">
                <button type="button" class="btn btn-primary" onclick="saveAllSettings()">
                    <i class="fas fa-save"></i> Simpan Semua
                </button>
            </div>
        </div>

        <!-- Settings Container -->
        <div class="settings-container">
            <!-- Settings Sidebar -->
            <div class="settings-sidebar">
                <ul class="settings-nav">
                    <li class="settings-nav-item active" data-target="profile">
                        <i class="fas fa-user"></i> Profil Akun
                    </li>
                    <li class="settings-nav-item" data-target="system">
                        <i class="fas fa-cog"></i> Pengaturan Sistem
                    </li>
                    <li class="settings-nav-item" data-target="security">
                        <i class="fas fa-shield-alt"></i> Keamanan
                    </li>
                    <li class="settings-nav-item" data-target="notifications">
                        <i class="fas fa-bell"></i> Notifikasi
                    </li>
                    <li class="settings-nav-item" data-target="appearance">
                        <i class="fas fa-palette"></i> Tampilan
                    </li>
                </ul>
            </div>

            <!-- Settings Content -->
            <div class="settings-content">
                <!-- Profile Settings Panel -->
                <div id="profile-settings" class="settings-panel active">
                    @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.settings.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="settings-section">
                            <h3>Informasi Profil</h3>
                            <div class="form-group">
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan Profil
                            </button>
                        </div>
                    </form>
                </div>

                <!-- System Settings Panel -->
                <div id="system-settings" class="settings-panel">
                    <div class="settings-section">
                        <h3>Pengaturan Umum Sistem</h3>
                        
                        <div class="form-group">
                            <label for="system-name">Nama Sistem <span class="text-danger">*</span></label>
                            <input type="text" id="system-name" class="form-control" value="Sistem Manajemen Lab TIK" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="max-loan">Maksimal Peminjaman (hari)</label>
                                <input type="number" id="max-loan" class="form-control" value="7" min="1" max="30">
                            </div>
                            <div class="form-group">
                                <label for="max-items">Maksimal Item per Peminjaman</label>
                                <input type="number" id="max-items" class="form-control" value="5" min="1" max="20">
                            </div>
                        </div>
                        
                        <div class="toggle-container">
                            <div class="toggle-label">
                                <span>Maintenance Mode</span>
                                <span>Nonaktifkan akses pengguna ke sistem</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="maintenance-mode">
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
                                <input type="checkbox" id="auto-approval" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-container">
                            <div class="toggle-label">
                                <span>Notifikasi Denda</span>
                                <span>Kirim notifikasi ketika peminjaman terlambat</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="late-notification" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label for="fine-amount">Jumlah Denda per Hari (Rp)</label>
                            <input type="number" id="fine-amount" class="form-control" value="5000" min="0">
                        </div>
                    </div>
                </div>

                <!-- Security Settings Panel -->
                <div id="security-settings" class="settings-panel">
                    <div class="settings-section">
                        <h3>Keamanan Akun</h3>
                        
                        <div class="form-group">
                            <label for="current-password">Password Saat Ini <span class="text-danger">*</span></label>
                            <input type="password" id="current-password" class="form-control" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="new-password">Password Baru <span class="text-danger">*</span></label>
                                <input type="password" id="new-password" class="form-control" required>
                                <small class="text-muted">Minimal 8 karakter</small>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" id="confirm-password" class="form-control" required>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary">
                            <i class="fas fa-key"></i> Perbarui Password
                        </button>
                    </div>
                    
                    <div class="settings-section">
                        <h3>Sesi Aktif</h3>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Anda sedang login dari perangkat ini
                        </div>
                    </div>
                </div>

                <!-- Notifications Settings Panel -->
                <div id="notifications-settings" class="settings-panel">
                    <div class="settings-section">
                        <h3>Pengaturan Notifikasi</h3>
                        
                        <div class="toggle-container">
                            <div class="toggle-label">
                                <span>Notifikasi Email</span>
                                <span>Terima notifikasi melalui email</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="email-notifications" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-container">
                            <div class="toggle-label">
                                <span>Notifikasi Peminjaman Baru</span>
                                <span>Dapatkan pemberitahuan untuk peminjaman baru</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="new-loan-notifications" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="toggle-container">
                            <div class="toggle-label">
                                <span>Notifikasi Pengembalian</span>
                                <span>Dapatkan pemberitahuan saat item dikembalikan</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="return-notifications" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Appearance Settings Panel -->
                <div id="appearance-settings" class="settings-panel">
                    <div class="settings-section">
                        <h3>Preferensi Tampilan</h3>
                        
                        <div class="toggle-container">
                            <div class="toggle-label">
                                <span>Mode Gelap</span>
                                <span>Aktifkan tema gelap untuk aplikasi</span>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="dark-mode-toggle-pref">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label for="theme-color">Warna Tema</label>
                            <select id="theme-color" class="form-control">
                                <option value="blue" selected>Biru (Default)</option>
                                <option value="green">Hijau</option>
                                <option value="purple">Ungu</option>
                                <option value="red">Merah</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="font-size">Ukuran Font</label>
                            <select id="font-size" class="form-control">
                                <option value="small">Kecil</option>
                                <option value="medium" selected>Sedang</option>
                                <option value="large">Besar</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="danger-zone">
                        <h4>
                            <i class="fas fa-exclamation-triangle"></i>
                            Zona Berbahaya
                        </h4>
                        <p>Reset semua pengaturan ke nilai default. Tindakan ini tidak dapat dibatalkan.</p>
                        <button class="btn btn-outline" onclick="confirmResetSettings()">
                            <i class="fas fa-undo"></i> Reset Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme toggle - SAMA PERSIS DENGAN REFERENSI
            const themeToggle = document.getElementById('theme-toggle');
            const darkModeTogglePref = document.getElementById('dark-mode-toggle-pref');

            const applyTheme = (theme) => {
                if (theme === 'enabled') {
                    document.body.classList.add('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                    if(darkModeTogglePref) darkModeTogglePref.checked = true;
                } else {
                    document.body.classList.remove('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                    if(darkModeTogglePref) darkModeTogglePref.checked = false;
                }
            };

            const toggleTheme = () => {
                const currentTheme = localStorage.getItem('darkMode') === 'enabled' ? 'disabled' : 'enabled';
                localStorage.setItem('darkMode', currentTheme);
                applyTheme(currentTheme);
            };

            themeToggle.addEventListener('click', toggleTheme);
            if(darkModeTogglePref) darkModeTogglePref.addEventListener('change', toggleTheme);
            
            // Load saved theme preference
            applyTheme(localStorage.getItem('darkMode') || 'disabled');

            // Settings navigation - KOREKSI DI SINI
            const navItems = document.querySelectorAll('.settings-nav-item');
            const panels = document.querySelectorAll('.settings-panel');
            
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    
                    // Update active nav item
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show corresponding panel
                    panels.forEach(p => {
                        p.classList.remove('active');
                    });
                    
                    const targetPanel = document.getElementById(`${target}-settings`);
                    if (targetPanel) {
                        targetPanel.classList.add('active');
                    }
                });
            });

            // Dropdown toggle - SAMA PERSIS DENGAN REFERENSI
            document.querySelectorAll('.dropdown-toggle-custom').forEach(item => {
                item.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-bs-target');
                    const target = document.querySelector(targetId);
                    const isExpanded = target.classList.contains('show');
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-items').forEach(dropdown => {
                        if (dropdown !== target) {
                            dropdown.classList.remove('show');
                        }
                    });
                    
                    // Toggle current dropdown
                    if (isExpanded) {
                        target.classList.remove('show');
                        this.setAttribute('aria-expanded', 'false');
                        this.querySelector('i:last-child').style.transform = 'rotate(0deg)';
                    } else {
                        target.classList.add('show');
                        this.setAttribute('aria-expanded', 'true');
                        this.querySelector('i:last-child').style.transform = 'rotate(180deg)';
                    }
                });
            });

            // Search settings
            const searchInput = document.getElementById('searchSettings');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                // Filter navigation items
                navItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Save all settings
        function saveAllSettings() {
            // Collect all settings data
            const settings = {
                systemName: document.getElementById('system-name').value,
                maxLoanDays: document.getElementById('max-loan').value,
                maxItems: document.getElementById('max-items').value,
                fineAmount: document.getElementById('fine-amount').value,
                maintenanceMode: document.getElementById('maintenance-mode').checked,
                autoApproval: document.getElementById('auto-approval').checked,
                lateNotification: document.getElementById('late-notification').checked,
                emailNotifications: document.getElementById('email-notifications').checked,
                newLoanNotifications: document.getElementById('new-loan-notifications').checked,
                returnNotifications: document.getElementById('return-notifications').checked,
                themeColor: document.getElementById('theme-color').value,
                fontSize: document.getElementById('font-size').value
            };

            // Here you would typically send this to your backend
            console.log('Saving settings:', settings);
            
            // Show success message
            alert('Pengaturan berhasil disimpan!');
            
            // You can add actual AJAX call here
            // fetch('/api/settings/save', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: JSON.stringify(settings)
            // })
            // .then(response => response.json())
            // .then(data => {
            //     alert('Pengaturan berhasil disimpan!');
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            //     alert('Gagal menyimpan pengaturan');
            // });
        }

        // Confirm reset settings
        function confirmResetSettings() {
            if (confirm('Apakah Anda yakin ingin mereset semua pengaturan ke default? Tindakan ini tidak dapat dibatalkan.')) {
                // Reset all form elements to default
                document.getElementById('system-name').value = 'Sistem Manajemen Lab TIK';
                document.getElementById('max-loan').value = '7';
                document.getElementById('max-items').value = '5';
                document.getElementById('fine-amount').value = '5000';
                document.getElementById('maintenance-mode').checked = false;
                document.getElementById('auto-approval').checked = true;
                document.getElementById('late-notification').checked = true;
                document.getElementById('email-notifications').checked = true;
                document.getElementById('new-loan-notifications').checked = true;
                document.getElementById('return-notifications').checked = true;
                document.getElementById('theme-color').value = 'blue';
                document.getElementById('font-size').value = 'medium';
                
                alert('Semua pengaturan telah direset ke nilai default.');
            }
        }
    </script>
</body>
</html>