<style>
    table.blueTable {
        border: 1px solid #1C6EA4;
        background-color: #EEEEEE;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }

    table.blueTable td,
    table.blueTable th {
        border: 1px solid #AAAAAA;
        max-width: 230px;
        word-wrap: break-word;
        padding: 3px 2px;
    }

    table.blueTable tbody td {
        font-size: 13px;
    }

    table.blueTable tr:nth-child(even) {
        background: #D0E4F5;
    }

    table.blueTable thead {
        background: #1C6EA4;
        background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 2px solid #444444;
    }

    table.blueTable thead th {
        font-size: 15px;
        font-weight: bold;
        color: #FFFFFF;
        text-align: center;
        border-left: 2px solid #D0E4F5;
    }

    table.blueTable thead th:first-child {
        border-left: none;
    }

    .bold {
        font-weight: bold;
    }

    .highlighted {
        background-color: #FFFF00 !important;
    }
</style>
<div class="table-responsive">
    <table class="table blueTable" width='100%'>
        <thead>
            <tr>
                <th colspan='4'>Uraian</th>
                <th>Anggaran (Rp)</th>
                <th>Realisasi (Rp)</th>
                <th>Lebih/(Kurang)(Rp)</th>
                <th>Persentase (%)</th>
            </tr>
        </thead>

        <tbody>

            <?php $__currentLoopData = $pendapatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class='bold'>
                    <td colspan='4'><?php echo e($l['Akun'] . ' ' . $l['Nama_Akun']); ?></td>
                    <td align='right'></td>
                    <td align='right'></td>
                    <td align='right'></td>
                    <td align='right'></td>
                </tr>
                <?php $__currentLoopData = $l['sub_pendapatan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($s['anggaran'][0]['pagu']) || !empty($s['realisasi'][0]['realisasi'] + $s['realisasi_bunga'][0]['realisasi'] + $s['realisasi_jurnal'][0]['realisasi'])): ?>
                        <tr class='bold'>
                            <td><?php echo e($s['Kelompok']); ?></td>
                            <td colspan='3'>
                                <?php echo e(Illuminate\Support\Str::of($s['Nama_Kelompok'])->title()->whenContains(
                                        'Desa',
                                        static function (Illuminate\Support\Stringable $string) {
                                            if ($string != 'Dana Desa') {
                                                return $string->replace('Desa', setting('sebutan_desa'));
                                            }
                                        },
                                        static fn(Illuminate\Support\Stringable $string) => $string->append(' ' . setting('sebutan_desa')),
                                    )->title()); ?>

                            </td>
                            <td align='right'><?php echo e(rp($s['anggaran'][0]['pagu'])); ?></td>
                            <td align='right'><?php echo e(rp($s['realisasi'][0]['realisasi'] + $s['realisasi_bunga'][0]['realisasi'] + $s['realisasi_jurnal'][0]['realisasi'])); ?></td>
                            <td align='right'><?php echo e(rp($s['anggaran'][0]['pagu'] - ($s['realisasi'][0]['realisasi'] + $s['realisasi_bunga'][0]['realisasi'] + $s['realisasi_jurnal'][0]['realisasi']))); ?></td>
                            <td align='right'><?php echo e($s['anggaran'][0]['pagu'] != 0 ? rp((($s['realisasi'][0]['realisasi'] + $s['realisasi_bunga'][0]['realisasi'] + $s['realisasi_jurnal'][0]['realisasi']) / $s['anggaran'][0]['pagu']) * 100) : 0); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $s['sub_pendapatan2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($q['anggaran'][0]['pagu']) || !empty($q['realisasi'][0]['realisasi'] + $q['realisasi_bunga'][0]['realisasi'] + $q['realisasi_jurnal'][0]['realisasi'])): ?>
                            <tr>
                                <td></td>
                                <td colspan='2'><?php echo e($q['Jenis']); ?></td>
                                <td>
                                    <?php echo e(Illuminate\Support\Str::of($q['Nama_Jenis'])->title()->whenContains(
                                            'Desa',
                                            static function (Illuminate\Support\Stringable $string) {
                                                if ($string != 'Dana Desa') {
                                                    return $string->replace('Desa', setting('sebutan_desa'));
                                                }
                                            },
                                            static function (Illuminate\Support\Stringable $string) {
                                                if (
                                                    !in_array($string, [
                                                        'Swadaya, Partisipasi dan Gotong Royong',
                                                        'Bagi Hasil Pajak Dan Retribusi',
                                                        'Bantuan Keuangan Provinsi',
                                                        'Bantuan Keuangan Kabupaten/Kota',
                                                        'Penerimaan Dari Hasil Kerjasama Dengan Pihak Ketiga',
                                                        'Koreksi Kesalahan Belanja Tahun-Tahun Sebelumnya',
                                                        'Bunga Bank',
                                                        'Hibah dan Sumbangan dari Pihak Ketiga',
                                                        'Lain-Lain Pendapatan Desa Yang Sah',
                                                        'Lain - Lain Pendapatan Asli Desa Yang Sah',
                                                    ])
                                                ) {
                                                    return $string->append(' ' . setting('sebutan_desa'));
                                                }
                                            },
                                        )->title()); ?>

                                </td>
                                <td align='right'><?php echo e(rp($q['anggaran'][0]['pagu'])); ?></td>
                                <td align='right'><?php echo e(rp($q['realisasi'][0]['realisasi'] + $q['realisasi_bunga'][0]['realisasi'] + $q['realisasi_jurnal'][0]['realisasi'])); ?></td>
                                <td align='right'><?php echo e(rp($q['anggaran'][0]['pagu'] - ($q['realisasi'][0]['realisasi'] + $q['realisasi_bunga'][0]['realisasi'] + $q['realisasi_jurnal'][0]['realisasi']))); ?></td>
                                <td align='right'><?php echo e($q['anggaran'][0]['pagu'] != 0 ? rp((($q['realisasi'][0]['realisasi'] + $q['realisasi_bunga'][0]['realisasi'] + $q['realisasi_jurnal'][0]['realisasi']) / $q['anggaran'][0]['pagu']) * 100) : 0); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class='bold highlighted'>
                    <td colspan='4' align='center'>JUMLAH PENDAPATAN</td>
                    <td align='right'><?php echo e(rp($l['anggaran'][0]['pagu'])); ?></td>
                    <?php $jumlah_real = ($l['realisasi'][0]['realisasi'] + $l['realisasi_bunga'][0]['realisasi'] + $l['realisasi_jurnal'][0]['realisasi']) ?>
                    <td align='right'><?php echo e(rp($jumlah_real)); ?></td>
                    <td align='right'><?php echo e(rp($l['anggaran'][0]['pagu'] - $jumlah_real)); ?></td>
                    <td align='right'><?php echo e(rp($jumlah_real == 0 ? 0 : ($jumlah_real / $l['anggaran'][0]['pagu']) * 100)); ?> </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $belanja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class='bold'>
                    <td colspan='4'><?php echo e($b['Akun'] . ' ' . $b['Nama_Akun']); ?></td>
                    <td align='right'></td>
                    <td align='right'></td>
                    <td align='right'></td>
                    <td align='right'></td>
                </tr>

                <?php $__currentLoopData = $b['sub_belanja']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($b1['anggaran'][0]['pagu']) || !empty($b1['realisasi'][0]['realisasi'] + $b1['realisasi_spj'][0]['realisasi'] + $b1['realisasi_bunga'][0]['realisasi'] + $b1['realisasi_jurnal'][0]['realisasi'])): ?>
                        <tr class='bold'>
                            <td><?php echo e($b1['Kelompok']); ?></td>
                            <td colspan='3'><?php echo e($b1['Nama_Kelompok']); ?></td>
                            <td align='right'><?php echo e(rp($b1['anggaran'][0]['pagu'])); ?></td>
                            <td align='right'><?php echo e(rp($b1['realisasi'][0]['realisasi'] - $b1['realisasi_um'][0]['realisasi'] + $b1['realisasi_spj'][0]['realisasi'] + $b1['realisasi_bunga'][0]['realisasi'] + $b1['realisasi_jurnal'][0]['realisasi'])); ?></td>
                            <td align='right'><?php echo e(rp($b1['anggaran'][0]['pagu'] - ($b1['realisasi'][0]['realisasi'] - $b1['realisasi_um'][0]['realisasi'] + $b1['realisasi_spj'][0]['realisasi'] + $b1['realisasi_bunga'][0]['realisasi'] + $b1['realisasi_jurnal'][0]['realisasi']))); ?></td>
                            <td align='right'>
                                <?php echo e($b1['anggaran'][0]['pagu'] != 0 ? rp((($b1['realisasi'][0]['realisasi'] - $b1['realisasi_um'][0]['realisasi'] + $b1['realisasi_spj'][0]['realisasi'] + $b1['realisasi_bunga'][0]['realisasi'] + $b1['realisasi_jurnal'][0]['realisasi']) / $b1['anggaran'][0]['pagu']) * 100) : 0); ?>

                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $b1['sub_belanja2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($b2['anggaran'][0]['pagu']) || !empty($b2['realisasi'][0]['realisasi'] + $b2['realisasi_spj'][0]['realisasi'] + $b2['realisasi_bunga'][0]['realisasi'] + $b2['realisasi_jurnal'][0]['realisasi'])): ?>
                            <tr>
                                <td></td>
                                <td colspan='2'><?php echo e($b2['Jenis']); ?></td>
                                <td><?php echo e($b2['Nama_Jenis']); ?></td>
                                <td align='right'><?php echo e(rp($b2['anggaran'][0]['pagu'])); ?></td>
                                <td align='right'><?php echo e(rp($b2['realisasi'][0]['realisasi'] - $b2['realisasi_um'][0]['realisasi'] + $b2['realisasi_spj'][0]['realisasi'] + $b2['realisasi_bunga'][0]['realisasi'] + $b2['realisasi_jurnal'][0]['realisasi'])); ?></td>
                                <td align='right'><?php echo e(rp($b2['anggaran'][0]['pagu'] - ($b2['realisasi'][0]['realisasi'] - $b2['realisasi_um'][0]['realisasi'] + $b2['realisasi_spj'][0]['realisasi'] + $b2['realisasi_bunga'][0]['realisasi'] + $b2['realisasi_jurnal'][0]['realisasi']))); ?></td>
                                <td align='right'>
                                    <?php echo e($b2['anggaran'][0]['pagu'] != 0 ? rp((($b2['realisasi'][0]['realisasi'] - $b2['realisasi_um'][0]['realisasi'] + $b2['realisasi_spj'][0]['realisasi'] + $b2['realisasi_bunga'][0]['realisasi'] + $b2['realisasi_jurnal'][0]['realisasi']) / $b2['anggaran'][0]['pagu']) * 100) : 0); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr class='bold highlighted'>
                    <td colspan='4' align='center'>JUMLAH BELANJA</td>
                    <td align='right'><?php echo e(rp($b['anggaran'][0]['pagu'])); ?></td>
                    <?php $jumlah_belanja = (($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi']) + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi']) ?>
                    <td align='right'><?php echo e(rp($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi'] + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi'])); ?></td>
                    <td align='right'><?php echo e(rp($b['anggaran'][0]['pagu'] - ($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi'] + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi']))); ?></td>
                    <td align='right'><?php echo e(rp($jumlah_belanja == 0 ? 0 : ($jumlah_belanja / $b['anggaran'][0]['pagu']) * 100)); ?> </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr class='bold highlighted'>
                <td colspan='4' align='center'>SURPLUS / (DEFISIT)</td>
                <td align='right'><?php echo e(rp($l['anggaran'][0]['pagu'] - $b['anggaran'][0]['pagu'])); ?></td>
                <td align='right'><?php echo e(rp($jumlah_real - ($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi'] + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi']))); ?></td>
                <td align='right'>
                    <?php echo e(rp($l['anggaran'][0]['pagu'] - $b['anggaran'][0]['pagu'] - ($jumlah_real - ($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi'] + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi'])))); ?>

                </td>
                <td align='right'>
                    <?php
                        $pembagi = $jumlah_real - ($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi']) + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi'];
                    ?>
                    <?php echo e($pembagi > 0 ? rp((($l['anggaran'][0]['pagu'] - $b['anggaran'][0]['pagu']) / $pembagi) * 100) : '-'); ?>

                </td>
            </tr>
            <?php $__currentLoopData = $pembiayaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class='bold'>
                    <td colspan='4'><?php echo e($p['Akun'] . ' ' . $p['Nama_Akun']); ?></td>
                    <td align='right'></td>
                    <td align='right'></td>
                    <td align='right'></td>
                    <td align='right'></td>
                </tr>

                <?php $__currentLoopData = $p['sub_pembiayaan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($p1['anggaran'][0]['pagu']) || !empty($p1['realisasi'][0]['realisasi'])): ?>
                        <tr class='bold'>
                            <td><?php echo e($p1['Kelompok']); ?></td>
                            <td colspan='3'><?php echo e($p1['Nama_Kelompok']); ?></td>
                            <td align='right'><?php echo e(rp($p1['anggaran'][0]['pagu'])); ?></td>
                            <td align='right'><?php echo e(rp($p1['realisasi'][0]['realisasi'])); ?></td>
                            <td align='right'><?php echo e(rp($p1['anggaran'][0]['pagu'] - $p1['realisasi'][0]['realisasi'])); ?></td>
                            <td align='right'></td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $p1['sub_pembiayaan2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($p2['anggaran'][0]['pagu']) || !empty($p2['realisasi'][0]['realisasi'])): ?>
                            <tr>
                                <td></td>
                                <td colspan='2'><?php echo e($p2['Jenis']); ?></td>
                                <td><?php echo e($p2['Nama_Jenis']); ?></td>
                                <td align='right'><?php echo e(rp($p2['anggaran'][0]['pagu'])); ?></td>
                                <td align='right'><?php echo e(rp($p2['realisasi'][0]['realisasi'])); ?></td>
                                <td align='right'><?php echo e(rp($p2['anggaran'][0]['pagu'] - $p2['realisasi'][0]['realisasi'])); ?></td>
                                <td align='right'></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $pembiayaan_keluar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $pk['sub_pembiayaan_keluar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($pk1['anggaran'][0]['pagu']) || !empty($pk1['realisasi'][0]['realisasi'])): ?>
                        <tr class='bold'>
                            <td><?php echo e($pk1['Kelompok']); ?></td>
                            <td colspan='3'><?php echo e($pk1['Nama_Kelompok']); ?></td>
                            <td align='right'><?php echo e(rp($pk1['anggaran'][0]['pagu'])); ?></td>
                            <td align='right'><?php echo e(rp($pk1['realisasi'][0]['realisasi'])); ?></td>
                            <td align='right'><?php echo e(rp($pk1['anggaran'][0]['pagu'] - $pk1['realisasi'][0]['realisasi'])); ?></td>
                            <td align='right'></td>
                        </tr>
                    <?php endif; ?>

                    <?php $__currentLoopData = $pk1['sub_pembiayaan_keluar2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($pk2['anggaran'][0]['pagu']) || !empty($pk2['realisasi'][0]['realisasi'])): ?>
                            <tr>
                                <td></td>
                                <td colspan='2'><?php echo e($pk2['Jenis']); ?></td>
                                <td><?php echo e($pk2['Nama_Jenis']); ?></td>
                                <td align='right'><?php echo e(rp($pk2['anggaran'][0]['pagu'])); ?></td>
                                <td align='right'><?php echo e(rp($pk2['realisasi'][0]['realisasi'])); ?></td>
                                <td align='right'><?php echo e(rp($pk2['anggaran'][0]['pagu'] - $pk2['realisasi'][0]['realisasi'])); ?></td>
                                <td align='right'></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr class='bold highlighted'>
                <td colspan='4' align='center'>PEMBIAYAAN NETTO</td>
                <td align='right'><?php echo e(rp($p1['anggaran'][0]['pagu'] - $pk1['anggaran'][0]['pagu'])); ?></td>
                <td align='right'><?php echo e(rp($p1['realisasi'][0]['realisasi'] - $pk1['realisasi'][0]['realisasi'])); ?></td>
                <td align='right'><?php echo e(rp($p1['anggaran'][0]['pagu'] - $pk1['anggaran'][0]['pagu'] - ($p1['realisasi'][0]['realisasi'] - $pk1['realisasi'][0]['realisasi']))); ?></td>
                <td align='right'></td>
            </tr>

            <tr class='bold highlighted'>
                <td colspan='4' align='center'>SILPA/SiLPA TAHUN BERJALAN</td>
                <td align='right'><?php echo e(rp($l['anggaran'][0]['pagu'] - $b['anggaran'][0]['pagu'] + ($p1['anggaran'][0]['pagu'] - $pk1['anggaran'][0]['pagu']))); ?></td>
                <td align='right'>
                    <?php echo e(rp($jumlah_real - ($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi'] + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi']) + ($p1['realisasi'][0]['realisasi'] - $pk1['realisasi'][0]['realisasi']))); ?>

                </td>
                <td align='right'>
                    <?php echo e(rp($l['anggaran'][0]['pagu'] - $b['anggaran'][0]['pagu'] - ($jumlah_real - ($b['realisasi'][0]['realisasi'] - $b['realisasi_um'][0]['realisasi'] + $b['realisasi_spj'][0]['realisasi'] + $b['realisasi_bunga'][0]['realisasi'] + $b['realisasi_jurnal'][0]['realisasi'])) + ($p1['anggaran'][0]['pagu'] - $pk1['anggaran'][0]['pagu'] - ($p1['realisasi'][0]['realisasi'] - $pk1['realisasi'][0]['realisasi'])))); ?>

                </td>
                <td align='right'></td>
            </tr>

        </tbody>
    </table>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/keuangan/laporan/apbd_isi.blade.php ENDPATH**/ ?>