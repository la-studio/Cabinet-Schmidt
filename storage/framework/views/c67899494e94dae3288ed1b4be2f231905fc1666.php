<?php $__env->startSection('content'); ?>
  <div class="slide-create">
    <form class="row center-xs" action="/admin/slider/store" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
      <?php echo e(csrf_field()); ?>

      <div class="col-xs">
        <div class="slide-create__field">
          <input type="number" name="index" placeholder="Numéro du slide"/>
        </div>
        <div class="slide-create__field">
          <input type="text" name="title" placeholder="Title du slide"/>
        </div>
        <div class="slide-create__field">
          <textarea name="description" placeholder="Description du slide" ></textarea>
        </div>
        <div class="slide-create__field">
          <span>Cover pour le slide</span>
          <input type="file" name="cover"/>
        </div>
        <button type="submit" role="button">Enregistrer</button>
      </div>
    </form>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>