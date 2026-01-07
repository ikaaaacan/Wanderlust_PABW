<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('tiket_tempat_wisata', function (Blueprint $table) {
            $table->id('id_tiket');
            $table->foreignId('id_wisata')->constrained('tempat_wisata', 'id_wisata')->onDelete('cascade');
            $table->string('nama_tiket');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->text('deskripsi')->nullable();
            $table->string('foto_tiket')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tiket_tempat_wisata');
    }
};
