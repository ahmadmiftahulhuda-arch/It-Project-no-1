<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman - Sistem Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ===== VARIABEL CSS ===== */
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

        /* ===== TOMBOL ===== */
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

        /* ===== KONTEN UTAMA ===== */
        .container.main-content {
            flex: 1;
        }

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

        .status-terlambat {
            background-color: #f8d7da;
            color: #842029;
            border-color: #f5c2c7;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-berlangsung {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #0d4521;
            border: 1px solid #28a745;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(40, 167, 69, 0.2);
            font-weight: 600;
        }

        .status-berlangsung::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 2.5s infinite linear;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .pulse-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #28a745;
            border-radius: 50%;
            margin-right: 5px;
            animation: pulse 1.5s infinite ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(0.8);
                opacity: 1;
            }

            50% {
                transform: scale(1.3);
                opacity: 0.6;
            }
        }

        .status-selesai {
            background-color: #e2e3e5;
            color: #383d41;
            border-color: #d6d8db;
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

        /* ===== SEARCH CONTAINER ===== */
        .search-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .search-container i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.95rem;
            pointer-events: none;
        }

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

        .search-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        .search-input:hover {
            border-color: #cbd5e1;
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        /* ===== PAGINATION ===== */
        .pagination-custom .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination-custom .page-link {
            color: var(--primary-color);
            border-radius: 8px;
            margin: 0 2px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 8px 14px;
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

        /* ===== TOOLTIP ===== */
        .info-tooltip {
            position: relative;
            display: inline-block;
            cursor: help;
        }

        .info-tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 100;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.85rem;
        }

        .info-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* ===== BADGE WAKTU ===== */
        .time-badge {
            background-color: #e9ecef;
            color: #495057;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
            margin-top: 4px;
        }

        /* ===== MODAL DETAIL ===== */
        .modal-detail {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            align-items: center;
            justify-content: center;
        }

        .modal-detail.active {
            display: flex;
        }

        .modal-content-custom {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header-custom {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .modal-header-custom h3 {
            margin: 0;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .modal-close:hover {
            transform: rotate(90deg);
        }

        .modal-body-custom {
            padding: 1.5rem;
        }

        .detail-section {
            margin-bottom: 1.5rem;
        }

        .detail-section h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 0.8rem;
            flex-wrap: wrap;
        }

        .detail-label {
            font-weight: 600;
            min-width: 150px;
            color: #495057;
        }

        .detail-value {
            flex: 1;
            color: #6c757d;
        }

        .detail-value.status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .detail-footer {
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
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

        /* ===== STYLING UNTUK WAKTU PENGIRIMAN ===== */
        .time-indicator {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .time-indicator i {
            margin-right: 5px;
        }

        .time-indicator.recent {
            color: #198754;
            font-weight: 500;
        }

        .time-indicator.old {
            color: #6c757d;
        }

        /* ===== LOADING SPINNER ===== */
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        /* ===== PERBAIKAN VISUAL ===== */
        .form-select,
        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 1.5rem;
        }

        .table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .table td:last-child {
            width: 150px;
            min-width: 150px;
        }

        .text-truncate-custom {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
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

            /* Responsivitas untuk modal */
            .modal-content-custom {
                width: 95%;
                margin: 10px;
            }

            .detail-row {
                flex-direction: column;
            }

            .detail-label {
                min-width: 100%;
                margin-bottom: 5px;
            }
        }

        @media (max-width: 576px) {
            .filter-tab {
                min-width: 90px;
                font-size: 0.8rem;
                padding: 6px 8px;
            }

            .btn-primary-custom,
            .btn-success-custom {
                width: 100%;
                padding: 12px;
            }

            .search-container,
            #ruang-filter {
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
    <!-- ===== NAVBAR UTAMA ===== -->
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
                                <a class="dropdown-item-custom active" href="{{ route('user.peminjaman.index') }}">
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
        <!-- Header dan Tambah Peminjaman -->
        <div class="page-header">
            <div>
                <h1 class="page-title"><i class="fa-solid fa-clipboard-list"></i> Daftar Peminjaman</h1>
                <p class="page-description">Kelola semua peminjaman ruangan dan proyektor</p>
            </div>
            <a href="{{ route('user.peminjaman.create') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-plus"></i> Ajukan Peminjaman
            </a>
        </div>

        <!-- Alert Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistik Ringkas -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-list-alt fa-2x text-primary mb-2"></i>
                        <h4 class="mb-1">{{ $peminjamans->total() }}</h4>
                        <p class="text-muted mb-0">Total Peminjaman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <h4 class="mb-1">{{ $peminjamans->where('status', 'disetujui')->count() }}</h4>
                        <p class="text-muted mb-0">Disetujui</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                        <h4 class="mb-1">{{ $peminjamans->where('status', 'pending')->count() }}</h4>
                        <p class="text-muted mb-0">Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                        <h4 class="mb-1">{{ $peminjamans->where('status', 'ditolak')->count() }}</h4>
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
            <div class="filter-tab" data-status="disetujui">
                <i class="fas fa-check-circle me-1"></i> Disetujui
            </div>
            <div class="filter-tab" data-status="berlangsung">
                <i class="fas fa-play-circle me-1"></i> Berlangsung
            </div>
            <div class="filter-tab" data-status="ditolak">
                <i class="fas fa-times-circle me-1"></i> Ditolak
            </div>
            <div class="filter-tab" data-status="selesai">
                <i class="fas fa-check-double me-1"></i> Selesai
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
                        <input type="date" class="form-control" id="tanggal-filter" placeholder="Filter Tanggal">
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Memuat data...</p>
        </div>

        <!-- Tabel Peminjaman -->
        <div class="table-container">
            <div class="table-responsive table-responsive-custom">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>Tanggal & Waktu</th>
                            <th>Ruang</th>
                            <th width="100" class="text-center">Proyektor</th>
                            <th>Keperluan</th>
                            <th width="130" class="text-center">Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($peminjamans as $peminjaman)
                            @php
                                $tanggal = \Carbon\Carbon::parse($peminjaman->tanggal);
                                $now = \Carbon\Carbon::now();
                                $isOngoing = $peminjaman->is_ongoing;

                                // Hitung waktu pengajuan relatif
                                $waktuPengajuan = \Carbon\Carbon::parse($peminjaman->created_at);
                                $selisih = $waktuPengajuan->diffForHumans($now, true);
                            @endphp

                            <tr class="{{ $isOngoing ? 'table-success' : '' }}"
                                data-status="{{ $peminjaman->status }}" data-ruang="{{ $peminjaman->ruang }}"
                                data-tanggal="{{ \Carbon\Carbon::parse($peminjaman->tanggal)->format('d M Y') }}"
                                data-tanggal-iso="{{ $peminjaman->tanggal }}"
                                data-waktu-mulai="{{ $peminjaman->display_waktu_mulai ?? ($peminjaman->waktu_mulai ?? '') }}"
                                data-waktu-selesai="{{ $peminjaman->display_waktu_selesai ?? ($peminjaman->waktu_selesai ?? '') }}"
                                data-waktu-pengajuan="{{ $peminjaman->created_at }}"
                                data-id="{{ $peminjaman->id }}">

                                <!-- 1. NO -->
                                <td class="fw-bold text-center">
                                    {{ ($peminjamans->currentPage() - 1) * $peminjamans->perPage() + $loop->iteration }}
                                </td>

                                <!-- 2. TANGGAL & WAKTU -->
                                <td>
                                    <div>
                                        <i class="fas fa-calendar-day text-primary me-1"></i>
                                        {{ $tanggal->format('d M Y') }}
                                    </div>
                                    <div>
                                        <span class="time-badge">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $peminjaman->display_waktu_mulai ?? '08:00' }} -
                                            {{ $peminjaman->display_waktu_selesai ?? '17:00' }}
                                        </span>
                                    </div>
                                    <div class="mt-1">
                                        <span class="badge bg-light text-secondary">
                                            <i class="fas fa-clock me-1"></i>{{ $selisih }} yang lalu
                                        </span>
                                    </div>
                                </td>

                                <!-- 3. RUANG -->
                                <td>
                                    <i class="fas fa-door-open text-info me-1"></i>
                                    {{ $peminjaman->ruangan->nama_ruangan ?? $peminjaman->ruang }}
                                </td>

                                <!-- 4. PROYEKTOR -->
                                <td class="text-center">
                                    @if ($peminjaman->projector)
                                        <div>
                                            <strong>{{ $peminjaman->projector->kode_proyektor ?? 'ID:' . $peminjaman->projector->id }}</strong>
                                            <div class="text-muted small">
                                                {{ $peminjaman->projector->merk ?? '' }}
                                                {{ $peminjaman->projector->model ?? '' }}
                                            </div>
                                        </div>
                                    @else
                                        <span class="badge bg-secondary status-badge">
                                            <i class="fas fa-times me-1"></i> Tidak
                                        </span>
                                    @endif
                                </td>

                                <!-- 5. KEPERLUAN -->
                                <td>
                                    <div class="info-tooltip">
                                        <span class="text-truncate-custom">
                                            {{ \Illuminate\Support\Str::limit($peminjaman->keperluan, 40) }}
                                        </span>
                                        @if (strlen($peminjaman->keperluan) > 40)
                                            <span class="tooltip-text">{{ $peminjaman->keperluan }}</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- 6. STATUS -->
                                <td class="text-center">
                                    @switch(true)
                                        @case($peminjaman->status === 'disetujui' && $isOngoing)
                                            <span class="badge status-badge status-berlangsung">
                                                <span class="pulse-dot"></span>
                                                <i class="fas fa-play-circle me-1"></i> Berlangsung
                                            </span>
                                        @break

                                        @case($peminjaman->status === 'disetujui')
                                            <span class="badge status-badge status-disetujui">
                                                <i class="fas fa-check-circle me-1"></i> Disetujui
                                            </span>
                                        @break

                                        @case($peminjaman->status === 'selesai')
                                            <span class="badge status-badge status-selesai">
                                                <i class="fas fa-check-double me-1"></i> Selesai
                                            </span>
                                        @break

                                        @case($peminjaman->status === 'ditolak')
                                            <span class="badge status-badge status-ditolak">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @break

                                        @default
                                            <span class="badge status-badge status-menunggu">
                                                <i class="fas fa-clock me-1"></i> Menunggu
                                            </span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn btn-info btn-action view-detail" title="Lihat Detail"
                                            data-id="{{ $peminjaman->id }}"
                                            data-tanggal="{{ $tanggal->format('d M Y') }}"
                                            data-waktu-mulai="{{ $peminjaman->display_waktu_mulai ?? $peminjaman->waktu_mulai }}"
                                            data-waktu-selesai="{{ $peminjaman->display_waktu_selesai ?? $peminjaman->waktu_selesai }}"
                                            data-ruang="{{ $peminjaman->ruangan->nama_ruangan ?? $peminjaman->ruang }}"
                                            data-dosen="{{ $peminjaman->dosen->nama_dosen ?? '-' }}"
                                            data-projector-label="{{ $peminjaman->projector ? $peminjaman->projector->kode_proyektor . ' - ' . ($peminjaman->projector->merk ?? '') : 'Tidak' }}"
                                            data-keperluan="{{ $peminjaman->keperluan }}"
                                            data-status="{{ $peminjaman->status }}" {{-- ambil dari USER --}}
                                            data-nama-peminjam="{{ $peminjaman->user->name ?? '-' }}"
                                            data-nim="{{ $peminjaman->user->nim ?? '-' }}"
                                            data-no-hp="{{ $peminjaman->user->no_hp ?? '-' }}"
                                            data-email="{{ $peminjaman->user->email ?? '-' }}"
                                            data-diajukan="{{ $waktuPengajuan->format('d M Y H:i') }}"
                                            data-is-ongoing="{{ $isOngoing ? 'true' : 'false' }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        @if ($peminjaman->status == 'pending')
                                            <a href="{{ route('user.peminjaman.edit', $peminjaman->id) }}"
                                                class="btn btn-warning btn-action" title="Edit Peminjaman">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger btn-action btn-delete"
                                                data-id="{{ $peminjaman->id }}"
                                                data-keperluan="{{ \Illuminate\Support\Str::limit($peminjaman->keperluan, 30) }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-warning btn-action" disabled
                                                title="Tidak dapat mengedit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-action" disabled
                                                title="Tidak dapat menghapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr class="no-data-row">
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h5 class="mt-3 mb-1">Belum ada data peminjaman</h5>
                                            <p class="mb-3">Silakan ajukan peminjaman baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($peminjamans->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination pagination-custom">
                            {{-- Previous Page Link --}}
                            @if ($peminjamans->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $peminjamans->previousPageUrl() }}">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($peminjamans->getUrlRange(1, $peminjamans->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $peminjamans->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($peminjamans->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $peminjamans->nextPageUrl() }}">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif

            <!-- Modal Detail Peminjaman -->
            <div class="modal-detail" id="detailModal">
                <div class="modal-content-custom">
                    <div class="modal-header-custom">
                        <h3><i class="fas fa-info-circle"></i> Detail Peminjaman</h3>
                        <button class="modal-close" id="closeModal">&times;</button>
                    </div>
                    <div class="modal-body-custom">

                        <div class="detail-section">
                            <h4><i class="fas fa-user"></i> Informasi Peminjam</h4>
                            <div class="detail-row">
                                <div class="detail-label">Nama Peminjam</div>
                                <div class="detail-value" id="detail-nama-peminjam"></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">NIM</div>
                                <div class="detail-value" id="detail-nim"></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">No. HP</div>
                                <div class="detail-value" id="detail-no-hp"></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Email</div>
                                <div class="detail-value" id="detail-email"></div>
                            </div>
                        </div>

                        <div class="detail-section">
                            <h4><i class="fas fa-calendar-alt"></i> Informasi Peminjaman</h4>
                            <div class="detail-row">
                                <div class="detail-label">Tanggal</div>
                                <div class="detail-value" id="detail-tanggal"></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Waktu</div>
                                <div class="detail-value" id="detail-waktu"></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Ruang</div>
                                <div class="detail-value" id="detail-ruang"></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Proyektor</div>
                                <div class="detail-value" id="detail-proyektor"></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Dosen Pengampu</div>
                                <div class="detail-value" id="detail-dosen">-</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    <span class="status-badge" id="detail-status"></span>
                                </div>
                            </div>
                        </div>

                        <div class="detail-section">
                            <h4><i class="fas fa-clipboard-list"></i> Keperluan</h4>
                            <div class="detail-row">
                                <div class="detail-value" id="detail-keperluan"></div>
                            </div>
                        </div>

                        <div class="detail-section">
                            <h4><i class="fas fa-history"></i> Informasi Pengajuan</h4>
                            <div class="detail-row">
                                <div class="detail-label">Diajukan pada</div>
                                <div class="detail-value" id="detail-diajukan"></div>
                            </div>
                        </div>

                        <div class="detail-footer">
                            <button class="btn btn-secondary" id="closeModalBtn">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Hapus Tersembunyi -->
            <form id="deleteForm" method="POST" style="display: none;">
                @csrf @method('DELETE')
            </form>
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

            // ===== MODAL DETAIL FUNCTIONALITY =====
            const detailModal = document.getElementById('detailModal');
            const closeModal = document.getElementById('closeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const viewDetailButtons = document.querySelectorAll('.view-detail');

            // Fungsi untuk menampilkan modal detail
            function showDetailModal(event) {
                const button = event.currentTarget;

                // Ambil data dari atribut data-*
                const tanggal = button.getAttribute('data-tanggal');
                const waktuMulai = button.getAttribute('data-waktu-mulai');
                const waktuSelesai = button.getAttribute('data-waktu-selesai');
                const ruang = button.getAttribute('data-ruang');
                const proyektor = button.getAttribute('data-projector-label') || button.getAttribute('data-proyektor');
                const keperluan = button.getAttribute('data-keperluan');
                const status = button.getAttribute('data-status');
                const namaPeminjam = button.getAttribute('data-nama-peminjam');
                const nim = button.getAttribute('data-nim');
                const prodi = button.getAttribute('data-prodi');
                const noHp = button.getAttribute('data-no-hp');
                const email = button.getAttribute('data-email');
                const dosen = button.getAttribute('data-dosen') || '';
                const diajukan = button.getAttribute('data-diajukan');
                const isOngoing = button.getAttribute('data-is-ongoing') === 'true';

                // Set nilai ke modal
                document.getElementById('detail-tanggal').textContent = tanggal;
                document.getElementById('detail-waktu').textContent = `${waktuMulai} - ${waktuSelesai}`;
                document.getElementById('detail-ruang').textContent = ruang;
                document.getElementById('detail-proyektor').textContent = proyektor;
                document.getElementById('detail-keperluan').textContent = keperluan;
                document.getElementById('detail-nama-peminjam').textContent = namaPeminjam;
                document.getElementById('detail-nim').textContent = nim;
                document.getElementById('detail-no-hp').textContent = noHp;
                document.getElementById('detail-email').textContent = email;
                document.getElementById('detail-dosen').textContent = dosen || '-';
                document.getElementById('detail-diajukan').textContent = diajukan;

                // Set status dengan badge yang sesuai
                const statusBadge = document.getElementById('detail-status');
                statusBadge.className = 'status-badge';

                if (isOngoing) {
                    statusBadge.classList.add('status-berlangsung');
                    statusBadge.innerHTML =
                        '<span class="pulse-dot"></span><i class="fas fa-play-circle me-1"></i> Berlangsung';
                } else {
                    switch (status) {
                        case 'disetujui':
                            statusBadge.classList.add('status-disetujui');
                            statusBadge.innerHTML = '<i class="fas fa-check-circle me-1"></i> Disetujui';
                            break;
                        case 'selesai':
                            statusBadge.classList.add('status-selesai');
                            statusBadge.innerHTML = '<i class="fas fa-check-double me-1"></i> Selesai';
                            break;
                        case 'ditolak':
                            statusBadge.classList.add('status-ditolak');
                            statusBadge.innerHTML = '<i class="fas fa-times-circle me-1"></i> Ditolak';
                            break;
                        default:
                            statusBadge.classList.add('status-menunggu');
                            statusBadge.innerHTML = '<i class="fas fa-clock me-1"></i> Menunggu';
                    }
                }

                // Tampilkan modal
                detailModal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Mencegah scroll di background
            }

            // Fungsi untuk menutup modal
            function closeDetailModal() {
                detailModal.classList.remove('active');
                document.body.style.overflow = ''; // Kembalikan scroll
            }

            // Event listener untuk tombol lihat detail
            viewDetailButtons.forEach(button => {
                button.addEventListener('click', showDetailModal);
            });

            // Event listener untuk tombol tutup modal
            closeModal.addEventListener('click', closeDetailModal);
            closeModalBtn.addEventListener('click', closeDetailModal);

            // Tutup modal saat klik di luar konten modal
            detailModal.addEventListener('click', (event) => {
                if (event.target === detailModal) {
                    closeDetailModal();
                }
            });

            // ===== KONFIRMASI HAPUS =====
            function confirmDelete(event) {
                event.preventDefault();
                const button = event.currentTarget;
                const keperluan = button.getAttribute('data-keperluan');
                const id = button.getAttribute('data-id');

                if (confirm(`Apakah Anda yakin ingin menghapus peminjaman:\n"${keperluan}"?`)) {
                    // Set action form dan submit
                    const form = document.getElementById('deleteForm');
                    form.action = `/peminjaman/${id}`;
                    form.submit();
                }
            }

            // ===== FILTER TABEL =====
            function filterTable() {
                const searchText = document.querySelector('.search-input').value.toLowerCase();
                const activeTab = document.querySelector('.filter-tab.active');
                const statusFilter = activeTab ? activeTab.getAttribute('data-status') : 'semua';
                const ruangFilter = document.getElementById('ruang-filter').value;
                const tanggalFilter = document.getElementById('tanggal-filter').value;

                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const rowStatus = row.getAttribute('data-status');
                    const rowRuang = row.getAttribute('data-ruang');
                    const rowTanggal = row.getAttribute('data-tanggal');

                    // Filter berdasarkan pencarian, status, ruang, dan tanggal
                    const textMatch = text.includes(searchText);
                    const statusMatch = statusFilter === 'semua' ||
                        (statusFilter === 'berlangsung' ? row.classList.contains('table-success') : rowStatus ===
                            statusFilter);
                    const ruangMatch = ruangFilter === 'semua' || rowRuang === ruangFilter;
                    const tanggalMatch = !tanggalFilter || rowTanggal === tanggalFilter;

                    if (textMatch && statusMatch && ruangMatch && tanggalMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Client-side: update badges to 'Berlangsung' when local time is inside booking window
            function updateOngoingBadges() {
                const rows = document.querySelectorAll('tbody tr[data-tanggal-iso]');
                const now = new Date();

                rows.forEach(row => {
                    const tanggalIso = row.getAttribute('data-tanggal-iso') || row.getAttribute('data-tanggal');
                    const waktuMulai = row.getAttribute('data-waktu-mulai') || '';
                    const waktuSelesai = row.getAttribute('data-waktu-selesai') || '';

                    if (!tanggalIso || !waktuMulai || !waktuSelesai) return;

                    const [y, m, d] = tanggalIso.split('-').map(Number);
                    const parseTime = (t) => {
                        const parts = t.split(':').map(Number);
                        return {
                            h: parts[0] || 0,
                            min: parts[1] || 0
                        };
                    };

                    const s = parseTime(waktuMulai);
                    const e = parseTime(waktuSelesai);
                    const start = new Date(y, m - 1, d, s.h, s.min, 0);
                    const end = new Date(y, m - 1, d, e.h, e.min, 59);

                    const isOngoing = now >= start && now <= end;

                    // Only update to 'Berlangsung' client-side when server status is 'disetujui'
                    const rowStatus = (row.getAttribute('data-status') || '').toLowerCase();
                    if (rowStatus !== 'disetujui') return;

                    // Prefer the status column badge to avoid overwriting the time-range badge
                    const badge = row.querySelector('.status-badge') || row.querySelector('span.badge');
                    if (!badge) return;

                    if (isOngoing) {
                        if (!/Berlangsung/i.test(badge.textContent)) {
                            badge.innerHTML = '<i class="fas fa-play-circle me-1"></i> Berlangsung';
                            badge.className = 'status-badge status-berlangsung';
                        }
                    }
                });
            }

            // ===== LOADING STATE =====
            function showLoading() {
                document.getElementById('loadingSpinner').style.display = 'block';
                document.querySelector('.table-container').style.opacity = '0.5';
            }

            function hideLoading() {
                document.getElementById('loadingSpinner').style.display = 'none';
                document.querySelector('.table-container').style.opacity = '1';
            }

            // ===== INISIALISASI EVENT LISTENER =====
            document.addEventListener('DOMContentLoaded', function() {
                // Event listener untuk tombol hapus
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', confirmDelete);
                });

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

                // Sembunyikan loading setelah halaman dimuat
                setTimeout(() => {
                    hideLoading();
                }, 500);

                // Update badges on load and every minute
                updateOngoingBadges();
                setInterval(updateOngoingBadges, 60000);
            });

            // Handle page transitions
            document.addEventListener('click', function(e) {
                if (e.target.matches('a') && e.target.getAttribute('href') &&
                    !e.target.getAttribute('href').startsWith('#')) {
                    showLoading();
                }
            });
        </script>
    </body>

    </html>
