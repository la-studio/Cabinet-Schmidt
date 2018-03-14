<?php $__env->startSection('title'); ?>
Ils nous font confiance
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
Tous les témoignagnes des clients du Cabinet Schmidt. Ils nous font confiance.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row center-xs actualites">
    <div class="col-xs-12 actualites__cover"></div>
    <div class="col-xs-12 actualites__banner">
      <h1>Les témoignages du Cabinet Schmidt</h1>
    </div>
    <div class="col-md-10 col-xs-12 gallery" id="gallery">
      <header class="row center-xs gallery__head">
        <h2>Ils nous font confiance</h2>
      </header>
      <section class="row center-xs gallery__list">
        <?php foreach($temoignages as $temoignage): ?>
          <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper">
            <div class="gallery__item">
              <?php if(!empty($temoignage->photo)): ?>
                <a href="/temoignage/<?php echo e($temoignage->slug); ?>" class="row image" style="background: url('<?php echo e($temoignage->photo); ?>') no-repeat center; background-size: 100%; background-position: top"></a>
              <?php endif; ?>
              <div class="row article">
                <div class="col-xs-12">
                  <h3 class="row article__title" style="margin-bottom: 5px"><a href="/temoignage/<?php echo e($temoignage->slug); ?>"><?php echo e($temoignage->person_identity); ?></a></h3>
                    <h4 class="row article__title"><a><?php echo e($temoignage->person_job); ?></a></h3>
                  <p class="row article__body">
                    <?php if(strlen($temoignage->description)>140): ?>
                      <?php echo e(substr($temoignage->description,0,139).'...'); ?>

                    <?php else: ?>
                      <?php echo e($temoignage->description); ?>

                    <?php endif; ?>
                  </p>
                </div>
                <div class="col-xs-12 article__footer">
                    <span></span>
                    <a href="/temoignage/<?php echo e($temoignage->slug); ?>" class="article__button"><span >Lire +</span></a>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </section>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>