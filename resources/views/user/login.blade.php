<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman Sarana Prasarana</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #6d84b4;
            --accent-color: #4c6baf;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        
        .login-card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .login-header h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .login-body {
            padding: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-right: none;
            border-radius: 5px 0 0 5px;
        }
        
        .form-control {
            border-left: none;
            border-radius: 0 5px 5px 0;
            padding-left: 5px;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }
        
        .form-control:focus + .input-group-append .input-group-text {
            border-color: #80bdff;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .login-footer p {
            margin-bottom: 10px;
            color: #6c757d;
        }
        
        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        
        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        /* Animations */
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
        
        .login-card {
            animation: fadeIn 0.5s ease;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                box-shadow: none;
            }
            
            body {
                padding: 15px;
                background: white;
            }
            
            .login-header {
                border-radius: 10px 10px 0 0;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1><i class="fas fa-building"></i> SarPras TI</h1>
                <p>Sistem Peminjaman Sarana Prasarana</p>
            </div>
            
            <div class="login-body">
                <div class="alert alert-danger" id="errorMessage">
                    <i class="fas fa-exclamation-circle"></i> <span id="errorText">Username atau password salah</span>
                </div>
                
                <form id="loginForm">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan username" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password" required>
                            <span class="password-toggle" id="passwordToggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </button>
                </form>
                
                <div class="login-footer">
                    <a href="#" class="forgot-password">Lupa password?</a>
                    <p>Belum punya akun? <a href="#" class="forgot-password">Hubungi administrator</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const errorMessage = document.getElementById('errorMessage');
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');
            
            // Toggle password visibility
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
            
            // Form submission
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                
                // Simple validation
                if (!username || !password) {
                    showError('Harap isi username dan password');
                    return;
                }
                
                // Simulate login process
                simulateLogin(username, password);
            });
            
            function simulateLogin(username, password) {
                // Show loading state
                const loginBtn = loginForm.querySelector('button[type="submit"]');
                const originalText = loginBtn.innerHTML;
                loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                loginBtn.disabled = true;
                
                // Simulate API call delay
                setTimeout(function() {
                    // For demo purposes - check for specific credentials
                    if (username === 'admin' && password === 'admin123') {
                        // Successful login - redirect to dashboard
                        window.location.href = '/dashboard';
                    } else if (username === 'user' && password === 'user123') {
                        // Successful login - redirect to dashboard
                        window.location.href = '/dashboard';
                    } else if (username === 'diana' && password === 'diana123') {
                        // Successful login - redirect to dashboard
                        window.location.href = '/dashboard';
                    } else {
                        // Show error message
                        showError('Username atau password salah');
                    }
                    
                    // Reset button
                    loginBtn.innerHTML = originalText;
                    loginBtn.disabled = false;
                }, 1500);
            }
            
            function showError(message) {
                document.getElementById('errorText').textContent = message;
                errorMessage.style.display = 'block';
                
                // Hide error after 5 seconds
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 5000);
            }
            
            // Check if there's a redirect message in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('redirect') === 'true') {
                showError('Harap login terlebih dahulu untuk mengakses halaman tersebut');
            }
        });
    </script>
</body>
</html>