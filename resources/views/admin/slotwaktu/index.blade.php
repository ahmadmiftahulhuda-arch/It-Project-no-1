<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Slot Waktu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #3b5998;
            --secondary: #6d84b4;
            --success: #4caf50;
            --info: #2196f3;
            --warning: #ff9800;
            --danger: #f44336;
            --light: #f8f9fa;
            --dark: #343a40;
            --text-light: #6c757d;
            --text-dark: #495057;
            --bg-light: #f5f8fa;
            --bg-card: #ffffff;
            --border-light: #e9ecef;
        }

        .dark-mode {
            --primary: #4a6fa5;
            --secondary: #5d7ba6;
            --light: #1a1d23;
            --dark: #f0f0f0;
            --bg-light: #121212;
            --bg-card: #1e1e1e;
            --text-dark: #e0e0e0;
            --text-light: #a0a0a0;
            --border-light: #333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 250px; height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            display: flex; flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo { font-size: 2rem; margin-bottom: 10px; }
        .menu-item { display: flex; align-items: center; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.3s; }
        .menu-item i { margin-right: 10px; }
        .menu-item:hover, .menu-item.active { background: rgba(255,255,255,0.15); color: #fff; }

        .main-content {
            margin-left: 250px;
            padding: 25px;
            background: var(--bg-light);
            min-height: 100vh;
        }

        .header {
            display: flex; justify-content: space-between; align-items: center;
            background: var(--bg-card);
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .page-title h1 { font-weight: 600; font-size: 1.8rem; margin: 0; }
        .btn-primary { background: var(--primary); border: none; border-radius: 6px; padding: 10px 15px; color: #fff; }
        .btn-primary:hover { background: var(--secondary); }

        .table-container {
            background: var(--bg-card);
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .table thead th { background: var(--bg-light); padding: 12px; font-weight: 600; border-bottom: 2px solid var(--border-light); }
        .table tbody td { padding: 12px; border-bottom: 1px solid var(--border-light); }
        .table tbody tr:hover { background: var(--bg-light); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><i class="fas fa-clock"></i></div>
            <h4>Sarpras Politala</h4>
        </div>

        <div class="sidebar-menu">
            <a href="/admin/dashboard" class="menu-item"><i class="fas fa-home"></i> Dashboard</a>
            <a href="/admin/ruangan" class="menu-item"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="{{ route('slotwaktu.index') }}" class="menu-item active"><i class="fas fa-clock"></i> Slot Waktu</a>
            <a href="/admin/jadwal" class="menu-item"><i class="fas fa-calendar"></i> Jadwal</a>
            <a href="/admin/laporan" class="menu-item"><i class="fas fa-chart-bar"></i> Laporan</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h4>Manajemen Slot Waktu</h4>
            <button class="btn btn-primary" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Slot Waktu</button>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th width="80">No</th>
                        <th>Waktu</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slotWaktu as $slot)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $slot->waktu }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="openEditModal('{{ $slot->id }}','{{ $slot->waktu }}')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('slotwaktu.destroy', $slot->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus slot waktu ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="fas fa-clock fa-2x mb-2"></i><br>
                            Belum ada data slot waktu.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('slotwaktu.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Slot Waktu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="waktu" class="form-label">Slot Waktu</label>
                    <input type="text" name="waktu" id="waktu" class="form-control" placeholder="Contoh: 07:00 - 08:30" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Slot Waktu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="edit_waktu" class="form-label">Slot Waktu</label>
                    <input type="text" name="waktu" id="edit_waktu" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openCreateModal() {
            new bootstrap.Modal(document.getElementById('createModal')).show();
        }

        function openEditModal(id, waktu) {
            const form = document.getElementById('editForm');
            form.action = "{{ route('slotwaktu.update', ':id') }}".replace(':id', id);
            document.getElementById('edit_waktu').value = waktu;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>
</body>
</html>
