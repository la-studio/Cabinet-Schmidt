<?php if ( ! ($articles->isEmpty() && $echosarticles->isEmpty())): ?>
<div class="col-xs-12 home__actus">
  <div class="row">
    <header class="col-xs-12 actus-header">
      <h1 class="actus-header__title">L’actualité de votre cabinet d’expertise comptable</h1>
    </header>
    <div class="col-xs-12 actus-articles">
      <div class="row center-lg">
        <?php if(!$articles->isEmpty()): ?>
        <section class="col-custom col-md-6 col-sm-6 col-xs-12 actus-articles__entreprises">
          <h2 class="actus-articles__header"><a href="/actualites-cabinet">Toute l'actualité du cabinet</a></h2>
          <?php foreach($articles as $article): ?>
            <article class="row article">
                <?php if(isset($article->image)): ?>
                <a href="/actualites-cabinet/<?php echo e($article->slug); ?>" class="col-xs article__picture" style="background-image: url('<?php echo e($article->image); ?>')"></a>
                <div class="col-xs article__content">
                  <div class="row article__wrapper"> <!-- wrapper is here to center content into the defined height box without stretch elements on sides and middle. -->
                    <h4 class="article__name"><?php echo e($article->title); ?></h4>
                    <p class="article__body">
                      <?php echo e($article->description); ?>

                    </p>
                  </div>
                  <div class="article__footer">
                      <span class="date"><?php echo e($article->created_at); ?></span>
                      <?php if(strlen($article->content)>0): ?>
                      <a href="/actualites-cabinet/<?php echo e($article->slug); ?>" class="button"><span >Lire +</span></a>
                      <?php endif; ?>
                  </div>
                </div>
                <?php else: ?>
                    <div class="article__content withoutimage">

                      <h4 class="article__name"><?php echo e($article->title); ?></h4>
                      <p class="article__body">
                          <?php echo e($article->description); ?>

                      </p>

                       <div class="article__footer">
                        <span class="date"><?php echo e($article->created_at); ?></span>
                        <?php if(strlen($article->content)>0): ?>
                        <a href="/actualites-cabinet/<?php echo e($article->slug); ?>" class="button"><span >Lire +</span></a>
                        <?php endif; ?>
                    </div>
                  </div>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </section>
        <?php endif; ?>
        <?php if(!$echosarticles->isEmpty()): ?>
        <section class="col-custom col-md-6 col-sm-6 col-xs-12 actus-articles__entreprises pr35">
          <h2 class="actus-articles__header"><a href="/actualites">Toute l'actualité des chefs d'entreprises</a></h2>
           <?php foreach($echosarticles as $echosarticle): ?>
            <article class="row article">
              <a href="/actualites/<?php echo e($echosarticle->slug); ?>" class="col-xs article__picture" style="background-image: url('<?php echo e($echosarticle->image); ?>')"></a>
              <div class="col-xs article__content">
                <div class="row article__wrapper">
                  <h4 class="article__name <?php if($is_large): ?>article__name--small"<?php endif; ?>><a href="/actualites/<?php echo e($echosarticle->slug); ?>"><?php echo e($echosarticle->title); ?></a></h4>
                  <p class="article__body">
                    <?php if(strlen($echosarticle->summary)>200): ?>
                      <?php echo e(substr($echosarticle->summary,0,200).'...'); ?>

                    <?php else: ?>
                      <?php echo e($echosarticle->summary); ?>

                    <?php endif; ?>
                  </p>
                </div>
                <div class="article__footer">
                  <span class="date"><?php echo e($echosarticle->date); ?></span>
                  <a href="/actualites/<?php echo e($echosarticle->slug); ?>" class="button"><span >Lire +</span></a>
                </div>
              </div>
            </article>
           <?php endforeach; ?>
        </section>
        <?php endif; ?>
      </div>
    </div>
    <header class="col-xs-12 actus-header margintop">
      <h2 class="actus-header__label">Consultez également les <a href="/chiffres-utiles">chiffres utiles</a> aux entrepreneurs</h2> 
      <br>
      <h2 class="actus-header__label">Et trouvez réponse à vos questions comptables, fiscales, sociales... dans <a href="/faq">la FAQ</a> !</h2>
    </header>
  </div>
</div>
<?php endif; ?>
