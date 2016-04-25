$(document).ready(function () {
  var swiper = new Swiper('.swiper', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        grabCursor: true,
        autoplay: 4000,
        loop: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });
  var sliderController = new Slider('.swiper',swiper); // Connecting Swiper to my object and initializing it.
  //Responsive menu switch on/off. No obj because way too simple.
  $('.responsive-menu').click(function () {
    $(this).toggleClass('responsive-menu--open');
    $('.header__secondary-nav').slideToggle('500');
    $('.responsive-menu__icons').toggleClass('responsive-menu__icons--open');
  })
})
