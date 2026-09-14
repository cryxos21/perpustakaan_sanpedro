@extends('layouts.dashboard')
@section('title', 'Manajemen Berita')
@section('content')
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul berita..." class="input">
        <button class="btn-secondary">Cari</button>
    </form>
    <a href="{{ route('admin.berita.create') }}" class="btn-primary">+ Tambah Berita</a>
</div>

<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[700px] text-left text-sm">
        <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Thumbnail</th><th>Judul</th><th>Penulis</th><th>Status</th><th>Tanggal</th><th></th></tr></thead>
        <tbody>
            @forelse ($berita as $b)
                <tr class="border-b border-gray-50">
                    <td class="py-2"><img src="{{ $b->thumbnailUrl() }}" class="h-12 w-16 rounded object-cover"></td>
                    <td class="max-w-xs">{{ $b->judul }}</td>
                    <td>{{ $b->user->name ?? '-' }}</td>
                    <td><x-status-badge :status="$b->status" /></td>
                    <td>{{ $b->published_at?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td class="space-x-2 whitespace-nowrap py-2">
                        <a href="{{ route('admin.berita.edit', $b) }}" class="text-sanpedro-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.berita.destroy', $b) }}" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="py-6 text-center text-gray-400">Belum ada berita.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $berita->links() }}</div>
@endsection
