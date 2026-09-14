@extends('layouts.dashboard')
@section('title', 'Dashboard Mahasiswa')
@section('content')
<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
    @foreach ([
        ['label' => 'Sedang Dipinjam', 'value' => $stats['sedang_dipinjam']],
        ['label' => 'Total Riwayat', 'value' => $stats['total_riwayat']],
        ['label' => 'Buku Terlambat', 'value' => $stats['terlambat']],
        ['label' => 'Total Denda', 'value' => 'Rp '.number_format($stats['total_denda'], 0, ',', '.')],
    ] as $item)
        <div class="card p-5">
            <p class="text-xs text-gray-400">{{ $item['label'] }}</p>
            <p class="mt-1 text-xl font-bold text-sanpedro-700 sm:text-2xl">{{ $item['value'] }}</p>
        </div>
    @endforeach
</div>

<div class="mt-6 card overflow-x-auto p-6">
    <h2 class="mb-4 font-semibold text-gray-800">Peminjaman Aktif</h2>
    <table class="w-full min-w-[600px] text-left text-sm">
        <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Kode</th><th>Buku</th><th>Jatuh Tempo</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($peminjamanAktif as $p)
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $p->kode_peminjaman }}</td>
                    <td>{{ $p->detailPeminjaman->pluck('buku.judul')->join(', ') }}</td>
                    <td>{{ $p->tanggal_jatuh_tempo?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td><x-status-badge :status="$p->status" /></td>
                </tr>
            @empty
                <tr><td colspan="4" class="py-6 text-center text-gray-400">Tidak ada peminjaman aktif.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
