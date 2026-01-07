<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PemilikTempatWisata;
use App\Models\User;

class PemilikTempatWisataSeeder extends Seeder {
    public function run(): void {
        $users = User::where('peran', 'pemilik')->get();

        foreach ($users as $user) {
            PemilikTempatWisata::factory()->create([
                'id_user' => $user->id_user
            ]);
        }
    }
}
