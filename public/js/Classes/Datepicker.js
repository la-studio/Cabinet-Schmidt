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
  this.tool = null;
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
  this.tool = new Debugger(this);
  this.tool.enabled = true;
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
  this.send();
  this.createBoards();
  this.updateDayLabel();
  this.enableClickListeners();
  this.addMarkers(this.agenda.dates);
  //this.highlightToday();
  $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
  /*
  $('.col').click(function () {
    $('.col').removeClass('col--selected');
    $(this).addClass('col--selected');
  })*/
  this.tool.debug('init',this.translate);
};

Datepicker.prototype.send = function () {
  this.tool.addMessage('init', 'La valeur de translate est de', 'end');
  //this.tool.addMessage('isPrevDayTheSameMonth','Le mois actuel est','end');
  //this.tool.addMessage('isPrevDayTheSameMonth',"L'ancien mois est",'end');
  this.tool.addMessage('getNext',"Le mois actif est",'end');
  this.tool.addMessage('getPrev',"Le mois actif est",'end');
};
Datepicker.prototype.getToday = function () {
  return this.dayList[this.day]; // return current day as String (e.g: Dimanche)
};

Datepicker.prototype.getThisMonth = function () {
  return this.monthList[this.month]; // return current month as String (e.g: Dimanche)
};

Datepicker.prototype.getMonth = function (index) {
  return this.monthList[index]; // return current month as String (e.g: Dimanche)
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
  //this.tool.debug('isPrevDayTheSameMonth', currentMonth)
  //this.tool.debug('isPrevDayTheSameMonth', monthToken)
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
};
Datepicker.prototype.translation = function (type, string) {
  if(this.langage=="fr") {
    if(type=="day") {
      var position = this.engDayList.indexOf(string)
      return this.dayList[position];
    }
  }
};

Datepicker.prototype.getNext = function () {
  if(this.active<11) {
    this.active++;
    this.setTranslate()
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text span:first-child').html(this.getMonth(this.active))
  } else if(this.active==11) {
    this.active=0;
    this.setTranslate();
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text span:first-child').html(this.getMonth(this.active))// Setting parameter manually because activ is defined to 0
  }
  this.tool.debug('getNext',this.active)
};
Datepicker.prototype.getPrev = function () {
  if(this.active>1) {
    this.active--;
    this.setTranslate()
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text span:first-child').html(this.getMonth(this.active))
  } else if(this.active==0) {
    this.active=11;
    this.setTranslate()
    $('.calendar-list').css('transform','translate3d('+this.translate+'px,0,0)');
    $('.month__text span:first-child').html(this.getMonth(this.active)) // Setting parameter manually because activ is defined to 0
  }
  this.tool.debug('getNext',this.active)
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
  for (var i = 0; i < options.length; i++) {
      var monthIndex = this.getMonthIndex(options[i].month);
      var toHighlight = $('.calendar[data-month="'+monthIndex+'"] .calendar__day-list .col[data-day="'+options[i].day+'"]').addClass('col--highlight');
  }
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
