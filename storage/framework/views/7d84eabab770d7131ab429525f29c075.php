<?php if($jam_kerja): ?>
    <div class="box box-primary box-solid items-center">
        <div class="bg-green-600 flex items-center justify-center py-3 px-6 mb-1">
            <h3 class="text-md font-semibold text-white text-center">
                <?php echo e(strtoupper($judul_widget)); ?>

            </h3>
        </div>
        <div class="h-1 bg-green-500 mb-2"></div>

        <div class="box-body">
            <table style="width: 100%;" cellpadding="0" cellspacing="0" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $jam_kerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($value->nama_hari); ?></td>
                            <?php if($value->status): ?>
                                <td class="text-center"><?php echo e($value->jam_masuk); ?></td>
                                <td class="text-center"><?php echo e($value->jam_keluar); ?></td>
                            <?php else: ?>
                                <td colspan="2"><span class="label label-danger text-center"> Libur </span></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/widgets/jam_kerja.blade.php ENDPATH**/ ?>