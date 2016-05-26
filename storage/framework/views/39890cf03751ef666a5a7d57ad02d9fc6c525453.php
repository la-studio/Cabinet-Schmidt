<?php $__env->startSection('content'); ?>
<div class>
  Bienvenue sur le panel d'administration !
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>