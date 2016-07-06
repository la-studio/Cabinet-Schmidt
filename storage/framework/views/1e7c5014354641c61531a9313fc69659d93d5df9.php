<div class="col-xs-12 home__actus">
  <div class="row">
    <header class="col-xs-12 actus-header">
      <h1 class="actus-header__title">L’actualité de votre cabinet d’expertise comptable</h1>
      <h2 class="actus-header__label">Découvrez <a href="/actualites">plus d'actualités</a></h2>
    </header>
    <div class="col-xs-12 actus-articles">
      <div class="row center-lg">
        <section class="col-custom col-md-5 col-sm-5 col-xs-12 actus-articles__cabinet">
          <h3 class="actus-articles__header">L'actualité du cabinet</h3>
          <?php foreach($articles as $article): ?>
            <article class="row middle-xs article">
                <div class="article__wrapper"> <!-- wrapper is here to center content into the defined height box without stretch elements on sides and middle. -->
                  <h4 class="article__name"><?php echo e($article->title); ?></h4>
                  <p class="article__body">
                    <?php echo e($article->content); ?>

                  </p>
                  <span class="article__date"><?php echo e($article->created_at); ?></span>
                </div>
            </article>
          <?php endforeach; ?>
        </section>
        <section class="col-custom col-md-7 col-sm-7 col-xs-12 actus-articles__entreprises">
          <h3 class="actus-articles__header">L'actualité des TPE-PME</h3>
           <?php for($i = 0; $i < 2; $i++): ?>
            <article class="row article">
              <a href="/actualites/<?php echo e($echosarticles[$i]->slug); ?>" class="col-xs article__picture" style="background-image: url('<?php echo e($echosarticles[$i]->image); ?>')"></a>
              <div class="col-xs article__content">
                <div class="row article__wrapper">
                  <h4 class="article__name <?php if($is_large): ?>article__name--small"<?php endif; ?>><a href="/actualites/<?php echo e($echosarticles[$i]->slug); ?>"><?php echo e($echosarticles[$i]->title); ?></a></h4>
                  <p class="article__body">
                    <?php if(strlen($echosarticles[$i]->summary)>200): ?>
                      <?php echo e(substr($echosarticles[$i]->summary,0,200).'...'); ?>

                    <?php else: ?>
                      <?php echo e($echosarticles[$i]->summary); ?>

                    <?php endif; ?>
                  </p>
                </div>
                <div class="article__footer">
                  <span class="date"><?php echo e($echosarticles[$i]->date); ?></span>
                  <a href="/actualites/<?php echo e($echosarticles[$i]->slug); ?>" class="button"><span >Lire +</span></a>
                </div>
              </div>
            </article>
           <?php endfor; ?>
        </section>
      </div>
    </div>
  </div>
</div>
