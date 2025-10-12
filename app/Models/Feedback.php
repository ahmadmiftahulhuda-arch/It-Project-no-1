<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'peminjaman_id',
        'kategori',
        'rating',
        'judul',
        'detail_feedback',
        'saran_perbaikan',
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
}
