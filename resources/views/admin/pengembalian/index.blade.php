@extends('layouts.dashboard')
@section('title', 'Pengembalian Buku')
@section('content')
<form method="GET" class="mb-4 flex gap-2">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIM..." class="input max-w-xs">
    <button class="btn-secondary">Cari</button>
</form>

<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[800px] text-left text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-gray-400">
                <th class="py-2">Kode</th><th>Mahasiswa</th><th>Buku</th><th>Jatuh Tempo</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $p)
                @php($terlambat = $p->tanggal_jatuh_tempo?->isPast())
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $p->kode_peminjaman }}</td>
                    <td>{{ $p->mahasiswa->nama }} <span class="text-xs text-gray-400">({{ $p->mahasiswa->nim }})</span></td>
                    <td>{{ $p->detailPeminjaman->pluck('buku.judul')->join(', ') }}</td>
                    <td>{{ $p->tanggal_jatuh_tempo?->translatedFormat('d M Y') }}</td>
                    <td><x-status-badge :status="$terlambat ? 'terlambat' : 'dipinjam'" /></td>
                    <td class="whitespace-nowrap py-2">
                        <form method="POST" action="{{ route('admin.pengembalian.store', $p) }}" onsubmit="return confirm('Proses pengembalian buku ini? Denda akan dihitung otomatis jika terlambat.')">
                            @csrf
                            <button class="text-sanpedro-600 hover:underline">Proses Pengembalian</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="py-6 text-center text-gray-400">Tidak ada buku yang sedang dipinjam.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $peminjaman->links() }}</div>
@endsection
