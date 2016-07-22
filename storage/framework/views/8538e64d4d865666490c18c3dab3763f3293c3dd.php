<?php $__env->startSection('content'); ?>
  <div class="row partenaire">
    <div class="col-xs">
      <div class="row center-xs partenaire__logo">
        <img src="<?php echo e($partenaire->logo); ?>" alt>
      </div>
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/partenaire/update/<?php echo e($partenaire->id); ?>">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="col-xs">
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Logo du partenaire</span>
              <input class="large-file" type="file" name="photo"/>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Nom du partenaire</span>
              <input class="large-field" type="text" name="name" value="<?php echo e($partenaire->name); ?>"/>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Lien du partenaire</span>
              <input class="large-field" type="text" name="link" value="<?php echo e($partenaire->link); ?>"/>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Description du partenaire</span>
              <textarea id="cabinet-article" class="large-field text-field" name="description"><?php echo e($partenaire->description); ?></textarea>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span></span>
              <div class="count">255 caratères restants</div>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Afficher dans les liens utiles</span>
              <input type="checkbox" name="enabled" <?php if($partenaire->enabled==1): ?>checked <?php endif; ?>/>
            </div>
          </div>
          <input type="submit" class="partenaire__save" value="Enregistrer"/>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>