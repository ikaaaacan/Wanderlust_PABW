<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_wisatawan')->constrained('wisatawan', 'id_wisatawan')->onDelete('cascade');
            $table->foreignId('id_tiket')->constrained('tiket_tempat_wisata', 'id_tiket')->onDelete('cascade');
            $table->integer('jumlah_tiket');
            $table->string('status_transaksi')->default('pending');
            $table->dateTime('tanggal_transaksi');
            $table->integer('total_harga');
            $table->string('kode_transaksi')->unique();
            $table->text('catatan_transaksi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transaksi');
    }
};
