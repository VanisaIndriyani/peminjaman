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
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->string('foto_diri')->nullable();
            $table->string('ktp')->nullable();
            $table->string('kk')->nullable();
            $table->string('sim_a')->nullable();
            $table->string('ktp_penjamin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn(['foto_diri', 'ktp', 'kk', 'sim_a', 'ktp_penjamin']);
        });
    }
};
