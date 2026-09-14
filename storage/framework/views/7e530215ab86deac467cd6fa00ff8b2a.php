<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="relative overflow-hidden bg-gradient-to-br from-sanpedro-800 via-sanpedro-700 to-sanpedro-900">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div>
                <p class="mb-3 inline-block rounded-full bg-sanpedro_gold-400/20 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-sanpedro_gold-400">
                    Cerdas, Beriman, dan Mandiri
                </p>
                <h1 class="text-3xl font-extrabold leading-tight text-white sm:text-4xl lg:text-5xl">
                    Temukan Referensi Akademik Anda di Perpustakaan Universitas San Pedro
                </h1>
                <p class="mt-4 text-base text-sanpedro-100 sm:text-lg">
                    Akses koleksi buku, referensi akademik, dan informasi perpustakaan dengan mudah dalam satu platform.
                </p>

                <form action="<?php echo e(route('katalog.index')); ?>" method="GET" class="mt-8 flex overflow-hidden rounded-xl bg-white shadow-lg">
                    <input type="text" name="q" placeholder="Cari judul buku, penulis, ISBN..." class="w-full px-5 py-4 text-sm text-gray-700 focus:outline-none">
                    <button type="submit" class="flex items-center gap-2 bg-sanpedro_gold-500 px-6 py-4 text-sm font-semibold text-sanpedro-900 hover:bg-sanpedro_gold-400">
                        Cari Buku
                    </button>
                </form>
            </div>

            <div class="hidden lg:block">
                <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=80"
                     alt="Ilustrasi perpustakaan modern" class="rounded-2xl shadow-2xl">
            </div>
        </div>
    </section>

    
    <section class="mx-auto -mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-4 rounded-2xl bg-white p-6 shadow-lg lg:grid-cols-4">
            <?php $__currentLoopData = [
                ['label' => 'Total Buku', 'value' => $stats['total_buku']],
                ['label' => 'Total Anggota', 'value' => $stats['total_anggota']],
                ['label' => 'Buku Tersedia', 'value' => $stats['buku_tersedia']],
                ['label' => 'Buku Dipinjam', 'value' => $stats['buku_dipinjam']],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="text-center">
                    <p class="text-2xl font-extrabold text-sanpedro-700 sm:text-3xl"><?php echo e(number_format($item['value'])); ?>+</p>
                    <p class="mt-1 text-xs font-medium text-gray-500 sm:text-sm"><?php echo e($item['label']); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-800 sm:text-2xl">Buku Terbaru</h2>
            <a href="<?php echo e(route('katalog.index')); ?>" class="text-sm font-semibold text-sanpedro-600 hover:underline">Lihat semua &rarr;</a>
        </div>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
            <?php $__empty_1 = true; $__currentLoopData = $bukuTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if (isset($component)) { $__componentOriginalb2ad6158e46176d6a9dc77a41399ede1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2ad6158e46176d6a9dc77a41399ede1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.book-card','data' => ['buku' => $buku]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('book-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['buku' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($buku)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2ad6158e46176d6a9dc77a41399ede1)): ?>
<?php $attributes = $__attributesOriginalb2ad6158e46176d6a9dc77a41399ede1; ?>
<?php unset($__attributesOriginalb2ad6158e46176d6a9dc77a41399ede1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2ad6158e46176d6a9dc77a41399ede1)): ?>
<?php $component = $__componentOriginalb2ad6158e46176d6a9dc77a41399ede1; ?>
<?php unset($__componentOriginalb2ad6158e46176d6a9dc77a41399ede1); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-sm text-gray-500">Belum ada data buku.</p>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-6 text-xl font-bold text-gray-800 sm:text-2xl">Kategori Buku</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('kategori.show', $k)); ?>" class="card flex flex-col items-center gap-2 p-5 text-center transition hover:shadow-md hover:-translate-y-0.5">
                        <span class="text-sm font-semibold text-gray-800"><?php echo e($k->nama); ?></span>
                        <span class="text-xs text-gray-500"><?php echo e($k->buku_count); ?> buku</span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-xl font-bold text-gray-800 sm:text-2xl">Informasi Layanan</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php $__currentLoopData = [
                ['title' => 'Layanan Sirkulasi', 'desc' => 'Peminjaman dan pengembalian buku secara cepat dan terjadwal.'],
                ['title' => 'Layanan Referensi', 'desc' => 'Bantuan pustakawan untuk mencari sumber referensi akademik.'],
                ['title' => 'Layanan Digital', 'desc' => 'Akses ke sumber daya digital dan katalog online.'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card p-6">
                    <h3 class="mb-2 font-semibold text-sanpedro-700"><?php echo e($layanan['title']); ?></h3>
                    <p class="text-sm text-gray-600"><?php echo e($layanan['desc']); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section class="bg-white py-16">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Berita Perpustakaan</h2>
                    <a href="<?php echo e(route('berita.index')); ?>" class="text-sm font-semibold text-sanpedro-600 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('berita.show', $b)); ?>" class="card flex gap-4 p-3 hover:shadow-md">
                            <img src="<?php echo e($b->thumbnailUrl()); ?>" class="h-20 w-24 flex-shrink-0 rounded-lg object-cover" alt="<?php echo e($b->judul); ?>">
                            <div>
                                <p class="line-clamp-2 text-sm font-semibold text-gray-800"><?php echo e($b->judul); ?></p>
                                <p class="mt-1 text-xs text-gray-400"><?php echo e($b->published_at?->translatedFormat('d F Y')); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-gray-500">Belum ada berita.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Pengumuman</h2>
                    <a href="<?php echo e(route('pengumuman.index')); ?>" class="text-sm font-semibold text-sanpedro-600 hover:underline">Lihat semua &rarr;</a>
                </div>
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="card p-4">
                            <p class="text-sm font-semibold text-gray-800"><?php echo e($p->judul); ?></p>
                            <p class="mt-1 line-clamp-2 text-xs text-gray-500"><?php echo e(Str::limit(strip_tags($p->isi), 120)); ?></p>
                            <p class="mt-2 text-xs text-gray-400"><?php echo e($p->published_at?->translatedFormat('d F Y')); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-gray-500">Belum ada pengumuman.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/public/home.blade.php ENDPATH**/ ?>