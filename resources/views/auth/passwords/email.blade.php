<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - Sistem Peminjaman</title>

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
            --info-color: #3b82f6;
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
        
        .forgot-container {
            max-width: 420px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .forgot-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(59, 89, 152, 0.3);
            padding: 35px 30px;
            overflow: hidden;
            position: relative;
            border: none;
        }
        
        .forgot-card::before {
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
        
        .header-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #f0f7ff 0%, #e3eeff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-color);
            font-size: 1.8rem;
            border: 2px solid rgba(59, 89, 152, 0.1);
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
        
        .alert {
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: none;
            animation: slideIn 0.3s ease-out;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            color: #065f46;
            border-left: 4px solid var(--success-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-success i {
            font-size: 1.1rem;
            color: var(--success-color);
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
            margin-bottom: 25px;
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
        
        .email-hint {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: -20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .email-hint i {
            color: var(--info-color);
            font-size: 0.9rem;
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
            margin: 5px 0 25px;
            font-size: 1rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-reset:hover {
            background: linear-gradient(135deg, var(--primary-hover) 0%, #3a5ca0 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 89, 152, 0.3);
        }
        
        .btn-reset:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none !important;
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
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        /* Instructions Box */
        .instructions {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            border-left: 4px solid var(--info-color);
        }
        
        .instructions-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .instructions-list {
            font-size: 0.8rem;
            color: #4b5563;
            margin-bottom: 0;
            padding-left: 20px;
        }
        
        .instructions-list li {
            margin-bottom: 4px;
        }
        
        .instructions-list li:last-child {
            margin-bottom: 0;
        }
        
        /* Fallback jika gambar tidak load */
        .no-background {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .forgot-card {
                padding: 25px 20px;
            }
            
            .header-title {
                font-size: 1.3rem;
            }
            
            .header-subtitle {
                font-size: 0.85rem;
            }
            
            .header-icon {
                width: 56px;
                height: 56px;
                font-size: 1.5rem;
            }
            
            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="forgot-container">
        <div class="forgot-card">
            <!-- Header Section -->
            <div class="header-container">
                <div class="header-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h1 class="header-title">Lupa Password</h1>
                <p class="header-subtitle">Masukkan email Anda untuk menerima link reset password</p>
            </div>

            <!-- Instructions -->
            <div class="instructions">
                <div class="instructions-title">
                    <i class="fas fa-info-circle"></i> Petunjuk Reset Password
                </div>
                <ul class="instructions-list">
                    <li>Masukkan email POLITALA Anda yang terdaftar</li>
                    <li>Link reset password akan dikirim ke email Anda</li>
                    <li>Link berlaku selama 60 menit</li>
                    <li>Periksa folder spam jika email tidak ditemukan</li>
                </ul>
            </div>

            <!-- Success Message -->
            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

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

            <!-- Form Lupa Password -->
            <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
                @csrf

                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" 
                           value="{{ old('email') }}" 
                           placeholder="email@politala.ac.id" 
                           required autofocus>
                    <div class="email-hint">
                        <i class="fas fa-info-circle"></i> Gunakan email POLITALA yang terdaftar
                    </div>
                </div>

                <button type="submit" class="btn-reset" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> Kirim Link Reset
                </button>
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
            const form = document.querySelector('#forgotForm');
            const emailInput = document.querySelector('#email');
            const submitBtn = document.querySelector('#submitBtn');
            const originalBtnText = submitBtn.innerHTML;
            
            // Form submission handler
            form.addEventListener('submit', function(e) {
                const email = emailInput.value.trim();
                
                // Validate POLITALA email
                if (!email.endsWith('@politala.ac.id') && !email.endsWith('@mhs.politala.ac.id')) {
                    e.preventDefault();
                    
                    // Show error message
                    showEmailError('Harap gunakan email POLITALA yang valid (@politala.ac.id atau @mhs.politala.ac.id)');
                    
                    // Add shake animation
                    emailInput.classList.add('shake');
                    setTimeout(() => {
                        emailInput.classList.remove('shake');
                    }, 500);
                    
                    // Focus on email input
                    emailInput.focus();
                    return false;
                }
                
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim link...';
            });
            
            // Function to show email error
            function showEmailError(message) {
                // Remove existing error alert
                const existingAlert = document.querySelector('.alert-email-error');
                if (existingAlert) {
                    existingAlert.remove();
                }
                
                // Create error alert
                const errorAlert = document.createElement('div');
                errorAlert.className = 'alert alert-danger alert-email-error';
                errorAlert.innerHTML = `
                    <ul class="mb-0">
                        <li>${message}</li>
                    </ul>
                `;
                
                // Insert after instructions or before form
                const instructions = document.querySelector('.instructions');
                if (instructions) {
                    instructions.insertAdjacentElement('afterend', errorAlert);
                } else {
                    const form = document.querySelector('form');
                    form.insertAdjacentElement('beforebegin', errorAlert);
                }
                
                // Remove error alert after 5 seconds
                setTimeout(() => {
                    if (errorAlert.parentNode) {
                        errorAlert.remove();
                    }
                }, 5000);
            }
            
            // Real-time email validation
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                
                if (email && !email.endsWith('@politala.ac.id') && !email.endsWith('@mhs.politala.ac.id')) {
                    this.classList.add('is-invalid');
                    showEmailError('Format email harus @politala.ac.id atau @mhs.politala.ac.id');
                } else {
                    this.classList.remove('is-invalid');
                    
                    // Remove error alert
                    const errorAlert = document.querySelector('.alert-email-error');
                    if (errorAlert) {
                        errorAlert.remove();
                    }
                }
            });
            
            // Reset button state if form fails to submit
            form.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && submitBtn.disabled) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
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
            
            // Success message animation
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                successAlert.classList.add('pulse');
                
                // Remove animation after 3 seconds
                setTimeout(() => {
                    successAlert.classList.remove('pulse');
                }, 3000);
            }
        });
    </script>
</body>
</html>