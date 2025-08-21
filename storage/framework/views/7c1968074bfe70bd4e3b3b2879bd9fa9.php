<?php $__currentLoopData = $teks_berjalan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="teks" style="font-family: Oswald; padding-right: 50px;">
        <?php echo e($teks['teks']); ?>

        <?php if($teks['tautan']): ?>
            <a href="<?php echo e($teks['tautan']); ?>" rel="noopener noreferrer" title="Baca Selengkapnya"><?php echo e($teks['judul_tautan']); ?></a>
        <?php endif; ?>
    </span>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/natra/resources/views/layouts/teks_berjalan.blade.php ENDPATH**/ ?>