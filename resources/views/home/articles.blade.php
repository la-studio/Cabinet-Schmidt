@extends('layout')

@section('title')
L’actualité du Cabinet Schmidt
@stop

@section('description')
Suivez l’actualité de votre cabinet comptable et de la région grenobloise !
@stop

@section('content')
  <div class="row center-xs actualites">
    <div class="col-xs-12 actualites__cover"></div>
    <div class="col-xs-12 actualites__banner">
      <h1>L’actualité du cabinet</h1>
    </div>
    <div class="col-md-10 col-xs-12 gallery" id="gallery">
      <header class="row center-xs gallery__head">
        <h2>Toute l'actualité du Cabinet Schmidt</h2>
      </header>
      <section class="row center-xs gallery__list">
          @foreach ($articles as $article)
          <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper">
            <div class="gallery__item">
              @if(isset($article->image))
              <a href="/actualites-cabinet/{{$article->slug}}" class="row image imgctrd" style="background-image: url('{{$article->image}}')">
              </a>
              @endif
              @if(!isset($article->image))
              <div class="row article maxheight">
              @else
              <div class="row article">
              @endif
                <div class="col-xs-12">
                  <h3 class="row article__title"><a href="/actualites-cabinet/{{$article->slug}}">{{$article->title}}</a></h3>
                  <p class="row article__body">
                    {{$article->description}}
                  </p>
                </div>
                <div class="col-xs-12 article__footer">
                    <span class="article__date">{{$article->created_at}}</span>
                    @if(strlen($article->content)>0)
                      <a href="/actualites-cabinet/{{$article->slug}}" class="article__button"><span >Lire +</span></a>
                    @endif
                </div>
              </div>
            </div>
          </article>
          @endforeach
        </section>
        <div class="row middle-xs center-xs gallery__pagination">
          @if ($articles->lastPage() > 1)
            <ul class="pagination">
                <li class="{{ ($articles->currentPage() == 1) ? ' disabled' : '' }}">
                    <a href="{{ $articles->previousPageUrl() }}#gallery" rel="prev"><i class="material-icons">chevron_left</i></a>
                 </li>
                @for ($i = 1; $i <= $articles->lastPage(); $i++)
                    <?php
                    $half_total_links = floor(7 / 2);
                    $from = $articles->currentPage() - $half_total_links;
                    $to = $articles->currentPage() + $half_total_links;
                    if ($articles->currentPage() < $half_total_links) {
                       $to += $half_total_links - $articles->currentPage();
                    }
                    if ($articles->lastPage() - $articles->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($articles->lastPage() - $articles->currentPage()) - 1;
                    }
                    ?>
                    @if ($from < $i && $i < $to)
                        <li class="{{ ($articles->currentPage() == $i) ? ' active' : '' }}">
                          @if($articles->currentPage() == $i)
                            {{ $i }}
                          @else
                            <a href="{{ $articles->url($i) }}#gallery">{{ $i }}</a>
                          @endif
                        </li>
                    @endif
                @endfor
                <li class="{{ ($articles->currentPage() == $articles->lastPage()) ? ' disabled' : '' }}">
                    <a href="{{ $articles->nextPageUrl() }}#gallery" rel="next"><i class="material-icons">chevron_right</i></a>
                </li>
            </ul>
          @endif
        </div>
    </div>
  </div>
@stop
