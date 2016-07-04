<?php if($echosarticles->lastPage() > 1): ?>
    <ul class="pagination">
        <li class="<?php echo e(($echosarticles->currentPage() == 1) ? ' disabled' : ''); ?>">
            <a href="<?php echo e($echosarticles->previousPageUrl()); ?>" rel="prev"></a>
         </li>
        <?php for($i = 1; $i <= $echosarticles->lastPage(); $i++): ?>
            <?php
            $half_total_links = floor(7 / 2);
            $from = $echosarticles->currentPage() - $half_total_links;
            $to = $echosarticles->currentPage() + $half_total_links;
            if ($echosarticles->currentPage() < $half_total_links) {
               $to += $half_total_links - $echosarticles->currentPage();
            }
            if ($echosarticles->lastPage() - $echosarticles->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($echosarticles->lastPage() - $echosarticles->currentPage()) - 1;
            }
            ?>
            <?php if($from < $i && $i < $to): ?>
                <li class="<?php echo e(($echosarticles->currentPage() == $i) ? ' active' : ''); ?>">
                    <a href="<?php echo e($echosarticles->url($i)); ?>"><?php echo e($i); ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>
        <li class="<?php echo e(($echosarticles->currentPage() == $echosarticles->lastPage()) ? ' disabled' : ''); ?>">
            <a href="<?php echo e($echosarticles->nextPageUrl()); ?>" rel="next">Last</a>
        </li>
    </ul>
<?php endif; ?>