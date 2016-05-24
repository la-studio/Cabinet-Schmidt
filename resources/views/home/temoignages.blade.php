<div class="col-xs-12 home__temoignages">
  <div class="row center-xs">
    <header class="col-xs-12 temoignages-header">
      <h2 class="temoignages-header__title">Ils nous font confiance</h2>
    </header>
    <div id="slider-temoignage" class="col-xs-12 slider">
      <div class="swiper-wrapper">
        @foreach ($temoignages as $temoignage)
          <div class="swiper-slide temoignage">
            <div class="row center-xs">
              <div class="col-sm-8 col-xs">
                <div class="row center-xs temoignage__photo">
                  <img src="{{$temoignage->logo}}" alt title="" />
                </div>
                <div class="row center-xs temoignage__body">
                  <p>{{$temoignage->content}}</p>
                </div>
                <div class="row center-xs temoignage__identity">
                  <div class="col-xs">
                    <h3 class="row center-xs">{{$temoignage->person_identity}}</h3>
                    <h4 class="row center-xs">{{$temoignage->person_job}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
