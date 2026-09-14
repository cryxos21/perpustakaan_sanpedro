@extends('layouts.app')
@section('title', $kategori->nama)
@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">{{ $kategori->nama }}</h1>
    <p class="mt-1 text-sm text-gray-500">{{ $kategori->deskripsi }}</p>

    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @forelse ($buku as $b)
            <x-book-card :buku="$b" />
        @empty
            <p class="col-span-full py-10 text-center text-sm text-gray-500">Belum ada buku pada kategori ini.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $buku->links() }}</div>
</div>
@endsection
