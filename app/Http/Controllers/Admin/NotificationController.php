<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Fetch all unread notifications for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications->map(function ($notification) {
            $data = $notification->data;
            return [
                'id' => $notification->id,
                'type' => $data['type'] ?? 'info',
                'icon' => $data['icon'] ?? 'fa-bell',
                'title' => $data['title'] ?? 'Notifikasi',
                'message' => $data['message'] ?? 'Anda memiliki notifikasi baru.',
                'time' => $notification->created_at->diffForHumans(),
                'read' => $notification->read_at !== null,
                'url' => $data['url'] ?? '#',
            ];
        });

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $user->unreadNotifications->count(),
        ]);
    }

    /**
     * Mark all unread notifications as read.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['message' => 'Semua notifikasi ditandai sebagai telah dibaca.']);
    }

    /**
     * Clear all notifications for the authenticated user.
     */
    public function clearAll()
    {
        $user = Auth::user();
        $user->notifications()->delete();

        return response()->json(['message' => 'Semua notifikasi telah dihapus.']);
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => "Notifikasi #{$id} ditandai sebagai telah dibaca."]);
        }

        return response()->json(['message' => "Notifikasi tidak ditemukan."], 404);
    }

    /**
     * Display all notifications on a dedicated page.
     */
    public function all()
    {
        $user = Auth::user();
        $notifications = $user->notifications->map(function ($notification) {
            $data = $notification->data;
            return [
                'id' => $notification->id,
                'type' => $data['type'] ?? 'info',
                'icon' => $data['icon'] ?? 'fa-bell',
                'title' => $data['title'] ?? 'Notifikasi',
                'message' => $data['message'] ?? 'Anda memiliki notifikasi baru.',
                'time' => $notification->created_at->diffForHumans(),
                'read' => $notification->read_at !== null,
                'url' => $data['url'] ?? '#',
            ];
        });

        return view('admin.notifications.all', ['notifications' => $notifications]);
    }
}
