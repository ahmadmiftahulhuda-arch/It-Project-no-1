@extends('admin.layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-edit me-2"></i>Edit Pengguna
                        </h5>
                        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" value="{{ old('nama', $pengguna->nama) }}" 
                                           placeholder="Masukkan nama lengkap" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                           id="nim" name="nim" value="{{ old('nim', $pengguna->nim) }}" 
                                           placeholder="Masukkan NIM">
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $pengguna->email) }}" 
                                           placeholder="Masukkan email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP (WhatsApp)</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                           id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp ?? '') }}" 
                                           placeholder="Contoh: 6281234567890">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="peran" class="form-label">Peran <span class="text-danger">*</span></label>
                                    <select class="form-select @error('peran') is-invalid @enderror" 
                                            id="peran" name="peran" required>
                                        <option value="">Pilih Peran</option>
                                        <option value="Admin Lab" {{ old('peran', $pengguna->peran) == 'Admin Lab' ? 'selected' : '' }}>Admin Lab</option>
                                        <option value="Asisten" {{ old('peran', $pengguna->peran) == 'Asisten' ? 'selected' : '' }}>Asisten</option>
                                        <option value="Mahasiswa" {{ old('peran', $pengguna->peran) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    </select>
                                    @error('peran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <select class="form-select @error('jurusan') is-invalid @enderror" 
                                            id="jurusan" name="jurusan">
                                        <option value="">Pilih Jurusan</option>
                                        @foreach($jurusanList as $jurusan)
                                            <option value="{{ $jurusan }}" {{ old('jurusan', $pengguna->jurusan) == $jurusan ? 'selected' : '' }}>
                                                {{ $jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif" {{ old('status', $pengguna->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Non-Aktif" {{ old('status', $pengguna->status) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung</label>
                                    <input type="date" class="form-control @error('tanggal_bergabung') is-invalid @enderror" 
                                           id="tanggal_bergabung" name="tanggal_bergabung" 
                                           value="{{ old('tanggal_bergabung', $pengguna->tanggal_bergabung ? $pengguna->tanggal_bergabung->format('Y-m-d') : '') }}">
                                    @error('tanggal_bergabung')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="text-dark mb-3">Ubah Password (Opsional)</h6>
                        <div class="row">
                             <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" placeholder="Isi untuk mengubah password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="password_confirmation" 
                                           name="password_confirmation" placeholder="Ketik ulang password baru">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection