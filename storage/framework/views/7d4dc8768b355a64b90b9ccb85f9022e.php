<style type="text/css">
    .progress-bar span {
        position: absolute;
        right: 20px;
        color: #000000;
        font-weight: bold;
    }
</style>
<div class="container" style="width: 100%; background: #fff; color: #222">
    <div class="box box-info">
        <?php $__currentLoopData = $data_widget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subdatas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div align="center">
                    <h4><?php echo e($subdatas['laporan']); ?></h4>
                </div>
                <hr />
                <div align="center">
                    <h5>Realisasi | Anggaran</h5>
                </div>
                <hr />
                <?php if(is_array($subdatas)): ?>
                    <?php $__currentLoopData = $subdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_array($subdata) && isset($subdata['judul'], $subdata['realisasi'], $subdata['anggaran'], $subdata['persen'])): ?>
                            <div class="progress-group">
                                <?php echo e(Illuminate\Support\Str::of($subdata['judul'])->title()->whenContains(
                                        'Desa',
                                        static function (Illuminate\Support\Stringable $string) {
                                            if ($string != 'Dana Desa') {
                                                return $string->replace('Desa', setting('sebutan_desa'));
                                            }
                                        },
                                        static fn(Illuminate\Support\Stringable $string) => $string->append(' ' . setting('sebutan_desa')),
                                    )->title()); ?><br>
                                <b><?php echo e(rupiah24($subdata['realisasi'])); ?> | <?php echo e(rupiah24($subdata['anggaran'] + ($subdata['realisasi_jurnal'] ?? 0))); ?></b>
                                <div class="progress progress-bar-striped" align="right" style="background-color: #FF0000"><small></small>
                                    <div class="progress-bar progress-bar-info" role="progressbar" style="width: <?php echo e($subdata['persen']); ?>%" aria-valuenow="<?php echo e($subdata['persen']); ?>" aria-valuemin="0" aria-valuemax="100"><span><?php echo e($subdata['persen']); ?> %</span></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/keuangan/laporan/grafik_rp_apbd_chart.blade.php ENDPATH**/ ?>