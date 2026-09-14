<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->foreignId('penulis_id')->constrained('penulis')->cascadeOnDelete();
            $table->foreignId('penerbit_id')->constrained('penerbit')->cascadeOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('isbn')->unique();
            $table->year('tahun_terbit')->nullable();
            $table->unsignedInteger('jumlah_halaman')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('cover')->nullable();
            $table->unsignedInteger('stok')->default(0);
            $table->unsignedInteger('tersedia')->default(0);
            $table->string('lokasi_rak')->nullable();
            $table->timestamps();

            $table->index('judul');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
