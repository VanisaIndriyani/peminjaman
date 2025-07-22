<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mobil;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mobils = [
            [
                'nama' => 'Innova Reborn',
                'merk' => 'Toyota',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 1234 ABC',
                'harga_sewa' => 700000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Toyota Fortuner',
                'merk' => 'Toyota',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 2345 DEF',
                'harga_sewa' => 1200000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Innova Reborn',
                'merk' => 'Toyota',
                'tahun' => 'Manual',
                'plat_nomor' => 'B 3456 GHI',
                'harga_sewa' => 700000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Innova Reborn',
                'merk' => 'Toyota',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 4567 JKL',
                'harga_sewa' => 600000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'All New Avanza',
                'merk' => 'Toyota',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 5678 MNO',
                'harga_sewa' => 450000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'All New Avanza',
                'merk' => 'Toyota',
                'tahun' => 'Manual',
                'plat_nomor' => 'B 6789 PQR',
                'harga_sewa' => 450000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'New Avanza',
                'merk' => 'Toyota',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 7890 STU',
                'harga_sewa' => 400000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Sedan Vios 1.5 G',
                'merk' => 'Toyota',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 8901 VWX',
                'harga_sewa' => 500000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'All New Terios',
                'merk' => 'Daihatsu',
                'tahun' => 'Manual',
                'plat_nomor' => 'B 9012 YZA',
                'harga_sewa' => 450000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'New Avanza',
                'merk' => 'Toyota',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 0123 BCD',
                'harga_sewa' => 350000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Honda Brio',
                'merk' => 'Honda',
                'tahun' => 'Matic',
                'plat_nomor' => 'B 1122 CDE',
                'harga_sewa' => 300000,
                'status' => 'tersedia',
                'foto' => null,
            ],
        ];
        foreach ($mobils as $mobil) {
            Mobil::create($mobil);
        }
    }
}
