<?php $__env->startSection('content'); ?>
<div class="rowfix row temoignages-list">
  <div class="col-xs">
    <?php foreach($temoignages as $temoignage): ?>
      <div class="row">
        <div class="col-xs">
          <div class="row">
            <span><?php echo e($temoignage->title); ?></span>
          </div>
          <div class="row">
            <span><?php echo e($temoignage->content); ?></span>
          </div>
          <div class="row">
            <span><?php echo e($temoignage->person_identity); ?></span>
          </div>
          <div class="row">
            <span><?php echo e($temoignage->person_job); ?></span>
          </div>
          <form class="row" action="/admin/temoignage/delete/<?php echo e($temoignage->id); ?>" method="post">
            <?php echo e(method_field('DELETE')); ?>

            <?php echo e(csrf_field()); ?>

            <button type="submit" name="button">Delete</button>
          </form>
          <a href="/admin/temoignage/edit/<?php echo e($temoignage->id); ?>"><span>Edit</span></a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>