<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Teknologi Informasi', 'Pendidikan', 'Ekonomi', 'Manajemen',
            'Hukum', 'Bahasa', 'Sastra', 'Agama', 'Teknik', 'Ilmu Sosial',
        ];

        foreach ($kategori as $nama) {
            Kategori::create([
                'nama' => $nama,
                'slug' => Str::slug($nama),
                'deskripsi' => "Koleksi buku dalam bidang {$nama}.",
            ]);
        }
    }
}
