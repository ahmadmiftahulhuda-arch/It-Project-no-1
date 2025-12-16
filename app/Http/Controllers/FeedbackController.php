<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::with('peminjaman.user');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('kategori', 'like', '%' . $search . '%')
                  ->orWhere('detail_feedback', 'like', '%' . $search . '%')
                  ->orWhereHas('peminjaman.user', function ($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($request->input('status') === 'published') {
            $query->where('status', 'Dipublikasikan');
        } elseif ($request->input('status') === 'draft') {
            $query->where('status', 'Draft');
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->input('rating'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        // Use withQueryString() to append filter parameters to pagination links
        $feedback = $query->latest()->paginate(10)->withQueryString();

        // Calculate stats for the entire dataset
        $totalFeedback = Feedback::count();
        $averageRating = Feedback::avg('rating');
        $published = Feedback::where('status', 'Dipublikasikan')->count();
        $draft = Feedback::whereIn('status', ['Draft', 'baru'])->count();

        return view('admin.feedback.index', compact(
            'feedback',
            'totalFeedback',
            'averageRating',
            'published',
            'draft'
        ));
    }

    public function create(Peminjaman $peminjaman)
    {
        return view('user.feedback.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id_peminjaman',
            'komentar'      => 'required|string',
            'tgl_feedback'  => 'required|date',
            'rating'        => 'required|integer|min:1|max:5',
            // 'status'        => 'required|in:Draft,Dipublikasikan', // Removed status validation
        ]);

        $feedbackData = $request->all();
        $feedbackData['status'] = 'Draft'; // Set status to Draft

        Feedback::create($feedbackData);

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil ditambahkan');
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string',
            'detail_feedback' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:Dipublikasikan,Draft',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'kategori' => $request->kategori,
            'detail_feedback' => $request->detail_feedback,
            'rating' => $request->rating,
            'status' => $request->status,
        ]);

        // Untuk AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Feedback berhasil diupdate'
            ]);
        }

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil diupdate');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil dihapus');
    }

    public function show($id)
    {
        $feedback = Feedback::with('peminjaman')->findOrFail($id);
        return view('admin.feedback.show', compact('feedback'));
    }

    public function stats()
    {
        $totalFeedback = Feedback::count();
        $averageRating = Feedback::avg('rating');
        $published = Feedback::where('status', 'Dipublikasikan')->count();
        $draft = Feedback::whereIn('status', ['Draft', 'baru'])->count();

        return view('admin.feedback.stats', compact('totalFeedback', 'averageRating', 'published', 'draft'));
    }

    // Method untuk mengambil data feedback dalam format JSON (untuk modal)
    public function getFeedbackData($id)
    {
        try {
            $feedback = Feedback::with('peminjaman.user')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $feedback->id,
                    'peminjaman_id' => $feedback->peminjaman_id,
                    'nama_peminjam' => $feedback->peminjaman->user->name ?? '-',
                    'kategori' => $feedback->kategori,
                    'detail_feedback' => $feedback->detail_feedback,
                    'rating' => $feedback->rating,
                    'status' => $feedback->status,
                    'created_at' => $feedback->created_at->format('d M Y'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    // ===============================================
    // USER FEEDBACK METHODS
    // ===============================================

    /**
     * Display a listing of the feedback for the logged-in user.
     */
    public function indexForUser(Request $request)
    {
        $feedbackItems = Feedback::where('user_id', Auth::id())
                                 ->with('peminjaman')
                                 ->latest()
                                 ->paginate(10);

        return view('user.feedback.index', compact('feedbackItems'));
    }

    /**
     * Show the form for creating a new feedback for the logged-in user.
     */
    public function createForUser()
    {
        $user = Auth::user();
        
        $peminjamans = Peminjaman::where('user_id', $user->id)
                                ->where('status', 'selesai')
                                ->whereDoesntHave('feedback')
                                ->with('ruangan', 'projector')
                                ->get();

        return view('user.feedback.create', compact('peminjamans'));
    }

    /**
     * Store a newly created feedback from the user.
     */
    public function storeForUser(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'rating' => 'required|integer|min:1|max:5',
            'kategori' => 'required|string',
            'detail_feedback' => 'required|string|max:1000',
        ]);

        $existingFeedback = Feedback::where('peminjaman_id', $request->peminjaman_id)->first();
        if ($existingFeedback) {
            return redirect()->back()->with('error', 'Anda sudah pernah memberikan feedback untuk peminjaman ini.');
        }

        $peminjaman = Peminjaman::where('id', $request->peminjaman_id)
                                ->where('user_id', Auth::id())
                                ->firstOrFail();

        Feedback::create([
            'peminjaman_id' => $peminjaman->id,
            'kategori' => $request->kategori,
            'rating' => $request->rating,
            'detail_feedback' => $request->detail_feedback,
            'status' => 'Draft',
        ]);

        return redirect()->route('user.peminjaman.riwayat')
                         ->with('success', 'Terima kasih! Feedback Anda telah berhasil dikirim.');
    }
}