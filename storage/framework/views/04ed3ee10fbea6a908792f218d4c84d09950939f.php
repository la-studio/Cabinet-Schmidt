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
    <title>Cabinet Schmidt - Dashboard</title>
  </head>
  <body>
    <div class="row admin">
      <div class="col-custom admin-menu">
        <div class="row admin-menu__logo">
          <a href="<?php echo e(URL::to('/admin/dashboard')); ?>"><?php echo $__env->make('admin.dashboard-logo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></a>
        </div>
        <nav class="row admin-menu__nav">
          <ul class="col-xs admin-menu__list">
            <li class="row admin-menu__item"><a href="<?php echo e(URL::to('/admin/articles')); ?>">Articles</a></li>
            <li class="row admin-menu__item"><a href="<?php echo e(URL::to('/admin/temoignages')); ?>">Témoignages</a></li>
            <li class="row admin-menu__item"><a href="<?php echo e(URL::to('/admin/partenaires')); ?>">Partenaires</a></li>
            <li class="row admin-menu__item"><a href="<?php echo e(URL::to('/admin/slider')); ?>">Slider</a></li>
            <li class="row admin-menu__item"><a href="<?php echo e(URL::to('/admin/competences')); ?>">Compétences</a></li>
            <li class="row admin-menu__item"><a href="<?php echo e(URL::to('/admin/storytelling')); ?>">Storytelling</a></li>
            <li class="row admin-menu__item"><a href="<?php echo e(URL::to('/admin/register')); ?>">Créer un compte</a></li>     

            <?php /* Let disconnect as last-child. */ ?>
            <li class="row admin-menu__item"><i class="fa fa-power-off"></i><a href="<?php echo e(URL::to('/logout')); ?>">Déconnexion</a></li>
          </ul>
        </nav>
      </div>
      <div class="col-xs admin-content">
        <?php echo $__env->yieldContent('content'); ?> <?php /* the 1st child of admin-content has to have a row class. */ ?>
      </div>
    </div>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script src="/js/admin-script.js"></script>
  </body>
</html>
