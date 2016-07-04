<?php foreach($echosarticles as $article): ?>
  <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper <?php echo e($article->rubrique); ?>">
    <div class="gallery__item">
      <a href="/actualites/<?php echo e($article->slug); ?>" class="row image" style="background-image: url('<?php echo e($article->image); ?>')"></a>
      <div class="row article">
        <div class="col-xs-12">
          <h3 class="row article__title"><a href="/actualites/<?php echo e($article->slug); ?>"><?php echo e($article->title); ?></a></h3>
          <p class="row article__body">
            <?php if(strlen($article->summary)>140): ?>
              <?php echo e(substr($article->summary,0,140).'...'); ?>

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