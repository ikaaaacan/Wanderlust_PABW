<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('nomor_telepon')->nullable();
            $table->string('password');
            $table->enum('peran', ['administrator', 'wisatawan', 'pemilik']);
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
