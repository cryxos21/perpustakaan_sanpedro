@extends('layouts.app')
@section('title', 'Layanan')
@section('content')
<div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Layanan Perpustakaan</h1>
    <div class="mt-8 grid gap-6 sm:grid-cols-2">
        @foreach ([
            ['title' => 'Layanan Sirkulasi', 'desc' => 'Melayani peminjaman dan pengembalian buku bagi anggota perpustakaan yang aktif.'],
            ['title' => 'Layanan Referensi', 'desc' => 'Membantu mahasiswa dan dosen menemukan sumber referensi akademik yang relevan.'],
            ['title' => 'Layanan Digital', 'desc' => 'Menyediakan akses ke katalog dan sumber daya digital perpustakaan.'],
            ['title' => 'Layanan Keanggotaan', 'desc' => 'Mengelola pendaftaran dan administrasi anggota perpustakaan.'],
            ['title' => 'Layanan Ruang Baca', 'desc' => 'Menyediakan informasi dan pengaturan penggunaan fasilitas ruang baca.'],
        ] as $l)
            <div class="card p-6">
                <h2 class="mb-2 font-semibold text-sanpedro-700">{{ $l['title'] }}</h2>
                <p class="text-sm text-gray-600">{{ $l['desc'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
