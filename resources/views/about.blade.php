@extends('layout')
@section('content')
<main class="row end-xs about">
  <div class="col-xs-6 col-custom panel panel--active">
    <h2 class="row panel__title">
      Une équipe pluridisciplinaire
    </h2>
    <div class="row panel__slogan">
      À votre écoute pour vous conseiller et vous accompagner dans différents secteurs
    </div>
    <div class="row arguments">
      <ul class="arguments__list">
        <li class="arguments__item">Conseil</li>
        <li class="arguments__item">Comptabilité</li>
        <li class="arguments__item">Social</li>
        <li class="arguments__item">Fiscalité</li>
        <li class="arguments__item">Création d'entreprise</li>
        <li class="arguments__item">Audit</li>
      </ul>
    </div>
    <div class="row center-xs panel__arrow">
      @include('about.mouse')
    </div>
  </div>
  <div class="about__cover" style="background-image: url('/images/cover-about.jpg')"></div>
  <div class="about__responsive">
  </div>
  <div class="about__line"></div>
</main>
@stop
