<?php $__env->startSection('title', $kategori->nama); ?>
<?php $__env->startSection('content'); ?>
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800"><?php echo e($kategori->nama); ?></h1>
    <p class="mt-1 text-sm text-gray-500"><?php echo e($kategori->deskripsi); ?></p>

    <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        <?php $__empty_1 = true; $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if (isset($component)) { $__componentOriginalb2ad6158e46176d6a9dc77a41399ede1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2ad6158e46176d6a9dc77a41399ede1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.book-card','data' => ['buku' => $b]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('book-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['buku' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($b)]); ?>
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
            <p class="col-span-full py-10 text-center text-sm text-gray-500">Belum ada buku pada kategori ini.</p>
        <?php endif; ?>
    </div>

    <div class="mt-8"><?php echo e($buku->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/public/kategori-detail.blade.php ENDPATH**/ ?>