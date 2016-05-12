MouseAnimation = function () {
  this.classesList = {};
  this.init();
}

MouseAnimation.prototype.init = function () {
  this.classesList = {
    wheel: 'mousewheel',
    arrows: 'mouse-arrow'
  };
  this.anim();
};

MouseAnimation.prototype.anim = function () {
  var that = this;
  that.toggleClasses();
  setInterval(function () {
    that.toggleClasses();
  },3000)
};

MouseAnimation.prototype.toggleClasses = function () {
  var that = this;
  var wheel = $('.'+that.classesList.wheel);
  var arrows = $('.'+that.classesList.arrows);
  wheel.addClass(that.classesList.wheel+'--animated');
  setTimeout(function () {
    wheel.removeClass(that.classesList.wheel+'--animated');
  },2000)
  for (var i = 0; i < arrows.length; i++) { // animations for arrows.
    this.setTimer(i,arrows)
  }
};

MouseAnimation.prototype.setTimer = function (iteration,el) { // Otherwise can't access index in the loop using it in a setTimeout
  var that = this;
  setTimeout(function () {
    el.eq(iteration).addClass(that.classesList.arrows+'--show');
    setTimeout(function () {
      if(iteration==0) {
        el.eq(0).removeClass(that.classesList.arrows+'--show');
      } else {
        el.eq(iteration).removeClass(that.classesList.arrows+'--show');
      }
    },400 + iteration*30)
  },500 + iteration*50)
};

wheelAnim = new MouseAnimation();
