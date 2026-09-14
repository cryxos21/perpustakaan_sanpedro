@props(['status'])
@php
    $map = [
        'menunggu' => 'bg-yellow-50 text-yellow-700',
        'dipinjam' => 'bg-blue-50 text-blue-700',
        'ditolak' => 'bg-red-50 text-red-700',
        'dikembalikan' => 'bg-green-50 text-green-700',
        'terlambat' => 'bg-red-50 text-red-700',
        'tersedia' => 'bg-green-50 text-green-700',
        'selesai' => 'bg-gray-100 text-gray-600',
        'dibatalkan' => 'bg-gray-100 text-gray-500',
        'draft' => 'bg-gray-100 text-gray-600',
        'terbit' => 'bg-green-50 text-green-700',
        'aktif' => 'bg-green-50 text-green-700',
        'nonaktif' => 'bg-gray-100 text-gray-500',
    ];
    $label = [
        'menunggu' => 'Menunggu', 'dipinjam' => 'Dipinjam', 'ditolak' => 'Ditolak',
        'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat', 'tersedia' => 'Tersedia',
        'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan', 'draft' => 'Draft', 'terbit' => 'Terbit',
        'aktif' => 'Aktif', 'nonaktif' => 'Nonaktif',
    ];
@endphp
<span class="badge {{ $map[$status] ?? 'bg-gray-100 text-gray-600' }}">{{ $label[$status] ?? ucfirst($status) }}</span>
