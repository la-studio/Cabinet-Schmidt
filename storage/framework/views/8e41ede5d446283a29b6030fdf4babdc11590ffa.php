<?php $__env->startSection('content'); ?>
<div class="row center-xs middle-xs admin-home">
  <p>Bienvenue <?php echo e(Auth::user()->name); ?> ! Le panneau d'administration permet de gérer le contenu du site web</p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>