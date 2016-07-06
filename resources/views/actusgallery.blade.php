@extends('layout')

@section('title')
L’actualité des chefs d’entreprise
@stop

@section('description')
Suivez l’actualité de votre cabinet comptable : fiscal, juridique, social, gestion, innovation…
@stop

@section('content')
  <div class="row center-xs actualites">
    <div class="col-xs-12 actualites__cover"></div>
    <div class="col-xs-12 actualites__banner">
      <h1>L’actualité des chefs d’entreprise</h1>
    </div>
    <div class="col-md-10 col-xs-12 gallery" id="gallery">
      <header class="row center-xs gallery__head">
        <h2>Toute l'actualité des tpe &amp; pme</h2>
      </header>
      <ul class="row center-xs filters">
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item {{ ($page == 'actus') ? 'filters__item--checked' : '' }}" data-filter="all"><a href="{{ URL::to('actualites#gallery') }}"><span>Tous</span></a></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item {{ ($page == 'Social') ? 'filters__item--checked' : '' }}" data-filter="Social"><a href="{{ URL::to('actualites/rubrique/Social#gallery') }}"><span>Social</span></a></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item {{ ($page == 'Fiscal') ? 'filters__item--checked' : '' }}" data-filter="Fiscal"><a href="{{ URL::to('actualites/rubrique/Fiscal#gallery') }}"><span>Fiscal</span></a></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item {{ ($page == 'Innovation Multimédia Création') ? 'filters__item--checked' : '' }}" data-filter="Innovation Multimédia Création"><a href="{{ URL::to('actualites/rubrique/Innovation Multimédia Création#gallery') }}"><span>Innovation</span></a></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item {{ ($page == 'Gestion') ? 'filters__item--checked' : '' }}" data-filter="Gestion Patrimoine"><a href="{{ URL::to('actualites/rubrique/Gestion#gallery') }}"><span>Gestion</span></a></li>
        <li class="col-lg col-md col-sm-4 col-xs-6 filters__item {{ ($page == 'Juridique') ? 'filters__item--checked' : '' }}" data-filter="Juridique"><a href="{{ URL::to('actualites/rubrique/Juridique#gallery') }}"><span>Juridique</span></a></li>
      </ul>
      <section class="row center-xs gallery__list">
          @foreach ($echosarticles as $article)
          <article class="col-md-4 col-sm-6 col-xs-12 col-custom gallery__wrapper {{$article->rubrique}}">
            <div class="gallery__item">
              <a href="/actualites/{{$article->slug}}" class="row image" style="background-image: url('{{$article->image}}')">
                <span class="article__category {{$article->rubrique}}">{{$article->rubrique}}</span>
              </a>
              <div class="row article">
                <div class="col-xs-12">
                  <h3 class="row article__title"><a href="/actualites/{{$article->slug}}">{{$article->title}}</a></h3>
                  <p class="row article__body">
                    @if(strlen($article->summary)>140)
                      {{substr($article->summary,0,140).'...'}}
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
