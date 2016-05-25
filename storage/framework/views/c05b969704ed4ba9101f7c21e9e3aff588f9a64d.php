<?php $__env->startSection('content'); ?>
  <div class="row center-xs temoignage">
    <div class="col-xs">
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/temoignage/update/<?php echo e($temoignage->id); ?>">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="col-xs">
          <div class="row center-xs">
            <img src="<?php echo e($temoignage->logo); ?>" alt="" />
          </div>
          <div class="row center-xs">
            <input type="file" name="photo" value="Changer de photo"/>
          </div>
          <div class="row center-xs">
            <input type="text" name="content" value="<?php echo e($temoignage->content); ?>">
          </div>
          <div class="row center-xs">
            <input type="text" name="person_job" value="<?php echo e($temoignage->person_job); ?>">
          </div>
          <div class="row center-xs">
            <input type="text" name="person_identity" value="<?php echo e($temoignage->person_identity); ?>">
          </div>
          <button type="submit" name="button">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>