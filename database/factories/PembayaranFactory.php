<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaksi;

class PembayaranFactory extends Factory {
    public function definition(): array {
        return [
            'id_transaksi' => Transaksi::factory(),
            'tanggal_bayar' => now(),
            'jumlah_pembayaran' => $this->faker->numberBetween(10000, 300000),
            'metode_pembayaran' => $this->faker->randomElement(['QRIS', 'Transfer Bank', 'Kartu Kredit']),
            'status_pembayaran' => $this->faker->randomElement(['berhasil', 'menunggu', 'gagal']),
            'bukti_pembayaran' => "https://loremflickr.com/640/480/receipt?lock=" . $this->faker->unique()->numberBetween(1,9999),
        ];
    }
}
