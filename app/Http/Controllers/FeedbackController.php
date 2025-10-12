<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with('peminjaman')->get();
        $totalFeedback = $feedback->count();
        $averageRating = $feedback->avg('rating');
        $published = $feedback->where('status', 'Dipublikasikan')->count();
        $draft = $feedback->where('status', 'Draft')->count();

        return view('admin.feedback.index', compact('feedback', 'totalFeedback', 'averageRating', 'published', 'draft'));
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
            'status'        => 'required|in:Draft,Dipublikasikan',
        ]);

        Feedback::create($request->all());

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil ditambahkan');
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'detail_feedback' => 'required|string|max:1000',
            'saran_perbaikan' => 'nullable|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:Dipublikasikan,Draft',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'detail_feedback' => $request->detail_feedback,
            'saran_perbaikan' => $request->saran_perbaikan,
            'rating' => $request->rating,
            'status' => $request->status,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diupdate');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus');
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
        $draft = Feedback::where('status', 'Draft')->count();

        return view('admin.feedback.stats', compact('totalFeedback', 'averageRating', 'published', 'draft'));
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
                                 ->with('peminjaman') // Eager load peminjaman details
                                 ->latest() // Order by newest first
                                 ->paginate(10);

        return view('user.feedback.index', compact('feedbackItems'));
    }

    /**
     * Show the form for creating a new feedback for the logged-in user.
     */
    public function createForUser()
    {
        $user = Auth::user();
        
        // Get completed borrowings for the user that don't have feedback yet
        $peminjamans = Peminjaman::where('user_id', $user->id)
                                ->where('status', 'selesai')
                                ->whereDoesntHave('feedback')
                                ->with('ruangan', 'projector') // Eager load details
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
            'judul' => 'required|string|max:255',
            'detail_feedback' => 'required|string|max:1000',
            'saran_perbaikan' => 'nullable|string|max:1000',
        ]);

        // Check if feedback for this loan already exists
        $existingFeedback = Feedback::where('peminjaman_id', $request->peminjaman_id)->first();
        if ($existingFeedback) {
            return redirect()->back()->with('error', 'Anda sudah pernah memberikan feedback untuk peminjaman ini.');
        }

        // Additional check to ensure the user owns the peminjaman
        $peminjaman = Peminjaman::where('id', $request->peminjaman_id)
                                ->where('user_id', Auth::id())
                                ->firstOrFail(); // Fails if not found or not owned by user

        Feedback::create([
            'peminjaman_id' => $peminjaman->id,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'rating' => $request->rating,
            'detail_feedback' => $request->detail_feedback,
            'saran_perbaikan' => $request->saran_perbaikan,
            'status' => 'Draft',
        ]);

        return redirect()->route('user.peminjaman.riwayat')
                         ->with('success', 'Terima kasih! Feedback Anda telah berhasil dikirim.');
    }
}