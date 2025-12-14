<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpkAlternative extends Model
{
    protected $table = 'spk_alternatives';

    protected $fillable = [
    'nama',
    'k1',
    'k2',
    'k3',
    'k4',
    'k5',
    'nilai_preferensi',
    ];
}
