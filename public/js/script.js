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
        spaceBetween: 50,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
      }
  var swiper = new Swiper('.swiper',optionsSlider);
  var swiper2 = new Swiper('.slider',optionsSlider)
  var sliderController = new Slider('.swiper',swiper); // Connecting Swiper to my object and initializing it.
  //Responsive menu switch on/off. No obj because way too simple.
  $('.responsive-menu').click(function () {
    $(this).toggleClass('responsive-menu--open');
    $('.header__secondary-nav').slideToggle('500');
    $('.responsive-menu__icons').toggleClass('responsive-menu__icons--open');
  })
})
