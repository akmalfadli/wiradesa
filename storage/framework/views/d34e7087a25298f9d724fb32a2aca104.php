<?php
    $bg_header = $latar_website;
?>

<div class="container md:px-4 lg:px-5">
    <header style="background-image: url(<?php echo e($bg_header); ?>);" class="bg-center bg-cover bg-no-repeat relative text-white">
        <div class="absolute bg-gray-800 bg-opacity-60 top-0 left-0 right-0 h-full">
        </div>

        <?php echo $__env->make('theme::commons.category_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="relative z-10 text-center space-y-2 mt-3 px-3 lg:px-5">
            <a href="<?php echo e(site_url('/')); ?>">
                <figure>
                    <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Logo <?php echo e(ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa'])); ?>" class="h-16 mx-auto pb-2">
                </figure>
                <span class="text-h2 block"><?php echo e($desa['nama_desa']); ?></span>
                <p><?php echo e(ucfirst(setting('sebutan_kecamatan_singkat'))); ?>

                    <?php echo e(ucwords($desa['nama_kecamatan'])); ?>,
                    <?php echo e(ucfirst(setting('sebutan_kabupaten_singkat'))); ?>

                    <?php echo e(ucwords($desa['nama_kabupaten'])); ?>,
                    Provinsi
                    <?php echo e(ucwords($desa['nama_propinsi'])); ?>

                </p>
            </a>
            <?php if($w_gal): ?>
                <marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="4" class="block w-10/12 lg:w-1/4 mx-auto">
                    <div class="grid grid-flow-col gap-3 shadow-lg pt-2">
                        <?php $__currentLoopData = $w_gal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_file(LOKASI_GALERI . 'kecil_' . $album['gambar'])): ?>
                                <?php $link = site_url('first/sub_gallery/'.$album['id']) ?>
                                <a href="<?php echo e($link); ?>" class="block w-32 h-20" title="<?php echo e($album['nama']); ?>">
                                    <img src="<?php echo e(AmbilGaleri($album['gambar'], 'kecil')); ?>" alt="<?php echo e($album['nama']); ?>" class="w-32 h-20 object-cover">
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </marquee>
            <?php endif; ?>
        </section>
        <?php if($teks_berjalan): ?>
            <div class="block px-3 bg-white text-white bg-opacity-20 py-1.5 text-xs mt-6 mb-0 z-20 relative">
                <marquee onmouseover="this.stop();" onmouseout="this.start();" class="block divide-x-4 relative">
                    <?php $__currentLoopData = $teks_berjalan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marquee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="px-3">
                            <?php echo e($marquee['teks']); ?>

                            <?php if(trim($marquee['tautan']) && $marquee['judul_tautan']): ?>
                                <a href="<?php echo e($marquee['tautan']); ?>" class="hover:text-link"><?php echo e($marquee['judul_tautan']); ?></a>
                            <?php endif; ?>
                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </marquee>
            </div>
        <?php endif; ?>
    </header>
    <?php echo $__env->make('theme::commons.main_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('theme::commons.mobile_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/esensis/resources/views/commons/header.blade.php ENDPATH**/ ?>