<?php $__env->startSection('title'); ?>
A propos de l'entreprise et l'équipe
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
Notre équipe à taille humaine accompagne et conseille les TPE et artisans du Grésivaudan sur la plan comptable, fiscal, social…
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main class="row end-xs about">
  <div class="col-xs-6 col-custom panel panel--active">
    <div class="row wrapper">
      <div class="col-xs sub-wrapper">
        <h1 class="row panel__title"></h1>
        <div class="row panel__slogan"></div>
        <div class="row arguments">
          <ul class="arguments__list"></ul>
        </div>
        <div class="row center-xs panel__mouse">
          <?php echo $__env->make('about.icons.mouse', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div> <?php /* end col-xs l.6 */ ?>
    </div>
    <div class="row panel__nav panel__nav--show">
      <div data-index="1" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          <?php echo $__env->make('about.icons.team', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
      <div data-index="2" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          <?php echo $__env->make('about.icons.worker', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
      <div data-index="3" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          <?php echo $__env->make('about.icons.map', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
      <div data-index="4" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          <?php echo $__env->make('about.icons.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="about__cover" style="background-image: url('/images/cover-about.jpg')"></div>
  <?php /* <div class="about__responsive">
  </div> */ ?>
</main>
<div class="mouse-template">
  <?php echo $__env->make('about.icons.mouse', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
  <?php echo $__env->make('about.nav-template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php /* nav-template way too long. */ ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>