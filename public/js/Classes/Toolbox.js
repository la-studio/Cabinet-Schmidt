ToolBox = function () {
  this.enabled = null;
  this.selector = null;
  this.el = null;
  this.widthTransition = null;
  this.heightTransition = null;
  this.translateProperties = {};
  this.transition = {};
  this.init();
}

ToolBox.prototype.init = function () {
  this.enabled = false;
  this.selector = '.toolbox';
  this.el = $(this.selector);
  this.translateOffsets = {
    translateX: null,
    translateY: null
  }
  this.transition.timers = {
    transform : 300, // Fucking firefox fix, can't use my dynamic method to get the  transition value
    height: 500 // Fucking firefox fix, can't use my dynamic method to get the  transition value
  }
  this.clickListener()
};

ToolBox.prototype.getTransformTransitionOffset = function () {
  var properties = this.el.css('transform');
  if(properties.indexOf('matrix3d')==-1) { // making an result array for 2D transformations.
    properties = properties.substr(7);
    var lastIndex = properties.indexOf(')')
    properties = properties.substr(0,lastIndex);
    var splittedProperties = properties.split(',')
    var translateX = splittedProperties[4];
    var translateY = splittedProperties[5];
    this.translateOffsets.translateX = translateX+"px";
    this.translateOffsets.translateY = translateY+"px";
  } else {
    //TODO, for 3d transformations cases
  }
};

ToolBox.prototype.getTransitionTime = function (property) {
  var properties = this.el.css('transition') || this.el.css('-moz-transition')
  properties = properties.split(',')
  for (var i = 0; i < properties.length; i++) {
    if(properties[i].indexOf(property)!==-1) {
      var value = properties[i].split(' ')[2]
      if(value.indexOf('s')!==-1 && value.indexOf('ms')==-1) {
        var index = value.indexOf('s');
        var time = value.substr(0,index);
        time = time*1000;
        return time
      } else if(value.indexOf('ms')!==-1) {
        return time
      }
    }
  }
};

ToolBox.prototype.clickListener = function () {
  var that = this;
  this.el.click(function () {
    that.toggleState();
  });
  $('body >*:not(.toolbox)').click(function () {
    if(that.enabled) {
      that.close();
    }
  })
};

ToolBox.prototype.open = function () {
  var that = this;
  this.enabled = true;
  var transitionValue = this.transition.timers.transform;
  //console.log(this.transition.timers);
  this.el.addClass('toolbox--open-x');
  this.el.removeClass('toolbox--delay');
  setTimeout(function () {
    that.el.addClass('toolbox--open-y');
  },transitionValue)
};

ToolBox.prototype.close = function () {
  var that = this;
  var transitionValue = this.transition.timers.height;//Fix for firefox, setTimeout second argument uses window scope in Firefox.
  // console.log(transitionValue);
  //console.log(this);
  this.el.removeClass('toolbox--open-y');
  that.el.addClass('toolbox--delay');
  setTimeout(function () {
    that.el.removeClass('toolbox--open-x');
  },transitionValue)
  this.enabled = false
};

ToolBox.prototype.toggleState = function () {
  if(!this.enabled) {
    this.open()
  } else {
    this.close()
  }
};

cabinetTools = new ToolBox()
