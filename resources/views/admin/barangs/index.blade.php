<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TI - Manajemen Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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

        /* Dark Mode Variables */
        .dark-mode {
            --primary: #4a6fa5;
            --secondary: #5d7ba6;
            --light: #1a1d23;
            --dark: #f0f0f0;
            --bg-light: #121212;
            --bg-card: #1e1e1e;
            --text-dark: #e0e0e0;
            --text-light: #a0a0a0;
            --border-light: #333;
            --gray: #8b8b8b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            animation: none !important;
            transition: none !important;
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
            transition: none !important;
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
            transition: none !important;
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
            transition: none !important;
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
            transition: none !important;
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
            transition: none !important;
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
            transition: none !important;
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
            transition: none !important;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid var(--border-light);
            transition: none !important;
        }

        .dark-mode .header {
            background: var(--bg-card);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            z-index: 2;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-light);
            border-radius: 30px;
            outline: none;
            transition: none !important;
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .search-bar input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .dark-mode .search-bar input {
            background-color: #2a2a2a;
            border-color: var(--border-light);
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
            transition: none !important;
            color: var(--text-dark);
            border: none;
        }

        .notification-btn:hover,
        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .dark-mode .notification-btn,
        .dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

        .dark-mode .notification-btn:hover,
        .dark-mode .theme-toggle:hover {
            background: #3a3a3a;
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

        /* PERBAIKAN: Dark Mode for Header Dropdown */
        .dark-mode .dropdown-menu {
            background-color: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .dropdown-menu .dropdown-item {
            color: var(--text-dark);
        }

        .dark-mode .dropdown-menu .dropdown-item:hover,
        .dark-mode .dropdown-menu .dropdown-item:focus {
            background-color: var(--primary);
            color: white;
        }

        .dark-mode .dropdown-menu .dropdown-divider {
            border-color: var(--border-light);
        }

        /* Page Title */
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding: 0 5px;
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
            border-radius: 6px;
            font-weight: 500;
            transition: none !important;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(59, 89, 152, 0.3);
            color: white;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: none !important;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
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
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: none !important;
            border: 1px solid var(--border-light);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .dark-mode .stat-card {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-card.active {
            border: 2px solid var(--primary);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: white;
            opacity: 0.9;
        }

        .stat-icon.total { background: var(--primary); }
        .stat-icon.tersedia { background: #66bb6a; }
        .stat-icon.dipinjam { background: #ffb74d; }
        .stat-icon.rusak { background: #ef5350; }

        .stat-info h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-info p {
            margin: 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Table Container */
        .table-container {
            background: var(--bg-card);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            transition: none !important;
        }

        .dark-mode .table-container {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table Header dengan Filter */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: end;
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-light);
            background: var(--bg-light);
            flex-wrap: wrap;
            gap: 15px;
        }

        .dark-mode .table-header {
            background: #252525;
            border-color: var(--border-light);
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .table-filters {
            display: flex;
            gap: 12px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 140px;
        }

        .filter-group label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-light);
            white-space: nowrap;
        }

        .filter-group select,
        .filter-group input {
            padding: 8px 12px;
            border: 1px solid var(--border-light);
            border-radius: 6px;
            background: var(--bg-card);
            font-size: 0.85rem;
            color: var(--text-dark);
            transition: none !important;
            width: 100%;
            height: 38px;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .dark-mode .filter-group select,
        .dark-mode .filter-group input {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        /* Perbaikan khusus untuk button filter dan reset */
        .filter-buttons {
            display: flex;
            gap: 8px;
            align-items: end;
            height: 38px;
        }

        .filter-buttons .btn {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            font-size: 0.85rem;
            padding: 8px 16px;
            min-width: 90px;
            border-radius: 6px;
            font-weight: 500;
            transition: none !important;
            text-decoration: none;
        }

        .filter-buttons .btn-primary {
            background: var(--primary);
            border: none;
            color: white;
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
        }

        .filter-buttons .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(59, 89, 152, 0.3);
        }

        .filter-buttons .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .filter-buttons .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
        }

        /* Table */
        .table {
            margin: 0;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .table thead th {
            background: var(--bg-light);
            border-bottom: 2px solid var(--border-light);
            font-weight: 600;
            padding: 15px;
            text-align: left;
            color: var(--dark);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .dark-mode .table thead th {
            background: #252525;
            color: var(--dark);
            border-color: var(--border-light);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-dark);
            background: var(--bg-card);
        }

        .table tbody tr {
            transition: none !important;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background: var(--bg-light);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .table tbody tr:hover {
            background: #2a2a2a;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Status Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-block;
        }

        .status-tersedia {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .dark-mode .status-tersedia {
            background: #1b5e20;
            color: #a5d6a7;
        }

        .status-dipinjam {
            background: #fff8e1;
            color: #ff8f00;
        }

        .dark-mode .status-dipinjam {
            background: #5d4037;
            color: #ffcc80;
        }

        .status-rusak {
            background: #ffebee;
            color: #c62828;
        }

        .dark-mode .status-rusak {
            background: #b71c1c;
            color: #ffcdd2;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .btn-warning-custom {
            background: #ff9800;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: none !important;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-warning-custom:hover {
            background: #f57c00;
            transform: translateY(-1px);
            color: white;
            box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);
        }

        .btn-danger-custom {
            background: #f44336;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: none !important;
            font-weight: 500;
        }

        .btn-danger-custom:hover {
            background: #d32f2f;
            transform: translateY(-1px);
            color: white;
            box-shadow: 0 2px 5px rgba(244, 67, 54, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
            background: var(--bg-card);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--text-light);
            opacity: 0.7;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding: 20px 0;
        }

        .pagination {
            margin: 0;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-item .page-link {
            color: var(--primary);
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            padding: 8px 12px;
            border-radius: 6px;
            transition: none !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .page-item .page-link:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(59, 89, 152, 0.2);
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .page-item.disabled .page-link {
            color: var(--text-light);
            background: var(--bg-light);
            border-color: var(--border-light);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .dark-mode .page-item .page-link {
            background: var(--bg-card);
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        .dark-mode .page-item .page-link:hover {
            background: var(--primary);
            color: white;
        }

        .dark-mode .page-item.disabled .page-link {
            background: #2a2a2a;
            color: var(--text-light);
        }

        /* Success Message dengan Auto-hide */
        .alert-auto-hide {
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 6px;
            margin-top: 20px;
            border: 1px solid #c3e6cb;
            position: relative;
            animation: slideIn 0.3s ease-out;
        }

        .dark-mode .alert-auto-hide {
            background: #1b5e20;
            color: #e8f5e8;
            border-color: #2e7d32;
        }

        .alert-auto-hide.hiding {
            animation: slideOut 0.3s ease-in;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        /* Info Jumlah Data */
        .data-info {
            text-align: center;
            margin: 20px 0;
            color: var(--text-light);
            font-size: 0.9rem;
            padding: 12px;
            background: var(--bg-light);
            border-radius: 6px;
            border: 1px solid var(--border-light);
        }

        .data-info strong {
            color: var(--primary);
        }

        /* ============================ */
        /* MODAL STYLES - NO ANIMATION */
        /* ============================ */
        
        /* NON-ANIMATED MODAL BACKDROP */
        .modal-backdrop {
            background: rgba(0, 0, 0, 0.5);
            animation: none !important;
            transition: none !important;
            opacity: 1 !important;
        }

        .dark-mode .modal-backdrop {
            background: rgba(0, 0, 0, 0.8);
        }

        /* NON-ANIMATED MODAL */
        .modal {
            animation: none !important;
            transition: none !important;
            opacity: 1 !important;
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1055;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
        }

        .modal.show {
            display: block !important;
            opacity: 1 !important;
        }

        .modal.fade {
            animation: none !important;
            transition: none !important;
            opacity: 1 !important;
        }

        .modal.fade .modal-dialog {
            transform: none !important;
            transition: none !important;
            animation: none !important;
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: 0.5rem;
            pointer-events: none;
            animation: none !important;
            transition: none !important;
            transform: none !important;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto;
            }
        }

        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: none !important;
            transition: none !important;
            transform: none !important;
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .dark-mode .modal-content {
            background: #1e1e1e;
            color: #ffffff;
            border: 1px solid #333;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-bottom: none;
            padding: 25px 30px 20px;
            position: relative;
            animation: none !important;
            transition: none !important;
        }

        .dark-mode .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .modal-title i {
            font-size: 1.6rem;
            color: white;
        }

        .modal-body {
            padding: 30px;
            background: var(--bg-card);
            color: var(--text-dark);
            animation: none !important;
            transition: none !important;
        }

        .dark-mode .modal-body {
            background: #1e1e1e;
            color: #ffffff;
        }

        .modal-footer {
            border-top: 1px solid var(--border-light);
            padding: 20px 30px;
            background: var(--bg-light);
            border-radius: 0 0 12px 12px;
            animation: none !important;
            transition: none !important;
        }

        .dark-mode .modal-footer {
            border-color: #333;
            background: #252525;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
            display: block;
            font-size: 0.9rem;
        }

        .dark-mode .form-label {
            color: #ffffff;
        }

        .form-control {
            padding: 12px 15px;
            border: 2px solid var(--border-light);
            border-radius: 8px;
            width: 100%;
            font-size: 0.95rem;
            transition: none !important;
            background: var(--bg-card);
            color: var(--text-dark);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.1);
            outline: none;
        }

        .dark-mode .form-control {
            background: #2a2a2a;
            border-color: #444;
            color: #ffffff;
        }

        .dark-mode .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.2);
            background: #2a2a2a;
            color: #ffffff;
        }

        .dark-mode .form-control::placeholder {
            color: #888;
        }

        /* DROPDOWN STYLES DENGAN ICON PANAH */
        .select-wrapper {
            position: relative;
            display: block;
        }

        .select-wrapper::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--text-light);
            z-index: 1;
        }

        .dark-mode .select-wrapper::after {
            color: #888;
        }

        .form-control.select-dropdown {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 40px;
            background: var(--bg-card);
        }

        .dark-mode .form-control.select-dropdown {
            background: #2a2a2a;
            color: #ffffff;
        }

        .form-control.select-dropdown option {
            background: var(--bg-card);
            color: var(--text-dark);
            padding: 10px;
        }

        .dark-mode .form-control.select-dropdown option {
            background: #2a2a2a;
            color: #ffffff;
        }

        .text-danger {
            color: #dc3545 !important;
            font-weight: 500;
        }

        .dark-mode .text-danger {
            color: #ff6b6b !important;
        }

        .required-star {
            color: #dc3545;
            font-weight: bold;
        }

        .dark-mode .required-star {
            color: #ff6b6b;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .dark-mode .text-muted {
            color: #a0a0a0 !important;
        }

        .btn-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: none !important;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .dark-mode .btn-outline {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .dark-mode .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-warning {
            background: #ff9800;
            border: none;
            color: white;
        }

        .dark-mode .btn-warning {
            background: #ff9800;
            color: white;
        }

        /* Loading State */
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
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header h2,
            .menu-item span,
            .dropdown-toggle-custom span {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 15px;
            }

            .menu-item i,
            .dropdown-toggle-custom i:first-child {
                margin-right: 0;
                font-size: 1.2rem;
            }

            .dropdown-toggle-custom {
                justify-content: center;
                padding: 15px;
            }

            .dropdown-items {
                position: fixed;
                left: 70px;
                width: 200px;
                z-index: 1001;
            }

            .main-content {
                margin-left: 70px;
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .search-bar {
                width: 100%;
            }

            .stats-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .table-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
                padding: 15px;
            }

            .table-filters {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .filter-group {
                min-width: auto;
                width: 100%;
            }

            .filter-buttons {
                width: 100%;
                justify-content: stretch;
                flex-direction: row;
            }

            .filter-buttons .btn {
                flex: 1;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .pagination {
                gap: 3px;
            }

            .page-item .page-link {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }
            
            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .page-title h1 {
                font-size: 1.5rem;
            }

            .modal-dialog {
                margin: 20px 10px;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 10px;
            }
            
            .header {
                margin-bottom: 15px;
            }
            
            .stats-container {
                margin-bottom: 20px;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                margin-right: 12px;
            }
            
            .stat-info h3 {
                font-size: 1.5rem;
            }
            
            .table {
                font-size: 0.8rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 8px 6px;
            }
            
            .btn-warning-custom,
            .btn-danger-custom {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
            
            .pagination-container {
                padding: 15px 0;
            }
            
            .filter-buttons {
                flex-direction: column;
            }

            .modal-dialog {
                margin: 10px 5px;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 15px;
            }
        }

        /* HAPUS SEMUA ANIMASI UNTUK SELURUH ELEMEN */
        * {
            animation: none !important;
        }

        /* OVERRIDE BOOTSTRAP ANIMATIONS */
        .fade {
            animation: none !important;
            transition: none !important;
        }

        .modal.fade .modal-dialog {
            animation: none !important;
            transition: none !important;
            transform: none !important;
        }

        .modal.show .modal-dialog {
            animation: none !important;
            transform: none !important;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h2>Admin TI</h2>
        </div>

        <div class="sidebar-menu">
            <!-- Menu Utama - DIPERBAIKI -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama" aria-expanded="false" aria-controls="menuUtama">
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#peminjamanMenu" aria-expanded="false" aria-controls="peminjamanMenu">
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
                    <a href="/admin/riwayat" class="dropdown-item active">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Peminjaman</span>
                    </a>
                    <a href="/admin/feedback" class="dropdown-item">
                        <i class="fas fa-comment"></i>
                        <span>Feedback</span>
                    </a>
                </div>
            </div>
            
            <!-- Manajemen Aset - DROPDOWN -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#asetMenu" aria-expanded="true" aria-controls="asetMenu">
                    <span>Manajemen Aset</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse show" id="asetMenu">
                    <a href="{{ route('projectors.index') }}" class="dropdown-item">
                        <i class="fas fa-video"></i>
                        <span>Proyektor</span>
                    </a>
                    <a href="{{ route('barangs.index') }}" class="dropdown-item active">
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#akademikMenu" aria-expanded="false" aria-controls="akademikMenu">
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#penggunaMenu" aria-expanded="false" aria-controls="penggunaMenu">
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
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#laporanMenu" aria-expanded="false" aria-controls="laporanMenu">
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
                <input type="text" placeholder="Cari kode/nama/merk..." id="globalSearch">
            </div>

            <div class="user-actions">
                <div class="notification-btn" title="Notifikasi">
                    <i class="fas fa-bell"></i>
                </div>

                <div class="theme-toggle" id="theme-toggle" title="Toggle Dark Mode">
                    <i class="fas fa-moon"></i>
                </div>

                <div class="dropdown">
                    <button class="user-profile dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">
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
                        <li><h6 class="dropdown-header">Selamat Datang, @auth {{ auth()->user()->name }} @else Pengguna @endauth</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog me-2"></i> Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
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
                <h1>Manajemen Barang</h1>
                <p>Kelola data barang Lab Teknologi Informasi</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBarangModal">
                    <i class="fas fa-plus-circle"></i> Tambah Barang
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card {{ !request('status_barang') ? 'active' : '' }}" onclick="filterByStatus('')">
                <div class="stat-icon total">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalCount ?? 0 }}</h3>
                    <p>Total Barang</p>
                </div>
            </div>
            <div class="stat-card {{ request('status_barang') == 'tersedia' ? 'active' : '' }}" onclick="filterByStatus('tersedia')">
                <div class="stat-icon tersedia">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $tersediaCount ?? 0 }}</h3>
                    <p>Tersedia</p>
                </div>
            </div>
            <div class="stat-card {{ request('status_barang') == 'dipinjam' ? 'active' : '' }}" onclick="filterByStatus('dipinjam')">
                <div class="stat-icon dipinjam">
                    <i class="fas fa-hand-holding"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $dipinjamCount ?? 0 }}</h3>
                    <p>Dipinjam</p>
                </div>
            </div>
            <div class="stat-card {{ request('status_barang') == 'rusak' ? 'active' : '' }}" onclick="filterByStatus('rusak')">
                <div class="stat-icon rusak">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $rusakCount ?? 0 }}</h3>
                    <p>Rusak</p>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <!-- Table Header dengan Filter -->
            <div class="table-header">
                <div class="table-title">
                    Daftar Barang
                </div>
                <form id="filterForm" method="GET" action="{{ route('barangs.index') }}" class="table-filters">
                    <div class="filter-group">
                        <label for="search">Cari</label>
                        <input type="text" id="search" name="search" placeholder="Kode/Nama/Merk" 
                               value="{{ request('search') }}">
                    </div>
                    <div class="filter-group">
                        <label for="status_barang">Status</label>
                        <select id="status_barang" name="status_barang">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status_barang') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dipinjam" {{ request('status_barang') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="rusak" {{ request('status_barang') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="merek_barang">Merk</label>
                        <select id="merek_barang" name="merek_barang">
                            <option value="">Semua Merk</option>
                            @foreach($mereks as $merek)
                                <option value="{{ $merek }}" {{ request('merek_barang') == $merek ? 'selected' : '' }}>{{ $merek }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="sort">Urutkan</label>
                        <select id="sort" name="sort">
                            <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="kode" {{ request('sort') == 'kode' ? 'selected' : '' }}>Kode A-Z</option>
                        </select>
                    </div>
                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('barangs.index') }}" class="btn btn-outline">
                            <i class="fas fa-refresh"></i> Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="150">Kode Barang</th>
                            <th width="120">Nama Barang</th>
                            <th width="120">Model Barang</th>
                            <th width="120">Merk</th>
                            <th width="100">Status</th>
                            <th>Keterangan</th>
                            <th width="120">Tanggal Dibuat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration + ($barangs->currentPage() - 1) * $barangs->perPage() }}</td>
                                <td><strong>{{ $barang->kode_barang }}</strong></td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->model_barang }}</td>
                                <td>{{ $barang->merek_barang }}</td>
                                <td>
                                    @if($barang->status_barang == 'tersedia')
                                        <span class="badge status-tersedia">Tersedia</span>
                                    @elseif($barang->status_barang == 'dipinjam')
                                        <span class="badge status-dipinjam">Dipinjam</span>
                                    @else
                                        <span class="badge status-rusak">Rusak</span>
                                    @endif
                                </td>
                                <td>
                                    <span title="{{ $barang->keterangan_barang }}">
                                        {{ Str::limit($barang->keterangan_barang, 50) ?: '-' }}
                                    </span>
                                </td>
                                <td>{{ $barang->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $barang->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $barang->id }}">
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailBarangModal"
                                                    data-kode_barang="{{ $barang->kode_barang }}"
                                                    data-nama_barang="{{ $barang->nama_barang }}"
                                                    data-model_barang="{{ $barang->model_barang }}"
                                                    data-merek_barang="{{ $barang->merek_barang }}"
                                                    data-status_barang="{{ $barang->status_barang }}"
                                                    data-keterangan_barang="{{ $barang->keterangan_barang }}"
                                                    data-created_at="{{ $barang->created_at->format('d F Y') }}">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editBarangModal"
                                                    data-barang-id="{{ $barang->id }}"
                                                    data-kode_barang="{{ $barang->kode_barang }}"
                                                    data-nama_barang="{{ $barang->nama_barang }}"
                                                    data-model_barang="{{ $barang->model_barang }}"
                                                    data-merek_barang="{{ $barang->merek_barang }}"
                                                    data-status_barang="{{ $barang->status_barang }}"
                                                    data-keterangan_barang="{{ $barang->keterangan_barang }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang {{ $barang->nama_barang }}?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">
                                    <i class="fas fa-box-open"></i><br>
                                    @if(request()->anyFilled(['search', 'status_barang', 'merek_barang']))
                                        Tidak ada data barang yang sesuai dengan filter
                                    @else
                                        Belum ada data barang. <a href="#" data-bs-toggle="modal" data-bs-target="#createBarangModal" style="color: var(--primary);">Tambahkan barang pertama</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($barangs->hasPages())
        <div class="pagination-container">
            <nav>
                {{ $barangs->links() }}
            </nav>
        </div>
        @endif

        <!-- Info Jumlah Data -->
        <div class="data-info">
            Menampilkan <strong>{{ $barangs->firstItem() ?? 0 }}</strong> - <strong>{{ $barangs->lastItem() ?? 0 }}</strong> dari <strong>{{ $barangs->total() }}</strong> data barang
        </div>

        <!-- Success Message dengan Auto-hide -->
        @if(session('success'))
            <div class="alert-auto-hide" id="successAlert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any() && (session('form_type') == 'create' || session('form_type') == 'edit'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if(session('form_type') == 'create')
                        const createModal = new bootstrap.Modal(document.getElementById('createBarangModal'));
                        createModal.show();
                    @elseif(session('form_type') == 'edit')
                        const editModal = new bootstrap.Modal(document.getElementById('editBarangModal'));
                        editModal.show();
                    @endif
                });
            </script>
        @endif
    </div>

    <!-- Create Barang Modal -->
    <div class="modal fade" id="createBarangModal" tabindex="-1" aria-labelledby="createBarangModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBarangModalLabel">
                        <i class="fas fa-plus-circle"></i> Tambah Barang Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('barangs.store') }}" method="POST" id="createBarangForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kode_barang" class="form-label">Kode Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="model_barang" class="form-label">Model Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="model_barang" name="model_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="merek_barang" class="form-label">Merek Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="merek_barang" name="merek_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status_barang" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status_barang" name="status_barang" required>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="dipinjam">Dipinjam</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="keterangan_barang" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan_barang" name="keterangan_barang" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Edit Barang Modal -->
    <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangModalLabel">
                        <i class="fas fa-edit"></i> Edit Barang
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBarangForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_kode_barang" class="form-label">Kode Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_kode_barang" name="kode_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_model_barang" class="form-label">Model Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_model_barang" name="model_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_merek_barang" class="form-label">Merek Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_merek_barang" name="merek_barang" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_status_barang" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_status_barang" name="status_barang" required>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="dipinjam">Dipinjam</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="edit_keterangan_barang" class="form-.label">Keterangan</label>
                                <textarea class="form-control" id="edit_keterangan_barang" name="keterangan_barang" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Barang Modal -->
    <div class="modal fade" id="detailBarangModal" tabindex="-1" aria-labelledby="detailBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailBarangModalLabel">Detail Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Kode Barang</th>
                                <td id="detail_kode_barang"></td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td id="detail_nama_barang"></td>
                            </tr>
                            <tr>
                                <th>Model Barang</th>
                                <td id="detail_model_barang"></td>
                            </tr>
                             <tr>
                                <th>Merek Barang</th>
                                <td id="detail_merek_barang"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="detail_status_barang"></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td id="detail_keterangan_barang"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Dibuat</th>
                                <td id="detail_created_at"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for handling modals
        document.addEventListener('DOMContentLoaded', function () {
            var editBarangModal = document.getElementById('editBarangModal');
            editBarangModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var barangId = button.getAttribute('data-barang-id');
                var kodeBarang = button.getAttribute('data-kode_barang');
                var namaBarang = button.getAttribute('data-nama_barang');
                var modelBarang = button.getAttribute('data-model_barang');
                var merekBarang = button.getAttribute('data-merek_barang');
                var statusBarang = button.getAttribute('data-status_barang');
                var keteranganBarang = button.getAttribute('data-keterangan_barang');

                var modalForm = editBarangModal.querySelector('#editBarangForm');
                modalForm.action = '/admin/barangs/' + barangId;

                var modalBodyInputKode = editBarangModal.querySelector('#edit_kode_barang');
                var modalBodyInputNama = editBarangModal.querySelector('#edit_nama_barang');
                var modalBodyInputModel = editBarangModal.querySelector('#edit_Model_barang');
                var modalBodyInputMerek = editBarangModal.querySelector('#edit_merek_barang');
                var modalBodyInputStatus = editBarangModal.querySelector('#edit_status_barang');
                var modalBodyInputKeterangan = editBarangModal.querySelector('#edit_keterangan_barang');

                modalBodyInputKode.value = kodeBarang;
                modalBodyInputNama.value = namaBarang;
                modalBodyInputModel.value = modelBarang;
                modalBodyInputMerek.value = merekBarang;
                modalBodyInputStatus.value = statusBarang;
                modalBodyInputKeterangan.value = keteranganBarang;
            });
            
            var detailBarangModal = document.getElementById('detailBarangModal');
            detailBarangModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                document.getElementById('detail_kode_barang').textContent = button.getAttribute('data-kode_barang');
                document.getElementById('detail_nama_barang').textContent = button.getAttribute('data-nama_barang');
                document.getElementById('detail_model_barang').textContent = button.getAttribute('data-model_barang');
                document.getElementById('detail_merek_barang').textContent = button.getAttribute('data-merek_barang');
                document.getElementById('detail_status_barang').textContent = button.getAttribute('data-status_barang');
                document.getElementById('detail_keterangan_barang').textContent = button.getAttribute('data-keterangan_barang');
                document.getElementById('detail_created_at').textContent = button.getAttribute('data-created_at');
            });
        });

        function filterByStatus(status) {
            const url = new URL(window.location);
            url.searchParams.set('status_barang', status);
            window.location.href = url.toString();
        }
    </script>
</body>
</html>
