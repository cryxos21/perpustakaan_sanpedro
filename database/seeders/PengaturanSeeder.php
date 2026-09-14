<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        Pengaturan::create([
            'nama_perpustakaan' => 'Perpustakaan Universitas San Pedro',
            'alamat' => 'Jl. Perintis Kemerdekaan, Kupang, Nusa Tenggara Timur',
            'email' => 'perpustakaan@sanpedro.ac.id',
            'telepon' => '(0380) 123456',
            'jam_pelayanan' => 'Senin - Jumat, 08.00 - 20.00 WITA',
            'tarif_denda_per_hari' => 1000,
            'lama_peminjaman_hari' => 7,
        ]);
    }
}
