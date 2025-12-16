<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Pengembalian; // Import Pengembalian model
use App\Models\User; // Import User model
use Illuminate\Support\Carbon;

class PengembalianBaruNotification extends Notification
{
    use Queueable;

    protected $pengembalian;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pengembalian $pengembalian)
    {
        $this->pengembalian = $pengembalian;
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
        // Get user name and room name, handling potential nulls for safety
        $userName = optional($this->pengembalian->peminjaman->user)->name ?? 'Pengguna tidak dikenal';
        $roomName = optional($this->pengembalian->peminjaman->ruangan)->nama_ruangan ?? 'Ruangan tidak dikenal';

        return [
            'id' => 'g-' . $this->pengembalian->id,
            'type' => 'success', // Assuming pengembalian is a 'success' type of notification
            'icon' => 'fa-undo',
            'title' => 'Pengembalian Masuk',
            'message' => "{$userName} mengajukan pengembalian untuk {$roomName}.",
            'time' => Carbon::parse($this->pengembalian->created_at)->diffForHumans(),
            'url' => url('/admin/pengembalian?status=pending'),
            'pengembalian_id' => $this->pengembalian->id,
        ];
    }
}
