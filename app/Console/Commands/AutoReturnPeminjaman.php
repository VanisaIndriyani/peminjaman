<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman;
use App\Models\Mobil;

class AutoReturnPeminjaman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-return-peminjaman';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->toDateString();
        $peminjamans = Peminjaman::where('status', 'dipinjam')
            ->where('tanggal_kembali', '<=', $today)
            ->get();

        $count = 0;
        foreach ($peminjamans as $peminjaman) {
            $peminjaman->status = 'kembali';
            $peminjaman->save();
            $mobil = $peminjaman->mobil;
            if ($mobil) {
                $mobil->status = 'tersedia';
                $mobil->save();
            }
            $count++;
        }
        $this->info("Auto update selesai. $count peminjaman diubah menjadi kembali.");
    }
}
