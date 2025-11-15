<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Admin Lab TI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
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
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .menu-section {
            padding: 10px 20px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 10px;
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

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
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
            color: #6c757d;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #e9ecef;
            border-radius: 30px;
            outline: none;
            transition: all 0.3s;
        }

        .search-bar input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
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
            background: #f8f9fa;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .notification-btn:hover,
        .theme-toggle:hover {
            background: #e4e6eb;
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
        }

        /* User Card Styles */
        .user-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: 1px solid #e9ecef;
            border-radius: 10px;
        }

        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .user-details .detail-item {
            border-bottom: 1px solid #f8f9fa;
            padding-bottom: 8px;
        }

        .user-details .detail-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .card-title {
            font-size: 1.1rem;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Modal backdrop transparency */
        .modal-backdrop {
            opacity: 0.7 !important;
        }

        .modal {
            backdrop-filter: blur(5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
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
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        body.dark-mode .header {
            background: #2d3748;
            border-color: #4a5568;
        }

        body.dark-mode .card {
            background: #2d3748;
            border-color: #4a5568;
            color: #ffffff;
        }

        body.dark-mode .card-title {
            color: #ffffff;
        }

        body.dark-mode .text-muted {
            color: #a0aec0 !important;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #4a5568;
            border-color: #718096;
            color: #ffffff;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background: #4a5568;
            border-color: #4299e1;
            color: #ffffff;
        }

        /* Loading spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            <h2>Admin TI</h2>
        </div>

        <div class="sidebar-menu">
            <a href="/admin/dashboard" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            
            <div class="menu-section">Manajemen Peminjaman</div>
            <a href="/admin/peminjaman" class="menu-item">
                <i class="fas fa-hand-holding"></i>
                <span>Peminjaman</span>
            </a>
            <a href="/admin/pengembalian" class="menu-item">
                <i class="fas fa-undo"></i>
                <span>Pengembalian</span>
            </a>
            
            <div class="menu-section">Manajemen Aset</div>
            <a href="/admin/proyektor" class="menu-item">
                <i class="fas fa-video"></i>
                <span>Proyektor</span>
            </a>
            <a href="/admin/ruangan" class="menu-item">
                <i class="fas fa-door-open"></i>
                <span>Ruangan</span>
            </a>
            
            <div class="menu-section">Manajemen Akademik</div>
            <a href="/admin/jadwal" class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Jadwal</span>
            </a>
            <a href="/admin/matakuliah" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Matakuliah</span>
            </a>
            
            <div class="menu-section">Manajemen Pengguna</div>
            <a href="/admin/pengguna" class="menu-item active">
                <i class="fas fa-users"></i>
                <span>Pengguna</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari pengguna..." id="globalSearchHeader">
            </div>

            <div class="user-actions">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                </button>

                <button class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="user-profile">
                    <div class="user-avatar">A</div>
                    <div>
                        <div>Admin Lab</div>
                        <div style="font-size: 0.8rem; color: #6c757d;">Teknologi Informasi</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 text-dark mb-1">Manajemen Pengguna</h1>
                    <p class="text-muted mb-0">Kelola data pengguna sistem Lab Teknologi Informasi</p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openCreateModal()">
                        <i class="fas fa-plus me-2"></i>Tambah Pengguna
                    </button>
                </div>
            </div>

            <!-- Alert Messages -->
            <div id="alertContainer">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>

            <!-- Users Grid -->
            <div class="row g-4" id="usersGrid">
                @if(isset($users) && count($users) > 0)
                    @foreach($users as $user)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="card user-card h-100 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="card-title mb-1 fw-bold text-dark">{{ $user->nama }}</h6>
                                            @if($user->nim)
                                                <p class="text-muted small mb-2">{{ $user->nim }}</p>
                                            @endif
                                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                                            <p class="text-primary small mb-0">
                                                <i class="fab fa-whatsapp me-1"></i>{{ $user->no_hp ?? '-' }}
                                            </p>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary border-0" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item" onclick="openEditModal({{ $user->id }})">
                                                        <i class="fas fa-edit me-2"></i>Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->nama }}')">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="user-details">
                                        <div class="detail-item mb-2">
                                            <span class="badge {{ $user->peran == 'Admin Lab' ? 'bg-danger' : ($user->peran == 'Asisten' ? 'bg-primary' : 'bg-success') }}">
                                                {{ $user->peran }}
                                            </span>
                                        </div>
                                        
                                        <div class="detail-item mb-2">
                                            <small class="text-muted">Jurusan:</small>
                                            <div class="fw-medium">{{ $user->jurusan ?? '-' }}</div>
                                        </div>

                                        <div class="detail-item mb-2">
                                            <small class="text-muted">Status:</small>
                                            <div>
                                                <span class="badge {{ $user->status === 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                                    <i class="fas fa-circle me-1 small"></i>{{ $user->status }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <small class="text-muted">Bergabung:</small>
                                            <div class="fw-medium text-dark">
                                                {{ $user->tanggal_bergabung ? \Carbon\Carbon::parse($user->tanggal_bergabung)->format('d M Y') : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pt-0">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-primary btn-sm flex-fill" onclick="openEditModal({{ $user->id }})">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm flex-fill" onclick="confirmDelete({{ $user->id }}, '{{ $user->nama }}')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="card text-center py-5">
                            <div class="card-body">
                                <div class="text-muted">
                                    <i class="fas fa-users fa-3x mb-3"></i>
                                    <h4>Belum ada data pengguna</h4>
                                    <p class="mb-4">Mulai dengan menambahkan pengguna baru ke sistem</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" onclick="openCreateModal()">
                                        <i class="fas fa-plus me-2"></i>Tambah Pengguna Pertama
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination Info -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan <strong>{{ count($users ?? []) }}</strong> pengguna
                </div>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="userForm" method="POST">
                    @csrf
                    <div id="formMethod"></div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                    <div class="invalid-feedback" id="namaError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback" id="emailError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim">
                                    <div class="invalid-feedback" id="nimError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP (WhatsApp)</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp">
                                    <div class="invalid-feedback" id="no_hpError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jurusan" name="jurusan" required>
                                        <option value="">Pilih Jurusan</option>
                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                        <option value="Teknik Komputer">Teknik Komputer</option>
                                        <option value="Teknik Elektro">Teknik Elektro</option>
                                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                                    </select>
                                    <div class="invalid-feedback" id="jurusanError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="peran" class="form-label">Peran <span class="text-danger">*</span></label>
                                    <select class="form-select" id="peran" name="peran" required>
                                        <option value="">Pilih Peran</option>
                                        <option value="Admin Lab">Admin Lab</option>
                                        <option value="Asisten">Asisten</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                    </select>
                                    <div class="invalid-feedback" id="peranError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                    <div class="invalid-feedback" id="statusError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" required>
                                    <div class="invalid-feedback" id="tanggal_bergabungError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="passwordFields">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="invalid-feedback" id="passwordError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="row d-none" id="changePasswordSection">
                            <div class="col-12">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="changePassword">
                                    <label class="form-check-label" for="changePassword">
                                        Ubah Password
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span id="submitBtnText">Simpan</span>
                            <div class="loading-spinner d-none" id="submitSpinner"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserName"></strong>?</p>
                    <p class="text-danger">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Global variables
    let currentEditId = null;
    let deleteUserId = null;

    // Initialize when document is ready
    $(document).ready(function() {
        initializeEventListeners();
    });

    function initializeEventListeners() {
        // Toggle password fields when change password checkbox is clicked
        $('#changePassword').on('change', function() {
            if (this.checked) {
                $('#passwordFields').removeClass('d-none');
                $('#password').prop('required', true);
                $('#password_confirmation').prop('required', true);
            } else {
                $('#passwordFields').addClass('d-none');
                $('#password').prop('required', false);
                $('#password_confirmation').prop('required', false);
                $('#password').val('');
                $('#password_confirmation').val('');
            }
        });

        // Reset form ketika modal ditutup
        $('#userModal').on('hidden.bs.modal', function () {
            resetForm();
        });

        // Form submission handler
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            submitUserForm();
        });

        // Confirm delete handler
        $('#confirmDeleteBtn').on('click', function() {
            deleteUser(deleteUserId);
        });

        // Global search
        $('#globalSearchHeader').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            filterUsers(searchTerm);
        });
    }

    function filterUsers(searchTerm) {
        const userCards = document.querySelectorAll('.col-xl-3.col-lg-4.col-md-6');
        
        userCards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            if (cardText.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function resetForm() {
        $('#userForm')[0].reset();
        clearFormErrors();
        $('#passwordFields').removeClass('d-none');
        $('#changePasswordSection').addClass('d-none');
        $('#changePassword').prop('checked', false);
        $('#password').prop('required', true);
        $('#password_confirmation').prop('required', true);
        $('#submitBtn').prop('disabled', false);
        $('#submitBtnText').text('Simpan');
        $('#submitSpinner').addClass('d-none');
    }

    function openCreateModal() {
        resetForm();
        $('#userModalLabel').text('Tambah Pengguna Baru');
        $('#formMethod').html('');
        
        // Gunakan route name yang benar
        $('#userForm').attr('action', "{{ route('pengguna.store') }}");
        
        const today = new Date().toISOString().split('T')[0];
        $('#tanggal_bergabung').val(today);
        $('#status').val('Aktif');
        
        currentEditId = null;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('userModal'));
        modal.show();
    }

    function openEditModal(userId) {
        currentEditId = userId;
        
        // Reset form dulu
        resetForm();
        
        // Set action URL untuk update - gunakan route yang benar
        $('#userModalLabel').text('Edit Pengguna');
        $('#formMethod').html('@method("PUT")');
        $('#userForm').attr('action', `/admin/pengguna/${userId}`);
        
        // Sembunyikan password fields untuk edit
        $('#passwordFields').addClass('d-none');
        $('#changePasswordSection').removeClass('d-none');
        $('#password').prop('required', false);
        $('#password_confirmation').prop('required', false);
        
        // Coba ambil data user via AJAX
        fetchUserData(userId);
    }

    function fetchUserData(userId) {
        const submitBtn = $('#submitBtn');
        const submitBtnText = $('#submitBtnText');
        const submitSpinner = $('#submitSpinner');
        
        submitBtnText.text('Loading...');
        submitSpinner.removeClass('d-none');
        submitBtn.prop('disabled', true);

        // Gunakan endpoint yang sederhana
        $.ajax({
            url: `/admin/pengguna/${userId}/edit`,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            timeout: 5000,
            success: function(response) {
                if (response.user) {
                    populateEditForm(response.user);
                } else if (response.data) {
                    populateEditForm(response.data);
                } else {
                    // Jika tidak ada data, coba dengan data dari HTML
                    populateWithLocalData(userId);
                }
                showModal();
            },
            error: function(xhr, status, error) {
                // Fallback: coba populate dengan data yang ada di HTML
                populateWithLocalData(userId);
                showModal();
            }
        });
    }

    function populateWithLocalData(userId) {
        // Cari user data dari card yang ada
        const userCard = $(`[onclick*="openEditModal(${userId})"]`).closest('.user-card');
        if (userCard.length) {
            const userName = userCard.find('.card-title').text().trim();
            const userNim = userCard.find('.text-muted.small').first().text().trim();
            const userEmail = userCard.find('.text-muted.small').eq(1).text().trim();
            const userNoHp = userCard.find('.text-primary.small').text().replace('', '').trim();
            const userJurusan = userCard.find('.fw-medium').first().text().trim();
            const userPeran = userCard.find('.badge').first().text().trim();
            const userStatus = userCard.find('.badge').last().text().trim();
            
            $('#nama').val(userName);
            $('#email').val(userEmail);
            $('#nim').val(userNim);
            $('#no_hp').val(userNoHp);
            $('#jurusan').val(userJurusan);
            $('#peran').val(userPeran);
            $('#status').val(userStatus);
        }
    }

    function populateEditForm(user) {
        // Populate form fields
        $('#nama').val(user.nama || '');
        $('#email').val(user.email || '');
        $('#nim').val(user.nim || '');
        $('#no_hp').val(user.no_hp || '');
        $('#jurusan').val(user.jurusan || '');
        $('#peran').val(user.peran || '');
        $('#status').val(user.status || '');
        $('#tanggal_bergabung').val(user.tanggal_bergabung || '');
        
        clearFormErrors();
    }

    function showModal() {
        resetSubmitButton();
        const modal = new bootstrap.Modal(document.getElementById('userModal'));
        modal.show();
    }

    function resetSubmitButton() {
        $('#submitBtn').prop('disabled', false);
        $('#submitBtnText').text('Simpan Perubahan');
        $('#submitSpinner').addClass('d-none');
    }

    function submitUserForm() {
        const submitBtn = $('#submitBtn');
        const submitBtnText = $('#submitBtnText');
        const submitSpinner = $('#submitSpinner');
        
        submitBtnText.text('Menyimpan...');
        submitSpinner.removeClass('d-none');
        submitBtn.prop('disabled', true);

        const form = $('#userForm')[0];
        const url = $('#userForm').attr('action');
        const method = $('#userForm').find('input[name="_method"]').val() || 'POST';

        // Validasi form sebelum submit
        if (!form.checkValidity()) {
            form.reportValidity();
            resetSubmitButton();
            return;
        }

        // Submit form secara normal (bukan AJAX) untuk menghindari CORS issues
        form.submit();
    }

    function confirmDelete(userId, userName) {
        deleteUserId = userId;
        $('#deleteUserName').text(userName);
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    function deleteUser(userId) {
        // Create a form for deletion
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/pengguna/${userId}`;
        form.style.display = 'none';

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Add method spoofing for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    }

    function clearFormErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
    }

    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        $('#alertContainer').html(alertHtml);
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }

    // Theme toggle
    $('#theme-toggle').on('click', function() {
        $('body').toggleClass('dark-mode');
        if ($('body').hasClass('dark-mode')) {
            $(this).html('<i class="fas fa-sun"></i>');
            localStorage.setItem('theme', 'dark');
        } else {
            $(this).html('<i class="fas fa-moon"></i>');
            localStorage.setItem('theme', 'light');
        }
    });

    // Load saved theme
    $(document).ready(function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            $('body').addClass('dark-mode');
            $('#theme-toggle').html('<i class="fas fa-sun"></i>');
        }
    });

    // Auto-hide alerts after 5 seconds
    $(document).ready(function() {
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
</body>
</html>