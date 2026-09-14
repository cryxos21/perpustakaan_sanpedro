<?php $__env->startSection('title', 'Kontak'); ?>
<?php $__env->startSection('content'); ?>
<?php ($pengaturan = \App\Models\Pengaturan::current()); ?>
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800">Kontak Kami</h1>
    <div class="mt-8 grid gap-4 rounded-xl bg-white p-6 shadow-sm sm:grid-cols-2">
        <div><p class="text-xs text-gray-400">Alamat</p><p class="text-sm font-medium text-gray-800"><?php echo e($pengaturan->alamat); ?></p></div>
        <div><p class="text-xs text-gray-400">Email</p><p class="text-sm font-medium text-gray-800"><?php echo e($pengaturan->email); ?></p></div>
        <div><p class="text-xs text-gray-400">Telepon</p><p class="text-sm font-medium text-gray-800"><?php echo e($pengaturan->telepon); ?></p></div>
        <div><p class="text-xs text-gray-400">Jam Pelayanan</p><p class="text-sm font-medium text-gray-800"><?php echo e($pengaturan->jam_pelayanan); ?></p></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/public/kontak.blade.php ENDPATH**/ ?>