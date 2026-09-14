<?php $__env->startSection('title', 'Manajemen Peminjaman'); ?>
<?php $__env->startSection('content'); ?>
<form method="GET" class="mb-4 flex flex-wrap gap-2">
    <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari nama / NIM..." class="input max-w-xs">
    <select name="status" class="input max-w-xs" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <?php $__currentLoopData = ['menunggu' => 'Menunggu', 'dipinjam' => 'Dipinjam', 'ditolak' => 'Ditolak', 'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($val); ?>" <?php if(request('status') == $val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button class="btn-secondary">Cari</button>
</form>

<div class="card overflow-x-auto p-4">
    <table class="w-full min-w-[800px] text-left text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-gray-400">
                <th class="py-2">Kode</th><th>Mahasiswa</th><th>Buku</th><th>Jatuh Tempo</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-50">
                    <td class="py-2"><?php echo e($p->kode_peminjaman); ?></td>
                    <td><?php echo e($p->mahasiswa->nama); ?> <span class="text-xs text-gray-400">(<?php echo e($p->mahasiswa->nim); ?>)</span></td>
                    <td><?php echo e($p->detailPeminjaman->pluck('buku.judul')->join(', ')); ?></td>
                    <td><?php echo e($p->tanggal_jatuh_tempo?->translatedFormat('d M Y') ?? '-'); ?></td>
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
                    <td class="whitespace-nowrap py-2">
                        <?php if($p->status === 'menunggu'): ?>
                            <form method="POST" action="<?php echo e(route('admin.peminjaman.setujui', $p)); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                                <button class="mr-2 text-green-600 hover:underline">Setujui</button>
                            </form>
                            <form method="POST" action="<?php echo e(route('admin.peminjaman.tolak', $p)); ?>" class="inline" onsubmit="return confirm('Tolak peminjaman ini?')">
                                <?php echo csrf_field(); ?>
                                <button class="text-red-600 hover:underline">Tolak</button>
                            </form>
                        <?php else: ?>
                            <span class="text-gray-400">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="py-6 text-center text-gray-400">Tidak ada data peminjaman.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($peminjaman->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/peminjaman/index.blade.php ENDPATH**/ ?>