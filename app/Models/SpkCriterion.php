<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpkCriterion extends Model
{
    protected $table = 'spk_criteria';
    protected $fillable = ['kode', 'nama', 'jenis'];

    public function penilaian()
    {
        return $this->hasMany(SpkPenilaian::class, 'criterion_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('kode');
    }
}
