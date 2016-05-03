Agenda = function () {
  this.selector = null;
  this.number = null;
  this.translate = null;
  this.width = null;
  this.active = null;
  this.dates = [];
  this.init();
}

Agenda.prototype.init = function () {
  this.selector = '.agenda-text';
  this.number = $(this.selector).data('appointements');
  this.translate = 0;
  this.width = $(this.selector).width();
  this.active = 0;
  this.sizing();
  this.clickListener();
  this.resizeListener();
  this.dates = this.getDates();
};

Agenda.prototype.sizing = function () {
  $('.agenda-text__carousel').width(this.width * this.number);
  $('.agenda-text__item').css({
    'width': $('.agenda-text__carousel').width() / this.number,
    'flex-basis': this.width
  })
  console.log('resized');
};

Agenda.prototype.getNext = function () {
  if(this.active<this.number-1) {
    this.active++;
    this.setTranslate();
    $('.agenda-text__carousel').css('transform','translate3d(-'+this.translate+'px,0,0)');
  }
  console.log(this.translate);
};

Agenda.prototype.setTranslate = function () {
  var value = this.active* this.width;
  this.translate = value;
};

Agenda.prototype.getDates = function () {
  var listDates = [];
  $('.agenda-text__date').each(function () {
    var number = $(this).html().split(' ')[0];
    var month =  $(this).html().split(' ')[1];
    var year =  $(this).html().split(' ')[2];
    listDates.push({day: number, month: month, year: year});
  })
  return listDates;
};

Agenda.prototype.clickListener = function () {
  var that = this;
  $('.agenda-text__button').click(function () {
    that.getNext()
  })
};

Agenda.prototype.resizeListener = function () {
  var that = this;
  $(window).on('resize', function () {
    that.sizing()
  })
};
comptaAgenda = new Agenda();
