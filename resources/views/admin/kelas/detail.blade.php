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
                        <h1 class="h3 fw-bold mb-1 text-dark-mode-aware">Kelas {{ $kela->nama_kelas }}</h1>
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
                    <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa">
                        <i class="fas fa-user-plus"></i> Tambah Mahasiswa
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        {{-- Card Header: Menggunakan text-dark-mode-aware untuk mengatasi warna teks di Dark Mode --}}
        <div class="card-header bg-white dark-mode-bg-card border-bottom-0 p-4">
            <h5 class="mb-0 fw-bold d-flex align-items-center text-dark-mode-aware">
                <i class="fas fa-list-ul me-2 text-primary"></i> Daftar Mahasiswa
            </h5>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-head-modern">
                        <tr>
                            <th class="py-3 px-4" style="width: 5%;">No</th>
                            <th class="py-3 px-4" style="width: 15%;">NIM</th>
                            <th class="py-3 px-4" style="width: 30%;">Nama</th>
                            <th class="py-3 px-4" style="width: 35%;">Jenis Kelamin</th>
                            <th class="py-3 px-4 text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $i => $m)
                        <tr>
                            <td class="px-4">{{ $i+1 }}</td>
                            {{-- Memastikan NIM menggunakan text-dark-mode-aware --}}
                            <td class="px-4"><span class="fw-semibold text-dark-mode-aware">{{ $m->nim }}</span></td>
                            {{-- Memastikan Nama menggunakan text-dark-mode-aware --}}
                            <td class="px-4 text-dark-mode-aware">{{ $m->nama }}</td>
                            
                            <td class="px-4">
                                {{ $m->jenis_kelamin }}
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
                                            <input type="text" name="jenis_kelamin" value="{{ $m->jenis_kelamin }}" class="form-control mb-2" placeholder="Jenis Kelamin">
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
                                    <p class="text-secondary">Klik **Tambah Mahasiswa** untuk memasukkan data.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
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
                    <h5 class="modal-title fw-bold text-white" id="modalTambahMahasiswaLabel"><i class="fas fa-user-plus"></i> Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="number" name="nim" placeholder="NIM" class="form-control mb-2" pattern="[0-9]*">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control mb-2">
                    <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin" class="form-control mb-2">
                    <input type="hidden" name="kelas_id" value="{{ $kela->id }}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush