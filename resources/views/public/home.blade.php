@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-sanpedro-800 via-sanpedro-700 to-sanpedro-900">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div>
                <p class="mb-3 inline-block rounded-full bg-sanpedro_gold-400/20 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-sanpedro_gold-400">
                    Cerdas, Beriman, dan Mandiri
                </p>
                <h1 class="text-3xl font-extrabold leading-tight text-white sm:text-4xl lg:text-5xl">
                    Temukan Referensi Akademik Anda di Perpustakaan Universitas San Pedro
                </h1>
                <p class="mt-4 text-base text-sanpedro-100 sm:text-lg">
                    Akses koleksi buku, referensi akademik, dan informasi perpustakaan dengan mudah dalam satu platform.
                </p>

                <form action="{{ route('katalog.index') }}" method="GET" class="mt-8 flex overflow-hidden rounded-xl bg-white shadow-lg">
                    <input type="text" name="q" placeholder="Cari judul buku, penulis, ISBN..." class="w-full px-5 py-4 text-sm text-gray-700 focus:outline-none">
                    <button type="submit" class="flex items-center gap-2 bg-sanpedro_gold-500 px-6 py-4 text-sm font-semibold text-sanpedro-900 hover:bg-sanpedro_gold-400">
                        Cari Buku
                    </button>
                </form>
            </div>

            <div class="hidden lg:block">
                <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=80"
                     alt="Ilustrasi perpustakaan modern" class="rounded-2xl shadow-2xl">
            </div>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="mx-auto -mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-4 rounded-2xl bg-white p-6 shadow-lg lg:grid-cols-4">
            @foreach ([
                ['label' => 'Total Buku', 'value' => $stats['total_buku']],
                ['label' => 'Total Anggota', 'value' => $stats['total_anggota']],
                ['label' => 'Buku Tersedia', 'value' => $stats['buku_tersedia']],
                ['label' => 'Buku Dipinjam', 'value' => $stats['buku_dipinjam']],
            ] as $item)
                <div class="text-center">
                    <p class="text-2xl font-extrabold text-sanpedro-700 sm:text-3xl">{{ number_format($item['value']) }}+</p>
                    <p class="mt-1 text-xs font-medium text-gray-500 sm:text-sm">{{ $item['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- BUKU TERBARU --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-800 sm:text-2xl">Buku Terbaru</h2>
            <a href="{{ route('katalog.index') }}" class="text-sm font-semibold text-sanpedro-600 hover:underline">Lihat semua &rarr;</a>
        </div>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
            @forelse ($bukuTerbaru as $buku)
                <x-book-card :buku="$buku" />
            @empty
                <p class="col-span-full text-sm text-gray-500">Belum ada data buku.</p>
            @endforelse
        </div>
    </section>

    {{-- KATEGORI --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-6 text-xl font-bold text-gray-800 sm:text-2xl">Kategori Buku</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ($kategori as $k)
                    <a href="{{ route('kategori.show', $k) }}" class="card flex flex-col items-center gap-2 p-5 text-center transition hover:shadow-md hover:-translate-y-0.5">
                        <span class="text-sm font-semibold text-gray-800">{{ $k->nama }}</span>
                        <span class="text-xs text-gray-500">{{ $k->buku_count }} buku</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LAYANAN --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-xl font-bold text-gray-800 sm:text-2xl">Informasi Layanan</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['title' => 'Layanan Sirkulasi', 'desc' => 'Peminjaman dan pengembalian buku secara cepat dan terjadwal.'],
                ['title' => 'Layanan Referensi', 'desc' => 'Bantuan pustakawan untuk mencari sumber referensi akademik.'],
                ['title' => 'Layanan Digital', 'desc' => 'Akses ke sumber daya digital dan katalog online.'],
            ] as $layanan)
                <div class="card p-6">
                    <h3 class="mb-2 font-semibold text-sanpedro-700">{{ $layanan['title'] }}</h3>
                    <p class="text-sm text-gray-600">{{ $layanan['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- BERITA & PENGUMUMAN --}}
    <section class="bg-white py-16">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Berita Perpustakaan</h2>
                    <a href="{{ route('berita.index') }}" class="text-sm font-semibold text-sanpedro-600 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="space-y-4">
                    @forelse ($berita as $b)
                        <a href="{{ route('berita.show', $b) }}" class="card flex gap-4 p-3 hover:shadow-md">
                            <img src="{{ $b->thumbnailUrl() }}" class="h-20 w-24 flex-shrink-0 rounded-lg object-cover" alt="{{ $b->judul }}">
                            <div>
                                <p class="line-clamp-2 text-sm font-semibold text-gray-800">{{ $b->judul }}</p>
                                <p class="mt-1 text-xs text-gray-400">{{ $b->published_at?->translatedFormat('d F Y') }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada berita.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Pengumuman</h2>
                    <a href="{{ route('pengumuman.index') }}" class="text-sm font-semibold text-sanpedro-600 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="space-y-4">
                    @forelse ($pengumuman as $p)
                        <div class="card p-4">
                            <p class="text-sm font-semibold text-gray-800">{{ $p->judul }}</p>
                            <p class="mt-1 line-clamp-2 text-xs text-gray-500">{{ Str::limit(strip_tags($p->isi), 120) }}</p>
                            <p class="mt-2 text-xs text-gray-400">{{ $p->published_at?->translatedFormat('d F Y') }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
