<?php
    $url = $post->url_slug;
    $abstract = potong_teks(strip_tags($post['isi']), 300);
    $image = $post['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $post['gambar']) 
        ? AmbilFotoArtikel($post['gambar'], 'sedang') 
        : gambar_desa($desa['logo']);
?>

<div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow h-96 flex flex-col">
    <img src="<?php echo e($image); ?>" alt="<?php echo e($post['judul']); ?>" 
         class="w-full h-48 object-cover flex-shrink-0">
    <div class="p-4 flex flex-col flex-grow">
        <a href="<?php echo e($url); ?>" >
            <h3 class="font-bold mb-2 leading-tight">
                <?php echo e(potong_teks($post['judul'], 80)); ?><?php echo e(strlen($post['judul']) > 80 ? '...' : ''); ?>

            </h3>
        </a>
        <p class="text-sm text-gray-600 mb-4 flex-grow">
            <?php echo potong_teks(html_entity_decode($abstract), 100); ?><?php echo e(strlen($abstract) > 100 ? '...' : ''); ?>

        </p>
        <div class="flex justify-between items-center mt-auto">
            <span class="text-xs text-gray-500"><?php echo e(tgl_indo($post['tgl_upload'])); ?></span>
            <a href="<?php echo e($url); ?>" 
                class="inline-block bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition-colors">
                Lihat Detail
            </a>
        </div>
    </div>
</div><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//desa/themes/perwira/resources/views/partials/artikel/list.blade.php ENDPATH**/ ?>