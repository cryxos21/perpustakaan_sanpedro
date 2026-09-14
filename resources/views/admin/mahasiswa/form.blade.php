@extends('layouts.dashboard')
@section('title', $mahasiswa->exists ? 'Edit Anggota' : 'Tambah Anggota')
@section('content')
<div class="card mx-auto max-w-2xl p-6">
    <form method="POST" action="{{ $mahasiswa->exists ? route('admin.mahasiswa.update', $mahasiswa) : route('admin.mahasiswa.store') }}" class="space-y-4">
        @csrf
        @if ($mahasiswa->exists) @method('PUT') @endif

        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="label">Nama Lengkap</label><input type="text" name="name" value="{{ old('name', $mahasiswa->nama) }}" class="input" required></div>
            <div><label class="label">Email</label><input type="email" name="email" value="{{ old('email', $mahasiswa->user->email ?? '') }}" class="input" required></div>
        </div>

        @unless ($mahasiswa->exists)
            <div><label class="label">Password</label><input type="password" name="password" class="input" required></div>
        @endunless

        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="label">NIM</label><input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="input" required></div>
            <div>
                <label class="label">Status</label>
                <select name="status" class="input" required>
                    <option value="aktif" @selected(old('status', $mahasiswa->status) == 'aktif')>Aktif</option>
                    <option value="nonaktif" @selected(old('status', $mahasiswa->status) == 'nonaktif')>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="label">Fakultas</label><input type="text" name="fakultas" value="{{ old('fakultas', $mahasiswa->fakultas) }}" class="input"></div>
            <div><label class="label">Program Studi</label><input type="text" name="program_studi" value="{{ old('program_studi', $mahasiswa->program_studi) }}" class="input"></div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="label">Semester</label><input type="number" name="semester" value="{{ old('semester', $mahasiswa->semester) }}" class="input" min="1" max="14"></div>
            <div><label class="label">No. HP</label><input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}" class="input"></div>
        </div>

        <div><label class="label">Alamat</label><textarea name="alamat" rows="2" class="input">{{ old('alamat', $mahasiswa->alamat) }}</textarea></div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
