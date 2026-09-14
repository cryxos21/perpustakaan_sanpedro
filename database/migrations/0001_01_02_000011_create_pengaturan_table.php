<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perpustakaan')->default('Perpustakaan Universitas San Pedro');
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('jam_pelayanan')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedInteger('tarif_denda_per_hari')->default(1000);
            $table->unsignedInteger('lama_peminjaman_hari')->default(7);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
