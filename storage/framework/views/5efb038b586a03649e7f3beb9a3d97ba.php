
<div class="mt-16">
    <h2 class="text-xl md:text-2xl font-bold mb-1">Data Statistik</h2>
    <h3 class="text-green-600 text-xl md:text-2xl font-bold mb-6 leading-tight"><?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?>, <?php echo e(ucfirst(setting('sebutan_kecamatan_singkat'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?></h3>
    
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
        
        <a href="<?= site_url(); ?>data-wilayah" class="block">
            <div class="border border-gray-200 rounded-lg p-3 md:p-4 hover:shadow-lg transition-shadow h-full">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full flex-shrink-0">
                        <i data-lucide="users" class="h-5 w-5 md:h-6 md:w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold text-sm md:text-base leading-tight">Data Warga Administratif</h3>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">Info detail jumlah masyarakat sesuai administrasi <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/pendidikan-dalam-kk" class="block">
            <div class="border border-gray-200 rounded-lg p-3 md:p-4 hover:shadow-lg transition-shadow h-full">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full flex-shrink-0">
                        <i data-lucide="graduation-cap" class="h-5 w-5 md:h-6 md:w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold text-sm md:text-base leading-tight">Data Pendidikan</h3>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">Info detail jumlah warga pendidikan dalam <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/pendidikan-sedang-ditempuh" class="block">
            <div class="border border-gray-200 rounded-lg p-3 md:p-4 hover:shadow-lg transition-shadow h-full">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full flex-shrink-0">
                        <i data-lucide="building" class="h-5 w-5 md:h-6 md:w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold text-sm md:text-base leading-tight">Data Pendidikan yang Ditempuh</h3>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">Info detail jumlah warga pendidikan yang Ditempuh Di <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/pekerjaan" class="block">
            <div class="border border-gray-200 rounded-lg p-3 md:p-4 hover:shadow-lg transition-shadow h-full">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full flex-shrink-0">
                        <i data-lucide="home" class="h-5 w-5 md:h-6 md:w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold text-sm md:text-base leading-tight">Data Pekerjaan</h3>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">Info detail jumlah warga pekerjaan di <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/rentang-umur" class="block">
            <div class="border border-gray-200 rounded-lg p-3 md:p-4 hover:shadow-lg transition-shadow h-full">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full flex-shrink-0">
                        <i data-lucide="book" class="h-5 w-5 md:h-6 md:w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold text-sm md:text-base leading-tight">Data Rentang Umur</h3>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">Info detail rentang umur warga di <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></p>
            </div>
        </a>

        <a href="<?= site_url(); ?>data-statistik/pekerjaan" class="block">
            <div class="border border-gray-200 rounded-lg p-3 md:p-4 hover:shadow-lg transition-shadow h-full">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 mb-2">
                    <div class="bg-green-100 p-2 rounded-full flex-shrink-0">
                        <i data-lucide="landmark" class="h-5 w-5 md:h-6 md:w-6 text-green-600"></i>
                    </div>
                    <h3 class="font-semibold text-sm md:text-base leading-tight">Data Pekerjaan Warga</h3>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">Info detail pekerjaan warga di <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></p>
            </div>
        </a>
    </div>
</div><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/partials/statistics.blade.php ENDPATH**/ ?>