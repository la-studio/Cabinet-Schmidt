Faq = function () {
  this.data = {};
  this.canSkip = null;
  this.isReady = null;
  this.topicsList = [];
  this.step = null;
  this.selected = {};
  this.articles = [];
  this.currentArticles = [];
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
  var that = this;
  $('.search__next i').click(function () {
    if(that.canSkip) {
      that.next();
    }
  })
  $('.faq .buttons__full').click(function () {
    that.addMore();
    $(this).addClass('buttons__full--disabled')
  })
  $('.faq .buttons__search').click(function () {
    that.newSearch();
  })
  $('.search__reload').click(function () {
    that.prev();
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
    $('.search__reload').removeClass('search__reload--show');
    this.step--;
  }
};

Faq.prototype.getResult = function () {
  var that = this;
  that.articles = [];
  $.getJSON('faq/keywords/'+this.selected.topic).done(function (data) {
      console.log(data);
      var x = 0;
      setTimeout(function () {
        that.isDone = true;
        for (var i = 0; i < data.length; i++) {
          if(that.isKeywordInSelection(data[i])) { //that.selected.keywords.indexOf(data[i].from_keyword
            that.currentArticles.push(data[i]);
            if(x<5) { // the if nesting is necessary here.
              var reponse = data[i].reponse;
              var template =  '<div class="col-xs-9 faq-item">'+
                                '<div class="row faq-item__question">'+data[i].question+'</div>'+
                                '<div class="row faq-item__reponse">'+reponse+'</div>'+
                              '</div>';
                $('.faq .list').append(template);
                x++;
            }
          }
        }
        if(that.currentArticles.length>5) {
          $('.buttons__full').addClass('buttons__full--show')
        }
        $('.buttons__search').addClass('buttons__search--show')
        $('.faq-item p').each(function () {
          if($(this).text()=='' || $(this).text()==' ') {
            $(this).remove();
          }
        })
      }, 1000);
  })
};

Faq.prototype.isKeywordInSelection = function (iteration) {
  for (var i = 0; i < iteration.keywords.length; i++) {
    if(this.selected.keywords.indexOf(iteration.keywords[i].keyword)!==-1 && this.currentArticles.indexOf(iteration.id)) {
      return true
    } else {
      return false
    }
  }
};

Faq.prototype.addMore = function () {
  for (var i = 6; i < this.currentArticles.length; i++) {
    var template =  '<div class="col-xs-9 faq-item">'+
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
