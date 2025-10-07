<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    use HasFactory;

    protected $fillable = ['id_slot', 'waktu'];

    /**
     * Scope untuk pencarian berdasarkan waktu
     */
    public function scopeSearchByTime($query, $time)
    {
        return $query->where('waktu', 'LIKE', '%' . $time . '%');
    }

    /**
     * Scope untuk pencarian berdasarkan ID slot
     */
    public function scopeSearchById($query, $id)
    {
        return $query->where('id_slot', 'LIKE', '%' . $id . '%');
    }
}