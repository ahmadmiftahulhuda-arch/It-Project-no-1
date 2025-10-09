<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian - Sistem Peminjaman</title>
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
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }

        .card-custom {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
            margin-bottom: 1.5rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(67, 97, 238, 0.4);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-belum_dikembalikan {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-dikembalikan {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-terlambat {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .condition-baik {
            background-color: #d4edda;
            color: #155724;
        }

        .condition-rusak-ringan {
            background-color: #fff3cd;
            color: #856404;
        }

        .condition-rusak-berat {
            background-color: #f8d7da;
            color: #721c24;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
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

        .modal-custom {
            border-radius: var(--border-radius);
            border: none;
        }

        .modal-header-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .loading-spinner {
            display: none;
        }

        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s ease infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 8px;
            }
            
            .btn-sm {
                padding: 6px 12px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
   <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-calendar-check me-2"></i>
                <strong>Sistem Peminjaman</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.peminjaman.index') }}"><i
                                class="fas fa-list me-1"></i> Daftar Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.peminjaman.create') }}"><i
                                class="fas fa-plus-circle me-1"></i> Tambah Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.peminjaman.riwayat') }}">
                            <i class="fas fa-history me-1"></i> Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  active" href="{{ route('user.pengembalian.index') }}">
                            <i class="fas fa-undo me-1"></i> Pengembalian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.feedback.index') }}">
                            <i class="fas fa-comment-dots me-1"></i> Feedback Saya
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h2><i class="fas fa-undo text-primary me-2"></i> Pengembalian Peminjaman</h2>
                <p class="text-muted">Ajukan pengembalian ruangan dan proyektor yang telah digunakan</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="btn btn-primary-custom">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                </a>
            </div>
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistik Ringkas -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                        <h4 class="mb-1">{{ $peminjamans->count() ?? 0 }}</h4>
                        <p class="text-muted mb-0">Peminjaman Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <h4 class="mb-1">{{ $pendingReturns ?? 0 }}</h4>
                        <p class="text-muted mb-0">Menunggu Pengembalian</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-undo fa-2x text-info mb-2"></i>
                        <h4 class="mb-1">{{ $returnedCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Telah Dikembalikan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                        <h4 class="mb-1">{{ $overdueCount ?? 0 }}</h4>
                        <p class="text-muted mb-0">Terlambat</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman Aktif yang Bisa Dikembalikan -->
        <div class="card card-custom mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i> Peminjaman Aktif yang Dapat Dikembalikan</h5>
            </div>
            <div class="card-body">
                @if(isset($peminjamans) && $peminjamans->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Tanggal</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
                                    <th width="100" class="text-center">Proyektor</th>
                                    <th>Keperluan</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $peminjaman)
                                    <tr>
                                        <td class="fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal ?? now())->format('d M Y') }}
                                        </td>
                                        <td>
                                            <i class="fas fa-door-open me-1 text-info"></i>
                                            {{ $peminjaman->ruang ?? 'Ruang A' }}
                                        </td>
                                        <td>
                                            <i class="fas fa-clock me-1 text-success"></i>
                                            {{ $peminjaman->waktu_mulai ?? '08:00' }} - {{ $peminjaman->waktu_selesai ?? '17:00' }}
                                        </td>
                                        <td class="text-center">
                                            @if($peminjaman->proyektor ?? false)
                                                <span class="badge bg-success">Ya</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak</span>
                                            @endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($peminjaman->keperluan ?? 'Keperluan rapat', 50) }}</td>
                                        <td class="text-center">
                                            <button type="button" 
                                                    class="btn btn-success btn-sm ajukan-pengembalian"
                                                    data-peminjaman-id="{{ $peminjaman->id ?? $loop->iteration }}"
                                                    data-ruang="{{ $peminjaman->ruang ?? 'Ruang A' }}"
                                                    data-tanggal="{{ \Carbon\Carbon::parse($peminjaman->tanggal ?? now())->format('d M Y') }}"
                                                    data-proyektor="{{ $peminjaman->proyektor ?? false ? 'Ya' : 'Tidak' }}">
                                                <i class="fas fa-undo me-1"></i> Ajukan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <h5 class="mt-3">Tidak ada peminjaman aktif</h5>
                        <p class="text-muted">Semua peminjaman sudah dikembalikan atau belum ada yang disetujui</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Riwayat Pengembalian -->
        <div class="card card-custom">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i> Riwayat Pengembalian</h5>
            </div>
            <div class="card-body">
                @if(isset($pengembalians) && $pengembalians->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Ruang</th>
                                    <th>Tanggal Kembali</th>
                                    <th width="100" class="text-center">Proyektor</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengembalians as $pengembalian)
                                    <tr>
                                        <td class="fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($pengembalian->tanggal ?? now())->format('d M Y') }}
                                        </td>
                                        <td>{{ $pengembalian->ruang ?? 'Ruang A' }}</td>
                                        <td>
                                            @if($pengembalian->tanggal_kembali ?? false)
                                                {{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($pengembalian->proyektor ?? false)
                                                <span class="badge bg-success">Ya</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(($pengembalian->status ?? '') == 'selesai')
                                                <span class="badge status-dikembalikan">Dikembalikan</span>
                                            @elseif(($pengembalian->status ?? '') == 'terlambat')
                                                <span class="badge status-terlambat">Terlambat</span>
                                            @else
                                                <span class="badge status-belum_dikembalikan">Belum Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td>{{ ($pengembalian->keterangan ?? '') ? \Illuminate\Support\Str::limit($pengembalian->keterangan, 30) : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5 class="mt-3">Belum ada riwayat pengembalian</h5>
                        <p class="text-muted">Riwayat pengembalian akan muncul di sini setelah Anda mengajukan pengembalian</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Pengajuan Pengembalian -->
    <div class="modal fade" id="pengembalianModal" tabindex="-1" aria-labelledby="pengembalianModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="pengembalianModalLabel">
                        <i class="fas fa-undo me-2"></i> Ajukan Pengembalian
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Ruang:</strong>
                            <p id="modal-ruang" class="text-primary">-</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Pinjam:</strong>
                            <p id="modal-tanggal" class="text-primary">-</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Proyektor:</strong>
                            <p id="modal-proyektor" class="text-primary">-</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Kembali:</strong>
                            <p class="text-success">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                        </div>
                    </div>
                    
                    <form id="form-pengembalian">
                        <input type="hidden" id="peminjaman_id" name="peminjaman_id">
                        
                        <div class="mb-3">
                            <label for="kondisi_ruang" class="form-label">Kondisi Ruang setelah digunakan:</label>
                            <select class="form-select" id="kondisi_ruang" name="kondisi_ruang" required>
                                <option value="">Pilih Kondisi Ruang</option>
                                <option value="baik">Baik - Bersih dan rapi</option>
                                <option value="rusak_ringan">Rusak Ringan - Ada sedikit kotoran/berantakan</option>
                                <option value="rusak_berat">Rusak Berat - Ada kerusakan atau sangat kotor</option>
                            </select>
                        </div>

                        <div class="mb-3" id="proyektor-section" style="display: none;">
                            <label for="kondisi_proyektor" class="form-label">Kondisi Proyektor:</label>
                            <select class="form-select" id="kondisi_proyektor" name="kondisi_proyektor">
                                <option value="">Pilih Kondisi Proyektor</option>
                                <option value="baik">Baik - Berfungsi normal</option>
                                <option value="rusak_ringan">Rusak Ringan - Ada masalah kecil</option>
                                <option value="rusak_berat">Rusak Berat - Tidak berfungsi/rusak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Tambahan (opsional):</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="submit-pengembalian">
                        <i class="fas fa-paper-plane me-1"></i> Ajukan Pengembalian
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('pengembalianModal'));
            const ajukanButtons = document.querySelectorAll('.ajukan-pengembalian');
            const proyektorSection = document.getElementById('proyektor-section');
            const submitButton = document.getElementById('submit-pengembalian');
            
            // Cache DOM elements untuk performa lebih baik
            const modalRuang = document.getElementById('modal-ruang');
            const modalTanggal = document.getElementById('modal-tanggal');
            const modalProyektor = document.getElementById('modal-proyektor');
            const peminjamanIdInput = document.getElementById('peminjaman_id');
            const kondisiProyektorSelect = document.getElementById('kondisi_proyektor');
            const form = document.getElementById('form-pengembalian');
            
            ajukanButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const peminjamanId = this.getAttribute('data-peminjaman-id');
                    const ruang = this.getAttribute('data-ruang');
                    const tanggal = this.getAttribute('data-tanggal');
                    const proyektor = this.getAttribute('data-proyektor');
                    
                    // Set data ke modal
                    modalRuang.textContent = ruang;
                    modalTanggal.textContent = tanggal;
                    modalProyektor.textContent = proyektor;
                    peminjamanIdInput.value = peminjamanId;
                    
                    // Tampilkan/sembunyikan section proyektor
                    if (proyektor === 'Ya') {
                        proyektorSection.style.display = 'block';
                        kondisiProyektorSelect.setAttribute('required', 'required');
                    } else {
                        proyektorSection.style.display = 'none';
                        kondisiProyektorSelect.removeAttribute('required');
                    }
                    
                    // Reset form
                    form.reset();
                    
                    // Tampilkan modal
                    modal.show();
                });
            });
            
            // Handle submit pengembalian
            submitButton.addEventListener('click', function() {
                if (form.checkValidity()) {
                    // Tampilkan loading state
                    this.classList.add('btn-loading');
                    this.disabled = true;
                    
                    // Simulasi proses AJAX yang lebih cepat (500ms)
                    setTimeout(() => {
                        // Success message
                        showAlert('success', `Pengembalian untuk ruang ${modalRuang.textContent} berhasil diajukan!`);
                        
                        // Tutup modal
                        modal.hide();
                        
                        // Reset button state
                        resetSubmitButton();
                        
                    }, 500); // Dikurangi dari 1500ms menjadi 500ms
                    
                } else {
                    form.reportValidity();
                }
            });

            // Reset modal ketika ditutup
            document.getElementById('pengembalianModal').addEventListener('hidden.bs.modal', function () {
                resetSubmitButton();
                form.reset();
            });

            // Fungsi untuk menampilkan alert
            function showAlert(type, message) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i> 
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                // Tambahkan alert di bagian atas container
                const container = document.querySelector('.container');
                const firstCard = document.querySelector('.card-custom');
                container.insertBefore(alertDiv, firstCard);
                
                // Auto remove alert setelah 5 detik
                setTimeout(() => {
                    if (alertDiv.parentElement) {
                        alertDiv.remove();
                    }
                }, 5000);
            }

            // Fungsi untuk reset button submit
            function resetSubmitButton() {
                submitButton.classList.remove('btn-loading');
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Ajukan Pengembalian';
            }
        });
    </script>
</body>
</html>