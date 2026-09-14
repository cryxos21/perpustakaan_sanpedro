@extends('layouts.dashboard')
@section('title', $buku->exists ? 'Edit Buku' : 'Tambah Buku')
@section('content')
<div class="card mx-auto max-w-2xl p-6">
    <form method="POST" action="{{ $buku->exists ? route('admin.buku.update', $buku) : route('admin.buku.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if ($buku->exists) @method('PUT') @endif

        <div>
            <label class="label">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" class="input" required>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <label class="label">Kategori</label>
                <select name="kategori_id" class="input" required>
                    <option value="">Pilih</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}" @selected(old('kategori_id', $buku->kategori_id) == $k->id)>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Penulis</label>
                <select name="penulis_id" class="input" required>
                    <option value="">Pilih</option>
                    @foreach ($penulis as $p)
                        <option value="{{ $p->id }}" @selected(old('penulis_id', $buku->penulis_id) == $p->id)>{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Penerbit</label>
                <select name="penerbit_id" class="input" required>
                    <option value="">Pilih</option>
                    @foreach ($penerbit as $p)
                        <option value="{{ $p->id }}" @selected(old('penerbit_id', $buku->penerbit_id) == $p->id)>{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <label class="label">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $buku->isbn) }}" class="input" required>
            </div>
            <div>
                <label class="label">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" class="input">
            </div>
            <div>
                <label class="label">Jumlah Halaman</label>
                <input type="number" name="jumlah_halaman" value="{{ old('jumlah_halaman', $buku->jumlah_halaman) }}" class="input">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="label">Stok</label>
                <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" class="input" required min="0">
            </div>
            <div>
                <label class="label">Lokasi Rak</label>
                <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak', $buku->lokasi_rak) }}" class="input">
            </div>
        </div>

        <div>
            <label class="label">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="input">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="label">Cover Buku {{ $buku->exists ? '(kosongkan jika tidak diubah)' : '' }}</label>
            @if ($buku->cover)
                <img src="{{ $buku->coverUrl() }}" class="mb-2 h-24 w-18 rounded object-cover">
            @endif
            <input type="file" name="cover" accept="image/*" class="input">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.buku.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
