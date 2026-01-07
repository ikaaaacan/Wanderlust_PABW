<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('foto_tempat_wisata', function (Blueprint $table) {
            $table->id('id_foto');
            $table->foreignId('id_wisata')->constrained('tempat_wisata', 'id_wisata')->onDelete('cascade');
            $table->string('foto_wisata');
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('foto_tempat_wisata');
    }
};
