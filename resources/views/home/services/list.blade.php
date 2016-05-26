<section id="tes" class="col-md-10 col-custom col-xs-12 services__list">
  <div class="row around-lg between-md center-xs">
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name">{{$competences[0]->title}}</h3>
            <div class="service__icon">
              @include('home.services.icons.bulles')
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan">{{$competences[0]->label}}</p>
        <p class="col-xs-12 service__description">{{$competences[0]->description}}</p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name">{{$competences[1]->title}}</h3>
            <div class="service__icon">
              @include('home.services.icons.ordinateur')
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan">{{$competences[1]->label}}</p>
        <p class="col-xs-12 service__description">{{$competences[1]->description}}</p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name">{{$competences[2]->title}}</h3>
            <div class="service__icon">
              @include('home.services.icons.fichier')
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan">{{$competences[2]->label}}</p>
        <p class="col-xs-12 service__description">{{$competences[2]->description}}</p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name">{{$competences[3]->title}}</h3>
            <div class="service__icon">
              @include('home.services.icons.calculatrice')
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan">{{$competences[3]->label}}</p>
        <p class="col-xs-12 service__description">{{$competences[3]->description}}</p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name">{{$competences[4]->title}}</h3>
            <div class="service__icon">
              @include('home.services.icons.silhouette')
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan">{{$competences[4]->label}}</p>
        <p class="col-xs-12 service__description">{{$competences[4]->description}}</p>
      </div>
    </article>
    <article class="col-md-6 col-sm-6 col-xs-12 col-custom service">
      <div class="row wrapper">
        <div class="col-xs-12 service-head">
          <div class="row middle-xs between-xs">
            <h3 class="service__name">{{$competences[5]->title}}</h3>
            <div class="service__icon">
              @include('home.services.icons.loupe')
            </div>
          </div>
        </div>
        <p class="col-xs-12 service__slogan">{{$competences[5]->label}}</p>
        <p class="col-xs-12 service__description">{{$competences[5]->description}}</p>
      </div>
    </article>
  </div>
</section>
