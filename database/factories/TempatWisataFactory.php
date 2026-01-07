<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PemilikTempatWisata;

class TempatWisataFactory extends Factory {
    public function definition(): array {
        return [
            'id_ptw' => PemilikTempatWisata::factory(),
            'nama_wisata' => $this->faker->company(),
            'alamat_wisata' => $this->faker->address(),
            'kota' => $this->faker->city(),
            'jenis_wisata' => $this->faker->randomElement(['Alam', 'Pantai', 'Sejarah', 'Taman Hiburan', 'Edukasi']),
            'waktu_buka' => '08:00',
            'waktu_tutup' => '17:00',
            'deskripsi' => $this->faker->paragraph(4),
            'status_wisata' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'catatan_revisi' => $this->faker->optional()->sentence(),
        ];
    }
}
