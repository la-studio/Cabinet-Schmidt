
$(document).ready(function () {
  function closeModal() {
    $('.modal-bg').toggleClass('reveal');
    $('.modal-body').toggleClass('reveal');
    setTimeout(function () {
      $('.modal-bg, .modal-body').removeClass('show');
    }, 500);
  }
  var optionsSlider = {
      pagination: '.swiper-pagination',
      paginationClickable: true,
      grabCursor: true,
      autoplay: 4000,
      loop: true,
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev'
    }
    var optionsSlider2 = {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        grabCursor: true,
        autoplay: 4000,
        loop: true,
        slidesPerView: 2
      }
      var optionsSlider3 = {
          pagination: '.swiper-pagination',
          paginationClickable: true,
          grabCursor: true,
          autoplay: 3000,
          loop: true,
          slidesPerView: 1,
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev'
        }
      if($('.slider').length >0) {
        //var swiper = new Swiper('.swiper',optionsSlider);
        var swiper2 = new Swiper('#slider-partenaires',optionsSlider2);
        var swiper3 = new Swiper('#slider-temoignage',optionsSlider3);
      }
      if($('.swiper').length >0) {
        var swiper = new Swiper('.swiper',optionsSlider);
        var sliderController = new Slider('.swiper',swiper); // Connecting Swiper to my object and initializing it.
      }
  //Responsive menu switch on/off. No obj because way too simple.
  $('.responsive-menu').click(function () {
    $(this).toggleClass('responsive-menu--open');
    $('.header__secondary-nav').slideToggle('500');
    $('.responsive-menu__icons').toggleClass('responsive-menu__icons--open');
  });

  // Handling input focus when focus in and out
  $('.input__field').on('focus focusout',function(){
    $(this).removeClass('input__field--error');
    $(this).siblings().filter('.input__error').removeClass('input__error--missing');
    $(this).siblings().filter('.input__label').removeClass('input__label--missing');
    if($(this).val().trim().length!=0) {
      $(this).parent().addClass('input--filled');
    } else if ($(this).val().trim().length==0) {
      $(this).parent().removeClass('input--filled');
    }
  })
  $('.input__field').on('keyup keydown', function () {
    if($(this).val().trim().length!=0) {
      $(this).parent().addClass('input--filled');
    }
  })
  $('.form__button span').click(function () {
    var proceed = true;
    //simple validation at client's end
    //loop through each field and we simply change border color to red for invalid fields
    $(".input__field").each(function() {
        if(!$.trim($(this).val())){ //if this field is empty
            $(this).addClass('input__field--error');
            $(this).siblings().filter('.input__label').addClass('input__label--missing');
            $(this).siblings().filter('.input__error').html('Ce champ est requis.').addClass('input__error--missing');
            proceed = false; //set do not proceed flag
        }
        //check invalid email
        var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))) {
            $(this).addClass('input__field--error');
            $(this).siblings().filter('.input__error').html('Veuillez utiliser une adresse valide.').addClass('input__error--missing');
            proceed = false; //set do not proceed flag
        }
    });
    if(proceed) {
      var data = {
        _token   : $('input[name="_token"]').attr('value'),
        identity : $('#form-identity').val(),
        company  : $('#form-company').val(),
        email    : $('#form-mail').val(),
        purpose  : $('#form-purpose').val(),
        message  : $('#form-message').val()
      }
      console.log(data);
      var options = {
        url : '/contact/send',
        type : 'post',
        data: data,
        success: function (response) {
          var sucessText = "Le message à été envoyé avec succès !";
          var sucessToken =  '<div class="success"><span class="success__icon"><i class="fa fa-check-circle"></i></span><span class="success__message">'+sucessText+'</span></div>'
          $('body').append('<div class="success">'+sucessText+'</div>')
          $(".input__field").val('').removeClass('input__field--missing');
          console.log(response);
        },
        error: function (xhr,status,error) {
          console.log(xhr,error);
          $('body').append(xhr.responseText)
        }
      }
      $.ajax(options);
    } // end if proceed
  }) // end button click
  $('.filters__item').on( 'click', function() {
    $('.filters__item').removeClass('filters__item--checked');
    $(this).addClass('filters__item--checked');
  });
  $('.upper__link--mention').click(function () {
    $('.modal-bg,.modal-body').toggleClass('show');
    setTimeout(function () {
      $('.modal-body,.modal-bg').toggleClass('reveal')
    }, 10);
  })
  $('.modal-bg, .modal-body__exit').click(function () {
    closeModal();
  })
  $(document).on('keydown',function (ev) {
    var key = ev.keyCode || ev.which;
    if(key==27) {
      closeModal();
    }
  })
})

$(function() {
  $('.gallery__list').mixitup({
    targetSelector: '.gallery__wrapper',
    filterSelector: '.filters__item',
    effects: ['fade'],
    easing: 'snap'
  });
})
