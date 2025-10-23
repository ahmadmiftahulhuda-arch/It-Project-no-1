<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Feedback - Sistem Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ===== VARIABEL CSS SESUAI FREE USER ===== */
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --border-radius: 10px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        /* ===== STYLING UMUM ===== */
        body {
            background-color: #f5f8fa;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        /* ===== SUB NAVIGASI ===== */
        .sub-nav {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.8rem 0;
            position: sticky;
            top: 70px;
            z-index: 999;
        }

        .sub-nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .sub-nav-links {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .sub-nav-link {
            color: var(--primary-color);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid transparent;
        }

        .sub-nav-link:hover,
        .sub-nav-link.active {
            background-color: rgba(59, 89, 152, 0.1);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .sub-nav-link i {
            font-size: 0.9rem;
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
        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
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
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .btn-success-custom {
            background-color: #198754;
            border-color: #198754;
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

        .btn-success-custom:hover {
            background-color: #157347;
            border-color: #146c43;
            transform: translateY(-2px);
            color: white;
        }

        /* ===== FORM FEEDBACK ===== */
        .feedback-form {
            max-width: 800px;
            margin: 30px auto;
        }

        .form-header {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 25px;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-header h2 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form-header p {
            margin-bottom: 0;
            opacity: 0.9;
        }

        .rating-stars .star {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
            margin-right: 5px;
        }

        .rating-stars .star:hover, 
        .rating-stars .star.selected {
            color: #ffc107;
        }

        .peminjaman-info {
            border-left: 4px solid var(--primary-color);
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            border-radius: 6px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 89, 152, 0.25);
        }

        /* ===== ALERT ===== */
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 1.5rem;
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

            .sub-nav {
                top: 56px;
            }

            .sub-nav-links {
                gap: 0.5rem;
            }

            .sub-nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }

            .form-header {
                padding: 20px 15px;
            }

            .rating-stars .star {
                font-size: 1.7rem;
            }

            .dropdown-menu-custom {
                width: 12rem;
                right: -1rem;
            }
        }

        @media (max-width: 576px) {
            .sub-nav-links {
                justify-content: center;
            }

            .sub-nav-link {
                flex: 1;
                min-width: 140px;
                justify-content: center;
                text-align: center;
            }

            .btn-primary-custom, .btn-success-custom {
                width: 100%;
                padding: 12px;
            }

            .btn-warning {
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- ===== NAVBAR UTAMA YANG DIPERBAIKI ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i>PINTER
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu sebelah kiri -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
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

     <!-- ===== KONTEN UTAMA ===== -->
    <div class="container main-content mt-4">
        <!-- Header -->
        <div class="page-header mb-4">
            <div>
                <h1 class="page-title"><i class="fa-solid fa-comment-dots"></i> Form Feedback</h1>
                <p class="page-description">Berikan masukan Anda untuk meningkatkan kualitas fasilitas kami</p>
            </div>
            <div>
                <a href="{{ route('user.peminjaman.riwayat') }}" class="btn btn-primary-custom">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>

        <!-- Form Feedback -->
        <div class="card card-custom feedback-form">
            <div class="form-header">
                <h2>Form Feedback Sarana Prasarana</h2>
                <p>Berikan masukan Anda untuk meningkatkan kualitas fasilitas kami</p>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @auth
                <form action="{{ route('user.feedback.store') }}" method="POST" id="feedbackForm">
                    @csrf

                    @if(isset($peminjaman))
                        <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
                        <div class="peminjaman-info">
                            <p class="mb-0">Anda memberikan feedback untuk peminjaman:</p>
                            <h5 class="mb-0"><strong>{{ $peminjaman->keperluan ?? 'Peminjaman ID: ' . $peminjaman->id }}</strong></h5>
                        </div>
                    @else
                        <div class="mb-4">
                            <label for="peminjaman_id" class="form-label">Pilih Peminjaman yang akan diberi Feedback *</label>
                            <select class="form-select @error('peminjaman_id') is-invalid @enderror" id="peminjaman_id" name="peminjaman_id" required>
                                <option value="" selected disabled>-- Pilih Peminjaman --</option>
                                @foreach($peminjamans as $item)
                                    <option value="{{ $item->id }}" {{ old('peminjaman_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->keperluan ?? 'Peminjaman ID: ' . $item->id }} ({{ $item->tanggal }})
                                    </option>
                                @endforeach
                            </select>
                            @error('peminjaman_id') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="kategori" class="form-label">Kategori Feedback *</label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="Fasilitas Ruangan" {{ old('kategori') == 'Fasilitas Ruangan' ? 'selected' : '' }}>Fasilitas Ruangan</option>
                                <option value="Kebersihan" {{ old('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                                <option value="Layanan Staff" {{ old('kategori') == 'Layanan Staff' ? 'selected' : '' }}>Layanan Staff</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Rating Kepuasan *</label>
                            <div class="rating-stars" id="rating-container">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}" required>
                            @error('rating') 
                                <div class="text-danger small mt-1">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="judul" class="form-label">Judul Feedback *</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Ringkasan singkat feedback Anda" value="{{ old('judul') }}" required>
                        @error('judul') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                    </div>

                    <div class="mb-4">
                        <label for="detail_feedback" class="form-label">Detail Feedback *</label>
                        <textarea class="form-control @error('detail_feedback') is-invalid @enderror" id="detail_feedback" name="detail_feedback" rows="4" placeholder="Jelaskan detail masalah atau feedback yang ingin Anda sampaikan..." required>{{ old('detail_feedback') }}</textarea>
                        @error('detail_feedback') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                    </div>

                    <div class="mb-4">
                        <label for="saran_perbaikan" class="form-label">Saran Perbaikan (opsional)</label>
                        <textarea class="form-control" id="saran_perbaikan" name="saran_perbaikan" rows="3" placeholder="Berikan saran untuk perbaikan...">{{ old('saran_perbaikan') }}</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary-custom px-4 py-2">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Feedback
                        </button>
                    </div>
                </form>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h4 class="mb-3">Anda perlu login untuk mengirim feedback</h4>
                    <p class="mb-4">Silakan login terlebih dahulu untuk memberikan masukan tentang fasilitas kami.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary-custom">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Login Sekarang
                    </a>
                </div>
                @endauth
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
                <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-tine di Program Studi Teknologi Informasi.</p>
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

        // ===== RATING STARS FUNCTIONALITY =====
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.rating-stars .star');
            const ratingInput = document.getElementById('rating');

            function setRating(value) {
                ratingInput.value = value;
                stars.forEach(star => {
                    star.classList.toggle('selected', star.dataset.value <= value);
                });
            }
            
            if(ratingInput.value) {
                setRating(ratingInput.value);
            }

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    setRating(star.dataset.value);
                });
            });
        });
    </script>
</body>
</html>