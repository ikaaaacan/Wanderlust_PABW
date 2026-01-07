<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TempatWisata;
use App\Models\PemilikTempatWisata;

class TempatWisataSeeder extends Seeder {
    public function run(): void {
        // 1. Ambil SEMUA pemilik yang sudah ada (ID 1-10)
        $pemiliks = PemilikTempatWisata::all();

        // 2. Loop setiap pemilik, buatkan 1 tempat wisata untuk mereka
        foreach ($pemiliks as $pemilik) {
            TempatWisata::factory()->create([
                // KUNCI: Override id_ptw dengan ID yang sudah ada
                'id_ptw' => $pemilik->id_ptw, 
            ]);
        }
    }
}