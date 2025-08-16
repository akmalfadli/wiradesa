<?php if(config_item('csrf_protection')): ?>
    <!-- CSRF Token -->
    <script type="text/javascript">
        var csrfParam = "<?php echo e($token_name); ?>";
        var csrfVal = "<?php echo e($token_value); ?>";

        function getCsrfToken() {
            return csrfVal;
        }
    </script>
    <!-- jQuery Cookie -->
    <script src="<?php echo e(asset('bootstrap/js/jquery.cookie.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/anti-csrf.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/layouts/components/token.blade.php ENDPATH**/ ?>