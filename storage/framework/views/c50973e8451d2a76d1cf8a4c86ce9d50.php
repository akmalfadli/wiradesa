<?php echo $__env->make('theme::commons.asset_highcharts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('layout'); ?>
    <div class="container mx-auto flex flex-col-reverse lg:flex-row my-5 gap-3 lg:gap-5 justify-between text-gray-600">
        <div class="lg:w-1/3 w-full">
            <?php echo $__env->make('theme::partials.statistik.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <main class="lg:w-3/4 w-full space-y-1 bg-white rounded-xs px-4 py-2 lg:py-4 lg:px-5 shadow">
            <?php echo $__env->make('theme::partials.statistik.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <script>
                // Pass PHP variables to JavaScript
                const enable3d = <?php echo e(setting('statistik_chart_3d') ? 1 : 0); ?>;
                const baseUrl = '<?php echo e(base_url()); ?>';
                const currentYear = '<?php echo e($selected_tahun ?? ''); ?>';
                
                console.log('Statistics Configuration:', {
                    enable3d: enable3d,
                    baseUrl: baseUrl,
                    currentYear: currentYear
                });
            </script>
        </main>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme::template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/partials/statistik/index.blade.php ENDPATH**/ ?>