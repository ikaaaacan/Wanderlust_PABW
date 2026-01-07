<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('bookmark', function (Blueprint $table) {
            $table->id('id_bookmark');
            $table->foreignId('id_wisatawan')->constrained('wisatawan', 'id_wisatawan')->onDelete('cascade');
            $table->foreignId('id_wisata')->constrained('tempat_wisata', 'id_wisata')->onDelete('cascade');
            $table->date('tanggal_simpan');
            $table->text('catatan')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bookmark');
    }
};
