<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Wisatawan;
use App\Models\TiketTempatWisata; // Pastikan model tiket di-import

class TransaksiSeeder extends Seeder {
    public function run(): void {
        // Ambil semua data tiket & wisatawan yang SUDAH ADA
        $tikets = TiketTempatWisata::all();
        $wisatawans = Wisatawan::all();

        // Jangan jalankan jika data kosong
        if($tikets->count() == 0 || $wisatawans->count() == 0) return;

        // Buat 20 transaksi contoh
        foreach(range(1, 20) as $index) {
            Transaksi::factory()->create([
                // Pilih wisatawan acak dari database
                'id_wisatawan' => $wisatawans->random()->id_wisatawan,
                // Pilih tiket acak dari database (ini otomatis menyambung ke id_wisata yang valid)
                'id_tiket' => $tikets->random()->id_tiket, 
            ]);
        }
    }
}