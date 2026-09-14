@extends('layouts.dashboard')
@section('title', 'Manajemen Pengumuman')
@section('content')
<div x-data="{ modalOpen: false, editing: null }">
    <div class="mb-4 flex justify-end">
        <button @click="editing = null; modalOpen = true" class="btn-primary">+ Tambah Pengumuman</button>
    </div>

    <div class="card overflow-x-auto p-4">
        <table class="w-full min-w-[700px] text-left text-sm">
            <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Judul</th><th>Status</th><th>Tanggal</th><th></th></tr></thead>
            <tbody>
                @forelse ($pengumuman as $p)
                    <tr class="border-b border-gray-50">
                        <td class="py-2 max-w-md">{{ $p->judul }}</td>
                        <td><x-status-badge :status="$p->status" /></td>
                        <td>{{ $p->published_at?->translatedFormat('d M Y') ?? '-' }}</td>
                        <td class="space-x-2 whitespace-nowrap py-2">
                            <button @click="editing = { id: {{ $p->id }}, judul: @js($p->judul), isi: @js($p->isi), status: @js($p->status), action: '{{ route('admin.pengumuman.update', $p) }}' }; modalOpen = true" class="text-sanpedro-600 hover:underline">Edit</button>
                            <form method="POST" action="{{ route('admin.pengumuman.destroy', $p) }}" class="inline" onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada pengumuman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $pengumuman->links() }}</div>

    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="modalOpen = false" class="w-full max-w-lg rounded-xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 font-semibold text-gray-800" x-text="editing ? 'Edit Pengumuman' : 'Tambah Pengumuman'"></h2>
            <form method="POST" :action="editing ? editing.action : '{{ route('admin.pengumuman.store') }}'" class="space-y-4">
                @csrf
                <template x-if="editing"><input type="hidden" name="_method" value="PUT"></template>
                <div><label class="label">Judul</label><input type="text" name="judul" :value="editing ? editing.judul : ''" class="input" required></div>
                <div><label class="label">Isi</label><textarea name="isi" rows="4" class="input" required x-text="editing ? editing.isi : ''"></textarea></div>
                <div>
                    <label class="label">Status</label>
                    <select name="status" class="input" required>
                        <option value="draft" :selected="editing && editing.status === 'draft'">Draft</option>
                        <option value="terbit" :selected="!editing || editing.status === 'terbit'">Terbit</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="btn-primary">Simpan</button>
                    <button type="button" @click="modalOpen = false" class="btn-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
