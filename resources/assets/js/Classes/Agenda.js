Agenda = function () {
  this.selector = null;
  this.active = null;
  this.year = null;
  this.parsedDates = [];
  this.monthList = [];
  this.datepicker = null;
  this.init();
}

Agenda.prototype.init = function () {
  var that = this;
  this.selector = '.agenda-text';
  this.translate = 0;
  setTimeout(function () {
    that.datepicker = hillsDatepicker;
  }, 50);
  this.year = new Date().getFullYear();
  this.monthList = ['Décembre','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre'];
  this.clickListener();
  this.parseResumes();
  this.getDatas();
  this.initActive();
};

Agenda.prototype.getNext = function () {
  if(this.active<this.dates.length) {
      this.active++;
      var that = this;
      $('.agenda-text__wrapper').fadeOut().fadeIn();
      setTimeout(function () {
        $('.agenda-text__date').text(that.dates[that.active]);
        $('.agenda-text__content').text(that.listContent[that.active]);
        var parsed = $.parseHTML($('.agenda-text__content').text());
        $('.agenda-text__content').html(parsed);
      }, 400);// 400 is default transition time of fadeout.
      if(this.active>1) {
        var lastActiveMonth = this.dates[this.active-1].split(' ')[1]; // the second word contains the month.
        var currMonth = this.dates[this.active].split(' ')[1];// the second word contains the month.
        if(lastActiveMonth!==currMonth) { // FIXME
          var month = this.datepicker.getMonthIndex(currMonth);
          this.datepicker.getNext();
          // this.datepicker.getCalendarMonth(month);
        }
      }
  }
};

Agenda.prototype.getIndex = function (index) {
  this.active = index;
  var that = this;
  $('.agenda-text__wrapper').fadeOut().fadeIn();
  setTimeout(function () {
    $('.agenda-text__date').text(that.dates[that.active]);
    $('.agenda-text__content').text(that.listContent[that.active]);
    var parsed = $.parseHTML($('.agenda-text__content').text());
    $('.agenda-text__content').html(parsed);
  }, 400);// 400 is default transition time of fadeout.
};

Agenda.prototype.getMonth = function (index) {
    if(this.month<12) {
        return this.monthList[index]; // return current month as String (e.g: Juin)
    } else {
        // For december
        return this.monthList[0];
    }
};

Agenda.prototype.initActive = function () {
  var val = $('.agenda-text__date').text();
  var that = this;
  setTimeout(function() {
      that.active = that.dates.indexOf(val);
  }, 10);
};

Agenda.prototype.getDatas = function () {
  var listDates = [];
  var listFullDates = [];
  var listContent =  [];
  $.getJSON('/collection/exceptions/appointments')
  .done(function (data) {
    for (var i = 0; i < data.length; i++) {
      var dates = data[i].date.split(' ');
      var day = dates[0];
      var month = dates[1];
      listFullDates.push(data[i].date);
      listContent.push(data[i].content);
      listDates.push({day: day ,month: month });
    }
  })
  this.listContent = listContent;
  this.parsedDates = listDates;
  this.dates = listFullDates;
};

Agenda.prototype.clickListener = function () {
  var that = this;
  $('.agenda-text__button').click(function () {
    that.getNext()
  });
};

Agenda.prototype.parseResumes = function () {
  $('.agenda-text__content').each(function () {
    var parsedAgenda = $.parseHTML($(this).text());
    $(this).html(parsedAgenda);
  })
};

comptaAgenda = new Agenda();
