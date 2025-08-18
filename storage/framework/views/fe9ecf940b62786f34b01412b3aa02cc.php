<style>
    .width-full {
        width: max-content;
    }
</style>
<nav class="bg-primary-100 text-white text-sm hidden lg:block" role="navigation">
    <ul>
        <?php if(menu_tema()): ?>
            <?php $__currentLoopData = menu_tema(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $has_dropdown = count($menu['childrens'] ?? []) > 0 ?>
                <li class="inline-block relative" <?php if($has_dropdown): ?> x-data="{dropdown: false}" <?php endif; ?>>

                    <?php $menu_link = $has_dropdown ? '#!' : $menu['link_url'] ?>

                    <a href="<?php echo e($menu_link); ?>" class=" p-2 inline-block hover:bg-primary-200" @mouseover="dropdown = true" @mouseleave="dropdown = false" @click="dropdown = !dropdown" <?php if($has_dropdown): ?> aria-expanded="false"
        aria-haspopup="true" <?php endif; ?>>
                        <?php echo e($menu['nama']); ?>


                        <?php if($has_dropdown): ?>
                            <i class="fas fa-chevron-down text-xs ml-1 inline-block transition duration-300" :class="{ 'transform rotate-180': dropdown }"></i>
                        <?php endif; ?>
                    </a>

                    <?php if($has_dropdown): ?>
                        <ul class="absolute top-full width-full bg-white text-gray-700 shadow-lg invisible transform transition duration-200 origin-top" :class="{ 'opacity-0 invisible z-[-10] scale-y-50': !dropdown, 'opacity-100 visible z-[9999] scale-y-100': dropdown }" x-transition
                            @mouseover="dropdown = true" @mouseleave="dropdown = false"
                        >

                            <?php $__currentLoopData = $menu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childrens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($childrens['childrens']): ?>
                                    <li class="inline-block relative"><a href="<?php echo e($childrens['link_url']); ?>" class="block py-3 pl-5 pr-4 hover:bg-primary-200 hover:text-white"><?php echo e($childrens['nama']); ?>

                                            <?php if($has_dropdown): ?>
                                                <i class="fas fa-chevron-left text-xs ml-1 inline-block transition duration-300" :class="{ 'transform rotate-180': dropdown }"></i>
                                            <?php endif; ?>
                                        </a></li>

                                    <?php $__currentLoopData = $childrens['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $bhas_dropdown = count($bmenu['childrens'] ?? []) > 0 ?>
                                        <li class="inline-block relative" <?php if($bhas_dropdown): ?> x-data="{dropdown: false}" <?php endif; ?>>

                                            <?php $bmenu_link = $bhas_dropdown ? '#!' : $bmenu['link_url'] ?>

                                            <a href="<?php echo e($bmenu_link); ?>" class="p-3 inline-block hover:bg-primary-200" @mouseover="dropdown = true" @mouseleave="dropdown = false" @click="dropdown = !dropdown"
                                                <?php if($bhas_dropdown): ?> aria-expanded="false"
            aria-haspopup="true" <?php endif; ?>
                                            >
                                                <?php echo e($bmenu['nama']); ?>


                                                <?php if($bhas_dropdown): ?>
                                                    <i class="fas fa-chevron-down text-xs ml-1 inline-block transition duration-300" :class="{ 'transform rotate-180': dropdown }"></i>
                                                <?php endif; ?>
                                            </a>

                                            <?php if($bhas_dropdown): ?>
                                                <ul class="absolute top-full width-full bg-white text-gray-700 shadow-lg invisible transform transition duration-200 origin-top" :class="{ 'opacity-0 invisible z-[-10] scale-y-50': !dropdown, 'opacity-100 visible z-[9999] scale-y-100': dropdown }"
                                                    x-transition @mouseover="dropdown = true" @mouseleave="dropdown = false"
                                                >

                                                    <?php $__currentLoopData = $bmenu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bchildrens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a href="<?php echo e($bchildrens['link_url']); ?>" class="block py-3 pl-5 pr-4 hover:bg-primary-200 hover:text-white"><?php echo e($bchildrens['nama']); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <li><a href="<?php echo e($childrens['link_url']); ?>" class="block py-3 pl-5 pr-4 hover:bg-primary-200 hover:text-white"><?php echo e($childrens['nama']); ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</nav>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/commons/main_menu.blade.php ENDPATH**/ ?>