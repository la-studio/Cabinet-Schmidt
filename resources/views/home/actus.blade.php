<div class="col-xs-12 home__actus">
  <div class="row">
    <header class="col-xs-12 actus-header">
      <h2 class="actus-header__title">Les dernières actualités</h2>
      @if($page == 'home')
        <h3 class="actus-header__label">Accéder à toute <a href="/actualites">l'actu</a></h3>
      @else
        <h3 class="actus-header__label">Accéder à toute l'actu</h3>
      @endif
    </header>
    <div class="col-xs-12 actus-articles">
      <div class="row center-lg">
        <section class="col-custom col-md-5 col-sm-5 col-xs-12 actus-articles__cabinet">
          <h3 class="actus-articles__header">L'actualité du cabinet</h3>
          @foreach ($articles as $article)
            <article class="row middle-xs article">
                <div class="article__wrapper"> <!-- wrapper is here to center content into the defined height box without stretch elements on sides and middle. -->
                  <h4 class="article__name">{{$article->title}}</h4>
                  <p class="article__body">
                    {{$article->content}}
                  </p>
                  <span class="article__date">{{$article->created_at}}</span>
                </div>
            </article>
          @endforeach
        </section>
        <section class="col-custom col-md-7 col-sm-7 col-xs-12 actus-articles__entreprises">
          <h3 class="actus-articles__header">L'actualité des TPE-PME</h3>
           @for ($i = 0; $i < 2; $i++)
            <article class="row article">
              <a href="/actualites/{{$echosarticles[$i]->slug}}" class="col-xs article__picture" style="background-image: url('{{$echosarticles[$i]->image}}')"></a>
              <div class="col-xs article__content">
                <div class="row article__wrapper">
                  <h4 class="article__name @if($is_large)article__name--small"@endif><a href="/actualites/{{$echosarticles[$i]->slug}}">{{$echosarticles[$i]->title}}</a></h4>
                  <p class="article__body">
                    @if(strlen($echosarticles[$i]->summary)>200)
                      {{substr($echosarticles[$i]->summary,0,200).'...'}}
                    @else
                      {{$echosarticles[$i]->summary}}
                    @endif
                  </p>
                </div>
                <div class="article__footer">
                  <span class="date">{{$echosarticles[$i]->date}}</span>
                  <a href="/actualites/{{$echosarticles[$i]->slug}}" class="button"><span >Lire +</span></a>
                </div>
              </div>
            </article>
           @endfor
        </section>
      </div>
    </div>
  </div>
</div>
