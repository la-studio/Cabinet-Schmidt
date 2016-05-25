<?php $__env->startSection('content'); ?>
  <div class="article-create">
    <form class="row center-xs" action="/admin/article/store" method="post">
      <?php echo e(csrf_field()); ?>

      <div class="col-xs">
        <div class="article-create__field">
          <input type="text" name="title" placeholder="Title de l'article"/>
        </div>
        <div class="article-create__field">
          <textarea type="text" name="content" placeholder="Contenu de l'article"></textarea>
        </div>
        <button type="submit" role="button">Enregistrer</button>
      </div>
    </form>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>