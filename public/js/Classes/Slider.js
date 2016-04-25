$(function() {
  Slider = function (selector,originalSlider) {
    this.element = $(selector);
    this.connection = originalSlider;
    this.slideClass = originalSlider.params.slideClass;
    this.slideActiveClass = originalSlider.params.slideActiveClass;
    this.activeSlide = originalSlider.params.slideVisibleClass;
    this.captionClass = '.slider-caption';
    this.speed = originalSlider.params.speed;
    // Initializing object when creating instance and storing object's scope
    that = this;
    this.init();
  }

  Slider.prototype.init = function () {
    this.connection.on('transitionEnd', function () {
      that.show();
    });
  };

  Slider.prototype.toggleClasses = function () {
    var activeClass = "."+this.slideActiveClass;
    var caption = this.captionClass; // dot is already in the property here.
    var currentCaption = $(activeClass).find(caption);
    var currentCaptionTitle = $(activeClass).find(caption+'__title');
    $(caption).removeClass('slider-caption--shown'); // removing class to other slider, to make the animation retrigger when going back to others slides
    currentCaption.addClass('slider-caption--shown');
    $(caption+'__title').removeClass('slider-caption__title--shown');
    currentCaptionTitle.addClass('slider-caption__title--shown');

  };

  Slider.prototype.show = function () {
    setTimeout(function () {
      that.toggleClasses();
    },this.speed - 190)
  };
});
