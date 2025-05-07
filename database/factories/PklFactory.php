<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Guru;

class PklFactory extends Factory
{
    public function definition(): array
    {
        return [
            'siswa_id'       => Siswa::inRandomOrder()->first()?->id ?? Siswa::factory(),
            'industri_id'    => Industri::inRandomOrder()->first()?->id ?? Industri::factory(),
            'guru_id'        => Guru::inRandomOrder()->first()?->id ?? Guru::factory(),
            'mulai'          => now()->subWeeks(rand(1, 4)),
            'selesai'        => now()->addWeeks(rand(1, 4)),
        ];
    }
}
