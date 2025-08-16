<?php
    $alt_slug = PREMIUM ? 'artikel' : 'first';
?>

<section x-data="{ catMenu: false }">
    <button type="button" class="lg:hidden inline-block py-4 px-6 z-10 relative" @click="catMenu = !catMenu">
        <i class="fa fa-list fa-lg"></i>
    </button>

    <div x-show="catMenu" x-on:click="catMenu = false" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-30 backdrop-blur-sm"></div>

    <div class="lg:py-3 px-3 lg:block transform transition-transform duration-300 lg:visible z-40"
        :class="{ 'bg-white text-gray-700 w-3/4 shadow fixed top-0 left-0 h-screen block inset-0 overflow-y-auto opacity-100 visible': catMenu, 'bg-white lg:bg-transparent fixed lg:relative -translate-x-full h-screen lg:h-auto lg:translate-x-0 opacity-0 lg:opacity-100': !catMenu }"
        x-transitionx-on:click.stop x-trap.noscroll.inert="catMenu"
    >

        <h5 class="text-h5 pt-5 pb-3 px-3 lg:hidden">Menu Kategori</h5>
        <div class="flex lg:flex-row flex-col justify-between items-center relative z-10">
            <ul class="w-full text-sm">
                <?php $__currentLoopData = $menu_kiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="lg:inline-block">
                        <a href="<?php echo e(site_url("{$alt_slug}/kategori/{$menu['slug']}")); ?>" class="block lg:inline-block py-2 px-3 hover:text-link">
                            <?php echo e($menu['kategori']); ?>

                        </a>
                    </li>
                    <?php if(count($menu['submenu'] ?? []) > 0): ?>
                        <?php $__currentLoopData = $menu['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="lg:inline-block">
                                <a href="<?php echo e(site_url("{$alt_slug}/kategori/{$submenu['slug']}")); ?>" class="block lg:inline-block py-2 px-3 hover:text-link">
                                    <?php echo e($submenu['kategori']); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="flex flex-col lg:flex-row gap-3 mt-5 lg:mt-0 flex-wrap lg:justify-end w-full px-3">
                <?php if(setting('layanan_mandiri') == 1): ?>
                    <a href="<?php echo e(site_url('layanan-mandiri')); ?>" class="btn btn-primary text-sm w-full lg:w-auto text-center">Layanan
                        Mandiri <i class="fas fa-external-link-alt ml-1"></i></a>
                <?php endif; ?>
                <a href="<?php echo e(site_url('siteman')); ?>" class="btn btn-accent text-sm w-full lg:w-auto text-center">Login Admin <i class="fas fa-external-link-alt ml-1"></i></a>
            </div>
        </div>
    </div>

</section>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/esensia/resources/views/commons/category_menu.blade.php ENDPATH**/ ?>