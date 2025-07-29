<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Mobil;
use App\Models\Peminjaman;

echo "Memulai update status mobil...\n";

$mobils = Mobil::all();
$updatedCount = 0;

foreach ($mobils as $mobil) {
    // Cek apakah ada peminjaman aktif untuk mobil ini
    $peminjamanAktif = Peminjaman::where('mobil_id', $mobil->id)
        ->whereIn('status', ['menunggu_pembayaran', 'disetujui', 'dipinjam'])
        ->exists();

    $newStatus = $peminjamanAktif ? 'dipinjam' : 'tersedia';
    
    if ($mobil->status !== $newStatus) {
        $oldStatus = $mobil->status;
        $mobil->status = $newStatus;
        $mobil->save();
        $updatedCount++;
        echo "Mobil {$mobil->nama} ({$mobil->plat_nomor}) status diubah dari '{$oldStatus}' ke '{$newStatus}'\n";
    }
}

echo "Update selesai. {$updatedCount} mobil diperbarui.\n"; 