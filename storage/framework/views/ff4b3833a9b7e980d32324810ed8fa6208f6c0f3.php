<?php $__env->startSection('content'); ?>
  <?php foreach($faq as $question): ?>
    <p>
      Yo, <?php echo e($question->question); ?>

    </p>
  <?php endforeach; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>