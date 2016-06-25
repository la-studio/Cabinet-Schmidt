<?php $__env->startSection('content'); ?>
  <div class="row center-xs middle-xs not-found">
    <div class="not-found__image">
      <?php echo $__env->make('errors.picto', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="not-found__body">
      <h2>Oups !</h2>
      <h3>Nous n'avons pas trouvé la page que vous recherchez.</h3>
      <span><a href="<?php echo e(URL::to('/')); ?>">Retour à l'accueil</a></span>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>