 
<?php $__env->startSection('content'); ?>
  <div class="partenaire-create">
    <form class="row center-xs" action="/admin/partenaire/store" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
      <?php echo e(csrf_field()); ?>

      <div class="col-xs">
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Logo du partenaire</span>
            <input class="large-file" type="file" name="photo"/>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Nom du partenaire</span>
            <input class="large-field" type="text" name="name"/>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Lien du partenaire</span>
            <input class="large-field" type="text" name="link"/>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Description du partenaire</span>
            <textarea id="cabinet-article" class="large-field text-field" name="description"></textarea>
          </div>
        </div>
        <div class="row center-xs slide__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span></span>
            <div class="count">255 caratères restants</div>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Afficher dans les liens utiles</span>
            <input type="checkbox" name="enabled"/>
          </div>
        </div>
        <input type="submit" class="partenaire-create__save" value="Enregistrer"/>
      </div>
    </form>
    <?php if(\Session::has('emptyFile')): ?>
    <div class="row center-xs partenaire-create__field">
      <p style="color:red">Vous devez ajouter le logo du partenaire</p>
    </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>