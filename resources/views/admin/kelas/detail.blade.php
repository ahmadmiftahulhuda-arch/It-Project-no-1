@extends('admin.layouts.app')

@section('title', 'Detail Kelas')

@section('content')
<div class="container">
    <!-- Header Kelas -->
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-people-fill text-primary"></i> Kelas {{ $kela->nama_kelas }}
                </h3>
                <span class="badge bg-success fs-6">{{ $mahasiswa->count() }} Mahasiswa</span>
            </div>
            <div>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa">
                    <i class="bi bi-person-plus"></i> Tambah Mahasiswa
                </button>
            </div>
        </div>
    </div>

    <!-- Tabel Mahasiswa -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-list-check"></i> Daftar Mahasiswa
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $i => $m)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td><span class="fw-bold">{{ $m->nim }}</span></td>
                            <td>{{ $m->nama }}</td>
                            <td><span class="badge bg-info">{{ $m->program_studi }}</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditMahasiswa{{ $m->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Mahasiswa -->
                        <div class="modal fade" id="modalEditMahasiswa{{ $m->id }}">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('mahasiswa.update', $m->id) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title">
                                                <i class="bi bi-pencil-square"></i> Edit Mahasiswa
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="nim" value="{{ $m->nim }}" class="form-control mb-2" placeholder="NIM">
                                            <input type="text" name="nama" value="{{ $m->nama }}" class="form-control mb-2" placeholder="Nama Lengkap">
                                            <input type="text" name="program_studi" value="{{ $m->program_studi }}" class="form-control mb-2" placeholder="Program Studi">
                                            <input type="hidden" name="kelas_id" value="{{ $kela->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada mahasiswa di kelas ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Mahasiswa -->
<div class="modal fade" id="modalTambahMahasiswa">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf
            <div class="modal-content rounded-4">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-person-plus"></i> Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nim" placeholder="NIM" class="form-control mb-2">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control mb-2">
                    <input type="text" name="program_studi" placeholder="Program Studi" class="form-control mb-2">
                    <input type="hidden" name="kelas_id" value="{{ $kela->id }}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush