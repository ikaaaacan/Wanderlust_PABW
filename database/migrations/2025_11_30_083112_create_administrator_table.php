<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('administrator', function (Blueprint $table) {
            $table->id('id_admin');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('administrator');
    }
};
