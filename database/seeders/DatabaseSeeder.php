<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      

        \App\Models\User::firstOrCreate([
            'email' => 'admin@mdrentcar.com',
        ], [
            'name' => 'Admin MD Rent Car',
            'password' => bcrypt('admin12345'),
            'role' => 'admin',
        ]);

        $this->call([
            MobilSeeder::class,
         
        ]);
    }
}
