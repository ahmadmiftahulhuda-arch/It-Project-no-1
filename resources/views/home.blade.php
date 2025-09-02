<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="{{ url('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">SarPras TI</div>
        <ul>
            <li><a href="/home" class="active">Beranda</a></li>
            <li><a href="/kalender">Kalender Perkuliahan</a></li>
            <li><a href="/peminjaman">Daftar Peminjaman</a></li>
            <li><a href="/berita">Berita</a></li>
            <li><a href="/about">About</a></li>
        <li>
        <a href="/login" class="btn btn-warning">
            <i class="fa-solid fa-right-to-bracket"></i> Login
        </a>
        </li>

        </ul>
    </nav>

    <!-- Isi Halaman -->
    <div class="container">
        <div class="card">
            <h1>Selamat Datang di Home Page!</h1>
            <p>Nama saya <strong>Ahmad Miftahul Huda</strong></p>
        </div>
    </div>
</body>
</html>
