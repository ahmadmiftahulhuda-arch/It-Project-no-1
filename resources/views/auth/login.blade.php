<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Booking Fasilitas & Infrastruktur Departemen IT</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-hover: #0b5ed7;
            --google-blue: #4285F4;
            --google-red: #EA4335;
            --google-yellow: #FBBC05;
            --google-green: #34A853;
            --politala-blue: #0d6efd;
            --politala-gold: #FFD700;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        
        .login-container {
            max-width: 450px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            overflow: hidden;
            position: relative;
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--politala-blue) 0%, var(--politala-gold) 100%);
        }
        
        .header-container {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            padding: 15px;
            background: linear-gradient(45deg, var(--politala-blue) 0%, #2e8de6 100%);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            font-weight: bold;
        }
        
        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.3;
        }
        
        .header-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .login-form-container {
            padding: 0 10px;
        }
        
        h2 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
            text-align: center;
        }
        
        .intro-text {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .btn-google {
            background-color: white;
            color: #757575;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .google-icon {
            display: flex;
            align-items: center;
        }
        
        .google-icon-circle {
            width: 18px;
            height: 18px;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        
        .divider::before {
            margin-right: 15px;
        }
        
        .divider::after {
            margin-left: 15px;
        }
        
        .form-control {
            padding: 14px 16px;
            border-radius: 6px;
            margin-bottom: 18px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
            border-color: var(--primary-color);
        }
        
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check-label {
            font-size: 0.9rem;
            color: #495057;
            user-select: none;
        }
        
        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .forgot-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 14px;
            font-weight: 600;
            border-radius: 6px;
            color: white;
            width: 100%;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }
        
        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .signup-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .info-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            border-left: 4px solid var(--primary-color);
        }
        
        .info-box p {
            margin-bottom: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .info-box i {
            color: var(--primary-color);
            margin-right: 8px;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                padding: 25px 20px;
            }
            
            .header-title {
                font-size: 1.3rem;
            }
            
            .header-subtitle {
                font-size: 0.9rem;
            }
            
            h2 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Header Section -->
            <div class="header-container">
                <div class="logo-container">
                    <div class="logo">IT</div>
                </div>
                <h1 class="header-title">Masuk ke Akun Anda</h1>
                <p class="header-subtitle">Gunakan email POLITALA Anda untuk mengakses sistem peminjaman</p>
            </div>

                <!-- Tombol Google -->
                <a href="{{ route('google.login') }}" class="btn btn-google">
                    <span class="google-icon">
                        <svg class="google-icon-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                        </svg>
                    </span>
                    Masuk dengan Google
                </a>

                <!-- Divider -->
                <div class="divider">atau dengan email</div>

                <!-- Form Login -->
                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email POLITALA (contoh: user@politala.ac.id)" required>
                    </div>

                    <div class="mb-3 password-container">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Kata sandi" required>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <a href="/forgot-password" class="forgot-link">Lupa kata sandi?</a>
                    </div>

                    <button type="submit" class="btn-login">Masuk</button>
                </form>
                
                <div class="info-box">
                    <p><i class="fas fa-info-circle"></i> Jika mengalami kendala login, hubungi admin IT di lab.infopoli@gmail.com</p>
                </div>
                
                <div class="signup-link">
                    Belum punya akun? <a href="#">Hubungi administrator</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            
            // Toggle password visibility
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle icon
                if (type === 'password') {
                    this.innerHTML = '<i class="far fa-eye"></i>';
                } else {
                    this.innerHTML = '<i class="far fa-eye-slash"></i>';
                }
            });
            
            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const email = document.querySelector('input[name="email"]').value;
                
                if (!email.endsWith('@politala.ac.id')) {
                    e.preventDefault();
                    alert('Harap gunakan email POLITALA yang valid (@politala.ac.id)');
                }
            });
        });
    </script>
</body>
</html>