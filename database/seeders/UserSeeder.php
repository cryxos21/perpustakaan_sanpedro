<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@sanpedro.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $petugas = User::create([
            'name' => 'Petugas Perpustakaan',
            'email' => 'petugas@sanpedro.ac.id',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        $mahasiswaUser = User::create([
            'name' => 'Mahasiswa Demo',
            'email' => 'mahasiswa@sanpedro.ac.id',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswaUser->id,
            'nim' => '2024010001',
            'nama' => 'Mahasiswa Demo',
            'fakultas' => 'Fakultas Ilmu Komputer',
            'program_studi' => 'Sistem Informasi',
            'semester' => 5,
            'no_hp' => '081234567890',
            'alamat' => 'Kupang, Nusa Tenggara Timur',
            'status' => 'aktif',
        ]);
    }
}
