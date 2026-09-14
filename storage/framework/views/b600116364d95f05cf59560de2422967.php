<?php $__env->startSection('title', 'Katalog Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Katalog Buku</h1>
    <p class="mt-1 text-sm text-gray-500">Temukan buku dan referensi akademik yang Anda butuhkan.</p>

    <form method="GET" action="<?php echo e(route('katalog.index')); ?>" class="mt-6 grid gap-3 rounded-xl bg-white p-4 shadow-sm sm:grid-cols-2 lg:grid-cols-6">
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari judul, ISBN, penulis..." class="input lg:col-span-2">

        <select name="kategori" class="input">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k->id); ?>" <?php if(request('kategori') == $k->id): echo 'selected'; endif; ?>><?php echo e($k->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="penulis" class="input">
            <option value="">Semua Penulis</option>
            <?php $__currentLoopData = $penulis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($p->id); ?>" <?php if(request('penulis') == $p->id): echo 'selected'; endif; ?>><?php echo e($p->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="penerbit" class="input">
            <option value="">Semua Penerbit</option>
            <?php $__currentLoopData = $penerbit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($p->id); ?>" <?php if(request('penerbit') == $p->id): echo 'selected'; endif; ?>><?php echo e($p->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="tahun" class="input">
            <option value="">Semua Tahun</option>
            <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($t): ?>
                    <option value="<?php echo e($t); ?>" <?php if(request('tahun') == $t): echo 'selected'; endif; ?>><?php echo e($t); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="ketersediaan" class="input">
            <option value="">Semua Status</option>
            <option value="tersedia" <?php if(request('ketersediaan') == 'tersedia'): echo 'selected'; endif; ?>>Tersedia</option>
            <option value="dipinjam" <?php if(request('ketersediaan') == 'dipinjam'): echo 'selected'; endif; ?>>Dipinjam</option>
        </select>

        <div class="flex gap-2 lg:col-span-6">
            <button type="submit" class="btn-primary">Terapkan Filter</button>
            <a href="<?php echo e(route('katalog.index')); ?>" class="btn-secondary">Reset</a>
        </div>
    </form>

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
            <p class="col-span-full py-10 text-center text-sm text-gray-500">Buku tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="mt-8">
        <?php echo e($buku->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/public/katalog.blade.php ENDPATH**/ ?>