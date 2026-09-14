<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Perpustakaan Universitas San Pedro</title>
    <link rel="icon" href="<?php echo e(asset('images/logo-universitas.png')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="min-h-screen bg-gray-100 font-sans text-gray-800">
    <div class="flex min-h-screen">
        <?php if (isset($component)) { $__componentOriginalb61c202d8e588e94c762ada9935cb4b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb61c202d8e588e94c762ada9935cb4b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb61c202d8e588e94c762ada9935cb4b4)): ?>
<?php $attributes = $__attributesOriginalb61c202d8e588e94c762ada9935cb4b4; ?>
<?php unset($__attributesOriginalb61c202d8e588e94c762ada9935cb4b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb61c202d8e588e94c762ada9935cb4b4)): ?>
<?php $component = $__componentOriginalb61c202d8e588e94c762ada9935cb4b4; ?>
<?php unset($__componentOriginalb61c202d8e588e94c762ada9935cb4b4); ?>
<?php endif; ?>

        <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden" onclick="toggleSidebar()"></div>

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-20 flex items-center justify-between border-b border-gray-200 bg-white px-4 py-3 shadow-sm lg:px-8">
                <button onclick="toggleSidebar()" class="rounded-md p-2 text-gray-600 hover:bg-gray-100 lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-800"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
                <div class="flex items-center gap-3">
                    <span class="hidden text-sm text-gray-600 sm:inline"><?php echo e(auth()->user()->name); ?></span>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Keluar</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-4 lg:p-8">
                <?php if(session('success')): ?>
                    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <ul class="list-inside list-disc">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\laragon\www\perpustakaan_sanpedro\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>