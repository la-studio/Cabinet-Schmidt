<section id="tes" class="col-md-10 col-custom col-xs-12 services__list">
  <div class="row around-lg between-md center-xs">
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name"><?php echo e($competences[0]->title); ?></h3>
            <div class="service__icon">
              <?php echo $__env->make('home.services.icons.bulles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan"><?php echo e($competences[0]->label); ?></p>
        <p class="col-xs-12 service__description"><?php echo e($competences[0]->description); ?></p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name"><?php echo e($competences[1]->title); ?></h3>
            <div class="service__icon">
              <?php echo $__env->make('home.services.icons.ordinateur', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan"><?php echo e($competences[1]->label); ?></p>
        <p class="col-xs-12 service__description"><?php echo e($competences[1]->description); ?></p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name"><?php echo e($competences[2]->title); ?></h3>
            <div class="service__icon">
              <?php echo $__env->make('home.services.icons.fichier', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan"><?php echo e($competences[2]->label); ?></p>
        <p class="col-xs-12 service__description"><?php echo e($competences[2]->description); ?></p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name"><?php echo e($competences[3]->title); ?></h3>
            <div class="service__icon">
              <?php echo $__env->make('home.services.icons.calculatrice', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan"><?php echo e($competences[3]->label); ?></p>
        <p class="col-xs-12 service__description"><?php echo e($competences[3]->description); ?></p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name"><?php echo e($competences[4]->title); ?></h3>
            <div class="service__icon">
              <?php echo $__env->make('home.services.icons.silhouette', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan"><?php echo e($competences[4]->label); ?></p>
        <p class="col-xs-12 service__description"><?php echo e($competences[4]->description); ?></p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name"><?php echo e($competences[5]->title); ?></h3>
            <div class="service__icon">
              <?php echo $__env->make('home.services.icons.loupe', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan"><?php echo e($competences[5]->label); ?></p>
        <p class="col-xs-12 service__description"><?php echo e($competences[5]->description); ?></p>
      </div>
    </article>
  </div>
</section>
