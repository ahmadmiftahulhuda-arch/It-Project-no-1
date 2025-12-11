<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dua Faktor - Admin POLITALA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #3b5998;
            --primary-hover: #344e86;
            --accent-color: #4c70ba;
            --admin-accent: #8b0000;
            --admin-hover: #a00000;
            --error-color: #dc3545;
            --success-color: #198754;
            --info-color: #0d6efd;
        }
        
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
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
        
        .verification-container {
            max-width: 450px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .verification-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(139, 0, 0, 0.25);
            padding: 35px;
            overflow: hidden;
            position: relative;
            border: none;
        }
        
        .verification-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--admin-accent) 0%, #b22222 100%);
            border-radius: 12px 12px 0 0;
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--admin-accent);
            margin-bottom: 8px;
            text-align: center;
        }
        
        .card-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 25px;
            text-align: center;
            line-height: 1.4;
        }
        
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: rgba(139, 0, 0, 0.1);
            color: var(--admin-accent);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .authenticator-icon {
            font-size: 1.2rem;
            color: var(--admin-accent);
            margin-bottom: 15px;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .form-control {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 5px;
            border: 1px solid #d1d5db;
            transition: all 0.3s;
            font-size: 1.1rem;
            background: white;
            text-align: center;
            letter-spacing: 3px;
            font-weight: 600;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.15);
            border-color: var(--admin-accent);
            background: white;
        }
        
        .form-control.is-invalid {
            border-color: var(--error-color);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
            border-color: var(--error-color);
        }
        
        .btn-verify {
            background: linear-gradient(135deg, var(--admin-accent) 0%, #b22222 100%);
            border: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 8px;
            color: white;
            width: 100%;
            transition: all 0.3s;
            margin-bottom: 20px;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }
        
        .btn-verify:hover {
            background: linear-gradient(135deg, var(--admin-hover) 0%, #c22e2e 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(139, 0, 0, 0.3);
        }
        
        .btn-verify:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        
        .alert {
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            font-size: 0.9rem;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }
        
        .alert-success {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
            border-left: 4px solid #198754;
        }
        
        .alert-info {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            border-left: 4px solid #0d6efd;
        }
        
        .back-link {
            text-align: center;
            margin-top: 15px;
            color: #6b7280;
            font-size: 0.85rem;
            padding-top: 15px;
            border-top: 1px solid #f3f4f6;
        }
        
        .back-link a {
            color: var(--admin-accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .back-link a:hover {
            color: var(--admin-hover);
            text-decoration: underline;
        }
        
        .verification-footer {
            text-align: center;
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 10px;
        }
        
        /* Timer styling */
        .timer-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .timer {
            font-weight: 700;
            color: var(--admin-accent);
            font-size: 1.1rem;
        }
        
        /* OTP input instructions */
        .otp-instructions {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            color: #6b7280;
        }
        
        /* Resend OTP link */
        .resend-link {
            text-align: center;
            margin-top: 15px;
            font-size: 0.85rem;
        }
        
        .resend-link a {
            color: var(--admin-accent);
            text-decoration: none;
            font-weight: 600;
        }
        
        .resend-link a:hover {
            text-decoration: underline;
        }
        
        .resend-link a.disabled {
            color: #adb5bd;
            cursor: not-allowed;
            text-decoration: none;
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
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        .pulse {
            animation: pulse 1s infinite;
        }
        
        /* Fallback jika gambar tidak load */
        .no-background {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .verification-card {
                padding: 25px 20px;
            }
            
            .card-title {
                font-size: 1.3rem;
            }
            
            .card-subtitle {
                font-size: 0.85rem;
            }
            
            body {
                padding: 10px;
            }
            
            .form-control {
                font-size: 1rem;
                padding: 12px 14px;
            }
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <div class="verification-card">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <div class="security-badge">
                    <i class="fas fa-shield-alt"></i>
                    Keamanan Dua Lapis
                </div>
                
                <div class="authenticator-icon">
                    <i class="fas fa-mobile-alt fa-2x"></i>
                </div>
                
                <h3 class="card-title">Verifikasi Dua Faktor</h3>
                <p class="card-subtitle">
                    Buka aplikasi authenticator Anda<br>
                    Masukkan kode verifikasi 6 digit untuk melanjutkan
                </p>
            </div>

            <!-- Timer (Optional) -->
            <div class="timer-container">
                <i class="far fa-clock"></i>
                <span>Kode berlaku selama:</span>
                <span class="timer" id="countdown">30</span>
                <span>detik</span>
            </div>

            <!-- Instructions -->
            <div class="otp-instructions">
                <small>
                    <i class="fas fa-info-circle me-1"></i>
                    Masukkan kode 6 digit dari aplikasi Google Authenticator, Authy, atau Microsoft Authenticator
                </small>
            </div>

            <!-- Error/Success Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('status'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Verification Form -->
            <form method="POST" action="{{ route('admin.2fa.verify') }}" id="verificationForm">
                @csrf
                
                <!-- OTP Field -->
                <div class="mb-4">
                    <label for="otp" class="form-label">Kode Verifikasi</label>
                    <input id="otp" type="text" 
                           class="form-control @error('otp') is-invalid @enderror" 
                           name="otp" 
                           required 
                           autofocus 
                           autocomplete="one-time-code" 
                           inputmode="numeric" 
                           pattern="[0-9]{6}"
                           maxlength="6"
                           placeholder="000000">
                    
                    @error('otp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn-verify" id="submitBtn">
                        <i class="fas fa-check-circle me-2"></i>
                        <span id="btnText">Verifikasi</span>
                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

            <!-- Alternative Actions -->
            <div class="back-link">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-1"></i> Bukan Anda? Kembali ke Login
                </a>
            </div>

            <!-- Hidden Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <div class="verification-footer">
                &copy; {{ date('Y') }} POLITALA - Sistem Peminjaman
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const otpInput = document.querySelector('#otp');
            const form = document.querySelector('#verificationForm');
            const submitBtn = document.querySelector('#submitBtn');
            const btnText = document.querySelector('#btnText');
            const btnSpinner = document.querySelector('#btnSpinner');
            const resendLink = document.querySelector('#resendLink');
            const countdownElement = document.querySelector('#countdown');
            
            // 1. Auto-focus on OTP input
            if (otpInput) {
                otpInput.focus();
                
                // Auto-tab between digits (optional enhancement)
                otpInput.addEventListener('input', function() {
                    if (this.value.length === 6) {
                        this.blur();
                        submitBtn.focus();
                    }
                });
                
                // Validate OTP format on blur
                otpInput.addEventListener('blur', function() {
                    const otp = this.value.trim();
                    if (otp && !/^\d{6}$/.test(otp)) {
                        this.classList.add('is-invalid');
                        const errorDiv = this.parentNode.querySelector('.otp-error');
                        if (!errorDiv) {
                            const newError = document.createElement('div');
                            newError.className = 'invalid-feedback otp-error';
                            newError.innerHTML = 'Kode harus terdiri dari 6 digit angka';
                            this.parentNode.appendChild(newError);
                        }
                    } else if (this.classList.contains('is-invalid')) {
                        this.classList.remove('is-invalid');
                        const errorDiv = this.parentNode.querySelector('.otp-error');
                        if (errorDiv) {
                            errorDiv.remove();
                        }
                    }
                });
            }
            
            // 2. Form submission with validation
            if (form) {
                form.addEventListener('submit', function(e) {
                    const otp = otpInput ? otpInput.value.trim() : '';
                    
                    // OTP validation
                    if (!/^\d{6}$/.test(otp)) {
                        e.preventDefault();
                        
                        // Show error
                        let errorDiv = otpInput.parentNode.querySelector('.otp-error');
                        if (!errorDiv) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback otp-error';
                            errorDiv.innerHTML = 'Kode harus terdiri dari 6 digit angka';
                            otpInput.parentNode.appendChild(errorDiv);
                        }
                        
                        otpInput.classList.add('is-invalid');
                        otpInput.focus();
                        
                        // Shake animation for error
                        form.classList.add('shake');
                        setTimeout(() => {
                            form.classList.remove('shake');
                        }, 500);
                        
                        return false;
                    }
                    
                    // Show loading state
                    if (submitBtn && btnText && btnSpinner) {
                        submitBtn.disabled = true;
                        btnText.textContent = 'Memverifikasi...';
                        btnSpinner.classList.remove('d-none');
                    }
                    
                    // Allow form submission
                    return true;
                });
            }
            
            // 3. Countdown timer
            let timeLeft = 30;
            let countdownInterval;
            
            function startCountdown() {
                clearInterval(countdownInterval);
                timeLeft = 30;
                countdownElement.textContent = timeLeft;
                resendLink.classList.add('disabled');
                resendLink.style.pointerEvents = 'none';
                
                countdownInterval = setInterval(() => {
                    timeLeft--;
                    countdownElement.textContent = timeLeft;
                    
                    if (timeLeft <= 0) {
                        clearInterval(countdownInterval);
                        resendLink.classList.remove('disabled');
                        resendLink.style.pointerEvents = 'auto';
                        countdownElement.textContent = '0';
                    }
                }, 1000);
            }
            
            // Start countdown on page load
            startCountdown();
            
            // 4. Resend OTP functionality
            if (resendLink) {
                resendLink.addEventListener('click', function(e) {
                    if (this.classList.contains('disabled')) {
                        e.preventDefault();
                        return;
                    }
                    
                    // Show loading on resend
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';
                    
                    // Simulate API call
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        startCountdown();
                        
                        // Show success message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success mt-3';
                        alertDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i> Kode baru telah dikirim!';
                        form.parentNode.insertBefore(alertDiv, form);
                        
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 3000);
                    }, 1500);
                });
            }
            
            // 5. Background image fallback
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
            
            // 6. Auto-submit when 6 digits entered
            if (otpInput) {
                otpInput.addEventListener('input', function() {
                    if (this.value.length === 6 && /^\d{6}$/.test(this.value)) {
                        // Optional: auto-submit
                        // form.submit();
                    }
                });
            }
            
            // 7. Remove error on input
            if (otpInput) {
                otpInput.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        this.classList.remove('is-invalid');
                        const errorDiv = this.parentNode.querySelector('.invalid-feedback');
                        if (errorDiv) {
                            errorDiv.remove();
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>