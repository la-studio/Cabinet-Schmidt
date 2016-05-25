<?php $__env->startSection('content'); ?>
  <div class="row center-xs article">
    <div class="col-xs">
      <form class="row center-xs" method="post" action="/admin/article/update/<?php echo e($article->id); ?>">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="row center-xs">
          <input type="text" name="title" value="<?php echo e($article->title); ?>">
        </div>
        <div class="row center-xs">
          <input type="text" name="content" value="<?php echo e($article->content); ?>">
        </div>
        <button type="submit" name="button">Enregistrer</button>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>