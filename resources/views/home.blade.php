<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Sistem Peminjaman Sarana Prasarana</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
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
        
        /* ===== NAVBAR STYLES YANG DIPERBAIKI ===== */
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

        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3.5rem 0;
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
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
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .hero-content h1 {
            animation: fadeInDown 1s ease;
        }
        
        .hero-content p {
            animation: fadeInUp 1s ease;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 2rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* ===== FILTER SECTION ===== */
        .filter-section {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-bottom: 2.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .filter-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .filter-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        
        .filter-table th {
            text-align: left;
            padding: 0.8rem 1rem 0.8rem 0;
            font-weight: 600;
            color: var(--primary-color);
            border-bottom: 1px solid #dee2e6;
        }
        
        .filter-table td {
            padding: 0.8rem 1rem 0.8rem 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            border: 1px solid #ced4da;
            transition: all 0.3s;
            width: 100%;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 89, 152, 0.25);
        }
        
        /* ===== QUICK FILTERS ===== */
        .quick-filters {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        
        .quick-filter {
            background-color: #e9ecef;
            border: none;
            border-radius: 20px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .quick-filter:hover {
            background-color: #dee2e6;
        }
        
        .quick-filter.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* ===== ROOM AVAILABILITY ===== */
        .availability-section {
            margin-bottom: 3rem;
        }
        
        .availability-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .availability-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .availability-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .room-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        
        .room-item {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
        }
        
        .room-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .room-item.occupied {
            border-left-color: #dc3545;
        }
        
        .room-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .room-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .room-status {
            font-weight: 600;
        }
        
        .status-available {
            color: #28a745;
        }
        
        .status-occupied {
            color: #dc3545;
        }
        
        /* ===== STATISTICS SECTION ===== */
        .stats-section {
            margin-bottom: 3rem;
        }
        
        .stats-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stats-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-item.blue {
            background-color: rgba(59, 89, 152, 0.1);
        }
        
        .stat-item.orange {
            background-color: rgba(255, 165, 0, 0.1);
        }
        
        .stat-item.purple {
            background-color: rgba(128, 0, 128, 0.1);
        }
        
        .stat-item.gray {
            background-color: rgba(128, 128, 128, 0.1);
        }
        
        .stat-label {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
        }
        
        .stat-item.blue .stat-label {
            color: #3b5998;
        }
        
        .stat-item.blue .stat-value {
            color: #3b5998;
        }
        
        .stat-item.orange .stat-label {
            color: #ff8c00;
        }
        
        .stat-item.orange .stat-value {
            color: #ff8c00;
        }
        
        .stat-item.purple .stat-label {
            color: #800080;
        }
        
        .stat-item.purple .stat-value {
            color: #800080;
        }
        
        .stat-item.gray .stat-label {
            color: #808080;
        }
        
        .stat-item.gray .stat-value {
            color: #808080;
        }
        
        /* ===== PROJECTOR SECTION ===== */
        .projector-section {
            margin-bottom: 3rem;
        }
        
        .projector-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .projector-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .projector-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .projector-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        
        .projector-item {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
        }
        
        .projector-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .projector-item.borrowed {
            border-left-color: #dc3545;
        }
        
        .projector-item.maintenance {
            border-left-color: #ffc107;
        }
        
        .projector-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .projector-details {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .projector-status {
            padding: 0.3rem 0.7rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-available {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        
        .status-borrowed {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .status-maintenance {
            background-color: rgba(255, 193, 7, 0.1);
            color: #856404;
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
        
        /* ===== ANIMATIONS ===== */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* ===== FOOTER STYLES ===== */
        .footer {
            background-color: #2d3748;
            color: white;
            padding: 40px 0 20px;
            margin-top: 2rem;
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
            background-color: #1a56db;
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
            color: #1a56db;
            padding-left: 5px;
        }
        
        .contact-info {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        
        .contact-info i {
            margin-right: 10px;
            color: #1a56db;
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
            background-color: #1a56db;
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
        
        /* ===== RESPONSIVE ADJUSTMENTS ===== */
        @media (max-width: 992px) {
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar ul li {
                margin: 0.3rem;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .logo {
                margin-bottom: 1rem;
            }
            
            .filter-section, 
            .availability-card,
            .stats-card,
            .projector-card {
                padding: 1.5rem;
            }
            
            .filter-table th, 
            .filter-table td {
                display: block;
                width: 100%;
                padding: 0.5rem 0;
            }
            
            .filter-table th {
                border-bottom: none;
                padding-top: 1rem;
            }
            
            .room-list,
            .projector-list {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
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

            .dropdown-menu-custom {
                width: 12rem;
                right: -1rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section {
                padding: 2.5rem 0;
            }

            .btn-warning {
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
            }
            
            .quick-filters {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .quick-filter {
                width: 100%;
            }
        }
    </style>
</head>
<body>
  <!-- ===== NAVBAR YANG DIPERBAIKI ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="/home">
                <i class="fas fa-building"></i>SarPras TI
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
                        <a class="nav-link dropdown-toggle active" href="#" id="kalenderDropdown" role="button"
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

    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold">Sistem Peminjaman Sarana Prasarana</h1>
                <p class="lead">Platform digital untuk pengelolaan dan peminjaman fasilitas di Program Studi Teknologi Informasi</p>
                <div class="mt-4">
                    <a href="#" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-plus-circle me-2"></i> Ajukan Peminjaman
                    </a>
                    <a href="/kalender" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calendar-alt me-2"></i> Lihat Kalender
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container main-content">
        <!-- Filter Pencarian -->
        <div class="filter-section">
            <h3 class="filter-title"><i class="fa-solid fa-filter"></i> Filter Pencarian</h3>
            
            <table class="filter-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kapasitas</th>
                        <th>Tipe Ruangan</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datePicker">
                        </td>
                        <td>
                            <select class="form-select">
                                <option selected>Pilih Kapasitas</option>
                                <option>1-10 orang</option>
                                <option>11-30 orang</option>
                                <option>31-50 orang</option>
                                <option>51+ orang</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select">
                                <option selected>Pilih Tipe</option>
                                <option>Kelas</option>
                                <option>Laboratorium</option>
                                <option>Ruang Rapat</option>
                                <option>Auditorium</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select">
                                <option selected>Pilih Lokasi</option>
                                <option>Gedung TI</option>
                                <option>Gedung Utama</option>
                                <option>Gedung Laboratorium</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="quick-filters">
                <div class="quick-filter active">Tersedia Hari ini</div>
                <div class="quick-filter">Lab Tersedia</div>
            </div>
        </div>

        <!-- Info Ruangan Tersedia -->
        <div class="availability-section">
            <div class="availability-card">
                <h3 class="availability-title"><i class="fa-solid fa-door-open"></i> Info Ruangan Tersedia</h3>
                
                <div class="room-list">
                    <div class="room-item">
                        <div class="room-name">Ruang Kelas A</div>
                        <div class="room-details">
                            <span>Kapasitas: 30 orang</span>
                            <span class="room-status status-available">Tersedia</span>
                        </div>
                    </div>
                    
                    <div class="room-item">
                        <div class="room-name">Ruang Kelas B</div>
                        <div class="room-details">
                            <span>Kapasitas: 25 orang</span>
                            <span class="room-status status-available">Tersedia</span>
                        </div>
                    </div>
                    
                    <div class="room-item">
                        <div class="room-name">Lab Jaringan</div>
                        <div class="room-details">
                            <span>Kapasitas: 20 orang</span>
                            <span class="room-status status-available">Tersedia</span>
                        </div>
                    </div>
                    
                    <div class="room-item occupied">
                        <div class="room-name">Lab Pemrograman</div>
                        <div class="room-details">
                            <span>Kapasitas: 25 orang</span>
                            <span class="room-status status-occupied">Terpakai</span>
                        </div>
                    </div>
                    
                    <div class="room-item">
                        <div class="room-name">Ruang Rapat</div>
                        <div class="room-details">
                            <span>Kapasitas: 15 orang</span>
                            <span class="room-status status-available">Tersedia</span>
                        </div>
                    </div>
                    
                    <div class="room-item occupied">
                        <div class="room-name">Auditorium</div>
                        <div class="room-details">
                            <span>Kapasitas: 100 orang</span>
                            <span class="room-status status-occupied">Terpakai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Ruangan Terpakai -->
        <div class="stats-section">
            <div class="stats-card">
                <h3 class="stats-title"><i class="fa-solid fa-calendar-check"></i> Info Ruangan Terpakai</h3>
                <p class="text-muted mb-4">Daftar ruangan yang sedang digunakan untuk 2025-09-09</p>

                <!-- Statistik Ringkas -->
                <div class="stats-grid">
                    <div class="stat-item blue">
                        <p class="stat-label">Pagi (08:00-12:00)</p>
                        <p class="stat-value">2</p>
                    </div>
                    <div class="stat-item orange">
                        <p class="stat-label">Siang (12:00-18:00)</p>
                        <p class="stat-value">2</p>
                    </div>
                    <div class="stat-item purple">
                        <p class="stat-label">Malam (18:00+)</p>
                        <p class="stat-value">2</p>
                    </div>
                    <div class="stat-item gray">
                        <p class="stat-label">Total Terpakai</p>
                        <p class="stat-value">6</p>
                    </div>
                </div>

                <!-- Contoh list ruangan terpakai -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold">Ruang Kelas A201</h4>
                            <p class="text-sm text-muted">Gedung A</p>
                            <p class="text-sm">Dipakai oleh: <span class="fw-medium">Dr. Budi Santoso</span></p>
                            <p class="text-sm">Waktu: 10:30 - 12:00</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold">Lab Jaringan</h4>
                            <p class="text-sm text-muted">Gedung B</p>
                            <p class="text-sm">Dipakai oleh: <span class="fw-medium">Ir. Sari Wulandari, M.T.</span></p>
                            <p class="text-sm">Waktu: 14:00 - 16:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Penggunaan -->
        <div class="stats-section">
            <div class="stats-card">
                <h3 class="stats-title"><i class="fa-solid fa-chart-bar"></i> Statistik Penggunaan</h3>
                <p class="text-muted mb-4">Data penggunaan fasilitas Departemen IT</p>

                <div class="stats-grid">
                    <div class="stat-item blue">
                        <p class="stat-label">Ruangan Terpakai Hari Ini</p>
                        <p class="stat-value">6</p>
                    </div>
                    <div class="stat-item green">
                        <p class="stat-label">Ruangan Tersedia Hari Ini</p>
                        <p class="stat-value">12</p>
                    </div>
                    <div class="stat-item purple">
                        <p class="stat-label">Proyektor Aktif</p>
                        <p class="stat-value">8</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Proyektor -->
        <div class="projector-section">
            <div class="projector-card">
                <h3 class="projector-title"><i class="fa-solid fa-video"></i> Status Proyektor</h3>
                <p class="text-muted mb-4">Real-time status ketersediaan proyektor</p>

                <!-- Statistik Ringkas -->
                <div class="stats-grid">
                    <div class="stat-item green">
                        <p class="stat-label">Tersedia</p>
                        <p class="stat-value">3</p>
                    </div>
                    <div class="stat-item red">
                        <p class="stat-label">Dipinjam</p>
                        <p class="stat-value">3</p>
                    </div>
                    <div class="stat-item yellow">
                        <p class="stat-label">Maintenance</p>
                        <p class="stat-value">2</p>
                    </div>
                    <div class="stat-item gray">
                        <p class="stat-label">Total Proyektor</p>
                        <p class="stat-value">8</p>
                    </div>
                </div>

                <!-- Contoh daftar proyektor -->
                <div class="projector-list">
                    <div class="projector-item">
                        <div class="projector-name">Epson EB-X41</div>
                        <div class="projector-details">Lab Komputer 1 - Gedung A</div>
                        <div class="projector-details">Kondisi: <span class="text-success fw-medium">Sangat Baik</span></div>
                        <div class="mt-2 p-2 bg-success bg-opacity-10 text-success rounded">
                            Siap digunakan
                        </div>
                    </div>
                    <div class="projector-item borrowed">
                        <div class="projector-name">BenQ MX550</div>
                        <div class="projector-details">Ruang Kelas A201 - Gedung A</div>
                        <div class="projector-details">Kondisi: <span class="text-primary fw-medium">Baik</span></div>
                        <div class="mt-2 p-2 bg-danger bg-opacity-10 text-danger rounded">
                            Dipinjam oleh Dr. Budi Santoso (10:30 - 12:00)
                        </div>
                    </div>
                    <div class="projector-item maintenance">
                        <div class="projector-name">Sony VPL-DX120</div>
                        <div class="projector-details">Lab Jaringan - Gedung B</div>
                        <div class="projector-details">Kondisi: <span class="text-warning fw-medium">Perlu Perbaikan</span></div>
                        <div class="mt-2 p-2 bg-warning bg-opacity-10 text-warning rounded">
                            Dalam perbaikan hingga 15 September
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

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
        // Back to top button functionality
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
        
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Quick filters functionality
        const quickFilters = document.querySelectorAll('.quick-filter');
        
        quickFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                quickFilters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Date picker initialization
        document.getElementById('datePicker').addEventListener('focus', function() {
            this.type = 'date';
        });
        
        // Animation on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.filter-section, .availability-card, .stats-card, .projector-card, .room-item, .projector-item');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (elementPosition < screenPosition) {
                    element.style.opacity = 1;
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Initialize elements for animation
        document.querySelectorAll('.filter-section, .availability-card, .stats-card, .projector-card, .room-item, .projector-item').forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>