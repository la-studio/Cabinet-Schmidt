<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="/css/flexboxgrid.css" media="screen">
    <link rel="stylesheet" href="/css/normalize.css" media="screen">
    <link rel="stylesheet" href="/css/font-awesome-4.3.0/css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="/css/app.css" media="screen">
    <title>Cabinet Schmidt</title>
  </head>
  <body>
    <div class="email">
      <header class="row center-xs email__head">
        <div class="logo">
          <?php echo $__env->make('layout.logo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </header>
      <div class="row center-xs email__content">
        <div class="col-xs-9">
          <p class="sb">
            Bonjour, <?php echo e($identity); ?> (<a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a>)<?php if($company!==""): ?>, de la société Dupont,<?php endif; ?> vous a envoyé le message suivant :
          </p>
          <p>
            <?php echo e($comment); ?>

          </p>
        </div>
      </div>
    </div>
  </body>
</html>
