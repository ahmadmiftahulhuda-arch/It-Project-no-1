<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sarpras TI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (untuk ikon Google) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
       <!-- CSS Kustom -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  
</head>
<body>

    <div class="login-card text-center">
        <img src="{{ asset('img/Logo-TI.png') }}" alt="Logo">
        <h5>Sarpras TI</h5>
        <p class="text-muted">Silahkan login menggunakan email Politala untuk melakukan peminjaman</p>

   <a href="{{ route('google.login') }}" class="btn btn-google w-100 mb-3">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
            Login dengan Google
        </a>
        <!-- Divider -->
        <div class="divider">--- atau lanjutkan dengan ---</div>

        <!-- Form Login -->
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <div class="d-flex justify-content-end">
                    <a href="/forgot-password" class="forgot-link">Lupa Password?</a>
                </div>
            </div>

            <div class="form-check text-start mb-3">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember">Ingat Saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Masuk</button>
              <div class="footer">
           <div class="footer">
            <p>&copy; 2025 Sarpras TI Politala | <a href="#">Bantuan</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>

</body>
</html>
