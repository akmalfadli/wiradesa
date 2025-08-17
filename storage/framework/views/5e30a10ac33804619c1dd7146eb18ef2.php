
<footer class="bg-green-700 text-white py-8">
    <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between">
            <div class="mb-6 md:mb-0">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-15 h-8 flex items-center justify-center">
                        <figure>
                            <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Logo <?php echo e(ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa'])); ?>" class="h-10 mx-auto pb-2">
                        </figure>
                    </div>
                    <div class="mb-2">
                        <p class="text-sm font-semibold"><?php echo e(ucfirst(setting('sebutan_desa'))); ?></p>
                        <p class="text-sm font-semibold -mt-1"><?php echo e(ucwords($desa['nama_desa'])); ?></p>
                    </div>
                </div>
                <p class="text-sm mb-1"><?php echo e(ucfirst(setting('sebutan_kecamatan'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?> </p>
                <p class="text-sm mb-1"><?php echo e(ucfirst(setting('sebutan_kabupaten'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?></p>
                <p class="text-sm mb-4">Provinsi <?php echo e(ucwords($desa['nama_propinsi'])); ?></p>
                <p class="text-sm"><?php echo e(ucfirst($data_config['email_desa'])); ?></p>
            </div>
            
            <div class="mb-6 md:mb-0 flex flex-col items-center text-center">
                <h3 class="font-semibold mb-3">Sosial Media</h3>
                <div class="flex gap-3 justify-center">
                    <a href="#" class="bg-green-600 p-2 rounded-md hover:bg-green-500 transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="bg-green-600 p-2 rounded-md hover:bg-green-500 transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="bg-green-600 p-2 rounded-md hover:bg-green-500 transition-colors">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
            
            <div>
                <h3 class="font-semibold mb-3">Konten</h3>
                <ul class="space-y-2 text-sm">
                    <li>&gt; Tentang Desa</li>
                    <li>&gt; Artikel</li>
                    <li>&gt; Data Statistik</li>
                    <li>&gt; Aparatur Desa</li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-green-600 mt-8 pt-4 text-center text-xs">
             <p>Hak cipta situs &copy; <?php echo e(date('Y')); ?> - <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?></p>
                        <p>
                <a href="https://akmalfadli.github.io" class="underline decoration-pink-500 underline-offset-1 decoration-2" target="_blank" rel="noopener">Perwira <?php echo e($themeVersion); ?></a> -
                <a href="https://opensid.my.id" class="underline decoration-green-500 underline-offset-1 decoration-2" target="_blank" rel="noopener">OpenSID <?php echo e(ambilVersi()); ?></a> 
            </p>
        </div>
    </div>
</footer><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//desa/themes/perwira/resources/views/partials/footer.blade.php ENDPATH**/ ?>