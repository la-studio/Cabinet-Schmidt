<?php $__env->startSection('content'); ?>
<div class="row center-xs articles-list">
  <?php foreach($articles as $article): ?>
    <div class="col-sm-6 article">
      <div class="row center-xs middle-xs wrapper">
        <div class="col-xs">
          <p class="article__title">Titre :<?php echo e($article->title); ?></p>
          <p class="article__content">Contenu : <?php echo e($article->content); ?></p>
        </div>
      </div>
      <form class="row center-xs article__form" action="/admin/article/delete/<?php echo e($article->id); ?>" method="post">
        <?php echo e(method_field('DELETE')); ?>

        <?php echo e(csrf_field()); ?>

        <a class="edit" href="/admin/article/edit/<?php echo e($article->id); ?>"><span>Éditer</span></a>
        <input type="submit" class="delete" value="Supprimer"/>
      </form>
    </div>
  <?php endforeach; ?>
</div>
  <a href="/admin/article/create" class="row center-xs article-add"><span>Ajouter un article</span></a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>