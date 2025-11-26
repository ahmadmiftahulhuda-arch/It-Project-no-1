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
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
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

        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 4rem 0 3rem;
            margin-bottom: 0;
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
            margin-bottom: 1rem;
        }
        
        .hero-content p {
            animation: fadeInUp 1s ease;
            margin-bottom: 2rem;
            font-size: 1.2rem;
        }

        /* ===== TOMBOL HERO ===== */
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-hero {
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-hero-primary {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid white;
        }

        .btn-hero-primary:hover {
            background-color: transparent;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-hero-outline {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-hero-outline:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        /* ===== NAVIGASI BAWAH BANNER ===== */
        .sub-navigation {
            background-color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 76px;
            z-index: 999;
        }
        
        .sub-nav-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .sub-nav-item {
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            background-color: #f8f9fa;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid transparent;
        }
        
        .sub-nav-item:hover,
        .sub-nav-item.active {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 2rem 1rem;
        }
        
        .section-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #eaeaea;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* ===== CARD STYLES ===== */
        .card-custom {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        /* ===== STATISTICS SECTION ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
        }
        
        /* ===== ROOM STATUS SECTION ===== */
        .room-status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .room-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .room-header {
            padding: 1rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .room-name {
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .room-status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-available {
            background-color: var(--success-color);
            color: white;
        }
        
        .status-occupied {
            background-color: var(--danger-color);
            color: white;
        }
        
        .status-maintenance {
            background-color: var(--warning-color);
            color: #212529;
        }
        
        .room-body {
            padding: 1.5rem;
        }
        
        .room-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .room-detail {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .room-schedule {
            margin-top: 1rem;
        }
        
        .schedule-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .schedule-item:last-child {
            border-bottom: none;
        }
        
        /* ===== PROJECTOR STATUS SECTION ===== */
        .projector-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .projector-card {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .projector-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .projector-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .projector-available {
            color: var(--success-color);
        }
        
        .projector-in-use {
            color: var(--danger-color);
        }
        
        .projector-maintenance {
            color: var(--warning-color);
        }
        
        .projector-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }
        
        .projector-location {
            color: #6c757d;
            margin-bottom: 1rem;
        }
        
        /* ===== QUICK ACTIONS ===== */
        .quick-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }
        
        .action-card {
            flex: 1;
            min-width: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            color: white;
        }
        
        .action-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .action-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        /* ===== USAGE STATISTICS ===== */
        .usage-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .usage-card {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .usage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .usage-title {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .usage-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .usage-bar {
            height: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }
        
        .usage-fill {
            height: 100%;
            border-radius: 5px;
        }
        
        .fill-primary {
            background-color: var(--primary-color);
        }
        
        .fill-success {
            background-color: var(--success-color);
        }
        
        .fill-warning {
            background-color: var(--warning-color);
        }
        
        .fill-danger {
            background-color: var(--danger-color);
        }
        
        .usage-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        /* ===== RECENT ACTIVITY ===== */
        .activity-list {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .activity-item {
            display: flex;
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .activity-icon.booking {
            background-color: rgba(59, 89, 152, 0.1);
            color: var(--primary-color);
        }
        
        .activity-icon.return {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }
        
        .activity-icon.maintenance {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        
        .activity-desc {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }
        
        .activity-time {
            color: #9ca3af;
            font-size: 0.8rem;
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
        
        /* ===== RESPONSIVE ADJUSTMENTS ===== */
        @media (max-width: 992px) {
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar ul li {
                margin: 0.3rem;
            }
            
            .sub-nav-container {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 10px;
            }
            
            .sub-nav-item {
                white-space: nowrap;
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 2rem;
            }
            
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero {
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }
            
            .sub-navigation {
                top: 70px;
            }
            
            .stats-grid,
            .room-status-grid,
            .projector-grid,
            .usage-stats {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                flex-direction: column;
            }
            
            .action-card {
                min-width: 100%;
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
            .hero-content h1 {
                font-size: 1.8rem;
            }
            
            .sub-nav-item {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .card-custom {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- ===== NAVBAR YANG DIPERBAIKI ===== -->
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
                        <a class="nav-link active" href="/home">
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
                                {{ Auth::user()->name }}
                                <span class="custom-arrow">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold">Sistem Peminjaman Sarana Prasarana</h1>
                <p class="lead">Kelola peminjaman ruangan dan proyektor dengan mudah dan efisien</p>
                
                <!-- Tombol Hero -->
                <div class="hero-buttons">
                    <a href="{{ route('user.peminjaman.create') }}" class="btn-hero btn-hero-primary">
                        <i class="fas fa-plus-circle"></i> Ajukan Peminjaman
                    </a>
                    <a href="/kalender" class="btn-hero btn-hero-outline">
                        <i class="fas fa-calendar-alt"></i> Lihat Kalender
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sub Navigation -->
    <section class="sub-navigation">
        <div class="container">
            <div class="sub-nav-container">
                <a href="#stats" class="sub-nav-item active">
                    <i class="fas fa-chart-bar"></i> Statistik
                </a>
                <a href="#rooms" class="sub-nav-item">
                    <i class="fas fa-door-open"></i> Info Ruangan
                </a>
                <a href="#projectors" class="sub-nav-item">
                    <i class="fas fa-video"></i> Status Proyektor
                </a>
                <a href="#usage" class="sub-nav-item">
                    <i class="fas fa-chart-pie"></i> Statistik Penggunaan
                </a>
                <a href="#quick-actions" class="sub-nav-item">
                    <i class="fas fa-bolt"></i> Aksi Cepat
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Statistik Ringkas -->
        <section id="stats" class="mb-5">
            <h2 class="section-title"><i class="fas fa-chart-bar"></i> Statistik Ringkas</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stat-number">12</div>
                    <div class="stat-label">Total Ruangan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">8</div>
                    <div class="stat-label">Ruangan Tersedia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-number">4</div>
                    <div class="stat-label">Ruangan Terpakai</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="stat-number">15</div>
                    <div class="stat-label">Total Proyektor</div>
                </div>
            </div>
        </section>

        <!-- Info Ruangan -->
        <section id="rooms" class="mb-5">
            <h2 class="section-title"><i class="fas fa-door-open"></i> Info Ruangan</h2>
            <div class="room-status-grid">
                @foreach($ruangan as $room)
                    <div class="room-card">
                        <div class="room-header">
                            <div class="room-name">{{ $room->nama_ruangan }}</div>
                            @php
                                $status = strtolower($room->status ?? '');
                                $statusClass = 'status-available';
                                $statusLabel = 'Tersedia';

                                if (in_array($status, ['terpakai', 'occupied', 'digunakan'])) {
                                    $statusClass = 'status-occupied';
                                    $statusLabel = 'Terpakai';
                                } elseif (in_array($status, ['maintenance', 'perbaikan'])) {
                                    $statusClass = 'status-maintenance';
                                    $statusLabel = 'Maintenance';
                                }
                            @endphp
                            <div class="room-status {{ $statusClass }}">{{ $statusLabel }}</div>
                        </div>
                        <div class="room-body">
                            <div class="room-details">
                                <div class="room-detail">
                                    <i class="fas fa-users"></i>
                                    <span>Kapasitas: {{ $room->kapasitas ?? 'N/A' }} orang</span>
                                </div>
                            </div>
                            <div class="room-schedule">
                                @if(isset($slotwaktu) && $slotwaktu->count())
                                    @foreach($slotwaktu as $slot)
                                        @php
                                            // cari jadwal di ruangan ini yang cocok dengan slot waktu
                                            $match = null;
                                            if (isset($room->jadwals)) {
                                                $match = $room->jadwals->first(function($j) use ($slot) {
                                                    $slotText = trim($slot->waktu);
                                                    $jadwalText = trim(($j->jam_mulai ?? '') . ' - ' . ($j->jam_selesai ?? ''));
                                                    return $slotText === $jadwalText;
                                                });
                                            }

                                            if ($match) {
                                                $label = $match->nama_kelas ?? ($match->sebaran_mahasiswa ?? 'Terpakai');
                                                $textClass = (!empty($match->nama_kelas) || !empty($match->kelas_mahasiswa)) ? 'text-danger' : 'text-success';
                                            } else {
                                                $label = 'Kosong';
                                                $textClass = 'text-success';
                                            }
                                        @endphp
                                        <div class="schedule-item">
                                            <span>{{ $slot->waktu }}</span>
                                            <span class="{{ $textClass }}">{{ $label }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- fallback lama jika tidak ada slot waktu --}}
                                    <div class="schedule-item">
                                        <span>08:00 - 10:00</span>
                                        <span class="text-success">Kosong</span>
                                    </div>
                                    <div class="schedule-item">
                                        <span>10:00 - 12:00</span>
                                        <span class="text-success">Kosong</span>
                                    </div>
                                    <div class="schedule-item">
                                        <span>13:00 - 15:00</span>
                                        <span class="text-success">Kosong</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Status Proyektor -->
        <section id="projectors" class="mb-5">
            <h2 class="section-title"><i class="fas fa-video"></i> Status Proyektor</h2>
            <div class="projector-grid">
                <div class="projector-card">
                    <div class="projector-icon projector-available">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="projector-name">Proyektor 1</div>
                    <div class="projector-location">Lab A</div>
                    <div class="room-status status-available">Tersedia</div>
                </div>
                <div class="projector-card">
                    <div class="projector-icon projector-in-use">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="projector-name">Proyektor 2</div>
                    <div class="projector-location">Lab B</div>
                    <div class="room-status status-occupied">Digunakan</div>
                </div>
                <div class="projector-card">
                    <div class="projector-icon projector-maintenance">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="projector-name">Proyektor 3</div>
                    <div class="projector-location">Lab C</div>
                    <div class="room-status status-maintenance">Perbaikan</div>
                </div>
                <div class="projector-card">
                    <div class="projector-icon projector-available">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="projector-name">Proyektor 4</div>
                    <div class="projector-location">Ruang Meeting</div>
                    <div class="room-status status-available">Tersedia</div>
                </div>
            </div>
        </section>

        <!-- Aksi Cepat -->
        <section id="quick-actions" class="mb-5">
            <h2 class="section-title"><i class="fas fa-bolt"></i> Aksi Cepat</h2>
            <div class="quick-actions">
                <a href="{{ route('user.peminjaman.create') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="action-title">Ajukan Peminjaman</div>
                    <p>Ajukan peminjaman ruangan atau proyektor</p>
                </a>
                <a href="{{ route('user.peminjaman.index') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="action-title">Lihat Peminjaman</div>
                    <p>Lihat daftar peminjaman Anda</p>
                </a>
                <a href="/kalender" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="action-title">Kalender</div>
                    <p>Lihat  peminjaman</p>
                </a>
                <a href="{{ route('user.feedback.create') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-comment-dots"></i>
                    </div>
                    <div class="action-title">Feedback</div>
                    <p>Berikan masukan untuk sistem</p>
                </a>
            </div>
        </section>

        <!-- Statistik Penggunaan -->
        <section id="usage" class="mb-5">
            <h2 class="section-title"><i class="fas fa-chart-pie"></i> Statistik Penggunaan</h2>
            <div class="usage-stats">
                <div class="usage-card">
                    <div class="usage-header">
                        <div class="usage-title">Penggunaan Ruangan</div>
                        <div class="usage-value">67%</div>
                    </div>
                    <div class="usage-bar">
                        <div class="usage-fill fill-primary" style="width: 67%"></div>
                    </div>
                    <div class="usage-label">
                        <span>Tersedia</span>
                        <span>33%</span>
                    </div>
                    <div class="usage-label">
                        <span>Terpakai</span>
                        <span>67%</span>
                    </div>
                </div>
                <div class="usage-card">
                    <div class="usage-header">
                        <div class="usage-title">Penggunaan Proyektor</div>
                        <div class="usage-value">40%</div>
                    </div>
                    <div class="usage-bar">
                        <div class="usage-fill fill-success" style="width: 40%"></div>
                    </div>
                    <div class="usage-label">
                        <span>Tersedia</span>
                        <span>60%</span>
                    </div>
                    <div class="usage-label">
                        <span>Terpakai</span>
                        <span>40%</span>
                    </div>
                </div>
                <div class="usage-card">
                    <div class="usage-header">
                        <div class="usage-title">Tingkat Kepuasan</div>
                        <div class="usage-value">92%</div>
                    </div>
                    <div class="usage-bar">
                        <div class="usage-fill fill-warning" style="width: 92%"></div>
                    </div>
                    <div class="usage-label">
                        <span>Puas</span>
                        <span>92%</span>
                    </div>
                    <div class="usage-label">
                        <span>Tidak Puas</span>
                        <span>8%</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Aktivitas Terbaru -->
        <section class="mb-5">
            <h2 class="section-title"><i class="fas fa-history"></i> Aktivitas Terbaru</h2>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon booking">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Peminjaman Baru</div>
                        <div class="activity-desc">Ahmad Miftahul Huda meminjam Lab A untuk Praktikum Jaringan</div>
                        <div class="activity-time">10 menit yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon return">
                        <i class="fas fa-undo"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pengembalian</div>
                        <div class="activity-desc">Najwa Khadijah mengembalikan proyektor di Lab B</div>
                        <div class="activity-time">1 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon maintenance">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Maintenance</div>
                        <div class="activity-desc">Proyektor di Lab C sedang dalam perbaikan</div>
                        <div class="activity-time">2 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon booking">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Peminjaman Disetujui</div>
                        <div class="activity-desc">Peminjaman Ruang Meeting oleh M. Ferdiy Ariyanto telah disetujui</div>
                        <div class="activity-time">3 jam yang lalu</div>
                    </div>
                </div>
            </div>
        </section>
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

        // ===== DROPDOWN ANIMATION =====
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown toggle animation
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    // Close other open dropdowns
                    dropdownToggles.forEach(otherToggle => {
                        if (otherToggle !== toggle && otherToggle.classList.contains('show')) {
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
                    const openDropdowns = document.querySelectorAll('.dropdown-toggle.show, .dropdown-menu.show');
                    openDropdowns.forEach(element => {
                        element.classList.remove('show');
                    });
                }
            });
        });

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
        
        // Sub navigation functionality
        const subNavItems = document.querySelectorAll('.sub-nav-item');
        
        subNavItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all items
                subNavItems.forEach(i => i.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Scroll to target section
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    const offsetTop = targetSection.offsetTop - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Update active sub nav item on scroll
        const sections = document.querySelectorAll('section[id]');
        
        window.addEventListener('scroll', () => {
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                
                if (scrollY >= (sectionTop - 150)) {
                    current = section.getAttribute('id');
                }
            });
            
            subNavItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });
        
        // Animation on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.stat-card, .room-card, .projector-card, .usage-card, .activity-item');
            
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
        document.querySelectorAll('.stat-card, .room-card, .projector-card, .usage-card, .activity-item').forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>