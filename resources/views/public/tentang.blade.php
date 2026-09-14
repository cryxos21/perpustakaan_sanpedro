@extends('layouts.app')
@section('title', 'Tentang Perpustakaan')
@section('content')
@php($pengaturan = \App\Models\Pengaturan::current())
<div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Tentang Perpustakaan</h1>
    <p class="mt-2 text-sm text-gray-500">{{ $pengaturan->nama_perpustakaan }} &mdash; Cerdas, Beriman, dan Mandiri.</p>

    <div class="mt-8 space-y-8">
        <section>
            <h2 class="mb-2 font-semibold text-sanpedro-700">Profil Perpustakaan</h2>
            <p class="text-sm leading-relaxed text-gray-600">
                Perpustakaan Universitas San Pedro merupakan pusat sumber belajar yang menyediakan koleksi buku,
                referensi akademik, dan layanan informasi bagi seluruh civitas akademika dalam mendukung proses
                belajar mengajar, penelitian, dan pengabdian kepada masyarakat.
            </p>
        </section>
        <section>
            <h2 class="mb-2 font-semibold text-sanpedro-700">Sejarah</h2>
            <p class="text-sm leading-relaxed text-gray-600">
                Sejak berdirinya Universitas San Pedro, perpustakaan terus berkembang mengikuti kebutuhan akademik,
                mulai dari koleksi cetak hingga transformasi menuju layanan digital yang lebih mudah diakses.
            </p>
        </section>
        <div class="grid gap-8 sm:grid-cols-2">
            <section>
                <h2 class="mb-2 font-semibold text-sanpedro-700">Visi</h2>
                <p class="text-sm leading-relaxed text-gray-600">Menjadi pusat sumber belajar unggul yang mendukung terciptanya lulusan yang cerdas, beriman, dan mandiri.</p>
            </section>
            <section>
                <h2 class="mb-2 font-semibold text-sanpedro-700">Misi</h2>
                <ul class="list-inside list-disc space-y-1 text-sm text-gray-600">
                    <li>Menyediakan koleksi yang relevan dengan kebutuhan akademik.</li>
                    <li>Meningkatkan literasi informasi civitas akademika.</li>
                    <li>Mengembangkan layanan perpustakaan berbasis teknologi.</li>
                </ul>
            </section>
        </div>
        <section>
            <h2 class="mb-2 font-semibold text-sanpedro-700">Jam Pelayanan</h2>
            <p class="text-sm text-gray-600">{{ $pengaturan->jam_pelayanan }}</p>
        </section>
        <section>
            <h2 class="mb-2 font-semibold text-sanpedro-700">Fasilitas</h2>
            <ul class="list-inside list-disc space-y-1 text-sm text-gray-600">
                <li>Ruang baca yang nyaman dan tenang</li>
                <li>Akses katalog online</li>
                <li>Layanan referensi dan sirkulasi</li>
                <li>Area diskusi kelompok</li>
            </ul>
        </section>
    </div>
</div>
@endsection
