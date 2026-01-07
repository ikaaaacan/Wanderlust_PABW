<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->foreignId('id_wisatawan')->constrained('wisatawan', 'id_wisatawan')->onDelete('cascade');
            $table->foreignId('id_wisata')->constrained('tempat_wisata', 'id_wisata')->onDelete('cascade');
            $table->integer('penilaian');
            $table->text('ulasan')->nullable();
            $table->string('judul_ulasan')->nullable();
            $table->string('foto_ulasan')->nullable();
            $table->date('tanggal_penilaian');
            $table->string('status_penilaian')->default('tampil');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penilaian');
    }
};
