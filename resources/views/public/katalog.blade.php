@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Katalog Buku</h1>
    <p class="mt-1 text-sm text-gray-500">Temukan buku dan referensi akademik yang Anda butuhkan.</p>

    <form method="GET" action="{{ route('katalog.index') }}" class="mt-6 grid gap-3 rounded-xl bg-white p-4 shadow-sm sm:grid-cols-2 lg:grid-cols-6">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul, ISBN, penulis..." class="input lg:col-span-2">

        <select name="kategori" class="input">
            <option value="">Semua Kategori</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id }}" @selected(request('kategori') == $k->id)>{{ $k->nama }}</option>
            @endforeach
        </select>

        <select name="penulis" class="input">
            <option value="">Semua Penulis</option>
            @foreach ($penulis as $p)
                <option value="{{ $p->id }}" @selected(request('penulis') == $p->id)>{{ $p->nama }}</option>
            @endforeach
        </select>

        <select name="penerbit" class="input">
            <option value="">Semua Penerbit</option>
            @foreach ($penerbit as $p)
                <option value="{{ $p->id }}" @selected(request('penerbit') == $p->id)>{{ $p->nama }}</option>
            @endforeach
        </select>

        <select name="tahun" class="input">
            <option value="">Semua Tahun</option>
            @foreach ($tahunList as $t)
                @if ($t)
                    <option value="{{ $t }}" @selected(request('tahun') == $t)>{{ $t }}</option>
                @endif
            @endforeach
        </select>

        <select name="ketersediaan" class="input">
            <option value="">Semua Status</option>
            <option value="tersedia" @selected(request('ketersediaan') == 'tersedia')>Tersedia</option>
            <option value="dipinjam" @selected(request('ketersediaan') == 'dipinjam')>Dipinjam</option>
        </select>

        <div class="flex gap-2 lg:col-span-6">
            <button type="submit" class="btn-primary">Terapkan Filter</button>
            <a href="{{ route('katalog.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>

    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @forelse ($buku as $b)
            <x-book-card :buku="$b" />
        @empty
            <p class="col-span-full py-10 text-center text-sm text-gray-500">Buku tidak ditemukan.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $buku->links() }}
    </div>
</div>
@endsection
