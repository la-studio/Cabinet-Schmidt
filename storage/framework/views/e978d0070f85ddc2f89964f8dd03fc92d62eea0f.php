<?php $__env->startSection('content'); ?>
  <?php foreach($competences as $competence): ?>
    <div class="col-sm-6 competence-list">
      <div class="row center-xs middle-xs wrapper">
        <div class="col-xs">
          <p><?php echo e($competence->title); ?></p>
          <p><?php echo e($competence->description); ?></p>
          <a href="/admin/competence/edit/<?php echo e($competence->id); ?>"><span>Edit</span></a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>