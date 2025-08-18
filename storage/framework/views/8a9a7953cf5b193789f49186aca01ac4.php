<?php if($widgetAktif): ?>
        <?php $__currentLoopData = $widgetAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(strtolower($widget['judul']) == "visi misi"): ?>
                <div class="w-full md:w-1/2">
                    <h2 class="text-2xl font-bold">Visi Misi Desa</h2>
                    <h3 class="text-green-600 font-semibold mb-4">Cita Cita Desa</h3>
                    <?php
                        $visimisi = explode(';', $widget['isi']);
                    ?>

                    <?php $__currentLoopData = $visimisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="text-sm text-justify text-gray-700 mb-2">
                            <?php echo potong_teks(html_entity_decode($isi), 450); ?> 
                            <?php echo e(strlen($isi) > 450 ? '...' : ''); ?>

                        </p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition-colors mt-3">
                        Lihat Selengkapnya
                    </button>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/partials/vision.blade.php ENDPATH**/ ?>