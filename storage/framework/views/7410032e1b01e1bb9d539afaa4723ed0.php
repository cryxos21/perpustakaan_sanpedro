<?php $__env->startSection('title', 'Manajemen Pengumuman'); ?>
<?php $__env->startSection('content'); ?>
<div x-data="{ modalOpen: false, editing: null }">
    <div class="mb-4 flex justify-end">
        <button @click="editing = null; modalOpen = true" class="btn-primary">+ Tambah Pengumuman</button>
    </div>

    <div class="card overflow-x-auto p-4">
        <table class="w-full min-w-[700px] text-left text-sm">
            <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Judul</th><th>Status</th><th>Tanggal</th><th></th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-gray-50">
                        <td class="py-2 max-w-md"><?php echo e($p->judul); ?></td>
                        <td><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $p->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($p->status)]); ?>
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
                        <td><?php echo e($p->published_at?->translatedFormat('d M Y') ?? '-'); ?></td>
                        <td class="space-x-2 whitespace-nowrap py-2">
                            <button @click="editing = { id: <?php echo e($p->id); ?>, judul: <?php echo \Illuminate\Support\Js::from($p->judul)->toHtml() ?>, isi: <?php echo \Illuminate\Support\Js::from($p->isi)->toHtml() ?>, status: <?php echo \Illuminate\Support\Js::from($p->status)->toHtml() ?>, action: '<?php echo e(route('admin.pengumuman.update', $p)); ?>' }; modalOpen = true" class="text-sanpedro-600 hover:underline">Edit</button>
                            <form method="POST" action="<?php echo e(route('admin.pengumuman.destroy', $p)); ?>" class="inline" onsubmit="return confirm('Hapus pengumuman ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada pengumuman.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($pengumuman->links()); ?></div>

    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="modalOpen = false" class="w-full max-w-lg rounded-xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 font-semibold text-gray-800" x-text="editing ? 'Edit Pengumuman' : 'Tambah Pengumuman'"></h2>
            <form method="POST" :action="editing ? editing.action : '<?php echo e(route('admin.pengumuman.store')); ?>'" class="space-y-4">
                <?php echo csrf_field(); ?>
                <template x-if="editing"><input type="hidden" name="_method" value="PUT"></template>
                <div><label class="label">Judul</label><input type="text" name="judul" :value="editing ? editing.judul : ''" class="input" required></div>
                <div><label class="label">Isi</label><textarea name="isi" rows="4" class="input" required x-text="editing ? editing.isi : ''"></textarea></div>
                <div>
                    <label class="label">Status</label>
                    <select name="status" class="input" required>
                        <option value="draft" :selected="editing && editing.status === 'draft'">Draft</option>
                        <option value="terbit" :selected="!editing || editing.status === 'terbit'">Terbit</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="btn-primary">Simpan</button>
                    <button type="button" @click="modalOpen = false" class="btn-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/pengumuman/index.blade.php ENDPATH**/ ?>