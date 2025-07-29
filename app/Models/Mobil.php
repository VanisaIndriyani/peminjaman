<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'merk', 'tahun', 'plat_nomor', 'harga_sewa', 'status', 'foto'
    ];

    /**
     * Cek apakah mobil tersedia pada rentang tanggal tertentu
     */
    public function isAvailableForDateRange($tanggalPinjam, $tanggalKembali)
    {
        // Cek apakah ada peminjaman yang overlap dengan rentang tanggal
        $overlappingPeminjaman = Peminjaman::where('mobil_id', $this->id)
            ->where(function($query) use ($tanggalPinjam, $tanggalKembali) {
                $query->where(function($q) use ($tanggalPinjam, $tanggalKembali) {
                    // Peminjaman yang dimulai sebelum tanggal kembali dan berakhir setelah tanggal pinjam
                    $q->where('tanggal_pinjam', '<=', $tanggalKembali)
                      ->where('tanggal_kembali', '>=', $tanggalPinjam);
                });
            })
            ->whereIn('status', ['menunggu_pembayaran', 'disetujui', 'dipinjam'])
            ->exists();

        return !$overlappingPeminjaman;
    }

    /**
     * Cek apakah mobil tersedia pada tanggal tertentu
     */
    public function isAvailableForDate($tanggal)
    {
        return $this->isAvailableForDateRange($tanggal, $tanggal);
    }

    /**
     * Get peminjaman yang aktif
     */
    public function peminjamanAktif()
    {
        return $this->hasMany(Peminjaman::class)->whereIn('status', ['menunggu_pembayaran', 'disetujui', 'dipinjam']);
    }
} 