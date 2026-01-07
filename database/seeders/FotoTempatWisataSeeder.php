<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FotoTempatWisata;
use App\Models\TempatWisata;

class FotoTempatWisataSeeder extends Seeder {
    public function run(): void {
        $wisatas = TempatWisata::all();

        foreach ($wisatas as $wisata) {
            for ($i = 1; $i <= 6; $i++) {
                FotoTempatWisata::factory()->create([
                    'id_wisata' => $wisata->id_wisata,
                    'urutan' => $i,
                ]);
            }
        }
    }
}
