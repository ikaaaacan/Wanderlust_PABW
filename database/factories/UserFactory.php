<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory {
    public function definition(): array {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nomor_telepon' => $this->faker->phoneNumber(),
            'password' => bcrypt('password'),
            'peran' => $this->faker->randomElement(['administrator', 'wisatawan', 'pemilik']),
            'foto_profil' => "https://loremflickr.com/320/320/face?lock=" . $this->faker->unique()->numberBetween(1,9999),
        ];
    }
}
