<div class="col-xs-12 home__partenaires">
  <div class="row">
    <header class="col-xs-12 partenaires-header">
      <h2 class="partenaires-header__title">Nous travaillons ensemble</h2>
      <h3 class="partenaires-header__label">Découvrez aussi <a href="#">quelques témoignages</a></h3>
    </header>
    <div id="slider-partenaires" class="slider">
      <div class="swiper-wrapper">
        <?php foreach($partenaires as $partenaire): ?>
          <div class="swiper-slide">
            <img src="<?php echo e($partenaire->logo); ?>" alt title="<?php echo e($partenaire->name); ?>" />
          </div>
        <?php endforeach; ?>
      </div>
      <?php /* <div class="swiper-button-prev">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
      </div>
      <div class="swiper-button-next">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </div> */ ?>
    </div>
  </div>
</div>
