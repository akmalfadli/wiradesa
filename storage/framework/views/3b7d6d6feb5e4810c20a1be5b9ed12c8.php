<?php $__env->startSection('title'); ?>
    <h1>
        <h1>Pengaturan Widget <?php echo e($pemerintah); ?></h1>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Pengaturan Widget <?php echo e($pemerintah); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo form_open_multipart($form_action, 'class="form-horizontal" id="validasi"'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <a href="<?php echo e(site_url('web_widget')); ?>" class="btn btn-social  btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali ke Widget">
                        <i class="fa fa-arrow-circle-left "></i>Kembali ke Widget
                    </a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="jumbotron">
                                    <p>Widget <?php echo e($pemerintah); ?> menampilkan foto staf <?php echo e($pemerintah); ?>. Klik tombol berikut
                                        untuk mengubah data dan foto staf <?php echo e($pemerintah); ?></p>
                                    <a class="btn btn-primary btn-large" href="<?php echo e(site_url('pengurus')); ?>"><?php echo e($pemerintah); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="mainform" name="mainform" action="" method="post">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-md-3 col-lg-2" style="margin-left: 19px;">Tampilkan nama/jabatan</label>
                                            <div class="col-xs-12 col-sm-2">
                                                <select class="form-control input-sm" name="setting[overlay]">
                                                    <option value="1" <?= ($settings['overlay'] == '1') ? 'selected' : ''; ?>>Ya</option>
                                                    <option value="0" <?= ($settings['overlay'] == '0') ? 'selected' : ''; ?>>Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-xs-12">
                        <button type="reset" class="btn btn-social  btn-danger btn-sm"><i class="fa fa-times"></i>
                            Batal</button>
                        <?php if(can('u')): ?>
                            <button type="submit" class="btn btn-social  btn-info btn-sm pull-right"><i class="fa fa-check"></i>
                                Simpan</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/web/widget/form_admin/admin_aparatur_desa.blade.php ENDPATH**/ ?>