<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel di database (supaya tidak salah jadi 'peminjamen')
    protected $table = 'peminjamans';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'user_id',
        'tanggal',
        'ruang',
        'proyektor',
        'ruangan_id',
        'projector_id',
        'keperluan',
        'dosen_nip',
        'status',
        'waktu_mulai',
        'waktu_selesai',
        'status_pengembalian', // <-- Ditambahkan
        'tanggal_kembali',      // <-- Ditambahkan
        'kondisi_kembali',      // <-- Ditambahkan
        'keterangan_kembali',    // <-- Ditambahkan
        'nilai_preferensi'
    ];

    public function spkPenilaian()
    {
        return $this->hasMany(\App\Models\SpkPenilaian::class, 'peminjaman_id');
    }

    /**
     * Relasi ke Pengembalian
     * Setiap peminjaman memiliki satu proses pengembalian.
     */
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    // Default values untuk waktu
    protected $attributes = [
        'waktu_mulai' => '08:00:00',
        'waktu_selesai' => '17:00:00',
    ];

    /**
     * Relasi ke User
     * Setiap peminjaman dimiliki oleh 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Ruangan
     * Setiap peminjaman terhubung ke 1 ruangan
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    /**
     * Relasi ke Projector
     * Setiap peminjaman terhubung ke 1 proyektor
     */
    public function projector()
    {
        return $this->belongsTo(Projector::class, 'projector_id');
    }

    /**
     * Relasi ke Dosen (pengampu mata kuliah)
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_nip', 'nip');
    }

    // Scope untuk riwayat
    public function scopeRiwayat($query)
    {
        return $query->whereHas('pengembalian')
            ->orWhereIn('status', ['ditolak', 'selesai', 'proses-pengembalian']);
    }

    // Scope untuk peminjaman aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'disetujui')
            ->whereDoesntHave('pengembalian');
    }

    /**
     * Relasi ke Feedback
     * Setiap peminjaman memiliki satu feedback.
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'peminjaman_id');
    }

    /**
     * Tampilkan waktu mulai dalam format H:i (tanpa detik)
     */
    public function getDisplayWaktuMulaiAttribute()
    {
        if (!$this->waktu_mulai) return null;
        // Normalize strings like '07:30:00' or '07:30'
        return substr($this->waktu_mulai, 0, 5);
    }

    /**
     * Tampilkan waktu selesai dalam format H:i (tanpa detik)
     */
    public function getDisplayWaktuSelesaiAttribute()
    {
        if (!$this->waktu_selesai) return null;
        return substr($this->waktu_selesai, 0, 5);
    }

    /**
     * Apakah peminjaman sedang berlangsung sekarang?
     * - Menggunakan tanggal + waktu_mulai/waktu_selesai jika tersedia
     * - Fallback: apabila tanggal adalah hari ini, bandingkan H:i string
     */
    public function getIsOngoingAttribute()
    {
        $now = Carbon::now();

        // Build start/end datetimes if possible
        try {
            $start = $this->waktu_mulai ? Carbon::parse($this->tanggal . ' ' . $this->waktu_mulai) : null;
        } catch (\Exception $e) {
            $start = null;
        }

        try {
            $end = $this->waktu_selesai ? Carbon::parse($this->tanggal . ' ' . $this->waktu_selesai) : null;
        } catch (\Exception $e) {
            $end = null;
        }

        if ($this->status === 'disetujui' && $start) {
            // If current time is within the booking window → ongoing
            if ($end && $now->between($start, $end)) return true;
            // If booking has started and ended but user hasn't submitted pengembalian,
            // keep it considered 'ongoing' (still in use) until pengembalian is recorded.
            if ($end && $now->gt($end) && !$this->pengembalian) return true;
            // If no explicit end time, consider ongoing once started
            if (!$end && $now->gte($start) && !$this->pengembalian) return true;
        }

        // Fallback: if booking is today, compare H:i strings
        try {
            $tanggal = Carbon::parse($this->tanggal);
        } catch (\Exception $e) {
            return false;
        }

        if ($this->status === 'disetujui' && $tanggal->isToday() && $this->waktu_mulai && $this->waktu_selesai) {
            $nowTime = $now->format('H:i');
            $startTime = substr($this->waktu_mulai, 0, 5);
            $endTime = substr($this->waktu_selesai, 0, 5);
            return ($nowTime >= $startTime && $nowTime <= $endTime);
        }

        return false;
    }
}
