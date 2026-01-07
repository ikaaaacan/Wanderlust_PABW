<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdministratorSeeder::class,
            WisatawanSeeder::class,
            PemilikTempatWisataSeeder::class,
            TempatWisataSeeder::class,
            FotoTempatWisataSeeder::class,
            TiketTempatWisataSeeder::class,
            TransaksiSeeder::class,
            PembayaranSeeder::class,
            PenilaianSeeder::class,
            BookmarkSeeder::class,
            MainUserSeeder::class,
        ]);
    }
}
