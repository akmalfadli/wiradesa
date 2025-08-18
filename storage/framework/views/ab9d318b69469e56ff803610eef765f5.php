<?php $__env->startSection('title'); ?>
    <h1>
        Laporan Keuangan
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(ci_route('keuangan_manual')); ?>">Laporan Keuangan</a></li>
    <li class="active">Grafik Pelaksanaan Belanja Desa</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box">
        <div class="box-header with-border">
            <form action="" method="get">
                <div class="row col-md-3">
                    <label class="col-md-4">Tahun Anggaran: </label>
                    <div class="col-md-8">
                        <select class="form-control" name="tahun" required onchange="this.form.submit()">
                            <option value="">Pilih Tahun</option>
                            <?php $__currentLoopData = $tahun_anggaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->tahun); ?>" <?= ($tahun == $item->tahun) ? 'selected' : ''; ?>><?php echo e($item->tahun); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('admin.keuangan.laporan.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-9">
                    <?php echo $__env->make('admin.keuangan.laporan.grafik_rp_apbd_chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/keuangan/laporan/grafik_rp_apbd_manual.blade.php ENDPATH**/ ?>