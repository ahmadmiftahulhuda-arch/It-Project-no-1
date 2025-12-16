<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TI - Pengaturan Sistem</title>
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

        /* Dropdown Menu Styles - Tanpa Icon Dropdown */
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

        .password-input-wrapper {
            position: relative;
        }
        .password-input-wrapper .form-control {
            padding-right: 40px; /* Make space for the icon */
        }
        .password-toggle-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray);
        }
        /* Ensure icon color is right in dark mode */
        .dark-mode .password-toggle-icon {
            color: var(--gray);
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
            background: linear-gradient(135deg, #ff4757, #ff3838);
            border: 2px solid var(--bg-card);
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

        .btn-success {
            background: var(--success);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(76, 175, 80, 0.2);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-success:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
            color: white;
        }

        /* Settings Container */
        .settings-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 25px;
        }

        /* Settings Sidebar */
        .settings-sidebar {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-light);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .dark-mode .settings-sidebar {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
        }

        .settings-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .settings-nav-item {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            color: var(--text-dark);
            border: 1px solid transparent;
        }

        .settings-nav-item:hover {
            background-color: rgba(59, 89, 152, 0.1);
            color: var(--primary);
            border-color: rgba(59, 89, 152, 0.2);
        }

        .settings-nav-item.active {
            background-color: rgba(59, 89, 152, 0.15);
            color: var(--primary);
            font-weight: 600;
            border-color: rgba(59, 89, 152, 0.3);
        }

        .settings-nav-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }

        /* Settings Content */
        .settings-content {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-light);
        }

        .dark-mode .settings-content {
            background: var(--bg-card);
            border-color: var(--border-light);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
        }

        /* PERBAIKAN: Settings Panel Visibility */
        .settings-panel {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .settings-panel.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Settings Section */
        .settings-section {
            margin-bottom: 30px;
        }

        .settings-section:last-child {
            margin-bottom: 0;
        }

        .settings-section h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-light);
            color: var(--dark);
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-group .form-control {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid var(--border-light);
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-group .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.1);
            outline: none;
        }

        .dark-mode .form-group .form-control {
            background-color: #2a2a2a;
            border-color: var(--border-light);
        }

        /* Toggle Switch */
        .toggle-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-light);
        }

        .toggle-container:last-child {
            border-bottom: none;
        }

        .toggle-label {
            flex: 1;
        }

        .toggle-label span:first-child {
            display: block;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .toggle-label span:last-child {
            display: block;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
            margin-left: 15px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }

        /* Form Row */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Danger Zone */
        .danger-zone {
            border: 2px solid var(--danger);
            border-radius: 10px;
            padding: 25px;
            background-color: rgba(244, 67, 54, 0.05);
            margin-top: 30px;
        }

        .dark-mode .danger-zone {
            background-color: rgba(244, 67, 54, 0.1);
        }

        .danger-zone h4 {
            color: var(--danger);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Alert Styles */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .dark-mode .alert-success {
            background-color: #1b5e20;
            color: #e8f5e8;
            border-color: #2e7d32;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .dark-mode .alert-danger {
            background-color: #c62828;
            color: #ffebee;
            border-color: #b71c1c;
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-block;
        }

        .badge-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .dark-mode .badge-success {
            background: #1b5e20;
            color: #a5d6a7;
        }

        .badge-warning {
            background: #fff8e1;
            color: #ff8f00;
        }

        .dark-mode .badge-warning {
            background: #5d4037;
            color: #ffcc80;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
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
        @media (max-width: 992px) {
            .settings-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .settings-sidebar {
                position: static;
                top: auto;
            }

            .notification-dropdown {
                width: 320px !important;
            }
        }

        @media (max-width: 768px) {
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

            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-title h1 {
                font-size: 1.5rem;
            }

            .settings-content {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .notification-dropdown {
                width: 280px !important;
                right: -100px !important;
            }

            .notification-toast-container {
                right: 10px;
                left: 10px;
            }

            .notification-toast {
                min-width: auto;
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 10px;
            }

            .settings-content {
                padding: 15px;
            }

            .toggle-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .toggle-switch {
                align-self: flex-start;
                margin-left: 0;
            }

            .notification-dropdown {
                width: 250px !important;
                right: -80px !important;
            }
        }

        /* Dark Mode Transition */
        body,
        .header,
        .settings-sidebar,
        .settings-content,
        .form-control,
        .btn,
        .alert {
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
            <!-- Menu Utama -->
            <div class="dropdown-custom">
                <!-- Icon dropdown dihapus dari sini -->
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
                <!-- Icon dropdown dihapus dari sini -->
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
                <!-- Icon dropdown dihapus dari sini -->
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
                <!-- Icon dropdown dihapus dari sini -->
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

            <!-- Manajemen Pengguna -->
            <div class="dropdown-custom">
                <!-- Icon dropdown dihapus dari sini -->
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
                <!-- Icon dropdown dihapus dari sini -->
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
                    <a href="{{ route('admin.settings.index') }}" class="dropdown-item active">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            </div>

            <!-- Sistem Pendukung Keputusan -->
            <div class="dropdown-custom">
                <!-- Icon dropdown dihapus dari sini -->
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
                <input type="text" placeholder="Cari pengaturan..." id="searchSettings">
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
                                <button type="button" class="btn btn-outline btn-sm" id="markAllRead">
                                    <i class="fas fa-check-double"></i>
                                </button>
                                <button type="button" class="btn btn-outline btn-sm" id="clearNotifications">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="notification-list" id="notificationList">
                            <!-- Notifications will be dynamically added here -->
                        </div>
                        <div class="notification-footer">
                            <a href="#" id="viewAllNotifications">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </div>

                <div class="theme-toggle" id="theme-toggle">
                    <i class="fas fa-moon"></i>
                </div>

                <!-- User Profile -->
                <div class="dropdown">
                    <button class="user-profile dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">
                        <div class="user-avatar">
                            @auth
                                {{ substr(auth()->user()->name, 0, 1) }}
                            @elseif(isset($user) && $user)
                                {{ substr($user->name, 0, 1) }}
                            @else
                                A
                            @endauth
                        </div>
                        <div>
                            <div style="color: var(--text-dark);">
                                @auth
                                    {{ auth()->user()->name }}
                                @elseif(isset($user) && $user)
                                    {{ $user->name }}
                                @else
                                    Administrator
                                @endauth
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                                @auth
                                    {{ auth()->user()->peran ?? auth()->user()->role ?? 'Admin' }}
                                @elseif(isset($user) && $user)
                                    {{ $user->peran ?? $user->role ?? 'Admin' }}
                                @else
                                    Admin
                                @endauth
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><h6 class="dropdown-header">Selamat Datang, @auth {{ auth()->user()->name }} @else Pengguna @endauth</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}#profile"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
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
                <h1>Pengaturan Sistem</h1>
                <p>Kelola pengaturan sistem, preferensi, dan konfigurasi lainnya</p>
            </div>
            <div class="page-title-actions">
                <button type="button" class="btn btn-primary" onclick="saveAllSettings()">
                    <i class="fas fa-save"></i> Simpan Semua
                </button>
            </div>
        </div>

        <!-- Settings Container -->
        <div class="settings-container">
            <!-- Settings Sidebar -->
            <div class="settings-sidebar">
                <ul class="settings-nav">
                    <li class="settings-nav-item active" data-target="profile">
                        <i class="fas fa-user"></i> Profil Akun
                    </li>
                    <li class="settings-nav-item" data-target="security">
                        <i class="fas fa-shield-alt"></i> Keamanan
                    </li>
                    <li class="settings-nav-item" data-target="notifications">
                        <i class="fas fa-bell"></i> Notifikasi
                    </li>
                </ul>
            </div>

            <!-- Settings Content -->
            <div class="settings-content">
                <!-- Profile Settings Panel -->
                <div id="profile-settings" class="settings-panel active">
                    <div class="settings-section">
                        <h3>Informasi Profil</h3>
                        @if(session('success_profile'))
                            <div class="alert alert-success">
                                {{ session('success_profile') }}
                            </div>
                        @endif
                        <!-- FIXED: Form dengan null safety -->
                        <form action="{{ route('admin.settings.profile') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" 
                                       value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" 
                                       value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="tel" id="phone" name="no_hp" class="form-control" 
                                       value="{{ old('no_hp', isset($user) && isset($user->no_hp) ? $user->no_hp : '') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan Profil
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Security Settings Panel -->
                <div id="security-settings" class="settings-panel">
                    <div class="settings-section">
                        <h3>Keamanan Akun</h3>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Update password Anda untuk menjaga keamanan akun
                        </div>
                        
                        @if(session('success_password'))
                            <div class="alert alert-success">
                                {{ session('success_password') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="password-form" method="POST" action="{{ route('admin.settings.password') }}">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Password Saat Ini <span class="text-danger">*</span></label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                                    <i class="fas fa-eye password-toggle-icon"></i>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password Baru <span class="text-danger">*</span></label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    <i class="fas fa-eye password-toggle-icon"></i>
                                </div>
                                <small class="text-muted">Minimal 8 karakter dengan kombinasi huruf, angka, dan simbol</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                    <i class="fas fa-eye password-toggle-icon"></i>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key"></i> Perbarui Password
                            </button>
                        </form>
                    </div>
                    
                    <div class="settings-section">
                        <h3>Sesi Aktif</h3>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Anda sedang login dari perangkat ini. Sesi akan berakhir setelah 24 jam inaktif.
                        </div>
                    </div>
                    
                    <div class="settings-section">
                        <h3>Autentikasi Dua Faktor</h3>
                        @if(session('success_security'))
                            <div class="alert alert-success">
                                {{ session('success_security') }}
                            </div>
                        @endif

                        @if(Auth::user()->two_factor_enabled)
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                Autentikasi Dua Faktor (2FA) saat ini <strong>Aktif</strong>.
                            </div>
                            <p>Akun Anda dilindungi dengan lapisan keamanan tambahan. Setiap kali login, Anda akan diminta memasukkan kode dari aplikasi authenticator Anda.</p>
                            <form id="disable-2fa-form" action="{{ route('admin.2fa.disable') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-ban"></i> Nonaktifkan 2FA
                                </button>
                            </form>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                Autentikasi Dua Faktor (2FA) saat ini <strong>Tidak Aktif</strong>.
                            </div>
                            <p>Tingkatkan keamanan akun Anda dengan mengaktifkan 2FA. Anda akan memerlukan aplikasi seperti Google Authenticator.</p>
                            <button type="button" class="btn btn-primary" id="enable-2fa-btn">
                                <i class="fas fa-shield-alt"></i> Aktifkan 2FA
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Notifications Settings Panel -->
                <div id="notifications-settings" class="settings-panel">
                    <form action="{{ route('admin.settings.notifications') }}" method="POST">
                        @csrf
                        <div class="settings-section">
                            <h3>Pengaturan Notifikasi</h3>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Notifikasi Peminjaman Baru</span>
                                    <span>Dapatkan pemberitahuan untuk peminjaman baru</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="new_loan_notifications" value="1" {{ old('new_loan_notifications', isset($user) && ($user->notification_preferences['new_loan_notifications'] ?? false)) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Notifikasi Pengembalian</span>
                                    <span>Dapatkan pemberitahuan saat item dikembalikan</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="return_notifications" value="1" {{ old('return_notifications', isset($user) && ($user->notification_preferences['return_notifications'] ?? false)) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            
                            <div class="toggle-container">
                                <div class="toggle-label">
                                    <span>Notifikasi Jadwal Perkuliahan</span>
                                    <span>Dapatkan pemberitahuan untuk jadwal perkuliahan baru</span>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="schedule_notifications" value="1" {{ old('schedule_notifications', isset($user) && ($user->notification_preferences['schedule_notifications'] ?? false)) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="settings-section">
                            <h3>Frekuensi Notifikasi</h3>
                            <div class="form-group">
                                <label for="notification-frequency">Frekuensi Email Notifikasi</label>
                                <select id="notification-frequency" name="notification_frequency" class="form-control">
                                    <option value="realtime" {{ old('notification_frequency', isset($user) ? ($user->notification_preferences['notification_frequency'] ?? '') : '') == 'realtime' ? 'selected' : '' }}>Realtime (langsung)</option>
                                    <option value="hourly" {{ old('notification_frequency', isset($user) ? ($user->notification_preferences['notification_frequency'] ?? '') : '') == 'hourly' ? 'selected' : '' }}>Setiap Jam</option>
                                    <option value="daily" {{ old('notification_frequency', isset($user) ? ($user->notification_preferences['notification_frequency'] ?? '') : '') == 'daily' ? 'selected' : '' }}>Setiap Hari</option>
                                    <option value="weekly" {{ old('notification_frequency', isset($user) ? ($user->notification_preferences['notification_frequency'] ?? '') : '') == 'weekly' ? 'selected' : '' }}>Setiap Minggu</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Pengaturan Notifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 2FA Setup Modal -->
    <div class="modal fade" id="twoFactorAuthModal" tabindex="-1" aria-labelledby="twoFactorAuthModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="twoFactorAuthModalLabel">Konfigurasi Autentikasi Dua Faktor (2FA)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="2fa-step-1" class="text-center">
                        <p>Pindai gambar QR di bawah ini menggunakan aplikasi authenticator Anda (misalnya Google Authenticator).</p>
                        <div id="qr-code-container" class="my-3">
                            <!-- QR Code will be loaded here -->
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <p class="text-muted">Setelah memindai, masukkan kode OTP yang muncul di aplikasi Anda untuk menyelesaikan proses aktivasi.</p>
                    </div>
                    <hr>
                    <div id="2fa-step-2">
                        <form id="activate-2fa-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="otp" class="form-label">Kode OTP</label>
                                <input type="text" class="form-control" id="otp" name="otp" required placeholder="Masukkan 6 digit kode" maxlength="6">
                                <div class="invalid-feedback" id="otp-error"></div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check-circle"></i> Aktifkan dan Verifikasi
                            </button>
                        </form>
                    </div>
                    <hr>
                    <div id="2fa-step-3">
                        <h5><i class="fas fa-key"></i> Simpan Kode Pemulihan Anda!</h5>
                        <p>Simpan kode pemulihan ini di tempat yang aman. Anda dapat menggunakannya untuk mengakses akun jika kehilangan akses ke perangkat Anda.</p>
                        <div id="recovery-codes-container" class="bg-light p-3 rounded">
                            <ul id="recovery-codes-list" class="list-unstyled row">
                               <!-- Recovery codes will be loaded here -->
                            </ul>
                        </div>
                         <button class="btn btn-secondary mt-3" id="copy-recovery-codes">
                            <i class="fas fa-copy"></i> Salin Kode
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme toggle
            const themeToggle = document.getElementById('theme-toggle');
            const darkModeTogglePref = document.getElementById('dark-mode-toggle-pref');

            const applyTheme = (theme) => {
                if (theme === 'enabled') {
                    document.body.classList.add('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                    if(darkModeTogglePref) darkModeTogglePref.checked = true;
                } else {
                    document.body.classList.remove('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                    if(darkModeTogglePref) darkModeTogglePref.checked = false;
                }
            };

            const toggleTheme = () => {
                const currentTheme = localStorage.getItem('darkMode') === 'enabled' ? 'disabled' : 'enabled';
                localStorage.setItem('darkMode', currentTheme);
                applyTheme(currentTheme);
            };

            themeToggle.addEventListener('click', toggleTheme);
            if(darkModeTogglePref) {
                darkModeTogglePref.addEventListener('change', function() {
                    const isDarkMode = this.checked;
                    localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
                    applyTheme(isDarkMode ? 'enabled' : 'disabled');
                });
            }
            
            // Load saved theme preference
            applyTheme(localStorage.getItem('darkMode') || 'disabled');

            // Show/hide password functionality
            document.querySelectorAll('.password-toggle-icon').forEach(icon => {
                icon.addEventListener('click', function () {
                    const passwordInput = this.previousElementSibling;
                    
                    // Toggle the type
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Toggle the icon class
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            });

            // ========== Settings Navigation ==========
            const navItems = document.querySelectorAll('.settings-nav-item');
            const panels = document.querySelectorAll('.settings-panel');
            
            function switchSettingsPanel(targetId) {
                // Hide all panels
                panels.forEach(panel => {
                    panel.classList.remove('active');
                });
                
                // Show target panel
                const targetPanel = document.getElementById(targetId);
                if (targetPanel) {
                    targetPanel.classList.add('active');
                }
            }
            
            // Add click event to navigation items
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    
                    // Update active nav item
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Switch to target panel
                    switchSettingsPanel(`${target}-settings`);
                });
            });
            
            // Check URL hash on load
            const hash = window.location.hash.substring(1);
            if (hash) {
                const targetNavItem = document.querySelector(`.settings-nav-item[data-target="${hash}"]`);
                if (targetNavItem) {
                    targetNavItem.click();
                }
            } else {
                // Re-open security tab on password validation error, only if no hash is present
                @if ($errors->has('current_password') || $errors->has('password') || session('success_password'))
                    document.querySelector('.settings-nav-item[data-target="security"]').click();
                @endif
            }

            // 2FA Setup
            const enable2faBtn = document.getElementById('enable-2fa-btn');
            const twoFactorAuthModal = new bootstrap.Modal(document.getElementById('twoFactorAuthModal'));
            const qrCodeContainer = document.getElementById('qr-code-container');
            const recoveryCodesList = document.getElementById('recovery-codes-list');
            const activate2faForm = document.getElementById('activate-2fa-form');
            const otpInput = document.getElementById('otp');
            const otpError = document.getElementById('otp-error');

            if (enable2faBtn) {
                enable2faBtn.addEventListener('click', function () {
                    // Show spinner while fetching QR code
                    qrCodeContainer.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
                    recoveryCodesList.innerHTML = '';
                    
                    twoFactorAuthModal.show();

                    // Fetch QR code and recovery codes
                    fetch('{{ route("admin.2fa.setup") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            // If response is not ok, get the JSON error message and throw it
                            return response.json().then(err => { throw new Error(err.message || 'Failed to setup 2FA.') });
                        }
                        return response.json();
                    })
                    .then(data => {
                        qrCodeContainer.innerHTML = `<img src="${data.qr_code_url}" alt="QR Code">`;
                        
                        let recoveryHtml = '';
                        data.recovery_codes.forEach(code => {
                            recoveryHtml += `<li class="col-md-6 col-sm-12"><code>${code}</code></li>`;
                        });
                        recoveryCodesList.innerHTML = recoveryHtml;
                    })
                    .catch(error => {
                        console.error('Error during 2FA setup:', error);
                        // Display the specific error message from the server
                        qrCodeContainer.innerHTML = `<p class="text-danger">Gagal memuat QR code. Error: ${error.message}</p>`;
                    });
                });
            }

            if(activate2faForm) {
                activate2faForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    
                    otpError.textContent = '';
                    otpInput.classList.remove('is-invalid');

                    fetch('{{ route("admin.2fa.activate") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ otp: otpInput.value })
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        return response.json().then(err => { throw new Error(err.message) });
                    })
                    .then(data => {
                        twoFactorAuthModal.hide();
                        showToastNotification(data.message, 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    })
                    .catch(error => {
                        otpInput.classList.add('is-invalid');
                        otpError.textContent = error.message || 'Terjadi kesalahan.';
                    });
                });
            }

            const copyRecoveryCodesBtn = document.getElementById('copy-recovery-codes');
            if (copyRecoveryCodesBtn) {
                copyRecoveryCodesBtn.addEventListener('click', function() {
                    const codes = Array.from(recoveryCodesList.querySelectorAll('code')).map(el => el.textContent);
                    const codesText = codes.join('\n');
                    navigator.clipboard.writeText(codesText).then(() => {
                        showToastNotification('Kode pemulihan disalin ke clipboard!', 'success');
                    });
                });
            }

            // Disable 2FA
            const disable2faForm = document.getElementById('disable-2fa-form');
            if (disable2faForm) {
                disable2faForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    fetch('{{ route("admin.2fa.disable") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({}) // Empty body for disable
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        return response.json().then(err => { throw new Error(err.message || 'Failed to disable 2FA.') });
                    })
                    .then(data => {
                        showToastNotification(data.message, 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    })
                    .catch(error => {
                        console.error('Error during 2FA disable:', error);
                        showToastNotification(`Gagal menonaktifkan 2FA. Error: ${error.message}`, 'danger');
                    });
                });
            }

            // Search settings
            const searchInput = document.getElementById('searchSettings');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                if (searchTerm) {
                    // Search mode: show all panels and highlight matches
                    panels.forEach(panel => {
                        panel.classList.add('active');
                        
                        // Highlight search terms in panel content
                        const textElements = panel.querySelectorAll('h3, p, label, span:not(.toggle-slider)');
                        textElements.forEach(el => {
                            const originalText = el.getAttribute('data-original') || el.textContent;
                            el.setAttribute('data-original', originalText);
                            
                            if (searchTerm && originalText.toLowerCase().includes(searchTerm)) {
                                const regex = new RegExp(`(${searchTerm})`, 'gi');
                                el.innerHTML = originalText.replace(regex, '<mark style="background-color: yellow; color: black;">$1</mark>');
                            } else if (!searchTerm) {
                                el.innerHTML = originalText;
                            }
                        });
                    });
                    
                    // Filter navigation items
                    navItems.forEach(item => {
                        const text = item.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                } else {
                    // Exit search mode: restore normal view
                    const activeNavItem = document.querySelector('.settings-nav-item.active');
                    if (activeNavItem) {
                        const target = activeNavItem.getAttribute('data-target');
                        switchSettingsPanel(`${target}-settings`);
                    }
                    
                    // Show all nav items
                    navItems.forEach(item => {
                        item.style.display = 'flex';
                    });
                    
                    // Remove highlighting
                    panels.forEach(panel => {
                        const textElements = panel.querySelectorAll('[data-original]');
                        textElements.forEach(el => {
                            const originalText = el.getAttribute('data-original');
                            el.innerHTML = originalText;
                        });
                    });
                }
            });

            // =================================================================
            // IMPROVED NOTIFICATION SYSTEM
            // =================================================================

            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationList = document.getElementById('notificationList');
            const notificationBadge = document.getElementById('notificationBadge');
            const markAllReadBtn = document.getElementById('markAllRead');
            const clearNotificationsBtn = document.getElementById('clearNotifications');
            const viewAllNotificationsBtn = document.getElementById('viewAllNotifications');
            const toastContainer = document.querySelector('.notification-toast-container');

            // Sample notifications data
            let notifications = [
                {
                    id: 1,
                    title: 'Peminjaman Baru',
                    message: 'John Doe mengajukan peminjaman proyektor untuk mata kuliah Basis Data',
                    type: 'info',
                    icon: 'fa-hand-holding-usd',
                    time: '5 menit yang lalu',
                    read: false,
                    actions: ['Terima', 'Tolak']
                },
                {
                    id: 2,
                    title: 'Pengembalian Berhasil',
                    message: 'Proyektor A telah dikembalikan oleh Jane Smith dalam kondisi baik',
                    type: 'success',
                    icon: 'fa-check-circle',
                    time: '1 jam yang lalu',
                    read: false,
                    actions: ['Tandai']
                },
                {
                    id: 3,
                    title: 'Peringatan Jadwal',
                    message: 'Jadwal perkuliahan Algoritma akan dimulai dalam 30 menit',
                    type: 'warning',
                    icon: 'fa-clock',
                    time: '3 jam yang lalu',
                    read: true,
                    actions: []
                },
                {
                    id: 4,
                    title: 'Perawatan Rutin',
                    message: 'Proyektor B memerlukan perawatan rutin bulan ini',
                    type: 'danger',
                    icon: 'fa-tools',
                    time: '1 hari yang lalu',
                    read: true,
                    actions: ['Jadwalkan']
                }
            ];

            // Initialize notification system
            function initNotificationSystem() {
                renderNotificationList();
                updateNotificationBadge();
            }

            // Render notification list
            function renderNotificationList() {
                if (notifications.length === 0) {
                    notificationList.innerHTML = `
                        <div class="notification-empty">
                            <i class="fas fa-bell-slash"></i>
                            <p>Tidak ada notifikasi</p>
                        </div>
                    `;
                    return;
                }

                notificationList.innerHTML = '';
                notifications.forEach(notif => {
                    const notificationItem = createNotificationItem(notif);
                    notificationList.appendChild(notificationItem);
                });
            }

            // Create notification item element
            function createNotificationItem(notif) {
                const div = document.createElement('div');
                div.className = `notification-item ${!notif.read ? 'unread' : ''}`;
                div.dataset.id = notif.id;
                
                const iconClass = getIconClass(notif.type);
                const timeAgo = formatTimeAgo(notif.time);
                
                div.innerHTML = `
                    <div class="notification-icon ${notif.type}">
                        <i class="fas ${notif.icon}"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">${notif.title}</div>
                        <div class="notification-message">${notif.message}</div>
                        <div class="notification-time">
                            <i class="far fa-clock"></i>
                            ${timeAgo}
                        </div>
                        ${notif.actions.length > 0 ? `
                            <div class="notification-actions-item">
                                ${notif.actions.map(action => 
                                    `<button class="btn btn-outline btn-sm" onclick="handleNotificationAction(${notif.id}, '${action.toLowerCase()}')">${action}</button>`
                                ).join('')}
                            </div>
                        ` : ''}
                    </div>
                `;
                
                // Add click event to mark as read
                div.addEventListener('click', function(e) {
                    if (!e.target.closest('.btn')) {
                        markAsRead(notif.id);
                    }
                });
                
                return div;
            }

            // Get icon class based on notification type
            function getIconClass(type) {
                const iconMap = {
                    'info': 'info',
                    'success': 'success',
                    'warning': 'warning',
                    'danger': 'danger'
                };
                return iconMap[type] || 'info';
            }

            // Format time ago
            function formatTimeAgo(timeStr) {
                // This is a simple implementation
                // In real app, you would parse the actual time string
                return timeStr;
            }

            // Update notification badge
            function updateNotificationBadge() {
                const unreadCount = notifications.filter(n => !n.read).length;
                if (unreadCount > 0) {
                    notificationBadge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                    notificationBadge.style.display = 'flex';
                } else {
                    notificationBadge.style.display = 'none';
                }
            }

            // Mark notification as read
            function markAsRead(id) {
                const notification = notifications.find(n => n.id === id);
                if (notification && !notification.read) {
                    notification.read = true;
                    updateNotificationBadge();
                    
                    // Update the specific notification item
                    const notificationItem = document.querySelector(`.notification-item[data-id="${id}"]`);
                    if (notificationItem) {
                        notificationItem.classList.remove('unread');
                    }
                }
            }

            // Mark all notifications as read
            function markAllAsRead() {
                notifications.forEach(notif => notif.read = true);
                updateNotificationBadge();
                renderNotificationList();
                showToastNotification('Semua notifikasi ditandai sebagai sudah dibaca', 'success');
            }

            // Clear all notifications
            function clearAllNotifications() {
                if (confirm('Apakah Anda yakin ingin menghapus semua notifikasi?')) {
                    notifications = [];
                    updateNotificationBadge();
                    renderNotificationList();
                    showToastNotification('Semua notifikasi telah dihapus', 'info');
                }
            }

            // Handle notification action
            function handleNotificationAction(id, action) {
                const notification = notifications.find(n => n.id === id);
                if (notification) {
                    switch(action) {
                        case 'terima':
                            showToastNotification(`Peminjaman dari ${notification.message.split(' ')[0]} telah diterima`, 'success');
                            break;
                        case 'tolak':
                            showToastNotification(`Peminjaman dari ${notification.message.split(' ')[0]} telah ditolak`, 'danger');
                            break;
                        case 'tandai':
                            showToastNotification('Notifikasi telah ditandai', 'info');
                            break;
                        case 'jadwalkan':
                            showToastNotification('Perawatan telah dijadwalkan', 'success');
                            break;
                    }
                    
                    // Remove the notification after action
                    notifications = notifications.filter(n => n.id !== id);
                    updateNotificationBadge();
                    renderNotificationList();
                }
            }

            // Show toast notification
            function showToastNotification(message, type = 'info') {
                const toastId = Date.now();
                const toast = document.createElement('div');
                toast.className = `notification-toast ${type}`;
                toast.dataset.id = toastId;
                
                const icon = getToastIcon(type);
                const title = getToastTitle(type);
                
                toast.innerHTML = `
                    <div class="toast-header">
                        <div class="toast-icon ${type}">
                            <i class="fas ${icon}"></i>
                        </div>
                        <div class="toast-title">${title}</div>
                        <button class="toast-close" onclick="removeToast(${toastId})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="toast-body">${message}</div>
                    <div class="toast-time">
                        <i class="far fa-clock"></i>
                        Baru saja
                    </div>
                    <div class="toast-progress">
                        <div class="toast-progress-bar"></div>
                    </div>
                `;
                
                toastContainer.appendChild(toast);
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    removeToast(toastId);
                }, 5000);
            }

            // Remove toast by ID
            window.removeToast = function(toastId) {
                const toast = document.querySelector(`.notification-toast[data-id="${toastId}"]`);
                if (toast) {
                    toast.style.animation = 'toastSlideOut 0.3s ease forwards';
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }
            };

            // Get toast icon based on type
            function getToastIcon(type) {
                const iconMap = {
                    'info': 'fa-info-circle',
                    'success': 'fa-check-circle',
                    'warning': 'fa-exclamation-triangle',
                    'danger': 'fa-exclamation-circle'
                };
                return iconMap[type] || 'fa-info-circle';
            }

            // Get toast title based on type
            function getToastTitle(type) {
                const titleMap = {
                    'info': 'Informasi',
                    'success': 'Berhasil',
                    'warning': 'Peringatan',
                    'danger': 'Error'
                };
                return titleMap[type] || 'Notifikasi';
            }

            // Simulate receiving new notifications
            function simulateNewNotification() {
                const notificationTypes = ['info', 'success', 'warning'];
                const notificationTitles = [
                    'Peminjaman Baru',
                    'Pengembalian',
                    'Jadwal Perkuliahan',
                    'Maintenance'
                ];
                const notificationMessages = [
                    'Ada peminjaman baru yang menunggu persetujuan',
                    'Item telah berhasil dikembalikan',
                    'Jadwal perkuliahan akan segera dimulai',
                    'Perangkat memerlukan pemeriksaan rutin'
                ];
                
                const randomType = notificationTypes[Math.floor(Math.random() * notificationTypes.length)];
                const randomTitle = notificationTitles[Math.floor(Math.random() * notificationTitles.length)];
                const randomMessage = notificationMessages[Math.floor(Math.random() * notificationMessages.length)];
                
                const newNotification = {
                    id: Date.now(),
                    title: randomTitle,
                    message: randomMessage,
                    type: randomType,
                    icon: randomType === 'success' ? 'fa-check-circle' : 'fa-bell',
                    time: 'Baru saja',
                    read: false,
                    actions: []
                };
                
                notifications.unshift(newNotification);
                updateNotificationBadge();
                renderNotificationList();
                
                // Show toast notification
                showToastNotification(randomMessage, randomType);
            }

            // Event listeners
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', markAllAsRead);
            }
            
            if (clearNotificationsBtn) {
                clearNotificationsBtn.addEventListener('click', clearAllNotifications);
            }
            
            if (viewAllNotificationsBtn) {
                viewAllNotificationsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    showToastNotification('Membuka semua notifikasi...', 'info');
                });
            }

            // Initialize notification system
            initNotificationSystem();

            // Simulate receiving notifications every 30 seconds (for demo)
            setInterval(() => {
                if (Math.random() > 0.7) { // 30% chance
                    simulateNewNotification();
                }
            }, 30000);

            // Initial toast notification
            setTimeout(() => {
                showToastNotification('Sistem notifikasi telah aktif', 'success');
            }, 1000);
        });

        // Save all settings
        function saveAllSettings() {
            const settings = {
                twoFactorAuth: document.getElementById('two-factor-auth')?.checked || false,
                themeColor: document.getElementById('theme-color').value,
                fontSize: document.getElementById('font-size').value,
                pageAnimations: document.getElementById('page-animations')?.checked || false
            };

            console.log('Saving settings:', settings);
            
            showToastNotification('Pengaturan berhasil disimpan!', 'success');
        }

        // Show notification (legacy function)
        function showNotification(message, type = 'success') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.fixed-notification');
            existingNotifications.forEach(notification => notification.remove());
            
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} fixed-notification`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                ${message}
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Confirm reset settings
        function confirmResetSettings() {
            if (confirm('Apakah Anda yakin ingin mereset semua pengaturan ke default? Tindakan ini tidak dapat dibatalkan.')) {
                // Reset all form elements to default
                document.getElementById('email-notifications').checked = true;
                document.getElementById('new-loan-notifications').checked = true;
                document.getElementById('return-notifications').checked = true;
                if (document.getElementById('schedule-notifications')) {
                    document.getElementById('schedule-notifications').checked = true;
                }
                document.getElementById('notification-frequency').value = 'realtime';
                
                showToastNotification('Semua pengaturan telah direset ke nilai default.', 'success');
            }
        }
    </script>
</body>
</html>