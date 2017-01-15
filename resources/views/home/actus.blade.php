@unless($articles->isEmpty() && $echosarticles->isEmpty())
<div class="col-xs-12 home__actus">
  <div class="row">
    <header class="col-xs-12 actus-header">
      <h1 class="actus-header__title">L’actualité de votre cabinet d’expertise comptable</h1>
    </header>
    <div class="col-xs-12 actus-articles">
      <div class="row center-lg">
        @if(!$articles->isEmpty())
        <section class="col-custom col-md-6 col-sm-6 col-xs-12 actus-articles__entreprises">
          <h2 class="actus-articles__header"><a href="/actualites-cabinet">Toute l'actualité du cabinet</a></h2>
          @foreach ($articles as $article)
            <article class="row article">
                @if(isset($article->image))
                <a href="/actualites-cabinet/{{$article->slug}}" class="col-xs article__picture" style="background-image: url('{{$article->image}}')"></a>
                <div class="col-xs article__content">
                  <div class="row article__wrapper"> <!-- wrapper is here to center content into the defined height box without stretch elements on sides and middle. -->
                    <h4 class="article__name">{{$article->title}}</h4>
                    <p class="article__body">
                      {{$article->description}}
                    </p>
                  </div>
                  <div class="article__footer">
                      <span class="date">{{$article->created_at}}</span>
                      @if(strlen($article->content)>0)
                      <a href="/actualites-cabinet/{{$article->slug}}" class="button"><span >Lire +</span></a>
                      @endif
                  </div>
                </div>
                @else
                    <div class="article__content withoutimage">

                      <h4 class="article__name">{{$article->title}}</h4>
                      <p class="article__body">
                          {{$article->description}}
                      </p>

                       <div class="article__footer">
                        <span class="date">{{$article->created_at}}</span>
                        @if(strlen($article->content)>0)
                        <a href="/actualites-cabinet/{{$article->slug}}" class="button"><span >Lire +</span></a>
                        @endif
                    </div>
                  </div>
              @endif
            </article>
          @endforeach
        </section>
        @endif
        @if(!$echosarticles->isEmpty())
        <section class="col-custom col-md-6 col-sm-6 col-xs-12 actus-articles__entreprises pr35">
          <h2 class="actus-articles__header"><a href="/actualites">Toute l'actualité des chefs d'entreprises</a></h2>
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
    <header class="col-xs-12 actus-header margintop">
      <h2 class="actus-header__label">Consultez également les <a href="/chiffres-utiles">chiffres utiles</a> aux entrepreneurs</h2> 
      <br>
      <h2 class="actus-header__label">Et trouvez réponse à vos questions comptables, fiscales, sociales... dans <a href="/faq">la FAQ</a> !</h2>
    </header>
  </div>
</div>
@endunless
