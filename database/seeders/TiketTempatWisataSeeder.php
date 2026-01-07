<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TiketTempatWisata;
use App\Models\TempatWisata;

class TiketTempatWisataSeeder extends Seeder {
    public function run(): void {
        // 1. Ambil SEMUA tempat wisata yang SUDAH ADA (ID 1-10)
        $wisatas = TempatWisata::all();

        // 2. Loop setiap tempat wisata
        foreach ($wisatas as $wisata) {
            // Buat misal 2 jenis tiket untuk setiap tempat wisata
            TiketTempatWisata::factory()->count(2)->create([
                // KUNCI: Override id_wisata agar tidak bikin tempat baru
                'id_wisata' => $wisata->id_wisata,
            ]);
        }
    }
}