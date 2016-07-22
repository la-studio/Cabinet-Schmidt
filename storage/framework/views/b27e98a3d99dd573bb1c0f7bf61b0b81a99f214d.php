<?php $__env->startSection('content'); ?>
  <div class="row center-xs temoignage">
    <div class="col-xs">
      <div class="row center-xs temoignage__logo">
        <img src="<?php echo e($temoignage->logo); ?>" alt="" />
      </div>
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/temoignage/update/<?php echo e($temoignage->id); ?>">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="col-xs">
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Logo de l'entreprise</span>
              <input class="large-file" type="file" name="photo"/>
            </div>
          </div>
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Nom du témoin</span>
              <input class="large-field" type="text" name="person_identity" value="<?php echo e($temoignage->person_identity); ?>">
            </div>
          </div>
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Métier et entreprise</span>
              <input class="large-field" type="text" name="person_job" value="<?php echo e($temoignage->person_job); ?>">
            </div>
          </div>
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Le témoignage</span>
              <textarea id="cabinet-article" class="large-field text-field" name="content"><?php echo e($temoignage->content); ?></textarea>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span></span>
              <div class="count">255 caratères restants</div>
            </div>
          </div>
          <input type="submit" class="temoignage__save" value="Enregistrer">
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>