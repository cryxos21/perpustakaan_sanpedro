<?php ($pengaturan = \App\Models\Pengaturan::current()); ?>
<footer class="mt-16 border-t border-gray-200 bg-sanpedro-900 text-sanpedro-100">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-4">
            <div>
                <div class="mb-3 flex items-center gap-3">
                    <img src="<?php echo e(asset('images/logo-universitas.png')); ?>" alt="Logo" class="h-10 w-10 rounded-full object-cover" onerror="this.src='<?php echo e(asset('images/logo-placeholder.png')); ?>'">
                    <div>
                        <p class="font-bold text-white">Universitas San Pedro</p>
                        <p class="text-xs text-sanpedro-200">Cerdas, Beriman, dan Mandiri</p>
                    </div>
                </div>
                <p class="text-sm text-sanpedro-200"><?php echo e($pengaturan->alamat); ?></p>
            </div>

            <div>
                <p class="mb-3 font-semibold text-white">Tautan</p>
                <ul class="space-y-2 text-sm text-sanpedro-200">
                    <li><a href="<?php echo e(route('katalog.index')); ?>" class="hover:text-white">Katalog Buku</a></li>
                    <li><a href="<?php echo e(route('layanan')); ?>" class="hover:text-white">Layanan</a></li>
                    <li><a href="<?php echo e(route('tata-tertib')); ?>" class="hover:text-white">Tata Tertib</a></li>
                    <li><a href="<?php echo e(route('tentang')); ?>" class="hover:text-white">Tentang Perpustakaan</a></li>
                </ul>
            </div>

            <div>
                <p class="mb-3 font-semibold text-white">Informasi</p>
                <ul class="space-y-2 text-sm text-sanpedro-200">
                    <li><a href="<?php echo e(route('berita.index')); ?>" class="hover:text-white">Berita</a></li>
                    <li><a href="<?php echo e(route('pengumuman.index')); ?>" class="hover:text-white">Pengumuman</a></li>
                    <li><a href="<?php echo e(route('kontak')); ?>" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>

            <div>
                <p class="mb-3 font-semibold text-white">Kontak</p>
                <ul class="space-y-2 text-sm text-sanpedro-200">
                    <li><?php echo e($pengaturan->email); ?></li>
                    <li><?php echo e($pengaturan->telepon); ?></li>
                    <li><?php echo e($pengaturan->jam_pelayanan); ?></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 border-t border-sanpedro-800 pt-6 text-center text-xs text-sanpedro-300">
            &copy; <?php echo e(date('Y')); ?> Perpustakaan Universitas San Pedro. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>
<?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/components/footer.blade.php ENDPATH**/ ?>