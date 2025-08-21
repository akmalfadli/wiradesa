<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<?php if($jam_kerja): ?>
    <div class="archive_style_1">
        <div class="single_bottom_rightbar">
            <h2 class="box-title">
                <i class="fa fa-clock-o"></i>&ensp;<?php echo e($judul_widget); ?>

            </h2>
            <div class="data-case-container">
                <ul class="ants-right-headline">
                    <li class="info-case">
                        <table style="width: 100%;" cellpadding="0" cellspacing="0">
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
                                            <td><?php echo e($value->jam_masuk); ?></td>
                                            <td><?php echo e($value->jam_keluar); ?></td>
                                        <?php else: ?>
                                            <td colspan="2"><span class="label label-danger"> Libur </span></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/natra/resources/views/widgets/jam_kerja.blade.php ENDPATH**/ ?>