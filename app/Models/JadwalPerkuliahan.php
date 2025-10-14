<?php
// app/Models/JadwalPerkuliahan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPerkuliahan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan model
     */
    protected $table = 'jadwal_perkuliahan';

    /**
     * Kolom yang boleh diisi secara mass-assignment
     */
    protected $fillable = [
        'kode_matkul',
        'sistem_kuliah',
        'nama_kelas',
        'kelas_mahasiswa',
        'sebaran_mahasiswa',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'daya_tampung',
    ];

    /**
     * Scope untuk filter pencarian dinamis.
     */
    public function scopeFilter($query, array $filters)
    {
        // 🔍 Pencarian bebas (search)
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('kode_matkul', 'like', "%{$search}%")
                  ->orWhere('nama_kelas', 'like', "%{$search}%")
                  ->orWhere('ruangan', 'like', "%{$search}%")
                  ->orWhere('kelas_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('hari', 'like', "%{$search}%");
            });
        }

        // 📅 Filter berdasarkan hari
        if (!empty($filters['hari'])) {
            $query->where('hari', $filters['hari']);
        }

        // 🏫 Filter berdasarkan ruangan
        if (!empty($filters['ruangan'])) {
            $query->where('ruangan', $filters['ruangan']);
        }

        // 🧑‍💻 Filter berdasarkan sistem kuliah (Online/Offline/Hybrid)
        if (!empty($filters['sistem_kuliah'])) {
            $query->where('sistem_kuliah', $filters['sistem_kuliah']);
        }

        // 🎓 Filter berdasarkan daya tampung minimal
        if (!empty($filters['daya_tampung_min'])) {
            $query->where('daya_tampung', '>=', $filters['daya_tampung_min']);
        }

        // 🔢 Sorting (opsional - bisa aktifkan jika ingin built-in sorting)
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'matkul':
                    $query->orderBy('kode_matkul');
                    break;
                case 'kelas':
                    $query->orderBy('nama_kelas');
                    break;
                default:
                    $query->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
                          ->orderBy('jam_mulai');
                    break;
            }
        }

        return $query;
    }

    /**
     * Accessor opsional untuk menampilkan waktu kuliah gabungan.
     */
    public function getWaktuAttribute()
    {
        if ($this->jam_mulai && $this->jam_selesai) {
            return "{$this->jam_mulai} - {$this->jam_selesai}";
        }
        return null;
    }
}
