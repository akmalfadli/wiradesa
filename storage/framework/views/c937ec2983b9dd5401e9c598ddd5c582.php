<?php
    $post = $single_artikel;
    $alt_slug = PREMIUM ? 'artikel' : 'first';
?>
<?php echo $__env->make('theme::commons.asset_highcharts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('content'); ?>
    <nav role="navigation" aria-label="navigation" class="breadcrumb">
        <ol>
            <li><a href="<?php echo e(ci_route()); ?>">Beranda</a></li>
            <li>
                <?php if($post['kategori']): ?>
                    <a href="<?php echo e(ci_route("{$alt_slug}.kategori.{$post['kat_slug']}")); ?>">
                        <?php echo e($post['kategori']); ?>

                    </a>
                <?php else: ?>
                    Artikel
                <?php endif; ?>
            </li>
        </ol>
    </nav>

    <article>
        <h1 class="text-h2">
            <?php echo e($post['judul']); ?>

        </h1>

        <span class="inline-flex flex-wrap gap-x-3 gap-y-2 text-xs lg:text-sm py-2 text-accent-200">
            <span><?php echo e($post['owner']); ?> <i class="fas fa-check text-xs bg-green-500 h-4 w-4 inline-flex items-center justify-center rounded-full text-white"></i></span>
            <span class="before:content-['-'] before:pr-3 before:inline-block"><?php echo e($post['tgl_upload_local']); ?></span>
            <span class="before:content-['-'] before:pr-3 before:inline-block">Dibaca <?php echo e(hit($post['hit'])); ?></span>
        </span>
    </article>

    <div class="content space-y-2 py-4 text-justify">
        <?php if($post['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $post['gambar'])): ?>
            <a href="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" class="h-auto block pb-3" data-fancybox="images">
                <figure>
                    <img src="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" alt="<?php echo e($post['judul']); ?>" class="w-full h-auto">
                </figure>
            </a>
        <?php endif; ?>
        <?php echo $post['isi']; ?>

    </div>

    <?php for($i = 1; $i <= 3; $i++): ?>
        <?php if($post['gambar' . $i] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $post['gambar' . $i])): ?>
            <a href="<?php echo e(AmbilFotoArtikel($post['gambar' . $i], 'sedang')); ?>" class="block" data-fancybox="images">
                <figure>
                    <img src="<?php echo e(AmbilFotoArtikel($post['gambar' . $i], 'sedang')); ?>" alt="<?php echo e($post['nama']); ?>" class="w-full">
                </figure>
            </a>
        <?php endif; ?>
    <?php endfor; ?>
    
    <?php if($post['dokumen']): ?>
        <div class="alert alert-info">
            <h4 class="text-h6">Dokumen Lampiran</h4>
            <a href="<?php echo e(ci_route('first.unduh_dokumen_artikel', $post['id'])); ?>" class="text-primary-200 text-sm flex space-x-3 pt-2">
                <span class="fas fa-download text-secondary inline-block"></span>
                <span class="hover:text-link"><?php echo e($post['dokumen']); ?></span>
            </a>
        </div>
    <?php endif; ?>

    <?php echo $__env->make('theme::partials.artikel.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme::layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//desa/themes/perwira/resources/views/partials/artikel/detail.blade.php ENDPATH**/ ?>