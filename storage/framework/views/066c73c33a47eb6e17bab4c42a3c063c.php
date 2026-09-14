<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-2 gap-4 lg:grid-cols-3 xl:grid-cols-6">
    <?php $__currentLoopData = [
        ['label' => 'Total Buku', 'value' => $stats['total_buku']],
        ['label' => 'Total Anggota', 'value' => $stats['total_anggota']],
        ['label' => 'Total Peminjaman', 'value' => $stats['total_peminjaman']],
        ['label' => 'Total Pengembalian', 'value' => $stats['total_pengembalian']],
        ['label' => 'Buku Terlambat', 'value' => $stats['buku_terlambat']],
        ['label' => 'Menunggu Persetujuan', 'value' => $stats['menunggu_persetujuan']],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card p-5">
            <p class="text-xs text-gray-400"><?php echo e($item['label']); ?></p>
            <p class="mt-1 text-2xl font-bold text-sanpedro-700"><?php echo e(number_format($item['value'])); ?></p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Peminjaman per Bulan (<?php echo e(date('Y')); ?>)</h2>
        <div class="flex h-48 items-end gap-2">
            <?php ($max = max($peminjamanPerBulan->max() ?: 1, 1)); ?>
            <?php for($m = 1; $m <= 12; $m++): ?>
                <?php ($val = $peminjamanPerBulan[$m] ?? 0); ?>
                <div class="flex flex-1 flex-col items-center gap-1">
                    <div class="w-full rounded-t bg-sanpedro-500" style="height: <?php echo e($val > 0 ? ($val / $max) * 100 : 2); ?>%"></div>
                    <span class="text-[10px] text-gray-400"><?php echo e(\Carbon\Carbon::create()->month($m)->translatedFormat('M')); ?></span>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Pengembalian per Bulan (<?php echo e(date('Y')); ?>)</h2>
        <div class="flex h-48 items-end gap-2">
            <?php ($max2 = max($pengembalianPerBulan->max() ?: 1, 1)); ?>
            <?php for($m = 1; $m <= 12; $m++): ?>
                <?php ($val = $pengembalianPerBulan[$m] ?? 0); ?>
                <div class="flex flex-1 flex-col items-center gap-1">
                    <div class="w-full rounded-t bg-sanpedro_gold-500" style="height: <?php echo e($val > 0 ? ($val / $max2) * 100 : 2); ?>%"></div>
                    <span class="text-[10px] text-gray-400"><?php echo e(\Carbon\Carbon::create()->month($m)->translatedFormat('M')); ?></span>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Buku Paling Banyak Dipinjam</h2>
        <ul class="space-y-2 text-sm">
            <?php $__empty_1 = true; $__currentLoopData = $bukuPopuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="flex items-center justify-between border-b border-gray-50 pb-2">
                    <span class="text-gray-700"><?php echo e($b->judul); ?></span>
                    <span class="font-semibold text-sanpedro-600"><?php echo e($b->total); ?>x</span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="text-gray-400">Belum ada data.</li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Kategori Paling Populer</h2>
        <ul class="space-y-2 text-sm">
            <?php $__empty_1 = true; $__currentLoopData = $kategoriPopuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="flex items-center justify-between border-b border-gray-50 pb-2">
                    <span class="text-gray-700"><?php echo e($k->nama); ?></span>
                    <span class="font-semibold text-sanpedro-600"><?php echo e($k->total); ?>x</span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="text-gray-400">Belum ada data.</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="mt-6 card overflow-x-auto p-6">
    <h2 class="mb-4 font-semibold text-gray-800">Peminjaman Terbaru</h2>
    <table class="w-full min-w-[500px] text-left text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-gray-400">
                <th class="pb-2">Kode</th><th class="pb-2">Mahasiswa</th><th class="pb-2">Buku</th><th class="pb-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $peminjamanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-50">
                    <td class="py-2"><?php echo e($p->kode_peminjaman); ?></td>
                    <td class="py-2"><?php echo e($p->mahasiswa->nama); ?></td>
                    <td class="py-2"><?php echo e($p->detailPeminjaman->pluck('buku.judul')->join(', ')); ?></td>
                    <td class="py-2"><?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
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
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="py-4 text-center text-gray-400">Belum ada peminjaman.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>