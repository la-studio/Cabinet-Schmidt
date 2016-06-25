<div class="col-xs-12 home__partenaires">
  <div class="row">
    <header class="col-xs-12 partenaires-header">
      <h2 class="partenaires-header__title">Nous travaillons ensemble</h2>
      <?php if($temoignagesLen>0): ?>
      <h3 class="partenaires-header__label">Découvrez aussi <a href="/sites-utiles">les liens utiles</a></h3>
      <?php endif; ?>
    </header>
    <div class="col-xs-12 center-xs partenaires-list">
      <div class="row">
        <?php foreach($partenaires as $partenaire): ?>
          <div class="col-md-3 col-sm-4 col-xs-12 partenaires-logo">
            <a href="http://<?php echo e($partenaire->logo); ?>" target="_blank"></a><img src="<?php echo e($partenaire->logo); ?>" alt title="<?php echo e($partenaire->name); ?>" />
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
