<?php $__env->startSection('content'); ?>
  <div class="row slide">
    <div class="col-xs">
      <div class="row center-xs slide__cover" style="background-image: url('<?php echo e($slide->cover); ?>')"></div>
      <form class="row center-xs slide__form" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/slider/update/<?php echo e($slide->id); ?>">
        <div class="col-xs">
          <?php echo e(method_field('PATCH')); ?>

          <?php echo e(csrf_field()); ?>

          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de couverture</span>
              <input type="file" class="file-input" name="photo"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de titre</span>
              <input type="text" name="title" value="<?php echo e($slide->title); ?>"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le nom du bouton</span>
              <input type="text" name="button_name" value="<?php echo e($slide->button_name); ?>"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le lien du bouton</span>
              <input type="text" name="button_link" value="<?php echo e($slide->button_link); ?>"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer la description</span>
              <input type="text" name="description" value="<?php echo e($slide->description); ?>"/>
            </div>
          </div>
          <input type="submit" class="competence__save" value="Enregistrer"/>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>