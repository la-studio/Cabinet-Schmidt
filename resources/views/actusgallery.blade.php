@extends('layout')
@section('content')
  <div class="row center-xs actualites">
    <div class="col-xs-12 actualites__cover"></div>
    <div class="col-xs-12 actualites__banner">
      <h1>L'actualité que nous vous partageons</h1>
    </div>
    <div class="col-md-10 col-xs-12 gallery">
      <header class="row center-xs gallery__head">
        <h2>Toute l'actualité des tpe & pme</h2>
      </header>
      <ul class="row center-xs filters">
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item filters__item--checked" data-filter="all"><span>tous</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Social"><span>Social</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Fiscal"><span>Fiscal</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Innovation Multimédia Création"><span>innovation</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Gestion Patrimoine"><span>gestion</span></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item" data-filter="Juridique"><span>juridique</span></li>
      </ul>
      <section class="row center-xs gallery__list">
        @foreach ($echosarticles as $article)
        <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper {{$article->rubrique}}">
          <div class="gallery__item">
            <a href="/actualites/{{$article->slug}}" class="row image" style="background-image: url('{{$article->image}}')"></a>
            <div class="row article">
              <div class="col-xs-12">
                <h3 class="row article__title"><a href="/actualites/{{$article->slug}}">{{$article->title}}</a></h3>
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
                  <a href="/actualites/{{$article->slug}}" class="article__button"><span >Lire +</span></a>
              </div>
            </div>
          </div>
        </article>
        @endforeach
      </section>
      <div class="row middle-xs center-xs gallery__pagination">
        @if ($echosarticles->lastPage() > 1)
          <ul class="pagination">
              <li class="{{ ($echosarticles->currentPage() == 1) ? ' disabled' : '' }}">
                  <a href="{{ $echosarticles->previousPageUrl() }}" rel="prev"><i class="material-icons">chevron_left</i></a>
               </li>
              @for ($i = 1; $i <= $echosarticles->lastPage(); $i++)
                  <?php
                  $half_total_links = floor(7 / 2);
                  $from = $echosarticles->currentPage() - $half_total_links;
                  $to = $echosarticles->currentPage() + $half_total_links;
                  if ($echosarticles->currentPage() < $half_total_links) {
                     $to += $half_total_links - $echosarticles->currentPage();
                  }
                  if ($echosarticles->lastPage() - $echosarticles->currentPage() < $half_total_links) {
                      $from -= $half_total_links - ($echosarticles->lastPage() - $echosarticles->currentPage()) - 1;
                  }
                  ?>
                  @if ($from < $i && $i < $to)
                      <li class="{{ ($echosarticles->currentPage() == $i) ? ' active' : '' }}">
                        @if($echosarticles->currentPage() == $i)
                          {{ $i }}
                        @else
                          <a href="{{ $echosarticles->url($i) }}">{{ $i }}</a>
                        @endif
                      </li>
                  @endif
              @endfor
              <li class="{{ ($echosarticles->currentPage() == $echosarticles->lastPage()) ? ' disabled' : '' }}">
                  <a href="{{ $echosarticles->nextPageUrl() }}" rel="next"><i class="material-icons">chevron_right</i></a>
              </li>
          </ul>
      @endif
      </div>
    </div>
  </div>
@stop
