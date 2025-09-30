<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_peminjaman',
        'komentar',
        'tgl_feedback',
        'rating',
        'status',
    ];

    // Relasi ke tabel peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
}
