<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Pengguna - Sistem Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
            --border-radius: 12px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            color: #333;
            line-height: 1.6;
            scroll-behavior: smooth;
        }

        /* ===== NAVBAR STYLES ===== */
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

        .navbar-nav-center {
            display: flex;
            justify-content: center;
            flex-grow: 1;
            margin: 0 auto;
        }

        .navbar-nav-center .nav-item {
            margin: 0 0.5rem;
        }

        .navbar-nav .nav-link.dropdown-toggle {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-nav .nav-link.dropdown-toggle::after {
            display: none !important;
        }

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

        .dropdown-menu a,
        .dropdown-menu a:hover,
        .dropdown-menu a:focus,
        .dropdown-menu a:active,
        .dropdown-menu a:visited {
            text-decoration: none !important;
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

        /* ===== BREADCRUMB ===== */
        .breadcrumb-custom {
            background-color: white;
            padding: 1.2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .breadcrumb-item-custom {
            font-size: 0.9rem;
            color: var(--primary-color);
        }

        .breadcrumb-item-custom.active {
            color: #6c757d;
            font-weight: 500;
        }

        .breadcrumb-item-custom a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-item-custom a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 2rem 0;
            min-height: calc(100vh - 300px);
        }

        /* ===== CARD SETTINGS ===== */
        .card-settings {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .card-settings:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .card-header-settings {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.8rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }

        .card-header-settings::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,218.7C672,224,768,160,864,138.7C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center;
        }

        .card-header-settings h4 {
            position: relative;
            z-index: 1;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.8rem;
        }

        .card-header-settings h4 i {
            font-size: 2rem;
        }

        /* ===== TABS STYLES ===== */
        .settings-tabs {
            background-color: #f8f9fa;
            padding: 0 1.8rem;
            border-bottom: 1px solid #dee2e6;
        }

        .nav-tabs-custom {
            border: none;
            gap: 0.5rem;
        }

        .nav-tabs-custom .nav-item {
            margin-bottom: 0;
        }

        .nav-tabs-custom .nav-link {
            color: #6c757d;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
        }

        .nav-tabs-custom .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(59, 89, 152, 0.05);
            border-bottom: 3px solid rgba(59, 89, 152, 0.3);
        }

        .nav-tabs-custom .nav-link.active {
            color: var(--primary-color);
            background-color: white;
            border-bottom: 3px solid var(--primary-color);
            border-radius: 0;
        }

        /* ===== TAB CONTENT ===== */
        .tab-content-custom {
            padding: 2.5rem;
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #eaeaea;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.4rem;
        }

        .section-title i {
            font-size: 1.3rem;
        }

        /* ===== SETTINGS CARD ===== */
        .settings-group-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.8rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
            transition: var(--transition);
        }

        .settings-group-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 3px 10px rgba(59, 89, 152, 0.1);
        }

        .settings-group-card h6 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        .settings-group-card h6 i {
            color: var(--accent-color);
        }

        /* ===== FORM CONTROLS ===== */
        .form-label-settings {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label-settings i {
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        .form-control-settings {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: white;
        }

        .form-control-settings:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 89, 152, 0.15);
            background-color: white;
        }

        .form-control-settings:disabled {
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }

        /* ===== FORM SWITCH ===== */
        .form-check-switch {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .form-check-switch:hover {
            background-color: rgba(59, 89, 152, 0.05);
        }

        .form-check-input {
            width: 3em;
            height: 1.5em;
            margin-right: 0.75rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(59, 89, 152, 0.25);
        }

        .form-check-label {
            font-weight: 500;
            color: #495057;
            flex: 1;
        }

        /* ===== BUTTONS ===== */
        .btn-settings-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 1rem;
        }

        .btn-settings-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 89, 152, 0.25);
            color: white;
        }

        .btn-settings-secondary {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-settings-secondary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* ===== ALERTS ===== */
        .alert-settings {
            border-radius: 10px;
            border: none;
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-settings i {
            font-size: 1.2rem;
            margin-top: 0.2rem;
        }

        .alert-settings-success {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid var(--success-color);
            color: #155724;
        }

        .alert-settings-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid var(--danger-color);
            color: #721c24;
        }

        .alert-settings-info {
            background-color: rgba(23, 162, 184, 0.1);
            border-left: 4px solid var(--info-color);
            color: #0c5460;
        }

        .alert-settings-warning {
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 4px solid var(--warning-color);
            color: #856404;
        }

        /* ===== FOOTER ===== */
        .footer {
            background-color: #2d3748;
            color: white;
            padding: 50px 0 25px;
            margin-top: 3rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
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
            margin: 40px auto 0;
            padding: 25px 20px 0;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ===== UTILITIES ===== */
        .text-muted-light {
            color: #6c757d !important;
            font-size: 0.9rem;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .icon-circle-primary {
            background-color: rgba(59, 89, 152, 0.1);
            color: var(--primary-color);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .nav-tabs-custom .nav-link {
                padding: 1rem 1.2rem;
                font-size: 0.95rem;
            }

            .tab-content-custom {
                padding: 2rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem 0;
            }

            .card-header-settings {
                padding: 1.5rem;
            }

            .card-header-settings h4 {
                font-size: 1.5rem;
            }

            .settings-tabs {
                padding: 0 1rem;
            }

            .nav-tabs-custom {
                flex-direction: column;
            }

            .nav-tabs-custom .nav-link {
                justify-content: flex-start;
                border-bottom: 2px solid transparent;
                border-left: 3px solid transparent;
            }

            .nav-tabs-custom .nav-link.active {
                border-bottom: 2px solid transparent;
                border-left: 3px solid var(--primary-color);
            }

            .tab-content-custom {
                padding: 1.5rem;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 576px) {
            .tab-content-custom {
                padding: 1.2rem;
            }

            .settings-group-card {
                padding: 1.2rem;
            }

            .form-check-switch {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .form-check-input {
                margin-right: 0;
            }
        }
    </style>
</head>

<body>
    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
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
                        <a class="nav-link" href="{{ route('home') }}">
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
                                {{ Auth::user()->display_name ?? Auth::user()->name }}
                                <span class="custom-arrow">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="userDropdown">
                                <li class="dropdown-header-custom">Masuk sebagai</li>
                                <li class="dropdown-header-custom fw-bold">
                                    {{ Auth::user()->display_name ?? Auth::user()->name }}</li>
                                <li>
                                    <hr class="dropdown-divider-custom">
                                </li>
                                <li>
                                    <a class="dropdown-item-custom" href="{{ route('user.profile.index') }}">
                                        <i class="fas fa-user fa-fw me-2"></i> Pengaturan Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item-custom" href="{{ route('user.peminjaman.riwayat') }}">
                                        <i class="fas fa-history fa-fw me-2"></i> Riwayat Peminjaman
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item-custom active" href="{{ route('user.settings.index') }}">
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

    <!-- ===== BREADCRUMB ===== -->
    <div class="breadcrumb-custom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item breadcrumb-item-custom">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item breadcrumb-item-custom active" aria-current="page">
                        <i class="fas fa-cog me-1"></i> Pengaturan Pengguna
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="container main-content">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Alerts -->
                @if (session('success'))
                    <div class="alert alert-settings-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-settings-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Main Settings Card -->
                <div class="card card-settings">
                    <div class="card-header-settings">
                        <h4><i class="fas fa-cog"></i> Pengaturan Pengguna</h4>
                    </div>

                    <!-- Settings Tabs -->
                    <div class="settings-tabs">
                        <ul class="nav nav-tabs nav-tabs-custom" id="settingsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="account-tab" data-bs-toggle="tab"
                                    data-bs-target="#account" type="button" role="tab" aria-controls="account"
                                    aria-selected="true">
                                    <i class="fas fa-user-cog"></i> Akun
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="notifications-tab" data-bs-toggle="tab"
                                    data-bs-target="#notifications" type="button" role="tab"
                                    aria-controls="notifications" aria-selected="false">
                                    <i class="fas fa-bell"></i> Notifikasi
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab"
                                    data-bs-target="#security" type="button" role="tab"
                                    aria-controls="security" aria-selected="false">
                                    <i class="fas fa-shield-alt"></i> Keamanan
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <form action="{{ route('user.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="tab-content tab-content-custom" id="settingsTabContent">

                            <!-- Account Tab -->
                            <div class="tab-pane fade show active" id="account" role="tabpanel"
                                aria-labelledby="account-tab">
                                <h5 class="section-title"><i class="fas fa-user-circle"></i> Informasi Akun</h5>
                                <p class="text-muted-light mb-4">Untuk mengubah informasi profil Anda (nama, email,
                                    nomor telepon) atau kata sandi, silakan kunjungi halaman <a
                                        href="{{ route('user.profile.index') }}" class="text-primary">Pengaturan
                                        Profil</a>.</p>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label-settings">
                                            <i class="fas fa-user"></i> Nama Lengkap
                                        </label>
                                        <input type="text" class="form-control form-control-settings"
                                            id="name" value="{{ $user->name }}" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label-settings">
                                            <i class="fas fa-envelope"></i> Alamat Email
                                        </label>
                                        <input type="email" class="form-control form-control-settings"
                                            id="email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    <!-- Button moved to footer -->
                                </div>
                            </div>

                            <!-- Notifications Tab -->
                            <div class="tab-pane fade" id="notifications" role="tabpanel"
                                aria-labelledby="notifications-tab">
                                <h5 class="section-title"><i class="fas fa-bell"></i> Preferensi Notifikasi</h5>
                                <p class="text-muted-light mb-4">Pilih jenis notifikasi yang ingin Anda terima.</p>

                                <!-- Email Notifications -->
                                <div class="settings-group-card">
                                    <h6><i class="fas fa-envelope"></i> Notifikasi Email</h6>
                                    <div class="form-check-switch">
                                        <input class="form-check-input" type="checkbox" id="emailStatusUpdates"
                                            name="email_status_updates"
                                            {{ $user->notification_preferences['email']['status_updates'] ?? true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="emailStatusUpdates">
                                            <strong>Pembaruan Status Peminjaman</strong>
                                            <small class="text-muted-light d-block">Notifikasi saat peminjaman
                                                disetujui, ditolak, atau dibatalkan</small>
                                        </label>
                                    </div>
                                    <div class="form-check-switch">
                                        <input class="form-check-input" type="checkbox" id="emailReminders"
                                            name="email_reminders"
                                            {{ $user->notification_preferences['email']['reminders'] ?? true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="emailReminders">
                                            <strong>Pengingat Peminjaman</strong>
                                            <small class="text-muted-light d-block">Notifikasi sebelum jadwal
                                                peminjaman dimulai</small>
                                        </label>
                                    </div>
                                    <div class="form-check-switch">
                                        <input class="form-check-input" type="checkbox" id="emailPromotions"
                                            name="email_promotions"
                                            {{ $user->notification_preferences['email']['promotions'] ?? true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="emailPromotions">
                                            <strong>Promo & Update Sistem</strong>
                                            <small class="text-muted-light d-block">Informasi tentang fitur baru dan
                                                promosi</small>
                                        </label>
                                    </div>
                                </div>

                                <!-- WhatsApp Notifications -->
                                <div class="settings-group-card">
                                    <h6><i class="fab fa-whatsapp"></i> Notifikasi WhatsApp</h6>

                                    @if ($user->no_hp)
                                        <div class="alert alert-settings-info mb-3">
                                            <i class="fas fa-info-circle"></i>
                                            <div>
                                                Notifikasi akan dikirim ke nomor: <strong>{{ $user->no_hp }}</strong>
                                                <br>
                                                <small>Ubah nomor telepon di <a
                                                        href="{{ route('user.profile.index') }}"
                                                        class="alert-link">Pengaturan Profil</a></small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-settings-warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <div>
                                                Anda belum menambahkan nomor telepon.
                                                <br>
                                                <small>Tambahkan nomor telepon di <a
                                                        href="{{ route('user.profile.index') }}"
                                                        class="alert-link">Pengaturan Profil</a> untuk mengaktifkan
                                                    notifikasi WhatsApp.</small>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- System Notifications -->
                                <div class="settings-group-card">
                                    <h6><i class="fas fa-desktop"></i> Notifikasi Sistem</h6>
                                    <div class="form-check-switch">
                                        <input class="form-check-input" type="checkbox" id="systemBrowser"
                                            name="system_browser"
                                            {{ $user->notification_preferences['system']['browser'] ?? true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="systemBrowser">
                                            <strong>Browser Notifications</strong>
                                            <small class="text-muted-light d-block">Notifikasi pop-up di
                                                browser</small>
                                        </label>
                                    </div>
                                    <div class="form-check-switch">
                                        <input class="form-check-input" type="checkbox" id="systemSound"
                                            name="system_sound"
                                            {{ $user->notification_preferences['system']['sound'] ?? false ? 'checked' : '' }}>
                                        <label class="form-check-label" for="systemSound">
                                            <strong>Suara Notifikasi</strong>
                                            <small class="text-muted-light d-block">Efek suara saat notifikasi
                                                masuk</small>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Tab -->
                            <div class="tab-pane fade" id="security" role="tabpanel"
                                aria-labelledby="security-tab">
                                <h5 class="section-title"><i class="fas fa-shield-alt"></i> Pengaturan Keamanan</h5>
                                <p class="text-muted-light mb-4">Kelola pengaturan keamanan akun Anda.</p>

                                <!-- Two-Factor Authentication -->
                                <div class="settings-group-card">
                                    <h6><i class="fas fa-lock"></i> Autentikasi Dua Faktor (2FA)</h6>
                                    <p class="text-muted-light mb-3">Tambahkan lapisan keamanan ekstra ke akun Anda
                                        dengan 2FA.</p>

                                    @if ($user->two_factor_enabled ?? false)
                                        <div class="alert alert-settings-success mb-3">
                                            <i class="fas fa-check-circle"></i>
                                            <div>
                                                <strong>2FA Aktif</strong>
                                                <br>
                                                <small>Akun Anda dilindungi dengan autentikasi dua faktor.</small>
                                            </div>
                                        </div>
                                        <div class="form-check-switch">
                                            <input class="form-check-input" type="checkbox" id="twoFactorEnabled"
                                                name="two_factor_enabled" checked>
                                            <label class="form-check-label" for="twoFactorEnabled">
                                                <strong>Nonaktifkan 2FA</strong>
                                                <small class="text-muted-light d-block">Matikan autentikasi dua
                                                    faktor</small>
                                            </label>
                                        </div>
                                    @else
                                        <div class="alert alert-settings-warning mb-3">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <div>
                                                <strong>2FA Tidak Aktif</strong>
                                                <br>
                                                <small>Aktifkan untuk keamanan akun yang lebih baik.</small>
                                            </div>
                                        </div>
                                        <div class="form-check-switch">
                                            <input class="form-check-input" type="checkbox" id="twoFactorEnabled"
                                                name="two_factor_enabled">
                                            <label class="form-check-label" for="twoFactorEnabled">
                                                <strong>Aktifkan 2FA</strong>
                                                <small class="text-muted-light d-block">Aktifkan autentikasi dua
                                                    faktor</small>
                                            </label>
                                        </div>
                                    @endif

                                    <div class="mt-3">
                                        <button type="button" class="btn btn-settings-secondary btn-sm" disabled>
                                            <i class="fas fa-qrcode me-1"></i> Kelola 2FA (Segera Hadir)
                                        </button>
                                    </div>
                                </div>

                                <!-- Active Sessions -->
                                <div class="settings-group-card">
                                    <h6><i class="fas fa-desktop"></i> Sesi Aktif</h6>
                                    <p class="text-muted-light mb-3">Kelola perangkat yang sedang login ke akun Anda.
                                    </p>
                                    <div class="alert alert-settings-info mb-3">
                                        <i class="fas fa-info-circle"></i>
                                        <div>
                                            <strong>Sesi Aktif Saat Ini</strong>
                                            <br>
                                            <small>Anda login dari perangkat ini.</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-settings-secondary btn-sm" disabled>
                                        <i class="fas fa-sign-out-alt me-1"></i> Lihat Semua Sesi (Segera Hadir)
                                    </button>
                                </div>

                                <!-- Security History -->
                                <div class="settings-group-card">
                                    <h6><i class="fas fa-history"></i> Riwayat Keamanan</h6>
                                    <p class="text-muted-light mb-3">Pantau aktivitas keamanan akun Anda.</p>
                                    <button type="button" class="btn btn-settings-secondary btn-sm" disabled>
                                        <i class="fas fa-download me-1"></i> Unduh Riwayat (Segera Hadir)
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons Footer -->
                        <div class="card-footer bg-light p-3 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('user.profile.index') }}" class="btn btn-settings-secondary">
                                    <i class="fas fa-edit me-2"></i> Edit Profil Lengkap
                                </a>
                                <button type="submit" class="btn btn-settings-primary px-5">
                                    <i class="fas fa-save me-2"></i> Simpan Pengaturan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Platform digital untuk mengelola dan memantau ketersediaan ruangan serta proyektor secara real-time
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
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
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

        // Tab Persistence
        document.addEventListener('DOMContentLoaded', function() {
            const settingsTab = new bootstrap.Tab(document.querySelector('#settingsTab button.active'));
            settingsTab.show();

            const triggerTabList = document.querySelectorAll('#settingsTab button');
            triggerTabList.forEach(triggerEl => {
                const tabTrigger = new bootstrap.Tab(triggerEl);
                triggerEl.addEventListener('click', event => {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });

            // Save active tab to localStorage
            document.querySelectorAll('#settingsTab button').forEach(tabButton => {
                tabButton.addEventListener('shown.bs.tab', function(event) {
                    localStorage.setItem('activeSettingsTab', event.target.id);
                });
            });

            // Restore active tab from localStorage
            const activeTab = localStorage.getItem('activeSettingsTab');
            if (activeTab) {
                const tabTrigger = document.querySelector(`#${activeTab}`);
                if (tabTrigger) {
                    const bsTab = new bootstrap.Tab(tabTrigger);
                    bsTab.show();
                }
            }
        });

        // Form validation for WhatsApp notifications
        document.querySelector('form').addEventListener('submit', function(e) {
            const whatsappStatus = document.getElementById('whatsappStatusUpdates');
            const whatsappReminders = document.getElementById('whatsappReminders');

            if ((whatsappStatus && whatsappStatus.checked) || (whatsappReminders && whatsappReminders.checked)) {
                const phoneNumber = "{{ $user->no_hp }}";
                if (!phoneNumber) {
                    e.preventDefault();
                    alert(
                        'Anda perlu menambahkan nomor telepon di Pengaturan Profil untuk mengaktifkan notifikasi WhatsApp.');
                    document.getElementById('notifications-tab').click();
                    return false;
                }
            }

            // Show saving message
            const saveButton = this.querySelector('button[type="submit"]');
            const originalText = saveButton.innerHTML;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
            saveButton.disabled = true;

            setTimeout(() => {
                saveButton.innerHTML = originalText;
                saveButton.disabled = false;
            }, 1500);
        });

        // Smooth scroll to alerts
        document.querySelectorAll('.alert').forEach(alert => {
            alert.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        });
    </script>
</body>

</html>
