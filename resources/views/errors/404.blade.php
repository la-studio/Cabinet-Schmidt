@extends('layout')
@section('title')
Page d'erreur
@stop
@section('robots')
<meta name="robots" content="noindex">
@stop
@section('content')
  <div class="row center-xs middle-xs not-found">
    <div class="not-found__image">
      @include('errors.picto')
    </div>
    <div class="not-found__body">
      <h2>Oups !</h2>
      <h3>Nous n'avons pas trouvé la page que vous recherchez.</h3>
      <span><a href="{{URL::to('/')}}">Retour à l'accueil</a></span>
    </div>
  </div>
@stop
