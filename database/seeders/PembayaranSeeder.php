<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\Transaksi;

class PembayaranSeeder extends Seeder {
    public function run(): void {
        // Ambil semua transaksi yang sudah dibuat oleh TransaksiSeeder
        $transaksis = Transaksi::all();

        // Cek jika tidak ada transaksi, jangan jalankan
        if($transaksis->isEmpty()) return;

        // Loop setiap transaksi, buatkan 1 data pembayaran
        foreach ($transaksis as $transaksi) {
            Pembayaran::factory()->create([
                'id_transaksi' => $transaksi->id_transaksi, // KUNCI: Pakai ID yang sudah ada
            ]);
        }
    }
}