<div class="container">
    <?php echo $__env->renderWhen($transparansi, 'theme::partials.apbdesa', $transparansi, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</div>

<?php
    $social_media = [
        'facebook' => [
            'color' => 'bg-blue-600',
            'icon' => 'fa-facebook-f',
        ],
        'twitter' => [
            'color' => 'bg-blue-400',
            'icon' => 'fa-twitter',
        ],
        'instagram' => [
            'color' => 'bg-pink-500',
            'icon' => 'fa-instagram',
        ],
        'telegram' => [
            'color' => 'bg-blue-500',
            'icon' => 'fa-telegram',
        ],
        'whatsapp' => [
            'color' => 'bg-green-500',
            'icon' => 'fa-whatsapp',
        ],
        'youtube' => [
            'color' => 'bg-red-500',
            'icon' => 'fa-youtube',
        ],
    ];
?>

<?php $__currentLoopData = $sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($social['link']): ?>
        <?php
            $social_media[strtolower($social['nama'])]['link'] = $social['link'];
        ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo $__env->make('theme::commons.back_to_top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<footer class="container mx-auto lg:px-5 px-3 pt-5 footer">
    <div class="bg-zinc-700 text-white py-5 px-5 rounded-t-xl text-sm flex flex-col gap-3 lg:flex-row justify-between items-center text-center lg:text-left">
        <span class="space-y-2">
            <p>Hak cipta situs &copy; <?php echo e(date('Y')); ?> - <?php echo e($nama_desa); ?></p>
            <p>
                <a href="https://www.trivusi.web.id" class="underline decoration-pink-500 underline-offset-1 decoration-2" target="_blank" rel="noopener">Perwira <?php echo e($themeVersion); ?></a> -
                <a href="https://opensid.my.id" class="underline decoration-green-500 underline-offset-1 decoration-2" target="_blank" rel="noopener">OpenSID <?php echo e(ambilVersi()); ?></a> -
                <?php if(file_exists('mitra')): ?>
                    Hosting didukung
                    <a href="https://my.idcloudhost.com/aff.php?aff=3172" rel="noopener noreferrer" target="_blank">
                        <img src="<?php echo e(base_url('/assets/images/Logo-IDcloudhost.png')); ?>" class="h-4 inline-block" alt="Logo-IDCloudHost" title="Logo-IDCloudHost">
                    </a>
                <?php endif; ?>
            </p>
        </span>
        <?php if(setting('tte')): ?>
            <div class="space-x-1">
                <img src="<?php echo e(asset('assets/images/bsre.png?v', false)); ?>" alt="Bsre" class="img-responsive" style="width: 185px;" />
            </div>
        <?php endif; ?>

        <ul class="space-x-1">
            <?php $__currentLoopData = $social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($link = $sm['link']): ?>
                    <li class="inline-block">
                        <a href="<?php echo e($link); ?>" class="inline-flex items-center justify-center <?php echo e($sm['color']); ?> h-8 w-8 rounded-full">
                            <i class="fab fa-lg <?php echo e($sm['icon']); ?>"></i>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</footer>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/Perwira/resources/views/commons/footer.blade.php ENDPATH**/ ?>