@extends('layouts.dashboard')
@section('title', 'Pengaturan Perpustakaan')
@section('content')
<div class="card mx-auto max-w-2xl p-6">
    <form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="label">Logo Perpustakaan</label>
            @if ($pengaturan->logo)
                <img src="{{ asset('storage/'.$pengaturan->logo) }}" class="mb-2 h-16 w-16 rounded-full object-cover">
            @endif
            <input type="file" name="logo" accept="image/*" class="input">
            <p class="mt-1 text-xs text-gray-400">Catatan: file ini menggantikan tampilan logo di halaman pengaturan. Logo utama navbar tetap berasal dari public/images/logo-universitas.png.</p>
        </div>

        <div><label class="label">Nama Perpustakaan</label><input type="text" name="nama_perpustakaan" value="{{ old('nama_perpustakaan', $pengaturan->nama_perpustakaan) }}" class="input" required></div>
        <div><label class="label">Alamat</label><textarea name="alamat" rows="2" class="input">{{ old('alamat', $pengaturan->alamat) }}</textarea></div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="label">Email</label><input type="email" name="email" value="{{ old('email', $pengaturan->email) }}" class="input"></div>
            <div><label class="label">Telepon</label><input type="text" name="telepon" value="{{ old('telepon', $pengaturan->telepon) }}" class="input"></div>
        </div>

        <div><label class="label">Jam Pelayanan</label><input type="text" name="jam_pelayanan" value="{{ old('jam_pelayanan', $pengaturan->jam_pelayanan) }}" class="input"></div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="label">Tarif Denda per Hari (Rp)</label>
                <input type="number" name="tarif_denda_per_hari" value="{{ old('tarif_denda_per_hari', $pengaturan->tarif_denda_per_hari) }}" class="input" required min="0">
            </div>
            <div>
                <label class="label">Lama Peminjaman (hari)</label>
                <input type="number" name="lama_peminjaman_hari" value="{{ old('lama_peminjaman_hari', $pengaturan->lama_peminjaman_hari) }}" class="input" required min="1">
            </div>
        </div>

        <button type="submit" class="btn-primary">Simpan Pengaturan</button>
    </form>
</div>
@endsection
