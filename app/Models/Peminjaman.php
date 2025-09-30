<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman'; 
    protected $primaryKey = 'id_peminjaman'; 
    protected $fillable = [
        'nama_peminjam',
        'tgl_pinjam',
        // tambahkan field lain sesuai tabel
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'id_peminjaman', 'id_peminjaman');
    }
}
