@extends('admin.layouts.app')

@section('title', 'Detail Kelas')

@section('content')

<div class="container-fluid">
    
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                
                {{-- Bagian Judul dan Statistik --}}
                <div class="page-title d-flex align-items-center mb-3 mb-md-0">
                    <i class="fas fa-users-class fa-2x text-primary me-3"></i>
                    <div>
                        {{-- Nama Kelas --}}
                        <h1 class="h3 fw-bold mb-1 text-dark-mode-aware">{{ $kela->nama_kelas }}</h1>
                        {{-- Jumlah Mahasiswa --}}
                        <span class="badge bg-success-soft text-success p-2 px-3 fw-bold fs-6" style="border-radius: 50px;">
                            <i class="fas fa-graduation-cap me-1"></i> {{ $mahasiswa->count() }} Mahasiswa
                        </span>
                    </div>
                </div>
                
                {{-- Tombol Aksi --}}
                <div class="page-actions d-flex gap-2">
                    {{-- Tombol Kembali: Menggunakan text-dark-mode-aware untuk mengatasi warna teks --}}
                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button class="btn btn-success d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalImportMahasiswa">
                        <i class="fas fa-file-excel"></i> Import Excel
                    </button>
                    <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa">
                        <i class="fas fa-plus"></i> Tambah Kordinator Kelas
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        {{-- Card Header: Menggunakan text-dark-mode-aware untuk mengatasi warna teks di Dark Mode --}}
        <div class="card-header bg-white dark-mode-bg-card border-bottom-0 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold d-flex align-items-center text-dark-mode-aware">
                    <i class="fas fa-list-ul me-2 text-primary"></i> Daftar Kordinator Kelas
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <div class="w-auto">
                    </div>
                    <a href="{{ route('admin.kelas.mahasiswa.export', $kela->id) }}" class="btn btn-success d-flex align-items-center">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <form action="{{ route('admin.kelas.mahasiswa.destroyAll', $kela->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua mahasiswa di kelas ini? Aksi ini tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger d-flex align-items-center">
                            <i class="fas fa-trash-alt"></i> Hapus Semua
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-head-modern">
                        <tr>
                            <th class="py-3 px-4" style="width: 5%;">No</th>
                            <th class="py-3 px-4" style="width: 15%;">NIM</th>
                            <th class="py-3 px-4" style="width: 30%;">Nama</th>
                            <th class="py-3 px-4" style="width: 35%;">Kordinator</th>
                            <th class="py-3 px-4 text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $i => $m)
                        <tr class="mahasiswa-row">
                            <td class="px-4">{{ $i+1 }}</td>
                            {{-- Memastikan NIM menggunakan text-dark-mode-aware --}}
                            <td class="px-4"><span class="fw-semibold text-dark-mode-aware">{{ $m->nim }}</span></td>
                            {{-- Memastikan Nama menggunakan text-dark-mode-aware --}}
                            <td class="px-4 text-dark-mode-aware">{{ $m->nama }}</td>
                            
                            <td class="px-4">
                                {{ $m->kordinator }}
                            </td>
                            
                            {{-- AKSI (Ikon ringkas, fungsi tidak diubah) --}}
                            <td class="px-4 text-center">
                                <button class="btn btn-sm btn-warning me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditMahasiswa{{ $m->id }}" 
                                        title="Edit Mahasiswa">
                                    <i class="fas fa-pencil-alt"></i> 
                                </button>
                                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')" 
                                            title="Hapus Mahasiswa">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEditMahasiswa{{ $m->id }}" tabindex="-1" aria-labelledby="modalEditMahasiswaLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('mahasiswa.update', $m->id) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title text-dark-mode-aware fw-bold" id="modalEditMahasiswaLabel">
                                                <i class="fas fa-pencil-alt"></i> Edit Mahasiswa
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="number" name="nim" value="{{ $m->nim }}" class="form-control mb-2" placeholder="NIM" pattern="[0-9]*">
                                            <input type="text" name="nama" value="{{ $m->nama }}" class="form-control mb-2" placeholder="Nama Lengkap">
                                            <input type="text" name="kordinator" value="{{ $m->kordinator }}" class="form-control mb-2" placeholder="Kordinator Kelas">
                                            <input type="hidden" name="kelas_id" value="{{ $kela->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-center p-4">
                                    <i class="fas fa-box-open fa-3x text-gray mb-3"></i>
                                    <h6 class="mb-1 text-dark-mode-aware">Belum ada mahasiswa di kelas ini.</h6>
                                    <p class="text-secondary">Klik **Tambah Kordinator Kelas** untuk memasukkan data.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                        <tr id="no-results" style="display: none;">
                            <td colspan="5" class="text-center py-5">
                                <div class="text-center p-4">
                                    <i class="fas fa-search fa-3x text-gray mb-3"></i>
                                    <h6 class="mb-1 text-dark-mode-aware">Tidak ada mahasiswa yang cocok.</h6>
                                    <p class="text-secondary">Coba periksa kembali NIM atau Nama yang dicari.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf
            <div class="modal-content rounded-4">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold text-white" id="modalTambahMahasiswaLabel"><i class="fas fa-plus"></i> Tambah Kordinator Kelas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="number" name="nim" placeholder="NIM" class="form-control mb-2" pattern="[0-9]*">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control mb-2">
                    <input type="text" name="kordinator" placeholder="Kordinator Kelas" class="form-control mb-2">
                    <input type="hidden" name="kelas_id" value="{{ $kela->id }}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalImportMahasiswa" tabindex="-1" aria-labelledby="modalImportMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.kelas.importMahasiswa', ['kela' => $kela->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content rounded-4">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold text-white" id="modalImportMahasiswaLabel"><i class="fas fa-file-excel"></i> Import Mahasiswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih file Excel</label>
                        <input class="form-control" type="file" name="file" id="file" required>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-success">Unduh template Excel</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"><i class="fas fa-upload"></i> Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) { // Check if search input exists
        const noResultsRow = document.getElementById('no-results');
        const studentRows = document.querySelectorAll('.mahasiswa-row');

        if (studentRows.length > 0) {
            searchInput.addEventListener('keyup', function () {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                studentRows.forEach(row => {
                    const nim = row.cells[1].textContent.toLowerCase();
                    const nama = row.cells[2].textContent.toLowerCase();

                    if (nim.includes(searchTerm) || nama.includes(searchTerm)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (noResultsRow) {
                    noResultsRow.style.display = visibleCount === 0 ? '' : 'none';
                }
            });
        } else {
            searchInput.disabled = true;
        }
    }
});
</script>
@endpush