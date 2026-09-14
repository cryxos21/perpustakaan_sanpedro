@extends('layouts.dashboard')
@section('title', $berita->exists ? 'Edit Berita' : 'Tambah Berita')
@section('content')
<div class="card mx-auto max-w-2xl p-6">
    <form method="POST" action="{{ $berita->exists ? route('admin.berita.update', $berita) : route('admin.berita.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if ($berita->exists) @method('PUT') @endif

        <div><label class="label">Judul</label><input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" class="input" required></div>
        <div><label class="label">Isi Berita</label><textarea name="isi" rows="8" class="input" required>{{ old('isi', $berita->isi) }}</textarea></div>

        <div>
            <label class="label">Thumbnail {{ $berita->exists ? '(kosongkan jika tidak diubah)' : '' }}</label>
            @if ($berita->thumbnail)
                <img src="{{ $berita->thumbnailUrl() }}" class="mb-2 h-24 w-32 rounded object-cover">
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="input">
        </div>

        <div>
            <label class="label">Status</label>
            <select name="status" class="input" required>
                <option value="draft" @selected(old('status', $berita->status) == 'draft')>Draft</option>
                <option value="terbit" @selected(old('status', $berita->status) == 'terbit')>Terbit</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
