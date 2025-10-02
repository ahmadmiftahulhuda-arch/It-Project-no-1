<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TI - Tambah Proyektor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* SAMA PERSIS DENGAN CSS DI INDEX DI ATAS */
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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

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
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: 1px solid var(--border-light);
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
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-light);
            border-radius: 30px;
            outline: none;
            background-color: var(--bg-light);
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
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
        }

        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
            border-radius: 4px;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .form-container {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .form-control {
            padding: 10px;
            border: 1px solid var(--border-light);
            border-radius: 4px;
            width: 100%;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        .text-danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
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
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fas fa-hand-holding"></i>
                <span>Peminjaman</span>
            </a>
            <a href="/admin/pengembalian" class="menu-item active">
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
            <a href="/admin/matakuliah" class="menu-item">
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
        <!-- Header -->
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari...">
            </div>

            <div class="user-actions">
                <div class="user-profile">
                    <div class="user-avatar">A</div>
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
                <h1>Tambah Proyektor Baru</h1>
                <p>Tambahkan data proyektor baru ke sistem</p>
            </div>
            <div>
                <a href="{{ route('projectors.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="form-container">
            <form action="{{ route('projectors.store') }}" method="POST">
                @csrf
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label for="kode_proyektor" class="form-label">Kode Proyektor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kode_proyektor" name="kode_proyektor" 
                               value="{{ old('kode_proyektor') }}" placeholder="PROJ-001" required>
                        @error('kode_proyektor')
                            <div style="color: #dc3545; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="merk" name="merk" 
                               value="{{ old('merk') }}" placeholder="Epson" required>
                        @error('merk')
                            <div style="color: #dc3545; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="model" class="form-label">Model <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="model" name="model" 
                               value="{{ old('model') }}" placeholder="EB-X06" required>
                        @error('model')
                            <div style="color: #dc3545; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @error('status')
                            <div style="color: #dc3545; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" 
                              rows="3" placeholder="Keterangan tambahan...">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div style="color: #dc3545; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Proyektor
                    </button>
                    <a href="{{ route('projectors.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Error Message -->
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-top: 20px;">
                <i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan dalam input data.
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>