<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'user_id',
        'peminjaman_id',
        'komentar',
        'rating',
        'status',
    ];

    /**
     * Relasi ke Peminjaman
     * Setiap feedback dimiliki oleh 1 peminjaman
     */
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    /**
     * Relasi ke User
     * Setiap feedback dimiliki oleh 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
