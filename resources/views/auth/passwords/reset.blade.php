<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Sistem Peminjaman</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #3b5998;
            --primary-hover: #344e86;
            --accent-color: #4c70ba;
            --success-color: #10b981;
            --danger-color: #ef4444;
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
        
        .reset-container {
            max-width: 480px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .reset-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(59, 89, 152, 0.3);
            padding: 35px 30px;
            overflow: hidden;
            position: relative;
            border: none;
        }
        
        .reset-card::before {
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
            font-size: 1.6rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
            line-height: 1.2;
        }
        
        .header-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 0;
            line-height: 1.4;
        }
        
        .alert {
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: none;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }
        
        .alert-danger ul {
            margin-bottom: 0;
            padding-left: 18px;
        }
        
        .alert-danger li {
            margin-bottom: 4px;
        }
        
        .alert-danger li:last-child {
            margin-bottom: 0;
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
            margin-bottom: 20px;
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
        
        .password-strength {
            margin-top: -15px;
            margin-bottom: 15px;
            font-size: 0.8rem;
        }
        
        .strength-bar {
            height: 4px;
            background-color: #e5e7eb;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            width: 0%;
            background-color: var(--danger-color);
            transition: all 0.3s;
        }
        
        .strength-fill.weak {
            width: 30%;
            background-color: var(--danger-color);
        }
        
        .strength-fill.medium {
            width: 60%;
            background-color: #f59e0b;
        }
        
        .strength-fill.strong {
            width: 100%;
            background-color: var(--success-color);
        }
        
        .strength-text {
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .btn-reset {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 8px;
            color: white;
            width: 100%;
            transition: all 0.3s;
            margin: 10px 0 25px;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }
        
        .btn-reset:hover {
            background: linear-gradient(135deg, var(--primary-hover) 0%, #3a5ca0 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 89, 152, 0.3);
        }
        
        .login-link-container {
            text-align: center;
            margin-top: 15px;
            color: #6b7280;
            font-size: 0.85rem;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
        }
        
        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .login-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .login-link i {
            font-size: 0.8rem;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        /* Fallback jika gambar tidak load */
        .no-background {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .reset-card {
                padding: 25px 20px;
            }
            
            .header-title {
                font-size: 1.4rem;
            }
            
            .header-subtitle {
                font-size: 0.85rem;
            }
            
            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="reset-container">
        <div class="reset-card">
            <!-- Header Section -->
            <div class="header-container">
                <h1 class="header-title">Reset Password</h1>
                <p class="header-subtitle">Masukkan password baru Anda untuk mengakses sistem peminjaman</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Reset Password -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" 
                           value="{{ $email ?? old('email') }}" 
                           placeholder="email@politala.ac.id" 
                           required autofocus>
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">Password Baru</label>
                    <div class="password-container">
                        <input id="password" type="password" class="form-control" 
                               name="password" placeholder="Masukkan password baru" required>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-text" id="strengthText">Kekuatan password: -</div>
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="password-container">
                        <input id="password_confirmation" type="password" class="form-control" 
                               name="password_confirmation" placeholder="Konfirmasi password baru" required>
                        <button type="button" class="toggle-password" id="togglePasswordConfirmation">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="mt-2" id="passwordMatchMessage" style="font-size: 0.8rem;"></div>
                </div>

                <button type="submit" class="btn-reset">Reset Password</button>
            </form>

            <div class="login-link-container">
                <a href="{{ route('login') }}" class="login-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const togglePassword = document.querySelector('#togglePassword');
            const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
            const password = document.querySelector('#password');
            const passwordConfirmation = document.querySelector('#password_confirmation');
            const strengthFill = document.querySelector('#strengthFill');
            const strengthText = document.querySelector('#strengthText');
            const passwordMatchMessage = document.querySelector('#passwordMatchMessage');
            
            // Toggle password visibility for new password
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                if (type === 'password') {
                    this.innerHTML = '<i class="far fa-eye"></i>';
                } else {
                    this.innerHTML = '<i class="far fa-eye-slash"></i>';
                }
            });
            
            // Toggle password visibility for confirmation
            togglePasswordConfirmation.addEventListener('click', function() {
                const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmation.setAttribute('type', type);
                
                if (type === 'password') {
                    this.innerHTML = '<i class="far fa-eye"></i>';
                } else {
                    this.innerHTML = '<i class="far fa-eye-slash"></i>';
                }
            });
            
            // Password strength checker
            password.addEventListener('input', function() {
                const pass = this.value;
                let strength = 0;
                let text = 'Kekuatan password: ';
                
                // Check length
                if (pass.length >= 8) strength += 1;
                if (pass.length >= 12) strength += 1;
                
                // Check for lowercase, uppercase, numbers, special chars
                if (/[a-z]/.test(pass)) strength += 1;
                if (/[A-Z]/.test(pass)) strength += 1;
                if (/[0-9]/.test(pass)) strength += 1;
                if (/[^A-Za-z0-9]/.test(pass)) strength += 1;
                
                // Update strength bar and text
                if (pass.length === 0) {
                    strengthFill.className = 'strength-fill';
                    strengthFill.style.width = '0%';
                    strengthText.textContent = 'Kekuatan password: -';
                } else if (strength <= 2) {
                    strengthFill.className = 'strength-fill weak';
                    strengthText.textContent = 'Kekuatan password: Lemah';
                } else if (strength <= 4) {
                    strengthFill.className = 'strength-fill medium';
                    strengthText.textContent = 'Kekuatan password: Sedang';
                } else {
                    strengthFill.className = 'strength-fill strong';
                    strengthText.textContent = 'Kekuatan password: Kuat';
                }
            });
            
            // Password confirmation match checker
            function checkPasswordMatch() {
                if (password.value && passwordConfirmation.value) {
                    if (password.value === passwordConfirmation.value) {
                        passwordMatchMessage.innerHTML = '<span style="color: #10b981;"><i class="fas fa-check-circle"></i> Password cocok</span>';
                        passwordConfirmation.classList.remove('is-invalid');
                        passwordConfirmation.classList.add('is-valid');
                    } else {
                        passwordMatchMessage.innerHTML = '<span style="color: #ef4444;"><i class="fas fa-times-circle"></i> Password tidak cocok</span>';
                        passwordConfirmation.classList.remove('is-valid');
                        passwordConfirmation.classList.add('is-invalid');
                    }
                } else {
                    passwordMatchMessage.innerHTML = '';
                    passwordConfirmation.classList.remove('is-valid', 'is-invalid');
                }
            }
            
            password.addEventListener('input', checkPasswordMatch);
            passwordConfirmation.addEventListener('input', checkPasswordMatch);
            
            // Form validation for POLITALA email
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const email = document.querySelector('#email').value;
                
                // Check for POLITALA email domain
                if (!email.endsWith('@politala.ac.id') && !email.endsWith('@mhs.politala.ac.id')) {
                    e.preventDefault();
                    alert('Harap gunakan email POLITALA yang valid (@politala.ac.id atau @mhs.politala.ac.id)');
                    document.querySelector('#email').classList.add('shake');
                    setTimeout(() => {
                        document.querySelector('#email').classList.remove('shake');
                    }, 500);
                }
                
                // Check password match
                if (password.value !== passwordConfirmation.value) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok');
                    passwordConfirmation.classList.add('shake');
                    setTimeout(() => {
                        passwordConfirmation.classList.remove('shake');
                    }, 500);
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
        });
    </script>
</body>
</html>