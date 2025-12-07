<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpkPenilaian extends Model
{
    protected $table = 'spk_penilaian';
    protected $fillable = [
        'peminjaman_id',
        'criterion_id',
        'nilai'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function criterion()
    {
        return $this->belongsTo(SpkCriterion::class, 'criterion_id');
    }
}
