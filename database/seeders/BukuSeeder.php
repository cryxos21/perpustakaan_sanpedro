<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriIds = Kategori::pluck('id')->all();
        $penulisIds = Penulis::pluck('id')->all();
        $penerbitIds = Penerbit::pluck('id')->all();

        $judulBuku = [
            'Pengantar Ilmu Komputer', 'Dasar Pemrograman Web', 'Algoritma dan Struktur Data',
            'Manajemen Basis Data', 'Kecerdasan Buatan untuk Pemula', 'Statistika Ekonomi Terapan',
            'Hukum Perdata Indonesia', 'Kewirausahaan Modern', 'Sastra Indonesia Klasik',
            'Bahasa Inggris Akademik', 'Pendidikan Karakter Bangsa', 'Filsafat Ilmu Pengetahuan',
            'Rekayasa Perangkat Lunak', 'Jaringan Komputer Lanjut', 'Teori Organisasi',
            'Akuntansi Keuangan Dasar', 'Sosiologi Masyarakat Digital', 'Teologi dan Kehidupan',
            'Mekanika Teknik Sipil', 'Manajemen Sumber Daya Manusia',
        ];

        foreach ($judulBuku as $i => $judul) {
            $stok = rand(3, 15);

            Buku::create([
                'kategori_id' => $kategoriIds[array_rand($kategoriIds)],
                'penulis_id' => $penulisIds[array_rand($penulisIds)],
                'penerbit_id' => $penerbitIds[array_rand($penerbitIds)],
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'isbn' => '978-602-'.rand(100, 999).'-'.rand(100, 999).'-'.rand(0, 9),
                'tahun_terbit' => rand(2015, 2025),
                'jumlah_halaman' => rand(120, 450),
                'deskripsi' => "Buku {$judul} membahas konsep dasar hingga lanjutan yang relevan untuk kebutuhan akademik mahasiswa.",
                'stok' => $stok,
                'tersedia' => $stok,
                'lokasi_rak' => 'RAK-'.chr(65 + ($i % 6)).'-'.rand(1, 20),
            ]);
        }
    }
}
