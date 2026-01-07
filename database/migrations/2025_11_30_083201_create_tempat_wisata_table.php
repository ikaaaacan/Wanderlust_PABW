<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('tempat_wisata', function (Blueprint $table) {
            $table->id('id_wisata');
            $table->foreignId('id_ptw')->constrained('pemilik_tempat_wisata', 'id_ptw')->onDelete('cascade');
            $table->string('nama_wisata');
            $table->string('alamat_wisata');
            $table->string('kota');
            $table->string('jenis_wisata');
            $table->time('waktu_buka');
            $table->time('waktu_tutup');
            $table->text('deskripsi')->nullable();
            $table->string('status_wisata')->default('pending');
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tempat_wisata');
    }
};
