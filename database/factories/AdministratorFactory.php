<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AdministratorFactory extends Factory {
    public function definition(): array {
        return [
            'id_user' => User::factory()->state(['peran' => 'administrator']),
            'jabatan' => $this->faker->randomElement(['Admin Sistem', 'Admin Konten', 'Supervisor']),
        ];
    }
}
