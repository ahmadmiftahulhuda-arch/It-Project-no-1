<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TI - Manajemen Jadwal Perkuliahan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* NOTIFICATION SYSTEM STYLES */
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
            color: white;
        }

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

        .theme-toggle:hover {
            background: #e4e6eb;
            color: var(--primary);
        }

        .dark-mode .theme-toggle {
            background: #2a2a2a;
            color: var(--text-dark);
        }

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

        /* Dark Mode for Header Dropdown */
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

        .stat-icon.total {
            background: var(--primary);
        }

        .stat-icon.senin {
            background: #66bb6a;
        }

        .stat-icon.selasa {
            background: #ffb74d;
        }

        .stat-icon.rabu {
            background: #ef5350;
        }

        .stat-icon.kamis {
            background: #5c6bc0;
        }

        .stat-icon.jumat {
            background: #26c6da;
        }

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
            color: var(--text-dark);
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
        }

        .dark-mode .filter-group input,
        .dark-mode .filter-group select {
            background: #2a2a2a;
            border-color: var(--border-light);
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

            .stats-container {
                grid-template-columns: 1fr;
                gap: 15px;
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

            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-title h1 {
                font-size: 1.5rem;
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

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table {
                font-size: 0.8rem;
            }

            .table thead th,
            .table tbody td {
                padding: 10px 8px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 10px;
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

            .pagination-container {
                padding: 15px 0;
            }
        }

        /* Page Title Actions */
        .page-title-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .modal-content {
            background: var(--bg-card);
            color: var(--text-dark);
            border: 1px solid var(--border-light);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-light);
            background: var(--bg-light);
        }

        .dark-mode .modal-header {
            background: #252525;
        }

        .modal-title {
            color: var(--dark);
        }

        .modal-body .form-label {
            color: var(--text-dark);
        }

        .modal-body .form-control,
        .modal-body .form-select {
            background: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border-light);
        }

        .modal-body .form-control:focus,
        .modal-body .form-select:focus {
            background: var(--bg-card);
            color: var(--text-dark);
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

            <!-- Manajemen Peminjaman -->
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

            <!-- Manajemen Aset -->
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

            <!-- Manajemen Akademik -->
            <div class="dropdown-custom">
                <button class="dropdown-toggle-custom" type="button" data-bs-toggle="collapse"
                    data-bs-target="#akademikMenu" aria-expanded="false" aria-controls="akademikMenu">
                    <span>Manajemen Akademik</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-items collapse" id="akademikMenu">
                    <a href="/admin/jadwal-perkuliahan" class="dropdown-item active">
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

            <!-- Manajemen Pengguna -->
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

            <!-- Laporan & Pengaturan -->
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
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari mata kuliah/dosen/kelas..." id="globalSearch"
                    value="{{ request('search') ?? '' }}">
            </div>

            <div class="user-actions">
                <!-- Notification Dropdown -->
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
                <h1>Manajemen Jadwal Perkuliahan</h1>
                <p>Kelola jadwal perkuliahan Lab Teknologi Informasi</p>
            </div>
            <div class="page-title-actions">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Jadwal
                </button>
                <form action="{{ route('jadwal-perkuliahan.delete-all') }}" method="POST"
                    onsubmit="return confirmDeleteAll()" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus Semua
                    </button>
                </form>
            </div>
        </div>

        <!-- Import Excel Form -->
        <form action="{{ route('jadwal-perkuliahan.import') }}" method="POST" enctype="multipart/form-data"
            class="import-form">
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
            @if (session('import_success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('import_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('import_error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('import_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
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

        <!-- Filter Section -->
        <div class="filter-section">
            <form id="filterForm" method="GET" action="{{ route('jadwal-perkuliahan.index') }}">
                <input type="hidden" name="search" id="search" value="{{ request('search') ?? '' }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="hari">Hari</label>
                        <select id="hari" name="hari">
                            <option value="">Semua Hari</option>
                            @if (!empty($hariList) && $hariList->count())
                                @foreach ($hariList as $h)
                                    <option value="{{ $h }}"
                                        {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                                @endforeach
                            @else
                                <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            @endif
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="ruangan">Ruangan</label>
                        <select id="ruangan" name="ruangan">
                            <option value="">Semua Ruangan</option>
                            @if (!empty($ruanganList) && $ruanganList->count())
                                @foreach ($ruanganList as $r)
                                    <option value="{{ $r }}"
                                        {{ request('ruangan') == $r ? 'selected' : '' }}>{{ $r }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="sistem_kuliah">Sistem Kuliah</label>
                        <select id="sistem_kuliah" name="sistem_kuliah">
                            <option value="">Semua Sistem</option>
                            @if (!empty($sistemKuliahList) && $sistemKuliahList->count())
                                @foreach ($sistemKuliahList as $sk)
                                    <option value="{{ $sk }}"
                                        {{ request('sistem_kuliah') == $sk ? 'selected' : '' }}>{{ $sk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="filter-actions" style="margin-top:12px; display:flex; gap:8px;">
                    <a href="{{ route('jadwal-perkuliahan.index') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-refresh me-1"></i> Reset
                    </a>
                    <a href="{{ route('jadwal-perkuliahan.export', request()->query()) }}"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-file-export me-1"></i> Ekspor
                    </a>
                </div>
            </form>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="120">Kode Matkul</th>
                            <th width="150">Sistem Kuliah</th>
                            <th width="120">Nama Kelas</th>
                            <th width="180">Kelas Mahasiswa</th>
                            <th width="180">Sebaran Mahasiswa</th>
                            <th width="100">Hari</th>
                            <th width="120">Jam Mulai</th>
                            <th width="120">Jam Selesai</th>
                            <th width="100">Ruangan</th>
                            <th width="120">Daya Tampung</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $item)
                            <tr>
                                <td>{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $item->kode_matkul ?? '-' }}</strong></td>
                                <td>{{ $item->sistem_kuliah ?? '-' }}</td>
                                <td>{{ $item->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->kelas_mahasiswa ?? '-' }}</td>
                                <td>{{ $item->sebaran_mahasiswa ?? '-' }}</td>
                                <td>
                                    @if ($item->hari)
                                        <span class="badge status-{{ strtolower($item->hari) }}">{{ $item->hari }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->jam_mulai ?? '-' }}</td>
                                <td>{{ $item->jam_selesai ?? '-' }}</td>
                                <td>{{ $item->ruangan ?? '-' }}</td>
                                <td>{{ $item->daya_tampung ?? '-' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-warning-custom" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('jadwal-perkuliahan.destroy', $item->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger-custom"
                                                onclick="return confirm('Hapus jadwal {{ $item->kode_matkul }}?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="empty-state">
                                    <i class="fas fa-calendar-times"></i><br>
                                    @if (request()->anyFilled(['search', 'hari', 'ruangan', 'sistem_kuliah']))
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

            <!-- Pagination -->
            @if ($jadwal->hasPages())
                <div class="pagination-container">
                    <nav>
                        <ul class="pagination">
                            @if ($jadwal->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $jadwal->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}">Sebelumnya</a>
                                </li>
                            @endif

                            @for ($page = 1; $page <= $jadwal->lastPage(); $page++)
                                @if ($page == $jadwal->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $jadwal->url($page) }}&{{ http_build_query(request()->except('page')) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($jadwal->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $jadwal->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}">Selanjutnya</a>
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
                Menampilkan {{ $jadwal->firstItem() ?? 0 }} - {{ $jadwal->lastItem() ?? 0 }} dari
                {{ $jadwal->total() }} data
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert-auto-hide" id="successAlert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
        </div>

        <!-- MODAL CREATE -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Jadwal Perkuliahan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('jadwal-perkuliahan.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="hari" class="form-label">Hari <span class="text-danger">*</span></label>
                                    <select class="form-select" id="hari" name="hari" required>
                                        <option value="">Pilih Hari</option>
                                        <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                        <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                        <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                        <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    </select>
                                    @error('hari')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="jam_mulai" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                        value="{{ old('jam_mulai') }}" required>
                                    @error('jam_mulai')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="jam_selesai" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                        value="{{ old('jam_selesai') }}" required>
                                    @error('jam_selesai')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="ruangan" class="form-label">Ruangan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="ruangan" name="ruangan" required>
                                        <option value="">Pilih Ruangan</option>
                                        <option value="Lab TIK 1" {{ old('ruangan') == 'Lab TIK 1' ? 'selected' : '' }}>Lab TIK 1</option>
                                        <option value="Lab TIK 2" {{ old('ruangan') == 'Lab TIK 2' ? 'selected' : '' }}>Lab TIK 2</option>
                                        <option value="Lab TIK 3" {{ old('ruangan') == 'Lab TIK 3' ? 'selected' : '' }}>Lab TIK 3</option>
                                        <option value="Lab TIK 4" {{ old('ruangan') == 'Lab TIK 4' ? 'selected' : '' }}>Lab TIK 4</option>
                                        <option value="Ruang Teori 1" {{ old('ruangan') == 'Ruang Teori 1' ? 'selected' : '' }}>Ruang Teori 1</option>
                                        <option value="Ruang Teori 2" {{ old('ruangan') == 'Ruang Teori 2' ? 'selected' : '' }}>Ruang Teori 2</option>
                                    </select>
                                    @error('ruangan')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="kode_matkul" class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kode_matkul" name="kode_matkul" required>
                                        <option value="">Pilih Kode Mata Kuliah</option>
                                        @foreach ($mataKuliahs as $matakuliah)
                                            <option value="{{ $matakuliah->kode }}"
                                                {{ old('kode_matkul') == $matakuliah->kode ? 'selected' : '' }}>
                                                {{ $matakuliah->kode }} - {{ $matakuliah->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kode_matkul')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="sistem_kuliah" class="form-label">Sistem Kuliah <span class="text-danger">*</span></label>
                                    <select class="form-select" id="sistem_kuliah" name="sistem_kuliah" required>
                                        <option value="">Pilih Sistem Kuliah</option>
                                        <option value="Teori" {{ old('sistem_kuliah') == 'Teori' ? 'selected' : '' }}>Teori</option>
                                        <option value="Praktikum" {{ old('sistem_kuliah') == 'Praktikum' ? 'selected' : '' }}>Praktikum</option>
                                    </select>
                                    @error('sistem_kuliah')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                                        value="{{ old('nama_kelas') }}" required>
                                    @error('nama_kelas')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="kelas_mahasiswa" class="form-label">Kelas Mahasiswa</label>
                                    <select class="form-select" id="kelas_mahasiswa" name="kelas_mahasiswa">
                                        <option value="">Pilih Kelas Mahasiswa</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->nama_kelas }}"
                                                {{ old('kelas_mahasiswa') == $k->nama_kelas ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_mahasiswa')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="sebaran_mahasiswa" class="form-label">Sebaran Mahasiswa</label>
                                    <input type="text" class="form-control" id="sebaran_mahasiswa"
                                        name="sebaran_mahasiswa" value="{{ old('sebaran_mahasiswa') }}">
                                    @error('sebaran_mahasiswa')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="daya_tampung" class="form-label">Daya Tampung <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="daya_tampung" name="daya_tampung"
                                        value="{{ old('daya_tampung') }}" required>
                                    @error('daya_tampung')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT UNTUK SETIAP DATA -->
        @foreach ($jadwal as $item)
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Jadwal Perkuliahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('jadwal-perkuliahan.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit_hari{{ $item->id }}" class="form-label">Hari <span class="text-danger">*</span></label>
                                        <select class="form-select" id="edit_hari{{ $item->id }}" name="hari" required>
                                            <option value="">Pilih Hari</option>
                                            <option value="Senin" {{ old('hari', $item->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                                            <option value="Selasa" {{ old('hari', $item->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                            <option value="Rabu" {{ old('hari', $item->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                            <option value="Kamis" {{ old('hari', $item->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                            <option value="Jumat" {{ old('hari', $item->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                        </select>
                                        @error('hari')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_jam_mulai{{ $item->id }}" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" id="edit_jam_mulai{{ $item->id }}"
                                            name="jam_mulai" value="{{ old('jam_mulai', $item->jam_mulai) }}" required>
                                        @error('jam_mulai')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit_jam_selesai{{ $item->id }}" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" id="edit_jam_selesai{{ $item->id }}"
                                            name="jam_selesai" value="{{ old('jam_selesai', $item->jam_selesai) }}" required>
                                        @error('jam_selesai')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_ruangan{{ $item->id }}" class="form-label">Ruangan <span class="text-danger">*</span></label>
                                        <select class="form-select" id="edit_ruangan{{ $item->id }}" name="ruangan" required>
                                            <option value="">Pilih Ruangan</option>
                                            <option value="Lab TIK 1" {{ old('ruangan', $item->ruangan) == 'Lab TIK 1' ? 'selected' : '' }}>Lab TIK 1</option>
                                            <option value="Lab TIK 2" {{ old('ruangan', $item->ruangan) == 'Lab TIK 2' ? 'selected' : '' }}>Lab TIK 2</option>
                                            <option value="Lab TIK 3" {{ old('ruangan', $item->ruangan) == 'Lab TIK 3' ? 'selected' : '' }}>Lab TIK 3</option>
                                            <option value="Lab TIK 4" {{ old('ruangan', $item->ruangan) == 'Lab TIK 4' ? 'selected' : '' }}>Lab TIK 4</option>
                                            <option value="Ruang Teori 1" {{ old('ruangan', $item->ruangan) == 'Ruang Teori 1' ? 'selected' : '' }}>Ruang Teori 1</option>
                                            <option value="Ruang Teori 2" {{ old('ruangan', $item->ruangan) == 'Ruang Teori 2' ? 'selected' : '' }}>Ruang Teori 2</option>
                                        </select>
                                        @error('ruangan')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="kode_matkul" class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                                        <select class="form-select" id="kode_matkul" name="kode_matkul" required>
                                            <option value="">Pilih Kode Mata Kuliah</option>
                                            @foreach ($mataKuliahs as $matakuliah)
                                                <option value="{{ $matakuliah->kode }}"
                                                    {{ old('kode_matkul', $item->kode_matkul) == $matakuliah->kode ? 'selected' : '' }}>
                                                    {{ $matakuliah->kode }} - {{ $matakuliah->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kode_matkul')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_sistem_kuliah{{ $item->id }}" class="form-label">Sistem Kuliah <span class="text-danger">*</span></label>
                                        <select class="form-select" id="edit_sistem_kuliah{{ $item->id }}" name="sistem_kuliah" required>
                                            <option value="">Pilih Sistem Kuliah</option>
                                            <option value="Teori" {{ old('sistem_kuliah', $item->sistem_kuliah) == 'Teori' ? 'selected' : '' }}>Teori</option>
                                            <option value="Praktikum" {{ old('sistem_kuliah', $item->sistem_kuliah) == 'Praktikum' ? 'selected' : '' }}>Praktikum</option>
                                        </select>
                                        @error('sistem_kuliah')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit_nama_kelas{{ $item->id }}" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="edit_nama_kelas{{ $item->id }}"
                                            name="nama_kelas" value="{{ old('nama_kelas', $item->nama_kelas) }}" required>
                                        @error('nama_kelas')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kelas_mahasiswa" class="form-label">Kelas Mahasiswa</label>
                                        <select class="form-select" id="kelas_mahasiswa" name="kelas_mahasiswa">
                                            <option value="">Pilih Kelas Mahasiswa</option>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->nama_kelas }}"
                                                    {{ old('kelas_mahasiswa', $item->kelas_mahasiswa) == $k->nama_kelas ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_mahasiswa')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="edit_sebaran_mahasiswa{{ $item->id }}" class="form-label">Sebaran Mahasiswa</label>
                                        <input type="text" class="form-control" id="edit_sebaran_mahasiswa{{ $item->id }}"
                                            name="sebaran_mahasiswa" value="{{ old('sebaran_mahasiswa', $item->sebaran_mahasiswa) }}">
                                        @error('sebaran_mahasiswa')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_daya_tampung{{ $item->id }}" class="form-label">Daya Tampung <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="edit_daya_tampung{{ $item->id }}"
                                            name="daya_tampung" value="{{ old('daya_tampung', $item->daya_tampung) }}" required>
                                        @error('daya_tampung')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Perbarui
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                    item.className = 'notification-item unread';
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
            if (unreadCount > 0) {
                notificationBadge.style.display = 'flex';
            } else {
                notificationBadge.style.display = 'none';
            }
        }

        function showNotificationToast(type, title, message) {
            const container = document.querySelector('.notification-toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `notification-toast ${type}`;
            toast.innerHTML = `
                <div class="toast-header">
                    <div class="toast-icon ${type}">
                        <i class="fas ${getIconForType(type)}"></i>
                    </div>
                    <div class="toast-title">${title}</div>
                    <button class="toast-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="toast-body">${message}</div>
                <div class="toast-time">
                    <i class="fas fa-clock"></i>
                    <span>Baru saja</span>
                </div>
                <div class="toast-progress">
                    <div class="toast-progress-bar"></div>
                </div>
            `;

            container.appendChild(toast);

            // Remove toast when close button clicked
            toast.querySelector('.toast-close').addEventListener('click', () => {
                toast.style.animation = 'toastSlideOut 0.3s ease forwards';
                setTimeout(() => toast.remove(), 300);
            });

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.style.animation = 'toastSlideOut 0.3s ease forwards';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 5000);
        }

        function getIconForType(type) {
            switch (type) {
                case 'success': return 'fa-check-circle';
                case 'warning': return 'fa-exclamation-triangle';
                case 'danger': return 'fa-times-circle';
                default: return 'fa-info-circle';
            }
        }

        function showActiveFilters() {
            const urlParams = new URLSearchParams(window.location.search);
            const activeFilters = [];
            if (urlParams.get('search')) activeFilters.push(`Pencarian: "${urlParams.get('search')}"`);
            if (urlParams.get('hari')) activeFilters.push(`Hari: ${urlParams.get('hari')}`);
            if (urlParams.get('ruangan')) activeFilters.push(`Ruangan: ${urlParams.get('ruangan')}`);
            if (urlParams.get('sistem_kuliah')) activeFilters.push(`Sistem: ${urlParams.get('sistem_kuliah')}`);
            
            if (activeFilters.length > 0) {
                const existingAlert = document.querySelector('.filter-alert');
                if (existingAlert) existingAlert.remove();
                const filterInfo = document.createElement('div');
                filterInfo.className = 'alert alert-info alert-dismissible fade show mt-3 filter-alert';
                filterInfo.innerHTML = `<strong>Filter Aktif:</strong> ${activeFilters.join(', ')}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
                const filterSection = document.querySelector('.filter-section');
                if (filterSection) filterSection.appendChild(filterInfo);
            }
        }

        // ========== INITIALIZATION ON DOM CONTENT LOADED ==========
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Theme
            const themeToggle = document.getElementById('theme-toggle');
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }
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

            // Auto-submit search form
            let searchTimeout;
            const globalSearchEl = document.getElementById('globalSearch');
            const searchHidden = document.getElementById('search');
            if (globalSearchEl && searchHidden) {
                globalSearchEl.addEventListener('input', function() {
                    searchHidden.value = this.value;
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        document.getElementById('filterForm').submit();
                    }, 800);
                });
            }

            // Auto-submit filter form
            document.querySelectorAll('#filterForm select').forEach(select => {
                select.addEventListener('change', () => {
                    document.getElementById('filterForm').submit();
                });
            });

            // Filter dari stats cards
            window.filterByDay = function(hari) {
                document.getElementById('hari').value = hari;
                document.getElementById('filterForm').submit();
            }

            // Konfirmasi hapus semua data
            window.confirmDeleteAll = function() {
                const totalData = {{ $jadwal->total() ?? 0 }};
                if (totalData === 0) {
                    alert('Tidak ada data yang bisa dihapus!');
                    return false;
                }

                return confirm(
                    `Apakah Anda yakin ingin menghapus SEMUA data jadwal perkuliahan?\n\nTotal data yang akan dihapus: ${totalData} jadwal\n\nTindakan ini tidak dapat dibatalkan!`
                );
            }

            // Initialize notification listeners
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', async () => {
                    notifications = [];
                    renderNotifications();
                    try {
                        await fetch('{{ route('admin.notifications.markAllAsRead') }}', { 
                            method: 'POST', 
                            headers: { 
                                'X-CSRF-TOKEN': csrfToken, 
                                'Content-Type': 'application/json' 
                            } 
                        });
                    } catch (error) { 
                        console.error('Failed to mark all as read:', error); 
                    }
                });
            }
            
            if (clearNotificationsBtn) {
                clearNotificationsBtn.addEventListener('click', async () => {
                    notifications = [];
                    renderNotifications();
                    try {
                        await fetch('{{ route('admin.notifications.clearAll') }}', { 
                            method: 'POST', 
                            headers: { 
                                'X-CSRF-TOKEN': csrfToken, 
                                'Content-Type': 'application/json' 
                            } 
                        });
                    } catch (error) { 
                        console.error('Failed to clear notifications:', error); 
                    }
                });
            }

            // Show success notification from session
            @if(session('success'))
                showNotificationToast('success', 'Sukses!', '{{ session('success') }}');
            @endif

            @if(session('error'))
                showNotificationToast('danger', 'Error!', '{{ session('error') }}');
            @endif

            @if(session('import_success'))
                showNotificationToast('success', 'Import Berhasil!', '{{ session('import_success') }}');
            @endif

            @if(session('import_error'))
                showNotificationToast('danger', 'Import Gagal!', '{{ session('import_error') }}');
            @endif

            // Auto-hide success alert
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('hiding');
                    setTimeout(() => {
                        successAlert.remove();
                    }, 300);
                }, 3000);
            }

            // Initial data fetch
            showActiveFilters();
            fetchNotifications();

            // Poll for new notifications every 30 seconds
            setInterval(fetchNotifications, 30000);
        });

        // Time validation functions
        function initializeTimeValidation(form) {
            const jamMulai = form.querySelector('[name="jam_mulai"]');
            const jamSelesai = form.querySelector('[name="jam_selesai"]');

            if (jamMulai && jamSelesai) {
                function validateTime() {
                    if (jamMulai.value && jamSelesai.value) {
                        if (jamMulai.value >= jamSelesai.value) {
                            jamSelesai.setCustomValidity('Jam selesai harus lebih besar dari jam mulai');
                            jamSelesai.reportValidity();
                            return false;
                        } else {
                            jamSelesai.setCustomValidity('');
                        }
                    }
                    return true;
                }

                jamMulai.addEventListener('change', validateTime);
                jamSelesai.addEventListener('change', validateTime);

                form.addEventListener('submit', function(e) {
                    if (!validateTime()) {
                        e.preventDefault();
                        return false;
                    }
                    return true;
                });
            }
        }

        // Initialize time validation for all modals
        document.querySelectorAll('form').forEach(form => {
            if (form.querySelector('[name="jam_mulai"]') && form.querySelector('[name="jam_selesai"]')) {
                initializeTimeValidation(form);
            }
        });

        // Auto open modal if there are validation errors
        @if($errors->any())
            @if(request()->isMethod('post') && !isset($jadwalPerkuliahan))
                setTimeout(function() {
                    const createModal = new bootstrap.Modal(document.getElementById('createModal'));
                    createModal.show();
                }, 300);
            @endif
        @endif
    </script>
</body>
</html>