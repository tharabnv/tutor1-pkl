<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama'       => fake()->name(),
            'nis'        => fake()->unique()->numerify('20###'),
            'gender'     => fake()->randomElement(['L', 'P']),
            'alamat'     => fake()->address(),
            'kontak'     => fake()->phoneNumber(),
            'email'      => fake()->unique()->safeEmail(),
            'status_pkl' => fake()->boolean(),
            'foto'       => 'foto-siswa/default.jpg', // atau null kalau belum upload
        ];
    }
}