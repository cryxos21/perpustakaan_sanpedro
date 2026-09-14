@extends('layouts.dashboard')
@section('title', 'Profil Saya')
@section('content')
@php($mahasiswa = $user->mahasiswa)
<div class="mx-auto max-w-2xl space-y-6">
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Informasi Akun</h2>
        <form method="POST" action="{{ route('mahasiswa.profil.update') }}" class="space-y-4">
            @csrf @method('PUT')
            <div class="grid gap-4 sm:grid-cols-2">
                <div><label class="label">NIM</label><input type="text" value="{{ $mahasiswa->nim }}" class="input bg-gray-100" disabled></div>
                <div><label class="label">Status</label><input type="text" value="{{ ucfirst($mahasiswa->status) }}" class="input bg-gray-100" disabled></div>
            </div>
            <div><label class="label">Nama</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="input" required></div>
            <div><label class="label">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="input" required></div>
            <div><label class="label">No. HP</label><input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}" class="input"></div>
            <div><label class="label">Alamat</label><textarea name="alamat" rows="2" class="input">{{ old('alamat', $mahasiswa->alamat) }}</textarea></div>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Ubah Password</h2>
        <form method="POST" action="{{ route('mahasiswa.profil.password') }}" class="space-y-4">
            @csrf @method('PUT')
            <div><label class="label">Password Saat Ini</label><input type="password" name="current_password" class="input" required></div>
            <div><label class="label">Password Baru</label><input type="password" name="password" class="input" required></div>
            <div><label class="label">Konfirmasi Password Baru</label><input type="password" name="password_confirmation" class="input" required></div>
            <button type="submit" class="btn-primary">Ubah Password</button>
        </form>
    </div>
</div>
@endsection
