<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Lab TIK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --accent: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
            --info: #3498db;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --background: #f9f9f9;
            --sidebar: #2c3e50;
            --card: #ffffff;
            --text: #333333;
            --text-light: #777777;
            --border: #dddddd;
        }

        .dark-mode {
            --background: #1e272e;
            --sidebar: #1a2530;
            --card: #2d3436;
            --text: #f5f6fa;
            --text-light: #dcdde1;
            --border: #353b48;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            transition: all 0.3s ease;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background-color: var(--card);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(45deg, var(--primary), var(--info));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 28px;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
        }

        .login-header p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text);
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .input-with-icon input {
            padding-left: 45px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background-color: var(--background);
            color: var(--text);
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--info));
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .login-footer a {
            color: var(--primary);
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--card);
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: var(--accent);
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
            }
            
            .login-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="theme-toggle" id="theme-toggle">
        <i class="fas fa-moon"></i>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h1>Login Admin Lab TIK</h1>
                <p>Masuk untuk mengelola sistem peminjaman barang</p>
            </div>

            <form id="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" class="form-control" placeholder="Masukkan username" required>
                    </div>
                    <div class="error-message" id="username-error"></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <div class="error-message" id="password-error"></div>
                </div>

                <button type="submit" class="btn btn-primary">Masuk</button>
            </form>

            <div class="login-footer">
                <p>Lupa password? <a href="#">Reset di sini</a></p>
            </div>
        </div>
    </div>

    <script>
        // Toggle theme
        const themeToggle = document.getElementById('theme-toggle');
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
        
        // Terapkan dark mode jika sebelumnya diaktifkan
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }

        // Form validation and submission
        const loginForm = document.getElementById('login-form');
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const usernameError = document.getElementById('username-error');
            const passwordError = document.getElementById('password-error');
            
            // Reset error messages
            usernameError.style.display = 'none';
            passwordError.style.display = 'none';
            
            let isValid = true;
            
            // Simple validation
            if (!username) {
                usernameError.textContent = 'Username harus diisi';
                usernameError.style.display = 'block';
                isValid = false;
            }
            
            if (!password) {
                passwordError.textContent = 'Password harus diisi';
                passwordError.style.display = 'block';
                isValid = false;
            }
            
            if (isValid) {
                // Simulate login process
                const submitBtn = loginForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
                
                // In a real application, you would send an AJAX request to your server
                setTimeout(() => {
                    // For demo purposes, redirect to dashboard after 1.5 seconds
                    window.location.href = '/admin/dashboard';
                }, 1500);
            }
        });
    </script>
</body>
</html>