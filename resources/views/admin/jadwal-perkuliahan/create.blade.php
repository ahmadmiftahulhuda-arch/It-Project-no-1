<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Perkuliahan - Admin Lab TI</title>
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
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: 1px solid var(--border-light);
        }

        .dark-mode .header {
            background: var(--bg-card);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

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

        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

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
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(59, 89, 152, 0.3);
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Form Container */
        .table-container {
            background: var(--bg-card);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .dark-mode .table-container {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--border-light);
            background: var(--bg-light);
        }

        .dark-mode .table-header {
            background: #252525;
            border-color: var(--border-light);
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        /* Form Styles */
        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            color: var(--text-dark);
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .dark-mode .form-control, 
        .dark-mode .form-select {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .dark-mode .text-danger {
            color: #f56565 !important;
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
            }

            .header {
                flex-direction: column;
                gap: 15px;
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .table-container,
        .form-control,
        .form-select {
            transition: all 0.3s ease;
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
            <a href="/admin/proyektor" class="menu-item">
                <i class="fas fa-video"></i>
                <span>Proyektor</span>
            </a>
            <a href="/admin/jadwal-perkuliahan" class="menu-item active">
                <i class="fas fa-calendar-alt"></i>
                <span>Jadwal Perkuliahan</span>
            </a>
            <a href="/admin/ruangan" class="menu-item">
                <i class="fas fa-door-open"></i>
                <span>Ruangan</span>
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
            <div></div> <!-- Spacer untuk alignment -->
            <div class="user-actions">
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

        <!-- Page Title -->
        <div class="page-title">
            <div>
                <h1>Tambah Jadwal Perkuliahan</h1>
                <p>Tambahkan jadwal perkuliahan baru</p>
            </div>
            <div>
                <a href="{{ route('jadwal-perkuliahan.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-title">
                    Form Tambah Jadwal
                </div>
            </div>

            <div class="p-4">
                <form action="{{ route('jadwal-perkuliahan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="hari" class="form-label">Hari <span class="text-danger">*</span></label>
                            <select class="form-select" id="hari" name="hari" required>
                                <option value="">Pilih Hari</option>
                                <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            </select>
                            @error('hari')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="waktu" class="form-label">Waktu <span class="text-danger">*</span></label>
                            <select class="form-select" id="waktu" name="waktu" required>
                                <option value="">Pilih Waktu</option>
                                <option value="07:00 - 08:40" {{ old('waktu') == '07:00 - 08:40' ? 'selected' : '' }}>07:00 - 08:40</option>
                                <option value="08:40 - 10:20" {{ old('waktu') == '08:40 - 10:20' ? 'selected' : '' }}>08:40 - 10:20</option>
                                <option value="10:20 - 12:00" {{ old('waktu') == '10:20 - 12:00' ? 'selected' : '' }}>10:20 - 12:00</option>
                                <option value="13:00 - 14:40" {{ old('waktu') == '13:00 - 14:40' ? 'selected' : '' }}>13:00 - 14:40</option>
                                <option value="14:40 - 16:20" {{ old('waktu') == '14:40 - 16:20' ? 'selected' : '' }}>14:40 - 16:20</option>
                                <option value="16:20 - 18:00" {{ old('waktu') == '16:20 - 18:00' ? 'selected' : '' }}>16:20 - 18:00</option>
                            </select>
                            @error('waktu')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kode_matkul" class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kode_matkul" name="kode_matkul" value="{{ old('kode_matkul') }}" required>
                            @error('kode_matkul')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nama_matkul" class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" value="{{ old('nama_matkul') }}" required>
                            @error('nama_matkul')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="dosen" class="form-label">Dosen Pengampu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="dosen" name="dosen" value="{{ old('dosen') }}" required>
                            @error('dosen')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas') }}" required>
                            @error('kelas')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ruangan" class="form-label">Ruangan <span class="text-danger">*</span></label>
                            <select class="form-select" id="ruangan" name="ruangan" required>
                                <option value="">Pilih Ruangan</option>
                                <option value="Lab TIK 1" {{ old('ruangan') == 'Lab TIK 1' ? 'selected' : '' }}>Lab TIK 1</option>
                                <option value="Lab TIK 2" {{ old('ruangan') == 'Lab TIK 2' ? 'selected' : '' }}>Lab TIK 2</option>
                                <option value="Lab TIK 3" {{ old('ruangan') == 'Lab TIK 3' ? 'selected' : '' }}>Lab TIK 3</option>
                                <option value="Lab TIK 4" {{ old('ruangan') == 'Lab TIK 4' ? 'selected' : '' }}>Lab TIK 4</option>
                                <option value="Ruang Teori 1" {{ old('ruangan') == 'Ruang Teori 1' ? 'selected' : '' }}>Ruang Teori 1</option>
                                <option value="Ruang Teori 2" {{ old('ruangan') == 'Ruang Teori 2' ? 'selected' : '' }}>Ruang Teori 2</option>
                            </select>
                            @error('ruangan')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                            @error('semester')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jadwal-perkuliahan.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success mt-3" id="successAlert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
    </div>

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

            // Auto-hide success message setelah 3 detik
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>
</html>