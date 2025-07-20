<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peminjamans = Peminjaman::all();
        $statuses = ['diproses', 'selesai'];
        $now = now();
        $i = 0;
        foreach ($peminjamans as $peminjaman) {
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_pengembalian' => $now->copy()->subDays(rand(0, 10))->format('Y-m-d'),
                'denda' => rand(0, 1) ? 0 : rand(50000, 200000),
                'status' => $statuses[$i % 2],
            ]);
            $i++;
        }
    }
}
