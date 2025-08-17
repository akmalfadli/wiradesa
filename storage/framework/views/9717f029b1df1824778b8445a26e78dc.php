
<header class="bg-green-700 text-white py-3 px-4 md:px-6 lg:px-8">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-15 h-8 flex items-center justify-center">
                <figure>
                    <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Logo <?php echo e(ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa'])); ?>" class="h-12 mx-auto pb-2">
                </figure>
            </div>
            <div class="mb-2">
                <p class="text-sm font-semibold"><?php echo e(ucfirst(setting('sebutan_desa'))); ?></p>
                <p class="text-sm font-semibold -mt-1"><?php echo e(ucwords($desa['nama_desa'])); ?></p>
            </div>
        </div>
        <?php echo $__env->make('theme::commons.main_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('theme::commons.mobile_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="md:hidden">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </div>
    </div>
</header><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//desa/themes/perwira/resources/views/partials/header.blade.php ENDPATH**/ ?>