<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil semua seeder lainnya
        $this->call([
            SiswaSeeder::class,
            GuruSeeder::class,
            IndustriSeeder::class,
            PklSeeder::class,
        ]);
    }
}
