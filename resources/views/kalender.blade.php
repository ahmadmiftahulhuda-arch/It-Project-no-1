<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Perkuliahan - Sistem Peminjaman Sarana Prasarana</title>
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
        
        /* ===== BREADCRUMB ===== */
        .breadcrumb-container {
            background-color: #e9ecef;
            padding: 1rem 0;
        }
        
        .breadcrumb {
            margin-bottom: 0;
            padding: 0 1rem;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 2rem 1rem;
        }
        
        .page-header {
            margin-bottom: 2rem;
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
        
        /* ===== CALENDAR SECTION ===== */
        .calendar-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-bottom: 2.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .calendar-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .month-navigation {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .month-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            min-width: 180px;
            text-align: center;
        }
        
        .calendar-controls {
            display: flex;
            gap: 0.5rem;
        }
        
        .calendar {
            width: 100%;
            border-collapse: collapse;
        }
        
        .calendar th {
            color: var(--primary-color);
            text-align: center;
            padding: 1rem 0.5rem;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        
        .calendar td {
            text-align: center;
            padding: 0.8rem 0.5rem;
            position: relative;
            border-radius: 8px;
            transition: background-color 0.2s;
            height: 100px;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }
        
        .calendar td:hover {
            background-color: #f5f8fa;
        }
        
        .day-number {
            display: block;
            text-align: left;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .today {
            background-color: rgba(59, 89, 152, 0.1);
            border: 2px solid var(--primary-color);
        }
        
        .today .day-number {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .event {
            background-color: #e9ecef;
            border-radius: 4px;
            padding: 2px 5px;
            margin-top: 2px;
            font-size: 0.75rem;
            text-align: left;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: all 0.3s ease;
        }
        
        .event:hover {
            transform: translateX(3px);
        }
        
        .event.lecture {
            background-color: #d1ecf1;
            border-left: 3px solid #0dcaf0;
        }
        
        .event.lab {
            background-color: #d4edda;
            border-left: 3px solid #198754;
        }
        
        .event.exam {
            background-color: #f8d7da;
            border-left: 3px solid #dc3545;
        }
        
        .event.meeting {
            background-color: #e7f1ff;
            border-left: 3px solid #0d6efd;
        }
        
        /* ===== LEGEND ===== */
        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1.8rem;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
        }
        
        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 3px;
            margin-right: 8px;
            flex-shrink: 0;
        }
        
        .lecture-color {
            background-color: #d1ecf1;
            border-left: 3px solid #0dcaf0;
        }
        
        .lab-color {
            background-color: #d4edda;
            border-left: 3px solid #198754;
        }
        
        .exam-color {
            background-color: #f8d7da;
            border-left: 3px solid #dc3545;
        }
        
        .meeting-color {
            background-color: #e7f1ff;
            border-left: 3px solid #0d6efd;
        }
        
        /* ===== SCHEDULE LIST ===== */
        .schedule-list {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-bottom: 2.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .schedule-list:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .schedule-item {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            padding: 1.5rem 0;
            transition: all 0.3s ease;
        }
        
        .schedule-item:hover {
            background-color: #f8f9fa;
            padding-left: 10px;
            border-radius: 8px;
        }
        
        .schedule-item:last-child {
            border-bottom: none;
        }
        
        .schedule-date {
            min-width: 80px;
            text-align: center;
            padding-right: 1rem;
        }
        
        .schedule-day {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
        }
        
        .schedule-month {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
        }
        
        .schedule-details {
            flex: 1;
        }
        
        .schedule-time {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .schedule-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }
        
        .schedule-location {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .schedule-type {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .type-lecture {
            background-color: #d1ecf1;
            color: #055160;
        }
        
        .type-lab {
            background-color: #d4edda;
            color: #0f5132;
        }
        
        .type-exam {
            background-color: #f8d7da;
            color: #842029;
        }
        
        .type-meeting {
            background-color: #e7f1ff;
            color: #052c65;
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
            
            .calendar-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .calendar td {
                height: 80px;
                padding: 0.5rem 0.3rem;
            }
            
            .event {
                font-size: 0.7rem;
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
            
            .calendar-container, 
            .schedule-list,
            .filter-section {
                padding: 1.5rem;
            }
            
            .calendar th, 
            .calendar td {
                padding: 0.5rem 0.2rem;
            }
            
            .day-number {
                font-size: 0.9rem;
            }
            
            .schedule-item {
                flex-direction: column;
            }
            
            .schedule-date {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 0.5rem;
            }
            
            .schedule-day {
                font-size: 1.5rem;
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
        
                    .calendar th, 
        
                    .calendar td {
        
                        padding: 0.3rem 0.1rem;
        
                        font-size: 0.8rem;
        
                    }
        
                    
        
                    .day-number {
        
                        font-size: 0.8rem;
        
                    }
        
                    
        
                    .event {
        
                        display: none;
        
                    }
        
                    
        
                    .hero-section {
        
                        padding: 2.5rem 0;
        
                    }
        
        
        
                    .btn-warning {
        
                        width: 100%;
        
                        justify-content: center;
        
                        margin-top: 0.5rem;
        
                    }
        
                }
        
            /* ===== ENHANCED ERROR POPUP STYLES ===== */
        
                .error-modal .modal-content {
        
                    border-radius: 16px;
        
                    border: none;
        
                    overflow: hidden;
        
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        
                    animation: modalAppear 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        
                }
        
        
        
                @keyframes modalAppear {
        
                    from {
        
                        opacity: 0;
        
                        transform: scale(0.8) translateY(20px);
        
                    }
        
                    to {
        
                        opacity: 1;
        
                        transform: scale(1) translateY(0);
        
                    }
        
                }
        
        
        
                .error-modal .modal-header {
        
                    background: linear-gradient(135deg, #dc3545, #c82333);
        
                    color: white;
        
                    padding: 1.5rem 2rem;
        
                    border-bottom: none;
        
                    position: relative;
        
                }
        
        
        
                .error-modal .modal-header::after {
        
                    content: '';
        
                    position: absolute;
        
                    bottom: 0;
        
                    left: 5%;
        
                    width: 90%;
        
                    height: 1px;
        
                    background: rgba(255, 255, 255, 0.2);
        
                }
        
        
        
                .error-modal .modal-title {
        
                    font-size: 1.4rem;
        
                    font-weight: 700;
        
                    display: flex;
        
                    align-items: center;
        
                    gap: 12px;
        
                }
        
        
        
                .error-modal .modal-title i {
        
                    font-size: 1.6rem;
        
                    animation: pulse 2s infinite;
        
                }
        
        
        
                @keyframes pulse {
        
                    0% { transform: scale(1); }
        
                    50% { transform: scale(1.1); }
        
                    100% { transform: scale(1); }
        
                }
        
        
        
                .error-modal .modal-body {
        
                    padding: 2.5rem 2rem;
        
                    font-size: 1.1rem;
        
                    line-height: 1.7;
        
                    color: #495057;
        
                    text-align: center;
        
                }
        
        
        
                .error-modal .error-icon-container {
        
                    margin-bottom: 1.5rem;
        
                }
        
        
        
                .error-modal .error-icon {
        
                    font-size: 4rem;
        
                    color: #dc3545;
        
                    margin-bottom: 1rem;
        
                    display: inline-block;
        
                    animation: shake 0.5s ease;
        
                }
        
        
        
                @keyframes shake {
        
                    0%, 100% { transform: translateX(0); }
        
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
        
                }
        
        
        
                .error-modal .error-message {
        
                    background: linear-gradient(135deg, #fff5f5, #ffeaea);
        
                    border-left: 4px solid #dc3545;
        
                    padding: 1.2rem;
        
                    border-radius: 8px;
        
                    margin-bottom: 1.5rem;
        
                    text-align: left;
        
                    font-weight: 500;
        
                }
        
        
        
                .error-modal .error-suggestion {
        
                    background-color: #f8f9fa;
        
                    padding: 1rem;
        
                    border-radius: 8px;
        
                    margin-top: 1.5rem;
        
                    font-size: 0.95rem;
        
                    color: #6c757d;
        
                    border-left: 3px solid var(--primary-color);
        
                }
        
        
        
                .error-modal .modal-footer {
        
                    border-top: none;
        
                    padding: 1.5rem 2rem;
        
                    background-color: #f8f9fa;
        
                    display: flex;
        
                    justify-content: center;
        
                    gap: 1rem;
        
                }
        
        
        
                .error-modal .btn-error {
        
                    padding: 0.75rem 2rem;
        
                    border-radius: 8px;
        
                    font-weight: 600;
        
                    transition: all 0.3s ease;
        
                    display: flex;
        
                    align-items: center;
        
                    gap: 8px;
        
                    border: none;
        
                    min-width: 140px;
        
                    justify-content: center;
        
                }
        
        
        
                .error-modal .btn-error-primary {
        
                    background: linear-gradient(135deg, #dc3545, #c82333);
        
                    color: white;
        
                    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        
                }
        
        
        
                .error-modal .btn-error-primary:hover {
        
                    background: linear-gradient(135deg, #c82333, #bd2130);
        
                    transform: translateY(-2px);
        
                    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        
                }
        
        
        
                .error-modal .btn-error-secondary {
        
                    background-color: #6c757d;
        
                    color: white;
        
                    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.2);
        
                }
        
        
        
                .error-modal .btn-error-secondary:hover {
        
                    background-color: #5a6268;
        
                    transform: translateY(-2px);
        
                    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.3);
        
                }
        
        
        
                .error-modal .btn-error-outline {
        
                    background-color: transparent;
        
                    color: #dc3545;
        
                    border: 2px solid #dc3545;
        
                }
        
        
        
                .error-modal .btn-error-outline:hover {
        
                    background-color: #dc3545;
        
                    color: white;
        
                    transform: translateY(-2px);
        
                }
        
        
        
                /* Responsive adjustments for error modal */
        
                @media (max-width: 576px) {
        
                    .error-modal .modal-dialog {
        
                        margin: 1rem;
        
                    }
        
        
        
                    .error-modal .modal-header,
        
                    .error-modal .modal-body,
        
                    .error-modal .modal-footer {
        
                        padding: 1.25rem;
        
                    }
        
        
        
                    .error-modal .modal-title {
        
                        font-size: 1.2rem;
        
                    }
        
        
        
                    .error-modal .error-icon {
        
                        font-size: 3rem;
        
                    }
        
        
        
                    .error-modal .modal-footer {
        
                        flex-direction: column;
        
                    }
        
        
        
                    .error-modal .btn-error {
        
                        width: 100%;
        
                    }
        
                }
        
        
        
                /* Auto-hide notification for non-critical errors */
        
                .error-toast {
        
                    position: fixed;
        
                    top: 100px;
        
                    right: 20px;
        
                    z-index: 9999;
        
                    min-width: 300px;
        
                    max-width: 400px;
        
                    background: white;
        
                    border-radius: 12px;
        
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        
                    overflow: hidden;
        
                    animation: slideInRight 0.5s ease, fadeOut 0.5s ease 4.5s forwards;
        
                    border-left: 4px solid #dc3545;
        
                }
        
        
        
                @keyframes slideInRight {
        
                    from {
        
                        transform: translateX(100%);
        
                        opacity: 0;
        
                    }
        
                    to {
        
                        transform: translateX(0);
        
                        opacity: 1;
        
                    }
        
                }
        
        
        
                @keyframes fadeOut {
        
                    to {
        
                        opacity: 0;
        
                        transform: translateX(100%);
        
                    }
        
                }
        
        
        
                .error-toast .toast-header {
        
                    background: linear-gradient(135deg, #dc3545, #c82333);
        
                    color: white;
        
                    padding: 1rem 1.25rem;
        
                    border-bottom: none;
        
                }
        
        
        
                .error-toast .toast-body {
        
                    padding: 1.25rem;
        
                    color: #495057;
        
                }
        
        
        
                /* Success modal for positive feedback */
        
                .success-modal .modal-header {
        
                    background: linear-gradient(135deg, #28a745, #218838);
        
                }
        
        
        
                .success-modal .btn-error-primary {
        
                    background: linear-gradient(135deg, #28a745, #218838);
        
                    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        
                }
        
        
        
                .success-modal .btn-error-primary:hover {
        
                    background: linear-gradient(135deg, #218838, #1e7e34);
        
                    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        
                }
        
            </style>
        
        </head>
        
        <body>
        
            <!-- ===== NAVBAR YANG DIPERBAIKI ===== -->
        
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" id="navbar">
        
                <div class="container">
        
                    <a class="navbar-brand" href="/home">
        
                        <!-- Logo TI yang diperbesar -->
        
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
        
                                        <a class="dropdown-item-custom active" href="/kalender">
        
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
        
                                         <i class="fas fa-user"></i> {{ Auth::user()->display_name }}
        
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
        
                        <h1 class="display-4 fw-bold">Kalender Perkuliahan</h1>
        
                        <p class="lead">Lihat jadwal perkuliahan, ujian, dan kegiatan akademik Program Studi Teknologi Informasi</p>
        
                    </div>
        
                </div>
        
            </section>
        
        
        
            <div class="container main-content">
        
                <div class="page-header">
        
                    <h1 class="page-title"><i class="fa-solid fa-calendar-days"></i> Kalender Perkuliahan</h1>
        
                    <p class="page-description">Lihat jadwal perkuliahan, ujian, dan kegiatan akademik lainnya</p>
        
                </div>
        
        
        
                <div class="filter-section">
        
                    <h3 class="filter-title"><i class="fa-solid fa-filter"></i> Filter Jadwal</h3>
        
                    <div class="row">
        
                        <div class="col-md-4 mb-3">
        
                            <label for="programFilter" class="form-label">Program Studi</label>
        
                            <select class="form-select" id="programFilter">
        
                                <option selected>Semua Program Studi</option>
        
                                <option>Teknologi Informasi</option>
        
                                <option>Sistem Informasi</option>
        
                                <option>Informatika</option>
        
                            </select>
        
                        </div>
        
                        <div class="col-md-4 mb-3">
        
                            <label for="monthFilter" class="form-label">Bulan</label>
        
                            <select class="form-select" id="monthFilter">
        
                                <option selected>September 2025</option>
        
                                <option>Oktober 2025</option>
        
                                <option>November 2025</option>
        
                                <option>Desember 2025</option>
        
                            </select>
        
                        </div>
        
                        <div class="col-md-4 mb-3">
        
                            <label for="eventTypeFilter" class="form-label">Jenis Kegiatan</label>
        
                            <select class="form-select" id="eventTypeFilter">
        
                                <option selected>Semua Kegiatan</option>
        
                                <option>Perkuliahan</option>
        
                                <option>Praktikum</option>
        
                                <option>Ujian</option>
        
                                <option>Rapat</option>
        
                            </select>
        
                        </div>
        
                    </div>
        
                </div>
        
        
        
                <div class="calendar-container">
        
                    <div class="calendar-header">
        
                        <div class="month-navigation">
        
                            <button class="btn btn-outline-primary">
        
                                <i class="fa-solid fa-chevron-left"></i>
        
                            </button>
        
                            <h2 class="month-title">September 2025</h2>
        
                            <button class="btn btn-outline-primary">
        
                                <i class="fa-solid fa-chevron-right"></i>
        
                            </button>
        
                        </div>
        
                        <div class="calendar-controls">
        
                            <button class="btn btn-outline-primary">
        
                                <i class="fa-solid fa-download"></i> Unduh
        
                            </button>
        
                            <button class="btn btn-primary">
        
                                <i class="fa-solid fa-print"></i> Cetak
        
                            </button>
        
                        </div>
        
                    </div>
        
                    
        
                    <div class="table-responsive">
        
                        <table class="calendar table table-bordered">
        
                            <thead>
        
                                <tr>
        
                                    <th>Senin</th>
        
                                    <th>Selasa</th>
        
                                    <th>Rabu</th>
        
                                    <th>Kamis</th>
        
                                    <th>Jumat</th>
        
                                    <th>Sabtu</th>
        
                                    <th>Minggu</th>
        
                                </tr>
        
                            </thead>
        
                            <tbody>
        
                                <tr>
        
                                    <td>
        
                                        <span class="day-number">1</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">2</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">3</span>
        
                                        <span class="event lecture">Pemrograman Web (08:00)</span>
        
                                        <span class="event lab">Praktikum Jaringan (13:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">4</span>
        
                                        <span class="event lecture">Basis Data (10:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">5</span>
        
                                        <span class="event meeting">Rapat Dosen (14:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">6</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">7</span>
        
                                    </td>
        
                                </tr>
        
                                <tr>
        
                                    <td>
        
                                        <span class="day-number">8</span>
        
                                        <span class="event lecture">Sistem Operasi (09:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">9</span>
        
                                        <span class="event exam">UTS - Algoritma (10:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">10</span>
        
                                        <span class="event lecture">Pemrograman Web (08:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">11</span>
        
                                        <span class="event lecture">Basis Data (10:00)</span>
        
                                        <span class="event lab">Praktikum Mobile (13:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">12</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">13</span>
        
                                        <span class="event lecture">Kuliah Umum (09:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">14</span>
        
                                    </td>
        
                                </tr>
        
                                <tr>
        
                                    <td>
        
                                        <span class="day-number">15</span>
        
                                        <span class="event lecture">Sistem Operasi (09:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">16</span>
        
                                        <span class="event lecture">Jaringan Komputer (11:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">17</span>
        
                                        <span class="event lecture">Pemrograman Web (08:00)</span>
        
                                        <span class="event lab">Praktikum Jaringan (13:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">18</span>
        
                                        <span class="event lecture">Basis Data (10:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">19</span>
        
                                        <span class="event exam">UAS - Matematika (08:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">20</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">21</span>
        
                                    </td>
        
                                </tr>
        
                                <tr>
        
                                    <td>
        
                                        <span class="day-number">22</span>
        
                                        <span class="event lecture">Sistem Operasi (09:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">23</span>
        
                                        <span class="event lecture">Jaringan Komputer (11:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">24</span>
        
                                        <span class="event lecture">Pemrograman Web (08:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">25</span>
        
                                        <span class="event lecture">Basis Data (10:00)</span>
        
                                        <span class="event lab">Praktikum Mobile (13:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">26</span>
        
                                        <span class="event exam">UAS - Pemrograman (08:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">27</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">28</span>
        
                                    </td>
        
                                </tr>
        
                                <tr>
        
                                    <td>
        
                                        <span class="day-number">29</span>
        
                                        <span class="event lecture">Sistem Operasi (09:00)</span>
        
                                    </td>
        
                                    <td>
        
                                        <span class="day-number">30</span>
        
                                        <span class="event lecture">Jaringan Komputer (11:00)</span>
        
                                        <span class="event meeting">Seminar TA (14:00)</span>
        
                                    </td>
        
                                    <td></td>
        
                                    <td></td>
        
                                    <td></td>
        
                                    <td></td>
        
                                    <td></td>
        
                                </tr>
        
                            </tbody>
        
                        </table>
        
                    </div>
        
                    
        
                    <div class="legend">
        
                        <div class="legend-item">
        
                            <div class="legend-color lecture-color"></div>
        
                            <span>Perkuliahan</span>
        
                        </div>
        
                        <div class="legend-item">
        
                            <div class="legend-color lab-color"></div>
        
                            <span>Praktikum/Lab</span>
        
                        </div>
        
                        <div class="legend-item">
        
                            <div class="legend-color exam-color"></div>
        
                            <span>Ujian</span>
        
                        </div>
        
                        <div class="legend-item">
        
                            <div class="legend-color meeting-color"></div>
        
                            <span>Rapat/Seminar</span>
        
                        </div>
        
                    </div>
        
                </div>
        
        
        
                <div class="schedule-list">
        
                    <h3 class="mb-4"><i class="fa-solid fa-list"></i> Daftar Kegiatan Bulan September 2025</h3>
        
                    
        
                    <div class="schedule-item">
        
                        <div class="schedule-date">
        
                            <div class="schedule-day">3</div>
        
                            <div class="schedule-month">Sep</div>
        
                        </div>
        
                        <div class="schedule-details">
        
                            <div class="schedule-time"><i class="fa-regular fa-clock"></i> 08:00 - 10:00</div>
        
                            <h4 class="schedule-title">Pemrograman Web</h4>
        
                            <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Ruang Kelas A, Gedung TI</div>
        
                            <span class="schedule-type type-lecture">Perkuliahan</span>
        
                        </div>
        
                    </div>
        
                    
        
                    <div class="schedule-item">
        
                        <div class="schedule-date">
        
                            <div class="schedule-day">3</div>
        
                            <div class="schedule-month">Sep</div>
        
                        </div>
        
                        <div class="schedule-details">
        
                            <div class="schedule-time"><i class="fa-regular fa-clock"></i> 13:00 - 15:00</div>
        
                            <h4 class="schedule-title">Praktikum Jaringan Komputer</h4>
        
                            <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Lab Jaringan, Gedung TI</div>
        
                            <span class="schedule-type type-lab">Praktikum</span>
        
                        </div>
        
                    </div>
        
                    
        
                    <div class="schedule-item">
        
                        <div class="schedule-date">
        
                            <div class="schedule-day">4</div>
        
                            <div class="schedule-month">Sep</div>
        
                        </div>
        
                        <div class="schedule-details">
        
                            <div class="schedule-time"><i class="fa-regular fa-clock"></i> 10:00 - 12:00</div>
        
                            <h4 class="schedule-title">Basis Data</h4>
        
                            <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Ruang Kelas B, Gedung TI</div>
        
                            <span class="schedule-type type-lecture">Perkuliahan</span>
        
                        </div>
        
                    </div>
        
                    
        
                    <div class="schedule-item">
        
                        <div class="schedule-date">
        
                            <div class="schedule-day">9</div>
        
                            <div class="schedule-month">Sep</div>
        
                        </div>
        
                        <div class="schedule-details">
        
                            <div class="schedule-time"><i class="fa-regular fa-clock"></i> 10:00 - 12:00</div>
        
                            <h4 class="schedule-title">Ujian Tengah Semester - Algoritma</h4>
        
                            <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Ruang Ujian 1, Gedung TI</div>
        
                            <span class="schedule-type type-exam">Ujian</span>
        
                        </div>
        
                    </div>
        
                    
        
                    <div class="schedule-item">
        
                        <div class="schedule-date">
        
                            <div class="schedule-day">13</div>
        
                            <div class="schedule-month">Sep</div>
        
                        </div>
        
                        <div class="schedule-details">
        
                            <div class="schedule-time"><i class="fa-regular fa-clock"></i> 09:00 - 11:00</div>
        
                            <h4 class="schedule-title">Kuliah Umum: Tren Teknologi Terkini</h4>
        
                            <div class="schedule-location"><i class="fa-solid fa-location-dot"></i> Auditorium, Gedung Utama</div>
        
                            <span class="schedule-type type-lecture">Kuliah Umum</span>
        
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
        
        <!-- Session Error Modal - Enhanced Version -->
        
            @if (session('error'))
        
            <div class="modal fade error-modal" id="sessionErrorModal" tabindex="-1" aria-labelledby="sessionErrorModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        
                <div class="modal-dialog modal-dialog-centered">
        
                    <div class="modal-content">
        
                        <div class="modal-header">
        
                            <h5 class="modal-title" id="sessionErrorModalLabel">
        
                                <i class="fas fa-exclamation-triangle"></i>
        
                                Akses Ditolak
        
                            </h5>
        
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        
                        </div>
        
                        <div class="modal-body">
        
                            <div class="error-icon-container">
        
                                <i class="fas fa-ban error-icon"></i>
        
                            </div>
        
                            
        
                            <div class="error-message">
        
                                <p class="mb-0">{{ session('error') }}</p>
        
                            </div>
        
                            
        
                            @if(strpos(session('error'), 'login') !== false || strpos(session('error'), 'Login') !== false)
        
                            <div class="error-suggestion">
        
                                <i class="fas fa-lightbulb me-2"></i>
        
                                <strong>Solusi:</strong> Silakan login terlebih dahulu untuk mengakses halaman ini.
        
                            </div>
        
                            @elseif(strpos(session('error'), 'izin') !== false || strpos(session('error'), 'akses') !== false)
        
                            <div class="error-suggestion">
        
                                <i class="fas fa-lightbulb me-2"></i>
        
                                <strong>Solusi:</strong> Hubungi administrator jika Anda merasa seharusnya memiliki akses.
        
                            </div>
        
                            @elseif(strpos(session('error'), 'valid') !== false || strpos(session('error'), 'Valid') !== false)
        
                            <div class="error-suggestion">
        
                                <i class="fas fa-lightbulb me-2"></i>
        
                                <strong>Solusi:</strong> Periksa kembali data yang Anda masukkan atau hubungi support.
        
                            </div>
        
                            @else
        
                            <div class="error-suggestion">
        
                                <i class="fas fa-lightbulb me-2"></i>
        
                                <strong>Tips:</strong> Refresh halaman atau coba lagi dalam beberapa saat.
        
                            </div>
        
                            @endif
        
                        </div>
        
                        <div class="modal-footer">
        
                            @if(strpos(session('error'), 'login') !== false || strpos(session('error'), 'Login') !== false)
        
                            <a href="{{ route('login') }}" class="btn btn-error btn-error-primary">
        
                                <i class="fas fa-sign-in-alt"></i> Login Sekarang
        
                            </a>
        
                            @endif
        
                            
        
                            <button type="button" class="btn btn-error btn-error-secondary" data-bs-dismiss="modal" id="closeErrorBtn">
        
                                <i class="fas fa-times"></i> Tutup
        
                            </button>
        
                            
        
                            @if(strpos(session('error'), 'login') === false)
        
                            <a href="/home" class="btn btn-error btn-error-outline">
        
                                <i class="fas fa-home"></i> Kembali ke Beranda
        
                            </a>
        
                            @endif
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
            @endif
        
        
        
            <!-- Success Modal Template -->
        
            <div class="modal fade success-modal" id="successModal" tabindex="-1" aria-hidden="true">
        
                <div class="modal-dialog modal-dialog-centered">
        
                    <div class="modal-content">
        
                        <div class="modal-header">
        
                            <h5 class="modal-title">
        
                                <i class="fas fa-check-circle"></i>
        
                                Berhasil!
        
                            </h5>
        
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        
                        </div>
        
                        <div class="modal-body">
        
                            <div class="error-icon-container">
        
                                <i class="fas fa-check-circle error-icon" style="color: #28a745;"></i>
        
                            </div>
        
                            
        
                            <div class="error-message" style="background: linear-gradient(135deg, #f0fff4, #e6ffe6); border-left-color: #28a745;">
        
                                <p class="mb-0" id="successMessage">Operasi berhasil diselesaikan.</p>
        
                            </div>
        
                        </div>
        
                        <div class="modal-footer">
        
                            <button type="button" class="btn btn-error btn-error-primary" data-bs-dismiss="modal">
        
                                <i class="fas fa-check"></i> Oke
        
                            </button>
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
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
        
         // Enhanced Error Modal Functionality
        
                    @if (session('error'))
        
                        var errorModal = new bootstrap.Modal(document.getElementById('sessionErrorModal'));
        
                        errorModal.show();
        
                        
        
                        // Add auto-focus to the most appropriate button
        
                        setTimeout(() => {
        
                            const primaryBtn = document.querySelector('.error-modal .btn-error-primary');
        
                            const closeBtn = document.getElementById('closeErrorBtn');
        
                            
        
                            if (primaryBtn) {
        
                                primaryBtn.focus();
        
                            } else if (closeBtn) {
        
                                closeBtn.focus();
        
                            }
        
                        }, 300);
        
                        
        
                        // Auto-hide modal after 10 seconds if user doesn't interact
        
                        let modalTimeout = setTimeout(() => {
        
                            if (document.querySelector('#sessionErrorModal.show')) {
        
                                errorModal.hide();
        
                            }
        
                        }, 10000);
        
                        
        
                        // Clear timeout on user interaction
        
                        document.getElementById('sessionErrorModal').addEventListener('click', () => {
        
                            clearTimeout(modalTimeout);
        
                        });
        
                        
        
                        // Add keyboard shortcuts
        
                        document.addEventListener('keydown', function(e) {
        
                            if (e.key === 'Escape') {
        
                                clearTimeout(modalTimeout);
        
                            }
        
                            
        
                            if (e.key === 'Enter' && document.querySelector('#sessionErrorModal.show')) {
        
                                const activeButton = document.querySelector('#sessionErrorModal .modal-footer .btn-error-primary');
        
                                if (activeButton) {
        
                                    activeButton.click();
        
                                }
        
                            }
        
                        });
        
                    @endif
        
                    
        
                    // Success Modal function for future use
        
                    window.showSuccessModal = function(message) {
        
                        const successModalEl = document.getElementById('successModal');
        
                        const successMessageEl = document.getElementById('successMessage');
        
                        
        
                        if (successMessageEl && message) {
        
                            successMessageEl.textContent = message;
        
                        }
        
                        
        
                        const successModal = new bootstrap.Modal(successModalEl);
        
                        successModal.show();
        
                        
        
                        // Auto-hide after 3 seconds
        
                        setTimeout(() => {
        
                            successModal.hide();
        
                        }, 3000);
        
                    };
        
                });
        
                
        
                // Animation on scroll
        
                const animateOnScroll = () => {
        
                    const elements = document.querySelectorAll('.filter-section, .calendar-container, .schedule-list, .schedule-item');
        
                    
        
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
        
                document.querySelectorAll('.filter-section, .calendar-container, .schedule-list, .schedule-item').forEach(element => {
                    element.style.opacity = 0;
                    element.style.transform = 'translateY(20px)';
                    element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                });
        
                window.addEventListener('scroll', animateOnScroll);
                window.addEventListener('load', animateOnScroll);
            </script>
        </body>
        </html>