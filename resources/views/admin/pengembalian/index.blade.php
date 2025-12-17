<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian - Sistem Manajemen Peminjaman</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
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

        /* Sidebar Styles - DIPERBAIKI dengan dropdown yang rapi */
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

        /* Dropdown Menu Styles - DIPERBAIKI */
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

        .stat-icon.returned {
            background: #66bb6a;
        }

        .stat-icon.overdue {
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
        .badge {
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .status-dikembalikan {
            background: #e8f5e9;
            color: #2e7d32;
        }

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

        .status-belum-dikembalikan,
        .status-belum_dikembalikan {
            background-color: #fff8e1;
            color: #ff8f00;
            border-color: #ffecb5;
        }

        .status-terlambat {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .status-disetujui,
        .status-dikembalikan {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-success-custom {
            background: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-danger-custom {
            background: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-warning-custom {
            background: #ff9800;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-info-custom {
            background: #2196f3;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-success-custom:hover,
        .btn-danger-custom:hover,
        .btn-warning-custom:hover,
        .btn-info-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
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
        .modal-header {
            background: var(--primary);
            color: white;
            border-bottom: none;
        }

        .btn-close-white {
            filter: invert(1);
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

        body.dark-mode .table tbody tr {
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
            <!-- Menu Utama - DIPERBAIKI -->
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
                    <a href="/admin/pengembalian" class="dropdown-item active">
                        <i class="fas fa-undo"></i>
                        <span>Pengembalian</span>
                    </a>
                    <a href="/admin/riwayat" class="dropdown-item">
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
                    <a href="/admin/settings" class="dropdown-item">
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
            <form id="searchForm" method="GET" action="{{ route('admin.pengembalian') }}" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari pengembalian..."
                    value="{{ request('search') }}">
                <button type="submit" style="display: none;"></button>
            </form>

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
                <h1>Dashboard Pengembalian</h1>
                <p>Kelola proses pengembalian barang Lab Teknologi Informasi</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3 id="pending-count">{{ $pendingReturns ?? 0 }}</h3>
                    <p>Belum Dikembalikan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon returned">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="returned-count">{{ $returnedCount ?? 0 }}</h3>
                    <p>Sudah Dikembalikan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon overdue">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="overdue-count">{{ $overdueCount ?? 0 }}</h3>
                    <p>Terlambat</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-list-alt"></i>
                </div>
                <div class="stat-info">
                    <h3 id="total-count">{{ $totalReturns ?? 0 }}</h3>
                    <p>Total Pengembalian</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form id="filterForm" method="GET" action="{{ route('admin.pengembalian') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="status_filter">Status Pengembalian</label>
                        <select id="status_filter" name="status" class="form-select js-choice">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu
                                Verifikasi
                            </option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>
                                Disetujui</option>
                            <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>
                                Terlambat</option>
                        </select>
                    </div>                      

                    <div class="filter-group">
                        <label for="ruang_filter">Ruang</label>
                        <select id="ruang_filter" name="ruangan_id" class="form-select js-choice">
                            <option value="">Semua Ruang</option>
                            @foreach ($ruangans as $r)
                                <option value="{{ $r->id }}"
                                    {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="projector_filter">Proyektor</label>
                        <select id="projector_filter" name="projector_id" class="form-select js-choice">
                            <option value="">Semua Proyektor</option>
                            @if (isset($projectors) && $projectors->count())
                                @foreach ($projectors as $p)
                                    <option value="{{ $p->id }}"
                                        {{ request('projector_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->kode_proyektor ?? 'P-' . $p->id }} - {{ $p->merk ?? '' }}
                                        {{ $p->model ?? '' }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="date_filter">Tanggal Pengembalian</label>
                        <input type="date" id="date_filter" name="date" value="{{ request('date') }}">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('admin.pengembalian') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-refresh me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Ruang & Barang</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pengembalian-table-body">
                        @if ($pengembalians->count() > 0)
                            @foreach ($pengembalians as $pengembalian)
                                @php
                                    $isLate = false;
                                    try {
                                        if (
                                            $pengembalian->tanggal_pengembalian &&
                                            $pengembalian->peminjaman &&
                                            $pengembalian->peminjaman->tanggal
                                        ) {
                                            $isLate = \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->gt(
                                                \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal),
                                            );
                                        }
                                    } catch (\Exception $e) {
                                        $isLate = false;
                                    }
                                @endphp
                                <tr data-status="{{ $pengembalian->status }}" data-id="{{ $pengembalian->id }}"
                                    data-waktu-mulai="{{ $pengembalian->peminjaman->display_waktu_mulai ?? ($pengembalian->peminjaman->waktu_mulai ?? '') }}"
                                    data-waktu-selesai="{{ $pengembalian->peminjaman->display_waktu_selesai ?? ($pengembalian->peminjaman->waktu_selesai ?? '') }}"
                                    data-waktu-pengembalian="{{ $pengembalian->tanggal_pengembalian ? \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('H:i') : '' }}">
                                    <td>{{ ($pengembalians->currentPage() - 1) * $pengembalians->perPage() + $loop->iteration }}
                                    </td>
    <!-- PEMINJAM -->
    <td>
        <div class="fw-bold">
            {{ $pengembalian->user->name ?? 'Guest' }}
        </div>
        <small class="text-muted">
            {{ $pengembalian->user->nim ?? '-' }}
        </small>
    </td>
                                    <td>
                                        <strong>{{ $pengembalian->peminjaman->ruangan->nama_ruangan ?? ($pengembalian->peminjaman->ruang ?? 'N/A') }}</strong><br>
                                        @if ($pengembalian->peminjaman->projector)
                                            <small class="text-muted">
                                                <i class="fas fa-video me-1"></i>
                                                {{ $pengembalian->peminjaman->projector->kode_proyektor ?? 'Proyektor ID: ' . $pengembalian->peminjaman->projector_id }}
                                                @if ($pengembalian->peminjaman->projector->merk || $pengembalian->peminjaman->projector->model)
                                                    -
                                                    {{ trim(($pengembalian->peminjaman->projector->merk ?? '') . ' ' . ($pengembalian->peminjaman->projector->model ?? '')) }}
                                                @endif
                                            </small>
                                        @else
                                            <small class="text-muted">Tanpa Proyektor</small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $pengembalian->peminjaman->tanggal ? \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal)->format('d M Y') : 'N/A' }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $pengembalian->peminjaman->display_waktu_mulai ?? ($pengembalian->peminjaman->waktu_mulai ?? '-') }}
                                            -
                                            {{ $pengembalian->peminjaman->display_waktu_selesai ?? ($pengembalian->peminjaman->waktu_selesai ?? '-') }}
                                        </small>
                                    </td>
                                    <td>
                                        @if ($pengembalian->tanggal_pengembalian)
                                            @php $tp = \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian); @endphp
                                            {{ $tp->format('d M Y') }}
                                            <br>
                                            <small class="text-muted">{{ $tp->format('H:i') }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                            <br>
                                            <small class="text-muted">Jatuh tempo:
                                                {{ $pengembalian->peminjaman->display_waktu_selesai ?? ($pengembalian->peminjaman->waktu_selesai ?? '-') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @php $pjStatus = $pengembalian->status; @endphp
                                        @if (in_array($pjStatus, ['verified', 'disetujui']))
                                            <span class="badge status-badge status-disetujui">
                                                <i class="fas fa-check-circle me-1"></i> Disetujui
                                            </span>
                                        @elseif (in_array($pjStatus, ['pending']))
                                            <span class="badge status-badge status-menunggu">
                                                <i class="fas fa-clock me-1"></i> Menunggu Verifikasi
                                            </span>
                                        @elseif (in_array($pjStatus, ['rejected', 'ditolak']))
                                            <span class="badge status-badge status-ditolak">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                        @elseif (in_array($pjStatus, ['overdue', 'terlambat']))
                                            <span class="badge status-badge status-terlambat">
                                                <i class="fas fa-exclamation-circle me-1"></i> Terlambat
                                            </span>
                                        @elseif ($isLate)
                                            <span class="badge status-badge status-terlambat">
                                                <i class="fas fa-exclamation-circle me-1"></i> Terlambat
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $pjStatus)) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pengembalian->kondisi_ruang)
                                            <div class="d-flex flex-column gap-1">
                                                <small><strong>Ruang:</strong>
                                                    {{ $pengembalian->kondisi_ruang }}</small>
                                                <small><strong>Proyektor:</strong>
                                                    {{ $pengembalian->kondisi_proyektor ?? '-' }}</small>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            {{-- Jika status pending → tampilkan setujui & tolak --}}
                                            @if ($pengembalian->status == 'pending')
                                                <form
                                                    action="{{ route('admin.pengembalian.approve', $pengembalian->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success-custom btn-sm">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Tombol Edit --}}
                                            <button type="button" class="btn btn-warning-custom btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                {{-- ID pengembalian --}} data-id="{{ $pengembalian->id }}"
                                                {{-- Kondisi --}}
                                                data-kondisi-ruang="{{ $pengembalian->kondisi_ruang ?? '' }}"
                                                data-kondisi-proyektor="{{ $pengembalian->kondisi_proyektor ?? '' }}"
                                                {{-- Catatan --}}
                                                data-catatan="{{ $pengembalian->catatan ?? '' }}"
                                                {{-- Tanggal & waktu pengembalian --}}
                                                data-tanggal-pengembalian="{{ $pengembalian->tanggal_pengembalian ?? '' }}"
                                                data-waktu-pengembalian="{{ $pengembalian->tanggal_pengembalian
                                                    ? \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('H:i')
                                                    : '' }}"
                                                {{-- Waktu peminjaman --}}
                                                data-waktu-mulai="{{ $pengembalian->peminjaman->display_waktu_mulai ?? ($pengembalian->peminjaman->waktu_mulai ?? '') }}"
                                                data-waktu-selesai="{{ $pengembalian->peminjaman->display_waktu_selesai ?? ($pengembalian->peminjaman->waktu_selesai ?? '') }}"
                                                {{-- Dosen --}}
                                                data-dosen-nip="{{ $pengembalian->peminjaman->dosen_nip ?? '' }}"
                                                {{-- Status --}} data-status="{{ $pengembalian->status }}">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>


                                            {{-- Tombol Detail --}}
                                            <button class="btn btn-info-custom btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" data-id="{{ $pengembalian->id }}"
                                                data-peminjam="{{ $pengembalian->user->name ?? 'Guest' }}"
                                                data-dosen="{{ $pengembalian->peminjaman->dosen->nama_dosen ?? '-' }}"
                                                data-ruang="{{ $pengembalian->peminjaman->ruangan->nama_ruangan ?? '-' }}"
                                                data-proyektor="{{ $pengembalian->peminjaman->projector
                                                    ? $pengembalian->peminjaman->projector->kode_proyektor . ' - ' . ($pengembalian->peminjaman->projector->merk ?? '')
                                                    : 'Tanpa Proyektor' }}"
                                                data-tanggal-pinjam="{{ $pengembalian->peminjaman->tanggal ?? '' }}"
                                                data-waktu-mulai="{{ $pengembalian->peminjaman->display_waktu_mulai ?? '' }}"
                                                data-waktu-selesai="{{ $pengembalian->peminjaman->display_waktu_selesai ?? '' }}"
                                                data-tanggal-pengembalian="{{ $pengembalian->tanggal_pengembalian ?? '' }}"
                                                data-waktu-pengembalian="{{ $pengembalian->tanggal_pengembalian
                                                    ? \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('H:i')
                                                    : '' }}"
                                                data-kondisi-ruang="{{ $pengembalian->kondisi_ruang ?? '-' }}"
                                                data-kondisi-proyektor="{{ $pengembalian->kondisi_proyektor ?? '-' }}"
                                                data-keterangan="{{ $pengembalian->catatan ?? '-' }}"
                                                data-status="{{ $pengembalian->status }}">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <i class="fas fa-inbox"></i><br>
                                    Belum ada data pengembalian
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if (isset($pengembalians) && $pengembalians->hasPages())
            <div class="pagination-container">
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($pengembalians->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Sebelumnya</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $pengembalians->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Sebelumnya</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($pengembalians->getUrlRange(1, $pengembalians->lastPage()) as $page => $url)
                            @if ($page == $pengembalians->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($pengembalians->hasMorePages())
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $pengembalians->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">Selanjutnya</a>
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

        <!-- Modal Kembalikan Barang -->
        <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="returnModalLabel"><i class="fas fa-undo me-2"></i> Proses
                            Pengembalian</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="returnForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Peminjam</label>
                                <input type="text" class="form-control" id="return_peminjam" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Barang</label>
                                <input type="text" class="form-control" id="return_barang" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pinjam</label>
                                <input type="text" class="form-control" id="return_tanggal_pinjam" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Jatuh Tempo</label>
                                <input type="text" class="form-control" id="return_tanggal_jatuh_tempo" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kondisi_barang" class="form-label">Kondisi Barang</label>
                                <select class="form-select" id="kondisi_barang" name="kondisi_barang" required>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="filter-group">
                            <label for="ruang_filter">Ruang</label>
                            <select id="ruang_filter" name="ruangan_id" class="form-select">
                                <option value="">Semua Ruang</option>
                                @if (isset($ruangans) && $ruangans->count())
                                    @foreach ($ruangans as $r)
                                        <option value="{{ $r->id }}"
                                            {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>
                                            {{ $r->nama_ruangan }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Detail Pengembalian -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel"><i class="fas fa-eye me-2"></i> Detail
                            Pengembalian</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">ID Pengembalian</label>
                                <p id="detail_id"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Peminjam</label>
                                <p id="detail_peminjam"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Dosen Pengampu</label>
                                <p id="detail_dosen"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Ruang</label>
                                <p id="detail_ruang"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Proyektor</label>
                                <p id="detail_proyektor"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Waktu Peminjaman</label>
                                <p id="detail_waktu_pinjam"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Waktu Pengembalian</label>
                                <p id="detail_waktu_kembali"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Status Pengembalian</label>
                                <p id="detail_status"></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Kondisi</label>
                                <p id="detail_kondisi"></p>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="fw-bold">Catatan / Keterangan</label>
                                <p id="detail_keterangan"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Pengembalian -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit me-2"></i> Edit
                            Pengembalian</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_kondisi_ruang" class="form-label">Kondisi Ruangan</label>
                                <select class="form-select" id="edit_kondisi_ruang" name="kondisi_ruang" required>
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="baik">Baik</option>
                                    <option value="rusak_ringan">Rusak Ringan</option>
                                    <option value="rusak_berat">Rusak Berat</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_kondisi_proyektor" class="form-label">Kondisi Proyektor</label>
                                <select class="form-select" id="edit_kondisi_proyektor" name="kondisi_proyektor"
                                    required>
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="baik">Baik</option>
                                    <option value="rusak_ringan">Rusak Ringan</option>
                                    <option value="rusak_berat">Rusak Berat</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" id="edit_tanggal_pengembalian" name="tanggal_pengembalian"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status</label>
                                <select id="edit_status" name="status" class="form-select" required>
                                    <option value="pending">Menunggu</option>
                                    <option value="verified">Disetujui</option>
                                    <option value="overdue">Terlambat</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="edit_catatan" name="catatan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Pengembalian -->
        <div class="modal fade" id="addReturnModal" tabindex="-1" aria-labelledby="addReturnModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addReturnModalLabel"><i class="fas fa-plus me-2"></i> Tambah
                            Pengembalian</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.pengembalian.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="peminjaman_id" class="form-label">Pilih Peminjaman</label>
                                <select class="form-select" id="peminjaman_id" name="peminjaman_id" required>
                                    <option value="">-- Pilih Peminjaman --</option>
                                    <!-- Data peminjaman akan diisi dari backend -->
                                    @if (isset($peminjamansAktif) && $peminjamansAktif->count() > 0)
                                        @foreach ($peminjamansAktif as $peminjaman)
                                            <option value="{{ $peminjaman->id }}">
                                                {{ $peminjaman->user->name ?? 'Guest' }} - {{ $peminjaman->ruang }}
                                                ({{ \Carbon\Carbon::parse($peminjaman->tanggal)->format('d M Y') }})
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>Tidak ada peminjaman aktif</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="add_kondisi_barang" class="form-label">Kondisi Barang</label>
                                <select class="form-select" id="add_kondisi_barang" name="kondisi_barang" required>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="add_keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="add_keterangan" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
        <script>
            // ========== DYNAMIC NOTIFICATION SYSTEM FUNCTIONS ==========
            let notifications = [];
            const notificationList = document.getElementById('notificationList');
            const notificationBadge = document.getElementById('notificationBadge');
            const markAllReadBtn = document.getElementById('markAllRead');
            const clearNotificationsBtn = document.getElementById('clearNotifications');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            async function fetchNotifications() {
                try {
                    const response = await fetch('{{ route('admin.notifications.index') }}');
                    if (!response.ok) throw new Error('Network response was not ok.');
                    const data = await response.json();
                    notifications = data.notifications || [];
                    renderNotifications();
                } catch (error) {
                    console.error('Failed to fetch notifications:', error);
                    if (notificationList) {
                        notificationList.innerHTML = `<div class="notification-empty"><i class="fas fa-exclamation-triangle text-danger"></i><p>Gagal memuat notifikasi</p></div>`;
                    }
                }
            }

            function renderNotifications() {
                if (!notificationList) return;
                notificationList.innerHTML = '';
                if (notifications.length === 0) {
                    notificationList.innerHTML = `<div class="notification-empty"><i class="fas fa-check-circle"></i><p>Tidak ada notifikasi baru</p></div>`;
                } else {
                    notifications.forEach(notif => {
                        const item = document.createElement('a');
                        item.href = notif.url;
                        item.className = 'notification-item unread';
                        item.dataset.id = notif.id;
                        item.innerHTML = `
                            <div class="notification-icon ${notif.type}"><i class="fas ${notif.icon}"></i></div>
                            <div class="notification-content">
                                <div class="notification-title">${notif.title}</div>
                                <div class="notification-message">${notif.message}</div>
                                <div class="notification-time"><i class="fas fa-clock"></i><span>${notif.time}</span></div>
                            </div>`;
                        item.addEventListener('click', (e) => {
                            e.preventDefault();
                            window.location.href = notif.url;
                        });
                        notificationList.appendChild(item);
                    });
                }
                updateBadge();
            }

            function updateBadge() {
                if (!notificationBadge) return;
                const unreadCount = notifications.length;
                notificationBadge.textContent = unreadCount;
                notificationBadge.style.display = unreadCount > 0 ? 'flex' : 'none';
            }
            
            // Format tanggal
            function formatDate(dateString) {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }

            // Format waktu sederhana (HH:mm)
            function formatTime(timeString) {
                if (!timeString) return '-';
                if (typeof timeString !== 'string') return String(timeString);
                if (timeString.indexOf(':') > -1) {
                    const parts = timeString.split(':');
                    return parts[0].padStart(2, '0') + ':' + parts[1].padStart(2, '0');
                }
                try {
                    const d = new Date(timeString);
                    return d.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                } catch (e) {
                    return timeString;
                }
            }

            function showActiveFilters() {
                const urlParams = new URLSearchParams(window.location.search);
                const activeFilters = [];

                if (urlParams.get('search')) {
                    activeFilters.push(`Pencarian: "${urlParams.get('search')}"`);
                }
                if (urlParams.get('status')) {
                    const statusText = {
                        'belum_dikembalikan': 'Belum Dikembalikan',
                        'dikembalikan': 'Dikembalikan',
                        'terlambat': 'Terlambat'
                    } [urlParams.get('status')] || urlParams.get('status');
                    activeFilters.push(`Status: ${statusText}`);
                }
                if (urlParams.get('date')) {
                    activeFilters.push(`Tanggal: ${urlParams.get('date')}`);
                }
                if (urlParams.get('sort')) {
                    const sortText = {
                        'newest': 'Terbaru',
                        'oldest': 'Terlama',
                        'due_date': 'Tanggal Jatuh Tempo'
                    } [urlParams.get('sort')] || urlParams.get('sort');
                    activeFilters.push(`Urutan: ${sortText}`);
                }

                if (activeFilters.length > 0) {
                    const existingAlert = document.querySelector('.filter-alert');
                    if (existingAlert) {
                        existingAlert.remove();
                    }

                    const filterInfo = document.createElement('div');
                    filterInfo.className = 'alert alert-info alert-dismissible fade show mt-3 filter-alert';
                    filterInfo.innerHTML = `
                        <strong>Filter Aktif:</strong> ${activeFilters.join(', ')}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    document.querySelector('.filter-section').appendChild(filterInfo);
                }
            }

            // ========== MAIN SCRIPT INITIALIZATION ==========
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Choices.js
                document.querySelectorAll('.js-choice').forEach(function(el) {
                    new Choices(el, { searchEnabled: true, shouldSort: false, position: 'bottom', itemSelectText: '' });
                });

                // Theme Toggle
                const themeToggle = document.getElementById('theme-toggle');
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

                // Apply saved theme
                if (localStorage.getItem('darkMode') === 'enabled') {
                    document.body.classList.add('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                }
                
                // Other initializations
                document.getElementById('date_filter')?.addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });

                const menuToggle = document.getElementById('menu-toggle');
                const sidebar = document.querySelector('.sidebar');
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                });

                let searchTimeout;
                const searchInputs = document.querySelectorAll('input[name="search"]');
                searchInputs.forEach(input => {
                    input.addEventListener('input', function() {
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(() => {
                            const form = this.closest('form');
                            if (form) form.submit();
                        }, 800);
                    });
                });

                const filterSelects = document.querySelectorAll('#filterForm select');
                filterSelects.forEach(select => {
                    select.addEventListener('change', function() {
                        document.getElementById('filterForm').submit();
                    });
                });

                const dateFilter = document.getElementById('date_filter');
                if (dateFilter) {
                    dateFilter.addEventListener('change', function() {
                        document.getElementById('filterForm').submit();
                    });
                }
                
                const returnModal = document.getElementById('returnModal');
                if (returnModal) {
                    returnModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const id = button.getAttribute('data-id');
                        const peminjam = button.getAttribute('data-peminjam');
                        const barang = button.getAttribute('data-barang');
                        const tanggalPinjam = button.getAttribute('data-tanggal-pinjam');
                        const tanggalJatuhTempo = button.getAttribute('data-tanggal-jatuh-tempo');
                        const waktuMulai = button.getAttribute('data-waktu-mulai');
                        const waktuSelesai = button.getAttribute('data-waktu-selesai');
                        const form = document.getElementById('returnForm');
                        form.action = `/admin/pengembalian/${id}/kembalikan`;
                        document.getElementById('return_peminjam').value = peminjam;
                        document.getElementById('return_barang').value = barang;
                        document.getElementById('return_tanggal_pinjam').value = formatDate(tanggalPinjam) + (waktuMulai ? ' ' + formatTime(waktuMulai) : '');
                        document.getElementById('return_tanggal_jatuh_tempo').value = formatDate(tanggalJatuhTempo) + (waktuSelesai ? ' ' + formatTime(waktuSelesai) : '');
                    });
                }

                const detailModal = document.getElementById('detailModal');
                if (detailModal) {
                    detailModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        document.getElementById('detail_id').textContent = `#${button.getAttribute('data-id')}`;
                        document.getElementById('detail_peminjam').textContent = button.getAttribute('data-peminjam') || '-';
                        document.getElementById('detail_dosen').textContent = button.getAttribute('data-dosen') || '-';
                        document.getElementById('detail_ruang').textContent = button.getAttribute('data-ruang') || '-';
                        document.getElementById('detail_proyektor').textContent = button.getAttribute('data-proyektor') || '-';
                        document.getElementById('detail_waktu_pinjam').textContent = formatDate(button.getAttribute('data-tanggal-pinjam')) + ' ' + formatTime(button.getAttribute('data-waktu-mulai')) + ' - ' + formatTime(button.getAttribute('data-waktu-selesai'));
                        document.getElementById('detail_waktu_kembali').textContent = button.getAttribute('data-tanggal-pengembalian') ? formatDate(button.getAttribute('data-tanggal-pengembalian')) + ' ' + formatTime(button.getAttribute('data-waktu-pengembalian')) : '-';
                        document.getElementById('detail_kondisi').textContent = `Ruang: ${button.getAttribute('data-kondisi-ruang')} | Proyektor: ${button.getAttribute('data-kondisi-proyektor')}`;
                        document.getElementById('detail_keterangan').textContent = button.getAttribute('data-keterangan') || '-';
                        let statusHtml = '';
                        switch (button.getAttribute('data-status')) {
                            case 'verified': statusHtml = `<span class="badge status-disetujui"><i class="fas fa-check-circle me-1"></i> Disetujui</span>`; break;
                            case 'rejected': statusHtml = `<span class="badge status-ditolak"><i class="fas fa-times-circle me-1"></i> Ditolak</span>`; break;
                            case 'overdue': statusHtml = `<span class="badge status-terlambat"><i class="fas fa-exclamation-circle me-1"></i> Terlambat</span>`; break;
                            default: statusHtml = `<span class="badge status-menunggu"><i class="fas fa-clock me-1"></i> Menunggu Verifikasi</span>`;
                        }
                        document.getElementById('detail_status').innerHTML = statusHtml;
                    });
                }
                
                const editModal = document.getElementById('editModal');
                if (editModal) {
                    editModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const id = button.getAttribute('data-id');
                        document.getElementById('editForm').action = `/admin/pengembalian/${id}`;
                        document.getElementById('edit_kondisi_ruang').value = button.getAttribute('data-kondisi-ruang') || '';
                        document.getElementById('edit_kondisi_proyektor').value = button.getAttribute('data-kondisi-proyektor') || '';
                        document.getElementById('edit_catatan').value = button.getAttribute('data-catatan') || '';
                        document.getElementById('edit_tanggal_pengembalian').value = button.getAttribute('data-tanggal-pengembalian') || '';
                        document.getElementById('edit_status').value = button.getAttribute('data-status') || 'pending';
                    });
                }

                document.querySelectorAll('form').forEach(form => {
                    if (form.id !== 'filterForm' && form.id !== 'searchForm') {
                        form.addEventListener('submit', function(e) {
                            const button = this.querySelector('button[type="submit"]');
                            const actionText = button.textContent.trim();
                            if (!confirm(`Apakah Anda yakin ingin ${actionText.toLowerCase()} data ini?`)) {
                                e.preventDefault();
                            }
                        });
                    }
                });

                // Initialize Notification Listeners
                if (markAllReadBtn) {
                    markAllReadBtn.addEventListener('click', async () => {
                        notifications = [];
                        renderNotifications();
                        try {
                            await fetch('{{ route('admin.notifications.markAllAsRead') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' } });
                        } catch (error) { console.error('Failed to mark all as read:', error); }
                    });
                }
                if (clearNotificationsBtn) {
                    clearNotificationsBtn.addEventListener('click', async () => {
                        notifications = [];
                        renderNotifications();
                        try {
                            await fetch('{{ route('admin.notifications.clearAll') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' } });
                        } catch (error) { console.error('Failed to clear notifications:', error); }
                    });
                }
                
                showActiveFilters();
                fetchNotifications();

                const tableRows = document.querySelectorAll('tbody tr');
                console.log('Jumlah data yang ditampilkan:', tableRows.length);
            });
        </script>
    </div>
</body>

</html>
