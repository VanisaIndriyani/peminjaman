<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Mobil;
use Illuminate\Support\Carbon;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $mobils = Mobil::all();
        $statuses = ['dipinjam', 'kembali'];
        $now = now();
        $i = 0;
        foreach ($mobils as $mobil) {
            Peminjaman::create([
                'user_id' => $user->id,
                'mobil_id' => $mobil->id,
                'tanggal_pinjam' => $now->copy()->subDays(rand(1, 30))->format('Y-m-d'),
                'tanggal_kembali' => $now->copy()->subDays(rand(0, 10))->format('Y-m-d'),
                'status' => $statuses[$i % 2],
            ]);
            $i++;
        }
    }
}
