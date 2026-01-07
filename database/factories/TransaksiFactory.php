<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wisatawan;
use App\Models\TiketTempatWisata;
use Illuminate\Support\Str;

class TransaksiFactory extends Factory {
    public function definition(): array {
        return [
            'id_wisatawan' => Wisatawan::factory(),
            'id_tiket' => TiketTempatWisata::factory(),
            'jumlah_tiket' => $this->faker->numberBetween(1, 5),
            'status_transaksi' => $this->faker->randomElement(['pending', 'berhasil', 'gagal']),
            'tanggal_transaksi' => now()->subDays(rand(0, 30)),
            'total_harga' => function (array $attr) {
                return $attr['jumlah_tiket'] * TiketTempatWisata::find($attr['id_tiket'])->harga;
            },
            'kode_transaksi' => strtoupper(Str::random(10)),
            'catatan_transaksi' => $this->faker->optional()->sentence(),
        ];
    }
}
