<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian - Sistem Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* ===== NAVBAR ===== */
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
            position: relative;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after, 
        .navbar-nav .nav-link.active::after {
            width: 70%;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
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

        .card-header-custom {
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 1rem 1.5rem;
            border-bottom: none;
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

        .btn-action {
            padding: 6px 10px;
            border-radius: 6px;
            margin: 0 2px;
            font-size: 0.85rem;
            border: none;
            transition: var(--transition);
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        /* ===== TABEL ===== */
        .table-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .table-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table th {
            border: none;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .table-hover tbody tr {
            transition: background-color 0.3s;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
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

        .status-belum_dikembalikan {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .status-dikembalikan {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .status-terlambat {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .condition-baik {
            background-color: #d4edda;
            color: #155724;
        }

        .condition-rusak-ringan {
            background-color: #fff3cd;
            color: #856404;
        }

        .condition-rusak-berat {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* ===== STATE KOSONG ===== */
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 60px;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        /* ===== MODAL ===== */
        .modal-custom {
            border-radius: var(--border-radius);
            border: none;
        }

        .modal-header-custom {
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            padding: 1rem 1.5rem;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-close-white {
            filter: invert(1);
        }

        /* ===== LOADING STATE ===== */
        .loading-spinner {
            display: none;
        }

        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s ease infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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

        /* ===== FORM ===== */
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.15);
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

            .table-container {
                overflow-x: auto;
                border-radius: 8px;
            }

            .table {
                min-width: 800px;
            }

            .btn-action {
                margin-bottom: 5px;
                display: inline-block;
                width: auto;
                margin: 2px;
            }

            .action-buttons {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .table th,
            .table td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }

            .status-badge {
                font-size: 0.7rem;
                padding: 4px 8px;
                min-width: 80px;
            }

            .card-body {
                padding: 15px;
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

            /* Responsivitas untuk sub-navigasi */
            .sub-nav {
                top: 56px; /* Sesuaikan dengan tinggi navbar mobile */
            }

            .sub-nav-links {
                gap: 0.5rem;
            }

            .sub-nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .btn-primary-custom, .btn-success-custom {
                width: 100%;
                padding: 12px;
            }

            /* Responsivitas untuk sub-navigasi */
            .sub-nav-links {
                justify-content: center;
            }

            .sub-nav-link {
                flex: 1;
                min-width: 140px;
                justify-content: center;
                text-align: center;
            }
        }

        /* ===== PERBAIKAN TAMBAHAN ===== */
        .table-row-highlight {
            transition: background-color 0.2s ease;
        }

        .table-row-highlight:hover {
            background-color: rgba(59, 89, 152, 0.05);
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
        }

        .table-responsive-custom {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .no-data-row td {
            padding: 30px !important;
            text-align: center;
        }

        .text-truncate-custom {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
        }
    </style>
</head>

<body>
    <!-- ===== NAVBAR UTAMA ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i>SarPras TI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Kalender Perkuliahan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.peminjaman.index') }}">
                            Daftar Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Tentang
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== SUB NAVIGASI ===== -->
    <div class="sub-nav">
        <div class="sub-nav-container">
            <div class="sub-nav-links">
                <a href="{{ route('user.peminjaman.create') }}" class="sub-nav-link">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Peminjaman
                </a>
                <a href="{{ route('user.pengembalian.index') }}" class="sub-nav-link active">
                    <i class="fas fa-undo"></i>
                    Pengembalian
                </a>
                <a href="{{ route('user.peminjaman.riwayat') }}" class="sub-nav-link">
                    <i class="fas fa-history"></i>
                    Riwayat
                </a>
                <a href="{{ route('user.feedback.create') }}" class="sub-nav-link">
                    <i class="fas fa-comment-dots"></i>
                    Feedback
                </a>
            </div>
        </div>
    </div>

    <!-- ===== KONTEN UTAMA ===== -->
    <div class="container main-content mt-4">
        <!-- Header dan Kembali ke Daftar -->
        <div class="page-header">
            <div>
                <h1 class="page-title"><i class="fa-solid fa-undo"></i> Pengembalian Peminjaman</h1>
                <p class="page-description">Ajukan pengembalian ruangan dan proyektor yang telah digunakan</p>
            </div>
            <a href="{{ route('user.peminjaman.index') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Alert Notifikasi -->
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

        <!-- Statistik Ringkas -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                        <h4 class="mb-1">{{ $peminjamans->count() ?? 0 }}</h4>
                        <p class="text-muted mb-0">Peminjaman Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <h4 class="mb-1">{{ $pendingReturns ?? 0 }}</h4>
                        <p class="text-muted mb-0">Menunggu Pengembalian</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-undo fa-2x text-info mb-2"></i>
                        <h4 class="mb-1">{{ $returnedCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Telah Dikembalikan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                        <h4 class="mb-1">{{ $overdueCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Terlambat</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman Aktif yang Bisa Dikembalikan -->
        <div class="card card-custom mb-4">
            <div class="card-header card-header-custom">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i> Peminjaman Aktif yang Dapat Dikembalikan</h5>
            </div>
            <div class="card-body">
                @if(isset($peminjamans) && $peminjamans->count() > 0)
                    <div class="table-responsive table-responsive-custom">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Tanggal</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
                                    <th width="100" class="text-center">Proyektor</th>
                                    <th>Keperluan</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $peminjaman)
                                    <tr class="table-row-highlight">
                                        <td class="fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <i class="fas fa-door-open me-1 text-info"></i>
                                            {{ $peminjaman->ruang }}
                                        </td>
                                        <td>
                                            <i class="fas fa-clock me-1 text-success"></i>
                                            {{ $peminjaman->waktu_mulai ?? '08:00' }} - {{ $peminjaman->waktu_selesai ?? '17:00' }}
                                        </td>
                                        <td class="text-center">
                                            @if($peminjaman->proyektor)
                                                <span class="badge bg-success status-badge"><i class="fas fa-check me-1"></i> Ya</span>
                                            @else
                                                <span class="badge bg-secondary status-badge"><i class="fas fa-times me-1"></i> Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate-custom">
                                                {{ \Illuminate\Support\Str::limit($peminjaman->keperluan, 50) }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" 
                                                    class="btn btn-success btn-sm ajukan-pengembalian"
                                                    data-peminjaman-id="{{ $peminjaman->id }}"
                                                    data-ruang="{{ $peminjaman->ruang }}"
                                                    data-tanggal="{{ \Carbon\Carbon::parse($peminjaman->tanggal)->format('d M Y') }}"
                                                    data-proyektor="{{ $peminjaman->proyektor ? 'Ya' : 'Tidak' }}">
                                                <i class="fas fa-undo me-1"></i> Ajukan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <h5 class="mt-3">Tidak ada peminjaman aktif</h5>
                        <p class="text-muted">Semua peminjaman sudah dikembalikan atau belum ada yang disetujui</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Riwayat Pengembalian -->
        <div class="card card-custom">
            <div class="card-header card-header-custom" style="background-color: #17a2b8;">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i> Riwayat Pengembalian</h5>
            </div>
            <div class="card-body">
                @if(isset($pengembalians) && $pengembalians->count() > 0)
                    <div class="table-responsive table-responsive-custom">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Ruang</th>
                                    <th>Tanggal Kembali</th>
                                    <th width="100" class="text-center">Proyektor</th>
                                    <th width="120" class="text-center">Kondisi Ruang</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengembalians as $pengembalian)
                                    <tr class="table-row-highlight">
                                        <td class="fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <i class="fas fa-door-open me-1 text-info"></i>
                                            {{ $pengembalian->peminjaman->ruang }}
                                        </td>
                                        <td>
                                            @if($pengembalian->tanggal_pengembalian)
                                                <i class="fas fa-calendar-check me-1 text-success"></i>
                                                {{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($pengembalian->peminjaman->proyektor)
                                                <span class="badge bg-success status-badge"><i class="fas fa-check me-1"></i> Ya</span>
                                            @else
                                                <span class="badge bg-secondary status-badge"><i class="fas fa-times me-1"></i> Tidak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($pengembalian->kondisi_ruang)
                                                @if($pengembalian->kondisi_ruang == 'baik')
                                                    <span class="badge condition-baik status-badge">Baik</span>
                                                @elseif($pengembalian->kondisi_ruang == 'rusak_ringan')
                                                    <span class="badge condition-rusak-ringan status-badge">Rusak Ringan</span>
                                                @else
                                                    <span class="badge condition-rusak-berat status-badge">Rusak Berat</span>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($pengembalian->status == 'dikembalikan' || $pengembalian->status == 'selesai')
                                                <span class="badge status-dikembalikan">
                                                    <i class="fas fa-check-circle me-1"></i> Dikembalikan
                                                </span>
                                            @elseif($pengembalian->status == 'terlambat')
                                                <span class="badge status-terlambat">
                                                    <i class="fas fa-exclamation-triangle me-1"></i> Terlambat
                                                </span>
                                            @elseif($pengembalian->status == 'pending')
                                                <span class="badge status-pending">
                                                    <i class="fas fa-clock me-1"></i> Menunggu Verifikasi
                                                </span>
                                            @else
                                                <span class="badge status-belum_dikembalikan">
                                                    <i class="fas fa-times-circle me-1"></i> Belum Dikembalikan
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate-custom">
                                                {{ $pengembalian->catatan ? \Illuminate\Support\Str::limit($pengembalian->catatan, 30) : '-' }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5 class="mt-3">Belum ada riwayat pengembalian</h5>
                        <p class="text-muted">Riwayat pengembalian akan muncul di sini setelah Anda mengajukan pengembalian</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Back to top button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Modal Pengajuan Pengembalian -->
    <div class="modal fade" id="pengembalianModal" tabindex="-1" aria-labelledby="pengembalianModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="pengembalianModalLabel">
                        <i class="fas fa-undo me-2"></i> Ajukan Pengembalian
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Ruang:</strong>
                            <p id="modal-ruang" class="text-primary">-</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Pinjam:</strong>
                            <p id="modal-tanggal" class="text-primary">-</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Proyektor:</strong>
                            <p id="modal-proyektor" class="text-primary">-</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Kembali:</strong>
                            <p class="text-success">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                        </div>
                    </div>
                    
                    <form id="form-pengembalian">
                        @csrf
                        <input type="hidden" id="peminjaman_id" name="peminjaman_id">
                        
                        <div class="mb-3">
                            <label for="kondisi_ruang" class="form-label">Kondisi Ruang setelah digunakan:</label>
                            <select class="form-select" id="kondisi_ruang" name="kondisi_ruang" required>
                                <option value="">Pilih Kondisi Ruang</option>
                                <option value="baik">Baik - Bersih dan rapi</option>
                                <option value="rusak_ringan">Rusak Ringan - Ada sedikit kotoran/berantakan</option>
                                <option value="rusak_berat">Rusak Berat - Ada kerusakan atau sangat kotor</option>
                            </select>
                        </div>

                        <div class="mb-3" id="proyektor-section" style="display: none;">
                            <label for="kondisi_proyektor" class="form-label">Kondisi Proyektor:</label>
                            <select class="form-select" id="kondisi_proyektor" name="kondisi_proyektor">
                                <option value="">Pilih Kondisi Proyektor</option>
                                <option value="baik">Baik - Berfungsi normal</option>
                                <option value="rusak_ringan">Rusak Ringan - Ada masalah kecil</option>
                                <option value="rusak_berat">Rusak Berat - Tidak berfungsi/rusak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Tambahan (opsional):</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="submit-pengembalian">
                        <i class="fas fa-paper-plane me-1"></i> Ajukan Pengembalian
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('pengembalianModal'));
            const ajukanButtons = document.querySelectorAll('.ajukan-pengembalian');
            const proyektorSection = document.getElementById('proyektor-section');
            const submitButton = document.getElementById('submit-pengembalian');
            
            // Cache DOM elements
            const modalRuang = document.getElementById('modal-ruang');
            const modalTanggal = document.getElementById('modal-tanggal');
            const modalProyektor = document.getElementById('modal-proyektor');
            const peminjamanIdInput = document.getElementById('peminjaman_id');
            const kondisiProyektorSelect = document.getElementById('kondisi_proyektor');
            const form = document.getElementById('form-pengembalian');
            
            // Fungsi untuk mengajukan pengembalian
            async function ajukanPengembalian(formData) {
                const peminjamanId = peminjamanIdInput.value;
                
                try {
                    const response = await fetch(`/user/pengembalian/ajukan/${peminjamanId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(Object.fromEntries(formData))
                    });
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const data = await response.json();
                    return data;
                } catch (error) {
                    console.error('Error:', error);
                    throw error;
                }
            }
            
            ajukanButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const peminjamanId = this.getAttribute('data-peminjaman-id');
                    const ruang = this.getAttribute('data-ruang');
                    const tanggal = this.getAttribute('data-tanggal');
                    const proyektor = this.getAttribute('data-proyektor');
                    
                    // Set data ke modal
                    modalRuang.textContent = ruang;
                    modalTanggal.textContent = tanggal;
                    modalProyektor.textContent = proyektor;
                    peminjamanIdInput.value = peminjamanId;
                    
                    // Tampilkan/sembunyikan section proyektor
                    if (proyektor === 'Ya') {
                        proyektorSection.style.display = 'block';
                        kondisiProyektorSelect.setAttribute('required', 'required');
                    } else {
                        proyektorSection.style.display = 'none';
                        kondisiProyektorSelect.removeAttribute('required');
                        kondisiProyektorSelect.value = ''; // Reset value
                    }
                    
                    // Reset form
                    form.reset();
                    
                    // Tampilkan modal
                    modal.show();
                });
            });
            
            // Handle submit pengembalian
            submitButton.addEventListener('click', async function() {
                if (form.checkValidity()) {
                    // Tampilkan loading state
                    this.classList.add('btn-loading');
                    this.disabled = true;
                    
                    try {
                        // Kirim data via AJAX
                        const formData = new FormData(form);
                        
                        // Timeout untuk request (5 detik maksimal)
                        const timeoutPromise = new Promise((_, reject) => 
                            setTimeout(() => reject(new Error('Request timeout')), 5000)
                        );
                        
                        const ajukanPromise = ajukanPengembalian(formData);
                        
                        // Race antara request dan timeout
                        const data = await Promise.race([ajukanPromise, timeoutPromise]);
                        
                        if (data.success) {
                            showAlert('success', data.message || 'Pengembalian berhasil diajukan!');
                            modal.hide();
                            
                            // Redirect setelah 1.5 detik (lebih cepat)
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showAlert('danger', error.message || 'Terjadi kesalahan saat mengajukan pengembalian');
                        resetSubmitButton();
                    }
                    
                } else {
                    form.reportValidity();
                }
            });

            // Reset modal ketika ditutup
            document.getElementById('pengembalianModal').addEventListener('hidden.bs.modal', function () {
                resetSubmitButton();
                form.reset();
            });

            // Fungsi untuk menampilkan alert
            function showAlert(type, message) {
                // Hapus alert sebelumnya
                const existingAlerts = document.querySelectorAll('.alert');
                existingAlerts.forEach(alert => alert.remove());
                
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i> 
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                // Tambahkan alert di bagian atas container
                const container = document.querySelector('.container');
                const firstCard = document.querySelector('.card-custom');
                container.insertBefore(alertDiv, firstCard);
                
                // Auto remove alert setelah 5 detik
                setTimeout(() => {
                    if (alertDiv.parentElement) {
                        alertDiv.remove();
                    }
                }, 5000);
            }

            // Fungsi untuk reset button submit
            function resetSubmitButton() {
                submitButton.classList.remove('btn-loading');
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Ajukan Pengembalian';
            }
        });
    </script>
</body>
</html>