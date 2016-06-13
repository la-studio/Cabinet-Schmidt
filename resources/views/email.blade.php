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
          @include('layout.logo')
        </div>
      </header>
      <div class="row center-xs email__content">
        <div class="col-xs-9">
          <p class="sb">
            Bonjour, {{$identity}} (<a href="mailto:{{$email}}">{{$email}}</a>)@if($company!==""), de la société Dupont,@endif vous a envoyé le message suivant :
          </p>
          <p>
            {{$comment}}
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
