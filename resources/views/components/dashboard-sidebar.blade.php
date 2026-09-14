@php
    $isAdminArea = auth()->user()->isAdmin() || auth()->user()->isPetugas();

    $adminMenu = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
        ['label' => 'Buku', 'route' => 'admin.buku.index'],
        ['label' => 'Kategori', 'route' => 'admin.kategori.index'],
        ['label' => 'Penulis', 'route' => 'admin.penulis.index'],
        ['label' => 'Penerbit', 'route' => 'admin.penerbit.index'],
        ['label' => 'Anggota', 'route' => 'admin.mahasiswa.index'],
        ['label' => 'Peminjaman', 'route' => 'admin.peminjaman.index'],
        ['label' => 'Pengembalian', 'route' => 'admin.pengembalian.index'],
        ['label' => 'Reservasi', 'route' => 'admin.reservasi.index'],
        ['label' => 'Berita', 'route' => 'admin.berita.index'],
        ['label' => 'Pengumuman', 'route' => 'admin.pengumuman.index'],
        ['label' => 'Pengaturan', 'route' => 'admin.pengaturan.edit', 'admin_only' => true],
        ['label' => 'Profil Saya', 'route' => 'admin.profil.edit'],
    ];

    $mahasiswaMenu = [
        ['label' => 'Dashboard', 'route' => 'mahasiswa.dashboard'],
        ['label' => 'Katalog Buku', 'route' => 'katalog.index'],
        ['label' => 'Peminjaman Saya', 'route' => 'mahasiswa.peminjaman.index'],
        ['label' => 'Reservasi', 'route' => 'mahasiswa.reservasi.index'],
        ['label' => 'Riwayat', 'route' => 'mahasiswa.riwayat.index'],
        ['label' => 'Profil', 'route' => 'mahasiswa.profil.edit'],
    ];

    $menu = $isAdminArea ? $adminMenu : $mahasiswaMenu;
@endphp
<aside id="dashboard-sidebar" class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full transform bg-sanpedro-900 text-sanpedro-100 transition-transform duration-200 lg:static lg:translate-x-0">
    <div class="flex h-16 items-center gap-3 border-b border-sanpedro-800 px-5">
        <img src="{{ asset('images/logo-universitas.png') }}" alt="Logo" class="h-9 w-9 rounded-full object-cover" onerror="this.src='{{ asset('images/logo-placeholder.png') }}'">
        <div class="leading-tight">
            <p class="text-sm font-bold text-white">Perpustakaan</p>
            <p class="text-[11px] text-sanpedro-300">Universitas San Pedro</p>
        </div>
    </div>

    <nav class="space-y-1 px-3 py-4">
        @foreach ($menu as $item)
            @if (!($item['admin_only'] ?? false) || auth()->user()->isAdmin())
                <a href="{{ route($item['route']) }}"
                   class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs($item['route']) ? 'bg-sanpedro-700 text-white' : 'text-sanpedro-200 hover:bg-sanpedro-800 hover:text-white' }}">
                    {{ $item['label'] }}
                </a>
            @endif
        @endforeach
    </nav>
</aside>
