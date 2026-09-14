@extends('layouts.app')
@section('title', 'Pengumuman')
@section('content')
<div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Pengumuman Perpustakaan</h1>

    <div class="mt-8 space-y-4">
        @forelse ($pengumuman as $p)
            <div class="card p-5">
                <h2 class="font-semibold text-gray-800">{{ $p->judul }}</h2>
                <p class="mt-2 whitespace-pre-line text-sm text-gray-600">{{ $p->isi }}</p>
                <p class="mt-3 text-xs text-gray-400">{{ $p->published_at?->translatedFormat('d F Y') }}</p>
            </div>
        @empty
            <p class="py-10 text-center text-sm text-gray-500">Belum ada pengumuman.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $pengumuman->links() }}</div>
</div>
@endsection
