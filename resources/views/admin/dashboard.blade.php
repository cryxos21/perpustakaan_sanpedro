@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<div class="grid grid-cols-2 gap-4 lg:grid-cols-3 xl:grid-cols-6">
    @foreach ([
        ['label' => 'Total Buku', 'value' => $stats['total_buku']],
        ['label' => 'Total Anggota', 'value' => $stats['total_anggota']],
        ['label' => 'Total Peminjaman', 'value' => $stats['total_peminjaman']],
        ['label' => 'Total Pengembalian', 'value' => $stats['total_pengembalian']],
        ['label' => 'Buku Terlambat', 'value' => $stats['buku_terlambat']],
        ['label' => 'Menunggu Persetujuan', 'value' => $stats['menunggu_persetujuan']],
    ] as $item)
        <div class="card p-5">
            <p class="text-xs text-gray-400">{{ $item['label'] }}</p>
            <p class="mt-1 text-2xl font-bold text-sanpedro-700">{{ number_format($item['value']) }}</p>
        </div>
    @endforeach
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Peminjaman per Bulan ({{ date('Y') }})</h2>
        <div class="flex h-48 items-end gap-2">
            @php($max = max($peminjamanPerBulan->max() ?: 1, 1))
            @for ($m = 1; $m <= 12; $m++)
                @php($val = $peminjamanPerBulan[$m] ?? 0)
                <div class="flex flex-1 flex-col items-center gap-1">
                    <div class="w-full rounded-t bg-sanpedro-500" style="height: {{ $val > 0 ? ($val / $max) * 100 : 2 }}%"></div>
                    <span class="text-[10px] text-gray-400">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('M') }}</span>
                </div>
            @endfor
        </div>
    </div>

    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Pengembalian per Bulan ({{ date('Y') }})</h2>
        <div class="flex h-48 items-end gap-2">
            @php($max2 = max($pengembalianPerBulan->max() ?: 1, 1))
            @for ($m = 1; $m <= 12; $m++)
                @php($val = $pengembalianPerBulan[$m] ?? 0)
                <div class="flex flex-1 flex-col items-center gap-1">
                    <div class="w-full rounded-t bg-sanpedro_gold-500" style="height: {{ $val > 0 ? ($val / $max2) * 100 : 2 }}%"></div>
                    <span class="text-[10px] text-gray-400">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('M') }}</span>
                </div>
            @endfor
        </div>
    </div>
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Buku Paling Banyak Dipinjam</h2>
        <ul class="space-y-2 text-sm">
            @forelse ($bukuPopuler as $b)
                <li class="flex items-center justify-between border-b border-gray-50 pb-2">
                    <span class="text-gray-700">{{ $b->judul }}</span>
                    <span class="font-semibold text-sanpedro-600">{{ $b->total }}x</span>
                </li>
            @empty
                <li class="text-gray-400">Belum ada data.</li>
            @endforelse
        </ul>
    </div>
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Kategori Paling Populer</h2>
        <ul class="space-y-2 text-sm">
            @forelse ($kategoriPopuler as $k)
                <li class="flex items-center justify-between border-b border-gray-50 pb-2">
                    <span class="text-gray-700">{{ $k->nama }}</span>
                    <span class="font-semibold text-sanpedro-600">{{ $k->total }}x</span>
                </li>
            @empty
                <li class="text-gray-400">Belum ada data.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="mt-6 card overflow-x-auto p-6">
    <h2 class="mb-4 font-semibold text-gray-800">Peminjaman Terbaru</h2>
    <table class="w-full min-w-[500px] text-left text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-gray-400">
                <th class="pb-2">Kode</th><th class="pb-2">Mahasiswa</th><th class="pb-2">Buku</th><th class="pb-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamanTerbaru as $p)
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $p->kode_peminjaman }}</td>
                    <td class="py-2">{{ $p->mahasiswa->nama }}</td>
                    <td class="py-2">{{ $p->detailPeminjaman->pluck('buku.judul')->join(', ') }}</td>
                    <td class="py-2"><x-status-badge :status="$p->status" /></td>
                </tr>
            @empty
                <tr><td colspan="4" class="py-4 text-center text-gray-400">Belum ada peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
