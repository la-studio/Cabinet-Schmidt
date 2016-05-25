<?php $__env->startSection('content'); ?>
<div class="rowfix row center-xs articles-list">
  <?php foreach($articles as $article): ?>
    <div href="/admin/article/<?php echo e($article->id); ?>" class="col-sm-6 article">
      <div class="row center-xs middle-xs rowfix wrapper">
        <div class="col-xs">
          <p><?php echo e($article->title); ?></p>
          <p><?php echo e($article->content); ?></p>
          <form action="/admin/article/delete/<?php echo e($article->id); ?>" method="post">
            <?php echo e(method_field('DELETE')); ?>

            <?php echo e(csrf_field()); ?>

            <button type="submit" name="button">Delete</button>
          </form>
          <a href="/admin/article/edit/<?php echo e($article->id); ?>"><span>Edit</span></a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  <a href="/admin/article/create" class="article-add"><span>Ajouter un article</span></a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>