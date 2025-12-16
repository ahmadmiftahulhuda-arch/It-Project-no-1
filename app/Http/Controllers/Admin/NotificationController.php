<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    /**
     * Fetch all unread notifications for the authenticated user.
     * Gathers pending loans and returns.
     */
    public function index()
    {
        $peminjamanNotifications = Peminjaman::with('user', 'ruangan')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $pengembalianNotifications = Pengembalian::with('peminjaman.user', 'peminjaman.ruangan')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $notifications = [];

        foreach ($peminjamanNotifications as $peminjaman) {
            $notifications[] = [
                'id' => 'p-' . $peminjaman->id,
                'type' => 'info',
                'icon' => 'fa-hand-holding',
                'title' => 'Peminjaman Baru',
                'message' => ($peminjaman->user->name ?? 'User') . ' perlu persetujuan untuk peminjaman di ' . ($peminjaman->ruangan->nama_ruangan ?? $peminjaman->ruang) . '.',
                'time' => Carbon::parse($peminjaman->created_at)->diffForHumans(),
                'read' => false,
                'url' => route('admin.peminjaman.index') . '?status=pending',
            ];
        }

        foreach ($pengembalianNotifications as $pengembalian) {
            $notifications[] = [
                'id' => 'g-' . $pengembalian->id,
                'type' => 'success',
                'icon' => 'fa-undo',
                'title' => 'Pengembalian Masuk',
                'message' => (optional($pengembalian->peminjaman->user)->name ?? 'User') . ' mengajukan pengembalian untuk ' . (optional($pengembalian->peminjaman->ruangan)->nama_ruangan ?? optional($pengembalian->peminjaman)->ruang) . '.',
                'time' => Carbon::parse($pengembalian->created_at)->diffForHumans(),
                'read' => false,
                'url' => url('/admin/pengembalian?status=pending'),
            ];
        }

        // Sort notifications by time (newest first)
        usort($notifications, function ($a, $b) {
            return strtotime($b['time']) <=> strtotime($a['time']);
        });
        
        $unreadCount = count($notifications);

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Mark all notifications as read.
     * This is a placeholder as there's no "read" status in the database yet.
     */
    public function markAllAsRead()
    {
        // In a real implementation with a notifications table, you would update the database here.
        // For now, we just return a success response as the "read" state is handled client-side.
        return response()->json(['message' => 'Semua notifikasi ditandai sebagai telah dibaca.']);
    }

    /**
     * Clear all notifications.
     * This is a placeholder.
     */
    public function clearAll()
    {
        // In a real implementation, you might delete notifications from a dedicated table.
        // For now, we can't delete the source (loans/returns), so we just return a success message.
        return response()->json(['message' => 'Semua notifikasi telah dihapus.']);
    }

    /**
     * Mark a specific notification as read.
     * This is a placeholder.
     */
    public function markAsRead($id)
    {
        // Placeholder. The read status is managed on the client side.
        return response()->json(['message' => "Notifikasi #{$id} ditandai sebagai telah dibaca."]);
    }

    /**
     * Display all notifications on a dedicated page.
     */
    public function all()
    {
        $peminjamanNotifications = Peminjaman::with('user', 'ruangan')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $pengembalianNotifications = Pengembalian::with('peminjaman.user', 'peminjaman.ruangan')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $notifications = [];

        foreach ($peminjamanNotifications as $peminjaman) {
            $notifications[] = [
                'id' => 'p-' . $peminjaman->id,
                'type' => 'info',
                'icon' => 'fa-hand-holding',
                'title' => 'Peminjaman Baru',
                'message' => ($peminjaman->user->name ?? 'User') . ' perlu persetujuan untuk peminjaman di ' . ($peminjaman->ruangan->nama_ruangan ?? $peminjaman->ruang) . '.',
                'time' => Carbon::parse($peminjaman->created_at)->diffForHumans(),
                'read' => false,
                'url' => route('admin.peminjaman.index') . '?status=pending',
            ];
        }

        foreach ($pengembalianNotifications as $pengembalian) {
            $notifications[] = [
                'id' => 'g-' . $pengembalian->id,
                'type' => 'success',
                'icon' => 'fa-undo',
                'title' => 'Pengembalian Masuk',
                'message' => (optional($pengembalian->peminjaman->user)->name ?? 'User') . ' mengajukan pengembalian untuk ' . (optional($pengembalian->peminjaman->ruangan)->nama_ruangan ?? optional($pengembalian->peminjaman)->ruang) . '.',
                'time' => Carbon::parse($pengembalian->created_at)->diffForHumans(),
                'read' => false,
                'url' => url('/admin/pengembalian?status=pending'),
            ];
        }

        // Sort notifications by time (newest first)
        usort($notifications, function ($a, $b) {
            return strtotime($b['time']) <=> strtotime($a['time']);
        });

        return view('admin.notifications.all', ['notifications' => $notifications]);
    }
}
