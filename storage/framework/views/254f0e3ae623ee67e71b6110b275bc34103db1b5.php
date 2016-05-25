<?php $__env->startSection('content'); ?>
  <div class="row center-xs useful-sites">
    <div class="col-xs-12 useful-sites__cover"></div>
    <div class="col-xs-12 useful-sites__banner">
      <h1>Liens utiles</h1>
    </div>
    <section class="col-xs-12 useful-sites__main-nav">
      <div class="row center-xs">
        <?php echo $__env->make('useful.list-partners', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php /*in this list there're articles classes col-sm-5 col-custom col-xs-12 partner */ ?>
      </div>
    </section>
    <nav class="col-md-11 col-xs-12 useful-sites__second-nav">
      <h2 class="row center-xs">D'autres sites utiles pour les créateurs d'entreprise</h2>
      <div class="row center-xs">
      <?php echo $__env->make('useful.list-links', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php /*in this list there're links classes col-sm-6 col-custom link */ ?>
      </div>
    </nav>
    <nav class="col-xs-12 useful-sites__third-nav">
      <div class="row center-xs">
      <?php echo $__env->make('useful.list-gouv', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php /*in this list there're links classes col-sm-6 col-custom link */ ?>
      </div>
    </nav>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>