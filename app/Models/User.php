<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Peminjaman;
use App\Models\Feedback;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'password',
        'verified',
        'nim',
        'peran',
        'jurusan',
        'status',
        'tanggal_bergabung',
        'two_factor_enabled',
        'notification_preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'two_factor_enabled' => 'boolean',
        'notification_preferences' => 'array',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function feedback()
    {
        return $this->hasManyThrough(Feedback::class, Peminjaman::class);
    }

    /**
     * Accessor for getting the display name without numbers.
     *
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        // Removes all numeric characters and trims whitespace
        return trim(preg_replace('/[0-9]/', '', $this->name));
    }
}
