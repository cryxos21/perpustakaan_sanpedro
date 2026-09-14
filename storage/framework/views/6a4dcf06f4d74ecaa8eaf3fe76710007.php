<?php
    $menu = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Katalog', 'route' => 'katalog.index'],
        ['label' => 'Kategori', 'route' => 'kategori.index'],
        ['label' => 'Layanan', 'route' => 'layanan'],
        ['label' => 'Berita', 'route' => 'berita.index'],
        ['label' => 'Tentang', 'route' => 'tentang'],
        ['label' => 'Kontak', 'route' => 'kontak'],
    ];
?>
<header x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
        :class="scrolled ? 'shadow-md bg-white' : 'bg-white'"
        class="sticky top-0 z-40 border-b border-gray-100 transition-all">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3">
            <img src="<?php echo e(asset('images/logo-universitas.png')); ?>" alt="Logo Universitas San Pedro" class="h-10 w-10 rounded-full object-cover" onerror="this.src='<?php echo e(asset('images/logo-placeholder.png')); ?>'">
            <div class="leading-tight">
                <p class="text-sm font-bold text-sanpedro-800 sm:text-base">Universitas San Pedro</p>
                <p class="text-[11px] text-gray-500 sm:text-xs">Cerdas, Beriman, dan Mandiri</p>
            </div>
        </a>

        <nav class="hidden items-center gap-6 lg:flex">
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route($item['route'])); ?>"
                   class="text-sm font-medium <?php echo e(request()->routeIs($item['route']) ? 'text-sanpedro-600' : 'text-gray-600 hover:text-sanpedro-600'); ?>">
                    <?php echo e($item['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(auth()->user()->isMahasiswa() ? route('mahasiswa.dashboard') : route('admin.dashboard')); ?>" class="btn-primary">Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="btn-primary">Login</a>
            <?php endif; ?>
        </div>

        <button @click="open = !open" class="rounded-md p-2 text-gray-600 hover:bg-gray-100 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
    </div>

    <div x-show="open" x-cloak class="border-t border-gray-100 bg-white lg:hidden">
        <div class="space-y-1 px-4 py-3">
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route($item['route'])); ?>" class="block rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <?php echo e($item['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(auth()->user()->isMahasiswa() ? route('mahasiswa.dashboard') : route('admin.dashboard')); ?>" class="mt-2 block rounded-md bg-sanpedro-600 px-3 py-2 text-center text-sm font-semibold text-white">Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="mt-2 block rounded-md bg-sanpedro-600 px-3 py-2 text-center text-sm font-semibold text-white">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/components/navbar.blade.php ENDPATH**/ ?>