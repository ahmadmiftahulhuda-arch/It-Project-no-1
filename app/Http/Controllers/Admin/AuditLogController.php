<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Menampilkan riwayat log audit aktivitas sistem.
     */
    public function index(Request $request)
    {
        abort_unless(
            auth()->user()->can('view audit logs') || auth()->user()->hasRole('Administrator') || auth()->user()->peran === 'Administrator',
            403,
            'Kamu tidak memiliki izin melihat Log Audit.'
        );

        $query = AuditLog::with('user')->latest();

        // Filter berdasarkan aksi jika dipilih
        if ($request->filled('action') && $request->action !== 'Semua') {
            $query->where('action', $request->action);
        }

        // Pencarian teks deskripsi, nama pengguna, atau IP
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhere('user_role', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        // Daftar kategori aksi unik untuk dropdown filter
        $actions = AuditLog::select('action')->distinct()->pluck('action');

        return view('admin.audit_logs.index', compact('logs', 'actions'));
    }
}
