<?php $__env->startSection('content'); ?>
<div class="row center-xs middle-xs admin-home">
  Bienvenue sur le panel d'administration !
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>