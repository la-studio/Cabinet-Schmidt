
$(document).ready(function () {
  function closeModal() {
    $('.modal-bg').toggleClass('reveal');
    $('.modal-body').toggleClass('reveal');
    setTimeout(function () {
      $('.modal-bg, .modal-body').removeClass('show');
    }, 500);
  }
  var isSafari = navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;

  if(isSafari){
    $('.agenda-datepicker').hide();
    $('.agenda-text').addClass('agenda-text--full');
  }

  function GetIEVersion() {
    var sAgent = window.navigator.userAgent;
    var Idx = sAgent.indexOf("MSIE");

    // If IE, return version number.
    if (Idx > 0) 
      return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

    // If IE 11 then look for Updated user agent string.
    else if (!!navigator.userAgent.match(/Trident\/7\./)) 
      return 11;

    else
      return 0; //It is not IE
  }

  if (GetIEVersion() > 0){ //if some form of IE
    $('.home__contact, .home__contact .row').addClass("ie-minheight");
    $('.home__contact .contact-wrapper').addClass("ie-verticalalign ie-spacearound");
    $('.home__contact .contact-item').addClass("ie-flex20");

    $('.services article').addClass("ie-flex40");

    $('footer').addClass("ie-verticalalign ie-minheight");
    $('.footer__socials .col-xs').addClass("ie-flex20");

    $('.link .link__label, .link .link__logo').addClass("ie-flex20");
  }
  
  var optionsSlider = {
      pagination: '.swiper-pagination',
      paginationClickable: true,
      grabCursor: true,
      autoplay: 7000,
      loop: true,
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev'
    }
    var optionsSlider2 = {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        grabCursor: true,
        autoplay: 7000,
        loop: true,
        slidesPerView: 2
      }
      var optionsSlider3 = {
          pagination: '.swiper-pagination',
          paginationClickable: true,
          grabCursor: true,
          autoplay: 7000,
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
    $(".input__field").not("#form-company").each(function() {
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
      //console.log(data);
      var options = {
        url : '/contact/send',
        type : 'post',
        data: data,
        success: function (response) {
          // var template = '<div class="success"><i class="material-icons">check_circle</i><span class="success__message">Le message a été envoyé avec succès !</span></div>';
          // $('.contact').append(template)
          $('.contact .success').addClass('success--is-displayed');
          $('.input').removeClass('input--filled');

          setTimeout(function () {
            $('.contact .success').addClass('success--is-visible');
          }, 10);
          setTimeout(function () {
            $('.contact .success').removeClass('success--is-visible');
            $('.contact .success').removeClass('success--is-displayed');
          }, 6000);
          $(".input__field").val('').removeClass('input__field--missing');
          //console.log(response);
        },
        error: function (xhr,status,error) {
          //console.log(xhr,error);
          $('.contact .fail').addClass('success--is-displayed');
          $('.input').removeClass('input--filled');

          setTimeout(function () {
            $('.contact .fail').addClass('success--is-visible');
          }, 10);
          setTimeout(function () {
            $('.contact .fail').removeClass('success--is-visible');
            $('.contact .fail').removeClass('success--is-displayed');
          }, 6000);
          $(".input__field").val('').removeClass('input__field--missing');
          //console.log(response);
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
    //filterSelector: '.filters__item',
    effects: ['fade'],
    easing: 'snap'
  });
})
