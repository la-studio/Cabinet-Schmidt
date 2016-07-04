<?php $__env->startSection('content'); ?>
<div class="rowfix row partenaires-list">
  <?php foreach($partenaires as $partenaire): ?>
    <div href="/admin/partenaire/<?php echo e($partenaire->id); ?>" class="col-sm-6 article">
      <div class="row center-xs middle-xs rowfix wrapper">
        <div class="col-xs">
          <div class=""><img src="<?php echo e($partenaire->logo); ?>" alt></div>
          <p><?php echo e($partenaire->description); ?></p>
          <div class="row center-xs">
            <form class="delete-form" action="/admin/partenaire/delete/<?php echo e($partenaire->id); ?>" method="post">
              <?php echo e(method_field('DELETE')); ?>

              <?php echo e(csrf_field()); ?>

              <input type="submit" value="Supprimer"/>
            </form>
            <a class="article__edit" href="/admin/partenaire/edit/<?php echo e($partenaire->id); ?>"><span>Éditer</span></a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  <div class="col-xs-12 partenaire-add">
    <a href="/admin/partenaire/create"><span>Ajouter un partenaire</span></a>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>