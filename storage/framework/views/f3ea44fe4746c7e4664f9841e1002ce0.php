<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>
<div class="mx-auto flex min-h-[70vh] max-w-md flex-col justify-center px-4 py-10 sm:px-6">
    <div class="card p-8">
        <div class="mb-6 text-center">
            <img src="<?php echo e(asset('images/logo-universitas.png')); ?>" alt="Logo" class="mx-auto h-14 w-14 rounded-full object-cover" onerror="this.src='<?php echo e(asset('images/logo-placeholder.png')); ?>'">
            <h1 class="mt-3 text-lg font-bold text-gray-800">Login Perpustakaan Universitas San Pedro</h1>
            <p class="text-xs text-gray-500">Cerdas, Beriman, dan Mandiri</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="label">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus class="input" placeholder="nama@sanpedro.ac.id">
            </div>
            <div>
                <label class="label">Password</label>
                <input type="password" name="password" required class="input" placeholder="Password">
            </div>
            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-sanpedro-600 focus:ring-sanpedro-500">
                Ingat saya
            </label>
            <button type="submit" class="btn-primary w-full">Login</button>
        </form>

        <div class="mt-6 rounded-lg bg-gray-50 p-4 text-xs text-gray-500">
            <p class="mb-1 font-semibold text-gray-600">Akun Demo:</p>
            <p>Admin: admin@sanpedro.ac.id / password</p>
            <p>Petugas: petugas@sanpedro.ac.id / password</p>
            <p>Mahasiswa: mahasiswa@sanpedro.ac.id / password</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/auth/login.blade.php ENDPATH**/ ?>