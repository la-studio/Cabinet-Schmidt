FluxHandler = function () {
  this.list = [];
  this.init();
}

FluxHandler.prototype.init = function () {
  this.storeArticles();
};

FluxHandler.prototype.storeArticles = function () {
  var that = this;
  $.ajax({
          type: "GET",
          url: "ec_flux_actualites.xml",
          dataType: "xml",
          success: function(xml) {
            $(xml).find('article create_date').each(function () {
              if($(this).text().substring(0,4)=='2016' && that.list.length<50) {
                that.list.push($(this).parent());
              }
            })
            that.storeDate(that.list);
            that.sort(that.list);
            that.createHomePreviews();
          }
      })
};

FluxHandler.prototype.storeDate = function (array) {
  for (var i = 0; i < array.length; i++) {
    var fulldate = array[i].find('create_date').text();
    var month = parseInt(fulldate.substring(5,7));
    var day = parseInt(fulldate.substring(8,10));
    console.log(fulldate);
    array[i].month = month; // Useful to store month and day for later (to not handle in fulldate)
    array[i].day = day;
    array[i].fulldate = month+'/'+day;
  }
};

FluxHandler.prototype.logInfos = function () { // DONT erase this pls. For debug of sorted dates of not.
  for (var i = 0; i < this.list.length; i++) {
     console.log(this.list[i].fulldate);
  }
};

FluxHandler.prototype.sort = function (array) {
  array.sort(function (a,b) {
    if (a.fulldate < b.fulldate) //sort string descending
      return 1;
    if (a.fulldate > b.fulldate)
      return -1;
    return 0; //default return value (no sorting)
  })
};

FluxHandler.prototype.createHomePreviews = function () {
  for (var i = 0; i <= 1; i++) {
    console.log(this.list);
    var title = this.list[i].find('title').text();
    var content = this.list[i].find('summary').text();
    var image = 'http://www.cineshow.fr/wp-content/uploads/2015/10/Arrow-header.jpg';
    var date = 'test';
    var link = '#';
    var template = '<div class="row article">'+
                     '<div class="col-xs article__picture" style="background-image: url("'+image+'")"></div>'+
                     '<div class="col-xs article__content">'+
                        '<div class="row article__wrapper>'+
                          '<h4 class="article__name">'+title+'</h4>'+
                          '<p class="article__body">'+content+'</p>'+
                        '</div>'+
                        '<div class="article__footer">'+
                          '<span class="date">Publié le '+date+'</span>'+
                          '<a href="'+link+'" class="button"><span >Lire +</span></a>'+ // FIXME: Set route for article.
                        '</div>'+
                      '</div>'+
                    '</article>';
    $('.actus-articles__entreprises').append(template);
    //this.list[i].find('title');
  }
};
fluxXML = new FluxHandler();
