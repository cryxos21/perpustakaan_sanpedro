@extends('layouts.dashboard')
@section('title', 'Peminjaman Saya')
@section('content')
<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[600px] text-left text-sm">
        <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Kode</th><th>Buku</th><th>Tanggal Pinjam</th><th>Jatuh Tempo</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($peminjaman as $p)
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $p->kode_peminjaman }}</td>
                    <td>{{ $p->detailPeminjaman->pluck('buku.judul')->join(', ') }}</td>
                    <td>{{ $p->tanggal_pinjam?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td>{{ $p->tanggal_jatuh_tempo?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td><x-status-badge :status="$p->status" /></td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada peminjaman aktif. Silakan cari buku di katalog.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $peminjaman->links() }}</div>
@endsection
