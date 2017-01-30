<?php $__env->startSection('title'); ?>
Les simulateurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
Simulez vos congés payés, calculez vos indemnités kilométriques, votre seuil de rentabilité...
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row"> <?php /* children have col-xs-12 markup on their global wrapper. */ ?>
    <?php echo $__env->make('simulators.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>