@extends('layouts.app')
@section('title', 'Berita Perpustakaan')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Berita Perpustakaan</h1>

    <form method="GET" class="mt-4 flex max-w-md gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..." class="input">
        <button class="btn-primary">Cari</button>
    </form>

    @if ($featured)
        <a href="{{ route('berita.show', $featured) }}" class="card mt-8 flex flex-col overflow-hidden md:flex-row hover:shadow-md">
            <img src="{{ $featured->thumbnailUrl() }}" class="h-56 w-full object-cover md:w-80" alt="{{ $featured->judul }}">
            <div class="p-6">
                <span class="badge bg-sanpedro-50 text-sanpedro-700">Berita Utama</span>
                <h2 class="mt-2 text-xl font-bold text-gray-800">{{ $featured->judul }}</h2>
                <p class="mt-2 line-clamp-3 text-sm text-gray-600">{{ Str::limit(strip_tags($featured->isi), 200) }}</p>
                <p class="mt-3 text-xs text-gray-400">{{ $featured->published_at?->translatedFormat('d F Y') }}</p>
            </div>
        </a>
    @endif

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($berita as $b)
            <a href="{{ route('berita.show', $b) }}" class="card overflow-hidden hover:shadow-md">
                <img src="{{ $b->thumbnailUrl() }}" class="h-40 w-full object-cover" alt="{{ $b->judul }}">
                <div class="p-4">
                    <p class="line-clamp-2 font-semibold text-gray-800">{{ $b->judul }}</p>
                    <p class="mt-2 text-xs text-gray-400">{{ $b->published_at?->translatedFormat('d F Y') }}</p>
                </div>
            </a>
        @empty
            <p class="col-span-full py-10 text-center text-sm text-gray-500">Belum ada berita.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $berita->links() }}</div>
</div>
@endsection
