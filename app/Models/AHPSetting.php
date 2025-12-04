<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AHPSetting extends Model
{
    protected $table = 'ahp_settings';

    protected $fillable = [
        'criteria',
        'weight'
    ];

    public $timestamps = true;
}
