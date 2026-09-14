<?php $__env->startSection('title', 'Manajemen Kategori'); ?>
<?php $__env->startSection('content'); ?>
<div x-data="{ modalOpen: false, editing: null }">
    <div class="mb-4 flex justify-end">
        <button @click="editing = null; modalOpen = true" class="btn-primary">+ Tambah Kategori</button>
    </div>

    <div class="card overflow-x-auto p-4">
        <table class="w-full min-w-[500px] text-left text-sm">
            <thead>
                <tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Nama</th><th>Deskripsi</th><th>Jumlah Buku</th><th></th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-gray-50">
                        <td class="py-2"><?php echo e($k->nama); ?></td>
                        <td class="max-w-sm truncate"><?php echo e($k->deskripsi); ?></td>
                        <td><?php echo e($k->buku_count); ?></td>
                        <td class="space-x-2 whitespace-nowrap py-2">
                            <button @click="editing = { id: <?php echo e($k->id); ?>, nama: <?php echo \Illuminate\Support\Js::from($k->nama)->toHtml() ?>, deskripsi: <?php echo \Illuminate\Support\Js::from($k->deskripsi)->toHtml() ?>, action: '<?php echo e(route('admin.kategori.update', $k)); ?>' }; modalOpen = true" class="text-sanpedro-600 hover:underline">Edit</button>
                            <form method="POST" action="<?php echo e(route('admin.kategori.destroy', $k)); ?>" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada kategori.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($kategori->links()); ?></div>

    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="modalOpen = false" class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 font-semibold text-gray-800" x-text="editing ? 'Edit Kategori' : 'Tambah Kategori'"></h2>
            <form method="POST" :action="editing ? editing.action : '<?php echo e(route('admin.kategori.store')); ?>'" class="space-y-4">
                <?php echo csrf_field(); ?>
                <template x-if="editing"><input type="hidden" name="_method" value="PUT"></template>
                <div>
                    <label class="label">Nama Kategori</label>
                    <input type="text" name="nama" :value="editing ? editing.nama : ''" class="input" required>
                </div>
                <div>
                    <label class="label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="input" x-text="editing ? editing.deskripsi : ''"></textarea>
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

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/kategori/index.blade.php ENDPATH**/ ?>