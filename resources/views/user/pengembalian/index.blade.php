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

        /* ===== FILTER TABS ===== */
        .filter-tabs {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
            background: white;
            border-radius: var(--border-radius);
            padding: 10px;
            box-shadow: var(--box-shadow);
            justify-content: space-between;
            flex-wrap: wrap;
            overflow-x: auto;
        }

        .filter-tab {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: var(--transition);
            font-weight: 500;
            border-radius: 6px;
            margin-right: 5px;
            flex: 1;
            text-align: center;
            min-width: 120px;
            margin-bottom: 5px;
            color: var(--primary-color);
        }

        .filter-tab.active {
            border-bottom-color: var(--primary-color);
            color: var(--primary-color);
            background-color: rgba(59, 89, 152, 0.1);
        }

        .filter-tab:hover {
            background-color: rgba(59, 89, 152, 0.05);
        }

        /* ====== SEARCH CONTAINER ====== */
        .search-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        /* ====== ICON ====== */
        .search-container i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.95rem;
            pointer-events: none;
        }

        /* ====== INPUT ====== */
        .search-input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background-color: #fff;
            color: #374151;
            font-size: 0.95rem;
            line-height: 1.5;
            height: 42px;
            transition: all 0.25s ease;
            display: block;
        }

        /* ====== FOCUS ====== */
        .search-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        /* ====== HOVER ====== */
        .search-input:hover {
            border-color: #cbd5e1;
        }

        /* ====== PLACEHOLDER ====== */
        .search-input::placeholder {
            color: #9ca3af;
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

            .filter-tabs {
                flex-wrap: wrap;
                overflow-x: auto;
                padding-bottom: 5px;
            }

            .filter-tab {
                flex: 1 0 auto;
                min-width: 120px;
                text-align: center;
                padding: 8px 10px;
                font-size: 0.85rem;
                white-space: nowrap;
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

            /* Responsivitas untuk navbar center */
            .navbar-nav-center {
                justify-content: flex-start;
                margin: 0;
            }
        }

        @media (max-width: 576px) {
            .btn-primary-custom, .btn-success-custom {
                width: 100%;
                padding: 12px;
            }

            .search-container,
            #ruang-filter,
            #tanggal-filter {
                margin-bottom: 15px;
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

        .filter-controls {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-controls>div {
            flex: 1;
            min-width: 200px;
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
                        <a class="nav-link dropdown-toggle active" href="#" id="peminjamanDropdown" role="button"
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
                        <i class="fas fa-list-alt fa-2x text-primary mb-2"></i>
                        <h4 class="mb-1">3</h4>
                        <p class="text-muted mb-0">Total Pengembalian</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <h4 class="mb-1">0</h4>
                        <p class="text-muted mb-0">Disetujui</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                        <h4 class="mb-1">2</h4>
                        <p class="text-muted mb-0">Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                        <h4 class="mb-1">1</h4>
                        <p class="text-muted mb-0">Ditolak</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Filter -->
        <div class="filter-tabs">
            <div class="filter-tab active" data-status="semua">Semua</div>
            <div class="filter-tab" data-status="pending">
                <i class="fas fa-clock me-1"></i> Menunggu
            </div>
            <div class="filter-tab" data-status="verified">
                <i class="fas fa-check-circle me-1"></i> Disetujui
            </div>
            <div class="filter-tab" data-status="rejected">
                <i class="fas fa-times-circle me-1"></i> Ditolak
            </div>
        </div>

        <!-- Card Filter dan Pencarian -->
        <div class="card card-custom">
            <div class="card-body py-3">
                <div class="filter-controls">
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" class="search-input"
                            placeholder="Cari berdasarkan ruang, keperluan, atau peminjam...">
                    </div>

                    <div>
                        <select class="form-select" id="ruang-filter">
                            <option value="semua">Semua Ruang</option>
                            <option value="Lab A">Lab A</option>
                            <option value="Lab B">Lab B</option>
                            <option value="Lab C">Lab C</option>
                            <option value="Ruang Meeting">Ruang Meeting</option>
                            <option value="Ruang Seminar">Ruang Seminar</option>
                        </select>
                    </div>
                    <div>
                        <input type="date" class="form-control" id="tanggal-filter" placeholder="mm/dd/yyyy">
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
                @if($peminjamans->count() > 0)
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
                                @foreach($peminjamans as $p)
                                    <tr class="table-row-highlight" 
                                        data-ruang="{{ $p->ruang }}" 
                                        data-tanggal="{{ $p->tanggal }}">
                                        <td class="fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <i class="fas fa-door-open me-1 text-info"></i>
                                            {{ $p->ruang }}
                                        </td>
                                        <td>
                                            <i class="fas fa-clock me-1 text-success"></i>
                                            {{ $p->waktu_mulai ?? '08:00' }} - {{ $p->waktu_selesai ?? '17:00' }}
                                        </td>
                                        <td class="text-center">
                                            @if($p->proyektor)
                                                <span class="badge bg-success status-badge"><i class="fas fa-check me-1"></i> Ya</span>
                                            @else
                                                <span class="badge bg-secondary status-badge"><i class="fas fa-times me-1"></i> Tidak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate-custom">
                                                {{ $p->keperluan }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-sm ajukan-pengembalian"
                                                data-id="{{ $p->id }}"
                                                data-ruang="{{ $p->ruang }}"
                                                data-tanggal="{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}"
                                                data-proyektor="{{ $p->proyektor ? 'Ya' : 'Tidak' }}">
                                                <i class="fas fa-paper-plane me-1"></i> Ajukan
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
                        <p class="text-muted">Semua peminjaman sudah dikembalikan atau belum disetujui.</p>
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
                @if($pengembalians->count() > 0)
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
                                @foreach($pengembalians as $k)
                                    <tr class="table-row-highlight" 
                                        data-status="{{ $k->status }}" 
                                        data-ruang="{{ $k->peminjaman->ruang }}" 
                                        data-tanggal="{{ $k->peminjaman->tanggal }}">
                                        <td class="fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($k->peminjaman->tanggal)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <i class="fas fa-door-open me-1 text-info"></i>
                                            {{ $k->peminjaman->ruang }}
                                        </td>
                                        <td>
                                            @if($k->tanggal_pengembalian)
                                                <i class="fas fa-calendar-check me-1 text-success"></i>
                                                {{ \Carbon\Carbon::parse($k->tanggal_pengembalian)->format('d M Y') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($k->peminjaman->proyektor)
                                                <span class="badge bg-success status-badge"><i class="fas fa-check me-1"></i> Ya</span>
                                            @else
                                                <span class="badge bg-secondary status-badge"><i class="fas fa-times me-1"></i> Tidak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge status-badge 
                                                @if($k->kondisi_ruang == 'baik') condition-baik 
                                                @elseif($k->kondisi_ruang == 'rusak_ringan') condition-rusak-ringan 
                                                @else condition-rusak-berat @endif">
                                                {{ ucfirst(str_replace('_', ' ', $k->kondisi_ruang)) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($k->status == 'pending')
                                                <span class="badge status-pending">
                                                    <i class="fas fa-clock me-1"></i> Menunggu Verifikasi
                                                </span>
                                            @elseif($k->status == 'verified')
                                                <span class="badge status-disetujui">
                                                    <i class="fas fa-check-circle me-1"></i> Disetujui
                                                </span>
                                            @else
                                                <span class="badge status-ditolak">
                                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate-custom">
                                                {{ $k->catatan ?: '-' }}
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
        <div class="modal-dialog">
            <div class="modal-content modal-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="pengembalianModalLabel">
                        <i class="fas fa-undo me-2"></i> Ajukan Pengembalian
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPengembalian">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="peminjaman_id">
                        <div class="mb-3">
                            <p><strong>Ruang:</strong> <span id="modal-ruang" class="text-primary">-</span></p>
                            <p><strong>Tanggal:</strong> <span id="modal-tanggal" class="text-primary">-</span></p>
                            <p><strong>Proyektor:</strong> <span id="modal-proyektor" class="text-primary">-</span></p>
                        </div>

                        <div class="mb-3">
                            <label for="kondisi_ruang" class="form-label">Kondisi Ruang</label>
                            <select class="form-select" id="kondisi_ruang" required>
                                <option value="">Pilih</option>
                                <option value="baik">Baik</option>
                                <option value="rusak_ringan">Rusak Ringan</option>
                                <option value="rusak_berat">Rusak Berat</option>
                            </select>
                        </div>
                        <div class="mb-3" id="proyektor-section" style="display:none;">
                            <label for="kondisi_proyektor" class="form-label">Kondisi Proyektor</label>
                            <select class="form-select" id="kondisi_proyektor">
                                <option value="">Pilih</option>
                                <option value="baik">Baik</option>
                                <option value="rusak_ringan">Rusak Ringan</option>
                                <option value="rusak_berat">Rusak Berat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (opsional)</label>
                            <textarea id="catatan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="submitPengembalian">Kirim</button>
                    </div>
                </form>
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

        // ===== MODAL FUNCTIONALITY =====
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('pengembalianModal'));
            const buttons = document.querySelectorAll('.ajukan-pengembalian');
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('peminjaman_id').value = btn.dataset.id;
                    document.getElementById('modal-ruang').textContent = btn.dataset.ruang;
                    document.getElementById('modal-tanggal').textContent = btn.dataset.tanggal;
                    document.getElementById('modal-proyektor').textContent = btn.dataset.proyektor;
                    if (btn.dataset.proyektor === 'Ya') {
                        document.getElementById('proyektor-section').style.display = 'block';
                    } else {
                        document.getElementById('proyektor-section').style.display = 'none';
                    }
                    modal.show();
                });
            });

            document.getElementById('submitPengembalian').addEventListener('click', async function() {
                const btn = this;
                const id = document.getElementById('peminjaman_id').value;
                const kondisi_ruang = document.getElementById('kondisi_ruang').value;
                const kondisi_proyektor = document.getElementById('kondisi_proyektor').value;
                const catatan = document.getElementById('catatan').value;

                if (!kondisi_ruang) {
                    alert('Pilih kondisi ruang!');
                    return;
                }

                btn.classList.add('btn-loading');
                btn.disabled = true;

                try {
                    const res = await fetch(`/pengembalian/ajukan/${id}`, {

                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf
                        },
                        body: JSON.stringify({ kondisi_ruang, kondisi_proyektor, catatan })
                    });
                    const data = await res.json();

                    if (data.success) {
                        alert(data.message);
                        modal.hide();
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        alert(data.message || 'Terjadi kesalahan');
                    }
                } catch (err) {
                    alert('Gagal mengirim pengembalian.');
                } finally {
                    btn.classList.remove('btn-loading');
                    btn.disabled = false;
                }
            });
        });

        // ===== FILTER TABEL =====
        function filterTable() {
            const searchText = document.querySelector('.search-input').value.toLowerCase();
            const activeTab = document.querySelector('.filter-tab.active');
            const statusFilter = activeTab ? activeTab.getAttribute('data-status') : 'semua';
            const ruangFilter = document.getElementById('ruang-filter').value;
            const tanggalFilter = document.getElementById('tanggal-filter').value;

            // Filter untuk tabel peminjaman aktif
            const activeRows = document.querySelectorAll('.card-custom:first-child tbody tr');
            activeRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowRuang = row.getAttribute('data-ruang');
                const rowTanggal = row.getAttribute('data-tanggal');

                const textMatch = text.includes(searchText);
                const ruangMatch = ruangFilter === 'semua' || rowRuang === ruangFilter;
                const tanggalMatch = !tanggalFilter || rowTanggal === tanggalFilter;

                if (textMatch && ruangMatch && tanggalMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter untuk tabel riwayat pengembalian
            const historyRows = document.querySelectorAll('.card-custom:last-child tbody tr');
            historyRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowStatus = row.getAttribute('data-status');
                const rowRuang = row.getAttribute('data-ruang');
                const rowTanggal = row.getAttribute('data-tanggal');

                const textMatch = text.includes(searchText);
                const statusMatch = statusFilter === 'semua' || rowStatus === statusFilter;
                const ruangMatch = ruangFilter === 'semua' || rowRuang === ruangFilter;
                const tanggalMatch = !tanggalFilter || rowTanggal === tanggalFilter;

                if (textMatch && statusMatch && ruangMatch && tanggalMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // ===== INISIALISASI EVENT LISTENER =====
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk pencarian
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('keyup', filterTable);

            // Event listener untuk filter tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    // Hapus kelas active dari semua tab
                    document.querySelectorAll('.filter-tab').forEach(t => {
                        t.classList.remove('active');
                    });

                    // Tambah kelas active ke tab yang diklik
                    this.classList.add('active');

                    filterTable();
                });
            });

            // Event listener untuk filter ruang
            document.getElementById('ruang-filter').addEventListener('change', filterTable);

            // Event listener untuk filter tanggal
            document.getElementById('tanggal-filter').addEventListener('change', filterTable);

            // Inisialisasi filter saat halaman dimuat
            filterTable();
        });
    </script>
</body>
</html>