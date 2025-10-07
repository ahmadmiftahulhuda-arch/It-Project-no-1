<!DOCTYPE html>
<html lang="id" x-data="{ tab: 'available' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Sistem Peminjaman Sarana Prasanara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css">
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --font-size-base: 0.9rem;
            --line-height-base: 1.5;
            --container-max-width: 1200px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: var(--font-size-base);
            line-height: var(--line-height-base);
            background-color: #f5f8fa;
            color: #333;
            scroll-behavior: smooth;
        }
        
        /* Container utama untuk konsistensi layout */
        .main-container {
            max-width: var(--container-max-width);
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* ===== NAVBAR STYLES ===== */
        .navbar {
            background-color: var(--primary-color);
            padding: 0.6rem 1rem; /* Diperkecil */
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.4rem 1rem; /* Diperkecil */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        
        .logo {
            color: white;
            font-size: 1.3rem; /* Diperkecil dari 1.5rem */
            font-weight: bold;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .logo i {
            margin-right: 8px; /* Diperkecil */
            transition: transform 0.3s;
        }
        
        .logo:hover i {
            transform: rotate(-10deg);
        }
        
        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            align-items: center;
        }
        
        .navbar ul li {
            margin-left: 1rem; /* Diperkecil */
        }
        
        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 0.4rem 0.6rem; /* Diperkecil */
            border-radius: 4px;
            transition: all 0.3s;
            font-weight: 500;
            position: relative;
            font-size: 0.9rem; /* Diperkecil dari 1rem */
        }
        
        .navbar ul li a::after {
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
        
        .navbar ul li a:hover::after, 
        .navbar ul li a.active::after {
            width: 70%;
        }
        
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            padding: 0.4rem 0.8rem; /* Diperkecil */
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem; /* Diperkecil */
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            font-size: 0.9rem; /* Diperkecil dari 1rem */
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
            padding: 3rem 0; /* Diperkecil dari 5rem */
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
            margin-bottom: 1rem; /* Diperkecil */
            font-size: 2rem; /* Diperkecil dari 2.5rem */
        }
        
        .hero-content p {
            animation: fadeInUp 1s ease;
            margin-bottom: 1.5rem; /* Diperkecil */
            font-size: 1rem; /* Diperkecil dari 1.2rem */
        }
        
        .hero-buttons {
            display: flex;
            gap: 0.8rem; /* Diperkecil */
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            background-color: white;
            color: var(--primary-color);
            border: none;
            padding: 0.6rem 1.2rem; /* Diperkecil */
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem; /* Diperkecil */
            font-size: 0.9rem; /* Diperkecil dari 1rem */
        }
        
        .btn-primary:hover {
            background-color: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline-light {
            background-color: transparent;
            color: white;
            border: 2px solid white;
            padding: 0.6rem 1.2rem; /* Diperkecil */
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem; /* Diperkecil */
            font-size: 0.9rem; /* Diperkecil dari 1rem */
        }
        
        .btn-outline-light:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        /* ===== MAIN CONTENT ===== */
        .nav-tabs .nav-item {
            margin: 0 5px;
        }

        .main-content {
            padding: 2rem 0; /* Diperkecil dari 3rem */
        }
        
        .section-title {
            color: var(--primary-color);
            margin-bottom: 1rem; /* Diperkecil */
            padding-bottom: 0.4rem; /* Diperkecil */
            border-bottom: 2px solid #eaeaea;
            display: flex;
            align-items: center;
            gap: 8px; /* Diperkecil */
            font-size: 1.5rem; /* Diperkecil dari 1.8rem */
        }
        
        /* ===== FEATURES SECTION ===== */
        .features-section {
            margin: 2rem 0; /* Diperkecil dari 3rem */
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Diperkecil dari 300px */
            gap: 1.2rem; /* Diperkecil */
            margin: 1.5rem 0; /* Diperkecil */
        }
        
        .feature-card {
            background: white;
            border-radius: 8px; /* Diperkecil */
            padding: 1.2rem; /* Diperkecil */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Diperkecil */
            transition: all 0.3s ease;
            min-height: 240px; /* Diperkecil dari 280px */
        }
        
        .feature-card:hover {
            transform: translateY(-4px); /* Diperkecil */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12); /* Diperkecil */
        }
        
        .feature-icon {
            background-color: var(--primary-color);
            color: white;
            width: 60px; /* Diperkecil dari 70px */
            height: 60px; /* Diperkecil dari 70px */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem; /* Diperkecil dari 2rem */
            margin-bottom: 1.2rem; /* Diperkecil */
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: rotate(15deg) scale(1.05); /* Diperkecil dari 1.1 */
        }
        
        .feature-content h4 {
            color: var(--primary-color);
            margin-bottom: 0.6rem; /* Diperkecil */
            font-size: 1.1rem; /* Diperkecil dari 1.3rem */
        }
        
        .feature-content p {
            font-size: 0.9rem; /* Diperkecil dari 1rem */
        }
        
        /* ===== STATS SECTION ===== */
        .stats-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0; /* Diperkecil dari 3rem */
            margin: 2rem 0; /* Diperkecil dari 3rem */
            border-radius: 10px; /* Diperkecil */
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); /* Diperkecil dari 200px */
            gap: 1.5rem; /* Diperkecil */
            text-align: center;
        }
        
        .stat-item {
            padding: 1.2rem; /* Diperkecil */
        }
        
        .stat-number {
            font-size: 2rem; /* Diperkecil dari 2.5rem */
            font-weight: bold;
            margin-bottom: 0.4rem; /* Diperkecil */
        }
        
        .stat-label {
            font-size: 1rem; /* Diperkecil dari 1.1rem */
        }
        
        /* ===== HOW IT WORKS SECTION ===== */
        .how-it-works {
            margin: 2rem 0; /* Diperkecil dari 3rem */
        }
        
        .steps-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem; /* Diperkecil dari 2rem */
            margin-top: 1.5rem; /* Diperkecil */
        }
        
        .step {
            display: flex;
            align-items: flex-start;
            gap: 1.2rem; /* Diperkecil */
            background: white;
            padding: 1.2rem; /* Diperkecil */
            border-radius: 8px; /* Diperkecil */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Diperkecil */
            transition: all 0.3s ease;
        }
        
        .step:hover {
            transform: translateX(4px); /* Diperkecil */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12); /* Diperkecil */
        }
        
        .step-number {
            background-color: var(--primary-color);
            color: white;
            width: 35px; /* Diperkecil dari 40px */
            height: 35px; /* Diperkecil dari 40px */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
            font-size: 0.9rem; /* Diperkecil */
        }
        
        .step-content h4 {
            color: var(--primary-color);
            margin-bottom: 0.4rem; /* Diperkecil */
            font-size: 1.1rem; /* Diperkecil dari 1.3rem */
        }
        
        .step-content p {
            font-size: 0.9rem; /* Diperkecil dari 1rem */
        }
        
        /* ===== TESTIMONIALS SECTION ===== */
        .testimonials-section {
            margin: 2rem 0; /* Diperkecil dari 3rem */
        }
        
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Diperkecil dari 300px */
            gap: 1.2rem; /* Diperkecil */
            margin-top: 1.2rem; /* Diperkecil */
        }
        
        .testimonial-card {
            background: white;
            border-radius: 8px; /* Diperkecil */
            padding: 1.2rem; /* Diperkecil */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Diperkecil */
            transition: all 0.3s ease;
            min-height: 180px; /* Diperkecil dari 220px */
        }
        
        .testimonial-card:hover {
            transform: translateY(-4px); /* Diperkecil */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12); /* Diperkecil */
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.2rem; /* Diperkecil */
            position: relative;
            padding-left: 1.2rem; /* Diperkecil */
            font-size: 0.9rem; /* Diperkecil dari 1rem */
        }
        
        .testimonial-text::before {
            content: """;
            position: absolute;
            left: 0;
            top: -8px; /* Diperkecil */
            font-size: 2.5rem; /* Diperkecil dari 3rem */
            color: var(--primary-color);
            font-family: Arial, sans-serif;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.8rem; /* Diperkecil */
        }
        
        .author-avatar {
            width: 45px; /* Diperkecil dari 50px */
            height: 45px; /* Diperkecil dari 50px */
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem; /* Diperkecil dari 1.2rem */
        }
        
        .author-info h5 {
            color: var(--primary-color);
            margin-bottom: 0.2rem;
            font-size: 1rem; /* Diperkecil dari 1.1rem */
        }
        
        .author-info p {
            color: #6c757d;
            font-size: 0.85rem; /* Diperkecil dari 0.9rem */
        }
        
        /* ===== CTA SECTION ===== */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0; /* Diperkecil dari 3rem */
            border-radius: 10px; /* Diperkecil */
            text-align: center;
            margin: 2rem 0; /* Diperkecil dari 3rem */
        }
        
        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .cta-content h2 {
            margin-bottom: 1.2rem; /* Diperkecil */
            font-size: 1.7rem; /* Diperkecil dari 2rem */
        }
        
        .cta-content p {
            margin-bottom: 1.5rem; /* Diperkecil */
            font-size: 1rem; /* Diperkecil dari 1.2rem */
        }
        
        /* ===== TAB NAVIGATION ===== */
        .tab-container {
            max-width: var(--container-max-width);
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .tab-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem; /* Diperkecil */
            background-color: #f1f5f9;
            padding: 0.4rem; /* Diperkecil */
            border-radius: 0.4rem; /* Diperkecil */
            margin-bottom: 1.2rem; /* Diperkecil */
            display: flex;
            justify-content: center; /* ketengah */
            gap: 15px;               /* jarak antar tombol */
            flex-wrap: wrap;         /* biar tidak overflow di layar kecil */
        }
        
        .tab-button {
            display: flex;
            align-items: center;
            gap: 0.4rem; /* Diperkecil */
            padding: 0.6rem 0.8rem; /* Diperkecil */
            border-radius: 0.3rem; /* Diperkecil */
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 0.9rem; /* Diperkecil dari 0.95rem */
        }
        
        .tab-button.active {
            background-color: #3b82f6;
            color: white;
        }
        
        .tab-button:not(.active) {
            background-color: transparent;
            color: #4b5563;
        }
        
        .tab-button:not(.active):hover {
            background-color: #e2e8f0;
        }
        
        /* Filter Section */
        .filter-section {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 0.4rem; /* Diperkecil */
            padding: 1.2rem; /* Diperkecil */
            margin-bottom: 1.2rem; /* Diperkecil */
        }
        
        .filter-section h3 {
            font-size: 1.1rem; /* Diperkecil dari 1.25rem */
            font-weight: 600;
            margin-bottom: 0.8rem; /* Diperkecil */
        }
        
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); /* Diperkecil dari 200px */
            gap: 0.8rem; /* Diperkecil */
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-group label {
            font-size: 0.8rem; /* Diperkecil dari 0.875rem */
            font-weight: 500;
            margin-bottom: 0.4rem; /* Diperkecil */
        }
        
        .filter-group input,
        .filter-group select {
            padding: 0.4rem; /* Diperkecil */
            border: 1px solid #d1d5db;
            border-radius: 0.3rem; /* Diperkecil */
            font-size: 0.9rem; /* Diperkecil dari 0.95rem */
        }
        
        .quick-filters {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.8rem; /* Diperkecil */
            padding-top: 0.8rem; /* Diperkecil */
            border-top: 1px solid #e5e7eb;
        }
        
        .quick-filter-buttons {
            display: flex;
            gap: 0.4rem; /* Diperkecil */
            flex-wrap: wrap;
        }
        
        .quick-filter-button {
            padding: 0.3rem 0.6rem; /* Diperkecil */
            border-radius: 9999px;
            font-size: 0.8rem; /* Diperkecil dari 0.875rem */
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        
        .reset-button {
            display: flex;
            align-items: center;
            gap: 0.2rem; /* Diperkecil */
            background: none;
            border: none;
            color: #6b7280;
            font-size: 0.8rem; /* Diperkecil dari 0.875rem */
            cursor: pointer;
        }
        
        .reset-button:hover {
            color: #374151;
        }
        
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 25px; /* Diperkecil */
            right: 25px; /* Diperkecil */
            width: 45px; /* Diperkecil dari 50px */
            height: 45px; /* Diperkecil dari 50px */
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
            transform: translateY(-4px); /* Diperkecil */
        }
        
        /* ===== ANIMATIONS ===== */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-15px); /* Diperkecil */
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px); /* Diperkecil */
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shine {
            from {
                left: -100%;
            }
            to {
                left: 100%;
            }
        }
        
        /* ===== FOOTER STYLES ===== */
        .footer {
            background-color: #2d3748;
            color: white;
            padding: 30px 0 15px; /* Diperkecil */
            margin-top: 1.5rem; /* Diperkecil */
        }
        
        .footer-container {
            max-width: var(--container-max-width);
            margin: 0 auto;
            padding: 0 15px; /* Diperkecil */
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Diperkecil dari 250px */
            gap: 25px; /* Diperkecil */
        }
        
        .footer-section h3 {
            font-size: 1.3rem; /* Diperkecil dari 1.5rem */
            margin-bottom: 15px; /* Diperkecil */
            position: relative;
            padding-bottom: 8px; /* Diperkecil */
        }
        
        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px; /* Diperkecil */
            height: 2px;
            background-color: #1a56db;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px; /* Diperkecil */
        }
        
        .footer-links a {
            color: #e5e7eb;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            font-size: 0.9rem; /* Diperkecil */
        }
        
        .footer-links a:hover {
            color: #1a56db;
            padding-left: 4px; /* Diperkecil */
        }
        
        .contact-info {
            margin-bottom: 12px; /* Diperkecil */
            display: flex;
            align-items: flex-start;
            font-size: 0.9rem; /* Diperkecil */
        }
        
        .contact-info i {
            margin-right: 8px; /* Diperkecil */
            color: #1a56db;
            min-width: 16px; /* Diperkecil */
        }
        
        .social-icons {
            display: flex;
            gap: 12px; /* Diperkecil */
            margin-top: 15px; /* Diperkecil */
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px; /* Diperkecil dari 40px */
            height: 35px; /* Diperkecil dari 40px */
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background-color: #1a56db;
            transform: translateY(-2px); /* Diperkecil */
        }
        
        .opening-hours {
            margin-bottom: 12px; /* Diperkecil */
        }
        
        .opening-hours div {
            margin-bottom: 4px; /* Diperkecil */
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem; /* Diperkecil */
        }
        
        .footer-bottom {
            max-width: var(--container-max-width);
            margin: 25px auto 0; /* Diperkecil */
            padding: 15px; /* Diperkecil */
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.85rem; /* Diperkecil */
        }
        
        /* ===== RESPONSIVE ADJUSTMENTS ===== */
        @media (max-width: 992px) {
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar ul li {
                margin: 0.2rem; /* Diperkecil */
            }
            
            .hero-content h1 {
                font-size: 1.7rem; /* Diperkecil dari 2rem */
            }
            
            .section-title {
                font-size: 1.3rem; /* Diperkecil dari 1.5rem */
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 0.8rem; /* Diperkecil */
            }
            
            .logo {
                margin-bottom: 0.8rem; /* Diperkecil */
                font-size: 1.1rem; /* Diperkecil dari 1.3rem */
            }
            
            .hero-section {
                padding: 2rem 0; /* Diperkecil dari 3rem */
            }
            
            .hero-content h1 {
                font-size: 1.5rem; /* Diperkecil dari 1.8rem */
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .features-grid, .testimonials-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .step {
                flex-direction: column;
                text-align: center;
            }
            
            .tab-nav {
                flex-direction: column;
            }
            
            .filter-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-filters {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.8rem; /* Diperkecil */
            }
            
            .footer-container {
                grid-template-columns: 1fr;
                gap: 15px; /* Diperkecil */
            }
            
            .footer-section h3 {
                font-size: 1.1rem; /* Diperkecil dari 1.3rem */
            }
            
            .back-to-top {
                bottom: 15px; /* Diperkecil */
                right: 15px; /* Diperkecil */
                width: 35px; /* Diperkecil dari 40px */
                height: 35px; /* Diperkecil dari 40px */
            }
        }
        
        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 1.3rem; /* Diperkecil dari 1.5rem */
            }
            
            .hero-content p {
                font-size: 0.9rem; /* Diperkecil dari 1rem */
            }
            
            .section-title {
                font-size: 1.1rem; /* Diperkecil dari 1.3rem */
            }
            
            .feature-card, .testimonial-card {
                padding: 0.8rem; /* Diperkecil */
            }
            
            .stat-number {
                font-size: 1.7rem; /* Diperkecil dari 2rem */
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <a href="/home" class="logo">
            <i class="fas fa-building"></i>SarPras TI
        </a>
        <ul>
            <li><a href="/home" class="active">Beranda</a></li>
            <li><a href="/kalender">Kalender Perkuliahan</a></li>
            <li><a href="/peminjaman">Daftar Peminjaman</a></li>
            <li><a href="/about">Tentang</a></li>
            <li>
                <a href="/login" class="btn-warning">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            </li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="main-container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold">Sistem Peminjaman Sarana Prasarana</h1>
                <p class="lead">Platform digital untuk pengelolaan dan peminjaman fasilitas di Program Studi Teknologi Informasi</p>
                <div class="hero-buttons">
                    <a href="/peminjaman" class="btn-primary">
                        <i class="fa-solid fa-calendar-check"></i> Ajukan Peminjaman
                    </a>
                    <a href="/kalender" class="btn-outline-light">
                        <i class="fa-solid fa-calendar-days"></i> Lihat Kalender
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <div class="tab-container">
        <div class="tab-nav">
            <button @click="tab='available'" 
                :class="tab==='available' ? 'tab-button active' : 'tab-button'">
            <i class="ri-calendar-check-line"></i><span>Info Ruangan Tersedia</span>
            </button>

            <button @click="tab='used'" 
                    :class="tab==='used' ? 'tab-button active' : 'tab-button'">
                <i class="ri-calendar-close-line"></i><span>Info Ruangan Terpakai</span>
            </button>

            <button @click="tab='projectors'" 
                    :class="tab==='projectors' ? 'tab-button active' : 'tab-button'">
                <i class="ri-slideshow-line"></i><span>Status Proyektor</span>
            </button>

            <button @click="tab='statistics'" 
                    :class="tab==='statistics' ? 'tab-button active' : 'tab-button'">
                <i class="ri-bar-chart-line"></i><span>Statistik Penggunaan</span>
            </button>
        </div>
    </div>


    <!-- Filter Section -->
    <div class="tab-container">
        <div class="filter-section">
            <h3>Filter Pencarian</h3>
            <div class="filter-grid">
                <!-- Tanggal -->
                <div class="filter-group">
                    <label>Tanggal</label>
                    <input type="date" class="w-full mt-1 border rounded-md px-3 py-2">
                </div>

                <!-- Kapasitas -->
                <div class="filter-group">
                    <label>Kapasitas</label>
                    <select>
                        <option>Pilih Kapasitas</option>
                        <option>1-10 orang</option>
                        <option>11-20 orang</option>
                        <option>21-50 orang</option>
                        <option>50+ orang</option>
                    </select>
                </div>

                <!-- Tipe Ruangan -->
                <div class="filter-group">
                    <label>Tipe Ruangan</label>
                    <select>
                        <option>Pilih Tipe</option>
                        <option>Ruang Kelas</option>
                        <option>Laboratorium</option>
                        <option>Ruang Rapat</option>
                        <option>Aula</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="filter-group">
                    <label>Lokasi</label>
                    <select>
                        <option>Pilih Lokasi</option>
                        <option>Gedung A</option>
                        <option>Gedung B</option>
                        <option>Gedung C</option>
                        <option>Gedung D</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter -->
            <div class="quick-filters">
                <div class="quick-filter-buttons">
                    <span>Quick Filter:</span>
                    <button class="quick-filter-button" style="background-color: #d1fae5; color: #065f46;">Tersedia Hari Ini</button>
                    <button class="quick-filter-button" style="background-color: #dbeafe; color: #1e40af;">Lab Tersedia</button>
                </div>
                <button class="reset-button">
                    <i class="ri-refresh-line"></i> Reset Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Tab Content -->
<div class="tab-container">
    <div x-show="tab==='available'">
        @include('rooms.available')
    </div>

    <div x-show="tab==='used'">
        @include('rooms.used')
    </div>

    <div x-show="tab==='projectors'">
        @include('rooms.projectors')
    </div>

    <div x-show="tab==='statistics'">
        @include('rooms.statistics')
    </div>
</div>
    <!-- Main Content -->
    <div class="main-container main-content">
        <!-- Features Section -->
        <section class="features-section">
            <h2 class="section-title">
                <i class="fa-solid fa-star"></i> Layanan Kami
            </h2>
            <p>Kami menyediakan berbagai layanan untuk mendukung kegiatan akademik di Program Studi Teknologi Informasi</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Peminjaman Ruangan</h4>
                        <p>Pinjam ruangan kelas, laboratorium, atau ruang meeting dengan mudah dan cepat.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Peminjaman Proyektor</h4>
                        <p>Layanan peminjaman proyektor untuk keperluan presentasi dan pembelajaran.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Peminjaman Perangkat</h4>
                        <p>Pinjam perangkat TI seperti laptop, tablet, atau perangkat pendukung lainnya.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- How It Works Section -->
        <section class="how-it-works">
            <h2 class="section-title">
                <i class="fa-solid fa-gears"></i> Cara Kerja Sistem
            </h2>
            <p>Proses peminjaman yang mudah dan cepat melalui beberapa langkah sederhana</p>
            
            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Login ke Sistem</h4>
                        <p>Masuk ke sistem menggunakan akun kampus Anda yang terdaftar.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Pilih Jenis Peminjaman</h4>
                        <p>Tentukan apakah Anda ingin meminjam ruangan, proyektor, atau perangkat lainnya.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Periksa Ketersediaan</h4>
                        <p>Lihat kalender untuk memastikan fasilitas yang Anda butuhkan tersedia pada waktu yang diinginkan.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Ajukan Peminjaman</h4>
                        <p>Isi formulir peminjaman dengan detail yang diperlukan dan kirim permintaan Anda.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <h4>Konfirmasi & Pengambilan</h4>
                        <p>Tunggu konfirmasi dan ambil fasilitas yang dipinjam pada waktu yang telah ditentukan.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <h2 class="section-title">
                <i class="fa-solid fa-comment"></i> Feedback Peminjaman SarPras TI
            </h2>
            <p>Apa kata mereka tentang sistem peminjaman kami</p>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        Sistem yang sangat memudahkan untuk meminjam ruangan dan proyektor. Tidak perlu lagi antri atau menunggu lama untuk konfirmasi.
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h5>Prof. Dr. Tahul Ambatukam</h5>
                            <p>Dosen Teknologi Informasi</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        Sebagai mahasiswa, saya sangat terbantu dengan adanya sistem ini. Bisa meminjam proyektor untuk melakukan perkuliahan dengan mudah.
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h5>M. Dimas Aprianto</h5>
                            <p>Mahasiswa TI Angkatan 2024</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        Sistem ini memudahkan saya untuk melakukan pengecekan ketersedian ruangan untuk saya meminjam yang akan saya gunakan untuk Seminar Proposal.
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h5>Ferdi 55</h5>
                            <p>Mahasiswa TI Angkatan 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Back to top button -->
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
        
        // Animation on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.feature-card, .step, .testimonial-card');
            
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
        document.querySelectorAll('.feature-card, .step, .testimonial-card').forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });
        
        // Counter animation for stats
        const startCounters = () => {
            const counters = document.querySelectorAll('.stat-number');
            const speed = 200;
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target') || counter.innerText.replace('+', ''));
                const count = +counter.innerText.replace('+', '');
                const increment = Math.ceil(target / speed);
                
                if (count < target) {
                    counter.innerText = Math.min(count + increment, target) + '+';
                    setTimeout(() => startCounters(), 1);
                }
            });
        };
        
        // Initialize counters with data attributes
        document.addEventListener('DOMContentLoaded', () => {
            // Start counter animation when stats section is in view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCounters();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(document.querySelector('.stats-section'));
        });
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>