@extends('layout')
@section('content')
<div class="row center-xs chiffres">
  <div class="col-xs-12 chiffres__cover"></div>
  <div class="col-xs-12 chiffres__banner">
    <h1>Chiffres utiles</h1>
  </div>
  <div class="col-md-10 col-xs-12 gallery">
    <ul class="row center-xs filters">
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item filters__item--checked" data-filter="all"><span>tous</span></li>
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item" data-filter="Social"><span>Social</span></li>
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item" data-filter="Fiscal"><span>Fiscal</span></li>
      <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 filters__item" data-filter="Juridique"><span>juridique</span></li>
    </ul>
    <section class="row center-xs gallery__list">
      @foreach($digitarticles as $article)
      <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper {{$article->rubrique}}">
        <div class="gallery__item">
          <a href="/chiffres-utiles/{{$article->slug}}" class="row image" style="background-image: url('{{$article->image}}')"></a>
          <div class="row article">
            <div class="col-xs-12">
              <h3 class="row article__title"><a href="/chiffres-utiles/{{$article->slug}}">{{$article->title}}</a></h3>
              <p class="row article__body">
                @if(strlen($article->summary)>200)
                  {{substr($article->summary,0,200).'...'}}
                @else
                  {{$article->summary}}
                @endif
              </p>
            </div>
            <div class="col-xs-12 article__footer">
                <span class="article__date">{{$article->date}}</span>
                <a href="/chiffres-utiles/{{$article->slug}}" class="article__button">Lire +</a>
            </div>
          </div>
        </div>
      </article>
      @endforeach
    </section>
  </div>
</div>
@stop
