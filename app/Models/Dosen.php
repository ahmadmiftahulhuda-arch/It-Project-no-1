<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';
    
    // Primary key adalah NIP
    protected $primaryKey = 'nip';
    
    // Tipe data primary key adalah string
    protected $keyType = 'string';
    
    // Non-incrementing karena NIP string
    public $incrementing = false;
    
    // Hanya dua field yang diisi
    protected $fillable = [
        'nip',
        'nama_dosen'
    ];
    
    protected $casts = [
        'nip' => 'string'
    ];
}