<?php $__env->startSection('title', 'Kategori Buku'); ?>
<?php $__env->startSection('content'); ?>
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Kategori Buku</h1>
    <p class="mt-1 text-sm text-gray-500">Jelajahi koleksi buku berdasarkan kategori.</p>

    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('kategori.show', $k)); ?>" class="card p-6 text-center transition hover:shadow-md hover:-translate-y-0.5">
                <p class="font-semibold text-gray-800"><?php echo e($k->nama); ?></p>
                <p class="mt-1 text-xs text-gray-500"><?php echo e($k->buku_count); ?> buku</p>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/public/kategori.blade.php ENDPATH**/ ?>