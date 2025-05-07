<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GuruFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama'   => fake()->name(),
            'nip'    => fake()->unique()->numerify('1980#######'),
            'gender' => fake()->randomElement(['L', 'P']),
            'alamat' => fake()->address(),
            'kontak' => fake()->numerify('###########'), // batasin digit
            'email' => fake()->unique()->safeEmailDomain('gurusija.com'),
        ];
    }
}

