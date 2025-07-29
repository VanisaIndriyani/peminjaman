<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mobil;
use App\Models\Peminjaman;
use Carbon\Carbon;

class UpdateMobilStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mobil:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status mobil berdasarkan peminjaman aktif';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai update status mobil...');

        $mobils = Mobil::all();
        $updatedCount = 0;

        foreach ($mobils as $mobil) {
            // Cek apakah ada peminjaman aktif untuk mobil ini
            $peminjamanAktif = Peminjaman::where('mobil_id', $mobil->id)
                ->whereIn('status', ['menunggu_pembayaran', 'disetujui', 'dipinjam'])
                ->exists();

            $newStatus = $peminjamanAktif ? 'dipinjam' : 'tersedia';
            
            if ($mobil->status !== $newStatus) {
                $mobil->status = $newStatus;
                $mobil->save();
                $updatedCount++;
                $this->info("Mobil {$mobil->nama} ({$mobil->plat_nomor}) status diubah dari '{$mobil->status}' ke '{$newStatus}'");
            }
        }

        $this->info("Update selesai. {$updatedCount} mobil diperbarui.");
    }
}
