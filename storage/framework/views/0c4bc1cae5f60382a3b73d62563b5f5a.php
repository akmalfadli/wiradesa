<aside class="space-y-5 sidebar">
    <form action="<?php echo e(site_url('/')); ?>" role="form" class="relative">
        <i class="fas fa-search absolute top-1/2 left-0 transform -translate-y-1/2 z-10 px-3 text-gray-500"></i>
        <input type="text" name="cari" class="form-input px-10 w-full h-12 bg-white relative inline-block" placeholder="Cari...">
    </form>
    <?php if($widgetAktif): ?>
        <?php $__currentLoopData = $widgetAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $judul_widget = [
                    'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul'])),
                ];
            ?>
            <div class="rounded-lg bg-white overflow-hidden">
                <?php if($widget['jenis_widget'] == 3 && strtolower($widget['judul']) !== 'sejarah' && strtolower($widget['judul']) !== 'pengembangan'  && strtolower($widget['judul']) !== 'visi misi'): ?>
                    <div class="box box-primary box-solid items-center">
                        <div class="bg-green-600 flex items-center justify-center py-3 px-6 mb-1">
                            <h3 class="text-md font-semibold text-white text-center">
                                <?php echo e(strtoupper(strip_tags($widget['judul']))); ?>

                            </h3>
                        </div>
                        <div class="h-1 bg-green-500 mb-2"></div>

                        <div class="widget-content prose prose-sm max-w-none">
                            <?php echo html_entity_decode($widget['isi']); ?>

                        </div>
                    </div>
                <?php else: ?>
                    <?php if ($__env->exists("theme::widgets.{$widget['isi']}", $judul_widget)) echo $__env->make("theme::widgets.{$widget['isi']}", $judul_widget, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</aside><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>