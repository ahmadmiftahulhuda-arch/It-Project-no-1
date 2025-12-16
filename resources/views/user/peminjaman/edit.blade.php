<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman - Sistem Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ===== VARIABEL CSS SESUAI FREE USER ===== */
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --warning-color: #ffc107;
            --warning-dark: #e0a800;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --border-radius: 10px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        /* ===== NAVBAR UTAMA DIPERBAIKI ===== */
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

        /* Logo TI yang diperbesar */
        .navbar-brand img {
            height: 45px;
            margin-right: 12px;
            transition: transform 0.3s;
        }

        .navbar-brand:hover img {
            transform: rotate(-10deg);
        }

        .navbar-nav .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* ===== NAVBAR CENTER ALIGNMENT ===== */
        .navbar-nav-center {
            display: flex;
            justify-content: center;
            flex-grow: 1;
            margin: 0 auto;
        }

        .navbar-nav-center .nav-item {
            margin: 0 0.5rem;
        }

        /* ===== NAVBAR DROPDOWN IMPROVEMENTS ===== */
        .navbar-nav .nav-link.dropdown-toggle {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Hapus panah default Bootstrap */
        .navbar-nav .nav-link.dropdown-toggle::after {
            display: none !important;
        }

        /* Custom arrow icon - lebih kecil dan simpel seperti gambar */
        .navbar-nav .nav-link.dropdown-toggle .custom-arrow {
            margin-left: 8px;
            font-size: 0.85rem;
            transition: transform 0.3s ease;
            display: inline-block;
            color: rgba(255, 255, 255, 0.7);
            font-weight: normal;
        }

        .navbar-nav .nav-link.dropdown-toggle.show .custom-arrow {
            transform: rotate(180deg);
        }

        /* Styling untuk dropdown yang aktif/diklik */
        .navbar-nav .nav-link.dropdown-toggle.show {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .dropdown-menu-custom {
            background-color: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            min-width: 220px;
            margin-top: 8px;
            transition: all 0.3s ease;
            transform-origin: top;
            animation: dropdownFadeIn 0.3s ease;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .dropdown-item-custom.active {
            background-color: rgba(59, 89, 152, 0.15);
            color: var(--primary-color);
            font-weight: 600;
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

        /* ===== NAVBAR DROPDOWN POSITIONING ===== */
        .navbar-nav .dropdown-menu {
            position: absolute;
        }

        /* ===== RESPONSIVE DROPDOWN ===== */
        @media (max-width: 768px) {
            .dropdown-menu-custom {
                margin-top: 0;
                border-radius: 0 0 8px 8px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .navbar-nav .nav-link.dropdown-toggle {
                justify-content: flex-start;
            }

            .navbar-nav .nav-link.dropdown-toggle .custom-arrow {
                margin-left: auto;
            }
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

        /* ===== KONTEN UTAMA ===== */
        .main-content {
            flex: 1;
        }

        /* ===== KARTU ===== */
        .card-custom {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
            background-color: white;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        /* ===== TOMBOL ===== */
        .btn-warning-custom {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-warning-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.5s ease;
        }

        .btn-warning-custom:hover::before {
            left: 100%;
        }

        .btn-warning-custom:hover {
            background-color: var(--warning-dark);
            border-color: var(--warning-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
            color: #000;
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-2px);
            color: white;
        }

        /* ===== FORM ===== */
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.15);
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
        }

        .input-icon .form-control,
        .input-icon .form-select {
            padding-left: 45px;
        }

        /* ===== HEADER ===== */
        .page-header {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-description {
            color: #6c757d;
            margin-bottom: 1.5rem;
            width: 100%;
        }

        /* ===== ALERT ===== */
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 1.5rem;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            padding: 0.5em 1em;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .status-disetujui {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        /* ===== FOOTER ===== */
        .footer {
            background-color: #2d3748;
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
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #e5e7eb;
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
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
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
            background-color: var(--secondary-color);
            transform: translateY(-5px);
        }

        /* ===== RESPONSIVITAS ===== */
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
        }

        @media (max-width: 576px) {

            .btn-warning-custom,
            .btn-secondary-custom {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- ===== NAVBAR UTAMA YANG DIPERBAIKI ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="/home">
                <!-- Logo TI yang ditambahkan -->
                <img src="/img/Logo_TI.png" alt="Logo TI">
                PINTER
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu tengah -->
                <ul class="navbar-nav navbar-nav-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kalenderDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-calendar-alt me-1"></i> Kalender Perkuliahan
                            <span class="custom-arrow">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="kalenderDropdown">
                            <li>
                                <a class="dropdown-item-custom" href="/kalender">
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
                                    <i class="fas fa-download me-2"></i> Download Kalender
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="peminjamanDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-clipboard-list me-1"></i> Peminjaman
                            <span class="custom-arrow">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
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
                                <a class="dropdown-item-custom" href="{{ route('user.peminjaman.riwayat') }}">
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
                        <a class="nav-link" href="/about">
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
                                {{ Auth::user()->display_name }}
                                <span class="custom-arrow">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="userDropdown">
                                <li class="dropdown-header-custom">Masuk sebagai</li>
                                <li class="dropdown-header-custom fw-bold">{{ Auth::user()->display_name }}</li>
                                <li>
                                    <hr class="dropdown-divider-custom">
                                </li>
                                <li>
                                    <a class="dropdown-item-custom" href="{{ route('user.profile.index') }}">
                                        <i class="fas fa-user fa-fw me-2"></i> Pengaturan Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item-custom" href="#">
                                        <i class="fas fa-history fa-fw me-2"></i> Riwayat Peminjaman
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item-custom {{ Request::routeIs('user.settings.index') ? 'active' : '' }}"
                                        href="{{ route('user.settings.index') }}">
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

    <!-- ===== KONTEN UTAMA ===== -->
    <div class="container main-content mt-4">
        <!-- Header dan Kembali ke Daftar -->
        <div class="page-header">
            <div>
                <h1 class="page-title"><i class="fa-solid fa-edit"></i> Edit Peminjaman</h1>
                <p class="page-description">Perbarui informasi peminjaman sesuai kebutuhan</p>
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

        <!-- Form Edit Peminjaman -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <form action="{{ route('user.peminjaman.update', $peminjaman->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Info Status -->
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle fa-lg me-3"></i>
                                <div>
                                    <h6 class="mb-1">Status Peminjaman:
                                        @if ($peminjaman->status == 'pending')
                                            <span class="badge status-badge status-menunggu">
                                                <i class="fas fa-clock me-1"></i> Menunggu Persetujuan
                                            </span>
                                        @elseif($peminjaman->status == 'disetujui')
                                            <span class="badge status-badge status-disetujui">
                                                <i class="fas fa-check-circle me-1"></i> Disetujui
                                            </span>
                                        @elseif($peminjaman->status == 'ditolak')
                                            <span class="badge status-badge status-ditolak">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @endif
                                    </h6>
                                    <p class="mb-0">Terakhir diubah:
                                        {{ \Carbon\Carbon::parse($peminjaman->updated_at)->format('d M Y H:i') }}</p>
                                </div>
                            </div>

                            @if ($peminjaman->status != 'pending')
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Perhatian:</strong> Hanya peminjaman dengan status "Menunggu" yang dapat
                                    diedit.
                                </div>
                            @endif

                            <div class="mb-4">
                                <label class="form-label">Tanggal Peminjaman</label>
                                <div class="input-icon">
                                    <i class="fas fa-calendar-day"></i>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ old('tanggal', $peminjaman->tanggal) }}"
                                        {{ $peminjaman->status != 'pending' ? 'disabled' : '' }} required>
                                </div>
                                @error('tanggal')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Waktu Mulai</label>
                                    <div class="input-icon">
                                        <i class="fas fa-clock"></i>
                                        <select name="waktu_mulai"
                                            class="form-select @error('waktu_mulai') is-invalid @enderror"
                                            {{ $peminjaman->status != 'pending' ? 'disabled' : '' }} required>
                                            <option value="">Pilih Waktu Mulai</option>
                                            @if (!empty($slotwaktu))
                                                @foreach ($slotwaktu as $slot)
                                                    <option value="{{ $slot->waktu }}"
                                                        {{ old('waktu_mulai', $peminjaman->waktu_mulai) == $slot->waktu ? 'selected' : '' }}>
                                                        {{ $slot->waktu }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('waktu_mulai')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Waktu Selesai</label>
                                    <div class="input-icon">
                                        <i class="fas fa-clock"></i>
                                        <select name="waktu_selesai"
                                            class="form-select @error('waktu_selesai') is-invalid @enderror"
                                            {{ $peminjaman->status != 'pending' ? 'disabled' : '' }} required>
                                            <option value="">Pilih Waktu Selesai</option>
                                            @if (!empty($slotwaktu))
                                                @foreach ($slotwaktu as $slot)
                                                    <option value="{{ $slot->waktu }}"
                                                        {{ old('waktu_selesai', $peminjaman->waktu_selesai) == $slot->waktu ? 'selected' : '' }}>
                                                        {{ $slot->waktu }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('waktu_selesai')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Ruang</label>
                                <div class="input-icon">
                                    <i class="fas fa-door-open"></i>
                                    <select name="ruangan_id" class="form-select">
                                        <option value="">-- Pilih Ruang --</option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}"
                                                {{ old('ruangan_id', $peminjaman->ruangan_id) == $r->id ? 'selected' : '' }}>
                                                {{ $r->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ruangan_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Proyektor (Opsional)</label>
                                <div class="input-icon">
                                    <i class="fas fa-video"></i>
                                    <select name="projector_id" class="form-select"
                                        {{ $peminjaman->status != 'pending' ? 'disabled' : '' }}>
                                        <option value="">-- Tidak Ada Proyektor --</option>
                                        @foreach ($projectors as $p)
                                            <option value="{{ $p->id }}"
                                                {{ old('projector_id', $peminjaman->projector_id) == $p->id ? 'selected' : '' }}>
                                                {{ $p->kode_proyektor }} - {{ $p->merk ?? '' }} {{ $p->model ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('projector_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4 form-group">
                                <label class="form-label">
                                    <i class="fas fa-user text-primary"></i>
                                    Dosen Pengampu Mata Kuliah
                                </label>
                                <div class="input-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <select name="dosen_nip"
                                        class="form-select @error('dosen_nip') is-invalid @enderror"
                                        {{ $peminjaman->status != 'pending' ? 'disabled' : '' }}>
                                        <option value="">-- Pilih Dosen Pengampu --</option>
                                        @if (!empty($dosens) && $dosens->count())
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->nip }}"
                                                    {{ old('dosen_nip', $peminjaman->dosen_nip) == $dosen->nip ? 'selected' : '' }}>
                                                    {{ $dosen->nama_dosen }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('dosen_nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Keperluan</label>
                                <div class="input-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                    <select name="keperluan" id="keperluanSelect" class="form-select"
                                        {{ $peminjaman->status != 'pending' ? 'disabled' : '' }} required>
                                        <option value="">-- Pilih Keperluan --</option>
                                        @php
                                            $opsi = [
                                                'Perkuliahan',
                                                'Kelas Pengganti',
                                                'Seminar TA/PKL/Proposal',
                                                'Ujikom',
                                                'Mentoring',
                                                'Belajar Bersama',
                                                'Konsultasi KRS',
                                                'UTS',
                                                'UAS',
                                            ];
                                        @endphp

                                        @foreach ($opsi as $item)
                                            <option value="{{ $item }}"
                                                {{ $peminjaman->keperluan == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach

                                        <option value="Lainnya"
                                            {{ !in_array($peminjaman->keperluan, $opsi) ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>

                                    <div class="mt-3 {{ in_array($peminjaman->keperluan, $opsi) ? 'd-none' : '' }}"
                                        id="keperluanLainnyaWrapper">
                                        <input type="text" name="keperluan_lainnya" class="form-control"
                                            value="{{ !in_array($peminjaman->keperluan, $opsi) ? $peminjaman->keperluan : '' }}"
                                            placeholder="Tuliskan keperluan lainnya">
                                    </div>

                                </div>
                                @error('keperluan')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('user.peminjaman.index') }}"
                                    class="btn btn-secondary-custom me-md-2">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                @if ($peminjaman->status == 'pending')
                                    <button type="submit" class="btn btn-warning-custom">
                                        <i class="fas fa-save me-2"></i>Perbarui Data
                                    </button>
                                @else
                                    <button type="button" class="btn btn-warning-custom" disabled>
                                        <i class="fas fa-ban me-2"></i>Tidak Dapat Edit
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="card card-custom mt-4">
                    <div class="card-body">
                        <h5><i class="fas fa-history text-warning me-2"></i> Riwayat Peminjaman</h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="fas fa-plus text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Data dibuat</h6>
                                <p class="text-muted mb-0">
                                    {{ \Carbon\Carbon::parse($peminjaman->created_at)->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="fas fa-edit text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Terakhir diubah</h6>
                                <p class="text-muted mb-0">
                                    {{ \Carbon\Carbon::parse($peminjaman->updated_at)->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
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
                <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-tine
                    di Program Studi Teknologi Informasi.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/ti.politala?igsh=MXY4MTc3NGZjeHR2MQ=="><i
                            class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.youtube.com/@teknikinformatikapolitala8620"><i
                            class="fab fa-youtube"></i></a>
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
            <p>&copy; 2025 Sistem Peminjaman Sarana Prasarana - Program Studi Teknologi Informasi Politeknik Negeri
                Tanah Laut. All Rights Reserved.</p>
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

        // ===== DROPDOWN ANIMATION =====
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown toggle animation
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    // Close other open dropdowns
                    dropdownToggles.forEach(otherToggle => {
                        if (otherToggle !== toggle && otherToggle.classList.contains(
                                'show')) {
                            otherToggle.classList.remove('show');
                            const otherMenu = otherToggle.nextElementSibling;
                            if (otherMenu && otherMenu.classList.contains('show')) {
                                otherMenu.classList.remove('show');
                            }
                        }
                    });
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown-menu')) {
                    const openDropdowns = document.querySelectorAll(
                        '.dropdown-toggle.show, .dropdown-menu.show');
                    openDropdowns.forEach(element => {
                        element.classList.remove('show');
                    });
                }
            });
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
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // ===== SET TANGGAL MINIMUM DAN VALIDASI FORM =====
        document.addEventListener('DOMContentLoaded', function() {
            // Set tanggal minimum ke hari ini
            const today = new Date().toISOString().split('T')[0];
            const dateInput = document.querySelector('input[type="date"]');

            if (dateInput) {
                dateInput.setAttribute('min', today);
            }

            // Validasi form
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const ruang = document.querySelector('select[name="ruangan_id"]') ? document
                        .querySelector('select[name="ruangan_id"]').value : '';
                    const keperluan = document.querySelector('select[name="keperluan"]').value;
                    const keperluanLainnya = document.querySelector('input[name="keperluan_lainnya"]')
                        ?.value || '';
                    const proyektor = document.querySelector('select[name="projector_id"]') ? document
                        .querySelector('select[name="projector_id"]').value : '';

                    if (ruang === '' && proyektor === '') {
                        e.preventDefault();
                        alert('Minimal pilih Ruangan atau Proyektor');
                        return false;
                    }

                    if (keperluan === '') {
                        isValid = false;
                        showToast('Keperluan tidak boleh kosong', 'error');
                    }

                    // jika pilih lainnya, wajib isi teks
                    if (keperluan === 'Lainnya' && keperluanLainnya.trim() === '') {
                        isValid = false;
                        showToast('Silakan isi keperluan lainnya', 'error');
                    }

                    // Proyektor optional: no need to force selection

                    // Cek status peminjaman
                    const status = "{{ $peminjaman->status }}";
                    if (status !== 'pending') {
                        e.preventDefault();
                        alert('Tidak dapat mengedit peminjaman yang sudah disetujui atau ditolak');
                        return false;
                    }
                });
            }
        });
    </script>
</body>

</html>
