<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman</title>

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
        }
        
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url("{{ asset('img/Gedung_TI.JPG') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            margin: 0;
        }
        
        .login-container {
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 6px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 25px 20px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color) 0%, #2e8de6 100%);
        }
        
        .header-container {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .header-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.2;
        }
        
        .header-subtitle {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0;
            line-height: 1.3;
        }
        
        .login-form-container {
            padding: 0;
        }
        
        .btn-google {
            background-color: white;
            color: #757575;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            width: 100%;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            font-size: 0.85rem;
        }
        
        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .google-icon {
            display: flex;
            align-items: center;
        }
        
        .google-icon-circle {
            width: 16px;
            height: 16px;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 15px 0;
            color: #6c757d;
            font-size: 0.8rem;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        
        .divider::before {
            margin-right: 10px;
        }
        
        .divider::after {
            margin-left: 10px;
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
            font-size: 0.85rem;
        }
        
        .form-control {
            padding: 10px 12px;
            border-radius: 4px;
            margin-bottom: 12px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.15);
            border-color: var(--primary-color);
            background: white;
        }
        
        .password-container {
            position: relative;
            margin-bottom: 5px;
        }
        
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 3px;
            transition: all 0.2s;
            font-size: 0.8rem;
        }
        
        .toggle-password:hover {
            background-color: #f8f9fa;
            color: #495057;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0 15px;
        }
        
        .form-check {
            margin-bottom: 0;
        }
        
        .form-check-input {
            width: 14px;
            height: 14px;
            margin-right: 6px;
            margin-top: 0.1em;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check-label {
            font-size: 0.8rem;
            color: #495057;
            user-select: none;
        }
        
        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.2s;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 10px;
            font-weight: 600;
            border-radius: 4px;
            color: white;
            width: 100%;
            transition: all 0.3s;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(13, 110, 253, 0.3);
        }
        
        .signup-link {
            text-align: center;
            margin-top: 10px;
            color: #6c757d;
            font-size: 0.8rem;
        }
        
        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .signup-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Fallback jika gambar tidak load */
        .no-background {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                padding: 20px 15px;
            }
            
            .header-title {
                font-size: 1.2rem;
            }
            
            .header-subtitle {
                font-size: 0.8rem;
            }
            
            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Header Section -->
            <div class="header-container">
                <h1 class="header-title">Masuk ke Akun Anda</h1>
                <p class="header-subtitle">Silahkan masuk menggunakan email POLITALA untuk melanjutkan ke sistem peminjaman</p>
            </div>

            <div class="login-form-container">
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
                    Google
                </a>

                <!-- Divider -->
                <div class="divider">atau lanjutkan dengan -</div>

                <!-- Form Login -->
                <form method="POST" action="/login">
                    @csrf

                    {{-- Display Validation Errors --}}
                    @error('email')
                        <div class="alert alert-danger mb-2 p-2" style="font-size: 0.8rem;" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Password</label>
                        <div class="password-container">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <a href="/forgot-password" class="forgot-link">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn-login">Masuk</button>
                </form>
                
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
            
            // Fallback jika gambar tidak load
            const body = document.querySelector('body');
            const img = new Image();
            img.src = "{{ asset('img/Gedung_TI.JPG') }}";
            img.onerror = function() {
                body.classList.add('no-background');
                console.log('Background image failed to load, using fallback gradient');
            };
            img.onload = function() {
                console.log('Background image loaded successfully');
            };
        });
    </script>
</body>
</html>