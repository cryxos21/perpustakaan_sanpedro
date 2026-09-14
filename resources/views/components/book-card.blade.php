@props(['buku'])
<a href="{{ route('buku.show', $buku) }}" class="card group flex flex-col overflow-hidden transition hover:shadow-md">
    <div class="aspect-[3/4] w-full overflow-hidden bg-gray-100">
        <img src="{{ $buku->coverUrl() }}" alt="Cover {{ $buku->judul }}" class="h-full w-full object-cover transition group-hover:scale-105">
    </div>
    <div class="flex flex-1 flex-col gap-1 p-3">
        <span class="badge {{ $buku->isTersedia() ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }} w-fit">
            {{ $buku->isTersedia() ? 'Tersedia' : 'Dipinjam' }}
        </span>
        <p class="line-clamp-2 text-sm font-semibold text-gray-800">{{ $buku->judul }}</p>
        <p class="text-xs text-gray-500">{{ $buku->penulis->nama ?? '-' }}</p>
        <p class="mt-auto text-xs text-gray-400">{{ $buku->penerbit->nama ?? '-' }} &middot; {{ $buku->tahun_terbit }}</p>
    </div>
</a>
