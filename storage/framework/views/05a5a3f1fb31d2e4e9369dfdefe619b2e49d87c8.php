<?php $__env->startSection('content'); ?>
<div class="rowfix row slider-list">
  <div class="col-xs">
  <?php foreach($slider as $slide): ?>
    <div class="row slide">
      <h2 class="col-xs-12">
        Slide <?php echo e($slide->index); ?>

      </h2>
      <div class="col-md-6 col-xs-12 slide__bg" style="background-image:url('<?php echo e($slide->cover); ?>')"></div>
      <div class="col-md-6 col-xs-12">
        <div class="row">
          <span><?php echo e($slide->title); ?></span>
        </div>
        <div class="row">
          <p><?php echo e($slide->description); ?></p>
        </div>
        <div class="row">
          <p><?php echo e($slide->button_link); ?></p>
        </div>
        <div class="row">
          <p><?php echo e($slide->button_name); ?></p>
        </div>
        <div class="row">
          <a href="/admin/slide/edit/<?php echo e($slide->id); ?>"><span class="slide__edit">Éditer ce slide</span></a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>