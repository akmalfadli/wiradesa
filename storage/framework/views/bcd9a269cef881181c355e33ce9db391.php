<?php
    $title = !empty($judul_kategori) ? $judul_kategori : 'Artikel Terkini';
    $slug = 'terkini';
    if (is_array($title)) {
        $slug = $title['slug'];
        $title = $title['kategori'];
    }
?>
<?php $__env->startSection('content'); ?>
    <!-- Tampilkan slider hanya di halaman awal. Tidak tampil pada daftar artikel di halaman kategori atau halaman selanjutnya serta halaman hasil pencarian -->
    <?php if(empty($cari) && count($slider_gambar ?? []) > 0 && request()->segment(2) != 'kategori' && (request()->segment(2) !== 'index' && request()->segment(1) !== 'index')): ?>
        <?php echo $__env->make('theme::partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!-- Judul Kategori / Artikel Terkini -->
    <div class="flex justify-between items-center w-full">
        <h3 class="text-h4 text-primary-200"><?php echo e($title); ?></h3>
        <a href="<?php echo e(site_url('arsip')); ?>" class="text-sm hover:text-primary-100">Indeks <i class="fas fa-chevron-right ml-1"></i></a>
    </div>

    <?php if(empty($cari) && count($slider_gambar ?? []) > 0 && request()->segment(2) != 'kategori' && (request()->segment(2) !== 'index' && request()->segment(1) !== 'index')): ?>
        <?php echo $__env->make('theme::partials.headline', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if($artikel->count() > 0): ?>
        <?php $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('theme::partials.artikel.list', ['post' => $post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="pagination space-y-1 flex-wrap w-full">
            <?php echo $__env->make('theme::commons.paging', ['paging_page' => $paging_page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php else: ?>
        <?php echo $__env->make('theme::partials.artikel.empty', ['title' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/esensi/resources/views/partials/artikel/index.blade.php ENDPATH**/ ?>