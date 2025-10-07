<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TI - Manajemen Jadwal Perkuliahan</title>
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
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid var(--border-light);
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
            transition: all 0.3s;
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
            transition: all 0.3s;
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
            transition: all 0.3s;
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
            transition: all 0.3s;
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

        .btn-danger {
            background: var(--danger);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(244, 67, 54, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-danger:hover {
            background: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(244, 67, 54, 0.3);
            color: white;
        }

        /* Import Form Styles */
        .import-form {
            background: var(--bg-card);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .dark-mode .import-form {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .import-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .import-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        .import-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .file-input-wrapper {
            position: relative;
            flex: 1;
            max-width: 300px;
        }

        .file-input-wrapper input[type="file"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border-light);
            border-radius: 6px;
            background: var(--bg-card);
            color: var(--text-dark);
            font-size: 0.85rem;
        }

        .dark-mode .file-input-wrapper input[type="file"] {
            background: #2a2a2a;
            border-color: var(--border-light);
            color: var(--text-dark);
        }

        .btn-success {
            background: var(--success);
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background: #45a049;
            transform: translateY(-1px);
            color: white;
        }

        .template-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .template-link:hover {
            color: var(--secondary);
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
            transition: all 0.3s;
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
        .stat-icon.senin { background: #66bb6a; }
        .stat-icon.selasa { background: #ffb74d; }
        .stat-icon.rabu { background: #ef5350; }
        .stat-icon.kamis { background: #5c6bc0; }
        .stat-icon.jumat { background: #26c6da; }

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
            align-items: center;
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
            transition: all 0.3s;
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

        .filter-actions {
            display: flex;
            gap: 8px;
            align-items: end;
            height: 38px;
        }

        .filter-actions .btn {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            font-size: 0.85rem;
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
            transition: all 0.3s;
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

        .status-senin {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .dark-mode .status-senin {
            background: #1b5e20;
            color: #a5d6a7;
        }

        .status-selasa {
            background: #fff8e1;
            color: #ff8f00;
        }

        .dark-mode .status-selasa {
            background: #5d4037;
            color: #ffcc80;
        }

        .status-rabu {
            background: #ffebee;
            color: #c62828;
        }

        .dark-mode .status-rabu {
            background: #b71c1c;
            color: #ffcdd2;
        }

        .status-kamis {
            background: #e8eaf6;
            color: #283593;
        }

        .dark-mode .status-kamis {
            background: #1a237e;
            color: #c5cae9;
        }

        .status-jumat {
            background: #e0f2f1;
            color: #00695c;
        }

        .dark-mode .status-jumat {
            background: #004d40;
            color: #b2dfdb;
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
            transition: all 0.3s;
            font-weight: 500;
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
            transition: all 0.3s;
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
            transition: all 0.3s;
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

        /* Responsive */
        @media (max-width: 1200px) {
            .table-filters {
                gap: 10px;
            }
            
            .filter-group {
                min-width: 130px;
            }
        }

        @media (max-width: 992px) {
            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            
            .table-filters {
                gap: 8px;
            }
            
            .filter-group {
                min-width: 120px;
            }
        }

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

            .filter-actions {
                width: 100%;
                justify-content: stretch;
            }

            .filter-actions .btn {
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

            .import-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .import-actions {
                width: 100%;
                justify-content: stretch;
            }

            .file-input-wrapper {
                max-width: none;
            }

            .page-title-actions {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .page-title-actions .btn {
                width: 100%;
                justify-content: center;
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
        }

        /* Dark Mode Transition */
        body,
        .header,
        .table-container,
        .stat-card,
        .table thead th,
        .table tbody td,
        .page-link,
        .search-bar input,
        .filter-group select,
        .filter-group input,
        .table {
            transition: all 0.3s ease;
        }

        /* Page Title Actions */
        .page-title-actions {
            display: flex;
            gap: 10px;
            align-items: center;
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
            <h2>Sarpras Politala</h2>
        </div>

        <div class="sidebar-menu">
            <a href="/admin/dashboard" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="/admin/peminjaman" class="menu-item">
                <i class="fas fa-hand-holding"></i>
                <span>Peminjaman</span>
            </a>
            <a href="/admin/pengembalian" class="menu-item">
                <i class="fas fa-undo"></i>
                <span>Pengembalian</span>
            </a>
            <a href="/admin/riwayat" class="menu-item">
                <i class="fas fa-history"></i>
                <span>Riwayat Peminjaman</span>
            </a>
            <a href="/admin/feedback" class="menu-item">
                <i class="fas fa-comment"></i>
                <span>Feedback</span>
            </a>
            <a href="/admin/proyektor" class="menu-item">
                <i class="fas fa-video"></i>
                <span>Proyektor</span>
            </a>
            <a href="/admin/jadwal-perkuliahan" class="menu-item active">
                <i class="fas fa-calendar-alt"></i>
                <span>Jadwal Perkuliahan</span>
            </a>
            <a href="/admin/ruangan" class="menu-item">
                <i class="fas fa-door-open"></i>
                <span>Ruangan</span>
            </a>
            <a href="/admin/matakuliah" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Matakuliah</span>
            </a>
            <a href="/admin/kelas" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Kelas</span>
            </a>
            <a href="/admin/pengguna" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Pengguna</span>
            </a>
            <a href="/admin/laporan" class="menu-item">
                <i class="fas fa-chart-bar"></i>
                <span>Statistik</span>
            </a>
            <a href="/admin/pengaturan" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari mata kuliah/dosen/kelas..." id="globalSearch" value="{{ request('search') ?? '' }}">
            </div>

            <div class="user-actions">
                <div class="notification-btn">
                    <i class="fas fa-bell"></i>
                </div>

                <div class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </div>

                <div class="user-profile">
                    <div class="user-avatar">A</div>
                    <div>
                        <div>Admin Lab</div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">Teknologi Informasi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title -->
<div class="page-title">
    <div>
        <h1>Manajemen Jadwal Perkuliahan</h1>
        <p>Kelola jadwal perkuliahan Lab Teknologi Informasi</p>
    </div>
    <div class="page-title-actions">
        <a href="{{ route('jadwal-perkuliahan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
        <!-- Di view -->
<form action="{{ route('jadwal-perkuliahan.delete-all') }}" method="POST" onsubmit="return confirmDeleteAll()">
    @csrf
    <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash"></i> Hapus Semua
    </button>
</form>
    </div>
</div>

        <!-- Import Excel Form -->
        <form action="{{ route('jadwal-perkuliahan.import') }}" method="POST" enctype="multipart/form-data" class="import-form">
            @csrf
            <div class="import-header">
                <h3 class="import-title">
                    <i class="fas fa-file-import me-2"></i>Import Data dari Excel
                </h3>
                <div class="import-actions">
                    <div class="file-input-wrapper">
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                    </div>
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-upload me-1"></i> Import Excel
                    </button>
                    
                </div>
            </div>
            <!-- Alert untuk pesan sukses/error import -->
            @if(session('import_success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('import_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('import_error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('import_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </form>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card {{ !request('hari') ? 'active' : '' }}" onclick="filterByDay('')">
                <div class="stat-icon total">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalCount ?? 0 }}</h3>
                    <p>Total Jadwal</p>
                </div>
            </div>
            <div class="stat-card {{ request('hari') == 'Senin' ? 'active' : '' }}" onclick="filterByDay('Senin')">
                <div class="stat-icon senin">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $seninCount ?? 0 }}</h3>
                    <p>Jadwal Senin</p>
                </div>
            </div>
            <div class="stat-card {{ request('hari') == 'Selasa' ? 'active' : '' }}" onclick="filterByDay('Selasa')">
                <div class="stat-icon selasa">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $selasaCount ?? 0 }}</h3>
                    <p>Jadwal Selasa</p>
                </div>
            </div>
            <div class="stat-card {{ request('hari') == 'Rabu' ? 'active' : '' }}" onclick="filterByDay('Rabu')">
                <div class="stat-icon rabu">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $rabuCount ?? 0 }}</h3>
                    <p>Jadwal Rabu</p>
                </div>
            </div>
            <div class="stat-card {{ request('hari') == 'Kamis' ? 'active' : '' }}" onclick="filterByDay('Kamis')">
                <div class="stat-icon kamis">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $kamisCount ?? 0 }}</h3>
                    <p>Jadwal Kamis</p>
                </div>
            </div>
            <div class="stat-card {{ request('hari') == 'Jumat' ? 'active' : '' }}" onclick="filterByDay('Jumat')">
                <div class="stat-icon jumat">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $jumatCount ?? 0 }}</h3>
                    <p>Jadwal Jumat</p>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <!-- Table Header dengan Filter -->
            <div class="table-header">
                <div class="table-title">
                    Daftar Jadwal Perkuliahan
                </div>
                <form id="filterForm" method="GET" action="{{ route('jadwal-perkuliahan.index') }}" class="table-filters">
                    <div class="filter-group">
                        <label for="search">Cari</label>
                        <input type="text" id="search" name="search" placeholder="Mata Kuliah/Dosen/Kelas" value="{{ request('search') ?? '' }}">
                    </div>
                    <div class="filter-group">
                        <label for="hari">Hari</label>
                        <select id="hari" name="hari">
                            <option value="">Semua Hari</option>
                            <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="ruangan">Ruangan</label>
                        <select id="ruangan" name="ruangan">
                            <option value="">Semua Ruangan</option>
                            <option value="Lab TIK 1" {{ request('ruangan') == 'Lab TIK 1' ? 'selected' : '' }}>Lab TIK 1</option>
                            <option value="Lab TIK 2" {{ request('ruangan') == 'Lab TIK 2' ? 'selected' : '' }}>Lab TIK 2</option>
                            <option value="Lab TIK 3" {{ request('ruangan') == 'Lab TIK 3' ? 'selected' : '' }}>Lab TIK 3</option>
                            <option value="Lab TIK 4" {{ request('ruangan') == 'Lab TIK 4' ? 'selected' : '' }}>Lab TIK 4</option>
                            <option value="Ruang Teori 1" {{ request('ruangan') == 'Ruang Teori 1' ? 'selected' : '' }}>Ruang Teori 1</option>
                            <option value="Ruang Teori 2" {{ request('ruangan') == 'Ruang Teori 2' ? 'selected' : '' }}>Ruang Teori 2</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="semester">Semester</label>
                        <select id="semester" name="semester">
                            <option value="">Semua Semester</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="sort">Urutkan</label>
                        <select id="sort" name="sort">
                            <option value="hari" {{ request('sort', 'hari') == 'hari' ? 'selected' : '' }}>Hari</option>
                            <option value="waktu" {{ request('sort') == 'waktu' ? 'selected' : '' }}>Waktu</option>
                            <option value="matakuliah" {{ request('sort') == 'matakuliah' ? 'selected' : '' }}>Mata Kuliah</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('jadwal-perkuliahan.index') }}" class="btn btn-outline">
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
                            <th width="120">Hari</th>
                            <th width="150">Waktu</th>
                            <th width="100">Kode</th>
                            <th width="200">Mata Kuliah</th>
                            <th width="150">Dosen</th>
                            <th width="120">Kelas</th>
                            <th width="120">Ruangan</th>
                            <th width="100">Semester</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $item)
                            <tr>
                                <td>{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                                <td>
                                    <span class="badge status-{{ strtolower($item->hari) }}">
                                        {{ $item->hari }}
                                    </span>
                                </td>
                                <td>{{ $item->waktu }}</td>
                                <td><strong>{{ $item->kode_matkul }}</strong></td>
                                <td>{{ $item->nama_matkul }}</td>
                                <td>{{ $item->dosen }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>{{ $item->ruangan }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('jadwal-perkuliahan.edit', $item->id) }}" class="btn-warning-custom">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('jadwal-perkuliahan.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger-custom" onclick="return confirm('Hapus jadwal {{ $item->nama_matkul }}?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <i class="fas fa-calendar-times"></i><br>
                                    @if(request()->anyFilled(['search', 'hari', 'ruangan', 'semester']))
                                        Tidak ada data jadwal yang sesuai dengan filter
                                    @else
                                        Belum ada data jadwal perkuliahan
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($jadwal->hasPages())
        <div class="pagination-container">
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if($jadwal->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Sebelumnya</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $jadwal->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}">Sebelumnya</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for($page = 1; $page <= $jadwal->lastPage(); $page++)
                        @if($page == $jadwal->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $jadwal->url($page) }}&{{ http_build_query(request()->except('page')) }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    {{-- Next Page Link --}}
                    @if($jadwal->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $jadwal->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}">Selanjutnya</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Selanjutnya</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif

        <!-- Info Jumlah Data -->
        <div style="text-align: center; margin-top: 15px; color: var(--text-light); font-size: 0.9rem;">
            Menampilkan {{ $jadwal->firstItem() ?? 0 }} - {{ $jadwal->lastItem() ?? 0 }} dari {{ $jadwal->total() }} data
        </div>

        <!-- Success Message dengan Auto-hide -->
        @if(session('success'))
            <div class="alert-auto-hide" id="successAlert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Dark Mode
        const themeToggle = document.getElementById('theme-toggle');
        
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('darkMode', 'enabled');
            } else {
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        themeToggle.addEventListener('click', toggleDarkMode);

        // Load saved theme preference
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }

            // Auto-hide success message setelah 3 detik
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('hiding');
                    setTimeout(() => {
                        successAlert.remove();
                    }, 300);
                }, 3000);
            }
        });

        // Filter dari stats cards
        function filterByDay(hari) {
            document.getElementById('hari').value = hari;
            document.getElementById('filterForm').submit();
        }

        // Auto submit filter changes
        document.getElementById('hari').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('ruangan').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('semester').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('sort').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        // Auto submit search dengan debounce
        let searchTimeout;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 800);
        });

        // Global search
        document.getElementById('globalSearch').addEventListener('input', function() {
            document.getElementById('search').value = this.value;
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 800);
        });

        // Konfirmasi hapus semua data
        function confirmDeleteAll() {
            const totalData = {{ $jadwal->total() ?? 0 }};
            if (totalData === 0) {
                alert('Tidak ada data yang bisa dihapus!');
                return false;
            }
            
            return confirm(`Apakah Anda yakin ingin menghapus SEMUA data jadwal perkuliahan?\n\nTotal data yang akan dihapus: ${totalData} jadwal\n\nTindakan ini tidak dapat dibatalkan!`);
        }
    </script>
</body>
</html>