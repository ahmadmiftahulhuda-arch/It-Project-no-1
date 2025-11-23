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
            --primary-color: #3b5998;
            --primary-hover: #344e86;
            --accent-color: #4c70ba;
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
            overflow: hidden; /* Menghilangkan scroll */
        }
        
        .login-container {
            max-width: 420px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(59, 89, 152, 0.3);
            padding: 30px;
            overflow: hidden;
            position: relative;
            border: none;
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border-radius: 12px 12px 0 0;
        }
        
        .header-container {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.2;
        }
        
        .header-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 0;
            line-height: 1.4;
        }
        
        .login-form-container {
            padding: 0;
        }
        
        .btn-google {
            background-color: white;
            color: #4b5563;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            font-size: 0.9rem;
        }
        
        .btn-google:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
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
            margin: 20px 0;
            color: #9ca3af;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .divider::before {
            margin-right: 12px;
        }
        
        .divider::after {
            margin-left: 12px;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .form-control {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #d1d5db;
            transition: all 0.3s;
            font-size: 0.9rem;
            background: white;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.15);
            border-color: var(--accent-color);
            background: white;
        }
        
        .password-container {
            position: relative;
            margin-bottom: 5px;
        }
        
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        
        .toggle-password:hover {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0 20px;
        }
        
        .form-check {
            margin-bottom: 0;
        }
        
        .form-check-input {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            margin-top: 0.1em;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.25);
        }
        
        .form-check-label {
            font-size: 0.85rem;
            color: #4b5563;
            user-select: none;
        }
        
        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
            font-weight: 600;
        }
        
        .forgot-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 8px;
            color: white;
            width: 100%;
            transition: all 0.3s;
            margin-bottom: 20px;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, var(--primary-hover) 0%, #3a5ca0 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 89, 152, 0.3);
        }
        
        .signup-link {
            text-align: center;
            margin-top: 15px;
            color: #6b7280;
            font-size: 0.85rem;
            padding-top: 15px;
            border-top: 1px solid #f3f4f6;
        }
        
        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
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
                padding: 25px 20px;
            }
            
            .header-title {
                font-size: 1.3rem;
            }
            
            .header-subtitle {
                font-size: 0.85rem;
            }
            
            body {
                padding: 10px;
                overflow: auto; /* Mengizinkan scroll hanya di mobile jika diperlukan */
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
                    Masuk dengan Google
                </a>

                <!-- Divider -->
                <div class="divider">atau lanjutkan dengan email</div>

                <!-- Form Login -->
                <form method="POST" action="/login">
                    @csrf

                    {{-- Display Validation Errors --}}
                    @error('email')
                        <div class="alert alert-danger mb-2 p-2" style="font-size: 0.8rem; border-radius: 6px;" role="alert">
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
                    Belum punya akun? Gunakan opsi <a href="{{ route('google.login') }}">Masuk dengan Google</a>.
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

            // Mencegah scroll dengan wheel/touch
            document.body.addEventListener('wheel', preventScroll, { passive: false });
            document.body.addEventListener('touchmove', preventScroll, { passive: false });
            
            function preventScroll(e) {
                e.preventDefault();
                return false;
            }
        });
    </script>
</body>
</html>