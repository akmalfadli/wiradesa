<div class="box-header with-border">
    <a href="<?php echo e(ci_route('surat_master')); ?>" class="btn btn-social btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
        <i class="fa fa-arrow-circle-left"></i>Kembali ke Daftar Surat
    </a>
    <?php if(super_admin() && $ci->uri->segment(2) == 'pengaturan'): ?>
        <button type="button" id="standar" title="Mengembalikan Standar Spesifikasi Surat" class="btn btn-social btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
            <i class="fa fa-refresh"></i>Mengembalikan Standar Spesifikasi
        </button>
    <?php endif; ?>
    <?php if(in_array($suratMaster->jenis, [3, 4])): ?>
        <?php if(setting('tte')): ?>
            <br /><br />
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Info !</h4>
                Jika surat ingin dikirim ke <?php echo e(setting('sebutan_kecamatan')); ?>, letakan kode [qr_camat] pada tempat yang ingin ditempelkan QRCode
                <?php echo e(setting('sebutan_kecamatan')); ?>.
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/pengaturan_surat/kembali.blade.php ENDPATH**/ ?>