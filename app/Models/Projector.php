<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projector extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_proyektor',
        'merk',
        'model',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk filter status
    public function scopeStatus($query, $status)
    {
        if ($status && in_array($status, ['tersedia', 'dipinjam', 'rusak'])) {
            return $query->where('status', $status);
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('kode_proyektor', 'like', "%{$search}%")
                  ->orWhere('merk', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    // Scope untuk merk
    public function scopeMerk($query, $merk)
    {
        if ($merk) {
            return $query->where('merk', $merk);
        }
        return $query;
    }

    // Scope untuk sorting
    public function scopeSort($query, $sort)
    {
        switch ($sort) {
            case 'oldest':
                return $query->orderBy('created_at', 'asc');
            case 'kode':
                return $query->orderBy('kode_proyektor', 'asc');
            case 'merk':
                return $query->orderBy('merk', 'asc');
            case 'newest':
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }

    // Method untuk mendapatkan semua merk unik
    public static function getMerks()
    {
        return static::distinct()->whereNotNull('merk')->pluck('merk')->toArray();
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'tersedia' => 'status-tersedia',
            'dipinjam' => 'status-dipinjam',
            'rusak' => 'status-rusak'
        ];

        return $statuses[$this->status] ?? 'status-tersedia';
    }

    // Accessor untuk status text
    public function getStatusTextAttribute()
    {
        $statuses = [
            'tersedia' => 'Tersedia',
            'dipinjam' => 'Dipinjam',
            'rusak' => 'Rusak'
        ];

        return $statuses[$this->status] ?? 'Tersedia';
    }
}