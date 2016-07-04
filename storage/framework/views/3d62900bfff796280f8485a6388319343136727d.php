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
            <a href="/actualites/<?php echo e($article->slug); ?>" class="row image" style="background-image: url('<?php echo e($article->image); ?>')"></a>
            <div class="row article">
              <div class="col-xs-12">
                <h3 class="row article__title"><a href="/actualites/<?php echo e($article->slug); ?>"><?php echo e($article->title); ?></a></h3>
                <p class="row article__body">
                  <?php if(strlen($article->summary)>200): ?>
                    <?php echo e(substr($article->summary,0,200).'...'); ?>

                  <?php else: ?>
                    <?php echo e($article->summary); ?>

                  <?php endif; ?>
                </p>
              </div>
              <div class="col-xs-12 article__footer">
                  <span class="article__date"><?php echo e($article->date); ?></span>
                  <a href="/actualites/<?php echo e($article->slug); ?>" class="article__button"><span >Lire +</span></a>
              </div>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </section>
      <div class="row middle-xs center-xs gallery__pagination">
        <?php if($echosarticles->lastPage() > 1): ?>
          <ul class="pagination">
              <li class="<?php echo e(($echosarticles->currentPage() == 1) ? ' disabled' : ''); ?>">
                  <a href="<?php echo e($echosarticles->previousPageUrl()); ?>" rel="prev"><i class="material-icons">chevron_left</i></a>
               </li>
              <?php for($i = 1; $i <= $echosarticles->lastPage(); $i++): ?>
                  <?php
                  $half_total_links = floor(7 / 2);
                  $from = $echosarticles->currentPage() - $half_total_links;
                  $to = $echosarticles->currentPage() + $half_total_links;
                  if ($echosarticles->currentPage() < $half_total_links) {
                     $to += $half_total_links - $echosarticles->currentPage();
                  }
                  if ($echosarticles->lastPage() - $echosarticles->currentPage() < $half_total_links) {
                      $from -= $half_total_links - ($echosarticles->lastPage() - $echosarticles->currentPage()) - 1;
                  }
                  ?>
                  <?php if($from < $i && $i < $to): ?>
                      <li class="<?php echo e(($echosarticles->currentPage() == $i) ? ' active' : ''); ?>">
                        <?php if($echosarticles->currentPage() == $i): ?>
                          <?php echo e($i); ?>

                        <?php else: ?>
                          <a href="<?php echo e($echosarticles->url($i)); ?>"><?php echo e($i); ?></a>
                        <?php endif; ?>
                      </li>
                  <?php endif; ?>
              <?php endfor; ?>
              <li class="<?php echo e(($echosarticles->currentPage() == $echosarticles->lastPage()) ? ' disabled' : ''); ?>">
                  <a href="<?php echo e($echosarticles->nextPageUrl()); ?>" rel="next"><i class="material-icons">chevron_right</i></a>
              </li>
          </ul>
      <?php endif; ?>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>