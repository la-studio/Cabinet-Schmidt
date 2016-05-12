@extends('layout')
@section('content')
<main class="row end-xs about">
  <div class="col-xs-6 col-custom panel panel--active">
    <div class="row wrapper">
      <div class="col-xs sub-wrapper">
        <h2 class="row panel__title"></h2>
        <div class="row panel__slogan"></div>
        <div class="row arguments">
          <ul class="arguments__list"></ul>
        </div>
        <div class="row center-xs panel__mouse">
          @include('about.mouse')
        </div>
      </div> {{-- end col-xs l.6 --}}
    </div>
    <div class="row panel__nav">
      <div class="col-xs item">
        <div class="row wrapper">

        </div>
      </div>
      <div class="col-xs item">
        <div class="row wrapper">

        </div>
      </div>
      <div class="col-xs item">
        <div class="row wrapper">

        </div>
      </div>
      <div class="col-xs item">
        <div class="row wrapper">

        </div>
      </div>
    </div>
  </div>
  <div class="about__cover" style="background-image: url('/images/cover-about.jpg')"></div>
  <div class="about__responsive">
  </div>
</main>
@stop
