@unless($articles->isEmpty() && $echosarticles->isEmpty())
<div class="col-xs-12 home__actus">
  <div class="row">
    <header class="col-xs-12 actus-header">
      <h1 class="actus-header__title">L’actualité de votre cabinet d’expertise comptable</h1>
      <h2 class="actus-header__label">Découvrez <a href="/actualites">plus d'actualités</a></h2>
    </header>
    <div class="col-xs-12 actus-articles">
      <div class="row center-lg">
        @if(!$articles->isEmpty())
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
        @endif
        @if(!$echosarticles->isEmpty())
        <section class="col-custom col-md-7 col-sm-7 col-xs-12 actus-articles__entreprises">
          <h3 class="actus-articles__header">L'actualité des TPE-PME</h3>
           @foreach($echosarticles as $echosarticle)
            <article class="row article">
              <a href="/actualites/{{$echosarticle->slug}}" class="col-xs article__picture" style="background-image: url('{{$echosarticle->image}}')"></a>
              <div class="col-xs article__content">
                <div class="row article__wrapper">
                  <h4 class="article__name @if($is_large)article__name--small"@endif><a href="/actualites/{{$echosarticle->slug}}">{{$echosarticle->title}}</a></h4>
                  <p class="article__body">
                    @if(strlen($echosarticle->summary)>200)
                      {{substr($echosarticle->summary,0,200).'...'}}
                    @else
                      {{$echosarticle->summary}}
                    @endif
                  </p>
                </div>
                <div class="article__footer">
                  <span class="date">{{$echosarticle->date}}</span>
                  <a href="/actualites/{{$echosarticle->slug}}" class="button"><span >Lire +</span></a>
                </div>
              </div>
            </article>
           @endforeach
        </section>
        @endif
      </div>
    </div>
  </div>
</div>
@endunless
