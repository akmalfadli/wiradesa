<?php if($widgetAktif): ?>
    <?php $__currentLoopData = $widgetAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $judul_widget = [
                'judul_widget' => str_replace(
                    'Desa',
                    ucwords(setting('sebutan_desa')),
                    strip_tags($widget['judul'])
                ),
            ];
        ?>

        <?php if(strtolower($widget['judul']) == "pengembangan"): ?>
            <div class="w-full md:w-1/2 relative">
                <div class="border-2 border-dashed border-green-600 rounded-lg p-6 relative">
                    <div class="absolute -top-3 left-4 bg-white px-2">
                        <h2 class="text-xl font-bold">Arah Pengembangan Desa</h2>
                    </div>

                    <p class="text-sm text-gray-600 mb-4">
                        <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?> akan membangun desa yang berkelanjutan, maju dan sejahtera
                    </p>

                    <?php
                        $items = explode(",", $widget['isi']);
                    ?>

                    <div class="space-y-2">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 mt-0.5"></i>
                                <p class="text-sm"><?php echo e(trim($item)); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="flex justify-around mt-8">
                        <div class="flex flex-col items-center">
                            <div class="bg-green-600 p-2 rounded-lg">
                                <i data-lucide="tree-pine" class="h-6 w-6 text-white"></i>
                            </div>
                            <p class="text-xs mt-1">Lingkungan</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-green-600 p-2 rounded-lg">
                                <i data-lucide="heart-handshake" class="h-6 w-6 text-white"></i>
                            </div>
                            <p class="text-xs mt-1">Ekonomi</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-green-600 p-2 rounded-lg">
                                <i data-lucide="book-open" class="h-6 w-6 text-white"></i>
                            </div>
                            <p class="text-xs mt-1">Pendidikan</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-green-600 p-2 rounded-lg">
                                <i data-lucide="home" class="h-6 w-6 text-white"></i>
                            </div>
                            <p class="text-xs mt-1">Infrastruktur</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/partials/development.blade.php ENDPATH**/ ?>