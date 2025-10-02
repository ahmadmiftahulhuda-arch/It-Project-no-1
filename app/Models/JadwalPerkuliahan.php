<?php
// app/Models/JadwalPerkuliahan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPerkuliahan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_perkuliahan';

    protected $fillable = [
        'hari',
        'waktu',
        'kode_matkul',
        'nama_matkul',
        'dosen',
        'kelas',
        'ruangan',
        'semester',
        'keterangan'
    ];

    // Scope untuk filter
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['search']) && $filters['search']) {
            $query->where(function($q) use ($filters) {
                $q->where('nama_matkul', 'like', '%'.$filters['search'].'%')
                  ->orWhere('dosen', 'like', '%'.$filters['search'].'%')
                  ->orWhere('kelas', 'like', '%'.$filters['search'].'%');
            });
        }

        if (isset($filters['hari']) && $filters['hari']) {
            $query->where('hari', $filters['hari']);
        }

        if (isset($filters['ruangan']) && $filters['ruangan']) {
            $query->where('ruangan', $filters['ruangan']);
        }

        if (isset($filters['semester']) && $filters['semester']) {
            $query->where('semester', $filters['semester']);
        }

        return $query;
    }
}