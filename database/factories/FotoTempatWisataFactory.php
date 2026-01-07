<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TempatWisata;

class FotoTempatWisataFactory extends Factory {
    public function definition(): array {
        return [
            'id_wisata' => TempatWisata::factory(),
            'foto_wisata' => "https://loremflickr.com/640/480/travel?lock=" . $this->faker->unique()->numberBetween(1,9999),
            'urutan' => 1,
        ];
    }
}
