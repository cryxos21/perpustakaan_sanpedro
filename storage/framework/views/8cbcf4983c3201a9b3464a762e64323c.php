<?php $__env->startSection('title', 'Manajemen Penulis'); ?>
<?php $__env->startSection('content'); ?>
<div x-data="{ modalOpen: false, editing: null }">
    <div class="mb-4 flex justify-end">
        <button @click="editing = null; modalOpen = true" class="btn-primary">+ Tambah Penulis</button>
    </div>

    <div class="card overflow-x-auto p-4">
        <table class="w-full min-w-[500px] text-left text-sm">
            <thead><tr class="border-b border-gray-100 text-gray-400"><th class="py-2">Foto</th><th>Nama</th><th>Jumlah Buku</th><th></th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $penulis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-gray-50">
                        <td class="py-2"><img src="<?php echo e($p->foto ? asset('storage/'.$p->foto) : asset('images/avatar-placeholder.png')); ?>" class="h-10 w-10 rounded-full object-cover"></td>
                        <td><?php echo e($p->nama); ?></td>
                        <td><?php echo e($p->buku_count); ?></td>
                        <td class="space-x-2 whitespace-nowrap py-2">
                            <button @click="editing = { id: <?php echo e($p->id); ?>, nama: <?php echo \Illuminate\Support\Js::from($p->nama)->toHtml() ?>, biografi: <?php echo \Illuminate\Support\Js::from($p->biografi)->toHtml() ?>, action: '<?php echo e(route('admin.penulis.update', $p)); ?>' }; modalOpen = true" class="text-sanpedro-600 hover:underline">Edit</button>
                            <form method="POST" action="<?php echo e(route('admin.penulis.destroy', $p)); ?>" class="inline" onsubmit="return confirm('Hapus penulis ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada penulis.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($penulis->links()); ?></div>

    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="modalOpen = false" class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 font-semibold text-gray-800" x-text="editing ? 'Edit Penulis' : 'Tambah Penulis'"></h2>
            <form method="POST" :action="editing ? editing.action : '<?php echo e(route('admin.penulis.store')); ?>'" enctype="multipart/form-data" class="space-y-4">
                <?php echo csrf_field(); ?>
                <template x-if="editing"><input type="hidden" name="_method" value="PUT"></template>
                <div>
                    <label class="label">Nama</label>
                    <input type="text" name="nama" :value="editing ? editing.nama : ''" class="input" required>
                </div>
                <div>
                    <label class="label">Biografi</label>
                    <textarea name="biografi" rows="3" class="input" x-text="editing ? editing.biografi : ''"></textarea>
                </div>
                <div>
                    <label class="label">Foto</label>
                    <input type="file" name="foto" accept="image/*" class="input">
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

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/penulis/index.blade.php ENDPATH**/ ?>