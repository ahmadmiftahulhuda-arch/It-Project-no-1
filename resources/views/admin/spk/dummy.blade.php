@php
    $dummyRankings = $dummyRankings ?? collect();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SPK Dummy - AHP & SAW</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- BOOTSTRAP & ICON --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #3b5998;
            --secondary: #6d84b4;
            --bg-light: #f5f8fa;
            --bg-card: #ffffff;
            --border-light: #e9ecef;
            --text-dark: #495057;
            --text-light: #6c757d;
            --sidebar-width: 250px;
        }

        body {
            background: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 0;
            color: var(--text-dark);
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            color: #fff;
            padding-top: 20px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        /* CONTENT */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 25px;
        }

        .card-custom {
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            padding: 25px;
            margin-bottom: 30px;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        table th {
            background: var(--primary);
            color: #fff;
            text-align: center;
            vertical-align: middle;
        }

        table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <h4>
        <i class="fas fa-laptop-code"></i><br>
        Admin TI
    </h4>

    <a href="{{ route('admin.spk.index') }}">
        <i class="fas fa-sliders-h me-2"></i> SPK Utama
    </a>

    <a href="{{ route('admin.spk.dummy') }}" class="active">
        <i class="fas fa-file-excel me-2"></i> SPK Dummy
    </a>
</div>

{{-- CONTENT --}}
<div class="main-content">

    <h2 class="mb-4">
        <i class="fas fa-file-excel text-primary"></i>
        SPK Dummy (Simulasi Excel & SAW)
    </h2>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- =========================
        IMPORT EXCEL
    ========================== --}}
    <div class="card-custom">
        <h5 class="section-title">
            <i class="fas fa-upload"></i>
            Import Data Dummy
        </h5>

        <form action="{{ route('admin.spk.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-2">
                <div class="col-md-9">
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success w-100">
                        <i class="fas fa-file-import me-1"></i> Import
                    </button>
                </div>
            </div>

            <small class="text-muted d-block mt-2">
                Format Excel: nama | keperluan | tanggal_pinjam | jam | catatan_riwayat | sarana_prasarana
            </small>
        </form>
    </div>

    {{-- =========================
        DATA DUMMY
    ========================== --}}
    <div class="card-custom">
        <h5 class="section-title">
            <i class="fas fa-database"></i>
            Data Dummy SPK
        </h5>

        @if ($dummyRankings->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3 (menit)</th>
                            <th>K4</th>
                            <th>K5</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dummyRankings as $i => $d)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $d->nama }}</td>
                                <td class="text-center">{{ $d->k1 }}</td>
                                <td class="text-center">{{ $d->k2 }}</td>
                                <td class="text-center">{{ $d->k3 }}</td>
                                <td class="text-center">{{ $d->k4 }}</td>
                                <td class="text-center">{{ $d->k5 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Belum ada data dummy yang diimport.
            </div>
        @endif
    </div>

    {{-- =========================
        RANKING SAW
    ========================== --}}
    <div class="card-custom">
        <h5 class="section-title">
            <i class="fas fa-ranking-star"></i>
            Hasil Perankingan SAW
        </h5>

        @if ($dummyRankings->count())
            @php
                $rankingSAW = $dummyRankings->sortByDesc('nilai_preferensi')->values();
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankingSAW as $i => $d)
                            <tr>
                                <td class="text-center fw-bold">{{ $i + 1 }}</td>
                                <td>{{ $d->nama }}</td>
                                <td class="text-center fw-bold">
                                    {{ number_format($d->nilai_preferensi, 4) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Ranking belum tersedia.
            </div>
        @endif
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
