<div class="col-xs-12 home__slider">
  <div class="row">
    <div class="col-xs swiper">
        <div class="swiper-wrapper">
          @foreach ($slider as $slide)
            <div class="swiper-slide" style="background-image: url('{{$slide->cover}}')">
              <div class="slider-caption">
                <h2 class="slider-caption__title">{{$slide->title}}</h2>
                <div class="slider-body">
                  <p class="slider-body__text">{{$slide->description}}</p>
                  @if($slide->button_link!=='' && $slide->button_link!==null)
                  <a href="{{$slide->button_link}}" class="slider-body__button">
                    <span>{{$slide->button_name}}</span>
                  </a>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="swiper-button-prev">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
        <div class="swiper-button-next">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
    </div>
  </div>
</div>
