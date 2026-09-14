@extends('layouts.dashboard')
@section('title', 'Manajemen Buku')
@section('content')
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul buku..." class="input">
        <button class="btn-secondary">Cari</button>
    </form>
    <a href="{{ route('admin.buku.create') }}" class="btn-primary">+ Tambah Buku</a>
</div>

<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[800px] text-left text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-gray-400">
                <th class="py-2">Cover</th><th>Judul</th><th>Kategori</th><th>Stok</th><th>Tersedia</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($buku as $b)
                <tr class="border-b border-gray-50">
                    <td class="py-2"><img src="{{ $b->coverUrl() }}" class="h-12 w-9 rounded object-cover"></td>
                    <td class="max-w-xs">{{ $b->judul }}</td>
                    <td>{{ $b->kategori->nama ?? '-' }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>{{ $b->tersedia }}</td>
                    <td><x-status-badge :status="$b->isTersedia() ? 'tersedia' : 'dipinjam'" /></td>
                    <td class="space-x-2 whitespace-nowrap py-2">
                        <a href="{{ route('admin.buku.edit', $b) }}" class="text-sanpedro-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.buku.destroy', $b) }}" class="inline" onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-6 text-center text-gray-400">Belum ada buku.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $buku->links() }}</div>
@endsection
