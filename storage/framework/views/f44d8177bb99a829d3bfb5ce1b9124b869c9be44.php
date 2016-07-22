<?php $__env->startSection('content'); ?>
  <div class="row slide">
    <div class="col-xs">
      <form class="row center-xs slide__form" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/temoignage/store">
        <div class="col-xs">
          <?php echo e(csrf_field()); ?>

          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Logo de l'entreprise</span>
              <input class="large-file file-input" type="file" name="photo"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Nom du témoin</span>
              <input class="large-field" type="text" name="person_identity"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Métier et entreprise</span>
              <input class="large-field" type="text" name="person_job"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Le témoignage</span>
              <textarea class="large-field text-field" id="cabinet-article" name="content"></textarea>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span></span>
              <div class="count">255 caratères restants</div>
            </div>
          </div>
          <input type="submit" class="competence__save" value="Enregistrer"/>
        <?php if(\Session::has('emptyFile')): ?>
        <p style="color:red">Vous devez ajouter le logo de l'entreprise</p>
        <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>