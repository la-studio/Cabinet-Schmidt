@extends('layout')

@section('title')
Témoignage de {{$temoignage->person_identity}}, {{$temoignage->person_job}}
@stop

@section('description')
{{$temoignage->description}}
@stop

@section('content')
  <div class="row center-xs echo-article">
    <div class="col-xs-9">
      <header>
        <p class="previousPage"><a href="/">Retour à la page d'accueil</a></p>
        <h1 class="echo-article__title">Témoignage de {{$temoignage->person_identity}}, {{$temoignage->person_job}}</h1>
      </header>
      <h2 class="echo-article__summary">
        {{$temoignage->description}}
      </h2>
      <div class="article__content">
        {!!$temoignage->content!!}
      </div>
    </div>
  </div>
@stop
