<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FonnteService; // <-- Ditambahkan
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\Projector;
use App\Models\Dosen;
use Carbon\Carbon;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $query = Peminjaman::with(['user', 'projector', 'ruangan', 'dosen']);

        // Filter pencarian (lebih luas: nama, nim, email, no_hp, keperluan, ruangan, proyektor, tanggal)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // Cari berdasarkan user (nama, nim, email, no_hp)
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                })
                    // atau keperluan
                    ->orWhere('keperluan', 'like', "%{$search}%")
                    // atau nama ruangan
                    ->orWhereHas('ruangan', function ($r) use ($search) {
                        $r->where('nama_ruangan', 'like', "%{$search}%");
                    })
                    // atau proyektor (kode/merk/model)
                    ->orWhereHas('projector', function ($p) use ($search) {
                        $p->where('kode_proyektor', 'like', "%{$search}%")
                            ->orWhere('merk', 'like', "%{$search}%")
                            ->orWhere('model', 'like', "%{$search}%");
                    });

                // Jika user memasukkan tanggal yang valid, juga cari berdasarkan tanggal peminjaman
                try {
                    $date = Carbon::parse($search)->format('Y-m-d');
                    $q->orWhereDate('tanggal', $date);
                } catch (\Exception $e) {
                    // bukan tanggal — abaikan
                }
            });
        }

        // Filter status (support 'terlambat' as derived status)
        if ($request->has('status') && $request->status != '') {
            // Accept either the display value 'terlambat' or the DB-safe 'overdue'
            if ($request->status === 'terlambat' || $request->status === 'overdue') {
                // pengembalians where tanggal_pengembalian > peminjaman.tanggal
                $query->whereRaw("DATE(tanggal_pengembalian) > (select DATE(tanggal) from peminjamans where peminjamans.id = pengembalians.peminjaman_id)");
            } else {
                $query->where('status', $request->status);
            }
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

        $ruangan = Ruangan::where('status', 'Tersedia')->get();
        $projectors = Projector::where('status', 'tersedia')->get();
        $dosens = Dosen::orderBy('nama_dosen')->get();

        return view('admin.peminjaman.index', compact(
            'peminjamans',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'totalCount',
            'ruangan',
            'projectors',
            'dosens'
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
            ->with(['user', 'ruangan', 'projector', 'dosen'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);   // <-- WAJIB paginate

        // 2. Pengembalian yang diajukan user - dengan filter
        $query = \App\Models\Pengembalian::with(['peminjaman', 'user', 'peminjaman.ruangan', 'peminjaman.projector']);

        // Filter ruangan
        if ($request->has('projector_id') && $request->projector_id != '') {
            $projectorId = $request->projector_id;

            $query->whereHas('peminjaman', function ($q) use ($projectorId) {
                $q->where('projector_id', $projectorId);
            });
        }

        // Filter pencarian (user, catatan, tanggal_pengembalian, peminjaman fields like keperluan/ruangan/projector)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // user fields
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    // catatan pada pengembalian
                    ->orWhere('catatan', 'like', "%{$search}%")
                    // peminjaman related fields
                    ->orWhereHas('peminjaman', function ($peminjamanQuery) use ($search) {
                        $peminjamanQuery->where('keperluan', 'like', "%{$search}%")
                            ->orWhereHas('ruangan', function ($r) use ($search) {
                                $r->where('nama_ruangan', 'like', "%{$search}%");
                            })
                            ->orWhereHas('projector', function ($p) use ($search) {
                                $p->where('kode_proyektor', 'like', "%{$search}%")
                                    ->orWhere('merk', 'like', "%{$search}%")
                                    ->orWhere('model', 'like', "%{$search}%");
                            });
                    });

                // Jika input adalah tanggal, cari juga berdasarkan tanggal_pengembalian
                try {
                    $date = Carbon::parse($search)->format('Y-m-d');
                    $q->orWhereDate('tanggal_pengembalian', $date);
                } catch (\Exception $e) {
                    // ignore
                }
            });
        }

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('tanggal_pengembalian', $request->date);
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'due_date':
                $query->orderBy('tanggal_pengembalian', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $pengembalians = $query->paginate(10);   // <-- WAJIB paginate

        // Ambil daftar ruang untuk filter dropdown
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();
        $projectors = Projector::orderBy('kode_proyektor')->get();

        // Hitung statistik
        $pendingReturns = Pengembalian::where('status', 'pending')->count();
        $returnedCount = Pengembalian::where('status', 'verified')->count();
        $overdueCount  = Pengembalian::where('status', 'overdue')->count();
        $totalReturns  = Pengembalian::count();

        $totalReturns = \App\Models\Pengembalian::count();

        return view('admin.pengembalian.index', compact(
            'peminjamans',
            'pengembalians',
            'pendingReturns',
            'returnedCount',
            'overdueCount',
            'totalReturns',
            'ruangans',
            'projectors',
        ));
    }

    /**
     * Display riwayat peminjaman
     */
    public function riwayat(Request $request)
    {
        $query = Peminjaman::with(['user', 'ruangan', 'projector', 'pengembalian', 'dosen']);

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                    ->orWhere('keperluan', 'like', "%{$search}%")
                    ->orWhereHas('ruangan', function ($r) use ($search) {
                        $r->where('nama_ruangan', 'like', "%{$search}%");
                    });
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

        // Ambil data ruangan dan projector untuk dropdown di modal edit
        $ruangans = \App\Models\Ruangan::orderBy('nama_ruangan')->get();
        $projectors = \App\Models\Projector::orderBy('kode_proyektor')->get();

        return view('admin.riwayat.index', compact(
            'riwayat',
            'completedCount',
            'cancelledCount',
            'ongoingCount',
            'totalCount',
            'ruangans',
            'projectors'
        ));
    }

    /**
     * Display daftar peminjaman untuk admin
     */
    public function index(Request $request)
    {
        $ruangan = Ruangan::all();
        $projectors = Projector::all();
        $dosens = Dosen::orderBy('nama_dosen')->get();
        $peminjamans = Peminjaman::with(['ruangan', 'projector', 'dosen'])->paginate(15);

        // juga hitung statistik jika dipakai di view
        $pendingCount = Peminjaman::where('status', 'pending')->count();
        $approvedCount = Peminjaman::where('status', 'disetujui')->count();
        $rejectedCount = Peminjaman::where('status', 'ditolak')->count();
        $totalCount = Peminjaman::count();

        return view('admin.peminjaman.index', compact(
            'peminjamans',
            'ruangan',
            'projectors',
            'dosens',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'totalCount'
        ));
    }

    /**
     * Show admin profile page
     */
    public function profile(Request $request)
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Store new peminjaman from admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjam' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'ruangan_id' => 'required|exists:ruangan,id',
            'projector_id' => 'nullable|exists:projectors,id',
            'dosen_nip' => 'nullable|exists:dosens,nip',
            'keperluan' => 'required|string|max:500',
        ]);

        // Cari user berdasarkan nama
        $user = User::where('name', $request->peminjam)->first();

        if (!$user) {
            $user = User::first();
        }

        Peminjaman::create([
            'user_id' => $user->id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'ruangan_id' => $request->ruangan_id,
            'projector_id' => $request->projector_id,
            'dosen_nip' => $request->dosen_nip ?? null,
            'keperluan' => $request->keperluan,
            'status' => 'disetujui',
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Approve peminjaman
     */
    public function approve($id)
    {
        $peminjaman = Peminjaman::with(['user', 'ruangan', 'dosen'])->findOrFail($id);
        $peminjaman->update(['status' => 'disetujui']);

        // Kirim notifikasi WhatsApp
        if ($peminjaman->user && $peminjaman->user->no_hp) {
            $ruangName = $peminjaman->ruangan ? $peminjaman->ruangan->nama_ruangan : 'ruang';
            $message = "Peminjaman Anda untuk ruang {$ruangName} pada tanggal {$peminjaman->tanggal} telah DISETUJUI.";
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
        $peminjaman = Peminjaman::with(['user', 'ruangan', 'dosen'])->findOrFail($id);
        $peminjaman->update(['status' => 'ditolak']);

        // Kirim notifikasi WhatsApp
        if ($peminjaman->user && $peminjaman->user->no_hp) {
            $ruangName = $peminjaman->ruangan ? $peminjaman->ruangan->nama_ruangan : 'ruang';
            $message = "Mohon maaf, peminjaman Anda untuk ruang {$ruangName} pada tanggal {$peminjaman->tanggal} telah DITOLAK.";
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
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'ruangan_id' => 'required|exists:ruangan,id',
            'projector_id' => 'nullable|exists:projectors,id',
            'dosen_nip' => 'nullable|exists:dosens,nip',
            'keperluan' => 'required|string|max:500',
            'status' => 'required|in:pending,disetujui,ditolak,selesai',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $data = [
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'ruangan_id' => $request->ruangan_id,
            'projector_id' => $request->projector_id,
            'dosen_nip' => $request->dosen_nip ?? null,
            'keperluan' => $request->keperluan,
            'status' => $request->status,
        ];

        if ($request->status == 'selesai') {
            $data['tanggal_kembali'] = now();
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
            'status_pengembalian' => 'sudah dikembalikan',
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

        // Determine whether pengembalian was submitted after the peminjaman end time
        $peminjaman = $pengembalian->peminjaman;
        $statusToSave = 'verified';

        try {
            // prefer stored waktu_selesai, fallback to end of day
            $waktuSelesai = $peminjaman->waktu_selesai ?? '23:59';
            $end = Carbon::parse($peminjaman->tanggal . ' ' . $waktuSelesai);

            // pengembalian->tanggal_pengembalian is cast to datetime; ensure we have a datetime
            $tglPeng = $pengembalian->tanggal_pengembalian ? Carbon::parse($pengembalian->tanggal_pengembalian) : Carbon::now();

            if ($tglPeng->greaterThan($end)) {
                $statusToSave = 'overdue'; // DB canonical
            }
        } catch (\Exception $e) {
            // If any parsing error, default to verified
            $statusToSave = 'verified';
        }

        // Update status pengembalian
        $pengembalian->update([
            'status' => $statusToSave
        ]);

        // Update status in peminjaman table: always mark selesai and set tanggal_kembali to pengembalian time
        $peminjaman->update([
            'status' => 'selesai',
            'status_pengembalian' => 'sudah dikembalikan',
            'tanggal_kembali' => $pengembalian->tanggal_pengembalian ?? now()
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
     * Update pengembalian (kondisi dan catatan)
     */
    public function updatePengembalian(Request $request, $id)
    {
        $request->validate([
            'kondisi_ruang' => 'required|in:baik,rusak_ringan,rusak_berat',
            'kondisi_proyektor' => 'nullable|in:baik,rusak_ringan,rusak_berat',
            'catatan' => 'nullable|string|max:500',
            'tanggal_pengembalian' => 'nullable|date',
            // saveable statuses use 'pending','verified','rejected','overdue' in DB
            'status' => 'required|in:pending,verified,rejected,overdue',
        ]);

        $pengembalian = \App\Models\Pengembalian::findOrFail($id);

        $data = [
            'kondisi_ruang' => $request->kondisi_ruang,
            'kondisi_proyektor' => $request->kondisi_proyektor ?? null,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ];

        if ($request->filled('tanggal_pengembalian')) {
            $data['tanggal_pengembalian'] = $request->tanggal_pengembalian;
        }

        // If admin marks as 'overdue' (Terlambat) and no tanggal_pengembalian provided, set it to today
        if ($request->status === 'overdue' && empty($data['tanggal_pengembalian'])) {
            $data['tanggal_pengembalian'] = Carbon::now()->toDateString();
        }

        $pengembalian->update($data);

        // propagate to peminjaman: if pengembalian is verified or terlambat, mark peminjaman as selesai
        try {
            $peminjaman = $pengembalian->peminjaman;
            if ($peminjaman && in_array($pengembalian->status, ['verified', 'overdue', 'terlambat'])) {
                $peminjaman->update([
                    'status' => 'selesai',
                    'tanggal_kembali' => $pengembalian->tanggal_pengembalian ?? Carbon::now(),
                    'status_pengembalian' => 'sudah dikembalikan'
                ]);
            }
        } catch (\Exception $e) {
            // ignore, not critical
        }
        return redirect()->route('admin.pengembalian')
            ->with('success', 'Pengembalian berhasil diperbarui.');
    }


    /**
     * Update riwayat peminjaman
     */
    public function updateRiwayat(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ruangan_id' => 'required|exists:ruangan,id',
            'projector_id' => 'nullable|exists:projectors,id',
            'keperluan' => 'required|string|max:500',
            'status' => 'required|in:pending,disetujui,berlangsung,ditolak,selesai',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'catatan' => 'nullable|string|max:500',
            // optional pengembalian fields
            'pengembalian_status' => 'nullable|in:pending,verified,rejected,overdue,terlambat',
            'tanggal_pengembalian' => 'nullable|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $data = [
            'tanggal' => $request->tanggal,
            'ruangan_id' => $request->ruangan_id,
            'projector_id' => $request->projector_id ?? null,
            'keperluan' => $request->keperluan,
            'catatan' => $request->catatan,
            'waktu_mulai' => $request->waktu_mulai ?? '08:00:00',
            'waktu_selesai' => $request->waktu_selesai ?? '17:00:00',
        ];

        // Handle status peminjaman
        // Jika status adalah "berlangsung", simpan sebagai "disetujui"
        if ($request->status == 'berlangsung') {
            $data['status'] = 'disetujui';
        } else {
            $data['status'] = $request->status;
        }
        $peminjaman->update($data);

        // Handle pengembalian data if admin provided it in edit modal
        if ($request->filled('pengembalian_status') || $request->filled('tanggal_pengembalian')) {
            $pj = \App\Models\Pengembalian::where('peminjaman_id', $peminjaman->id)->first();
            $pjData = [];
            if ($request->filled('pengembalian_status')) {
                // map 'terlambat' input to DB value 'overdue' to avoid enum truncation
                $pjStatus = $request->pengembalian_status;
                if ($pjStatus === 'terlambat') {
                    $pjStatus = 'overdue';
                }
                $pjData['status'] = $pjStatus;
            }
            if ($request->filled('tanggal_pengembalian')) {
                $pjData['tanggal_pengembalian'] = $request->tanggal_pengembalian;
            }

            // If admin set status to 'overdue' but didn't provide tanggal_pengembalian, set it to today
            if (isset($pjData['status']) && in_array($pjData['status'], ['overdue']) && empty($pjData['tanggal_pengembalian'])) {
                $pjData['tanggal_pengembalian'] = Carbon::now()->toDateString();
            }

            if ($pj) {
                $pj->update($pjData);
            } else {
                $pjData['peminjaman_id'] = $peminjaman->id;
                $pjData['user_id'] = $peminjaman->user_id;
                // Ensure tanggal_pengembalian has a value because DB column doesn't have a default
                if (empty($pjData['tanggal_pengembalian'])) {
                    $pjData['tanggal_pengembalian'] = Carbon::now()->toDateString();
                }
                \App\Models\Pengembalian::create($pjData);
            }
            // After creating/updating pengembalian, propagate status to peminjaman if needed
            try {
                $pjLatest = \App\Models\Pengembalian::where('peminjaman_id', $peminjaman->id)->first();
                if ($pjLatest && in_array($pjLatest->status, ['verified', 'overdue', 'terlambat'])) {
                    $peminjaman->update([
                        'status' => 'selesai',
                        'tanggal_kembali' => $pjLatest->tanggal_pengembalian ?? now(),
                        'status_pengembalian' => 'sudah dikembalikan'
                    ]);
                }
            } catch (\Exception $e) {
                // non-fatal
            }
        }

        return redirect()->route('admin.riwayat')
            ->with('success', 'Riwayat peminjaman berhasil diperbarui.');
    }

    /**
     * Display dashboard admin
     */
    public function dashboard()
    {
        // Statistik untuk dashboard
        $totalBarang = Projector::count(); // Total proyektor
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
            'totalBarang',
            'totalPeminjaman',
            'peminjamanPending',
            'peminjamanDisetujui',
            'peminjamanDitolak',
            'peminjamanSelesai',
            'peminjamanTerbaru'
        ));
    }

    /**
     * Display laporan admin
     */
    public function laporan(Request $request)
    {
        // For now, just return the view. Data fetching logic will be added later.
        $years = Peminjaman::select(DB::raw('YEAR(tanggal) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.laporan', compact('years'));
    }

    public function getReportData(Request $request)
    {
        $reportType = $request->input('report_type', 'peminjaman');
        $dateRange = $request->input('date_range', 'month');
        $year = $request->input('year', now()->year);
        $today = Carbon::now();

        $startDate = $today->copy()->startOfMonth();
        $endDate = $today->copy()->endOfMonth();

        switch ($dateRange) {
            case 'week':
                $startDate = $today->copy()->startOfWeek();
                $endDate = $today->copy()->endOfWeek();
                break;
            case 'month':
                // default is this month
                break;
            case 'quarter':
                $startDate = $today->copy()->startOfQuarter();
                $endDate = $today->copy()->endOfQuarter();
                break;
            case 'year':
                $startDate = $today->copy()->startOfYear();
                $endDate = $today->copy()->endOfYear();
                break;
        }

        $stats = [];
        $monthlyChartData = [];
        $distributionChartData = [];
        $uiConfig = [];

        switch ($reportType) {
            case 'penggunaan':
                $peminjamanQuery = Peminjaman::whereBetween('tanggal', [$startDate, $endDate]);

                $ruanganUsage = $peminjamanQuery->select('ruangan_id', DB::raw('COUNT(*) as count'))
                    ->groupBy('ruangan_id')->orderBy('count', 'desc')->with('ruangan')->first();
                $proyektorUsage = $peminjamanQuery->whereNotNull('projector_id')
                    ->select('projector_id', DB::raw('COUNT(*) as count'))
                    ->groupBy('projector_id')->orderBy('count', 'desc')->with('projector')->first();

                $stats = [
                    'Total Peminjaman' => $peminjamanQuery->count(),
                    'Ruangan Terpopuler' => $ruanganUsage->ruangan->nama_ruangan ?? 'N/A',
                    'Proyektor Terpopuler' => $proyektorUsage->projector->kode_proyektor ?? 'N/A',
                    'Pengguna Aktif' => $peminjamanQuery->distinct('user_id')->count()
                ];

                $distribusiRuangan = Peminjaman::whereBetween('tanggal', [$startDate, $endDate])->select('ruangan_id', DB::raw('COUNT(*) as count'))
                    ->groupBy('ruangan_id')->with('ruangan')->get();

                $distributionChartData = [
                    'labels' => $distribusiRuangan->map(fn($item) => $item->ruangan->nama_ruangan ?? 'N/A'),
                    'data' => $distribusiRuangan->pluck('count')
                ];
                $uiConfig = [
                    'stat_titles' => ['Total Peminjaman', 'Ruangan Terpopuler', 'Proyektor Terpopuler', 'Pengguna Aktif'],
                    'chart_titles' => ['Peminjaman Bulanan', 'Distribusi Peminjaman per Ruangan']
                ];
                break;

            case 'inventaris':
                $stats = [
                    'Total Ruangan' => Ruangan::count(),
                    'Ruangan Tersedia' => Ruangan::where('status', 'Tersedia')->count(),
                    'Total Proyektor' => Projector::count(),
                    'Proyektor Tersedia' => Projector::where('status', 'tersedia')->count(),
                ];
                $statusRuangan = Ruangan::select('status', DB::raw('COUNT(*) as count'))->groupBy('status')->pluck('count', 'status');
                $statusProyektor = Projector::select('status', DB::raw('COUNT(*) as count'))->groupBy('status')->pluck('count', 'status');

                $monthlyChartData = $statusRuangan->values()->all();
                $distributionChartData = [
                    'labels' => $statusProyektor->keys()->all(),
                    'data' => $statusProyektor->values()->all()
                ];
                $uiConfig = [
                    'stat_titles' => ['Total Ruangan', 'Ruangan Tersedia', 'Total Proyektor', 'Proyektor Tersedia'],
                    'chart_titles' => ['Status Ruangan', 'Status Proyektor']
                ];
                break;

            case 'pengguna':
                $userQuery = User::whereHas('peminjaman', fn($q) => $q->whereBetween('tanggal', [$startDate, $endDate]));
                $topUser = User::withCount('peminjaman')->orderBy('peminjaman_count', 'desc')->first();

                $stats = [
                    'Total Pengguna' => User::count(),
                    'Pengguna Aktif' => $userQuery->count(),
                    'Pengguna Baru' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
                    'Peminjam Teratas' => $topUser->name ?? 'N/A'
                ];
                $top10Users = User::withCount('peminjaman')->orderBy('peminjaman_count', 'desc')->take(10)->get();
                $monthlyChartData = $top10Users->pluck('peminjaman_count')->all();
                $distributionChartData = [
                    'labels' => $top10Users->pluck('name')->all(),
                    'data' => $top10Users->pluck('peminjaman_count')->all()
                ];
                $uiConfig = [
                    'stat_titles' => ['Total Pengguna', 'Pengguna Aktif', 'Pengguna Baru', 'Peminjam Teratas'],
                    'chart_titles' => ['Top 10 Peminjam', 'Distribusi Peminjaman Pengguna']
                ];
                break;

            case 'peminjaman':
            default:
                $peminjamanQuery = Peminjaman::whereBetween('tanggal', [$startDate, $endDate]);
                $stats = [
                    'Total Peminjaman' => $peminjamanQuery->count(),
                    'Barang Dipinjam' => $peminjamanQuery->clone()->whereIn('status', ['disetujui', 'selesai'])->count(),
                    'Pengguna Aktif' => $peminjamanQuery->clone()->distinct('user_id')->count('user_id'),
                    'Barang Rusak' => Pengembalian::whereBetween('created_at', [$startDate, $endDate])
                        ->where(fn($q) => $q->where('kondisi_ruang', 'like', 'rusak%')->orWhere('kondisi_proyektor', 'like', 'rusak%'))->count()
                ];

                $monthlyData = Peminjaman::select(DB::raw('MONTH(tanggal) as month'), DB::raw('COUNT(*) as count'))
                    ->whereYear('tanggal', $year)->groupBy('month')->orderBy('month')->pluck('count', 'month')->all();
                for ($m = 1; $m <= 12; $m++) {
                    $monthlyChartData[] = $monthlyData[$m] ?? 0;
                }

                $distribusiData = Peminjaman::whereBetween('tanggal', [$startDate, $endDate])->select(
                    DB::raw('SUM(CASE WHEN projector_id IS NOT NULL THEN 1 ELSE 0 END) as proyektor'),
                    DB::raw('SUM(CASE WHEN projector_id IS NULL THEN 1 ELSE 0 END) as ruangan_saja')
                )->first();
                $distributionChartData = [
                    'labels' => ['Dengan Proyektor', 'Ruangan Saja'],
                    'data' => [$distribusiData->proyektor ?? 0, $distribusiData->ruangan_saja ?? 0]
                ];
                $uiConfig = [
                    'stat_titles' => ['Total Peminjaman', 'Barang Dipinjam', 'Pengguna Aktif', 'Barang Rusak'],
                    'chart_titles' => ['Peminjaman Bulanan', 'Distribusi Peminjaman']
                ];
                break;
        }

        $recentActivity = Peminjaman::with('user', 'ruangan')->orderBy('created_at', 'desc')->take(5)
            ->get()->map(fn($item) => [
                'title' => 'Peminjaman ' . $item->status,
                'description' => ($item->user->name ?? 'User') . ' meminjam ' . ($item->ruangan->nama_ruangan ?? 'ruangan'),
                'time' => $item->created_at->diffForHumans(),
                'status' => $item->status
            ]);

        return response()->json([
            'stats' => $stats,
            'monthlyChart' => $monthlyChartData,
            'distributionChart' => $distributionChartData,
            'recentActivity' => $recentActivity,
            'uiConfig' => $uiConfig
        ]);
    }
}
