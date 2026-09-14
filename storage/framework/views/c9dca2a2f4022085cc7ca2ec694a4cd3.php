<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['buku']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['buku']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<a href="<?php echo e(route('buku.show', $buku)); ?>" class="card group flex flex-col overflow-hidden transition hover:shadow-md">
    <div class="aspect-[3/4] w-full overflow-hidden bg-gray-100">
        <img src="<?php echo e($buku->coverUrl()); ?>" alt="Cover <?php echo e($buku->judul); ?>" class="h-full w-full object-cover transition group-hover:scale-105">
    </div>
    <div class="flex flex-1 flex-col gap-1 p-3">
        <span class="badge <?php echo e($buku->isTersedia() ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'); ?> w-fit">
            <?php echo e($buku->isTersedia() ? 'Tersedia' : 'Dipinjam'); ?>

        </span>
        <p class="line-clamp-2 text-sm font-semibold text-gray-800"><?php echo e($buku->judul); ?></p>
        <p class="text-xs text-gray-500"><?php echo e($buku->penulis->nama ?? '-'); ?></p>
        <p class="mt-auto text-xs text-gray-400"><?php echo e($buku->penerbit->nama ?? '-'); ?> &middot; <?php echo e($buku->tahun_terbit); ?></p>
    </div>
</a>
<?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/components/book-card.blade.php ENDPATH**/ ?>