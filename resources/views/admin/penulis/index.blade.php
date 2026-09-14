@extends('layouts.dashboard')
@section('title', 'Manajemen Penulis')
@section('content')
<div x-data="{ modalOpen: false, editing: null }">
    <div class="mb-4 flex justify-end">
        <button @click="editing = null; modalOpen = true" class="btn-primary">+ Tambah Penulis</button>
    </div>

    <div class="card overflow-x-auto p-4">
        <table class="w-full min-w-[500px] text-left text-sm">
            <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Foto</th><th>Nama</th><th>Jumlah Buku</th><th></th></tr></thead>
            <tbody>
                @forelse ($penulis as $p)
                    <tr class="border-b border-gray-50">
                        <td class="py-2"><img src="{{ $p->foto ? asset('storage/'.$p->foto) : asset('images/avatar-placeholder.png') }}" class="h-10 w-10 rounded-full object-cover"></td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->buku_count }}</td>
                        <td class="space-x-2 whitespace-nowrap py-2">
                            <button @click="editing = { id: {{ $p->id }}, nama: @js($p->nama), biografi: @js($p->biografi), action: '{{ route('admin.penulis.update', $p) }}' }; modalOpen = true" class="text-sanpedro-600 hover:underline">Edit</button>
                            <form method="POST" action="{{ route('admin.penulis.destroy', $p) }}" class="inline" onsubmit="return confirm('Hapus penulis ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada penulis.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $penulis->links() }}</div>

    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="modalOpen = false" class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 font-semibold text-gray-800" x-text="editing ? 'Edit Penulis' : 'Tambah Penulis'"></h2>
            <form method="POST" :action="editing ? editing.action : '{{ route('admin.penulis.store') }}'" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <template x-if="editing"><input type="hidden" name="_method" value="PUT"></template>
                <div>
                    <label class="label">Nama</label>
                    <input type="text" name="nama" :value="editing ? editing.nama : ''" class="input" required>
                </div>
                <div>
                    <label class="label">Biografi</label>
                    <textarea name="biografi" rows="3" class="input" x-text="editing ? editing.biografi : ''"></textarea>
                </div>
                <div>
                    <label class="label">Foto</label>
                    <input type="file" name="foto" accept="image/*" class="input">
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
