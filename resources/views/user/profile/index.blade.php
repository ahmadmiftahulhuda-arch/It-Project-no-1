<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - Sistem Peminjaman Sarana Prasarana</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            --verification-color: #ff6b35;
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

        /* ===== BREADCRUMB STYLES ===== */
        .breadcrumb-custom {
            background-color: white;
            padding: 1rem 0;
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

        /* ===== CARD STYLES ===== */
        .card-profile {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 2rem;
        }

        .card-profile:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .card-header-profile {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }

        .card-header-profile::before {
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

        .card-header-profile h4 {
            position: relative;
            z-index: 1;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-profile h4 i {
            font-size: 1.8rem;
        }

        .card-body-profile {
            padding: 2rem;
        }

        /* ===== FORM STYLES ===== */
        .form-label-profile {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label-profile i {
            font-size: 0.9rem;
        }

        .form-control-profile {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control-profile:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 89, 152, 0.15);
        }

        .form-control-profile.is-invalid {
            border-color: var(--danger-color);
        }

        .form-text-profile {
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ===== SECTION DIVIDER ===== */
        .section-divider {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, #e9ecef, transparent);
            margin: 2rem 0;
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #eaeaea;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            font-size: 1.3rem;
        }

        /* ===== BUTTON STYLES ===== */
        .btn-profile-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
        }

        .btn-profile-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 89, 152, 0.2);
            color: white;
        }

        .btn-profile-secondary {
            background-color: #f8f9fa;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            text-decoration: none;
            text-align: center;
        }

        .btn-profile-secondary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 89, 152, 0.2);
        }

        /* ===== ALERT STYLES ===== */
        .alert-profile {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .alert-profile-success {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid var(--success-color);
            color: #155724;
        }

        .alert-profile-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid var(--danger-color);
            color: #721c24;
        }

        .alert-profile-danger ul {
            margin-bottom: 0;
            padding-left: 1.5rem;
        }

        .alert-profile-danger li {
            margin-bottom: 0.25rem;
        }

        /* ===== USER INFO CARD ===== */
        .user-info-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary-color);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .user-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .user-detail i {
            color: var(--primary-color);
            width: 20px;
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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .card-body-profile {
                padding: 1.5rem;
            }
            
            .card-header-profile {
                padding: 1.25rem;
            }
            
            .btn-profile-primary,
            .btn-profile-secondary {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }
            
            .breadcrumb-custom {
                padding: 0.75rem 0;
                margin-bottom: 1.5rem;
            }
            
            .footer-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
        
        @media (max-width: 576px) {
            .card-body-profile {
                padding: 1rem;
            }
            
            .form-control-profile {
                padding: 0.7rem 0.9rem;
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
        }
        
        /* ===== VERIFICATION MODAL STYLES ===== */
        .verification-modal .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(255, 107, 53, 0.25);
            animation: modalAppear 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid rgba(255, 107, 53, 0.2);
        }

        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(30px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .verification-modal .modal-header {
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
            color: white;
            padding: 2rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }

        .verification-modal .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.15' d='M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,218.7C672,224,768,160,864,138.7C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center;
        }

        .verification-modal .modal-title {
            font-size: 1.6rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .verification-modal .modal-title i {
            font-size: 2rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .verification-modal .modal-body {
            padding: 3rem 2.5rem;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #495057;
            text-align: center;
            background-color: #fffaf8;
        }

        .verification-modal .verification-icon-container {
            margin-bottom: 2rem;
        }

        .verification-modal .verification-icon {
            font-size: 5rem;
            color: #ff6b35;
            margin-bottom: 1.5rem;
            display: inline-block;
            animation: pulse 2s infinite ease-in-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        .verification-modal .verification-message {
            background: linear-gradient(135deg, #fff5f1, #ffe8e0);
            border-left: 5px solid #ff6b35;
            padding: 1.8rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            text-align: left;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.1);
            position: relative;
        }

        .verification-modal .verification-message::before {
            content: '"';
            position: absolute;
            top: -20px;
            left: 20px;
            font-size: 4rem;
            color: rgba(255, 107, 53, 0.2);
            font-family: Georgia, serif;
        }

        .verification-modal .verification-steps {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 12px;
            margin-top: 2rem;
            border: 2px dashed #dee2e6;
        }

        .verification-modal .step-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 1rem;
            padding: 0.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .verification-modal .step-item:hover {
            background-color: rgba(255, 107, 53, 0.05);
        }

        .verification-modal .step-number {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .verification-modal .step-content {
            flex: 1;
            text-align: left;
        }

        .verification-modal .step-title {
            font-weight: 600;
            color: #ff6b35;
            margin-bottom: 0.3rem;
        }

        .verification-modal .step-desc {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .verification-modal .verification-reminder {
            background: linear-gradient(135deg, rgba(59, 89, 152, 0.08), rgba(108, 117, 125, 0.05));
            padding: 1.2rem;
            border-radius: 10px;
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid var(--primary-color);
        }

        .verification-modal .verification-reminder i {
            color: var(--primary-color);
            font-size: 1.3rem;
        }

        .verification-modal .modal-footer {
            border-top: none;
            padding: 2rem 2.5rem;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .verification-modal .btn-verification {
            padding: 0.9rem 2.5rem;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
            min-width: 180px;
            justify-content: center;
            font-size: 1.05rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .verification-modal .btn-verification-primary {
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
            color: white;
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.3);
        }

        .verification-modal .btn-verification-primary:hover {
            background: linear-gradient(135deg, #ff5722, #ff7043);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4);
        }

        .verification-modal .btn-verification-secondary {
            background-color: #6c757d;
            color: white;
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.2);
        }

        .verification-modal .btn-verification-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(108, 117, 125, 0.3);
        }

        .verification-modal .btn-verification-outline {
            background-color: transparent;
            color: #ff6b35;
            border: 3px solid #ff6b35;
            font-weight: 700;
        }

        .verification-modal .btn-verification-outline:hover {
            background-color: #ff6b35;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        /* Responsive adjustments for verification modal */
        @media (max-width: 768px) {
            .verification-modal .modal-dialog {
                margin: 1rem;
            }

            .verification-modal .modal-header {
                padding: 1.5rem;
            }

            .verification-modal .modal-body {
                padding: 2rem 1.5rem;
            }

            .verification-modal .modal-footer {
                padding: 1.5rem;
                flex-direction: column;
            }

            .verification-modal .btn-verification {
                width: 100%;
                min-width: auto;
            }

            .verification-modal .verification-icon {
                font-size: 4rem;
            }
        }

        @media (max-width: 576px) {
            .verification-modal .modal-header {
                padding: 1.25rem;
            }

            .verification-modal .modal-body {
                padding: 1.5rem 1.25rem;
            }

            .verification-modal .modal-title {
                font-size: 1.3rem;
            }

            .verification-modal .verification-icon {
                font-size: 3.5rem;
            }

            .verification-modal .verification-message {
                padding: 1.25rem;
            }

            .verification-modal .step-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        /* Status indicator for unverified users */
        .verification-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            animation: statusPulse 2s infinite;
        }

        .verification-status.unverified {
            background-color: rgba(255, 107, 53, 0.15);
            color: #ff6b35;
            border: 2px solid rgba(255, 107, 53, 0.3);
        }

        @keyframes statusPulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 107, 53, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(255, 107, 53, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 107, 53, 0); }
        }

        .verification-status.verified {
            background-color: rgba(40, 167, 69, 0.15); /* Greenish background */
            color: #28a745; /* Green text */
            border: 2px solid rgba(40, 167, 69, 0.3);
            animation: statusPulseGreen 2s infinite; /* A slightly different pulse */
        }

        @keyframes statusPulseGreen {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }

        /* ===== ENHANCED ERROR POPUP STYLES (for other errors) ===== */
        .error-modal .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalAppear 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
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

        .error-modal .modal-title i {
            font-size: 1.6rem;
            animation: pulse 2s infinite;
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
                                {{ $user->display_name }}
                                <span class="custom-arrow">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="userDropdown">
                                <li class="dropdown-header-custom">Masuk sebagai</li>
                                <li class="dropdown-header-custom fw-bold">{{ $user->display_name }}</li>
                                <li>
                                    <hr class="dropdown-divider-custom">
                                </li>
                                <li>
                                    <a class="dropdown-item-custom active" href="{{ route('user.profile.index') }}">
                                        <i class="fas fa-user fa-fw me-2"></i> Pengaturan Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item-custom {{ Request::routeIs('user.settings.index') ? 'active' : '' }}" href="{{ route('user.settings.index') }}">
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
                        <i class="fas fa-user-cog me-1"></i> Pengaturan Profil
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- User Info Card -->
                <div class="user-info-card">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->display_name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <!-- Status Verifikasi -->
                        @if(!$user->verified)
                        <div class="verification-status unverified">
                            <i class="fas fa-exclamation-circle"></i>
                            Akun Belum Diverifikasi
                        </div>
                        @else
                        <div class="verification-status verified">
                            <i class="fas fa-check-circle"></i>
                            Akun Telah Diverifikasi
                        </div>
                        @endif
                        
                        <div class="user-detail">
                            <i class="fas fa-user"></i>
                            <span><strong>Nama:</strong> {{ $user->display_name }}</span>
                        </div>
                        <div class="user-detail">
                            <i class="fas fa-envelope"></i>
                            <span><strong>Email:</strong> {{ $user->email }}</span>
                        </div>
                        @if($user->no_hp)
                        <div class="user-detail">
                            <i class="fas fa-phone"></i>
                            <span><strong>No. Telepon:</strong> {{ $user->no_hp }}</span>
                        </div>
                        @endif
                        <div class="user-detail">
                            <i class="fas fa-calendar-alt"></i>
                            <span><strong>Bergabung:</strong> {{ $user->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Profile Settings Card -->
                <div class="card-profile">
                    <div class="card-header-profile">
                        <h4><i class="fas fa-user-cog"></i> Pengaturan Profil</h4>
                    </div>
                    <div class="card-body-profile">
                        @if (session('success'))
                            <div class="alert alert-profile-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-profile-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terjadi kesalahan:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Alert untuk user belum diverifikasi -->
                        @if(!$user->verified)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="border-left: 4px solid #ff6b35; background-color: rgba(255, 107, 53, 0.1);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-clock me-3" style="font-size: 1.5rem; color: #ff6b35;"></i>
                                <div>
                                    <h5 class="alert-heading mb-2" style="color: #ff6b35;">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        Akun Anda Belum Diverifikasi
                                    </h5>
                                    <p class="mb-0">
                                        Untuk menggunakan semua fitur sistem, silakan lengkapi verifikasi akun Anda.
                                        <a href="#" class="alert-link" data-bs-toggle="modal" data-bs-target="#verificationModal">
                                            Klik di sini untuk petunjuk verifikasi
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Pribadi Section -->
                            <h5 class="section-title"><i class="fas fa-user"></i> Informasi Pribadi</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label-profile">
                                        <i class="fas fa-user"></i> Nama Lengkap
                                    </label>
                                    <input type="text" class="form-control form-control-profile @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text-profile">
                                        <i class="fas fa-info-circle"></i> Nama lengkap Anda yang terdaftar
                                    </small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nim" class="form-label-profile">
                                        <i class="fas fa-id-card"></i> NIM
                                    </label>
                                    <input type="text" class="form-control form-control-profile @error('nim') is-invalid @enderror"
                                           id="nim" name="nim" value="{{ old('nim', $user->nim) }}">
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text-profile">
                                        <i class="fas fa-info-circle"></i> Nomor Induk Mahasiswa Anda
                                    </small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label-profile">
                                        <i class="fas fa-envelope"></i> Alamat Email
                                    </label>
                                    <input type="email" class="form-control form-control-profile @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required readonly>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text-profile">
                                        <i class="fas fa-info-circle"></i> Alamat email yang aktif
                                    </small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label-profile">
                                        <i class="fas fa-phone"></i> Nomor Telepon
                                    </label>
                                    <input type="text" class="form-control form-control-profile @error('no_hp') is-invalid @enderror" 
                                           id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" 
                                           placeholder="Contoh: 081234567890">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text-profile">
                                        <i class="fas fa-info-circle"></i> Wajib, untuk notifikasi WhatsApp
                                    </small>
                                </div>
                            </div>


                            <hr class="section-divider">

                            <!-- Ubah Kata Sandi Section -->
                            <h5 class="section-title"><i class="fas fa-lock"></i> Keamanan Akun</h5>
                            <p class="text-muted mb-4">
                                <i class="fas fa-shield-alt me-2"></i>Kosongkan kolom password jika Anda tidak ingin mengubah kata sandi.
                            </p>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label-profile">
                                        <i class="fas fa-key"></i> Kata Sandi Baru
                                    </label>
                                    <input type="password" class="form-control form-control-profile @error('password') is-invalid @enderror" 
                                           id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text-profile">
                                        <i class="fas fa-info-circle"></i> Minimal 8 karakter
                                    </small>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation" class="form-label-profile">
                                        <i class="fas fa-key"></i> Konfirmasi Kata Sandi
                                    </label>
                                    <input type="password" class="form-control form-control-profile" 
                                           id="password_confirmation" name="password_confirmation">
                                    <small class="form-text-profile">
                                        <i class="fas fa-info-circle"></i> Ulangi kata sandi baru Anda
                                    </small>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-4">
                                <div class="col-md-6 mb-3">
                                    <button type="submit" class="btn-profile-primary">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <a href="{{ route('home') }}" class="btn-profile-secondary">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
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

    <!-- ===== VERIFICATION MODAL (User Belum Diverifikasi) ===== -->
    @if(!$user->verified)
    <div class="modal fade verification-modal" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verificationModalLabel">
                        <i class="fas fa-user-check"></i>
                        Verifikasi Akun Anda
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="verification-icon-container">
                        <i class="fas fa-user-clock verification-icon"></i>
                    </div>
                    
                    <div class="verification-message">
                        <h4 class="mb-3">Halo, {{ $user->display_name }}! 👋</h4>
                        <p class="mb-2">Akun Anda saat ini <strong>belum diverifikasi</strong>. Untuk dapat menggunakan semua fitur sistem peminjaman, silakan selesaikan proses verifikasi berikut:</p>
                    </div>
                    
                    <div class="verification-steps">
                        <h5 class="mb-3"><i class="fas fa-list-ol me-2"></i> Langkah-langkah Verifikasi:</h5>
                        
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <div class="step-title">Lengkapi Data Profil</div>
                                <div class="step-desc">Pastikan semua informasi profil Anda sudah lengkap dan benar, termasuk NIM dan nomor telepon.</div>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <div class="step-title">Hubungi Administrator</div>
                                <div class="step-desc">Kunjungi kantor Program Studi Teknologi Informasi dengan membawa kartu identitas mahasiswa (KTM) asli.</div>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <div class="step-title">Verifikasi Dokumen</div>
                                <div class="step-desc">Administrator akan memverifikasi identitas Anda dan mengaktifkan akun dalam 1-2 hari kerja.</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="verification-reminder">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <strong>Catatan Penting:</strong> Anda masih dapat mengubah data profil, namun <strong>tidak dapat melakukan peminjaman</strong> sampai akun diverifikasi.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="https://wa.me/6281528438544?text=Halo,%20saya%20{{ urlencode($user->display_name) }}%20ingin%20verifikasi%20akun%20PINTER%20untuk%20keperluan%20(sebutkan%20keperluan%20anda)." 
                       class="btn btn-verification btn-verification-primary" target="_blank">
                        <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                    </a>
                    
                    <button type="button" class="btn btn-verification btn-verification-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                    
                    <button type="button" class="btn btn-verification btn-verification-outline" onclick="location.reload()">
                        <i class="fas fa-sync-alt"></i> Perbarui Status
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== SESSION ERROR MODAL (for other errors) ===== -->
    @if (session('error') && strpos(session('error'), 'verifikasi') === false)
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

            // Enhanced Verification Modal Functionality
            @if(!$user->verified)
                // Show verification modal automatically after 2 seconds
                setTimeout(() => {
                    var verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
                    verificationModal.show();
                    
                    // Add auto-focus to the most appropriate button
                    setTimeout(() => {
                        const primaryBtn = document.querySelector('.verification-modal .btn-verification-primary');
                        if (primaryBtn) {
                            primaryBtn.focus();
                        }
                    }, 400);
                    
                    // Auto-hide modal after 30 seconds if user doesn't interact
                    let modalTimeout = setTimeout(() => {
                        if (document.querySelector('#verificationModal.show')) {
                            verificationModal.hide();
                        }
                    }, 30000);
                    
                    // Clear timeout on user interaction
                    document.getElementById('verificationModal').addEventListener('click', () => {
                        clearTimeout(modalTimeout);
                    });
                    
                    // Add keyboard shortcuts
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            clearTimeout(modalTimeout);
                        }
                        
                        if (e.key === 'Enter' && document.querySelector('#verificationModal.show')) {
                            const activeButton = document.querySelector('#verificationModal .modal-footer .btn-verification-primary');
                            if (activeButton) {
                                activeButton.click();
                            }
                        }
                    });
                }, 2000);
            @endif

            // Enhanced Error Modal Functionality (for other errors)
            @if (session('error') && strpos(session('error'), 'verifikasi') === false)
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

        // Password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Add eye icons to password fields
            const passwordInputs = document.querySelectorAll('input[type="password"]');
            
            passwordInputs.forEach(input => {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative';
                
                const eyeIcon = document.createElement('span');
                eyeIcon.className = 'position-absolute end-0 top-50 translate-middle-y me-3';
                eyeIcon.style.cursor = 'pointer';
                eyeIcon.innerHTML = '<i class="fas fa-eye" style="color: #6c757d;"></i>';
                
                input.parentNode.insertBefore(wrapper, input);
                wrapper.appendChild(input);
                wrapper.appendChild(eyeIcon);
                
                eyeIcon.addEventListener('click', function() {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    const icon = this.querySelector('i');
                    if (type === 'text') {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
            
            // Form validation enhancement
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const password = document.getElementById('password');
                const confirmPassword = document.getElementById('password_confirmation');
                
                if (password.value || confirmPassword.value) {
                    if (password.value !== confirmPassword.value) {
                        e.preventDefault();
                        showErrorToast('Kata sandi dan konfirmasi kata sandi tidak cocok!');
                        confirmPassword.focus();
                    }
                }
            });
            
            // Add animation to cards
            const cards = document.querySelectorAll('.card-profile, .user-info-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Toast notification function
        function showErrorToast(message, type = 'error') {
            const toastId = 'toast-' + Date.now();
            const toastHtml = `
                <div class="toast align-items-center text-bg-${type === 'error' ? 'danger' : 'success'} border-0" 
                     id="${toastId}" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                                data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', toastHtml);
            
            const toast = new bootstrap.Toast(document.getElementById(toastId), {
                autohide: true,
                delay: 5000
            });
            toast.show();
            
            // Remove from DOM after hide
            document.getElementById(toastId).addEventListener('hidden.bs.toast', function() {
                this.remove();
            });
        }

        // Check verification status periodically
        @if(!$user->verified)
        function checkVerificationStatus() {
            fetch('/api/check-verification')
                .then(response => response.json())
                .then(data => {
                    if (data.is_verified) {
                        // User is now verified, reload page
                        showSuccessModal('Selamat! Akun Anda telah diverifikasi. Halaman akan direfresh.');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                })
                .catch(error => console.error('Error checking verification:', error));
        }

        // Check every 30 seconds
        setInterval(checkVerificationStatus, 30000);
        @endif
    </script>
</body>
</html>