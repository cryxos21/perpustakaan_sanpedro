@extends('layouts.app')
@section('title', $berita->judul)
@section('content')
<div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
    <a href="{{ route('berita.index') }}" class="text-sm text-sanpedro-600 hover:underline">&larr; Kembali ke Berita</a>
    <h1 class="mt-3 text-2xl font-bold text-gray-800 sm:text-3xl">{{ $berita->judul }}</h1>
    <p class="mt-2 text-xs text-gray-400">Oleh {{ $berita->user->name ?? 'Admin' }} &middot; {{ $berita->published_at?->translatedFormat('d F Y') }}</p>

    <img src="{{ $berita->thumbnailUrl() }}" class="mt-6 w-full rounded-xl object-cover" alt="{{ $berita->judul }}">

    <div class="prose mt-6 max-w-none text-sm leading-relaxed text-gray-700">
        {!! nl2br(e($berita->isi)) !!}
    </div>

    @if ($lainnya->isNotEmpty())
        <div class="mt-12">
            <h2 class="mb-4 font-bold text-gray-800">Berita Lainnya</h2>
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ($lainnya as $b)
                    <a href="{{ route('berita.show', $b) }}" class="card overflow-hidden hover:shadow-md">
                        <img src="{{ $b->thumbnailUrl() }}" class="h-28 w-full object-cover">
                        <div class="p-3"><p class="line-clamp-2 text-sm font-medium text-gray-800">{{ $b->judul }}</p></div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
