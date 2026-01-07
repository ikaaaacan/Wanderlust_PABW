<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bookmark;
use App\Models\Wisatawan;
use App\Models\TempatWisata;

class BookmarkSeeder extends Seeder {
    public function run(): void {
        $wisatawans = Wisatawan::all();
        $wisatas = TempatWisata::all();

        if($wisatas->count() == 0 || $wisatawans->count() == 0) return;

        foreach(range(1, 15) as $index) {
            Bookmark::factory()->create([
                'id_wisatawan' => $wisatawans->random()->id_wisatawan,
                'id_wisata' => $wisatas->random()->id_wisata, // Pakai ID yang ada
            ]);
        }
    }
}