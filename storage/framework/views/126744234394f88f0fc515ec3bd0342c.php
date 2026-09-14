<?php $__env->startSection('title', 'Pengaturan Perpustakaan'); ?>
<?php $__env->startSection('content'); ?>
<div class="card mx-auto max-w-2xl p-6">
    <form method="POST" action="<?php echo e(route('admin.pengaturan.update')); ?>" enctype="multipart/form-data" class="space-y-4">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div>
            <label class="label">Logo Perpustakaan</label>
            <?php if($pengaturan->logo): ?>
                <img src="<?php echo e(asset('storage/'.$pengaturan->logo)); ?>" class="mb-2 h-16 w-16 rounded-full object-cover">
            <?php endif; ?>
            <input type="file" name="logo" accept="image/*" class="input">
            <p class="mt-1 text-xs text-gray-400">Catatan: file ini menggantikan tampilan logo di halaman pengaturan. Logo utama navbar tetap berasal dari public/images/logo-universitas.png.</p>
        </div>

        <div><label class="label">Nama Perpustakaan</label><input type="text" name="nama_perpustakaan" value="<?php echo e(old('nama_perpustakaan', $pengaturan->nama_perpustakaan)); ?>" class="input" required></div>
        <div><label class="label">Alamat</label><textarea name="alamat" rows="2" class="input"><?php echo e(old('alamat', $pengaturan->alamat)); ?></textarea></div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="label">Email</label><input type="email" name="email" value="<?php echo e(old('email', $pengaturan->email)); ?>" class="input"></div>
            <div><label class="label">Telepon</label><input type="text" name="telepon" value="<?php echo e(old('telepon', $pengaturan->telepon)); ?>" class="input"></div>
        </div>

        <div><label class="label">Jam Pelayanan</label><input type="text" name="jam_pelayanan" value="<?php echo e(old('jam_pelayanan', $pengaturan->jam_pelayanan)); ?>" class="input"></div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="label">Tarif Denda per Hari (Rp)</label>
                <input type="number" name="tarif_denda_per_hari" value="<?php echo e(old('tarif_denda_per_hari', $pengaturan->tarif_denda_per_hari)); ?>" class="input" required min="0">
            </div>
            <div>
                <label class="label">Lama Peminjaman (hari)</label>
                <input type="number" name="lama_peminjaman_hari" value="<?php echo e(old('lama_peminjaman_hari', $pengaturan->lama_peminjaman_hari)); ?>" class="input" required min="1">
            </div>
        </div>

        <button type="submit" class="btn-primary">Simpan Pengaturan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/admin/pengaturan.blade.php ENDPATH**/ ?>