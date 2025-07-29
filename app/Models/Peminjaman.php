<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'mobil_id', 'tanggal_pinjam', 'tanggal_kembali', 'status',
        'foto_diri', 'ktp', 'kk', 'sim_a', 'ktp_penjamin', 'diskon', 'total_harga'
    ];

    protected $table = 'peminjamans';

    protected static function booted()
    {
        // Update status mobil saat peminjaman dibuat, diupdate, atau dihapus
        static::created(function ($peminjaman) {
            $peminjaman->updateMobilStatus();
        });

        static::updated(function ($peminjaman) {
            $peminjaman->updateMobilStatus();
        });

        static::deleted(function ($peminjaman) {
            $peminjaman->updateMobilStatus();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    /**
     * Update status mobil berdasarkan peminjaman aktif
     */
    public function updateMobilStatus()
    {
        if (!$this->mobil) return;

        // Cek apakah ada peminjaman aktif untuk mobil ini
        $peminjamanAktif = Peminjaman::where('mobil_id', $this->mobil_id)
            ->whereIn('status', ['menunggu_pembayaran', 'disetujui', 'dipinjam'])
            ->exists();

        // Update status mobil
        $this->mobil->status = $peminjamanAktif ? 'dipinjam' : 'tersedia';
        $this->mobil->save();
    }
} 