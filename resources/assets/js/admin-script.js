
$(function(){$.fn.clearTextLimit=function(){return this.each(function(){this.onkeydown=this.onkeyup=null;});};$.fn.textLimit=function(limit,callback){if(typeof callback!=='function')var callback=function(){};return this.each(function(){this.limit=limit;this.callback=callback;this.onkeydown=this.onkeyup=function(){this.value=this.value.substr(0,this.limit);this.reached=this.limit-this.value.length;this.reached=(this.reached==0)?true:false;return this.callback(this.value.length,this.limit,this.reached);}});};});

$(document).ready(function () {
  $('#cabinet-article').textLimit(255, function( length, limit, reached  ){
    var character = limit - length;
    if(length == limit){
      $('.count').text(character+' caractère restant');
    }else{
      $('.count').text(character+' caractères restants');
    }
  });

  $('.add').click(function () {
    var val = $('.to_add').val();
    if(!val.length == 0){
      $('.story__form ul').append('<li class="list__item"><span>'+val+'</span><span class="delete"><i class="material-icons">clear</i></span></li>');
      $('.story__form').append('<input type="hidden" name="item[]" value="'+val+'"/>');
      $('.to_add').val('');
    }
  })
  if(window.location.href.indexOf("admin/storytelling/edit")!==-1) {
    $(document).on('click','.story__form .delete',function () {
      var val = $(this).prev().text();
      $('input[value="'+val+'"]').remove();
      $(this).parent().remove();
    })
    $(document).on('keydown',function (ev) {
      var key = ev.keyCode || ev.which;
      if(key==13) {
        ev.preventDefault();
      }
    })
    $('.to_add').on('keydown',function (ev) {
      var key = ev.keyCode || ev.which;
      if(key==13) {
        var val = $(this).val();
        $('.story__form ul').append('<li class="list__item"><span>'+val+'</span><span class="delete"><i class="material-icons">clear</i></span></li>');
        $('.story__form').append('<input type="hidden" name="item[]" value="'+val+'"/>');
        $('.to_add').val('');
      }
    })
  }
})