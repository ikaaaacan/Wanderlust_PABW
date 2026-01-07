<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('wisatawan', function (Blueprint $table) {
            $table->id('id_wisatawan');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('usia')->nullable();
            $table->string('status_akun')->default('aktif');
            $table->string('kota_asal')->nullable();
            $table->string('preferensi_wisata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('wisatawan');
    }
};
