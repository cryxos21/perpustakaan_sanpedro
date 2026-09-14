@extends('layouts.app')

@section('title', $buku->judul)

@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="grid gap-10 lg:grid-cols-3">
        <div class="lg:col-span-1">
            <img src="{{ $buku->coverUrl() }}" alt="{{ $buku->judul }}" class="w-full rounded-xl object-cover shadow-md">
        </div>

        <div class="lg:col-span-2">
            <x-status-badge :status="$buku->isTersedia() ? 'tersedia' : 'dipinjam'" />
            <h1 class="mt-3 text-2xl font-bold text-gray-800 sm:text-3xl">{{ $buku->judul }}</h1>
            <p class="mt-1 text-sm text-gray-500">oleh {{ $buku->penulis->nama ?? '-' }}</p>

            <dl class="mt-6 grid grid-cols-2 gap-4 rounded-xl bg-white p-5 shadow-sm text-sm sm:grid-cols-3">
                <div><dt class="text-gray-400">ISBN</dt><dd class="font-medium text-gray-800">{{ $buku->isbn }}</dd></div>
                <div><dt class="text-gray-400">Penerbit</dt><dd class="font-medium text-gray-800">{{ $buku->penerbit->nama ?? '-' }}</dd></div>
                <div><dt class="text-gray-400">Tahun Terbit</dt><dd class="font-medium text-gray-800">{{ $buku->tahun_terbit }}</dd></div>
                <div><dt class="text-gray-400">Kategori</dt><dd class="font-medium text-gray-800">{{ $buku->kategori->nama ?? '-' }}</dd></div>
                <div><dt class="text-gray-400">Jumlah Halaman</dt><dd class="font-medium text-gray-800">{{ $buku->jumlah_halaman }}</dd></div>
                <div><dt class="text-gray-400">Lokasi Rak</dt><dd class="font-medium text-gray-800">{{ $buku->lokasi_rak }}</dd></div>
                <div><dt class="text-gray-400">Stok</dt><dd class="font-medium text-gray-800">{{ $buku->stok }}</dd></div>
                <div><dt class="text-gray-400">Tersedia</dt><dd class="font-medium text-gray-800">{{ $buku->tersedia }}</dd></div>
            </dl>

            <div class="mt-6">
                <h2 class="mb-2 font-semibold text-gray-800">Deskripsi</h2>
                <p class="text-sm leading-relaxed text-gray-600">{{ $buku->deskripsi ?: 'Belum ada deskripsi untuk buku ini.' }}</p>
            </div>

            <div class="mt-6">
                @auth
                    @if (auth()->user()->isMahasiswa())
                        @if ($sudahDiajukan)
                            <span class="btn-secondary cursor-not-allowed opacity-60">Sudah Diajukan</span>
                        @elseif ($buku->isTersedia())
                            <form method="POST" action="{{ route('mahasiswa.peminjaman.store', $buku) }}">
                                @csrf
                                <button type="submit" class="btn-primary">Ajukan Peminjaman</button>
                            </form>
                        @else
                            <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                Buku sedang tidak tersedia.
                            </div>
                            <form method="POST" action="{{ route('mahasiswa.reservasi.store', $buku) }}" class="mt-3">
                                @csrf
                                <button type="submit" class="btn-secondary">Reservasi Buku</button>
                            </form>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Login untuk Meminjam</a>
                @endauth
            </div>
        </div>
    </div>

    @if ($bukuTerkait->isNotEmpty())
        <div class="mt-16">
            <h2 class="mb-4 text-lg font-bold text-gray-800">Buku Terkait</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ($bukuTerkait as $b)
                    <x-book-card :buku="$b" />
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
