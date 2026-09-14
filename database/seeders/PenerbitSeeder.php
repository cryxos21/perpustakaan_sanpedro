<?php

namespace Database\Seeders;

use App\Models\Penerbit;
use Illuminate\Database\Seeder;

class PenerbitSeeder extends Seeder
{
    public function run(): void
    {
        $penerbit = [
            ['nama' => 'Gramedia Pustaka Utama', 'email' => 'info@gramedia.com'],
            ['nama' => 'Erlangga', 'email' => 'info@erlangga.co.id'],
            ['nama' => 'Andi Offset', 'email' => 'info@andipublisher.com'],
            ['nama' => 'Penerbit Kanisius', 'email' => 'info@kanisius.co.id'],
            ['nama' => 'Salemba Empat', 'email' => 'info@salemba.co.id'],
        ];

        foreach ($penerbit as $p) {
            Penerbit::create([
                'nama' => $p['nama'],
                'email' => $p['email'],
                'alamat' => 'Jakarta, Indonesia',
                'telepon' => '021-'.rand(1000000, 9999999),
                'website' => 'https://www.'.str()->slug($p['nama']).'.com',
            ]);
        }
    }
}
