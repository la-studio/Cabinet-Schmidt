<?php $__env->startSection('content'); ?>
  <div class="row partenaire">
    <div class="col-xs">
      <div class="row center-xs">
        <img src="<?php echo e($partenaire->logo); ?>" alt>
      </div>
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/partenaire/update/<?php echo e($partenaire->id); ?>">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <label>
        Changer de photo
        <input type="file" name="photo"/>
        </label>
        <button type="submit" name="button">Enregistrer</button>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>