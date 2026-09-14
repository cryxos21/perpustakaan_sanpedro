<?php $__env->startSection('title', 'Berita Perpustakaan'); ?>
<?php $__env->startSection('content'); ?>
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Berita Perpustakaan</h1>

    <form method="GET" class="mt-4 flex max-w-md gap-2">
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari berita..." class="input">
        <button class="btn-primary">Cari</button>
    </form>

    <?php if($featured): ?>
        <a href="<?php echo e(route('berita.show', $featured)); ?>" class="card mt-8 flex flex-col overflow-hidden md:flex-row hover:shadow-md">
            <img src="<?php echo e($featured->thumbnailUrl()); ?>" class="h-56 w-full object-cover md:w-80" alt="<?php echo e($featured->judul); ?>">
            <div class="p-6">
                <span class="badge bg-sanpedro-50 text-sanpedro-700">Berita Utama</span>
                <h2 class="mt-2 text-xl font-bold text-gray-800"><?php echo e($featured->judul); ?></h2>
                <p class="mt-2 line-clamp-3 text-sm text-gray-600"><?php echo e(Str::limit(strip_tags($featured->isi), 200)); ?></p>
                <p class="mt-3 text-xs text-gray-400"><?php echo e($featured->published_at?->translatedFormat('d F Y')); ?></p>
            </div>
        </a>
    <?php endif; ?>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php $__empty_1 = true; $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('berita.show', $b)); ?>" class="card overflow-hidden hover:shadow-md">
                <img src="<?php echo e($b->thumbnailUrl()); ?>" class="h-40 w-full object-cover" alt="<?php echo e($b->judul); ?>">
                <div class="p-4">
                    <p class="line-clamp-2 font-semibold text-gray-800"><?php echo e($b->judul); ?></p>
                    <p class="mt-2 text-xs text-gray-400"><?php echo e($b->published_at?->translatedFormat('d F Y')); ?></p>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="col-span-full py-10 text-center text-sm text-gray-500">Belum ada berita.</p>
        <?php endif; ?>
    </div>

    <div class="mt-8"><?php echo e($berita->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/public/berita.blade.php ENDPATH**/ ?>