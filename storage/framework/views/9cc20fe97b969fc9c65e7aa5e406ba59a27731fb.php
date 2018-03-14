<div class="col-xs-12 services" style="background-attachment: fixed">
  <div class="row center-xs">
    <header class="col-xs-12 services__head">
      <h2 class="services__title">Un cabinet d'expertise c'est</h2>
      <h3 class="services__label">Bien plus que de la comptabilité</h3>
    </header>
    <?php echo $__env->make('home.services.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <!-- section class="col-xs-12 services__list" in this template.-->
  </div>
</div>
