<div class="lg:hidden" x-data="{ menuOpen: false }">
    <!-- Mobile Menu Toggle Button -->
    <button type="button" 
            class="flex items-center space-x-1 text-white hover:text-gray-200 focus:outline-none md:hidden"
            @click="menuOpen = !menuOpen">
        <i class="fas transition-transform duration-300" :class="{ 'fa-bars': !menuOpen, 'fa-times': menuOpen }"></i>
        <span class="text-sm uppercase">Menu</span>
    </button>

    <!-- Mobile Menu Overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-40" 
         x-show="menuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="menuOpen = false">
    </div>

    <!-- Mobile Menu Drawer -->
    <nav class="fixed top-0 right-0 h-full w-80 max-w-sm bg-primary-100 text-white shadow-2xl z-50 overflow-y-auto" 
         x-show="menuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-full"
         role="navigation">
        
        <!-- Drawer Header -->
        <div class="flex items-center justify-between p-4 border-b border-primary-200 bg-primary-200">
            <h3 class="text-lg font-semibold">Menu Navigasi</h3>
            <button @click="menuOpen = false" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Menu Items -->
        <ul class="py-2">
            <?php $menu_atas = menu_tema() ?>
            <?php if($menu_atas): ?>
                <?php $__currentLoopData = $menu_atas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $has_dropdown = count($menu['childrens'] ?? []) > 0 ?>
                    <li class="border-b border-primary-200/30" <?php if($has_dropdown): ?> x-data="{dropdownMain: false}" <?php endif; ?>>

                        <?php $menu_link = $has_dropdown ? '#!' : $menu['link_url'] ?>

                        <a href="<?php echo e($menu_link); ?>" 
                           class="flex items-center justify-between px-4 py-4 hover:bg-primary-200 transition-colors duration-200 text-base" 
                           <?php if($has_dropdown): ?> @click.prevent="dropdownMain = !dropdownMain" <?php else: ?> @click="menuOpen = false" <?php endif; ?>>
                            <span class="font-medium"><?php echo e($menu['nama']); ?></span>

                            <?php if($has_dropdown): ?>
                                <i class="fas fa-chevron-down text-sm transition-transform duration-300" 
                                   :class="{ 'transform rotate-180': dropdownMain }"></i>
                            <?php endif; ?>
                        </a>

                        <?php if($has_dropdown): ?>
                            <ul class="bg-primary-200/50" 
                                x-show="dropdownMain"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-96"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 max-h-96"
                                x-transition:leave-end="opacity-0 max-h-0"
                                style="overflow: hidden;">

                                <?php $__currentLoopData = $menu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childrens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $has_dropdown2 = count($childrens['childrens'] ?? []) > 0 ?>

                                    <li class="border-b border-primary-300/20 last:border-b-0" <?php if($has_dropdown2): ?> x-data="{dropdownSub: false}" <?php endif; ?>>
                                        <?php $menu_link2 = $has_dropdown2 ? '#!' : $childrens['link_url'] ?>
                                        <a href="<?php echo e($menu_link2); ?>" 
                                           class="flex items-center justify-between px-6 py-3 hover:bg-primary-300/50 transition-colors duration-200" 
                                           <?php if($has_dropdown2): ?> @click.prevent="dropdownSub = !dropdownSub" <?php else: ?> @click="menuOpen = false" <?php endif; ?>>
                                            <span><?php echo e($childrens['nama']); ?></span>
                                            <?php if($has_dropdown2): ?>
                                                <i class="fas fa-chevron-down text-xs transition-transform duration-300" 
                                                   :class="{ 'transform rotate-180': dropdownSub }"></i>
                                            <?php endif; ?>
                                        </a>

                                        <?php if($has_dropdown2): ?>
                                            <ul class="bg-primary-300/50" 
                                                x-show="dropdownSub"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 max-h-0"
                                                x-transition:enter-end="opacity-100 max-h-64"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 max-h-64"
                                                x-transition:leave-end="opacity-0 max-h-0"
                                                style="overflow: hidden;">
                                                <?php $__currentLoopData = $childrens['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="border-b border-primary-400/20 last:border-b-0">
                                                        <a href="<?php echo e($children['link_url']); ?>" 
                                                           class="block px-8 py-3 hover:bg-primary-400/50 transition-colors duration-200"
                                                           @click="menuOpen = false">
                                                            <?php echo e($children['nama']); ?>

                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </nav>
</div><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/commons/mobile_menu.blade.php ENDPATH**/ ?>