@extends('layout')

@section('title')
Ils nous font confiance
@stop

@section('description')
Les témoignagnes des clients du Cabinet Schmidt : les TPE et PME de la vallée du Grésivaudan qui nous font confiance.
@stop

@section('content')
  <div class="row center-xs actualites">
    <div class="col-xs-12 temoignages__cover"></div>
    <div class="col-xs-12 actualites__banner">
      <h1>Les témoignages du Cabinet Schmidt</h1>
    </div>
    <div class="col-md-10 col-xs-12 gallery" id="gallery">
      <header class="row center-xs gallery__head">
        <h2>Ils nous font confiance</h2>
      </header>
      <section class="row center-xs gallery__list">
        @foreach ($temoignages as $temoignage)
          <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper">
            <div class="gallery__item">
              @if (!empty($temoignage->photo))
                <a href="/temoignage/{{$temoignage->slug}}" class="row image" style="background: url('{{$temoignage->photo}}') no-repeat center; background-size: 100%; background-position: top"></a>
              @endif
              <div class="row article">
                <div class="col-xs-12">
                  <h3 class="row article__title" style="margin-bottom: 5px"><a href="/temoignage/{{$temoignage->slug}}">{{$temoignage->person_identity}}</a></h3>
                    <h4 class="row article__title"><a>{{$temoignage->person_job}}</a></h3>
                  <p class="row article__body">
                    @if(strlen($temoignage->description)>140)
                      {{substr($temoignage->description,0,139).'...'}}
                    @else
                      {{$temoignage->description}}
                    @endif
                  </p>
                </div>
                <div class="col-xs-12 article__footer">
                    <span></span>
                    <a href="/temoignage/{{$temoignage->slug}}" class="article__button"><span >Lire +</span></a>
                </div>
              </div>
            </div>
          </article>
        @endforeach
      </section>
    </div>
  </div>
@stop
