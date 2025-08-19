<?php $__env->startSection('content'); ?>

    <div class="row vertical-align" style="background-color: #ffffff">
        <div class="col-sm-8 hidden-xs" style="padding: 0px;">
            <?php echo $__env->make('kehadiran::frontend.left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-sm-4 col-xm-4">
            <div class="row">
                <div class="col-xm-12 text-center" style="padding-top:100px; padding-left: 25px; padding-right: 25px;">
                    <img class="user-image" src="<?php echo e(AmbilFoto($masuk['foto'], '', $masuk['sex'])); ?>" alt="Foto Penduduk" height="120px">
                    <?php if($success != 0): ?>
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <strong><?php echo e('Rekam Kehadiran ' . ($kehadiran ? 'Masuk' : 'Keluar') . ' Berhasil'); ?></strong>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            Halaman akan keluar otomatis dalam 5 detik
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-xm-12 text-center">
                    <h2><?php echo e($masuk['pamong_nama']); ?></h2>
                    <h4><?php echo e($masuk['jabatan']); ?></h4>
                </div>
                <div class="col-xm-12 text-center">
                    <?php echo form_open_multipart(ci_route('kehadiran.check-in-out'), 'name="check" id="validasi"'); ?>

                    <div class="checkbox">
                        <?php if(!$kehadiran && !$success): ?>
                            <input type="hidden" name="status_kehadiran" value="hadir">
                            <button id="hadir" class="btn btn-success btn-small">Rekam Masuk</button>
                        <?php endif; ?>

                        <?php if($kehadiran && !$success): ?>
                            <div class="form-group">
                                <select name="status_kehadiran">
                                    <option value="tidak berada di kantor">Absen Keluar</option>
                                    <?php $__currentLoopData = $alasan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(strtolower($item->alasan)); ?>"><?php echo e(ucwords(strtolower($item->alasan))); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <button id="keluar" class="btn btn-danger btn-small">Keluar</button>
                        <?php endif; ?>
                    </div>
                    </form>
                </div>
                <div class="col-xm-12 text-center">
                    <a class="btn bg-olive margin" href="<?php echo e(ci_route('kehadiran.logout')); ?>">Selesai</a>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            var success = "<?php echo e($success); ?>";
            var url = "<?php echo e(ci_route('kehadiran.logout')); ?>";

            if (success) {
                setTimeout(function() {
                    location.href = url;
                }, 5000);
            }

            var waktu = "<?php echo e($kehadiran->jam_masuk); ?>";
            var sekarang = "<?php echo e(date('H:i')); ?>";

            if (waktu < sekarang) {
                $('#hadir').click(function() {
                    $('form[name="check"]').submit();
                })
            } else {
                $('#keluar').click(function() {
                    var box = confirm("Anda masuk kurang dari 1 menit, apakah anda yakin ingin keluar?");
                    if (box == true)
                        $('form[name="check"]').submit();
                    else
                        return false;
                })
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('kehadiran::frontend.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/Modules/Kehadiran/Views/frontend/index.blade.php ENDPATH**/ ?>