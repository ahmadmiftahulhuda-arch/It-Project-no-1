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
            --secondary-color: #6c757d;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 10px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        
        .login-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 35px 30px;
            max-width: 450px;
            width: 100%;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), #4e73df);
        }
        
        .login-card img {
            width: 90px;
            margin-bottom: 15px;
            transition: var(--transition);
        }
        
        .header-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 8px;
            line-height: 1.3;
        }
        
        .header-subtitle {
            font-size: 1rem;
            color: var(--secondary-color);
            margin-bottom: 25px;
        }
        
        .login-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark-color);
        }
        
        .login-subtitle {
            color: var(--secondary-color);
            font-size: 0.95rem;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        
        .btn-google {
            background-color: #fff;
            color: #444;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: var(--transition);
            width: 100%;
            margin-bottom: 15px;
        }
        
        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-google img {
            width: 20px;
            height: 20px;
            margin-bottom: 0;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: var(--secondary-color);
            font-size: 0.9rem;
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
            border: 1px solid #ddd;
            transition: var(--transition);
            font-size: 1rem;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }
        
        .form-control::placeholder {
            color: #9ca3af;
            font-size: 0.95rem;
        }
        
        .forgot-link {
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .forgot-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .form-check-label {
            font-size: 0.95rem;
            color: #495057;
            cursor: pointer;
        }
        
        .form-check-input {
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 14px;
            font-weight: 600;
            border-radius: 6px;
            color: white;
            width: 100%;
            margin-top: 15px;
            transition: var(--transition);
            font-size: 1rem;
        }
        
        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }
        
        .options-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        
        .form-label {
            font-size: 0.95rem;
            color: #495057;
            margin-bottom: 8px;
            display: block;
            font-weight: 500;
        }
        
        @media (max-width: 576px) {
            .login-card {
                padding: 25px 20px;
            }
            
            .header-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Header Section -->
        <div class="text-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4f/Logo_Politeknik_Negeri_Tanah_Laut.png" alt="Logo POLITALA">
            <h1 class="header-title">Sistem Booking Fasilitas & Infrastruktur Departemen IT</h1>
            <p class="header-subtitle">Prodi Teknologi Informasi</p>
        </div>
        
        <h2 class="login-title text-center">Masuk ke Akun Anda</h2>
        <p class="login-subtitle text-center">Silahkan masuk menggunakan email POLITALA untuk melanjutkan ke sistem peminjaman</p>

        <!-- Tombol Google -->
        <a href="{{ route('google.login') }}" class="btn btn-google">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
            Lanjutkan dengan Google
        </a>

        <!-- Divider -->
        <div class="divider">— atau lanjutkan dengan —</div>

        <!-- Form Login -->
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <span class="form-label">Email</span>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
            </div>

            <div class="mb-3">
                <span class="form-label">Password</span>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <div class="options-container">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <a href="/forgot-password" class="forgot-link">Lupa password?</a>
            </div>

            <button type="submit" class="btn btn-login">Masuk</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>