<div class="col-xs-12 home__actus">
  <div class="row">
    <header class="col-xs-12 actus-header">
      <h2 class="actus-header__title">Les dernières actualités</h2>
      <h3 class="actus-header__label">Accéder à toute <a href="#">L'actu</a></h3>
    </header>
    <div class="col-xs-12 actus-articles">
      <div class="row center-lg">
        <section class="col-custom col-md-5 col-sm-5 col-xs-12 actus-articles__cabinet">
          <h3 class="actus-articles__header">L'actualité du cabinet</h3>
          {{-- {{dd($data['articles'])}} --}}
          @foreach ($data['articles'] as $article)
            <article class="row center-lg middle-xs article">
                <div class="article__wrapper"> <!-- wrapper is here to center content into the defined height box without stretch elements on sides and middle. -->
                  <h4 class="article__name">{{$article->title}}</h4>
                  <p class="article__body">
                    {{$article->content}}
                  </p>
                  <span class="article__date">Publié le {{$article->created_at}}</span>
                </div>
            </article>
          @endforeach
        </section>
        <section class="col-custom col-md-7 col-sm-7 col-xs-12 actus-articles__entreprises">
          <h3 class="actus-articles__header">L'actualité des TPE-PME</h3>
          <article class="row article">
            <div class="col-xs article__picture" style="background-image: url('http://www.cineshow.fr/wp-content/uploads/2015/10/Arrow-header.jpg')"></div>
            <div class="col-xs article__content">
              <div class="row article__wrapper">
                <h4 class="article__name">Le cabinet Schmidt ferme cet été</h4>
                <p class="article__body">
                  Fermeture des portes le 10 août,nous vous retrouvons le lundi 25 août.Bonnes vacances !
                </p>
              </div>
              <div class="article__footer">
                <span class="date">Publié le 25/03/2016</span>
                <a href="#" class="button"><span >Lire +</span></a>
              </div>
            </div>
          </article>
          <article class="row article">
            <div class="col-xs article__picture" style="background-image: url('http://www.cineshow.fr/wp-content/uploads/2015/10/Arrow-header.jpg')"></div>
            <div class="col-xs article__content">
              <div class="row article__wrapper">
                <h4 class="article__name">Le cabinet Schmidt ferme cet été</h4>
                <p class="article__body">
                  Fermeture des portes le 10 août,nous vous retrouvons le lundi 25 août.Bonnes vacances !
                </p>
              </div>
              <div class="article__footer">
                <span class="date">Publié le 25/03/2016</span>
                <a href="#" class="button"><span >Lire +</span></a>
              </div>
            </div>
          </article>
        </section>
      </div>
    </div>
  </div>
</div>
