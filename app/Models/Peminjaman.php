<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel di database (supaya tidak salah jadi 'peminjamen')
    protected $table = 'peminjamans';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'user_id',
        'tanggal',
        'ruang',
        'proyektor',
        'keperluan',
        'status',
        'waktu_mulai',
        'waktu_selesai'
    ];

    /**
     * Relasi ke Pengembalian
     * Setiap peminjaman memiliki satu proses pengembalian.
     */
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    // Default values untuk waktu
    protected $attributes = [
        'waktu_mulai' => '08:00:00',
        'waktu_selesai' => '17:00:00',
    ];

    /**
     * Relasi ke User
     * Setiap peminjaman dimiliki oleh 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk riwayat
    public function scopeRiwayat($query)
    {
        return $query->whereHas('pengembalian')
                    ->orWhereIn('status', ['ditolak', 'selesai', 'proses-pengembalian']);
    }

    // Scope untuk peminjaman aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'disetujui')
                    ->whereDoesntHave('pengembalian');
    }
}