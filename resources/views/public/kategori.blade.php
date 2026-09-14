@extends('layouts.app')
@section('title', 'Kategori Buku')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Kategori Buku</h1>
    <p class="mt-1 text-sm text-gray-500">Jelajahi koleksi buku berdasarkan kategori.</p>

    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @foreach ($kategori as $k)
            <a href="{{ route('kategori.show', $k) }}" class="card p-6 text-center transition hover:shadow-md hover:-translate-y-0.5">
                <p class="font-semibold text-gray-800">{{ $k->nama }}</p>
                <p class="mt-1 text-xs text-gray-500">{{ $k->buku_count }} buku</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
