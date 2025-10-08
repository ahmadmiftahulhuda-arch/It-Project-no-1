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
        return view('admin.feedback.index', compact('feedback'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::with('barang')->get();
        return view('admin.feedback.create', compact('peminjaman'));
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
            'komentar' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:Dipublikasikan,Draft',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'komentar' => $request->komentar,
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
            'id_peminjaman' => 'required|exists:peminjamans,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        // Additional check to ensure the user owns the peminjaman
        $peminjaman = Peminjaman::where('id', $request->id_peminjaman)
                                ->where('user_id', Auth::id())
                                ->firstOrFail(); // Fails if not found or not owned by user

        Feedback::create([
            'id_peminjaman' => $peminjaman->id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tgl_feedback' => now(),
            'status' => 'Dipublikasikan',
        ]);

        return redirect()->route('user.feedback.create')
                         ->with('success', 'Terima kasih! Feedback Anda telah berhasil dikirim.');
    }
}