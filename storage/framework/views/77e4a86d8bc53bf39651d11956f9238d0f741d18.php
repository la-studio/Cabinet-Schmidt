<div class="col-xs-12 home__slider">
  <div class="row">
    <div class="col-xs swiper">
        <div class="swiper-wrapper">
          <?php foreach($slider as $slide): ?>
            <div class="swiper-slide" style="background-image: url('<?php echo e($slide->cover); ?>')">
              <div class="slider-caption">
                <h2 class="slider-caption__title"><?php echo e($slide->title); ?></h2>
                <div class="slider-body">
                  <p class="slider-body__text"><?php echo e($slide->description); ?></p>
                  <?php if($slide->button_link!=='' && $slide->button_link!==null): ?>
                  <a href="<?php echo e($slide->button_link); ?>" class="slider-body__button">
                    <span><?php echo e($slide->button_name); ?></span>
                  </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
        <div class="swiper-button-next">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
    </div>
  </div>
</div>
