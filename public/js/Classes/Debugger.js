Debugger = function (Scope) {
  this.listProperties = [];
  this.params = {};
  this.parentScope = Scope;
  this.enabled = null;
  that = this
  this.init();
}

Debugger.prototype.init = function () {
  this.defaults = {
    excludedListProperties : ['debug','listProperties']
  };
  this.createMissing();
  that.setDebugInfos();
  this.enableKeyListener();
}

Debugger.prototype.enableKeyListener = function () {
  var that = this;
    var keyword = null;
    $(document).on('keypress',function (event) {
      var key = event.which || event.keyCode;
      if(key==100 && keyword==null) { // d
        keyword = "d"
      }
      if(key==101 && keyword == "d") { // e
        keyword = keyword + "e"
      }
      if(key==98 && keyword == "de") { // b
        keyword = keyword + "b"
      }
      if(key==117 && keyword == "deb") { // u
        keyword = keyword + "u"
      }
      if(key==103 && keyword == "debu") { // g
        keyword = keyword + "g"
      }
      if(key==13 && keyword=="debug") { // 13 is enter
        that.setScopeDebug(true)
        if(that.parentScope.debug) {
          //console.log('Debug mode activated !')
        } else {
          //console.log('Debug mode Failed !')
        }
      }
    })
}

Debugger.prototype.setScopeDebug = function (state) {
  this.parentScope.debug = state
  this.enabled = this.parentScope.debug // I set it here because if it does at init the value doesn't change and some functions can"t execute
};

Debugger.prototype.getScopeDebug = function () {
  return this.parentScope.debug
};

Debugger.prototype.excludeProperties = function (listArray,exclusionsArray) {
  exclusions = exclusionsArray || this.defaults.excludedListProperties;
  for (var i = 0; i < exclusions.length; i++) {
    for (var i = 0; i < listArray.length; i++) {
      var toDeleteIndex = listArray.indexOf(exclusions[i]);
      if(listArray.indexOf(exclusions[i])!=-1) {
        listArray.splice(toDeleteIndex,1)
      }
    }
  }
  return listArray
};

Debugger.prototype.getListProperties = function (properties) {
  var list = [];
  for (var key in properties) {
    if (properties.hasOwnProperty(key)) {
       list.push(key);
    }
  }
  return list;
}

Debugger.prototype.setDebugInfos = function () {
  var obj = Object.getPrototypeOf(this.parentScope)
  this.listProperties = this.getListProperties(obj);
}


Debugger.prototype.createMissing = function () {
  if(this.parentScope.sentencesDebugList === undefined) {
    this.parentScope.sentencesDebugList = {};
  }
  if(this.parentScope.debug === undefined) {
    this.parentScope.debug = null;
  }
};

Debugger.prototype.addMessage = function (method,sentence,position) {
  var newItem = {title: sentence, placement: position }
  if(this.checkMessage(method,sentence)) {
    if(this.parentScope.sentencesDebugList[method]===undefined) {
      this.parentScope.sentencesDebugList[method] = []
    }
    this.parentScope.sentencesDebugList[method].push(newItem);
  }
};

Debugger.prototype.checkMessage = function (method,sentence) {
  if(method===undefined) {
    //console.log("La phrase de debug '"+sentence+"' ne peut pas être ajoutée car la méthode cible n'est pas spécifiée dans la fonction !");
    return false
  } else if(typeof method==="string") {
    if(this.listProperties.indexOf(method)==-1) {
      //console.log("La phrase de debug '"+sentence+"' ne peut pas être ajoutée car la méthode cible ne fait pas partie des méthodes de l'objet !");
      return false
    } else {
      return true
    }
  }
};

Debugger.prototype.callSentences = function (method) {
  return this.parentScope.sentencesDebugList[method]
};

Debugger.prototype.logInfos = function (sentences,method,args) {
  if(this.enabled && sentences.length > 0) {
    for (var i = 0; i < args.length; i++) {
      if(sentences[i].placement=="end") {
        //console.log(sentences[i].title+' '+args[i]);
      } else if(sentences[i].placement=="start") {
        //console.log(args[i]+' '+sentences[i].title);
      }
    }
  }
};

Debugger.prototype.debug = function (method,...args) {
  var $sentences = this.callSentences(method);
  this.logInfos($sentences,method,args)
};
