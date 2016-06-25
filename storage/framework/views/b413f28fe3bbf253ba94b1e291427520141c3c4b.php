<?php $__env->startSection('content'); ?>
<div class="row temoignages-list">
  <?php foreach($temoignages as $temoignage): ?>
    <div class="col-sm-6 col-xs-12 temoignage">
      <div class="row center-xs temoignage__image">
        <img src="<?php echo e($temoignage->logo); ?>" alt="" />
      </div>
      <div class="row center-xs temoignage__title">
        <span><?php echo e($temoignage->title); ?></span>
      </div>
      <div class="row center-xs temoignage__content">
        <span><?php echo e($temoignage->content); ?></span>
      </div>
      <div class="row center-xs temoignage__identity">
        <span><?php echo e($temoignage->person_identity); ?></span>
      </div>
      <div class="row center-xs temoignage__job">
        <span><?php echo e($temoignage->person_job); ?></span>
      </div>
      <form class="row center-xs temoignage__form" action="/admin/temoignage/delete/<?php echo e($temoignage->id); ?>" method="post">
        <?php echo e(method_field('DELETE')); ?>

        <?php echo e(csrf_field()); ?>

        <a class="edit" href="/admin/temoignage/edit/<?php echo e($temoignage->id); ?>"><span>Éditer</span></a>
        <input type="submit" class="delete" value="Supprimer">
      </form>
    </div>
  <?php endforeach; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>