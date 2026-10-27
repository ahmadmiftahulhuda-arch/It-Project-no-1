@extends('admin.layouts.app')

@section('title', 'Log Audit Sistem - Admin Lab TI')

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
        margin-bottom: 25px;
        overflow: hidden;
    }
    .card-custom-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-light);
        background: var(--bg-card);
    }

    .action-badge-login { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
    .action-badge-logout { background: #e3f2fd; color: #1565c0; border: 1px solid #bbdefb; }
    .action-badge-other { background: #fff3e0; color: #e65100; border: 1px solid #ffe0b2; }
    .action-badge {
        display: inline-block;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<!-- Page Title Sesuai Tema PINTER -->
<div class="page-title mb-4">
    <div>
        <h1>Log Audit Aktivitas Sistem</h1>
        <p>Rekam jejak otomatis seluruh aktivitas pengguna, otentikasi login/logout, dan perubahan data sistem.</p>
    </div>
    <div class="action-buttons">
        <span class="badge bg-primary px-3 py-2" style="font-size: 0.85rem; border-radius: 6px;">
            <i class="fas fa-lock me-1"></i> Append-Only · Immutable
        </span>
    </div>
</div>

<!-- Stats Cards Sesuai Tema PINTER -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-history"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $logs->total() }}</h3>
                <p>Total Log Aktivitas</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon available">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $actions->count() }}</h3>
                <p>Kategori Aksi Tercatat</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon borrowed">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $logs->currentPage() }} / {{ $logs->lastPage() }}</h3>
                <p>Halaman Navigasi Log</p>
            </div>
        </div>
    </div>
</div>

<!-- Info Banner Kepatuhan Audit Sesuai Tema PINTER (Biru) -->
<div class="alert alert-info d-flex align-items-center gap-3 mb-4 border-0 shadow-sm" style="border-left: 4px solid var(--primary) !important;">
    <div style="width: 36px; height: 36px; background: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
        <i class="fas fa-shield-alt text-white"></i>
    </div>
    <div>
        <p class="mb-0 small text-dark">
            <strong>CCTV Digital & Rekam Jejak Keamanan:</strong> Setiap aktivitas sistem mencatat <strong>pengguna</strong>, <strong>peran</strong>, <strong>kategori aksi</strong>, <strong>IP Address</strong>, dan <strong>waktu kejadian</strong> secara otomatis untuk kebutuhan audit dan akuntabilitas.
        </p>
    </div>
</div>

<!-- Filter Card Sesuai Tema PINTER -->
<div class="card-custom p-3 mb-4">
    <form method="GET" action="{{ route('admin.audit-logs.index') }}" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label small fw-semibold text-muted mb-1">Filter Kategori Aksi</label>
            <select name="action" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="Semua">-- Semua Kategori --</option>
                @foreach($actions as $act)
                    <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ $act }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-7">
            <label class="form-label small fw-semibold text-muted mb-1">Pencarian Log</label>
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-muted">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" class="form-control"
                    placeholder="Cari nama pengguna, role, deskripsi, atau IP address..."
                    value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm flex-grow-1">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
            @if(request('search') || (request('action') && request('action') != 'Semua'))
                <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-outline-secondary btn-sm" title="Reset filter">
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Table Card Sesuai Tema PINTER -->
<div class="card-custom">
    <div class="card-custom-header d-flex align-items-center justify-content-between">
        <div>
            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">
                <i class="fas fa-list me-2 text-primary"></i>Riwayat Log Audit
            </h5>
            <small class="text-muted">Menampilkan {{ $logs->firstItem() ?? 0 }} - {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} entri log</small>
        </div>
        <span class="badge bg-primary rounded-pill">{{ $logs->total() }} Log</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3 py-3 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Waktu</th>
                    <th class="py-3 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Pengguna</th>
                    <th class="py-3 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Peran</th>
                    <th class="py-3 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Aksi</th>
                    <th class="py-3 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">Deskripsi</th>
                    <th class="py-3 text-uppercase" style="font-size: 0.72rem; color: var(--text-light);">IP Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="ps-3 py-2 text-nowrap">
                        <div class="fw-semibold text-dark" style="font-size: 0.82rem;">
                            {{ $log->created_at->format('d/m/Y') }}
                        </div>
                        <small class="text-muted" style="font-size: 0.75rem;">
                            <i class="far fa-clock me-1"></i>{{ $log->created_at->format('H:i:s') }}
                        </small>
                    </td>
                    <td class="py-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="user-avatar" style="width: 32px; height: 32px; font-size: 0.8rem; background: var(--primary);">
                                {{ strtoupper(substr($log->user_name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold text-dark" style="font-size: 0.82rem;">{{ $log->user_name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-2">
                        <span class="badge bg-light text-dark border rounded-pill" style="font-size: 0.72rem;">
                            {{ $log->user_role ?? '-' }}
                        </span>
                    </td>
                    <td class="py-2">
                        @php
                            $badgeClass = match(strtoupper($log->action)) {
                                'LOGIN'  => 'action-badge-login',
                                'LOGOUT' => 'action-badge-logout',
                                default  => 'action-badge-other',
                            };
                            $icon = match(strtoupper($log->action)) {
                                'LOGIN'  => 'fa-sign-in-alt',
                                'LOGOUT' => 'fa-sign-out-alt',
                                default  => 'fa-cog',
                            };
                        @endphp
                        <span class="action-badge {{ $badgeClass }}">
                            <i class="fas {{ $icon }} me-1"></i>{{ $log->action }}
                        </span>
                    </td>
                    <td class="py-2" style="max-width: 320px;">
                        <span class="text-dark" style="font-size: 0.82rem;">{{ $log->description }}</span>
                    </td>
                    <td class="py-2">
                        <code class="text-muted" style="font-size: 0.75rem;">{{ $log->ip_address ?? '-' }}</code>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 text-secondary" style="opacity: 0.5;"></i>
                        <p class="mb-0">Belum ada data log aktivitas yang tercatat.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($logs->hasPages())
    <div class="card-footer bg-white border-top py-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Halaman {{ $logs->currentPage() }} dari {{ $logs->lastPage() }}
        </small>
        <div>
            {{ $logs->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>
@endsection
