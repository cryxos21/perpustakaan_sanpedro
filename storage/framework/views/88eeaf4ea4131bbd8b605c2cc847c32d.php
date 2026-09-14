<?php $__env->startSection('title', 'Manajemen Berita'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari judul berita..." class="input">
        <button class="btn-secondary">Cari</button>
    </form>
    <a href="<?php echo e(route('admin.berita.create')); ?>" class="btn-primary">+ Tambah Berita</a>
</div>

<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[700px] text-left text-sm">
        <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Thumbnail</th><th>Judul</th><th>Penulis</th><th>Status</th><th>Tanggal</th><th></th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-50">
                    <td class="py-2"><img src="<?php echo e($b->thumbnailUrl()); ?>" class="h-12 w-16 rounded object-cover"></td>
                    <td class="max-w-xs"><?php echo e($b->judul); ?></td>
                    <td><?php echo e($b->user->name ?? '-'); ?></td>
                    <td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $b->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($b->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?></td>
                    <td><?php echo e($b->published_at?->translatedFormat('d M Y') ?? '-'); ?></td>
                    <td class="space-x-2 whitespace-nowrap py-2">
                        <a href="<?php echo e(route('admin.berita.edit', $b)); ?>" class="text-sanpedro-600 hover:underline">Edit</a>
                        <form method="POST" action="<?php echo e(route('admin.berita.destroy', $b)); ?>" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="py-6 text-center text-gray-400">Belum ada berita.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($berita->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>