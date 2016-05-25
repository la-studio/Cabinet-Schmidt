<?php $__env->startSection('content'); ?>
<div class="rowfix row articles-list">
  <?php foreach($articles as $article): ?>
    <a href="/admin/article/<?php echo e($article->id); ?>" class="col-sm-6 article">
      <div class="row center-xs middle-xs rowfix wrapper">
        <div class="col-xs">
          <span><?php echo e($article->title); ?></span>
          <p><?php echo e($article->content); ?></p>
        </div>
      </div>
    </a>
  <?php endforeach; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>