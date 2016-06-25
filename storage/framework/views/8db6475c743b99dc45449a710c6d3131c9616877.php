<?php $__env->startSection('content'); ?>
  <div class="row story">
    <div class="col-xs">
      <div class="row center-xs story__cover" style="background-image: url('<?php echo e($slide->cover); ?>')"></div>
      <form class="row center-xs story__form" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/storytelling/update/<?php echo e($slide->id); ?>">
        <div class="col-xs">
          <?php echo e(method_field('PUT')); ?>

          <?php echo e(csrf_field()); ?>

          <div class="row center-xs story__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de couverture</span>
              <input type="file" class="file-input" name="photo"/>
            </div>
          </div>
          <div class="row center-xs story__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de titre</span>
              <input type="text" name="title" value="<?php echo e($slide->title); ?>"/>
            </div>
          </div>
          <div class="row center-xs story__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le résumé</span>
              <?php /* <input type="text" name="summary" value="<?php echo e($slide->summary); ?>"/> */ ?>
              <textarea name="summary"><?php echo e($slide->summary); ?></textarea>
            </div>
          </div>
          <div class="row center-xs story__field">
            <input type="text" class="to_add"/>
            <span class="add">Ajouter</span>
          </div>
          <ul class="row list">
            <?php foreach($slide->list_item as $item): ?>
            <li class="list__item"><span><?php echo e($item->name); ?></span><span class="delete"><i class="material-icons">clear</i></span></li>
            <?php endforeach; ?>
          </ul>
          <?php foreach($slide->list_item as $item): ?>
          <input type="hidden" name="item[]" value="<?php echo e($item->name); ?>">
          <?php endforeach; ?>
          <input type="submit" class="story__save" value="Enregistrer">
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>