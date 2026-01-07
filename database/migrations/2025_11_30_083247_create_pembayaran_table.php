<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_transaksi')->constrained('transaksi', 'id_transaksi')->onDelete('cascade');
            $table->date('tanggal_bayar');
            $table->integer('jumlah_pembayaran');
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran')->default('pending');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('pembayaran');
    }
};
