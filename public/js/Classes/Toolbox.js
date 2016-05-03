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
  this.widthTransition = 300;
  this.heightTransition = null;
  this.translateOffsets = {
    translateX: null,
    translateY: null
  }
  this.transition.timers = {
    transform : this.getTransitionTime('transform'),
    height: this.getTransitionTime('height')
  }
  this.clickListener()
  this.getTransitionTime();
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
    //TODO
  }
};

ToolBox.prototype.getTransitionTime = function (property) {
  var properties = this.el.css('transition');
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
};

ToolBox.prototype.open = function () {
  var that = this;
  this.enabled = true
  this.el.addClass('toolbox--open-x');
  setTimeout(function () {
    that.el.addClass('toolbox--open-y');
  },this.transition.timers.transform)
};

ToolBox.prototype.close = function () {
  var that = this;
  this.el.removeClass('toolbox--open-y');
  setTimeout(function () {
    that.el.removeClass('toolbox--open-x');
  },this.transition.timers.height)
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
