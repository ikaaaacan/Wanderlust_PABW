<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wisatawan;
use App\Models\TempatWisata;

class BookmarkFactory extends Factory {
    public function definition(): array {
        return [
            'id_wisatawan' => Wisatawan::factory(),
            'id_wisata' => TempatWisata::factory(),
            'tanggal_simpan' => now()->subDays(rand(0, 30)),
            'catatan' => $this->faker->optional()->sentence(),
            'kategori' => $this->faker->randomElement(['Favorit', 'Ingin Dikunjungi', 'Wishlist']),
        ];
    }
}
