<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wisatawan;
use App\Models\TempatWisata;

class PenilaianFactory extends Factory {
    public function definition(): array {
        return [
            'id_wisatawan' => Wisatawan::factory(),
            'id_wisata' => TempatWisata::factory(),
            'penilaian' => $this->faker->numberBetween(1, 5),
            'ulasan' => $this->faker->paragraph(),
            'judul_ulasan' => $this->faker->sentence(),
            'foto_ulasan' => "https://loremflickr.com/640/480/review?lock=" . $this->faker->unique()->numberBetween(1,9999),
            'tanggal_penilaian' => now()->subDays(rand(0, 100)),
            'status_penilaian' => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}
