About = function () {
  this.slides = [];
  this.active = null;
  this.transitionsProperty = null;
  this.imagesSuffixPath = null;
  this.el = null;
  this.init()
}

About.prototype.init = function () {
  this.imagesSuffixPath = '/images/';
  this.el = 'panel';
  this.lastSlide = new Date();
  var suffix = this.imagesSuffixPath;
  this.active = 1;

  //Methods executed at init.
  this.getDatasAndInitView();
  this.forceScroll();
  this.enableKeyboardListener();
  this.scrollListener();
  this.mouseListener();
  this.loadListener();
  this.preloadImages()
  var that = this;
  setTimeout(function () {
      that.clickListener();
  },50)
};

About.prototype.getDatasAndInitView = function () {
  var that = this;
  var list = [];
  $.getJSON('/a-propos/datas').done(function(data) {
    for (var i = 0; i < data.length; i++) {
      var obj = {};
      obj.list = [];
      obj.title = data[i].title;
      obj.conclusion = data[i].conclusion;
      obj.slogan = data[i].summary;
      obj.cover = data[i].cover;
      for (var n = 0; n < data[i].list_item.length; n++) {
        obj.list.push(data[i].list_item[n]);
      }
      list.push(obj)
    }
    // that.slides = list;
    that.slides = list;
    that.initFirstView();
  })
};

About.prototype.forceScroll = function () {
  var that = this;
  if($('.about').length>0) {
    setTimeout(function () {
      if(!that.isDown()) {
        $('html,body').animate({scrollTop: $('.header').height()}, 500);
      }
    },1600)
  }
};

About.prototype.scrollListener = function () {
  $(window).on('scroll',function () {
    if($(this).scrollTop()>=$('.header').height()) {
      $('.panel__mouse svg').addClass('show')
    }
  })
};

About.prototype.loadListener = function () {
  $(window).on('load',function () {
    if($(this).scrollTop()>=$('.header').height()) {
      $('.panel__mouse svg').addClass('show')
    }
  })
};

About.prototype.mouseListener = function() {
    var that = this;
    $(document).on('mousewheel DOMMouseScroll', function(ev) { // DOMMouseScroll ev too for shitty Firefox.
        if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
            if (ev.originalEvent.detail > 0) {
                //scroll down
                if (that.canSlide() && that.isDown()) { // ev.originalEvent.wheelDelta < 0 == Scroll down.
                    that.getNext();
                }
            }
        } else {
            ev.delta = null;
            if (ev.originalEvent) {
                if (ev.originalEvent.wheelDelta) {
                    ev.delta = ev.originalEvent.wheelDelta;
                    if (that.canSlide() && that.isDown() && ev.delta < 0) { // ev.originalEvent.wheelDelta < 0 == Scroll down.
                        that.getNext();
                    }
                } else if (ev.originalEvent.clientY && $(window).scrollTop() == $('.header').height() && ev.originalEvent.wheelDelta == undefined) {
                    if (that.canSlide() && that.isDown()) { // ev.originalEvent.wheelDelta < 0 == Scroll down.
                        that.getNext();
                    }
                }
            }
        }

    })
};

About.prototype.isDown = function () {
  var headerHeight = $('.header').height();
  if($(document).scrollTop()>=headerHeight) {
    return true
  } else {
    return false
  }
};

About.prototype.enableKeyboardListener = function () {
  var that = this;
  $(document).on('keydown',function (ev) {
    var key = ev.keyCode || ev.which;
    if (key==39 && that.canSlide()) { // right arrow
      that.getNext();
    }
  })
};

About.prototype.clickListener = function () {
  var that = this;
  $(document).on('click', '.panel__nav .item',function () {
    var index = $(this).data('index');
    if(!$(this).hasClass('current')) {
      if(index==1) {
        that.active = 0;
      } else {
        that.active = index-1;
      }
      setTimeout(function () { // Timeout to reach the next created DOM element, if i don't use this, the dom catched will be the dom destroyed.
        $('.panel__nav .item').eq(that.active-1).addClass('current');
      }, 1100);
     that.getNext()
    }
     // getNext will increment it.
  })
};

About.prototype.getNext = function () {
  var el = $('.'+this.el+'--active');
  var that = this;
  if(this.active>=0 && this.active<4) {
    this.active++;
    this.handleThisAndCall(el,that.active-1)
  } else if(this.active==4) {
    this.active = 1;
    this.handleThisAndCall(el,that.active-1)
  }
};

About.prototype.canSlide = function () {
  if(this.lastSlide) {
    if(new Date(this.lastSlide.getTime() + 2000) < new Date()) {
      this.lastSlide = new Date()
      return true
    } else {
      return false
    }
  } else {
    return true
  }
};

About.prototype.highlightCurrent = function (index) {
  $('.panel__nav .wrapper').removeClass('wrapper--active')
  $('.panel__nav .wrapper').eq(this.active-1).addClass('wrapper--active')
};

About.prototype.handleThisAndCall = function (el,index) {
  var that = this;
  el.addClass(this.el+'--extend');
  $('.'+this.el+'__slogan').css('visibility','hidden')
  $('.'+this.el+'__conclusion').css('visibility','hidden')
  $('.'+this.el+'.arguments__item').css('visibility','hidden')
  $('.'+this.el+'--extend *').fadeOut(150);
  setTimeout(function () {
    $('.about').addClass('about--reveal')
  },100)
  setTimeout(function () {
    $('.about__cover').addClass('about__cover--reveal')
  },450)
  setTimeout(function () {
    $('.about__cover').removeClass('about__cover--reveal').css('background-image','url("'+that.getCover(index)+'")');
    $('.about').removeClass('about--reveal');
    $('.'+that.el+'--extend').fadeOut(500).remove();
  },700)
  setTimeout(function () {
    that.appendSlide(index)
  },850)
};

About.prototype.appendSlide = function (index) {
  var that = this;
  var template = '<div class="col-xs-6 col-custom panel panel--active panel--slided"></div>';
  $('.about').append(template);
  var el = $('.'+that.el+'--active'); // Don't define it before otherwise it won't catch any dom element.
  this.appendChildren(el,index);
  this.getInfos(el,index);
};

About.prototype.preloadImages = function () {
  for (var i = 0; i < this.slides.length; i++) {
    img = new Image()
    $('body').append('<span id="#preloader"></span>')
    img.onload = function () {
      $('#preloader').css('background-image','url("'+img.src+'")');
    }
    img.src = this.slides[i].cover;
  }
  $('#preloader').remove();
};

About.prototype.appendChildren = function (el,index) {
  var that = this;
  var childrenTemplate = '<div class="row wrapper">'+
                            '<div class="col-xs">'+
                              '<h1 class="row panel__title"></h1>'+
                              '<div class="row panel__slogan panel__slogan--slided"></div>'+
                              '<div class="row arguments"><ul class="arguments__list"></ul></div>'+
                              '<div class="row panel__mouse">'+$('.mouse-template').clone().html()+'</div>'+
                            '</div>'+
                          '</div>'+
                          '<div class="row panel__nav panel__nav--slided">'+$('.nav-template').clone().html()+'</div>'

  setTimeout(function () {
    $('.panel__mouse svg').addClass('slided')
    that.highlightCurrent(index);
  },50)
  el.append(childrenTemplate);
};

About.prototype.getInfos = function (el,index) {
  var title = this.slides[index].title;
  var slogan = this.slides[index].slogan;
  el.find('.panel__title').text(title);
  el.find('.panel__slogan').text(slogan);
  for (var i = 0; i < this.slides[index].list.length; i++) {
    var elemList = this.slides[index].list[i].name;
    el.find('.arguments__list').append('<li class="arguments__item arguments__item--slided">'+elemList+'</li>')
  }
  // if(this.slides[this.active-1].conclusion) { // TODO: DONT ERASE. Conclusion removed. I let the js here just in case.
  //   var conclusion = this.slides[this.active-1].conclusion
  //   el.append('<div class="row panel__conclusion panel__conclusion--slided"></div>');
  //   el.find('.panel__conclusion').text(conclusion);
  // }
};

About.prototype.getCover = function (index) {
  return this.slides[index].cover // this.active has a 1 based index, so given that js' arrays have a 0 based index, i have to decrement it of 1.
};

About.prototype.initFirstView = function () {
  var el = $('.'+this.el+'--active'); // Don't define it before otherwise it won't catch any dom element.
  var title = this.slides[this.active-1].title;
  var slogan = this.slides[this.active-1].slogan;
  el.find('.panel__title').text(title);
  el.find('.panel__slogan').text(slogan);
  $('.about__cover').css('background-image','url("'+this.getCover(0)+'")');
  for (var i = 0; i < this.slides[this.active-1].list.length; i++) {
    var elemList = this.slides[this.active-1].list[i].name;
    el.find('.arguments__list').append('<li class="arguments__item arguments__item--slided">'+elemList+'</li>')
  }
  this.highlightCurrent(this.active-1);
};
originalNav = new About();

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
  return this.monthList[index]; // return current month as String (e.g: Dimanche)
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

// Ismaël Sebbane's Datepicker Plugin, Design inspired by Google Material UI.

Datepicker = function (langage) {
  this.calendar = null;
  var date = null;
  this.year = null;
  this.month = null;
  this.day = null;
  this.dayList = null;
  this.engDayList =  null;
  this.container = null;
  this.monthProperties = null;
  this.langage = null;
  this.defaults = {
    langage : "fr"
  }
  this.active = null;
  this.selector = null;
  this.width = null;
  this.init()
}

Datepicker.prototype.init = function () {
  this.calendar = new Date();
  var date = this.calendar;
  this.year = date.getFullYear();
  this.month = date.getMonth()+1; // Index for months starts by 0;
  this.day = date.getDay();
  this.dayList = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
  this.engDayList = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
  this.monthList = ['Décembre','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre'];
  if (this.langage==null) {
    this.langage = this.defaults.langage;
  }
  this.active = this.month;
  this.agenda = comptaAgenda;
  this.width = $('.datepicker__body').width();
  this.selector = '.calendar-list';
  this.transition = this.setTranslate();
  this.createBoards();
  this.updateDayLabel();
  this.enableClickListeners();
  this.addMarkers(this.agenda.parsedDates);
  $('.month__text').text(this.getThisMonth()+' '+this.year);
  //this.highlightToday();
  $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
  /*
  $('.col').click(function () {
    $('.col').removeClass('col--selected');
    $(this).addClass('col--selected');
  })*/
};

Datepicker.prototype.getToday = function () {
  return this.dayList[this.day]; // return current day as String (e.g: Dimanche)
};

Datepicker.prototype.getThisMonth = function () {
  return this.monthList[this.month]; // return current month as String (e.g: Juin)
};

Datepicker.prototype.getMonth = function (index) {
  return this.monthList[index]; // return parameter month as String (e.g: Juin)
};

Datepicker.prototype.getTodayNumber = function () {
  return new Date().toString().split(' ')[2];
};

Datepicker.prototype.getDayIndex = function (day) {
  var index = this.dayList.indexOf(day);
  return index // With String day as parameter, returns day Index.
};

Datepicker.prototype.getMonthIndex = function (month) {
  var index = this.monthList.indexOf(month);
  return index // With String day as parameter, returns month  Index.
};

Datepicker.prototype.getMonthDayNumber = function(year,monthIndex) {
  var dayIndex = 0;
  while (this.isPrevDayTheSameMonth(year,monthIndex,dayIndex)) {
    dayIndex--; // This will trigger the function until it find a prev day from a different month than the day analysed.
  }
  return -dayIndex // the index if negative so i invert it
}

Datepicker.prototype.getFirstDayOfMonth = function (year, monthIndex) {
  var negativeIndex = this.getMonthDayNumber(year, monthIndex)
  negativeIndex = -negativeIndex;
  // the method below returns a inverted value to make the count of days number in a month, i need to have it negative to use it a new Date object as a parameter to get the day string of the first day of the month, i'm also adding +1 because this value refers to the last day of the previous month we want to check the first day
  var day = new Date(year,monthIndex,negativeIndex+1).toString().split(' ')[0]; // Getting first word from returned string of object instancied with a index parameter we've got from method above
  return this.translation("day",day); // translating it to French.
};

Datepicker.prototype.isPrevDayTheSameMonth = function (year,monthIndex,index) {
  var lastDay = new Date(year,monthIndex, 0).toString(); // Stringify the returned value to split it up.
  var currentMonth = lastDay.split(' ')[1]; // Extracting the second word of sentence of get the month on the returned date
  var prevDay = new Date(year,monthIndex, index).toString() // Making the same to check if the prev day month is still on the same month
  var monthToken = prevDay.split(' ')[1];
  return currentMonth==monthToken ? true : false // If the day before the current day is from the same month, this function will return true
}

Datepicker.prototype.enableClickListeners = function () {
  var that = this;
  $('.month__prev').click(function () {
    that.getPrev()
  })
  $('.month__next').click(function () {
    that.getNext()
  })
  $('.col[data-day]').click(function () {
    if($(this).hasClass('col--highlight')) {
      var month = $(this).parent().parent().data('month');
      var day = $(this).data('day');
      var date = new Date();
      var sentence = day+' '+that.getMonth(month)+' '+date.getFullYear();
      var index = that.agenda.dates.indexOf(sentence);
      that.agenda.getIndex(index);
    }
  })
};
Datepicker.prototype.translation = function (type, string) {
  if(this.langage=="fr") {
    if(type=="day") {
      var position = this.engDayList.indexOf(string)
      return this.dayList[position];
    }
  }
};

Datepicker.prototype.getCalendarMonth = function (index) {
  this.active==index;
  this.setTranslate();
  $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
  $('.month__text').text(this.getMonth(this.active)+' '+this.year);
};

Datepicker.prototype.getNext = function () {
  if(this.active<11) {
    this.active++;
    this.setTranslate()
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text').text(this.getMonth(this.active)+' '+this.year);
  } else if(this.active==11) {
    this.active=0;
    this.setTranslate();
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text').text(this.getMonth(this.active)+' '+this.year);// Setting parameter manually because activ is defined to 0
  }
};
Datepicker.prototype.getPrev = function () {
  if(this.active>1) {
    this.active--;
    this.setTranslate()
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text').text(this.getMonth(this.active)+' '+this.year);
  } else if(this.active==0) {
    this.active=11;
    this.setTranslate()
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text').text(this.getMonth(this.active)+' '+this.year); // Setting parameter manually because activ is defined to 0
  }
};
Datepicker.prototype.getDayIndex = function (today) {
  var index = this.dayList.indexOf(today);
  return index // With String day as parameter, returns day Index.
};

Datepicker.prototype.updateDayLabel = function () {
  $('.date__day').html(this.getToday());
  $('.date__month').html(this.getThisMonth());
  $('.date__number').html(this.getTodayNumber());
};

/*
Datepicker.prototype.highlightToday = function () {
  var toHighlight = $('.calendar[data-month="'+this.month+'"] .calendar__day-list .col').eq(this.day).addClass('col--selected');
};*/

Datepicker.prototype.createBoards = function () {
  el = $(this.selector);
  $('.calendar-list').css('width',12*this.width)
  for (var i = 1; i <= 12; i++) { // creating month container, i starting to 1 for have the good index.
    el.append('<div class="calendar" data-month="'+i+'" style="flex-basis:'+$('.datepicker__body').width()+'px;width:'+$('.datepicker__body').width()+'px"></div>');
  }
  for (var i = 0; i <= 12; i++) { // creating label container list and days container list
    $('.calendar:nth-child('+i+')').append('<div class="calendar__label-list"></div>'); // Eq index starts to 0, need increment it
    $('.calendar:nth-child('+i+')').append('<div class="calendar__day-list"></div>');
  }
  for (var i = 0; i <= 12; i++) {
    for (var n = 0; n < this.dayList.length; n++) {// creating day labels as col with loop in each month with another loop
      $('.calendar__label-list').eq(i).append('<div class="col"><span>'+this.dayList[n].substr(0,1)+'</span></div>')
    }
    var firstDay = this.getFirstDayOfMonth(this.year,i+1);
    var firstDayPos = this.getDayIndex(firstDay);
    for (var x = 1 ; x <= this.getMonthDayNumber(this.year,i+1) +firstDayPos; x++) { // creating day cols in each month with another loop and adding loops because of useless loop to make the month start to the good day
      if(firstDayPos!==0) { // if month doesnt start with Sunday
        if(x<firstDayPos+1) { // Day Index starts to 0, need to increment it for have the good start for months (e.g : the 1 at Tuesday label position
          $('.calendar__day-list').eq(i).append('<div class="col"></div>') // empty cols
        } else {
          if (firstDayPos==0) {
            $('.calendar__day-list').eq(i).append('<div class="col"><span>'+(x+1)+'</span></div>')
          } else {
            $('.calendar__day-list').eq(i).append('<div data-day="'+(x-firstDayPos)+'" class="col"><span>'+(x-firstDayPos)+'</span></div>')
          }
        }
      } else { // end first if for x loop
        $('.calendar__day-list').eq(i).append('<div data-day="'+x+'"class="col"><span>'+x+'</span></div>')
      }
    }
  }
};

Datepicker.prototype.addMarkers = function (options) {
  var that = this;
  setTimeout(function () {
    for (var i = 0; i < options.length; i++) {
        var monthIndex = that.getMonthIndex(options[i].month);
        var toHighlight = $('.calendar[data-month="'+monthIndex+'"] .calendar__day-list .col[data-day="'+options[i].day+'"]').addClass('col--highlight');
    }
  },1000);
};

Datepicker.prototype.setTranslate = function () {
  if(this.active<12 && this.active>=1) {
    var value = -((this.active-1)*this.width) // I decrement one because we don't wanna translate for the first month.
    this.translate = value;
  } else {
    var value = -((11)*this.width); // 11 because we need to translate to the end of the container - the width of a month calendar.
    this.translate = value;
  }

}

var hillsDatepicker = new Datepicker()

Faq = function () {
  this.data = {};
  this.canSkip = null;
  this.isReady = null;
  this.topicsList = [];
  this.step = null;
  this.selected = {};
  this.articles = [];
  this.currentArticles = [];
  this.addMoreTimes = 1;
  this.init();
};

Faq.prototype.init = function () {
  this.canSkip = false;
  this.isReady = false;
  this.step = 1;
  this.data = this.getData(); // I also define this.topicsList in this method.
  this.clickListener();
  this.keyboardListener();
};

Faq.prototype.getData = function () {
  var obj = {};
  var that = this;
  $.getJSON('/faq/data').done(function (data) {
    for (var i = 0; i < data.rubriques.length; i++) {
      var rubrique = obj[data.rubriques[i]] = data.result[i];
    }
    that.data = obj;
    that.topicsList = data.rubriques;
  })
};

Faq.prototype.clickListener = function () {
  $('.list').addClass('is-hidden');
  $('.buttons').addClass('is-hidden');

  var that = this;
  $('.search__next i').click(function () {
    if(that.canSkip) {
      that.next();
    }
  })
  $('.faq .buttons__full').click(function () {
      that.addMore(that.addMoreTimes);
      that.addMoreTimes++;
  })
  $('.faq .buttons__search').click(function () {
    that.newSearch();
  })
  $('.search__reload').click(function () {
    that.prev();
  });
  $(document).on('click','.faq .new-search', function () {
    that.newSearch();
    $(this).parent().remove();
  })
  $(document).on('click','.faq .option',function () {
    var val = $(this).data('content');
    if(that.step==1) {
      that.canSkip = true;
      $('.search__current').text(val).attr('data-content',val);
      $('.faq .option').removeClass('option--selected');
      $(this).toggleClass('option--selected')
      $('.search__next i').addClass('ready');
    } else if(that.step==2) {
      if($(this).hasClass('option--selected')) {
        $(this).removeClass('option--selected');
        var field = $('.search__current').text();
        var arr = field.split(',');
        var index = arr.indexOf(val);
        arr.splice(index,1);
        var newField = arr.join(',');
        $('.search__current').text(newField);
      } else {
        $(this).addClass('option--selected');
        if($('.search__current').text()=="") {
          $('.search__current').text(val).attr('data-content',val);
        } else if($('.search__current').text().indexOf(val)==-1) {
          var newVal =  $('.search__current').text()+','+val;
          $('.search__current').text(newVal).attr('data-content',val);
        }
      }
      if($('.search__current').text()!=="") {
        that.isReady = true;
        $('.search__next i').addClass('ready');
      } else {
        that.isReady = false;
        $('.search__next i').removeClass('ready');
      }
    }
  })

};

Faq.prototype.keyboardListener = function () {
  var that = this;
  $(document).on('keydown',function (ev) {
    var key = ev.keyCode || ev.which;
    if(key==13) {
      that.next();
    }
  })
};


Faq.prototype.next = function () {
  var that = this;
  if(this.step==1 && this.canSkip) {
    var val = $('.search__select').find('.option--selected').data('content');
    this.selected.topic = val;
    $('.search__select').find('li').remove();
    $('.search__current').text('');
    $('.search__next i').removeClass('ready');
    $('.search__reload').addClass('search__reload--show');
    setTimeout(function () {
      $('.search__progress .fill').addClass('step-2'); // We need a settimeout there because this element is destroyed and refresh'd while the execution time of this method
    }, 5);
    this.createList('.search__select',this.data[this.selected.topic],false);
    this.slideTitle('Sélectionnez un ou plusieurs mots-clés');
    this.step++;
  } else if(this.step==2 && this.isReady) {
    this.canSkip = false;
    $('.search__progress .fill').addClass('step-3');
    this.selected.keywords = []
    $('.search__select').find('.option--selected').each(function () {
      that.selected.keywords.push($(this).data('content'));
    })
    that.getResult();
    setTimeout(function () {
      $('.search').addClass('fade-out');
    }, 600);
    setTimeout(function () {
      $('.search').addClass('hide');
      $('.list').removeClass('is-hidden');
      $('.buttons').removeClass('is-hidden');
    }, 1100);
  }
};

Faq.prototype.slideTitle = function (sentence) {
  $('.search__label').addClass('search__label--down');
  setTimeout(function () {
    $('.search__label').removeClass('search__label--down');
  }, 250);
  setTimeout(function () {
    $('.search__label').text(sentence)
  }, 200);
};

Faq.prototype.prev = function () {
  if(this.step==2) {
    $('.search__progress .fill').removeClass('step-2');
    $('.search__current').text('');
    $('.search__label').removeClass('search__label--change'); // No need to check if it has class, if i want to go back it's that it has the class
    $('.search__label').addClass('search__label--rollback');
    $('.search__select').find('li').remove();
    this.createList('.search__select',this.topicsList,true);
    this.slideTitle('Sélectionnez une rubrique');
    $('.search__next i').removeClass('ready');
    this.isReady = false;
    $('.search__reload').removeClass('search__reload--show');
    this.step--;
    this.canSkip = false;
  }
};

Faq.prototype.getResult = function () {
  var that = this;
  that.articles = [];
  that.currentArticles = [];
  $.getJSON('faq/keywords/'+this.selected.topic).done(function (data) {
      var x = 0;
      setTimeout(function () {
        that.isDone = true;
        for (var i = 0; i < data.length; i++) {
          if(that.isKeywordInSelection(data[i])) { //that.selected.keywords.indexOf(data[i].from_keyword
            that.currentArticles.push(data[i]);
            if(x<5) { // the if nesting is necessary here.
              var reponse = data[i].reponse;
              var question = data[i].question;
              var title = data[i].title;
              var template =  '<div class="col-xs-9 faq-item">'+
                                '<div class="row faq-item__title">'+title+'</div>'+
                                '<div class="row faq-item__question">'+question+'</div>'+
                                '<div class="row faq-item__reponse">'+reponse+'</div>'+
                              '</div>';
                $('.faq .list').append(template);
                x++;
            }
          }
        }
        console.log(data);
        if(that.currentArticles.length>5) {
          $('.buttons__full').addClass('buttons__full--show')
        } else if(that.currentArticles.length==0) {
          $('.faq .list').append('<span class="no-results">Aucun résultat de recherche, voulez-vous faire <span class="new-search">une nouvelle recherche ?</span></span>')
        }
        if(that.currentArticles.length>0) {
          $('.buttons__search').addClass('buttons__search--show');
        }
        $('.faq-item p').each(function () {
          if($(this).text()=='' || $(this).text()==' ') {
            $(this).remove();
          }
        })
      }, 1000);
  })
};

Faq.prototype.isKeywordInSelection = function (iteration) {
  bool = false;
  for (var i = 0; i < iteration.keywords.length; i++) {
    if(this.selected.keywords.indexOf(iteration.keywords[i].keyword)!==-1 && this.currentArticles.indexOf(iteration.id)) {
      bool = true;
    } else {
      if(bool == true){
        bool = true;
      }else{
        bool = false;
      }
    }
  }
  return bool;
};

Faq.prototype.addMore = function (index) {
  iterationNumber = 5;
  index = (index * iterationNumber) + 1;
  iterationIndex = iterationNumber + index;
  if(this.currentArticles.length < iterationIndex){
    iterationIndex = this.currentArticles.length;
    $('.buttons__full').removeClass('buttons__full--show');
  }
  for (var i = index; i < iterationIndex; i++) {
    var template =  '<div class="col-xs-9 faq-item">'+
                      '<div class="row faq-item__title">'+this.currentArticles[i].title+'</div>'+
                      '<div class="row faq-item__question">'+this.currentArticles[i].question+'</div>'+
                      '<div class="row faq-item__reponse">'+this.currentArticles[i].reponse+'</div>'+
                    '</div>';
      $('.faq .list').append(template);
  }
  $('.faq-item p').each(function () {
    if($(this).text()=='' || $(this).text()==' ') {
      $(this).remove();
    }
  })
};

Faq.prototype.newSearch = function () {
  this.step = 1;
  this.canSkip = false;
  this.isReady = false;
  $('.list').addClass('is-hidden');
  $('.buttons').addClass('is-hidden');
  $('.search__next i').removeClass('ready');
  $('.search').removeClass('hide fade-out');
  $('.search__select .option').remove();
  this.createList('.search__select',this.topicsList,true);
  $('.search__progress .fill').removeClass('step-3 step-2');
  $('.search__current').text('');
  $('.buttons__search').removeClass('buttons__search--show');
  $('.buttons__full').removeClass('buttons__full--show');
  this.slideTitle('Sélectionnez une rubrique');
  $('.faq-item').fadeOut(500);
};

Faq.prototype.createList = function (target, datas, isRollback) {
  if(!isRollback) {
    for (var i = 0; i < datas.length; i++) {
      $(target).append('<li data-content="'+datas[i].name+'" class="option">'+datas[i].name+'</li>');
    }
  } else {
    for (var i = 0; i < datas.length; i++) {
      $(target).append('<li data-content="'+datas[i]+'" class="option">'+datas[i]+'</li>');
    }
  }
};

FaqHandler = new Faq();

FluxHandler = function () {
  this.init();
}

FluxHandler.prototype.init = function () {
  this.monthList = ['Décembre','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre'];
  this.parsingDates();
  this.parsingTags();
  this.trimTable();
};

FluxHandler.prototype.parsingDates = function () {
  var that = this;
  $('.actus-articles__entreprises .article__footer .date, .actus-articles__cabinet .article__date, .gallery__item .article__date, .echo-article__date').each(function () {
    var val = $(this).text();
    var year = val.substring(0,4);
    if (val.substring(5,7) >= 10){
      var month = val.substring(5,7);
    }else{
      var month = val.substring(6,7);
    }
    month = that.getMonth(month);
    var day = val.substring(8,10);
    var date = 'Publié le '+day+' '+month+' '+year+'.';
    $(this).text(date);
  })
};

FluxHandler.prototype.parsingTags = function () {
  var parsedContent = $.parseHTML($('.echo-article__content').text());
  var parsedTable = $.parseHTML($('.echo-article__table').text());
  $('.echo-article__content').html(parsedContent);
  $('.echo-article__table').html(parsedTable);
};

FluxHandler.prototype.trimTable = function () {
  $('.echo-article__table td').each(function () {
    var trimmed = $(this).text().split('').join('');
    $(this).text(trimmed);
  })
  $('.echo-article__table tr').each(function () {
    if($(this).children().length==1) {
      $(this).find('td').attr('colspan',8).addClass('full');
    }
  })
};

FluxHandler.prototype.testLink = function (val) {
  return /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/.test(val);
};

FluxHandler.prototype.replace = function (val) {
  var special = ["À","Á","Â","Ã","Ä","Å","Æ","Ç","È","É","Ê","Ë","Ì","Í","Î","Ï","Ð","Ñ","Ò","Ó","Ô","Õ","Ö","Ø","Ù","Ú","Û","Ü","Ý","ß","à","á","â","ã","ä","å","æ","ç","è","é","ê","ë","ì","í","î","ï","ñ","ò","ó","ô","õ","ö","ø","ù","ú","û","ü","ý","ÿ","’",":",'&nbsp','/']
  var literal = ["A","A","A","A","A","A","AE","C","E","E","E","E","I","I","I","I","D","N","O","O","O","O","O","O","U","U","U","U","Y","s","a","a","a","a","a","a","ae","c","e","e","e","e","i","i","i","i","n","o","o","o","o","o","o","u","u","u","u","y","y","","-","",'-']
  for (i=0;i<special.length;i++) {
    if(val.indexOf(special[i])!==-1) {
      while(val.indexOf(special[i])!==-1) {
        val = val.replace(special[i],literal[i]);
      }
    }
  }
  val = val.replace(/ /g, "-");
  val = val.replace('--','-');
  val = val.toLowerCase();
  return val;
};

FluxHandler.prototype.removeSpecials = function (str) {
  var specialChars = "!@#$^&%*()+=-[]\{}|:<>?,.";
  for (var i = 0; i < specialChars.length; i++) {
      str = str.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
  }
  return str;
};


FluxHandler.prototype.getMonth = function (index) {
  return this.monthList[index]; // return current month as String (e.g: Dimanche)
};

fluxXML = new FluxHandler();

MouseAnimation = function () {
  this.classesList = {};
  this.init();
}

MouseAnimation.prototype.init = function () {
  this.classesList = {
    wheel: 'mousewheel',
    arrows: 'mouse-arrow'
  };
  this.anim();
};

MouseAnimation.prototype.anim = function () {
  var that = this;
  that.toggleClasses();
  setInterval(function () {
    that.toggleClasses();
  },3000)
};

MouseAnimation.prototype.toggleClasses = function () {
  var that = this;
  var wheel = $('.'+that.classesList.wheel);
  var arrows = $('.'+that.classesList.arrows);
  wheel.addClass(that.classesList.wheel+'--animated');
  setTimeout(function () {
    wheel.removeClass(that.classesList.wheel+'--animated');
  },2000)
  for (var i = 0; i < arrows.length; i++) { // animations for arrows.
    this.setTimer(i,arrows)
  }
};

MouseAnimation.prototype.setTimer = function (iteration,el) { // Otherwise can't access index in the loop using it in a setTimeout
  var that = this;
  setTimeout(function () {
    el.eq(iteration).addClass(that.classesList.arrows+'--show');
    setTimeout(function () {
      if(iteration==0) {
        el.eq(0).removeClass(that.classesList.arrows+'--show');
      } else {
        el.eq(iteration).removeClass(that.classesList.arrows+'--show');
      }
    },400 + iteration*30)
  },500 + iteration*50)
};

wheelAnim = new MouseAnimation();


  Slider = function (selector,originalSlider) {
    this.element = $(selector);
    this.connection = originalSlider;
    this.slideClass = originalSlider.params.slideClass;
    this.slideActiveClass = originalSlider.params.slideActiveClass;
    this.activeSlide = originalSlider.params.slideVisibleClass;
    this.captionClass = '.slider-caption';
    this.speed = originalSlider.params.speed;
    // Initializing object when creating instance and storing object's scope
    that = this;
    this.init();
  }

  Slider.prototype.init = function () {
    this.connection.on('transitionEnd', function () {
      that.show();
    });
    setTimeout(function () {
      $('.slider-caption').addClass('slider-caption--shown');
      $('.slider-caption__title').addClass('slider-caption__title--shown');
    }, 150);
  };

  Slider.prototype.toggleClasses = function () {
    var activeClass = "."+this.slideActiveClass;
    var caption = this.captionClass; // dot is already in the property here.
    var currentCaption = $(activeClass).find(caption);
    var currentCaptionTitle = $(activeClass).find(caption+'__title');
    $(caption).removeClass('slider-caption--shown'); // removing class to other slider, to make the animation retrigger when going back to others slides
    currentCaption.addClass('slider-caption--shown');
    $(caption+'__title').removeClass('slider-caption__title--shown');
    currentCaptionTitle.addClass('slider-caption__title--shown');

  };

  Slider.prototype.show = function () {
    setTimeout(function () {
      that.toggleClasses();
    },this.speed - 190)
  };

ToolBox = function () {
  this.enabled = null;
  this.selector = null;
  this.el = null;
  this.widthTransition = null;
  this.heightTransition = null;
  this.translateProperties = {};
  this.transition = {};
  this.init();
}

ToolBox.prototype.init = function () {
  this.enabled = false;
  this.selector = '.toolbox';
  this.el = $(this.selector);
  this.translateOffsets = {
    translateX: null,
    translateY: null
  }
  this.transition.timers = {
    transform : 300, // Fucking firefox fix, can't use my dynamic method to get the  transition value
    height: 500 // Fucking firefox fix, can't use my dynamic method to get the  transition value
  }
  this.clickListener()
};

ToolBox.prototype.getTransformTransitionOffset = function () {
  var properties = this.el.css('transform');
  if(properties.indexOf('matrix3d')==-1) { // making an result array for 2D transformations.
    properties = properties.substr(7);
    var lastIndex = properties.indexOf(')')
    properties = properties.substr(0,lastIndex);
    var splittedProperties = properties.split(',')
    var translateX = splittedProperties[4];
    var translateY = splittedProperties[5];
    this.translateOffsets.translateX = translateX+"px";
    this.translateOffsets.translateY = translateY+"px";
  } else {
    //TODO, for 3d transformations cases
  }
};

ToolBox.prototype.getTransitionTime = function (property) {
  var properties = this.el.css('transition') || this.el.css('-moz-transition')
  properties = properties.split(',')
  for (var i = 0; i < properties.length; i++) {
    if(properties[i].indexOf(property)!==-1) {
      var value = properties[i].split(' ')[2]
      if(value.indexOf('s')!==-1 && value.indexOf('ms')==-1) {
        var index = value.indexOf('s');
        var time = value.substr(0,index);
        time = time*1000;
        return time
      } else if(value.indexOf('ms')!==-1) {
        return time
      }
    }
  }
};

ToolBox.prototype.clickListener = function () {
  var that = this;
  this.el.click(function () {
    that.toggleState();
  });
  $('body >*:not(.toolbox)').click(function () {
    if(that.enabled) {
      that.close();
    }
  })
};

ToolBox.prototype.open = function () {
  var that = this;
  this.enabled = true;
  var transitionValue = this.transition.timers.transform;
  //console.log(this.transition.timers);
  this.el.addClass('toolbox--open-x');
  this.el.removeClass('toolbox--delay');
  setTimeout(function () {
    that.el.addClass('toolbox--open-y');
  },transitionValue)
};

ToolBox.prototype.close = function () {
  var that = this;
  var transitionValue = this.transition.timers.height;//Fix for firefox, setTimeout second argument uses window scope in Firefox.
  // console.log(transitionValue);
  //console.log(this);
  this.el.removeClass('toolbox--open-y');
  that.el.addClass('toolbox--delay');
  setTimeout(function () {
    that.el.removeClass('toolbox--open-x');
  },transitionValue)
  this.enabled = false
};

ToolBox.prototype.toggleState = function () {
  if(!this.enabled) {
    this.open()
  } else {
    this.close()
  }
};

cabinetTools = new ToolBox()

//# sourceMappingURL=Classes.js.map
