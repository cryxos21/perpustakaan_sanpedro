@extends('layouts.app')
@section('title', 'Tata Tertib')
@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Tata Tertib Perpustakaan</h1>
    <ol class="mt-8 list-inside list-decimal space-y-3 text-sm text-gray-600">
        <li>Anggota wajib menunjukkan kartu anggota yang masih aktif saat melakukan peminjaman.</li>
        <li>Peminjaman buku dilakukan sesuai batas waktu yang ditentukan oleh petugas perpustakaan.</li>
        <li>Keterlambatan pengembalian buku dikenakan denda sesuai tarif yang berlaku.</li>
        <li>Buku yang hilang atau rusak menjadi tanggung jawab peminjam.</li>
        <li>Pengunjung wajib menjaga ketenangan dan kebersihan ruang baca.</li>
        <li>Dilarang membawa makanan dan minuman ke dalam ruang koleksi.</li>
    </ol>
</div>
@endsection
