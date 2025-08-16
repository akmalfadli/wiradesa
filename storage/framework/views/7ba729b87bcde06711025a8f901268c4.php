
<?php
    $bg_header = $latar_website;
?>
<div class="relative h-[300px] md:h-[400px] bg-green-700 text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-50" 
         style="background-image: url(<?php echo e($bg_header); ?>);">
    </div>
    
    <div class="relative z-10 h-full flex flex-col justify-center px-4 md:px-6 lg:px-8">
         
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-2">
            Website Resmi
        </h1>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
            <?php echo e(ucfirst(setting('sebutan_desa'))); ?> <?php echo e(ucwords($desa['nama_desa'])); ?>

        </h2>
        <p class="text-sm"><?php echo e(ucfirst(setting('sebutan_kecamatan'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?> 
            <?php echo e(ucfirst(setting('sebutan_kabupaten'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?></p>
        <p class="text-sm">Provinsi <?php echo e(ucwords($desa['nama_propinsi'])); ?></p>
        
    </div>
   
</div><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//desa/themes/perwira/resources/views/partials/hero.blade.php ENDPATH**/ ?>