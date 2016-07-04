<?php $__env->startSection('content'); ?>
  <div class="row center-xs article">
    <div class="col-xs">
      <form class="row center-xs" method="post" action="/admin/article/update/<?php echo e($article->id); ?>">
        <?php echo e(method_field('PATCH')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="col-xs">
          <div class="row center-xs article__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Titre de l'article</span>
              <input type="text" name="title" value="<?php echo e($article->title); ?>">
            </div>
          </div>
          <div class="row center-xs article__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Contenu de l'article</span>
              <textarea name="content"><?php echo e($article->content); ?></textarea>
            </div>
          </div>
          <input type="submit" class="article__save" value="Enregistrer">
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>