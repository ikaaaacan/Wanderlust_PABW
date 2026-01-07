<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WisatawanFactory extends Factory {
    public function definition(): array {
        return [
            'id_user' => User::factory()->state(['peran' => 'wisatawan']),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->address(),
            'usia' => $this->faker->numberBetween(15, 65),
            'status_akun' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'kota_asal' => $this->faker->city(),
            'preferensi_wisata' => $this->faker->randomElement(['Pantai', 'Gunung', 'Kuliner', 'Edukasi', 'Sejarah']),
        ];
    }
}
