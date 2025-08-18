<div id="penduduk" class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Grafik Laporan Keuangan</h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?= ($submenu == 'Grafik Keuangan') ? 'active' : ''; ?>"><a href="<?php echo e(ci_route('keuangan.laporan')); ?>?jenis=grafik-RP-APBD-manual&tahun=<?php echo e($tahun); ?>">Grafik Pelaksanaan APBDes</a></li>
        </ul>
    </div>
</div>
<div id="penduduk" class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Tabel Laporan (Belanja Per Bidang)</h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?= ($submenu == 'Laporan Keuangan Akhir Bidang Manual') ? 'active' : ''; ?>"><a href="<?php echo e(ci_route('keuangan.laporan')); ?>?jenis=rincian_realisasi_bidang_manual&tahun=<?php echo e($tahun); ?>">Laporan Pelaksanaan APBDes Manual</a></li>
        </ul>
    </div>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/keuangan/laporan/menu.blade.php ENDPATH**/ ?>