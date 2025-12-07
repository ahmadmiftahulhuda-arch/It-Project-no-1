<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Ruangan;
use App\Models\Projector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Peminjaman::where('user_id', $userId);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('keperluan', 'like', "%{$search}%")
                  ->orWhere('ruang', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('user.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $pendingFeedbackCount = Peminjaman::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->whereDoesntHave('feedback')
            ->count();

        if ($pendingFeedbackCount > 0) {
            return redirect()->route('user.peminjaman.riwayat')
                ->with('error', 'Anda harus mengisi feedback dari peminjaman sebelumnya.');
        }

        $ruangan = Ruangan::all();

        // Ambil proyektor yang tersedia untuk dipilih (status 'tersedia')
        $projectors = Projector::where('status', 'tersedia')->get();

        return view('user.peminjaman.create', compact('ruangan', 'projectors'));
    }

    public function store(Request $request)
    {
        // Check if the user is verified
        if (!Auth::user()->verified) {
            return redirect()->back()->with('error', 'Akun Anda belum diverifikasi oleh admin. Anda tidak dapat membuat peminjaman.');
        }

        $request->validate([
            'tanggal'       => 'required|date',
            'ruangan_id'    => 'required|exists:ruangan,id',
            'projector_id'  => 'nullable|exists:projectors,id',
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'keperluan'     => 'required|string|max:255',
        ]);

        Peminjaman::create([
            'user_id'       => Auth::id(),
            'tanggal'       => $request->tanggal,
            'ruangan_id'    => $request->ruangan_id,
            'projector_id'  => $request->projector_id,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'keperluan'     => $request->keperluan,
            'status'        => 'pending',
        ]);

        return redirect()->route('user.peminjaman.index')->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())->findOrFail($id);
        return view('user.peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())->findOrFail($id);
        $ruangan = Ruangan::all();
        $projectors = Projector::where('status', 'tersedia')->get();
        return view('user.peminjaman.edit', compact('peminjaman', 'ruangan', 'projectors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'ruangan_id'    => 'required|exists:ruangan,id',
            'projector_id'  => 'nullable|exists:projectors,id',
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'keperluan'     => 'required|string|max:255',
        ]);

        $peminjaman = Peminjaman::where('user_id', Auth::id())->findOrFail($id);

        $peminjaman->update([
            'tanggal'       => $request->tanggal,
            'ruangan_id'    => $request->ruangan_id,
            'projector_id'  => $request->projector_id,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'keperluan'     => $request->keperluan,
        ]);

        return redirect()->route('user.peminjaman.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())->findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('user.peminjaman.index')->with('success', 'Data berhasil dihapus');
    }

    public function riwayat(Request $request)
    {
        $query = Peminjaman::with('feedback')
            ->where('user_id', Auth::id());

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('keperluan', 'like', "%{$search}%")
                  ->orWhere('ruang', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $riwayat = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('user.peminjaman.riwayat', compact('riwayat'));
    }

    public function pengembalianUser(Request $request)
    {
        $userId = Auth::id();

        $activeQuery = Peminjaman::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->whereDoesntHave('pengembalian')
            ->whereDate('tanggal', '<=', Carbon::now());

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $activeQuery->where(function ($q) use ($search) {
                $q->where('keperluan', 'like', "%{$search}%")
                  ->orWhere('ruang', 'like', "%{$search}%");
            });
        }

        $peminjamans = $activeQuery->orderBy('tanggal', 'desc')->get();

        $pengembalians = Pengembalian::whereHas('peminjaman', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->with('peminjaman')
        ->orderBy('created_at', 'desc')
        ->get();

        $pendingReturns = $peminjamans->count();
        $returnedCount = $pengembalians->count();

        $overdueCount = Peminjaman::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->whereDoesntHave('pengembalian')
            ->whereDate('tanggal', '<', Carbon::now())
            ->count();

        return view('user.pengembalian.index', compact(
            'peminjamans',
            'pengembalians',
            'pendingReturns',
            'returnedCount',
            'overdueCount'
        ));
    }

    public function ajukanPengembalian(Request $request, $id)
    {
        try {
            $userId = Auth::id();

            $request->validate([
                'kondisi_ruang' => 'required|in:baik,rusak_ringan,rusak_berat',
                'kondisi_proyektor' => 'nullable|in:baik,rusak_ringan,rusak_berat',
                'catatan' => 'nullable|string|max:500',
            ]);

            $peminjaman = Peminjaman::where('user_id', $userId)
                ->where('status', 'disetujui')
                ->whereDoesntHave('pengembalian')
                ->findOrFail($id);

            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'user_id' => $userId,
                'tanggal_pengembalian' => now(),
                'kondisi_ruang' => $request->kondisi_ruang,
                'kondisi_proyektor' => $request->kondisi_proyektor,
                'catatan' => $request->catatan,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan pengembalian berhasil diajukan.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function showPengembalian($id)
    {
        $pengembalian = Pengembalian::whereHas('peminjaman', function($q) {
            $q->where('user_id', Auth::id());
        })
        ->with('peminjaman')
        ->findOrFail($id);

        return view('user.pengembalian.show', compact('pengembalian'));
    }
}
