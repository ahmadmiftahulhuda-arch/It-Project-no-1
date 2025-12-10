<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-3">Profil Admin</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $user->name ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                <p><strong>Peran:</strong> {{ $user->peran ?? 'Administrator' }}</p>
                <a href="/admin" class="btn btn-outline-primary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>