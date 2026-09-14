@extends('layouts.dashboard')
@section('title', 'Manajemen Reservasi')
@section('content')
<form method="GET" class="mb-4 flex gap-2">
    <select name="status" class="input max-w-xs" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        @foreach (['menunggu' => 'Menunggu', 'tersedia' => 'Tersedia', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $val => $label)
            <option value="{{ $val }}" @selected(request('status') == $val)>{{ $label }}</option>
        @endforeach
    </select>
</form>

<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[700px] text-left text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-gray-400">
                <th class="py-2">Mahasiswa</th><th>Buku</th><th>Tanggal Reservasi</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservasi as $r)
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $r->mahasiswa->nama }}</td>
                    <td>{{ $r->buku->judul }}</td>
                    <td>{{ $r->tanggal_reservasi->translatedFormat('d M Y') }}</td>
                    <td><x-status-badge :status="$r->status" /></td>
                    <td class="whitespace-nowrap py-2">
                        @if (in_array($r->status, ['menunggu', 'tersedia']))
                            <form method="POST" action="{{ route('admin.reservasi.destroy', $r) }}" onsubmit="return confirm('Batalkan reservasi ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Batalkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-400">Tidak ada data reservasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $reservasi->links() }}</div>
@endsection
