<div class="mt-16 mb-16">
    <div class="bg-gray-100 rounded-lg p-6 text-center"> 
        
        <div class="bg-green-600 text-white py-1 px-4 rounded-full inline-block mb-4">
            Aparatur Desa
        </div>
        
        <h2 class="text-2xl font-bold mb-4">Aparatur Desa</h2>
        
        <p class="text-sm text-gray-700 mb-6 max-w-2xl mx-auto">
            Dalam pelaksanaannya, aparatur desa memiliki peran yang sangat penting
            dalam melaksanakan berbagai tugas dan tanggung jawab mereka.
        </p>
        
        <div class="flex flex-wrap justify-center gap-8">
            <?php $__currentLoopData = $aparatur_desa['daftar_perangkat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="<?php echo e($data['foto']); ?>" 
                             alt="<?php echo e($data['nama']); ?>" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold mt-2"><?php echo e($data['nama']); ?></h3>
                    <p class="text-xs text-gray-600 mb-2"><?php echo e($data['jabatan']); ?></p>
                    <?php if($data['kehadiran'] == 1): ?>
                        <?php if($data['status_kehadiran'] == 'hadir'): ?>
                            <span class="btn btn-primary w-auto mx-auto inline-block text-xs">Hadir</span>
                        <?php endif; ?>
                        <?php if($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir'): ?>
                            <span class="btn btn-danger w-auto mx-auto inline-block text-xs"><?php echo e(ucwords($data['status_kehadiran'])); ?></span>
                        <?php endif; ?>
                        <?php if($data['tanggal'] != date('Y-m-d')): ?>
                            <span class="btn btn-danger w-auto mx-auto inline-block text-xs">Belum Rekam Kehadiran</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/widgets/aparatur_desa_home.blade.php ENDPATH**/ ?>