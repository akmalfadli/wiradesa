<?php if($paginator->hasPages()): ?>
    <nav class="pagination_area text-center">
        <div>Halaman <?php echo e($paginator->currentPage()); ?> dari <?php echo e($paginator->lastPage()); ?></div>
        <ul class="pagination">
            
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->url(1)); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>"><i class="fa fa-fast-backward"></i>&nbsp;</a>
            </li>
            <?php if($paginator->onFirstPage()): ?>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>"><i class="fa fa-backward"></i>&nbsp;</a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?php echo e($element); ?></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="page-item active" aria-current="page"><span class="page-link"><?php echo e($page); ?></span></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>"><i class="fa fa-forward"></i>&nbsp;</a>
                </li>
            <?php else: ?>
            <?php endif; ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->url($paginator->lastPage())); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>"><i class="fa fa-fast-forward"></i>&nbsp;</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/natra/resources/views/commons/pagination_default.blade.php ENDPATH**/ ?>