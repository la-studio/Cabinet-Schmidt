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
  this.slides = [
    {
      title: "Une équipe pluridisciplinaire",
      slogan: 'À votre écoute pour vous conseiller et vous accompagner dans différents secteurs',
      list: ['Conseil','Comptabilité','Social','Fiscalité',"Création d'entreprise",'Audit'],
      conclusion: null,
      cover: suffix+'cover-about.jpg'
    },
    {
      title: "Auprès des TPE et artisans",
      slogan: 'Nous accompagnons des entreprises issues de différents secteurs tels que :',
      list: ['Artisanat','Commerce','Professions libérales','Loueurs de meubles','CMI','Agricole','Restauration'],
      conclusion: 'Et bien plus encore !',
      cover: suffix+'artisan.jpg'
    },
    {
      title: "Implantée dans le Grésivaudan",
      slogan: "Implantée dans la vallée du Grésivaudan de l'axe Grenoble - Chambéry, les entreprises sont principalement issues de :",
      list: ['Crolles','Pontcharra','Grenoble','Meylan','Voiron'],
      conclusion: 'Et dans les alentours !',
      cover: suffix+'Gresivaudan.jpg'
    },
    {
      title: "Depuis plus de 20 ans",
      slogan: 'Le cabinet a acquis une expérience durant ses années de métier',
      list: ['Plus de 300 clients','Plus de 3000 liasses fiscales bouclées','Et des milliers de litres de café'],
      conclusion: 'Rejoignez nous pour faire partie de cette aventure !',
      cover: suffix+'cover-comptable.jpg'
    }
  ];
  this.active = 1;

  //Methods executed at init.
  this.initFirstView();
  this.forceScroll();
  this.enableKeyboardListener();
  this.scrollListener();
  this.mouseListener();
  this.loadListener();
};

About.prototype.forceScroll = function () {
  var that = this;
  setTimeout(function () {
    if(!that.isDown()) {
      $('html,body').animate({scrollTop: $('.header').height()}, 500);
    }
  },1600)
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

About.prototype.mouseListener = function () {
  var that = this;
  $(document).on('mousewheel',function (ev) {
    if(that.canSlide() && that.isDown() && ev.originalEvent.wheelDelta < 0) { // ev.originalEvent.wheelDelta < 0 == Scroll down.
     that.getNext();
   }
  })
};

About.prototype.isDown = function () {
  if($('body').scrollTop()>=$('.header').height()) {
    return true
  } else {
    return false
  }
};

About.prototype.enableKeyboardListener = function () {
  var that = this;
  $(document).on('keydown',function (ev) {
    //ev.preventDefault();
    var key = ev.keyCode || ev.which;
    if (key==39 && that.canSlide()) { // right arrow
      that.getNext();

    }
  })
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

About.prototype.getNext = function () {
  var el = $('.'+this.el+'--active');
  var that = this;
  if(this.active>=1 && this.active<4) {
    this.active++;
    this.handleThisAndCall(el)
    console.log('this.active is now '+this.active);
  } else if(this.active==4) {
    this.active = 1;
    this.handleThisAndCall(el)
  }
};

About.prototype.handleThisAndCall = function (el) {
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
  },300)
  setTimeout(function () {
    $('.about__cover').removeClass('about__cover--reveal').css('background-image','url("'+that.getCover()+'")');
    $('.about').removeClass('about--reveal');
    $('.'+that.el+'--extend').fadeOut(500).remove();
  },700)
  setTimeout(function () {
    that.appendSlide()
  },850)
};

About.prototype.appendSlide = function () {
  var that = this;
  var template = '<div class="col-xs-6 col-custom panel panel--active panel--slided"></div>';
  $('.about').append(template);
  var el = $('.'+that.el+'--active'); // Don't define it before otherwise it won't catch any dom element.
  this.appendChildren(el);
  this.getInfos(el);
};

About.prototype.appendChildren = function (el) {
  var childrenTemplate = '<div class="row wrapper">'+
                            '<div class="col-xs">'+
                              '<h2 class="row panel__title"></h2>'+
                              '<div class="row panel__slogan panel__slogan--slided"></div>'+
                              '<div class="row arguments"><ul class="arguments__list"></ul></div>'+
                              '<div class="row panel__mouse">'+$('.mouse-template').clone().html()+'</div>'+
                            '</div>'+
                          '</div>'
  setTimeout(function () {
    $('.panel__mouse svg').addClass('slided')
  },50)
  el.append(childrenTemplate);
};

About.prototype.getInfos = function (el) {
  var title = this.slides[this.active-1].title;
  var slogan = this.slides[this.active-1].slogan;
  el.find('.panel__title').text(title);
  el.find('.panel__slogan').text(slogan);
  for (var i = 0; i < this.slides[this.active-1].list.length; i++) {
    var elemList = this.slides[this.active-1].list[i];
    el.find('.arguments__list').append('<li class="arguments__item arguments__item--slided">'+elemList+'</li>')
  }
  // if(this.slides[this.active-1].conclusion) { // Conclusion removed. I let the js here just in case.
  //   var conclusion = this.slides[this.active-1].conclusion
  //   el.append('<div class="row panel__conclusion panel__conclusion--slided"></div>');
  //   el.find('.panel__conclusion').text(conclusion);
  // }
};

About.prototype.getCover = function () {
  return this.slides[this.active-1].cover // this.active has a 1 based index, so given that js' arrays have a 0 based index, i have to decrement it of 1.
};

About.prototype.initFirstView = function () {
  var el = $('.'+this.el+'--active'); // Don't define it before otherwise it won't catch any dom element.
  console.log(el);
  var title = this.slides[this.active-1].title;
  var slogan = this.slides[this.active-1].slogan;
  el.find('.panel__title').text(title);
  el.find('.panel__slogan').text(slogan);
  for (var i = 0; i < this.slides[this.active-1].list.length; i++) {
    var elemList = this.slides[this.active-1].list[i];
    el.find('.arguments__list').append('<li class="arguments__item arguments__item--slided">'+elemList+'</li>')
  }
};
originalNav = new About();
