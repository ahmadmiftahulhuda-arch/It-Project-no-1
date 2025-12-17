<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Barang - Lab TIK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #3b5998;
            --secondary: #6d84b4;
            --success: #4caf50;
            --info: #2196f3;
            --warning: #ff9800;
            --danger: #f44336;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
            --sidebar-width: 250px;
            --text-light: #6c757d;
            --text-dark: #495057;
            --bg-light: #f5f8fa;
            --bg-card: #ffffff;
            --border-light: #e9ecef;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .dark-mode .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .sidebar-logo {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .menu-section {
            padding: 0 15px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 600;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
            flex-shrink: 0;
        }

        .menu-item span {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Dropdown Menu Styles */
        .dropdown-custom {
            margin-bottom: 5px;
        }

        .dropdown-toggle-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            cursor: pointer;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            font-weight: 600;
        }

        .dropdown-toggle-custom:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .dropdown-toggle-custom i:last-child {
            transition: transform 0.3s;
            margin-left: auto;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .dropdown-toggle-custom[aria-expanded="true"] {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid white;
        }

        .dropdown-toggle-custom[aria-expanded="true"] i:last-child {
            transform: rotate(180deg);
        }

        .dropdown-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .dropdown-items.show {
            max-height: 500px;
        }

        .dropdown-items .dropdown-item {
            padding: 10px 20px 10px 40px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            position: relative;
        }

        .dropdown-items .dropdown-item:hover,
        .dropdown-items .dropdown-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        .dropdown-items .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: 1px solid var(--border-light);
        }

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-light);
            border-radius: 30px;
            outline: none;
            transition: all 0.3s;
            background-color: var(--bg-light);
        }

        .search-bar input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-btn,
        .theme-toggle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-dark);
        }

        .notification-btn:hover,
        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Page Title */
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title h1 {
            color: var(--dark);
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .page-title p {
            color: var(--text-light);
            margin: 0;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(59, 89, 152, 0.3);
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 1px solid var(--border-light);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: white;
            opacity: 0.9;
        }

        .stat-icon.pending {
            background: #ffb74d;
        }

        .stat-icon.approved {
            background: #66bb6a;
        }

        .stat-icon.rejected {
            background: #ef5350;
        }

        .stat-icon.total {
            background: var(--primary);
        }

        .stat-info h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .stat-info p {
            margin: 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Filter Section */
        .filter-section {
            background: var(--bg-card);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--dark);
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-light);
            border-radius: 4px;
            outline: none;
            transition: all 0.3s;
            background-color: var(--bg-light);
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        /* Table */
        .table-container {
            background: var(--bg-card);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid var(--border-light);
            font-weight: 600;
            color: var(--dark);
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: var(--border-light);
        }

        .table tbody tr {
            transition: all 0.3s;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.45em 0.9em;
            border-radius: 18px;
            font-size: 0.82rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid transparent;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .status-disetujui,
        .status-dikembalikan {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-selesai {
            background: #e9ecef;
            color: #495057;
        }

        .status-berlangsung {
            background: #e3f2fd;
            color: #1565c0;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-success-custom {
            background: #4caf50;
            color: white;
        }

        .btn-danger-custom {
            background: #f44336;
            color: white;
        }

        .btn-warning-custom {
            background: #ff9800;
            color: white;
        }

        .btn-info-custom {
            background: #2196f3;
            color: white;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-link {
            color: var(--primary);
            border: 1px solid var(--border-light);
            padding: 8px 15px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: var(--bg-card);
            border-radius: 12px;
            width: 600px;
            max-width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-light);
        }

        .close-btn {
            cursor: pointer;
            font-size: 24px;
            color: var(--text-light);
        }

        .close-btn:hover {
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .char-count {
            text-align: right;
            font-size: 12px;
            color: var(--text-light);
            margin-top: 5px;
        }

        .status-radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
        }

        .radio-label input {
            display: none;
        }

        .radio-custom {
            width: 18px;
            height: 18px;
            border: 2px solid var(--border-light);
            border-radius: 50%;
            margin-right: 8px;
            position: relative;
            transition: all 0.3s ease;
        }

        .radio-label input:checked+.radio-custom {
            border-color: var(--primary);
            background: var(--primary);
        }

        .radio-label input:checked+.radio-custom::after {
            content: '';
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-light);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: var(--border-light);
            color: var(--text-dark);
        }

        .btn-cancel:hover {
            background: #bdc3c7;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary);
        }

        /* Star Rating */
        .star-rating {
            display: flex;
            gap: 5px;
            font-size: 24px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .star-rating .star {
            color: #ddd;
            transition: color 0.3s, transform 0.2s;
        }

        .star-rating .star:hover {
            transform: scale(1.2);
        }

        .star-rating .star.active {
            color: #ffc107;
        }

        .rating-stars {
            margin-bottom: 10px;
        }

        /* Alert */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        /* Spinner */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h2,
            .menu-item span {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 15px;
            }

            .menu-item i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 70px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
            }

            .search-bar {
                width: 100%;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
                margin: 10px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* Dark Mode */
        body.dark-mode .dropdown-menu {
            background-color: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .dropdown-menu .dropdown-item {
            color: var(--text-dark);
        }

        body.dark-mode .dropdown-menu .dropdown-item:hover,
        body.dark-mode .dropdown-menu .dropdown-item:focus {
            background-color: var(--primary);
            color: white;
        }

        body.dark-mode .dropdown-menu .dropdown-divider {
            border-color: var(--border-light);
        }

        body.dark-mode {
            --bg-light: #121212;
            --bg-card: #1e1e1e;
            --text-dark: #e0e0e0;
            --text-light: #a0a0a0;
            --border-light: #333;
            --dark: #f0f0f0;
        }

        body.dark-mode .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }

        body.dark-mode .header,
        body.dark-mode .stat-card,
        body.dark-mode .filter-section,
        body.dark-mode .table-container {
            background: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        body.dark-mode .table thead th {
            background: #252525;
            color: var(--text-dark);
            border-color: var(--border-light);
        }


        body.dark-mode .table tbody tr:hover {
            background: #2a2a2a;
        }

        body.dark-mode .search-bar input,
        body.dark-mode .filter-group input,
        body.dark-mode .filter-group select {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        /* Make table elements dark in dark mode */
        body.dark-mode .table,
        body.dark-mode .table thead,
        body.dark-mode .table tbody,
        body.dark-mode .table th,
        body.dark-mode .table td,
        body.dark-mode .table tr {
            background-color: transparent;
            color: var(--text-dark);
        }

        /* Ensure table header is darker (override Bootstrap) */
        body.dark-mode .table thead th {
            background: #252525;
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        /* Row hover and cells */
        body.dark-mode .table tbody tr:hover {
            background: #2a2a2a;
        }

        body.dark-mode .notification-btn,
        body.dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        body.dark-mode .page-title h1 {
            color: var(--text-dark);
        }

        body.dark-mode .page-title p {
            color: var(--text-light);
        }

        body.dark-mode .stat-info p {
            color: var(--text-light);
        }

        body.dark-mode .filter-group label {
            color: var(--text-dark);
        }

        .menu-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            display: none;
        }

        .menu-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            display: none;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }
        }

        /* ============================
           IMPROVED NOTIFICATION SYSTEM
           ============================ */

        .notification-btn {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-dark);
            border: none;
        }

        .notification-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 89, 152, 0.2);
        }

        .notification-btn .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            font-size: 0.65rem;
            padding: 3px 6px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #FF5B5B, #D92525);
            border: 2px solid var(--bg-card);
            box-shadow: 0 2px 4px rgba(217, 37, 37, 0.4);
            border-radius: 999px;
        }

        .dark-mode .notification-btn {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        .dark-mode .notification-btn:hover {
            background: #3a3a3a;
            color: var(--primary);
        }

        /* Notification Dropdown */
        .notification-dropdown {
            width: 380px !important;
            max-height: 500px;
            overflow: hidden;
            border: none !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-radius: 12px !important;
            padding: 0;
            margin-top: 10px;
            animation: notificationSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border-light) !important;
        }

        @keyframes notificationSlideIn {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Notification Header */
        .notification-header {
            padding: 18px 20px;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1rem;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
        }

        .notification-actions .btn-sm {
            padding: 4px 10px;
            font-size: 0.75rem;
        }

        /* Notification List */
        .notification-list {
            max-height: 350px;
            overflow-y: auto;
        }

        .notification-list::-webkit-scrollbar {
            width: 5px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 10px;
        }

        .notification-list::-webkit-scrollbar-thumb:hover {
            background: var(--gray);
        }

        /* Notification Item */
        .notification-item {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .notification-item:hover {
            background-color: rgba(59, 89, 152, 0.05);
        }

        .dark-mode .notification-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .notification-item.unread {
            background-color: rgba(59, 89, 152, 0.08);
            border-left: 3px solid var(--primary);
        }

        .dark-mode .notification-item.unread {
            background-color: rgba(59, 89, 152, 0.15);
        }

        .notification-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-icon.info {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1976d2;
        }

        .notification-icon.success {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
        }

        .notification-icon.warning {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #f57c00;
        }

        .notification-icon.danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #d32f2f;
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .notification-message {
            color: var(--text-light);
            font-size: 0.85rem;
            line-height: 1.4;
            margin-bottom: 6px;
        }

        .notification-time {
            font-size: 0.75rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .notification-actions-item {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .notification-actions-item .btn {
            padding: 4px 12px;
            font-size: 0.8rem;
        }

        /* Empty State */
        .notification-empty {
            padding: 50px 20px;
            text-align: center;
            color: var(--text-light);
        }

        .notification-empty i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .notification-empty p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Footer */
        .notification-footer {
            padding: 15px 20px;
            background: var(--bg-light);
            border-top: 1px solid var(--border-light);
            text-align: center;
        }

        .notification-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .notification-footer a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Notification Toast Styles */
        .notification-toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .notification-toast {
            background: var(--bg-card);
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            border-left: 4px solid;
            min-width: 300px;
            max-width: 350px;
            animation: toastSlideIn 0.3s ease, toastSlideOut 0.3s ease 4.7s forwards;
            transform: translateX(0);
            border: 1px solid var(--border-light);
        }

        @keyframes toastSlideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes toastSlideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        .notification-toast.info {
            border-left-color: #2196f3;
        }

        .notification-toast.success {
            border-left-color: #4caf50;
        }

        .notification-toast.warning {
            border-left-color: #ff9800;
        }

        .notification-toast.danger {
            border-left-color: #f44336;
        }

        .toast-header {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .toast-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .toast-icon.info {
            background: #e3f2fd;
            color: #2196f3;
        }

        .toast-icon.success {
            background: #e8f5e9;
            color: #4caf50;
        }

        .toast-icon.warning {
            background: #fff3e0;
            color: #ff9800;
        }

        .toast-icon.danger {
            background: #ffebee;
            color: #f44336;
        }

        .toast-title {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.95rem;
            flex: 1;
        }

        .toast-close {
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 0.8rem;
            transition: color 0.3s;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-close:hover {
            color: var(--danger);
        }

        .toast-body {
            color: var(--text-dark);
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .toast-time {
            font-size: 0.75rem;
            color: var(--text-light);
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Progress Bar */
        .toast-progress {
            height: 3px;
            background: var(--border-light);
            border-radius: 3px;
            margin-top: 10px;
            overflow: hidden;
        }

        .toast-progress-bar {
            height: 100%;
            width: 100%;
            animation: progressBar 5s linear forwards;
            transform-origin: left;
        }

        .notification-toast.info .toast-progress-bar {
            background: #2196f3;
        }

        .notification-toast.success .toast-progress-bar {
            background: #4caf50;
        }

        .notification-toast.warning .toast-progress-bar {
            background: #ff9800;
        }

        .notification-toast.danger .toast-progress-bar {
            background: #f44336;
        }

        @keyframes progressBar {
            from {
                transform: scaleX(1);
            }
            to {
                transform: scaleX(0);
            }
        }
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }
        }
    </style>
</head>

<body>
    <!-- Notification Toast Container -->
    <div class="notification-toast-container"></div>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h2>Admin TI</h2>
        </div>

        <div class="sidebar-menu">
            <!-- Menu Utama -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menuUtama" aria-expanded="false" aria-controls="menuUtama">
                    <span>Menu Utama</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="menuUtama">
                    <a href="/admin/dashboard" class="dropdown-item">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Peminjaman - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#peminjamanMenu" aria-expanded="false" aria-controls="peminjamanMenu">
                    <span>Manajemen Peminjaman</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="peminjamanMenu">
                    <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item">
                        <i class="fas fa-hand-holding"></i>
                        <span>Peminjaman</span>
                    </a>
                    <a href="/admin/pengembalian" class="dropdown-item">
                        <i class="fas fa-undo"></i>
                        <span>Pengembalian</span>
                    </a>
                    <a href="/admin/riwayat" class="dropdown-item">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Peminjaman</span>
                    </a>
                    <a href="/admin/feedback" class="dropdown-item active">
                        <i class="fas fa-comment"></i>
                        <span>Feedback</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Aset - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#asetMenu" aria-expanded="false" aria-controls="asetMenu">
                    <span>Manajemen Aset</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="asetMenu">
                    <a href="{{ route('projectors.index') }}" class="dropdown-item">
                        <i class="fas fa-video"></i>
                        <span>Proyektor</span>
                    </a>
                    <a href="{{ route('barangs.index') }}" class="dropdown-item">
                        <i class="fas fa-box"></i>
                        <span>Barang</span>
                    </a>
                    <a href="/admin/ruangan" class="dropdown-item">
                        <i class="fas fa-door-open"></i>
                        <span>Ruangan</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Akademik - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#akademikMenu" aria-expanded="false" aria-controls="akademikMenu">
                    <span>Manajemen Akademik</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="akademikMenu">
                    <a href="/admin/jadwal-perkuliahan" class="dropdown-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Perkuliahan</span>
                    </a>
                    <a href="/admin/slotwaktu" class="dropdown-item">
                        <i class="fas fa-clock"></i>
                        <span>Slot Waktu</span>
                    </a>
                    <a href="/admin/mata_kuliah" class="dropdown-item">
                        <i class="fas fa-book"></i>
                        <span>Matakuliah</span>
                    </a>
                    <a href="/admin/kelas" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Kelas</span>
                    </a>
                    <a href="/admin/dosen" class="dropdown-item">
                        <i class="fas fa-user-tie"></i>
                        <span>Dosen</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Pengguna - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#penggunaMenu" aria-expanded="false" aria-controls="penggunaMenu">
                    <span>Manajemen Pengguna</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="penggunaMenu">
                    <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                        <i class="fas fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                </div>
            </div>

            <!-- Laporan & Pengaturan - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#laporanMenu" aria-expanded="false" aria-controls="laporanMenu">
                    <span>Laporan & Pengaturan</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="laporanMenu">
                    <a href="/admin/laporan" class="dropdown-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistik</span>
                    </a>
                    <a href="/admin/pengaturan" class="dropdown-item">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            </div>

            <!-- Sistem Pendukung Keputusan -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#spkMenu" aria-expanded="false" aria-controls="spkMenu">
                    <span>Sistem TPK</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="spkMenu">
                    <a href="{{ route('admin.spk.index') }}" class="dropdown-item">
                        <i class="fas fa-sliders-h"></i>
                        <span>AHP & SAW</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari feedback...">
            </div>

            <div class="user-actions">
                <!-- Improved Notification Dropdown -->
                <div class="dropdown">
                    <button class="notification-btn" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
                    </button>
                    <div class="dropdown-menu notification-dropdown" aria-labelledby="notificationDropdown">
                        <div class="notification-header">
                            <h6>Notifikasi</h6>
                            <div class="notification-actions">
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="markAllRead">
                                    <i class="fas fa-check-double"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="clearNotifications">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="notification-list" id="notificationList">
                            <!-- Notifications will be dynamically added here -->
                        </div>
                        <div class="notification-footer">
                            <a href="{{ route('admin.notifications.all') }}" id="viewAllNotifications">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </div>

                <div class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </div>

                <div class="dropdown">
                    <button class="user-profile dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">
                        <div class="user-avatar">
                            @auth
                                {{ substr(auth()->user()->name, 0, 1) }}
                            @else
                                A
                            @endauth
                        </div>
                        <div>
                            <div style="color: var(--text-dark);">
                                @auth
                                    {{ auth()->user()->name }}
                                @else
                                    Administrator
                                @endauth
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                                @auth
                                    {{ auth()->user()->peran ?? 'Admin' }}
                                @else
                                    Admin
                                @endauth
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">Selamat Datang, @auth {{ auth()->user()->name }}
                                @else
                                Pengguna @endauth
                            </h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i
                                    class="fas fa-user-circle me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i
                                    class="fas fa-cog me-2"></i> Pengaturan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Title -->
        <div class="page-title">
            <div>
                <h1>Manajemen Feedback</h1>
                <p>Kelola feedback dari pengguna Lab Teknologi Informasi</p>
            </div>

        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="stat-info">
                    <h3 id="total-feedback">{{ $totalFeedback ?? 0 }}</h3>
                    <p>Total Feedback</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon approved">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                    <h3 id="average-rating">{{ number_format($averageRating ?? 0, 1) }}</h3>
                    <p>Rating Rata-rata</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="published-count">{{ $published ?? 0 }}</h3>
                    <p>Dipublikasikan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rejected">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-info">
                    <h3 id="draft-count">{{ $draft ??  0 }}</h3>
                    <p>Draft</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <form id="filterForm" method="GET" action="{{ route('admin.feedback.index') }}" class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="status_filter">Status</label>
                    <select id="status_filter" name="status">
                        <option value="">Semua Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                            Dipublikasikan</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="rating_filter">Rating</label>
                    <select id="rating_filter" name="rating">
                        <option value="">Semua Rating</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="kategori_filter">Kategori</label>
                    <select id="kategori_filter" name="kategori">
                        <option value="">Semua Kategori</option>
                        <option value="Fasilitas Ruangan" {{ request('kategori') == 'Fasilitas Ruangan' ? 'selected' : '' }}>Fasilitas Ruangan</option>
                        <option value="Kebersihan" {{ request('kategori') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="Layanan Staff" {{ request('kategori') == 'Layanan Staff' ? 'selected' : '' }}>Layanan Staff</option>
                        <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="date_filter">Tanggal Feedback</label>
                    <input type="date" id="date_filter" name="date" value="{{ request('date') }}">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <input type="hidden" id="search" name="search" value="{{ request('search') }}">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline btn-sm" id="resetFilter">
                        <i class="fas fa-refresh me-1"></i> Reset
                    </button>
                </div>
                <a href="{{ route('admin.feedback.export', request()->query()) }}" class="btn btn-outline">
                    <i class="fas fa-file-export"></i> Ekspor
                </a>
            </div>
        </form>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="feedbackTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Kategori</th>
                            <th>Detail Feedback</th>
                            <th>Rating</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="feedbackTableBody">
                        @foreach ($feedback as $item)
                            <tr>
                                <td>{{ ($feedback->currentPage() - 1) * $feedback->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>
                                    {{ \Illuminate\Support\Str::limit($item->detail_feedback ?? '-', 50) }}
                                </td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $item->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <small class="text-muted">({{ $item->rating }})</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                <td>
                                    @if ($item->status == 'Dipublikasikan')
                                        <span class="badge status-disetujui">Dipublikasikan</span>
                                    @else
                                        <span class="badge status-menunggu">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 action-buttons">
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning-custom btn-sm"
                                            onclick="showEditModal(
                                                {{ $item->id }},
                                                '{{ $item->peminjaman->user->name ?? '-' }}',
                                                '{{ $item->kategori }}',
                                                `{{ addslashes($item->detail_feedback) }}`,
                                                {{ $item->rating }},
                                                '{{ $item->status }}'
                                            )">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form
                                            action="{{ route('admin.feedback.destroy', ['feedback' => $item->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custom btn-sm"
                                                onclick="return confirm('Yakin mau hapus feedback ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $feedback->links() }}
        </div>

        <!-- Modal Edit Feedback -->
        <div id="editModal" class="modal">
            <!-- Modal content akan diisi oleh JavaScript -->
        </div>

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ========== DYNAMIC NOTIFICATION SYSTEM ==========
                let notifications = [];
                const notificationList = document.getElementById('notificationList');
                const notificationBadge = document.getElementById('notificationBadge');
                const markAllReadBtn = document.getElementById('markAllRead');
                const clearNotificationsBtn = document.getElementById('clearNotifications');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                async function fetchNotifications() {
                    try {
                        const response = await fetch('{{ route('admin.notifications.index') }}');
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        const data = await response.json();
                        notifications = data.notifications || [];
                        renderNotifications();
                    } catch (error) {
                        console.error('Failed to fetch notifications:', error);
                        if (notificationList) {
                            notificationList.innerHTML = `
                                <div class="notification-empty">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    <p>Gagal memuat notifikasi</p>
                                </div>
                            `;
                        }
                    }
                }

                function renderNotifications() {
                    if (!notificationList) return;
                    notificationList.innerHTML = '';
                    if (notifications.length === 0) {
                        notificationList.innerHTML = `
                            <div class="notification-empty">
                                <i class="fas fa-check-circle"></i>
                                <p>Tidak ada notifikasi baru</p>
                            </div>
                        `;
                    } else {
                        notifications.forEach(notif => {
                            const item = document.createElement('a');
                            item.href = notif.url;
                            item.className = `notification-item ${notif.read_at ? '' : 'unread'}`; 
                            item.dataset.id = notif.id;
                            item.innerHTML = `
                                <div class="notification-icon ${notif.type}">
                                    <i class="fas ${notif.icon}"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">${notif.title}</div>
                                    <div class="notification-message">${notif.message}</div>
                                    <div class="notification-time">
                                        <i class="fas fa-clock"></i>
                                        <span>${notif.time}</span>
                                    </div>
                                </div>
                            `;
                            item.addEventListener('click', async (e) => {
                                e.preventDefault();
                                await markAsRead(notif.id);
                                window.location.href = notif.url;
                            });
                            notificationList.appendChild(item);
                        });
                    }
                    updateBadge();
                }

                function updateBadge() {
                    if (!notificationBadge) return;
                    const unreadCount = notifications.filter(notif => !notif.read_at).length;
                    notificationBadge.textContent = unreadCount;
                    if (unreadCount > 0) {
                        notificationBadge.style.display = 'flex';
                    } else {
                        notificationBadge.style.display = 'none';
                    }
                }

                async function markAsRead(notificationId) {
                    try {
                        await fetch(`{{ url('admin/notifications') }}/${notificationId}/mark-as-read`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
                        });
                        notifications = notifications.map(notif => 
                            notif.id === notificationId ? { ...notif, read_at: new Date().toISOString() } : notif
                        );
                        renderNotifications();
                    } catch (error) {
                        console.error('Failed to mark notification as read:', error);
                    }
                }

                if (markAllReadBtn) {
                    markAllReadBtn.addEventListener('click', async () => {
                        try {
                            await fetch('{{ route('admin.notifications.markAllAsRead') }}', { 
                                method: 'POST', 
                                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' } 
                            });
                            notifications = notifications.map(notif => ({ ...notif, read_at: new Date().toISOString() }));
                            renderNotifications();
                        } catch (error) {
                            console.error('Failed to mark all as read:', error);
                        }
                    });
                }

                if (clearNotificationsBtn) {
                    clearNotificationsBtn.addEventListener('click', async () => {
                        try {
                            await fetch('{{ route('admin.notifications.clearAll') }}', { 
                                method: 'POST', 
                                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
                            });
                            notifications = [];
                            renderNotifications();
                        } catch (error) {
                            console.error('Failed to clear notifications:', error);
                        }
                    });
                }
                
                fetchNotifications();
                // ========== END DYNAMIC NOTIFICATION SYSTEM ==========

                // Theme Toggle
                const themeToggle = document.getElementById('theme-toggle');
                if (themeToggle) { // Ensure themeToggle exists
                    themeToggle.addEventListener('click', () => {
                        document.body.classList.toggle('dark-mode');

                        if (document.body.classList.contains('dark-mode')) {
                            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                            localStorage.setItem('darkMode', 'enabled');
                        } else {
                            themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                            localStorage.setItem('darkMode', 'disabled');
                        }
                    });
                }


                // Toggle sidebar on mobile
                const menuToggle = document.getElementById('menu-toggle');
                const sidebar = document.querySelector('.sidebar');

                if (menuToggle && sidebar) { // Ensure elements exist
                    menuToggle.addEventListener('click', () => {
                        sidebar.classList.toggle('active');
                    });
                }

                // =============================================
                // FUNGSI UTAMA EDIT MODAL
                // =============================================

                // Fungsi untuk menampilkan modal edit tanpa AJAX
                window.showEditModal = function(id, namaPeminjam, kategori, detailFeedback, rating, status) {
                    // Escape karakter khusus untuk HTML
                    const escapeHtml = (text) => {
                        return text
                            .replace(/&/g, "&amp;")
                            .replace(/</g, "&lt;")
                            .replace(/>/g, "&gt;")
                            .replace(/"/g, "&quot;")
                            .replace(/'/g, "&#039;");
                    };

                    // Buat modal content
                    const modalContent = `
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Edit Feedback</h2>
                                <span class="close-btn" onclick="closeEditModal()">&times;</span>
                            </div>

                            <form id="editForm" method="POST" action="/admin/feedback/${id}">
                                @csrf
                                @method('PUT')
                                
                                <!-- Hidden input untuk ID -->
                                <input type="hidden" name="id" id="editId" value="${id}">
                                <input type="hidden" name="rating" value="${rating}">
                                <input type="hidden" name="detail_feedback" value="${escapeHtml(detailFeedback)}">
                                <input type="hidden" name="kategori" value="${escapeHtml(kategori)}">

                                <div class="form-group">
                                    <label>Peminjam</label>
                                    <input type="text" class="form-control" value="${escapeHtml(namaPeminjam)}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input type="text" class="form-control" value="${escapeHtml(kategori)}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Detail Feedback</label>
                                    <textarea id="editDetailFeedback" class="form-control" rows="4" readonly>${escapeHtml(detailFeedback)}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Rating</label>
                                    <div class="rating-stars" style="font-size: 24px;">
                                        ${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Status Publikasi</label>
                                    <div class="status-radio-group">
                                        <label class="radio-label">
                                            <input type="radio" name="status" value="Dipublikasikan" id="statusPublished" ${status === "Dipublikasikan" ? 'checked' : ''}>
                                            <span class="radio-custom"></span>
                                            Dipublikasikan
                                        </label>
                                        <label class="radio-label">
                                            <input type="radio" name="status" value="Draft" id="statusDraft" ${status !== "Dipublikasikan" ? 'checked' : ''}>
                                            <span class="radio-custom"></span>
                                            Draft
                                        </label>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    `;

                    // Tampilkan modal
                    const modal = document.getElementById('editModal');
                    modal.innerHTML = modalContent;
                    modal.style.display = "flex";

                    // Setup event listeners
                    setupModalListeners();
                }

                // Setup event listeners untuk modal
                function setupModalListeners() {
                    // Form submission
                    const editForm = document.getElementById('editForm');
                    if (editForm) {
                        editForm.addEventListener('submit', async function(e) {
                            e.preventDefault();

                            const formData = new FormData(this);

                            try {
                                // Tampilkan loading
                                const submitBtn = this.querySelector('button[type="submit"]');
                                const originalText = submitBtn.innerHTML;
                                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                                submitBtn.disabled = true;

                                const response = await fetch(this.action, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: formData
                                });

                                if (response.ok) {
                                    const result = await response.json();
                                    alert('Feedback berhasil diperbarui!');
                                    closeEditModal();
                                    location.reload();
                                } else {
                                    const errorData = await response.json();
                                    let errorMessage = errorData.message || 'Gagal memperbarui feedback';
                                    if (response.status === 422 && errorData.errors) {
                                        // Collect all error messages from the 'errors' object
                                        const errorMessages = Object.values(errorData.errors).flat();
                                        errorMessage = errorMessages.join('\n');
                                    }
                                    throw new Error(errorMessage);
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan perubahan: ' + error.message);

                                // Reset button
                                const submitBtn = editForm.querySelector('button[type="submit"]');
                                submitBtn.innerHTML = 'Simpan Perubahan';
                                submitBtn.disabled = false;
                            }
                        });
                    }
                }

                // Fungsi untuk menutup modal
                window.closeEditModal = function() {
                    document.getElementById('editModal').style.display = "none";
                    document.getElementById('editModal').innerHTML = '';
                }

                // =============================================
                // FILTER DAN PENCARIAN (SERVER-SIDE)
                // =============================================
                const filterForm = document.getElementById('filterForm');
                const searchInputHeader = document.getElementById('searchInput'); // Header search input
                const searchInputForm = document.getElementById('search'); // Form search input
                const statusFilter = document.getElementById('status_filter');
                const ratingFilter = document.getElementById('rating_filter');
                const dateFilter = document.getElementById('date_filter');
                const kategoriFilter = document.getElementById('kategori_filter');
                const resetFilterButton = document.getElementById('resetFilter');

                // Function to submit the form
                function submitFilterForm() {
                    filterForm.submit();
                }

                // Auto-submit on change for selects and date
                if (statusFilter) statusFilter.addEventListener('change', submitFilterForm);
                if (ratingFilter) ratingFilter.addEventListener('change', submitFilterForm);
                if (dateFilter) dateFilter.addEventListener('change', submitFilterForm);
                if (kategoriFilter) kategoriFilter.addEventListener('change', submitFilterForm);

                // Auto-submit on input for text search (with a small delay)
                let searchTimeout;
                if (searchInputForm) { // Check if element exists
                    searchInputForm.addEventListener('input', () => {
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(submitFilterForm, 500); // Submit after 500ms of inactivity
                    });
                }

                // Handle header search input
                if (searchInputHeader && searchInputForm) { // Check if elements exist
                    searchInputHeader.addEventListener('input', () => {
                        searchInputForm.value = searchInputHeader.value; // Sync header search with form search
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(submitFilterForm, 500); // Submit after 500ms of inactivity
                    });
                }

                // Reset Filter functionality
                if (resetFilterButton) { // Check if element exists
                    resetFilterButton.addEventListener('click', () => {
                        if (searchInputForm) searchInputForm.value = '';
                        if (searchInputHeader) searchInputHeader.value = ''; // Also clear header search
                        if (statusFilter) statusFilter.value = '';
                        if (ratingFilter) ratingFilter.value = '';
                        if (dateFilter) dateFilter.value = '';
                        if (kategoriFilter) kategoriFilter.value = '';
                        submitFilterForm();
                    });
                }

                // Handles the dropdown menu toggling (existing in riwayat/index.blade.php)
                const dropdownToggle = document.querySelectorAll('.dropdown-toggle-custom');
                dropdownToggle.forEach(toggle => {
                    toggle.addEventListener('click', function() {
                        const target = document.querySelector(this.dataset.bsTarget);
                        if (target) {
                            const isShown = target.classList.contains('show');
                            this.setAttribute('aria-expanded', !isShown);
                            if (isShown) {
                                target.classList.remove('show');
                            } else {
                                target.classList.add('show');
                            }
                        }
                    });
                });


                // Terapkan dark mode jika sebelumnya diaktifkan (existing DOMContentLoaded block)
                if (localStorage.getItem('darkMode') === 'enabled') {
                    document.body.classList.add('dark-mode');
                    const themeToggle = document.getElementById('theme-toggle'); // Ensure themeToggle is accessible
                    if (themeToggle) {
                        themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                    }
                }

                // Tutup modal saat klik di luar modal (existing DOMContentLoaded block)
                window.addEventListener('click', function(event) {
                    const modal = document.getElementById('editModal');
                    if (modal && event.target === modal) { // Ensure modal exists
                        closeEditModal();
                    }
                });

                // Tutup modal dengan tombol ESC (existing DOMContentLoaded block)
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeEditModal();
                    }
                });
            });
        </script>
    </div>
</body>

</html>
