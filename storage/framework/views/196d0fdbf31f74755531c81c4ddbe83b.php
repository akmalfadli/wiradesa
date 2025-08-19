<?php if($paginator->hasPages()): ?>
    <nav>
        <ul class="pagination flex gap-2 flex-wrap">
            
            <li class="page-item">
                <a href="<?php echo e($paginator->url(1)); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200 pagination-link">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </li>

            
            <?php if(!$paginator->onFirstPage()): ?>
                <li class="page-item">
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200 pagination-link">
                        <i class="fas fa-chevron-left inline-block"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $start + 4);
                
                // Adjust start if we're near the end
                if ($end - $start < 4) {
                    $start = max(1, $end - 4);
                }
            ?>

            
            <?php if($start > 1): ?>
                <li class="page-item">
                    <a class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200 pagination-link" href="<?php echo e($paginator->url(1)); ?>">1</a>
                </li>
                <?php if($start > 2): ?>
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link py-1 px-3 rounded-lg shadow inline-block border bg-gray-100 text-gray-500">...</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            
            <?php for($page = $start; $page <= $end; $page++): ?>
                <?php if($page == $current): ?>
                    <li class="page-item" aria-current="page">
                        <span class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-primary-100 text-white hover:text-white hover:bg-primary-200"><?php echo e($page); ?></span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200 pagination-link" href="<?php echo e($paginator->url($page)); ?>"><?php echo e($page); ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>

            
            <?php if($end < $last): ?>
                <?php if($end < $last - 1): ?>
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link py-1 px-3 rounded-lg shadow inline-block border bg-gray-100 text-gray-500">...</span>
                    </li>
                <?php endif; ?>
                <li class="page-item">
                    <a class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200 pagination-link" href="<?php echo e($paginator->url($last)); ?>"><?php echo e($last); ?></a>
                </li>
            <?php endif; ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page-item">
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200 pagination-link">
                        <i class="fas fa-chevron-right inline-block"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <li class="page-item">
                <a href="<?php echo e($paginator->url($last)); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200 pagination-link">
                    <i class="fas fa-arrow-right inline-block"></i>
                </a>
            </li>
        </ul>
    </nav>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add click handler to all pagination links
        const paginationLinks = document.querySelectorAll('.pagination-link');
        
        paginationLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Store the scroll target in sessionStorage
                sessionStorage.setItem('scrollToArticles', 'true');
            });
        });
    });
    </script>
<?php endif; ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/commons/pagination-tailwind.blade.php ENDPATH**/ ?>