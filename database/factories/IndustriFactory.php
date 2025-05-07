<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Guru;

class IndustriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama'         => fake()->company(),
            'bidang_usaha' => fake()->jobTitle(),
            'alamat'       => fake()->address(),
            'kontak'       => fake()->phoneNumber(),
            'email'        => fake()->companyEmail(),
        ];
    }
}
