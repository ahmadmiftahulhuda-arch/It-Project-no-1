<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'model_barang',
        'merek_barang',
        'keterangan_barang',
        'status_barang',
    ];
}
