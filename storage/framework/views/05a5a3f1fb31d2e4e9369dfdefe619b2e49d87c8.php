<?php $__env->startSection('content'); ?>
<div class="rowfix row slider-list">
  <div class="col-xs">
  <?php foreach($slider as $slide): ?>
    <div class="row slide">
      <div class="col-xs">
        <div class="row middle-xs slide__header">
          <h2>Slide <?php echo e($slide->index); ?></h2>
          <span><a href="/admin/slide/edit/<?php echo e($slide->id); ?>"><i class="material-icons">create</i></a></span></a>
        </div>
        <div class="row slide__content">
          <a href="/admin/slide/edit/<?php echo e($slide->id); ?>" class="col-md-6 col-xs-12 slide__bg" style="background-image:url('<?php echo e($slide->cover); ?>')"></a>
          <div class="col-md-6 col-xs-12 properties">
            <div class="row properties__title">
              <span><?php echo e($slide->title); ?></span>
            </div>
            <div class="row properties__description">
              <p><?php echo e($slide->description); ?></p>
            </div>
            <div class="row properties__link-target">
              <?php if($slide->button_link!=='' && $slide->button_link!==null): ?>
              <p>Le lien/L'ancre du bouton est : <?php echo e($slide->button_link); ?></p>
              <?php else: ?>
                <p>Ce bouton n'a pas de lien. Il n'est donc pas visible sur le slider</p>
              <?php endif; ?>
            </div>
            <div class="row properties__button-name">
              <p>Le texte du bouton est : <?php echo e($slide->button_name); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>