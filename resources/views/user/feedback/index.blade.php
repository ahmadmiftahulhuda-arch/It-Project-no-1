<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Feedback - Sistem Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 12px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        body {
            background-color: #f5f7fb;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            padding-bottom: 2rem;
        }
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }
        .table-container {
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-bottom: 1.5rem;
        }
        .table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        .table th {
            border: none;
            padding: 16px 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .table td {
            padding: 14px 12px;
            vertical-align: middle;
            font-size: 0.9rem;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        .rating-stars {
            color: #ffc107;
        }
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #6c757d;
        }
        .empty-state i {
            font-size: 60px;
            margin-bottom: 15px;
            color: #dee2e6;
        }
        .pagination-custom .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .pagination-custom .page-link {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.peminjaman.index') }}">
                <i class="fas fa-calendar-check me-2"></i>
                <strong>Sistem Peminjaman</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.peminjaman.index') }}"><i class="fas fa-list me-1"></i> Daftar Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.peminjaman.create') }}"><i class="fas fa-plus-circle me-1"></i> Tambah Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.peminjaman.riwayat') }}">
                            <i class="fas fa-history me-1"></i> Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.pengembalian.index') }}">
                            <i class="fas fa-undo me-1"></i> Pengembalian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.feedback.index') }}">
                            <i class="fas fa-comment-dots me-1"></i> Feedback Saya
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== KONTEN UTAMA ===== -->
    <div class="container mb-5">
        <!-- Header -->
        <div class="row mb-4 page-header">
            <div class="col-md-6">
                <h2 class="mb-1"><i class="fas fa-comment-dots text-primary me-2"></i> Riwayat Feedback Saya</h2>
                <p class="text-muted mb-0">Lihat semua feedback yang telah Anda berikan.</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('user.feedback.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Beri Feedback Baru
                </a>
            </div>
        </div>

        <!-- Tabel Feedback -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Peminjaman</th>
                            <th class="text-center">Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal Feedback</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($feedbackItems as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->peminjaman->ruang ?? 'N/A' }}</strong>
                                    <div class="text-muted small">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal)->format('d M Y') }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="rating-stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $item->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </td>
                                <td>{{ $item->komentar ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h4 class="mt-3">Belum ada feedback</h4>
                                        <p class="text-muted">Anda belum pernah memberikan feedback.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($feedbackItems->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $feedbackItems->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
