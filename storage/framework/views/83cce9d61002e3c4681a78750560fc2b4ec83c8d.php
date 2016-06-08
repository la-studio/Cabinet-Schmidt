<?php $__env->startSection('content'); ?>
  <div class="row center-xs actualites">
    <div class="col-xs-12 actualites__cover"></div>
    <div class="col-xs-12 actualites__banner">
      <h1>L'actualité que nous vous partageons</h1>
    </div>
    <div class="col-xs-12 actualites__preview">
      <?php echo $__env->make('home.actus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="col-md-10 col-xs-12 gallery">
      <header class="row center-xs gallery__head">
        <h2>Toute l'actualité des tpe & pme</h2>
      </header>
      <ul class="row center-xs filters">
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item filters__item--checked" data-filter="all"><span>tous</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Social"><span>Social</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Fiscal"><span>Fiscal</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Innovation Multimédia Création"><span>innovation</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Gestion Patrimoine"><span>gestion</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Juridique"><span>juridique</span></li>
      </ul>
      <section class="row center-xs gallery__list">
        <?php foreach($echosarticles as $article): ?>
        <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper <?php echo e($article->rubrique); ?>">
          <div class="gallery__item">
            <a href="/actus/<?php echo e($article->slug); ?>" class="row image" style="background-image: url('<?php echo e($article->image); ?>')"></a>
            <div class="row article">
              <div class="col-xs-12">
                <h3 class="row article__title"><a href="/actus/<?php echo e($article->slug); ?>"><?php echo e($article->title); ?></a></h3>
                <p class="row article__body">
                  <?php echo e($article->summary); ?>

                </p>
              </div>
              <div class="col-xs-12 article__footer">
                  <span class="article__date"><?php echo e($article->date); ?></span>
                  <a href="/actus/<?php echo e($article->slug); ?>" class="article__button"><span >Lire +</span></a>
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