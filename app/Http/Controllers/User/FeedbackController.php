<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Auth::user()->feedback()->latest()->paginate(10);
        return view('user.feedback.index', compact('feedbacks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'kategori' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'judul' => 'required|string|max:255',
            'detail_feedback' => 'required|string',
            'saran_perbaikan' => 'nullable|string',
        ]);

        // Ensure the user owns the peminjaman
        $peminjaman = \App\Models\Peminjaman::where('id', $request->peminjaman_id)
                                        ->where('user_id', Auth::id())
                                        ->firstOrFail();

        Feedback::create([
            'user_id' => Auth::id(),
            'peminjaman_id' => $peminjaman->id,
            'kategori' => $request->kategori,
            'rating' => $request->rating,
            'judul' => $request->judul,
            'detail_feedback' => $request->detail_feedback,
            'saran_perbaikan' => $request->saran_perbaikan,
            'status' => 'baru', // Default status
        ]);

        return redirect()->route('user.feedback.index')->with('success', 'Terima kasih! Feedback Anda telah berhasil dikirim.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        // Ensure the user owns the feedback and it's still pending
        if ($feedback->user_id !== Auth::id() || $feedback->status !== 'pending') {
            abort(403);
        }

        return view('user.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        // Ensure the user owns the feedback and it's still pending
        if ($feedback->user_id !== Auth::id() || $feedback->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $feedback->update([
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('user.feedback.index')->with('success', 'Feedback berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        // Ensure the user owns the feedback
        if ($feedback->user_id !== Auth::id()) {
            abort(403);
        }

        $feedback->delete();

        return redirect()->route('user.feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
}
