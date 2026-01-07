<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrator;
use App\Models\User;

class AdministratorSeeder extends Seeder {
    public function run(): void {
        $users = User::where('peran', 'administrator')->get();

        foreach ($users as $user) {
            Administrator::factory()->create([
                'id_user' => $user->id_user
            ]);
        }
    }
}
