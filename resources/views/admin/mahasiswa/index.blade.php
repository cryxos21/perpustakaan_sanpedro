@extends('layouts.dashboard')
@section('title', 'Manajemen Anggota')
@section('content')
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIM..." class="input">
        <button class="btn-secondary">Cari</button>
    </form>
    <a href="{{ route('admin.mahasiswa.create') }}" class="btn-primary">+ Tambah Anggota</a>
</div>

<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[800px] text-left text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-gray-400">
                <th class="py-2">NIM</th><th>Nama</th><th>Prodi</th><th>Fakultas</th><th>Email</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswa as $m)
                <tr class="border-b border-gray-50">
                    <td class="py-2">{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->program_studi }}</td>
                    <td>{{ $m->fakultas }}</td>
                    <td>{{ $m->user->email ?? '-' }}</td>
                    <td><x-status-badge :status="$m->status" /></td>
                    <td class="space-x-2 whitespace-nowrap py-2">
                        <a href="{{ route('admin.mahasiswa.edit', $m) }}" class="text-sanpedro-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.mahasiswa.destroy', $m) }}" class="inline" onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-6 text-center text-gray-400">Belum ada anggota.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $mahasiswa->links() }}</div>
@endsection
