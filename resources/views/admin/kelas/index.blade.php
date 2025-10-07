<!DOCTYPE html>
<html>
<head>
    <title>Data Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        /* CARD STATS STYLES */
        .stat-card {
            background-color: var(--bg-card);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid var(--border-light);
        }

        .dark-mode .stat-card {
            background-color: var(--bg-card);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-color: var(--border-light);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.bg-primary-light { background-color: var(--primary); }
        .stat-icon.bg-success-light { background-color: var(--success); }
        .stat-icon.bg-info-light { background-color: var(--info); }
        
        .dark-mode .stat-icon.bg-primary-light { background-color: #3f60a8; }
        .dark-mode .stat-icon.bg-success-light { background-color: #388e3c; }
        .dark-mode .stat-icon.bg-info-light { background-color: #1565c0; }


        .stat-title {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }

        .dark-mode .stat-value {
            color: var(--text-dark);
        }
        /* END CARD STATS STYLES */

        /* CARD KELAS STYLES (NEW) */
        .card-kelas {
            background-color: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .card-kelas:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .dark-mode .card-kelas {
            background-color: var(--bg-card);
            border-color: var(--border-light);
        }

        .card-kelas .card-footer {
            background-color: var(--bg-light); 
            border-top: 1px solid var(--border-light);
            padding: 10px 15px;
            border-radius: 0 0 10px 10px;
            display: flex;
            gap: 8px; /* Menjaga jarak antar tombol */
            flex-wrap: nowrap;
        }

        .dark-mode .card-kelas .card-footer {
            background-color: #2a2a2a;
            border-color: var(--border-light);
        }

        .card-kelas .card-title {
            color: var(--dark) !important;
            transition: color 0.3s ease;
        }

        .dark-mode .card-kelas .card-title {
            color: var(--text-dark) !important;
        }

        .kelas-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            background-color: var(--primary);
        }
        
        /* Memastikan tombol di card footer memiliki lebar yang sama */
        .card-footer .btn {
            flex-grow: 1;
            text-align: center;
            padding: 6px 10px; /* Sedikit lebih kecil agar muat */
            font-size: 0.8rem;
        }
        /* END CARD KELAS STYLES */


        /* Sidebar Styles */
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

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        /* Header */
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

        /* Page Title */
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            margin-top: 0; 
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

        /* Action Buttons */
        .btn-warning-custom {
            background: #ff9800;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center; /* Tambah: agar icon dan teks center */
            gap: 5px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-warning-custom:hover {
            background: #f57c00;
            transform: translateY(-1px);
            color: white;
            box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);
        }

        .btn-danger-custom {
            background: #f44336;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center; /* Tambah: agar icon dan teks center */
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-danger-custom:hover {
            background: #d32f2f;
            transform: translateY(-1px);
            color: white;
            box-shadow: 0 2px 5px rgba(244, 67, 54, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
            background: var(--bg-card);
            border-radius: 10px;
            border: 2px dashed var(--border-light);
            margin-top: 15px;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--text-light);
            opacity: 0.7;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h2,
            .menu-item span {
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
            /* Menyesuaikan grid agar menjadi 1 kolom di HP */
            .col-xl-3.col-lg-4.col-md-6 {
                width: 100%;
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .stat-card,
        .card-kelas,
        .card-kelas .card-footer,
        .search-bar input {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h2>Sarpras Politala</h2>
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
            <a href="/admin/feedback" class="menu-item">
                <i class="fas fa-comment"></i>
                <span>Feedback</span>
            </a>
            <a href="/admin/projectors" class="menu-item">
                <i class="fas fa-video"></i>
                <span>Proyektor</span>
            </a>
            <a href="/admin/jadwal-perkuliahan" class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Jadwal Perkuliahan</span>
            </a>
            <a href="/admin/ruangan" class="menu-item">
                <i class="fas fa-door-open"></i>
                <span>Ruangan</span>
            </a>
            <a href="http://127.0.0.1:8000/admin/slotwaktu" class="menu-item">
                <i class="fas fa-clock"></i>
                <span>Slot Waktu</span>
            </a>
            <a href="http://127.0.0.1:8000/admin/mata_kuliah" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Matakuliah</span>
            </a>
            <a href="/admin/kelas" class="menu-item active">
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

    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <form action="{{ route('admin.kelas.index') }}" method="GET" class="flex-grow">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari kelas..." id="globalSearch" name="search" value="{{ request('search') ?? '' }}">
                </form>
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

        <div class="page-title">
            <div>
                <h1>Manajemen Kelas</h1>
                <p>Platform terpusat untuk mengelola data kelas secara efisien.</p>
            </div>
            <div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
                    <i class="fas fa-plus"></i> Tambah Baru
                </button>
            </div>
        </div>
        <div class="row mb-4">
            {{-- Card Total Kelas --}}
            <div class="col-md-4 mb-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-title">Total Kelas</div>
                        <div class="stat-value">{{ $totalKelas ?? '0' }}</div> 
                    </div>
                    <div class="stat-icon bg-primary-light">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
            </div>

            {{-- Card Total Mahasiswa --}}
            <div class="col-md-4 mb-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-title">Total Mahasiswa</div>
                        <div class="stat-value">{{ $totalMahasiswa ?? '0' }}</div> 
                    </div>
                    <div class="stat-icon bg-success-light">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>

            {{-- Card Rata-rata per Kelas --}}
            <div class="col-md-4 mb-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-title">Rata-rata per Kelas</div>
                        <div class="stat-value">{{ $rataRata ?? '0' }}</div> 
                    </div>
                    <div class="stat-icon bg-info-light">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
            </div>
        </div>
        <h3 style="margin-bottom: 15px; color: var(--dark);">Daftar Seluruh Kelas</h3>
        <div class="row">
            @forelse($kelas as $k)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card-kelas card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title fw-bold" style="font-size: 1.5rem;">
                                    {{ $k->nama_kelas }}
                                </h5>
                                <p class="card-text text-muted" style="font-size: 0.9rem;">
                                    {{ $k->mahasiswa_count }} Mahasiswa
                                </p>
                            </div>
                            <div class="kelas-icon bg-primary-light text-white">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.kelas.show', $k->id) }}" class="btn btn-info btn-sm">
                            Detail
                        </a>
                        <button class="btn btn-warning-custom btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKelas{{ $k->id }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" style="display: inline;" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-custom btn-sm w-100" onclick="return confirm('Hapus kelas {{ $k->nama_kelas }}?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-users"></i><br>
                    Belum ada data kelas
                </div>
            </div>
            @endforelse
        </div>
        </div>

    <div class="modal fade" id="modalTambahKelas" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.kelas.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i> Tambah Kelas Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kelas_tambah" class="form-label">Nama Kelas</label>
                            <input type="text" 
                                id="nama_kelas_tambah" 
                                name="nama_kelas" 
                                value="{{ old('nama_kelas') }}" 
                                class="form-control @error('nama_kelas') is-invalid @enderror" 
                                placeholder="Contoh: 3A" 
                                required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-1"></i> Tambah Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($kelas as $k)
    <div class="modal fade" id="modalEditKelas{{ $k->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.kelas.update', $k->id) }}">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kelas_{{ $k->id }}" class="form-label">Nama Kelas</label>
                            <input type="text" 
                                id="nama_kelas_{{ $k->id }}" 
                                name="nama_kelas" 
                                value="{{ old('nama_kelas', $k->nama_kelas) }}" 
                                class="form-control @error('nama_kelas') is-invalid @enderror" 
                                placeholder="Contoh: 3A" 
                                required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Dark Mode
        const themeToggle = document.getElementById('theme-toggle');
        
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('darkMode', 'enabled');
            } else {
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        themeToggle.addEventListener('click', toggleDarkMode);

        // Load saved theme preference
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }
        });
    </script>

</body>
</html>