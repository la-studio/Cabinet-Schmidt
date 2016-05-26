<?php $__env->startSection('content'); ?>
  <div class="row center-xs competence">
    <div class="col-xs">
      <form class="row center-xs" method="post" action="/admin/competence/update/<?php echo e($competence->id); ?>">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="col-xs">
          <div class="row middle-xs center-xs">
            <span>Titre</span>
            <input type="text" name="title" value="<?php echo e($competence->title); ?>">
          </div>
          <div class="row middle-xs center-xs">
            <span>Slogan</span>
            <textarea name="label"><?php echo e($competence->label); ?></textarea>
          </div>
          <div class="row middle-xs center-xs">
            <span>Description</span>
            <textarea name="description"><?php echo e($competence->description); ?></textarea>
          </div>
          <button type="submit" name="button">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>