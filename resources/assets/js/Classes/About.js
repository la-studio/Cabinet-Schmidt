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
