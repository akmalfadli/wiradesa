<?php $abstrak = potong_teks($post['isi'], 550) ?>
<div class="business_category_left wow fadeInDown">
    <ul class="fashion_catgnav">
        <li>
            <div class="catgimg2_container2">
                <h5 class="catg_titile">
                    <a href="<?php echo e($post->url_slug); ?>" title="Baca Selengkapnya"><?php echo e($post['judul']); ?></a>
                </h5>
                <div class="post_commentbox">
                    <span class="meta_date"><?php echo e(tgl_indo($post['tgl_upload'])); ?>&nbsp;
                        <i class="fa fa-user"></i><?php echo e($post['owner']); ?>&nbsp;
                        <i class="fa fa-eye"></i><?php echo e(hit($post['hit'])); ?>&nbsp;
                        <i class="fa fa-comments"></i>
                        <?php echo e($post->jumlah_komentar); ?>

                        &nbsp;
                    </span>
                </div>
                <a href="<?php echo e($post->url_slug); ?>" title="Baca Selengkapnya" style="font-weight:bold">
                    <?php if(is_file(LOKASI_FOTO_ARTIKEL . 'kecil_' . $post['gambar'])): ?>
                        <img data-src="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" src="<?php echo e(asset('images/img-loader.gif')); ?>" width="300" class="yall_lazy img-fluid img-thumbnail hidden-sm hidden-xs" style="float:left; margin:0 8px 4px 0;" alt="<?php echo e($post['judul']); ?>" />
                        <img data-src="<?php echo e(AmbilFotoArtikel($post['gambar'], 'sedang')); ?>" src="<?php echo e(asset('images/img-loader.gif')); ?>" width="100%" class="yall_lazy img-fluid img-thumbnail hidden-lg hidden-md" style="float:left; margin:0 8px 4px 0;" alt="<?php echo e($post['judul']); ?>" />
                    <?php else: ?>
                        <img src="<?php echo e(theme_asset('images/noimage.png')); ?>" width="300px" class="img-fluid img-thumbnail hidden-sm hidden-xs" style="float:left; margin:0 8px 4px 0;" alt="<?php echo e($post['judul']); ?>" />
                        <img src="<?php echo e(theme_asset('images/noimage.png')); ?>" width="100%" class="img-fluid img-thumbnail hidden-lg hidden-md" style="float:left; margin:0 8px 4px 0;" alt="<?php echo e($post['judul']); ?>" />
                    <?php endif; ?>
                </a>
                <div style="text-align: justify;" class="hidden-sm hidden-xs">
                    <?php echo $abstrak; ?> ...
                </div>
            </div>
        </li>
    </ul>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/natra/resources/views/partials/artikel/list.blade.php ENDPATH**/ ?>