<?php $__env->startSection('title'); ?>
Témoignage de <?php echo e($temoignage->person_identity); ?>, <?php echo e($temoignage->person_job); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e($temoignage->description); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row center-xs echo-article">
    <div class="col-xs-9">
      <header>
        <p class="previousPage"><a href="/">Retour à la page d'accueil</a></p>
        <h1 class="echo-article__title">Témoignage de <?php echo e($temoignage->person_identity); ?>, <?php echo e($temoignage->person_job); ?></h1>
      </header>
      <h2 class="echo-article__summary">
        <?php echo e($temoignage->description); ?>

      </h2>
      <div class="article__content">
        <?php echo $temoignage->content; ?>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>