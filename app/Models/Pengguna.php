<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penggunas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'peran',
        'jurusan',
        'status',
        'tanggal_bergabung',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_bergabung' => 'date',
    ];

    /**
     * Scope untuk pengguna aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    /**
     * Scope untuk pengguna non-aktif
     */
    public function scopeNonAktif($query)
    {
        return $query->where('status', 'Non-Aktif');
    }

    /**
     * Scope untuk peran tertentu
     */
    public function scopePeran($query, $peran)
    {
        return $query->where('peran', $peran);
    }

    /**
     * Scope untuk jurusan tertentu
     */
    public function scopeJurusan($query, $jurusan)
    {
        return $query->where('jurusan', $jurusan);
    }
}