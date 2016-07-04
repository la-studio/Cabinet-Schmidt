<?php $__env->startSection('content'); ?>
<div class="row center-xs chiffres">
  <div class="col-xs-12 chiffres__cover"></div>
  <div class="col-xs-12 chiffres__banner">
    <h1>Chiffres utiles</h1>
  </div>
  <div class="col-md-10 col-xs-12 gallery">
    <ul class="row center-xs filters">
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item <?php echo e(($page == 'digit') ? 'filters__item--checked' : ''); ?>" data-filter="all"><a href="<?php echo e(URL::to('chiffres-utiles')); ?>"><span>Tous</span></a></li>
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item <?php echo e(($page == 'Social') ? 'filters__item--checked' : ''); ?>" data-filter="Social"><a href="<?php echo e(URL::to('chiffres-utiles/rubrique/Social')); ?>"><span>Social</span></a></li>
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item <?php echo e(($page == 'Fiscal') ? 'filters__item--checked' : ''); ?>" data-filter="Fiscal"><a href="<?php echo e(URL::to('chiffres-utiles/rubrique/Fiscal')); ?>"><span>Fiscal</span></a></li>
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item <?php echo e(($page == 'Juridique') ? 'filters__item--checked' : ''); ?>" data-filter="Juridique"><a href="<?php echo e(URL::to('chiffres-utiles/rubrique/Juridique')); ?>"><span>Juridique</span></a></li>
    </ul>
    <section class="row center-xs gallery__list">
      <?php foreach($digitarticles as $article): ?>
      <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper <?php echo e($article->rubrique); ?>">
        <div class="gallery__item">
          <a href="/chiffres-utiles/<?php echo e($article->slug); ?>" class="row image" style="background-image: url('<?php echo e($article->image); ?>')">               
            <span class="article__category <?php echo e($article->rubrique); ?>"><?php echo e($article->rubrique); ?></span>
          </a>
          <div class="row article">
            <div class="col-xs-12">
              <h3 class="row article__title"><a href="/chiffres-utiles/<?php echo e($article->slug); ?>"><?php echo e($article->title); ?></a></h3>
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
                <a href="/chiffres-utiles/<?php echo e($article->slug); ?>" class="article__button">Lire +</a>
            </div>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </section>
    <div class="row middle-xs center-xs gallery__pagination">
        <?php if($digitarticles->lastPage() > 1): ?>
          <ul class="pagination">
              <li class="<?php echo e(($digitarticles->currentPage() == 1) ? ' disabled' : ''); ?>">
                  <a href="<?php echo e($digitarticles->previousPageUrl()); ?>" rel="prev"><i class="material-icons">chevron_left</i></a>
               </li>
              <?php for($i = 1; $i <= $digitarticles->lastPage(); $i++): ?>
                  <?php
                  $half_total_links = floor(7 / 2);
                  $from = $digitarticles->currentPage() - $half_total_links;
                  $to = $digitarticles->currentPage() + $half_total_links;
                  if ($digitarticles->currentPage() < $half_total_links) {
                     $to += $half_total_links - $digitarticles->currentPage();
                  }
                  if ($digitarticles->lastPage() - $digitarticles->currentPage() < $half_total_links) {
                      $from -= $half_total_links - ($digitarticles->lastPage() - $digitarticles->currentPage()) - 1;
                  }
                  ?>
                  <?php if($from < $i && $i < $to): ?>
                      <li class="<?php echo e(($digitarticles->currentPage() == $i) ? ' active' : ''); ?>">
                        <?php if($digitarticles->currentPage() == $i): ?>
                          <?php echo e($i); ?>

                        <?php else: ?>
                          <a href="<?php echo e($digitarticles->url($i)); ?>"><?php echo e($i); ?></a>
                        <?php endif; ?>
                      </li>
                  <?php endif; ?>
              <?php endfor; ?>
              <li class="<?php echo e(($digitarticles->currentPage() == $digitarticles->lastPage()) ? ' disabled' : ''); ?>">
                  <a href="<?php echo e($digitarticles->nextPageUrl()); ?>" rel="next"><i class="material-icons">chevron_right</i></a>
              </li>
          </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>