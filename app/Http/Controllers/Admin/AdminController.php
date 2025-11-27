<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FonnteService; // <-- Ditambahkan
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // <-- Ditambahkan

class AdminController extends Controller
{
    /**
     * Display halaman peminjaman admin (menggantikan dashboard)
     */
    public function peminjaman(Request $request)
    {
        // Query untuk statistik
        $pendingCount = Peminjaman::where('status', 'pending')->count();
        $approvedCount = Peminjaman::where('status', 'disetujui')->count();
        $rejectedCount = Peminjaman::where('status', 'ditolak')->count();
        $totalCount = Peminjaman::count();

        // Query untuk data peminjaman dengan filter
        // Eager load related models so views can show names/details
        $query = Peminjaman::with(['user', 'projector', 'ruangan']);

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                    ->orWhere('keperluan', 'like', "%{$search}%")
                    ->orWhere('ruang', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('tanggal', $request->date);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'return':
                $query->orderBy('tanggal_kembali', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $peminjamans = $query->paginate(10);

        return view('admin.peminjaman.index', compact(
            'peminjamans',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'totalCount'
        ));
    }

    /**
     * Display halaman pengembalian
     */
public function pengembalian(Request $request)
{
    // 1. Peminjaman aktif (belum ajukan pengembalian)
    $peminjamans = Peminjaman::where('status', 'disetujui')
        ->whereDoesntHave('pengembalian')
        ->with('user')
        ->orderBy('tanggal', 'desc')
        ->paginate(10);   // <-- WAJIB paginate

    // 2. Pengembalian yang diajukan user
    $pengembalians = \App\Models\Pengembalian::with(['peminjaman', 'user'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);   // <-- WAJIB paginate

    return view('admin.pengembalian.index', compact('peminjamans', 'pengembalians'));
}

    /**
     * Display riwayat peminjaman
     */
    public function riwayat(Request $request)
    {
        $query = Peminjaman::with('user');

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                    ->orWhere('keperluan', 'like', "%{$search}%")
                    ->orWhere('ruang', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter tanggal dari
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('tanggal', '>=', $request->date_from);
        }

        // Filter tanggal sampai
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('tanggal', '<=', $request->date_to);
        }

        // Hitung statistik untuk riwayat
        $completedCount = Peminjaman::where('status', 'disetujui')->count();
        $cancelledCount = Peminjaman::where('status', 'ditolak')->count();
        $ongoingCount = Peminjaman::where('status', 'pending')->count();
        $totalCount = Peminjaman::count();

        $riwayat = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.riwayat.index', compact(
            'riwayat',
            'completedCount',
            'cancelledCount',
            'ongoingCount',
            'totalCount'
        ));
    }

    /**
     * Display daftar peminjaman untuk admin
     */
    public function index(Request $request)
    {
        return $this->peminjaman($request);
    }

    /**
     * Store new peminjaman from admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjam' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ruang' => 'required|string|max:100',
            'proyektor' => 'required|boolean',
            'keperluan' => 'required|string|max:500',
        ]);

        // Cari user berdasarkan nama atau buat guest user
        $user = User::where('name', $request->peminjam)->first();

        if (!$user) {
            // Jika user tidak ditemukan, buat guest user atau gunakan user default
            $user = User::first(); // atau handle sesuai kebutuhan
        }

        Peminjaman::create([
            'user_id' => $user->id,
            'tanggal' => $request->tanggal,
            'ruang' => $request->ruang,
            'proyektor' => $request->proyektor,
            'keperluan' => $request->keperluan,
            'status' => 'disetujui', // Otomatis disetujui jika dibuat admin
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Approve peminjaman
     */
    public function approve($id)
    {
        $peminjaman = Peminjaman::with('user')->findOrFail($id);
        $peminjaman->update(['status' => 'disetujui']);

        // Kirim notifikasi WhatsApp
        if ($peminjaman->user && $peminjaman->user->no_hp) {
            $message = "Peminjaman Anda untuk ruang {$peminjaman->ruang} pada tanggal {$peminjaman->tanggal} telah DISETUJUI.";
            try {
                $fonnteService = resolve(FonnteService::class);
                $fonnteService->sendMessage($peminjaman->user->no_hp, $message);
            } catch (\Exception $e) {
                Log::error('Gagal mengirim notifikasi WhatsApp untuk peminjaman ID ' . $id . ': ' . $e->getMessage());
            }
        } else {
            Log::warning('Tidak dapat mengirim notifikasi WhatsApp: Nomor HP tidak ditemukan untuk peminjaman ID ' . $id);
        }

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil disetujui.');
    }

    /**
     * Reject peminjaman
     */
    public function reject($id)
    {
        $peminjaman = Peminjaman::with('user')->findOrFail($id);
        $peminjaman->update(['status' => 'ditolak']);

        // Kirim notifikasi WhatsApp
        if ($peminjaman->user && $peminjaman->user->no_hp) {
            $message = "Mohon maaf, peminjaman Anda untuk ruang {$peminjaman->ruang} pada tanggal {$peminjaman->tanggal} telah DITOLAK.";
            try {
                $fonnteService = resolve(FonnteService::class);
                $fonnteService->sendMessage($peminjaman->user->no_hp, $message);
            } catch (\Exception $e) {
                Log::error('Gagal mengirim notifikasi WhatsApp untuk peminjaman ID ' . $id . ': ' . $e->getMessage());
            }
        } else {
            Log::warning('Tidak dapat mengirim notifikasi WhatsApp: Nomor HP tidak ditemukan untuk peminjaman ID ' . $id);
        }

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditolak.');
    }

    /**
     * Complete peminjaman (pengembalian)
     */
    public function complete($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'selesai',
            'tanggal_kembali' => Carbon::now()
        ]);

        return redirect()->route('admin.pengembalian')
            ->with('success', 'Peminjaman berhasil diselesaikan.');
    }

    /**
     * Update peminjaman
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ruang' => 'required|string|max:100',
            'proyektor' => 'required|boolean',
            'keperluan' => 'required|string|max:500',
            'status' => 'required|in:pending,disetujui,ditolak,selesai',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        // Data umum
        $data = [
            'tanggal' => $request->tanggal,
            'ruang' => $request->ruang,
            'proyektor' => $request->proyektor,
            'keperluan' => $request->keperluan,
            'status' => $request->status,
        ];

        // Jika status selesai → set tanggal kembali + status pengembalian
        if ($request->status == 'selesai') {
            $data['tanggal_kembali'] = Carbon::now();
            $data['status_pengembalian'] = 'sudah dikembalikan';
        }

        $peminjaman->update($data);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    /**
     * Delete peminjaman
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }

    /**
     * Store pengembalian
     */
    public function storePengembalian(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'kondisi' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $peminjaman->update([
            'status' => 'selesai',
            'tanggal_kembali' => Carbon::now(),
            'kondisi_kembali' => $request->kondisi,
            'keterangan_kembali' => $request->keterangan
        ]);

        return redirect()->route('admin.pengembalian')
            ->with('success', 'Pengembalian berhasil dicatat.');
    }

public function prosesPengembalian(Request $request, $id)
{
    // Ambil data peminjaman berdasarkan ID peminjaman
    $peminjaman = \App\Models\Peminjaman::findOrFail($id);

    $peminjaman->update([
        'status'             => 'selesai',
        'status_pengembalian'=> 'sudah dikembalikan',
        'tanggal_kembali'    => now(),
        'kondisi_kembali'    => $request->kondisi_barang,
        'keterangan_kembali' => $request->keterangan,
    ]);

    return redirect()->route('admin.pengembalian')
        ->with('success', 'Pengembalian berhasil diproses.');
}

public function approvePengembalian($id)
{
    $pengembalian = \App\Models\Pengembalian::with('peminjaman')->findOrFail($id);

    // Update status pengembalian
    $pengembalian->update([
        'status' => 'verified'
    ]);

    // Update status di tabel peminjaman
    $pengembalian->peminjaman->update([
        'status' => 'selesai',
        'status_pengembalian' => 'sudah dikembalikan',
        'tanggal_kembali' => now()
    ]);

    return redirect()->route('admin.pengembalian')
        ->with('success', 'Pengembalian berhasil disetujui.');
}

public function rejectPengembalian($id)
{
    $pengembalian = \App\Models\Pengembalian::with('peminjaman')->findOrFail($id);

    // Update status pengembalian
    $pengembalian->update([
        'status' => 'rejected'
    ]);

    return redirect()->route('admin.pengembalian')
        ->with('success', 'Pengembalian ditolak.');
}


    /**
     * Update riwayat peminjaman
     */
    public function updateRiwayat(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ruang' => 'required|string|max:100',
            'proyektor' => 'required|boolean',
            'keperluan' => 'required|string|max:500',
            'status' => 'required|in:pending,disetujui,berlangsung,ditolak,selesai',
            'status_pengembalian' => 'required|in:belum dikembalikan,sudah dikembalikan',
            'catatan' => 'nullable|string|max:500',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $data = $request->only(['tanggal', 'ruang', 'proyektor', 'keperluan', 'catatan']);

        // Handle status peminjaman
        // Jika status adalah "berlangsung", simpan sebagai "disetujui"
        if ($request->status == 'berlangsung') {
            $data['status'] = 'disetujui';
        } else {
            $data['status'] = $request->status;
        }

        // Handle status pengembalian
        if ($request->status_pengembalian == 'sudah dikembalikan') {
            $data['tanggal_kembali'] = Carbon::now();
            $data['status_pengembalian'] = 'sudah dikembalikan';
        } else {
            $data['tanggal_kembali'] = null;
            $data['status_pengembalian'] = 'belum dikembalikan';
        }

        $peminjaman->update($data);

        return redirect()->route('admin.riwayat')
            ->with('success', 'Riwayat peminjaman berhasil diperbarui.');
    }

    /**
     * Display dashboard admin
     */
    public function dashboard()
    {
        // Statistik untuk dashboard
        $totalPeminjaman = Peminjaman::count();
        $peminjamanPending = Peminjaman::where('status', 'pending')->count();
        $peminjamanDisetujui = Peminjaman::where('status', 'disetujui')->count();
        $peminjamanDitolak = Peminjaman::where('status', 'ditolak')->count();
        $peminjamanSelesai = Peminjaman::where('status', 'selesai')->count();

        // Peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPeminjaman',
            'peminjamanPending',
            'peminjamanDisetujui',
            'peminjamanDitolak',
            'peminjamanSelesai',
            'peminjamanTerbaru'
        ));
    }
}
