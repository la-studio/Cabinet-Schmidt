
$(document).ready(function () {
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
        slidesPerView: 3,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
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
      if($('.swiper').length >0 && $('.slider').length >0) {
        var swiper = new Swiper('.swiper',optionsSlider);
        var swiper2 = new Swiper('#slider-partenaires',optionsSlider2);
        var swiper3 = new Swiper('#slider-temoignage',optionsSlider3);
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
  }) // end button click
})
