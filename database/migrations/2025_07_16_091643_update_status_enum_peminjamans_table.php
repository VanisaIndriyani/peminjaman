<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::statement("ALTER TABLE peminjamans MODIFY status ENUM('menunggu_pembayaran','dipinjam','kembali','ditolak','disetujui') DEFAULT 'menunggu_pembayaran'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::statement("ALTER TABLE peminjamans MODIFY status ENUM('dipinjam','kembali','ditolak','disetujui') DEFAULT 'dipinjam'");
    }
};
