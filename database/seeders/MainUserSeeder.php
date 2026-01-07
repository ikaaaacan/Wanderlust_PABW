<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Administrator;
use App\Models\Wisatawan;
use App\Models\PemilikTempatWisata;

class MainUserSeeder extends Seeder {
    public function run(): void {

        //Data Administrator
        $admin = User::create([
            'nama'          => 'Riska Dea Bakri',
            'email'         => 'riska@wanderlust.com',
            'nomor_telepon' => '081234567890',
            'password'      => Hash::make('123'),
            'peran'         => 'administrator',
            'foto_profil'   => 'https://placeholder.com/foto_admin_anda.jpg',
        ]);

        Administrator::create([
            'id_user' => $admin->id_user,
            'jabatan' => 'Super Admin',
        ]);

        //Data Wisatawan
        $wisatawan = User::create([
            'nama'          => 'Faiz Syafiq N',
            'email'         => 'faiz@wanderlust.com',
            'nomor_telepon' => '089876543210',
            'password'      => Hash::make('123'),
            'peran'         => 'wisatawan',
            'foto_profil'   => 'https://placeholder.com/foto_wisatawan_anda.jpg',
        ]);

        Wisatawan::create([
            'id_user'           => $wisatawan->id_user,
            'tanggal_lahir'     => '2005-01-01',
            'jenis_kelamin'     => 'L',
            'alamat'            => 'Jl. Contoh Alamat No.123, Bandung',
            'usia'              => 20,
            'status_akun'       => 'aktif',
            'kota_asal'         => 'Bandung',
            'preferensi_wisata' => 'Pantai',
        ]);

        //Data Pemilik Tempat Wisata
        $pemilik = User::create([
            'nama'          => 'M. Alnilam Lambda',
            'email'         => 'alnilam@gmail.com',
            'nomor_telepon' => '081316556908',
            'password'      => Hash::make('123'),
            'peran'         => 'pemilik',
            'foto_profil'   => 'Alnilam.jpg',
        ]);

        PemilikTempatWisata::create([
            'id_user'           => $pemilik->id_user,
            'jabatan'           => 'Minister of Tourism',
            'nama_organisasi'   => 'KEMENPAREKRAF',
            'alamat_bisnis'     => 'Jl. Mulia Jaya Semesta No. 45, Bandung, West Java',
            'npwp'              => '12.345.678.9-123.000',
            'siu'               => 'SIU-2025-0001',
            'foto_organisasi'   => 'kemenparekraf.jpg',
            'status_akun'       => 'aktif',
            'catatan_revisi'    => null,
        ]);
    }
}