<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Peminjaman; // Import Peminjaman model
use App\Models\User; // Import User model
use Illuminate\Support\Carbon;

class PeminjamanBaruNotification extends Notification
{
    use Queueable;

    protected $peminjaman;

    /**
     * Create a new notification instance.
     */
    public function __construct(Peminjaman $peminjaman)
    {
        $this->peminjaman = $peminjaman;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // We will store this notification in the database
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // Get user name, handling potential null user for safety
        $userName = $this->peminjaman->user ? $this->peminjaman->user->name : 'Pengguna tidak dikenal';
        // Get room name, handling potential null room for safety
        $roomName = $this->peminjaman->ruangan ? $this->peminjaman->ruangan->nama_ruangan : 'Ruangan tidak dikenal';

        return [
            'id' => 'p-' . $this->peminjaman->id,
            'type' => 'info',
            'icon' => 'fa-hand-holding',
            'title' => 'Peminjaman Baru',
            'message' => "{$userName} perlu persetujuan untuk peminjaman di {$roomName}.",
            'time' => Carbon::parse($this->peminjaman->created_at)->diffForHumans(),
            'url' => route('admin.peminjaman.index') . '?status=pending',
            'peminjaman_id' => $this->peminjaman->id,
        ];
    }
}
