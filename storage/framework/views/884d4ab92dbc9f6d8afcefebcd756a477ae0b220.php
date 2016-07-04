<?php $__env->startSection('content'); ?>
  <div class="row center-xs echo-article">
    <div class="col-xs-9">
      <header>
        <h1 class="echo-article__title"><?php echo e($compacted_article->title); ?></h1>
        <h2 class="echo-article__summary"><?php echo e($compacted_article->summary); ?></h2>
      </header>
      <p class="echo-article__date"><?php echo e($compacted_article->created_at); ?></p>
      <div class="echo-article__content">
        <?php echo e($compacted_article->content); ?>

      </div>
      <?php if(count($compacted_article->table_html)>0): ?>
      <div class="echo-article__table"><?php echo e($compacted_article->table_html); ?></div>
      <?php endif; ?>
      <div class="echo-article__author">
        <?php echo e($compacted_article->auteur); ?>

      </div>
      <?php if(count($compacted_article->references)>0): ?>
      <nav class="row start-xs echo-article__links">
        <h3>Liens de référence : </h3>
        <?php foreach($compacted_article->references as $link): ?>
          <span><a href="<?php echo e($link->link); ?>"><?php echo e($link->label); ?></a></span>
        <?php endforeach; ?>
      </nav>
      <?php endif; ?>
      <div class="row center-xs echo-article__suggestions">
        <h3 class="col-xs-12">D'autres articles des Echos Publishing</h3>
        <?php foreach($result as $suggestion): ?>
        <div class="col-md col-sm-6 col-xs-12 suggestion">
          <div class="row wrapper">
            <span class="col-xs-12 suggestion__cover"><a href="/chiffres-utiles/<?php echo e($suggestion->slug); ?>" style="background-image:url('<?php echo e($suggestion->image); ?>')"></a></span>
            <a href="/chiffres-utiles/<?php echo e($suggestion->slug); ?>" class="col-xs-12 suggestion__caption"><?php echo e($suggestion->title); ?></a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>