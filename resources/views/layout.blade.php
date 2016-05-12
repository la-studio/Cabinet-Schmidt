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
    <link rel="stylesheet" type="text/css" href="js/Swiper-master/dist/css/swiper.min.css">
    <link rel="stylesheet" href="/css/app.css" media="screen">
    <title>Cabinet Schmidt</title>
  </head>
  <body>
    @include('layout.header')
    @yield('content')
    @unless(isset($remove_footer))
    @include('layout.footer')
    @endunless
    @include('layout.toolbox')
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/Swiper-master/dist/js/swiper.min.js"></script>
    <script type="text/javascript" src="/js/Classes/Slider.js"></script>
    <script type="text/javascript" src="/js/Classes/Debugger.js"></script>
    <script type="text/javascript" src="/js/Classes/Agenda.js" ></script>
    <script type="text/javascript" src="/js/Classes/Toolbox.js"></script>
    <script type="text/javascript" src="/js/Classes/Datepicker.js"></script>
    <script type="text/javascript" src="/js/Classes/About.js"></script>
    <script type="text/javascript" src="/js/Classes/MouseAnimation.js"></script>
    @if (isset($check))
    <script type="text/javascript" src="/js/initMap.js"></script>
    <script type="text/javascript" async src="http://maps.google.com/maps/api/js?v3.exp&key=AIzaSyDaqvAJy_P9DqqR8ClhZJG0L5ldEOiEYDs&callback=initMaps"></script>
    @endif
    <script type="text/javascript" src="/js/mixitup.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
  </body>
</html>
