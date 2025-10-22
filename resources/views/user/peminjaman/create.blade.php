<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman - Sistem Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ===== VARIABEL CSS YANG DIPERBAIKI ===== */
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --border-radius: 12px;
            --box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        /* ===== STYLING UMUM YANG DIPERBAIKI ===== */
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #334155;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            scroll-behavior: smooth;
        }

        /* ===== NAVBAR UTAMA YANG DIPERBAIKI ===== */
        .navbar-custom {
            background-color: var(--primary-color);
            padding: 0.8rem 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .navbar-custom.scrolled {
            padding: 0.5rem 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-brand i {
            margin-right: 10px;
            transition: transform 0.3s;
        }

        .navbar-brand:hover i {
            transform: rotate(-10deg);
        }

        .navbar-nav .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* ===== DROPDOWN MENU YANG DIPERBAIKI ===== */
        .dropdown-menu-custom {
            background-color: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            min-width: 220px;
            margin-top: 8px;
            transition: all 0.3s ease;
        }

        .dropdown-item-custom {
            padding: 0.7rem 1rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-weight: 500;
        }

        .dropdown-item-custom:hover {
            background-color: rgba(59, 89, 152, 0.1);
            color: var(--primary-color);
        }

        .dropdown-divider-custom {
            margin: 0.5rem 0;
            border-top: 1px solid #e9ecef;
        }

        .dropdown-header-custom {
            padding: 0.7rem 1rem;
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 600;
        }

         /* ===== TOMBOL LOGIN ===== */
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            font-size: 0.9rem;
        }

        .btn-warning::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.5s ease;
        }

        .btn-warning:hover::before {
            left: 100%;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* ===== KONTEN UTAMA YANG DIPERBAIKI ===== */
        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        /* ===== KARTU YANG DIPERBAIKI ===== */
        .card-custom {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
            background-color: white;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        /* ===== TOMBOL YANG DIPERBAIKI ===== */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-color: var(--primary-color);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.5s ease;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
            border-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 89, 152, 0.3);
            color: white;
        }

        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            border-color: #6c757d;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-secondary-custom:hover {
            background: linear-gradient(135deg, #5a6268, #545b62);
            border-color: #545b62;
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* ===== FORM YANG DIPERBAIKI ===== */
        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.15);
            outline: none;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
            font-size: 1rem;
        }

        .input-icon .form-control, .input-icon .form-select {
            padding-left: 45px;
        }

        /* ===== HEADER YANG DIPERBAIKI ===== */
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
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
        }

        .page-description {
            color: #64748b;
            margin-bottom: 1.5rem;
            width: 100%;
            font-size: 1.1rem;
        }

        /* ===== ALERT YANG DIPERBAIKI ===== */
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }

        .alert ul {
            margin-bottom: 0;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        /* ===== INFO BOX YANG DIPERBAIKI ===== */
        .info-box {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-left: 4px solid var(--primary-color);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .info-box h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-box ul {
            margin-bottom: 0;
            padding-left: 1.5rem;
        }

        .info-box li {
            margin-bottom: 0.5rem;
            color: #475569;
        }

        /* ===== FOOTER YANG DIPERBAIKI ===== */
        .footer {
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            padding: 40px 0 20px;
            margin-top: auto;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
            font-weight: 700;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: var(--primary-color);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
        }

        .footer-links a:hover {
            color: var(--primary-color);
            padding-left: 5px;
        }

        .contact-info {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .contact-info i {
            margin-right: 10px;
            color: var(--primary-color);
            min-width: 20px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .opening-hours {
            margin-bottom: 15px;
        }

        .opening-hours div {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 30px auto 0;
            padding: 20px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
        }

        /* Back to top button yang diperbaiki */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
            transform: translateY(-5px);
        }

        /* ===== RESPONSIVITAS YANG DIPERBAIKI ===== */
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .navbar-brand {
                font-size: 1rem;
            }

            .page-header .col-md-6 {
                margin-bottom: 15px;
            }

            .page-header .text-md-end {
                text-align: left !important;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .footer-section h3 {
                font-size: 1.3rem;
            }

            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 40px;
                height: 40px;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .btn-primary-custom, .btn-secondary-custom {
                width: 100%;
                padding: 12px;
            }

            .d-md-flex.justify-content-md-end {
                flex-direction: column;
                gap: 0.5rem;
            }

            .d-md-flex.justify-content-md-end .btn {
                width: 100%;
            }
        }

        /* ===== ANIMASI TAMBAHAN ===== */
        .form-group {
            transition: all 0.3s ease;
        }

        .form-group:focus-within {
            transform: translateX(5px);
        }

        /* ===== STYLING UNTUK VALIDASI FORM ===== */
        .is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* ===== STYLING UNTUK TEXTAREA ===== */
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* ===== STYLING UNTUK CARD FORM ===== */
        .card-form {
            border-top: 4px solid var(--primary-color);
        }

        .card-form .card-body {
            padding: 2rem;
        }
    </style>
</head>

<body>
    <!-- ===== NAVBAR UTAMA YANG DIPERBAIKI ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i>SarPras TI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu sebelah kiri -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kalenderDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-calendar-alt me-1"></i> Kalender Perkuliahan
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="kalenderDropdown">
                            <li>
                                <a class="dropdown-item-custom" href="#">
                                    <i class="fas fa-calendar me-2"></i> Kalender Akademik
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item-custom" href="#">
                                    <i class="fas fa-clock me-2"></i> Jadwal Kuliah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item-custom" href="#">
                                    <i class="fas fa-book me-2"></i> Jadwal Ujian
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item-custom" href="#">
                                    <i class="fas fa-graduation-cap me-2"></i> Jadwal Wisuda
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider-custom">
                            </li>
                            <li>
                                <a class="dropdown-item-custom" href="#">
                                    <i class="fas fa-download me-2"></i> Download Kalender
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="peminjamanDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-clipboard-list me-1"></i> Peminjaman                           
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="peminjamanDropdown">
                            <li>
                                <a class="dropdown-item-custom" href="{{ route('user.peminjaman.index') }}">
                                    <i class="fas fa-clipboard-list me-2"></i> Daftar Peminjaman
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item-custom" href="{{ route('user.peminjaman.create') }}">
                                    <i class="fas fa-plus-circle me-2"></i> Tambah Peminjaman
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item-custom" href="{{ route('user.pengembalian.index') }}">
                                    <i class="fas fa-undo me-2"></i> Pengembalian
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item-custom active" href="{{ route('user.peminjaman.riwayat') }}">
                                    <i class="fas fa-history me-2"></i> Riwayat
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item-custom" href="{{ route('user.feedback.create') }}">
                                    <i class="fas fa-comment-dots me-2"></i> Feedback
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-info-circle me-1"></i> Tentang
                        </a>
                    </li>
                </ul>

                <!-- Menu sebelah kanan (login/user) -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="userDropdown">
                                <li class="dropdown-header-custom">Masuk sebagai</li>
                                <li class="dropdown-header-custom fw-bold">{{ Auth::user()->name }}</li>
                                <li>
                                    <hr class="dropdown-divider-custom">
                                </li>
                                <li>
                                    <a class="dropdown-item-custom" href="#">
                                        <i class="fas fa-user fa-fw me-2"></i> Pengaturan Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item-custom" href="#">
                                        <i class="fas fa-history fa-fw me-2"></i> Riwayat Peminjaman
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item-custom" href="#">
                                        <i class="fas fa-cog fa-fw me-2"></i> Pengaturan
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider-custom">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item-custom text-danger">
                                            <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn-warning">
                                <i class="fa-solid fa-right-to-bracket"></i> Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== KONTEN UTAMA YANG DIPERBAIKI ===== -->
    <div class="container main-content">
        <!-- Header dan Kembali ke Daftar -->
        <div class="page-header">
            <div>
                <h1 class="page-title"><i class="fa-solid fa-plus-circle"></i> Tambah Peminjaman</h1>
                <p class="page-description">Isi form berikut untuk menambahkan data peminjaman baru</p>
            </div>
            <a href="{{ route('user.peminjaman.index') }}" class="btn btn-secondary-custom">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Alert Notifikasi -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form Peminjaman -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-custom card-form">
                    <div class="card-body">
                        <form action="{{ route('user.peminjaman.store') }}" method="POST" id="peminjamanForm">
                            @csrf
                            
                            <div class="mb-4 form-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar-day text-primary"></i>
                                    Tanggal Peminjaman
                                </label>
                                <div class="input-icon">
                                    <i class="fas fa-calendar-day"></i>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                                           value="{{ old('tanggal') }}" required id="tanggalInput">
                                </div>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 form-group">
                                <label class="form-label">
                                    <i class="fas fa-door-open text-primary"></i>
                                    Ruang
                                </label>
                                <div class="input-icon">
                                    <i class="fas fa-door-open"></i>
                                    <select name="ruang" class="form-select @error('ruang') is-invalid @enderror" required>
                                        <option value="">-- Pilih Ruang --</option>
                                        <option value="Lab A" {{ old('ruang') == 'Lab A' ? 'selected' : '' }}>Lab A</option>
                                        <option value="Lab B" {{ old('ruang') == 'Lab B' ? 'selected' : '' }}>Lab B</option>
                                        <option value="Lab C" {{ old('ruang') == 'Lab C' ? 'selected' : '' }}>Lab C</option>
                                        <option value="Ruang Meeting" {{ old('ruang') == 'Ruang Meeting' ? 'selected' : '' }}>Ruang Meeting</option>
                                        <option value="Ruang Seminar" {{ old('ruang') == 'Ruang Seminar' ? 'selected' : '' }}>Ruang Seminar</option>
                                    </select>
                                </div>
                                @error('ruang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 form-group">
                                <label class="form-label">
                                    <i class="fas fa-video text-primary"></i>
                                    Proyektor
                                </label>
                                <div class="input-icon">
                                    <i class="fas fa-video"></i>
                                    <select name="proyektor" class="form-select @error('proyektor') is-invalid @enderror" required>
                                        <option value="">-- Pilih Ketersediaan --</option>
                                        <option value="1" {{ old('proyektor') == '1' ? 'selected' : '' }}>Ya, butuh proyektor</option>
                                        <option value="0" {{ old('proyektor') == '0' ? 'selected' : '' }}>Tidak butuh proyektor</option>
                                    </select>
                                </div>
                                @error('proyektor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 form-group">
                                <label class="form-label">
                                    <i class="fas fa-clipboard-list text-primary"></i>
                                    Keperluan
                                </label>
                                <div class="input-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                    <textarea name="keperluan" class="form-control @error('keperluan') is-invalid @enderror" 
                                              rows="4" placeholder="Jelaskan keperluan peminjaman secara detail..." required>{{ old('keperluan') }}</textarea>
                                </div>
                                @error('keperluan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('user.peminjaman.index') }}" class="btn btn-secondary-custom me-md-2">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>Simpan Peminjaman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Info Box yang Diperbaiki -->
                <div class="info-box mt-4">
                    <h5><i class="fas fa-info-circle"></i> Informasi Penting</h5>
                    <ul class="mb-0">
                        <li>Pastikan untuk memeriksa ketersediaan ruangan sebelum melakukan peminjaman</li>
                        <li>Peminjaman proyektor harus dilakukan minimal 1 hari sebelumnya</li>
                        <li>Hubungi administrator untuk bantuan terkait peminjaman</li>
                        <li>Status peminjaman akan ditinjau oleh administrator</li>
                        <li>Waktu peminjaman default adalah 08:00 - 17:00</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to top button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-time di Program Studi Teknologi Informasi.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/ti.politala?igsh=MXY4MTc3NGZjeHR2MQ=="><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.youtube.com/@teknikinformatikapolitala8620"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Link Cepat</h3>
                <ul class="footer-links">
                    <li><a href="/home">Beranda</a></li>
                    <li><a href="/kalender">Kalender Perkuliahan</a></li>
                    <li><a href="/about">Tentang</a></li>
                    <li><a href="/syaratdanketentuan">Syarat & Ketentuan</a></li>
                    <li><a href="/faq">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Kontak Kami</h3>
                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Jl. Ahmad Yani No.Km.06, Kec. Pelaihari, Kabupaten Tanah Laut, Kalimantan Selatan</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <span>(0512) 2021065</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <span>peminjaman@example.ac.id</span>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Jam Operasional</h3>
                <div class="opening-hours">
                    <div>
                        <span>Senin - Kamis:</span>
                        <span>08:00 - 16:00</span>
                    </div>
                    <div>
                        <span>Jumat:</span>
                        <span>08:00 - 16:00</span>
                    </div>
                    <div>
                        <span>Sabtu & Minggu:</span>
                        <span>Tutup</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 Sistem Peminjaman Sarana Prasarana - Program Studi Teknologi Informasi Politeknik Negeri Tanah Laut. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== NAVBAR SCROLL EFFECT =====
        const navbar = document.getElementById('navbar');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ===== BACK TO TOP BUTTON FUNCTIONALITY =====
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });
        
        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // ===== SET TANGGAL MINIMUM DAN VALIDASI FORM =====
        document.addEventListener('DOMContentLoaded', function() {
            // Set tanggal minimum ke hari ini
            const today = new Date().toISOString().split('T')[0];
            const dateInput = document.getElementById('tanggalInput');
            
            if (dateInput) {
                dateInput.setAttribute('min', today);
                
                // Jika tidak ada nilai sebelumnya, set ke hari ini
                if (!dateInput.value) {
                    dateInput.value = today;
                }
            }
            
            // Validasi form yang lebih baik
            const form = document.getElementById('peminjamanForm');
            const submitBtn = document.getElementById('submitBtn');
            
            if (form) {
                form.addEventListener('submit', function(e) {
                    const ruang = document.querySelector('select[name="ruang"]').value;
                    const keperluan = document.querySelector('textarea[name="keperluan"]').value;
                    const proyektor = document.querySelector('select[name="proyektor"]').value;
                    
                    let isValid = true;
                    
                    if (ruang === '') {
                        isValid = false;
                        showToast('Pilih ruang terlebih dahulu', 'error');
                    }
                    
                    if (keperluan.trim() === '') {
                        isValid = false;
                        showToast('Keperluan tidak boleh kosong', 'error');
                    }
                    
                    if (proyektor === '') {
                        isValid = false;
                        showToast('Pilih ketersediaan proyektor', 'error');
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                        return false;
                    }
                    
                    // Tampilkan loading state
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                        submitBtn.disabled = true;
                    }
                });
            }
            
            // Fungsi untuk menampilkan toast notification
            function showToast(message, type = 'info') {
                // Buat elemen toast
                const toast = document.createElement('div');
                toast.className = `alert alert-${type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
                toast.style.top = '20px';
                toast.style.right = '20px';
                toast.style.zIndex = '1060';
                toast.style.minWidth = '300px';
                toast.innerHTML = `
                    <i class="fas ${type === 'error' ? 'fa-exclamation-triangle' : 'fa-info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                document.body.appendChild(toast);
                
                // Hapus toast setelah 5 detik
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 5000);
            }
            
            // Animasi untuk form groups
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach(group => {
                const input = group.querySelector('input, select, textarea');
                if (input) {
                    input.addEventListener('focus', function() {
                        group.style.transform = 'translateX(5px)';
                    });
                    
                    input.addEventListener('blur', function() {
                        group.style.transform = 'translateX(0)';
                    });
                }
            });
        });
    </script>
</body>
</html>