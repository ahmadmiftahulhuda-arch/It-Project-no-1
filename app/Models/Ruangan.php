<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JadwalPerkuliahan;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'kapasitas',
        'status',
    ];

    /**
     * Relasi ke jadwal perkuliahan yang menggunakan ruangan ini.
     * Karena tabel `jadwal_perkuliahan` menyimpan nama ruangan di kolom `ruangan`,
     * kita gunakan foreignKey `ruangan` dan localKey `nama_ruangan`.
     */
    public function jadwals()
    {
        return $this->hasMany(JadwalPerkuliahan::class, 'ruangan', 'nama_ruangan');
    }
}