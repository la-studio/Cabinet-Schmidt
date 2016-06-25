<?php $__env->startSection('content'); ?>

  <div class="row competences-list">
  <?php foreach($competences as $competence): ?>
    <div class="col-sm-6 competences-item">
      <div class="row center-xs middle-xs wrapper">
        <div class="col-xs">
          <p class="title"><?php echo e($competence->title); ?></p>
          <p class="description"><?php echo e($competence->description); ?></p>
          <a href="/admin/competence/edit/<?php echo e($competence->id); ?>">
            <i class="material-icons">create</i>
            <span>Éditer</span>
          </a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>