<?php $__env->startSection('title'); ?>
L’actualité du Cabinet Schmidt
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
Suivez l’actualité de votre cabinet comptable et de la région grenobloise !
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row center-xs actualites">
    <div class="col-xs-12 actualites__cover"></div>
    <div class="col-xs-12 actualites__banner">
      <h1>L’actualité du cabinet</h1>
    </div>
    <div class="col-md-10 col-xs-12 gallery" id="gallery">
      <header class="row center-xs gallery__head">
        <h2>Toute l'actualité du Cabinet Schmdit</h2>
      </header>
      <section class="row center-xs gallery__list">
          <?php foreach($articles as $article): ?>
          <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper">
            <div class="gallery__item">
              <?php if(isset($article->image)): ?>
              <a href="/actualites-cabinet/<?php echo e($article->slug); ?>" class="row image imgctrd" style="background-image: url('<?php echo e($article->image); ?>')">
              </a>
              <?php endif; ?>
              <?php if(!isset($article->image)): ?>
              <div class="row article maxheight">
              <?php else: ?>
              <div class="row article">
              <?php endif; ?>
                <div class="col-xs-12">
                  <h3 class="row article__title"><a href="/actualites-cabinet/<?php echo e($article->slug); ?>"><?php echo e($article->title); ?></a></h3>
                  <p class="row article__body">
                    <?php echo e($article->description); ?>

                  </p>
                </div>
                <div class="col-xs-12 article__footer">
                    <span class="article__date"><?php echo e($article->created_at); ?></span>
                    <?php if(strlen($article->content)>0): ?>
                      <a href="/actualites-cabinet/<?php echo e($article->slug); ?>" class="article__button"><span >Lire +</span></a>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </section>
        <div class="row middle-xs center-xs gallery__pagination">
          <?php if($articles->lastPage() > 1): ?>
            <ul class="pagination">
                <li class="<?php echo e(($articles->currentPage() == 1) ? ' disabled' : ''); ?>">
                    <a href="<?php echo e($articles->previousPageUrl()); ?>#gallery" rel="prev"><i class="material-icons">chevron_left</i></a>
                 </li>
                <?php for($i = 1; $i <= $articles->lastPage(); $i++): ?>
                    <?php
                    $half_total_links = floor(7 / 2);
                    $from = $articles->currentPage() - $half_total_links;
                    $to = $articles->currentPage() + $half_total_links;
                    if ($articles->currentPage() < $half_total_links) {
                       $to += $half_total_links - $articles->currentPage();
                    }
                    if ($articles->lastPage() - $articles->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($articles->lastPage() - $articles->currentPage()) - 1;
                    }
                    ?>
                    <?php if($from < $i && $i < $to): ?>
                        <li class="<?php echo e(($articles->currentPage() == $i) ? ' active' : ''); ?>">
                          <?php if($articles->currentPage() == $i): ?>
                            <?php echo e($i); ?>

                          <?php else: ?>
                            <a href="<?php echo e($articles->url($i)); ?>#gallery"><?php echo e($i); ?></a>
                          <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
                <li class="<?php echo e(($articles->currentPage() == $articles->lastPage()) ? ' disabled' : ''); ?>">
                    <a href="<?php echo e($articles->nextPageUrl()); ?>#gallery" rel="next"><i class="material-icons">chevron_right</i></a>
                </li>
            </ul>
          <?php endif; ?>
        </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>