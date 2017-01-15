<?php $__env->startSection('content'); ?>
  <div class="article-create">
    <form class="row center-xs" action="/admin/article/store" method="post" enctype="multipart/form-data">
      <?php echo e(csrf_field()); ?>

      <div class="col-xs">
        <div class="row center-xs article__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Image de l'article</span>
            <input type="file" name="image">
          </div>
        </div>
        <div class="row center-xs article__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Titre de l'article</span>
            <input type="text" class="large-field" name="title">
          </div>
        </div>
        <div class="row center-xs article__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Description de l'article</span>
            <textarea class="large-field text-field" id="cabinet-article" name="description"></textarea>
          </div>
        </div>
          <div class="row center-xs article__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span></span>
              <div class="count">255 caratères restants</div>
            </div>
          </div>
        <div class="row center-xs article__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Contenu de l'article</span>
            <textarea id="article-ckeditor" name="content"></textarea>
          </div>
        </div>
        <input type="submit" class="article__save" value="Enregistrer">
      </div>
    </form>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>