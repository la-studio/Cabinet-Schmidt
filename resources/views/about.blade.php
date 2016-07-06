@extends('layout')

@section('title')
A propos de l'entreprise et l'équipe
@stop

@section('description')
Notre équipe à taille humaine accompagne et conseille les TPE et artisans du Grésivaudan sur la plan comptable, fiscal, social…
@stop

@section('content')
<main class="row end-xs about">
  <div class="col-xs-6 col-custom panel panel--active">
    <div class="row wrapper">
      <div class="col-xs sub-wrapper">
        <h1 class="row panel__title"></h1>
        <div class="row panel__slogan"></div>
        <div class="row arguments">
          <ul class="arguments__list"></ul>
        </div>
        <div class="row center-xs panel__mouse">
          @include('about.icons.mouse')
        </div>
      </div> {{-- end col-xs l.6 --}}
    </div>
    <div class="row panel__nav panel__nav--show">
      <div data-index="1" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          @include('about.icons.team')
        </div>
      </div>
      <div data-index="2" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          @include('about.icons.worker')
        </div>
      </div>
      <div data-index="3" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          @include('about.icons.map')
        </div>
      </div>
      <div data-index="4" class="col-xs-3 item">
        <div class="row center-xs middle-xs wrapper">
          @include('about.icons.head')
        </div>
      </div>
    </div>
  </div>
  <div class="about__cover" style="background-image: url('/images/cover-about.jpg')"></div>
  {{-- <div class="about__responsive">
  </div> --}}
</main>
<div class="mouse-template">
  @include('about.icons.mouse')
</div>
  @include('about.nav-template') {{-- nav-template way too long. --}}
@stop
