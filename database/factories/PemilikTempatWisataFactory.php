<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PemilikTempatWisataFactory extends Factory {
    public function definition(): array {
        return [
            'id_user' => User::factory()->state(['peran' => 'pemilik']),
            'jabatan' => $this->faker->JobTitle(),
            'nama_organisasi' => $this->faker->company(),
            'alamat_bisnis' => $this->faker->address(),
            'npwp' => $this->faker->numerify('##.###.###.#-###.###'),
            'siu' => $this->faker->numerify('SIU-####-####'),
            'foto_organisasi' => "https://loremflickr.com/640/480/building?lock=" . $this->faker->unique()->numberBetween(1,9999),
            'status_akun' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'catatan_revisi' => $this->faker->optional()->sentence(),
        ];
    }
}
