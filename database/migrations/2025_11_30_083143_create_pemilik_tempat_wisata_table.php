<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('pemilik_tempat_wisata', function (Blueprint $table) {
            $table->id('id_ptw');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('jabatan')->nullable();
            $table->string('nama_organisasi');
            $table->string('alamat_bisnis');
            $table->string('npwp')->nullable();
            $table->string('siu')->nullable();
            $table->string('foto_organisasi')->nullable();
            $table->string('status_akun')->default('pending');
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pemilik_tempat_wisata');
    }
};
