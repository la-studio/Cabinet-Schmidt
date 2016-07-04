<?php $__env->startSection('content'); ?>
  <div class="row home"> <?php /* children have col-xs-12 markup on their global wrapper. */ ?>
    <?php echo $__env->make('home.slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('home.contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('home.actus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('home.services', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if($temoignagesLen>0): ?>
      <?php echo $__env->make('home.temoignages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(count($count)): ?>
      <?php echo $__env->make('home.agenda', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
      <?php echo $__env->make('home.agenda-empty', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('home.partenaires', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>