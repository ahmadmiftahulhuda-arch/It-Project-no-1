<!DOCTYPE html>
<html>

<head>
    <title>Data Kelas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        /* CARD STATS STYLES */
        .stat-card {
            background-color: var(--bg-card);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid var(--border-light);
        }

        .dark-mode .stat-card {
            background-color: var(--bg-card);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-color: var(--border-light);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.bg-primary-light {
            background-color: var(--primary);
        }

        .stat-icon.bg-success-light {
            background-color: var(--success);
        }

        .stat-icon.bg-info-light {
            background-color: var(--info);
        }

        .dark-mode .stat-icon.bg-primary-light {
            background-color: #3f60a8;
        }

        .dark-mode .stat-icon.bg-success-light {
            background-color: #388e3c;
        }

        .dark-mode .stat-icon.bg-info-light {
            background-color: #1565c0;
        }


        .stat-title {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }

        .dark-mode .stat-value {
            color: var(--text-dark);
        }

        /* END CARD STATS STYLES */

        /* CARD KELAS STYLES (NEW) */
        .card-kelas {
            background-color: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .card-kelas:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .dark-mode .card-kelas {
            background-color: var(--bg-card);
            border-color: var(--border-light);
        }

        .card-kelas .card-footer {
            background-color: var(--bg-light);
            border-top: 1px solid var(--border-light);
            padding: 10px 15px;
            border-radius: 0 0 10px 10px;
            display: flex;
            gap: 8px;
            /* Menjaga jarak antar tombol */
            flex-wrap: nowrap;
        }

        .dark-mode .card-kelas .card-footer {
            background-color: #2a2a2a;
            border-color: var(--border-light);
        }

        .card-kelas .card-title {
            color: var(--dark) !important;
            transition: color 0.3s ease;
        }

        .dark-mode .card-kelas .card-title {
            color: var(--text-dark) !important;
        }

        .kelas-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            background-color: var(--primary);
        }

        /* Memastikan tombol di card footer memiliki lebar yang sama */
        .card-footer .btn {
            flex-grow: 1;
            text-align: center;
            padding: 6px 10px;
            /* Sedikit lebih kecil agar muat */
            font-size: 0.8rem;
        }

        /* END CARD KELAS STYLES */


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
            margin-top: 0;
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

        /* Action Buttons */
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
            justify-content: center;
            /* Tambah: agar icon dan teks center */
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
            justify-content: center;
            /* Tambah: agar icon dan teks center */
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
            border-radius: 10px;
            border: 2px dashed var(--border-light);
            margin-top: 15px;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--text-light);
            opacity: 0.7;
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
            color: white;
            font-weight: bold;
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
            
            .notification-dropdown {
                width: 95vw !important;
                max-width: 95vw !important;
                margin-right: 10px;
            }

            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-title h1 {
                font-size: 1.5rem;
            }
            
            .notification-toast {
                min-width: 280px;
                max-width: 320px;
                right: 10px;
                top: 10px;
            }

            /* Menyesuaikan grid agar menjadi 1 kolom di HP */
            .col-xl-3.col-lg-4.col-md-6 {
                width: 100%;
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .stat-card,
        .card-kelas,
        .card-kelas .card-footer,
        .search-bar input {
            transition: all 0.3s ease;
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
                    <a href="/admin/pengembalian" class="dropdown-item">
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
                    <a href="/admin/kelas" class="dropdown-item active">
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

    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <form action="{{ route('admin.kelas.index') }}" method="GET" class="flex-grow">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari kelas..." id="globalSearch" name="search"
                        value="{{ request('search') ?? '' }}">
                </form>
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

        <div class="page-title">
            <div>
                <h1>Manajemen Kelas</h1>
                <p>Platform terpusat untuk mengelola data kelas secara efisien.</p>
            </div>
            <div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
                    <i class="fas fa-plus"></i> Tambah Kelas
                </button>
            </div>
        </div>
        <div class="row mb-4">
            {{-- Card Total Kelas --}}
            <div class="col-md-4 mb-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-title">Total Kelas</div>
                        <div class="stat-value">{{ $totalKelas ?? '0' }}</div>
                    </div>
                    <div class="stat-icon bg-primary-light">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
            </div>

            {{-- Card Total Mahasiswa --}}
            <div class="col-md-4 mb-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-title">Total Mahasiswa</div>
                        <div class="stat-value">{{ $totalMahasiswa ?? '0' }}</div>
                    </div>
                    <div class="stat-icon bg-success-light">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>

            {{-- Card Rata-rata per Kelas --}}
            <div class="col-md-4 mb-3">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-title">Rata-rata per Kelas</div>
                        <div class="stat-value">{{ $rataRata ?? '0' }}</div>
                    </div>
                    <div class="stat-icon bg-info-light">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
            </div>
        </div>
        <h3 style="margin-bottom: 15px; color: var(--dark);">Daftar Seluruh Kelas</h3>
        <div class="row">
            @forelse($kelas as $k)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card-kelas card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title fw-bold" style="font-size: 1.5rem;">
                                        {{ $k->nama_kelas }}
                                    </h5>
                                    <p class="card-text text-muted" style="font-size: 0.9rem;">
                                        {{ $k->mahasiswa_count }} Mahasiswa
                                    </p>
                                </div>
                                <div class="kelas-icon bg-primary-light text-white">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.kelas.show', $k->id) }}" class="btn btn-info btn-sm">
                                Detail
                            </a>
                            <button class="btn btn-warning-custom btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalEditKelas{{ $k->id }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST"
                                style="display: inline;" class="flex-grow-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-custom btn-sm w-100"
                                    onclick="return confirm('Hapus kelas {{ $k->nama_kelas }}?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-users"></i><br>
                        Belum ada data kelas
                    </div>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $kelas->appends(request()->query())->links() }}
        </div>
    </div>

    <div class="modal fade" id="modalTambahKelas" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.kelas.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i> Tambah Kelas Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kelas_tambah" class="form-label">Nama Kelas</label>
                            <input type="text" id="nama_kelas_tambah" name="nama_kelas"
                                value="{{ old('nama_kelas') }}"
                                class="form-control @error('nama_kelas') is-invalid @enderror"
                                placeholder="Contoh: 3A" required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-1"></i>
                            Tambah Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($kelas as $k)
        <div class="modal fade" id="modalEditKelas{{ $k->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.kelas.update', $k->id) }}">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Kelas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_kelas_{{ $k->id }}" class="form-label">Nama Kelas</label>
                                <input type="text" id="nama_kelas_{{ $k->id }}" name="nama_kelas"
                                    value="{{ old('nama_kelas', $k->nama_kelas) }}"
                                    class="form-control @error('nama_kelas') is-invalid @enderror"
                                    placeholder="Contoh: 3A" required>
                                @error('nama_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ========== NOTIFICATION SYSTEM ==========
        let notifications = [];
        const notificationList = document.getElementById('notificationList');
        const notificationBadge = document.getElementById('notificationBadge');
        const markAllReadBtn = document.getElementById('markAllRead');
        const clearNotificationsBtn = document.getElementById('clearNotifications');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const toastContainer = document.querySelector('.notification-toast-container');

        async function fetchNotifications() {
            try {
                const response = await fetch('{{ route('admin.notifications.index') }}');
                if (!response.ok) throw new Error('Failed to fetch');
                const data = await response.json();
                
                const newNotifications = (data.notifications || []).filter(newNotif => 
                    !notifications.some(existingNotif => existingNotif.id === newNotif.id)
                );

                if (newNotifications.length > 0) {
                    showNewNotificationsToast(newNotifications);
                }

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
                    item.href = notif.url || '#';
                    // Controller returns 'read' boolean based on 'read_at'
                    item.className = `notification-item ${!notif.read ? 'unread' : ''}`;
                    item.dataset.id = notif.id;
                    
                    item.innerHTML = `
                        <div class="notification-icon ${notif.type || 'info'}">
                            <i class="fas ${notif.icon || 'fa-info-circle'}"></i>
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
                    
                    item.addEventListener('click', (e) => {
                        e.preventDefault();
                        // Mark as read and then navigate
                        markAsRead(notif.id).then(() => {
                            window.location.href = notif.url || '#';
                        });
                    });
                    
                    notificationList.appendChild(item);
                });
            }
            updateBadge();
        }

        function updateBadge() {
            if (!notificationBadge) return;
            const unreadCount = notifications.filter(n => !n.read).length;
            notificationBadge.textContent = unreadCount;
            if (unreadCount > 0) {
                notificationBadge.style.display = 'flex';
            } else {
                notificationBadge.style.display = 'none';
            }
        }

        async function markAsRead(id) {
            const notification = notifications.find(n => n.id === id);
            // Only proceed if the notification exists and is unread
            if (notification && !notification.read) {
                notification.read = true; // Optimistic update for immediate UI feedback
                renderNotifications(); // Re-render to show it as read
                try {
                    await fetch(`/admin/notifications/${id}/mark-as-read`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
                    });
                } catch (error) {
                    console.error(`Failed to mark notification ${id} as read:`, error);
                    notification.read = false; // Revert on failure
                    renderNotifications();
                }
            }
        }

        async function markAllAsRead() {
            const currentlyUnread = notifications.filter(n => !n.read);
            if (currentlyUnread.length === 0) return;

            notifications.forEach(n => n.read = true);
            renderNotifications();
            showToast('Semua notifikasi telah ditandai sebagai dibaca', 'success');
            try {
                await fetch('{{ route('admin.notifications.markAllAsRead') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
                });
            } catch (error) {
                console.error('Failed to mark all as read:', error);
                // Revert UI on failure
                currentlyUnread.forEach(notifToRevert => {
                    const notif = notifications.find(n => n.id === notifToRevert.id);
                    if (notif) notif.read = false;
                });
                renderNotifications();
            }
        }

        async function clearAllNotifications() {
            const backupNotifications = [...notifications];
            notifications = [];
            renderNotifications();
            showToast('Semua notifikasi telah dihapus', 'info');
            try {
                await fetch('{{ route('admin.notifications.clearAll') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
                });
            } catch (error) {
                console.error('Failed to clear notifications:', error);
                notifications = backupNotifications; // Restore on failure
                renderNotifications();
            }
        }

        function showToast(message, type = 'info', title = null) {
            if(!toastContainer) return;
            const toast = document.createElement('div');
            toast.className = `notification-toast ${type}`;
            
            const titles = { info: 'Informasi', success: 'Berhasil', warning: 'Peringatan', danger: 'Error' };
            const icons = { info: 'fa-info-circle', success: 'fa-check-circle', warning: 'fa-exclamation-triangle', danger: 'fa-times-circle' };
            
            toast.innerHTML = `
                <div class="toast-header">
                    <div class="toast-icon ${type}"><i class="fas ${icons[type]}"></i></div>
                    <div class="toast-title">${title || titles[type]}</div>
                    <button class="toast-close"><i class="fas fa-times"></i></button>
                </div>
                <div class="toast-body">${message}</div>
                <div class="toast-time"><i class="fas fa-clock"></i><span>Baru saja</span></div>
                <div class="toast-progress"><div class="toast-progress-bar"></div></div>
            `;
            
            toast.querySelector('.toast-close').addEventListener('click', () => toast.remove());
            toastContainer.appendChild(toast);
            setTimeout(() => { if (toast.parentNode === toastContainer) toast.remove(); }, 5000);
        }

        function showNewNotificationsToast(newNotifications) {
            if (newNotifications.length > 0) {
                const message = newNotifications.length === 1 
                    ? `1 notifikasi baru: ${newNotifications[0].message}` 
                    : `Anda memiliki ${newNotifications.length} notifikasi baru.`;
                showToast(message, 'info', 'Notifikasi Baru');
            }
        }
    
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
            
            // Inisialisasi notifikasi
            fetchNotifications();
            setInterval(fetchNotifications, 15000); // Poll for new notifications every 15 seconds
            
            // Event listeners untuk notifikasi
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', markAllAsRead);
            }
            
            if (clearNotificationsBtn) {
                clearNotificationsBtn.addEventListener('click', clearAllNotifications);
            }
        });
    </script>

</body>

</html>
