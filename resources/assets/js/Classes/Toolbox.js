ToolBox = function () {
  this.enabled = null;
  this.selector = null;
  this.el = null;
  this.init();
}

ToolBox.prototype.init = function () {
  this.enabled = false;
  this.selector = '.toolbox';
  this.el = $(this.selector);
  this.clickListener()
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
  this.el.addClass('toolbox--open');
};

ToolBox.prototype.close = function () {
  var that = this;
  this.el.removeClass('toolbox--open');
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
