@extends('admin.layouts.app')

@section('title', 'Manajemen RBAC & Hak Akses - Admin Lab TI')

@section('content')
<style>
    /* Styling mengikuti standar tema PINTER Lab TI */
    .stat-card {
        background: var(--bg-card);
        border-radius: 8px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
        border: 1px solid var(--border-light);
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.4rem;
        color: white;
        flex-shrink: 0;
    }
    .stat-icon.total { background: var(--primary); }
    .stat-icon.available { background: var(--success); }
    .stat-icon.borrowed { background: var(--info); }
    .stat-info h3 {
        margin: 0;
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.1;
    }
    .stat-info p {
        margin: 4px 0 0;
        color: var(--text-light);
        font-size: 0.85rem;
    }

    .card-custom {
        background: var(--bg-card);
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-light);
        overflow: hidden;
    }
    .card-custom-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-light);
        background: var(--bg-card);
    }

    /* Role Accordion */
    .role-accordion-btn {
        background: var(--bg-card) !important;
        border: 1px solid var(--border-light) !important;
        border-radius: 8px !important;
        padding: 12px 16px !important;
        margin-bottom: 8px;
        color: var(--text-dark) !important;
    }
    .role-accordion-btn:not(.collapsed) {
        border-color: var(--primary) !important;
        background: rgba(59, 89, 152, 0.05) !important;
        border-radius: 8px 8px 0 0 !important;
    }
    .role-accordion-body {
        border: 1px solid var(--border-light);
        border-top: none;
        border-radius: 0 0 8px 8px;
        background: rgba(59, 89, 152, 0.02);
        padding: 15px;
        margin-bottom: 8px;
    }
    .perm-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--bg-card);
        border: 1px solid var(--border-light);
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 0.78rem;
        color: var(--text-dark);
        margin: 3px 2px;
    }
    .perm-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--success);
    }
</style>

<!-- Flash Message Feedback -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="border-radius: 8px;">
    <i class="fas fa-check-circle fs-5 me-2"></i>
    <div>{{ session('success') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="border-radius: 8px;">
    <i class="fas fa-exclamation-circle fs-5 me-2"></i>
    <div>{{ session('error') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Page Title Sesuai Tema PINTER -->
<div class="page-title mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold mb-1">Manajemen RBAC & Hak Akses</h1>
        <p class="text-muted mb-0">Kelola peran (roles), izin akses modul (permissions), dan otorisasi pengguna berbasis Spatie Permission.</p>
    </div>
    <div class="action-buttons d-flex align-items-center gap-2">
        <form action="{{ route('admin.rbac.sync') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mensinkronkan semua peran pengguna database dengan Spatie RBAC?');">
            @csrf
            <button type="submit" class="btn btn-outline-primary btn-sm px-3 py-2 fw-semibold" style="border-radius: 6px;">
                <i class="fas fa-sync-alt me-1"></i> Sinkronkan Semua Peran
            </button>
        </form>
        <span class="badge bg-primary px-3 py-2" style="font-size: 0.85rem; border-radius: 6px;">
            <i class="fas fa-shield-alt me-1"></i> Spatie RBAC Aktif
        </span>
    </div>
</div>

<!-- Stats Cards Sesuai Tema PINTER -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $roles->count() }}</h3>
                <p>Total Peran (Roles)</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon available">
                <i class="fas fa-key"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $permissions->count() }}</h3>
                <p>Total Hak Akses (Permissions)</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon borrowed">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $users->count() }}</h3>
                <p>Pengguna Terdaftar</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Row -->
<div class="row g-4">
    <!-- Kiri: Daftar Peran & Permissions -->
    <div class="col-lg-7">
        <div class="card-custom">
            <div class="card-custom-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">
                        <i class="fas fa-user-tag me-2 text-primary"></i>Daftar Peran & Hak Izin
                    </h5>
                    <small class="text-muted">Klik nama peran untuk melihat perizinan yang dimiliki</small>
                </div>
                <span class="badge bg-primary rounded-pill">{{ $roles->count() }} Role</span>
            </div>
            <div class="p-3">
                @php
                    $roleBadges = [
                        'superadmin'    => 'bg-danger',
                        'administrator' => 'bg-danger',
                        'admin'         => 'bg-primary',
                        'dosen'         => 'bg-info text-dark',
                        'mahasiswa'     => 'bg-secondary',
                        'inputer'       => 'bg-warning text-dark',
                        'checker'       => 'bg-success',
                        'approver'      => 'bg-primary',
                        'user'          => 'bg-secondary',
                    ];
                @endphp
                <div class="accordion accordion-flush" id="rolesAccordion">
                    @foreach($roles as $role)
                        @php
                            $rKey = strtolower($role->name);
                            $badgeClass = $roleBadges[$rKey] ?? 'bg-primary';
                        @endphp
                        <div class="accordion-item border-0 mb-1">
                            <h2 class="accordion-header" id="heading-{{ $role->id }}">
                                <button class="accordion-button collapsed role-accordion-btn" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $role->id }}">
                                    <div class="d-flex align-items-center justify-content-between w-100 me-2">
                                        <span class="badge {{ $badgeClass }} px-3 py-2 rounded-pill" style="font-size: 0.82rem; font-weight: 600;">
                                            <i class="fas fa-user-tag me-1"></i> {{ $role->name }}
                                        </span>
                                        <span class="badge bg-light text-dark border">
                                            {{ $role->permissions->count() }} permissions
                                        </span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse-{{ $role->id }}" class="accordion-collapse collapse" data-bs-parent="#rolesAccordion">
                                <div class="role-accordion-body">
                                    <p class="text-muted small mb-2 fw-semibold">
                                        <i class="fas fa-key me-1 text-warning"></i>Hak Akses Modul:
                                    </p>
                                    <div class="d-flex flex-wrap">
                                        @forelse($role->permissions as $perm)
                                            <span class="perm-badge">
                                                <span class="perm-dot"></span> {{ $perm->name }}
                                            </span>
                                        @empty
                                            <span class="text-muted small fst-italic">Belum ada permission untuk peran ini.</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Kanan: Status Otorisasi Pengguna -->
    <div class="col-lg-5">
        <div class="card-custom">
            <div class="card-custom-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">
                        <i class="fas fa-users-cog me-2 text-primary"></i>Mapping Peran Pengguna
                    </h5>
                    <small class="text-muted">Sinkronisasi peran database & Spatie role</small>
                </div>
                <span class="badge bg-primary rounded-pill">{{ $users->count() }} Pengguna</span>
            </div>
            <div class="table-responsive" style="max-height: 480px; overflow-y: auto;">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th class="ps-3 py-2 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Pengguna</th>
                            <th class="py-2 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Peran DB</th>
                            <th class="py-2 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Spatie Role</th>
                            <th class="pe-3 py-2 text-end text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                        <tr>
                            <td class="ps-3 py-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar" style="width: 32px; height: 32px; font-size: 0.8rem; background: var(--primary);">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div style="min-width: 0;">
                                        <div class="fw-semibold text-truncate text-dark" style="font-size: 0.82rem; max-width: 110px;" title="{{ $u->name }}">
                                            {{ $u->name }}
                                        </div>
                                        <small class="text-muted text-truncate d-block" style="font-size: 0.7rem; max-width: 110px;" title="{{ $u->email }}">
                                            {{ $u->email }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2">
                                <span class="badge bg-light text-dark border" style="font-size: 0.72rem;">
                                    {{ $u->peran ?? '-' }}
                                </span>
                            </td>
                            <td class="py-2">
                                @forelse($u->roles as $r)
                                    @php
                                        $rKey = strtolower($r->name);
                                        $bCls = $roleBadges[$rKey] ?? 'bg-primary';
                                    @endphp
                                    <span class="badge {{ $bCls }} rounded-pill" style="font-size: 0.7rem; padding: 4px 8px;">
                                        {{ $r->name }}
                                    </span>
                                @empty
                                    <span class="badge bg-warning text-dark" style="font-size: 0.7rem;">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Belum Sync
                                    </span>
                                @endforelse
                            </td>
                            <td class="pe-3 py-2 text-end">
                                <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editRoleModal-{{ $u->id }}"
                                    title="Ubah Peran">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Ubah Peran Pengguna -->
                        <div class="modal fade" id="editRoleModal-{{ $u->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $u->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="border-radius: 12px; border: 1px solid var(--border-light);">
                                    <form action="{{ route('admin.rbac.assignRole') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $u->id }}">
                                        <div class="modal-header border-bottom">
                                            <h5 class="modal-title fw-bold" id="modalLabel-{{ $u->id }}">
                                                <i class="fas fa-user-tag text-primary me-2"></i>Ubah Peran Pengguna
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-semibold">Nama Pengguna</label>
                                                <input type="text" class="form-control" value="{{ $u->name }} ({{ $u->email }})" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-semibold">Pilih Peran Baru</label>
                                                <select name="role" class="form-select" required>
                                                    @foreach($roles as $roleOption)
                                                        <option value="{{ $roleOption->name }}" {{ ($u->peran == $roleOption->name || $u->hasRole($roleOption->name)) ? 'selected' : '' }}>
                                                            {{ $roleOption->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted mt-1 d-block">
                                                    Mengubah peran akan otomatis mensinkronkan izin modul dan hak akses akun ini.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top bg-light">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3 border-top bg-light">
                <small class="text-muted d-flex align-items-center gap-2">
                    <i class="fas fa-info-circle text-primary"></i>
                    Gunakan tombol <strong>"Sinkronkan Semua Peran"</strong> di atas atau tombol edit di kolom aksi untuk memperbarui otorisasi.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
