
$(document).ready(function () {
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
