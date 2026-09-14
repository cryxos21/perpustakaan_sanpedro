<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status']));

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

foreach (array_filter((['status']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $map = [
        'menunggu' => 'bg-yellow-50 text-yellow-700',
        'dipinjam' => 'bg-blue-50 text-blue-700',
        'ditolak' => 'bg-red-50 text-red-700',
        'dikembalikan' => 'bg-green-50 text-green-700',
        'terlambat' => 'bg-red-50 text-red-700',
        'tersedia' => 'bg-green-50 text-green-700',
        'selesai' => 'bg-gray-100 text-gray-600',
        'dibatalkan' => 'bg-gray-100 text-gray-500',
        'draft' => 'bg-gray-100 text-gray-600',
        'terbit' => 'bg-green-50 text-green-700',
        'aktif' => 'bg-green-50 text-green-700',
        'nonaktif' => 'bg-gray-100 text-gray-500',
    ];
    $label = [
        'menunggu' => 'Menunggu', 'dipinjam' => 'Dipinjam', 'ditolak' => 'Ditolak',
        'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat', 'tersedia' => 'Tersedia',
        'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan', 'draft' => 'Draft', 'terbit' => 'Terbit',
        'aktif' => 'Aktif', 'nonaktif' => 'Nonaktif',
    ];
?>
<span class="badge <?php echo e($map[$status] ?? 'bg-gray-100 text-gray-600'); ?>"><?php echo e($label[$status] ?? ucfirst($status)); ?></span>
<?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/components/status-badge.blade.php ENDPATH**/ ?>