<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wisatawan;
use App\Models\User;

class WisatawanSeeder extends Seeder {
    public function run(): void {
        $users = User::where('peran', 'wisatawan')->get();

        foreach ($users as $user) {
            Wisatawan::factory()->create([
                'id_user' => $user->id_user
            ]);
        }
    }
}
