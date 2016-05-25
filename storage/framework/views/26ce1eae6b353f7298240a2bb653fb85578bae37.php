<?php $__env->startSection('content'); ?>
  <div class="row article">
    <span><?php echo e($article->title); ?></span>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>