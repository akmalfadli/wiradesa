<?php
    $themeVersion = 'v2508.0.0';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $__env->yieldContent('title', 'Website Resmi ' . ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa'])); ?>
    </title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <?php echo $__env->make('theme::commons.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('theme::commons.source_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('theme::commons.source_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://cdn.tailwindcss.com"></script>ß
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<?php
    $post = $single_artikel;
?>
<body class="w-full bg-white">
    <div class="max-w-6xl mx-auto mb-2">
        <?php echo $__env->make('theme::partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('theme::partials.hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->yieldContent('layout'); ?>
         <?php if(request()->path() === '/' || request()->path() === ''): ?>
            <div class="px-2 md:px-6 lg:px-2">
                <div class="flex flex-col md:flex-row gap-8 mt-8">
                    <?php echo $__env->make('theme::partials.history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('theme::partials.location', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
                <div class="flex flex-col md:flex-row gap-8 mt-16">
                    <?php echo $__env->make('theme::partials.development', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('theme::partials.vision', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
                <?php echo $__env->make('theme::partials.statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('theme::partials.articles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('theme::partials.officials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>
    </div>
        
    <?php echo $__env->make('theme::partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/template.blade.php ENDPATH**/ ?>