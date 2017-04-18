<?php $__env->startSection('content'); ?>
  <div class="row center-xs article">
    <div class="col-xs">
      <form class="row center-xs" method="post" action="/admin/article/update/<?php echo e($article->id); ?>" enctype="multipart/form-data">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <?php if(isset($article->image)): ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <img src="<?php echo e($article->image); ?>" alt="<?php echo e($article->title); ?>" class="maxwh">
            </div>
        <?php endif; ?>
        <div class="col-xs">
          <div class="row center-xs article__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Image de l'article</span>
              <input type="file" name="image">
            </div>
        </div>
        <div class="col-xs">
          <div class="row center-xs article__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Titre de l'article</span>
              <input class="large-field" type="text" name="title" value="<?php echo e($article->title); ?>">
            </div>
          </div>
        <div class="row center-xs article__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Description de l'article</span>
            <textarea class="large-field text-field" id="cabinet-article" name="description"><?php echo e($article->description); ?></textarea>
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
              <textarea class="large-field text-field" id="article-ckeditor" name="content"><?php echo e($article->content); ?></textarea>
            </div>
          </div>
          <input type="submit" class="article__save" value="Enregistrer">
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>