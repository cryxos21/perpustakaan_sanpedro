@extends('layouts.dashboard')
@section('title', 'Riwayat Peminjaman')
@section('content')
<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[700px] text-left text-sm">
        <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Kode</th><th>Buku</th><th>Tanggal Kembali</th><th>Denda</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($riwayat as $r)
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $r->kode_peminjaman }}</td>
                    <td>{{ $r->detailPeminjaman->pluck('buku.judul')->join(', ') }}</td>
                    <td>{{ $r->tanggal_kembali?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td>Rp {{ number_format($r->total_denda, 0, ',', '.') }}</td>
                    <td><x-status-badge :status="$r->status" /></td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada riwayat peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $riwayat->links() }}</div>
@endsection
