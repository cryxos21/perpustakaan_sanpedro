<?php

namespace Database\Seeders;

use App\Models\Penulis;
use Illuminate\Database\Seeder;

class PenulisSeeder extends Seeder
{
    public function run(): void
    {
        $penulis = [
            'Sutan Takdir Alisjahbana', 'Pramoedya Ananta Toer', 'Habibie R. Nasution',
            'Maria Fransiska', 'Robert C. Martin', 'Yohanes Surya',
            'Dewi Lestari', 'Andrea Hirata', 'Budi Santoso', 'Sri Wahyuni',
        ];

        foreach ($penulis as $nama) {
            Penulis::create([
                'nama' => $nama,
                'biografi' => "{$nama} adalah salah satu penulis yang karyanya menjadi referensi akademik.",
            ]);
        }
    }
}
