<?php $__env->startSection('title'); ?>
<?php echo e($article->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e($article->content); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row center-xs echo-article">
    <div class="cover" style="background-image: url(<?php echo e($article->image); ?>)">
    </div>
    <div class="col-xs-9">
      <header>
        <p class="previousPage"><a href="/actualites-cabinet">Retour aux actualités</a></p>
        <h1 class="echo-article__title"><?php echo e($article->title); ?></h1>
      </header>
      <h2 class="echo-article__summary">
        <?php echo e($article->description); ?>

      </h2>
      <p class="echo-article__date"><?php echo e($article->created_at); ?></p>

      <div class="article__content">
        <?php echo $article->content; ?>

      </div>
      <div class="echo-article__publisher mbottom">
        Publié par le Cabinet Schmidt
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>