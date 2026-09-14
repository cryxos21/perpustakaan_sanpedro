@extends('layouts.dashboard')
@section('title', 'Reservasi Saya')
@section('content')
<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[600px] text-left text-sm">
        <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Buku</th><th>Tanggal Reservasi</th><th>Status</th><th></th></tr></thead>
        <tbody>
            @forelse ($reservasi as $r)
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $r->buku->judul }}</td>
                    <td>{{ $r->tanggal_reservasi->translatedFormat('d M Y') }}</td>
                    <td><x-status-badge :status="$r->status" /></td>
                    <td class="py-2">
                        @if ($r->status === 'tersedia')
                            <a href="{{ route('buku.show', $r->buku) }}" class="text-sanpedro-600 hover:underline">Ajukan Peminjaman</a>
                        @elseif ($r->status === 'menunggu')
                            <form method="POST" action="{{ route('mahasiswa.reservasi.destroy', $r) }}" onsubmit="return confirm('Batalkan reservasi ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Batalkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada reservasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $reservasi->links() }}</div>
@endsection
