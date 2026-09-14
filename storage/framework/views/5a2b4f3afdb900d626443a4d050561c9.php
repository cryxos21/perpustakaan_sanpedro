<?php $__env->startSection('title', 'Profil Saya'); ?>
<?php $__env->startSection('content'); ?>
<div class="mx-auto max-w-2xl space-y-6">
    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Informasi Akun</h2>
        <form method="POST" action="<?php echo e(route('admin.profil.update')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <div><label class="label">Nama</label><input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="input" required></div>
            <div><label class="label">Email</label><input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="input" required></div>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <div class="card p-6">
        <h2 class="mb-4 font-semibold text-gray-800">Ubah Password</h2>
        <form method="POST" action="<?php echo e(route('admin.profil.password')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <div><label class="label">Password Saat Ini</label><input type="password" name="current_password" class="input" required></div>
            <div><label class="label">Password Baru</label><input type="password" name="password" class="input" required></div>
            <div><label class="label">Konfirmasi Password Baru</label><input type="password" name="password_confirmation" class="input" required></div>
            <button type="submit" class="btn-primary">Ubah Password</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/profil.blade.php ENDPATH**/ ?>