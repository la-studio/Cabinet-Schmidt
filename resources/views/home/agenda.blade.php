<div class="col-xs-12 home__agenda" id="agenda">
  <div class="row center-xs">
    <header class="col-xs-12 agenda-header">
      <h2 class="agenda-header__title">L'agenda de la compta</h2>
      <h3 class="agenda-header__label">Pour connaître les échéanciers</h3>
    </header>
    <div class="col-md-5 col-xs-12 agenda-datepicker">
      <div class="row end-xs">
        <div class="datepicker">
          <div class="datepicker__caption">
            <div class="date">
              <span class="date__day"></span>
              <span class="date__number"></span>
              <span class="date__month"></span>
            </div>
          </div>
          <div class="datepicker__body">
            <div class="month">
              <div class="month__prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
              </div>
              <div class="month__text">
                <span>Mai</span>
                <span>2016</span>
              </div>
              <div class="month__next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
              </div>
            </div>
            <div class="calendar-list">

            </div>
          </div>
        </div>
      </div>
    </div> {{-- end col-xs-5 datepicker --}}
    <div class="col-md-7 col-xs-10 agenda-text">
        <div class="agenda-text__carousel">
          <div class="agenda-text__wrapper">
            <h3 class="agenda-text__date">{{$appointment->date}}</h3>
            <div class="agenda-text__content">{{$appointment->content}}</div>
          </div>
        </div>
        <div data-hover="Prochaine date" class="agenda-text__button">
          <span>Prochaine date</span>
        </div>
    </div>
  </div>
</div>
