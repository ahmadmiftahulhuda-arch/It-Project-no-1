<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Perubahan Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #f44336;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Peringatan Keamanan</h2>
        </div>
        <div class="content">
            <p>Halo, {{ $user->name }},</p>
            <p>
                Kami memberitahu Anda bahwa kata sandi untuk akun Anda dengan email <strong>{{ $user->email }}</strong> baru saja diubah.
            </p>
            <p>
                Jika Anda yang melakukan perubahan ini, Anda tidak perlu melakukan tindakan apa pun.
            </p>
            <p>
                Namun, jika Anda <strong>tidak</strong> merasa melakukan perubahan ini, segera amankan akun Anda dengan mengatur ulang kata sandi Anda dan hubungi administrator sistem.
            </p>
            <p>Terima kasih.</p>
        </div>
        <div class="footer">
            <p>Ini adalah email otomatis. Mohon untuk tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Sistem Manajemen Lab TI</p>
        </div>
    </div>
</body>
</html>
