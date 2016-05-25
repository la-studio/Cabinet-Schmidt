<?php $__env->startSection('content'); ?>
  <div class="row slide">
    <div class="col-xs">
      <div class="row center-xs slide__cover" style="background-image: url('<?php echo e($slide->cover); ?>')"></div>
      <form class="row center-xs slide__form" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/slider/update/<?php echo e($slide->id); ?>">
        <div class="col-xs">
          <?php echo e(method_field('PATCH')); ?>

          <?php echo e(csrf_field()); ?>

          <label class="row center-xs">
          Changer de photo
            <input type="file" name="photo"/>
          </label>
          <label class="row center-xs">
          Changer le titre
            <input type="text" name="title" value="<?php echo e($slide->title); ?>"/>
          </label>
          <label class="row center-xs">
          Changer le nom du bouton
            <input type="text" name="title" value="<?php echo e($slide->button_name); ?>"/>
          </label>
          <label class="row center-xs">
          Changer le lien du bouton (mettre une ancre ou bien l'url suivant le nom de domaine)
            <input type="text" name="title" value="<?php echo e($slide->button_name); ?>"/>
          </label>
          <label class="row center-xs">
          Changer la description
            <textarea type="text" name="description"><?php echo e($slide->description); ?></textarea>
          </label>
          <button type="submit" name="button">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>