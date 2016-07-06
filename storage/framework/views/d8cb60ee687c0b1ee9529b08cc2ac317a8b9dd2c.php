<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>Cabinet Schmidt - <?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta name="author" content="Cabinet Schmidt">

    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/tools.css">
    <link rel="stylesheet" href="/css/app.css" media="screen">
  </head>
  <body>
    <?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('layout.popup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php /* <?php if ( ! (isset($remove_footer))): ?> */ ?>
      <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php /* <?php endif; ?> */ ?>
    <?php echo $__env->make('layout.toolbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>    
    <script type="text/javascript" src="/js/Classes.js"></script>
    <?php if(isset($check)): ?>
        <script type="text/javascript" src="/js/map.js"></script>
        <script type="text/javascript" async src="https://maps.google.com/maps/api/js?v3.exp&key=AIzaSyCXezNBO39ejsNwTN-4Lxj-d-gzh866rLY&callback=initMaps"></script>
    <?php endif; ?>
    <script type="text/javascript" src="/js/script.js"></script>
  </body>
</html>
