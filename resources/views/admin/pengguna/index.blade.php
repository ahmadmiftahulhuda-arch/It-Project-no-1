@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark mb-1">Manajemen Pengguna</h1>
            <p class="text-muted mb-0">Kelola data pengguna sistem Lab Teknologi Informasi</p>
        </div>
        <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Users Grid -->
    <div class="row g-4">
        @forelse($users as $user)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card user-card h-100 shadow-sm">
                <div class="card-body">
                    <!-- User Header -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="card-title mb-1 fw-bold text-dark">{{ $user->nama }}</h6>
                            @if($user->nim)
                            <p class="text-muted small mb-2">{{ $user->nim }}</p>
                            @endif
                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary border-0" type="button" 
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('pengguna.edit', $user->id) }}">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $user->nama }}?')">
                                            <i class="fas fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- User Details -->
                    <div class="user-details">
                        <div class="detail-item mb-2">
                            <span class="badge 
                                @if($user->peran === 'Admin Lab') bg-danger
                                @elseif($user->peran === 'Asisten') bg-primary
                                @else bg-success @endif">
                                {{ $user->peran }}
                            </span>
                        </div>
                        
                        <div class="detail-item mb-2">
                            <small class="text-muted">Jurusan:</small>
                            <div class="fw-medium">{{ $user->jurusan ?? '-' }}</div>
                        </div>

                        <div class="detail-item mb-2">
                            <small class="text-muted">Status:</small>
                            <div>
                                @if($user->status === 'Aktif')
                                    <span class="badge bg-success">
                                        <i class="fas fa-circle me-1 small"></i>{{ $user->status }}
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-circle me-1 small"></i>{{ $user->status }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="detail-item">
                            <small class="text-muted">Bergabung:</small>
                            <div class="fw-medium text-dark">
                                @if($user->tanggal_bergabung)
                                    {{ \Carbon\Carbon::parse($user->tanggal_bergabung)->isoFormat('D MMM YYYY') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 pt-0">
                    <div class="d-flex gap-2">
                        <a href="{{ route('pengguna.edit', $user->id) }}" 
                           class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" class="d-inline flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $user->nama }}?')">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card text-center py-5">
                <div class="card-body">
                    <div class="text-muted">
                        <i class="fas fa-users fa-3x mb-3 d-block"></i>
                        <h4>Belum ada data pengguna</h4>
                        <p class="mb-4">Mulai dengan menambahkan pengguna baru ke sistem</p>
                        <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Pengguna Pertama
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->count() > 0)
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Menampilkan <strong>{{ $users->count() }}</strong> pengguna
        </div>
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
.user-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border: 1px solid #e9ecef;
}

.user-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
}

.user-details .detail-item {
    border-bottom: 1px solid #f8f9fa;
    padding-bottom: 8px;
}

.user-details .detail-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.card-title {
    font-size: 1.1rem;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.dropdown-toggle::after {
    display: none;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

/* Pastikan form tidak mempengaruhi layout */
form.d-inline {
    display: inline !important;
}
</style>
@endsection