@extends('layouts.dashboard')
@section('title', 'Manajemen Peminjaman')
@section('content')
<form method="GET" class="mb-4 flex flex-wrap gap-2">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIM..." class="input max-w-xs">
    <select name="status" class="input max-w-xs" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        @foreach (['menunggu' => 'Menunggu', 'dipinjam' => 'Dipinjam', 'ditolak' => 'Ditolak', 'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat'] as $val => $label)
            <option value="{{ $val }}" @selected(request('status') == $val)>{{ $label }}</option>
        @endforeach
    </select>
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
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $p->kode_peminjaman }}</td>
                    <td>{{ $p->mahasiswa->nama }} <span class="text-xs text-gray-400">({{ $p->mahasiswa->nim }})</span></td>
                    <td>{{ $p->detailPeminjaman->pluck('buku.judul')->join(', ') }}</td>
                    <td>{{ $p->tanggal_jatuh_tempo?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td><x-status-badge :status="$p->status" /></td>
                    <td class="whitespace-nowrap py-2">
                        @if ($p->status === 'menunggu')
                            <form method="POST" action="{{ route('admin.peminjaman.setujui', $p) }}" class="inline">
                                @csrf
                                <button class="mr-2 text-green-600 hover:underline">Setujui</button>
                            </form>
                            <form method="POST" action="{{ route('admin.peminjaman.tolak', $p) }}" class="inline" onsubmit="return confirm('Tolak peminjaman ini?')">
                                @csrf
                                <button class="text-red-600 hover:underline">Tolak</button>
                            </form>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="py-6 text-center text-gray-400">Tidak ada data peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $peminjaman->links() }}</div>
@endsection
