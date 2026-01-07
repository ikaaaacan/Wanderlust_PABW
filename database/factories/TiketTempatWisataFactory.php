<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TempatWisata;

class TiketTempatWisataFactory extends Factory {
    public function definition(): array {
        return [
            'id_wisata' => TempatWisata::factory(),
            'nama_tiket' => $this->faker->randomElement(['Reguler', 'VIP', 'Anak-anak', 'Dewasa']),
            'harga' => $this->faker->numberBetween(10000, 200000),
            'jumlah' => $this->faker->numberBetween(50, 500),
            'deskripsi' => $this->faker->sentence(),
            'foto_tiket' => "https://loremflickr.com/640/480/ticket?lock=" . $this->faker->unique()->numberBetween(1,9999),
        ];
    }
}
