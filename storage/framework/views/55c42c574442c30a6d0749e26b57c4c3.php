<div class="box box-info">
    <div class="box-header with-border">
        <table id="judul-laporan" width="100%" style="border: solid 0px black; text-align: center;">
            <tr>
                <td>
                    <h4>LAPORAN REALISASI PELAKSANAAN</h4>
                    <h4>ANGGARAN PENDAPATAN DAN BELANJA DESA</h4>
                    <h4>PEMERINTAH <?php echo e(strtoupper(ucwords(setting('sebutan_desa')))); ?> <?php echo e(strtoupper($desa['nama_desa'])); ?></h4>
                    <h4>TAHUN ANGGARAN <?php echo e($tahun); ?></h4>
                </td>
            </tr>
        </table>

        <?php echo $__env->make('admin.keuangan.laporan.apbd_isi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/keuangan/laporan/apbd.blade.php ENDPATH**/ ?>