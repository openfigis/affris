
var Runner={version:'2.0'};Runner.apply=function(obj,cfg,defaults){if(defaults){Runner.apply(obj,defaults);}
if(obj&&cfg&&typeof cfg=='object'){for(var prop in cfg){obj[prop]=cfg[prop];}}
return obj;};Runner.emptyFn=function(){};(function(){var idCounter=0;var zIndexMax=0;var userAgent=navigator.userAgent.toLowerCase();var isOpera=userAgent.indexOf("opera")>-1;var isIE=(!isOpera&&userAgent.indexOf("msie")>-1);var isIE7=(!isOpera&&userAgent.indexOf("msie 7")>-1);var isIE8=(!isOpera&&userAgent.indexOf("msie 8")>-1);var isChrome=userAgent.indexOf("chrome")>-1;var isSafari=(!isChrome&&(/webkit|khtml/).test(userAgent));var isSafari3=(isSafari&&userAgent.indexOf('webkit/5')!=-1);var isGecko=(!isSafari&&!isChrome&&userAgent.indexOf("gecko")>-1);var isGecko3=(isGecko&&userAgent.indexOf("rv:1.9")>-1);var isSecure=(window.location.href.toLowerCase().indexOf("https")===0);Runner.apply(Runner,{extend:function(){var overrideFunc=function(obj){for(var prop in obj){this[prop]=obj[prop];}};var baseObjConstr=Object.prototype.constructor;return function(subBase,supPar,overrides){if(typeof supPar=='object'){overrides=supPar;supPar=subBase;subBase=(overrides.constructor!=baseObjConstr)?overrides.constructor:function(){supPar.apply(this,arguments);};}
var F=function(){},subBaseProt,supParProt=supPar.prototype;F.prototype=supParProt;subBaseProt=subBase.prototype=new F();subBaseProt.constructor=subBase;subBase.superclass=supParProt;if(supParProt.constructor==baseObjConstr){supParProt.constructor=supPar;}
subBase.override=function(obj){Runner.override(subBase,obj);};subBaseProt.override=overrideFunc;Runner.override(subBase,overrides);subBase.extend=function(obj){Runner.extend(subBase,obj);};return subBase;};}(),override:function(origClass,overrides){if(overrides){var origProt=origClass.prototype;for(var method in overrides){origProt[method]=overrides[method];}
if(Runner.isIE&&overrides.toString!=origClass.toString){origProt.toString=overrides.toString;}}},getControl:function(rowId,fName){return Runner.controls.ControlManager.getAt(false,rowId,fName);},loadJS:function(src,onload,scope){scope=scope||this;var js=document.createElement('script');js.setAttribute('type','text/javascript');js.setAttribute('src',src);if(onload&&Runner.isIE){js.onreadystatechange=function(){if(js.readyState=='complete'||js.readyState=='loaded'){onload.call(scope);}};}else if(onload){js.onload=function(){onload.call(scope);}}
document.getElementsByTagName('HEAD')[0].appendChild(js);},htmlDecode:function(txt){txt=txt.replace(/&gt;/ig,"\>");txt=txt.replace(/&lt;/ig,"\<");txt=txt.replace(/&amp;/ig,"&");return txt;},namespace:function(name){var params=name.split('.'),current=Runner;for(var i=1;i<params.length;i++){if(!current[params[i]]){current[params[i]]={};}
current=current[params[i]];}
return current;},genId:function(pref){return++idCounter;},setIdCounter:function(num){if(typeof num!='number'){return false;}
idCounter+=++num;},getZindex:function(elObj){if(elObj){$(elObj).css("z-index",++zIndexMax);}
return zIndexMax;},setZindex:function(counter){if(zIndexMax<counter){zIndexMax=++counter;}},goodFieldName:function(fName){return fName.replace(/\W/g,'_');},getSearchController:function(id){return window['searchController'+id];},isArray:function(toCheck){return toCheck&&typeof toCheck.splice=='function'&&typeof toCheck.length=='number';},deepCopy:function(obj,cfg){if(cfg&&typeof cfg=='object'){for(var prop in cfg){if(typeof cfg[prop]=='object'&&!Runner.isArray(cfg[prop])){if(typeof obj[prop]!='object'){obj[prop]={};}
Runner.deepCopy(obj[prop],cfg[prop]);}else{obj[prop]=cfg[prop];}}}
return obj;},isOpera:isOpera,isGecko:isGecko,isGecko2:isGecko&&!isGecko3,isGecko3:isGecko3,isSafari:isSafari,isSafari3:isSafari3,isSafari2:isSafari&&!isSafari3,isIE:isIE,isIE6:isIE&&!isIE7&&!isIE8,isIE7:isIE7,isIE8:isIE8,isChrome:isChrome,isSecure:isSecure,debugMode:false});Runner.ns=Runner.namespace;})();Runner.namespace('Runner.controls');Runner.namespace('Runner.search');String.prototype.entityify=function(){return this.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace('"','&quot;');};String.prototype.quote=function(){return this.replace("\\","\\\\").replace("'","\\'");};String.prototype.xTempl=function(o){return this.replace(/{([^{}]*)}/g,function(a,b){var r=o[b];return typeof r==='string'||typeof r==='number'?r:a;});};String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"");};String.prototype.slashdecode=function(){var out='';var pos=0;for(var i=0;i<this.length-1;i++)
{var c=this.charAt(i);if(c=='\\')
{out+=this.substr(pos,i-pos);pos=i+2;var c1=this.charAt(i+1);i++;if(c1=='\\'){out+="\\";}else if(c1=='r'){out+="\r";}else if(c1=='n'){out+="\n";}else{i--;pos-=2;}}}
if(pos<this.length)
out+=this.substr(pos);return out;};Array.prototype.isInArray=function(value,caseSensitive){for(var i=0;i<this.length;i++){if(caseSensitive){if(this[i]==value){return true;}}else{if(this[i].toString().toLowerCase()==value.toString().toLowerCase()){return true;}}}
return false;};Array.prototype.countElems=function(value,caseSensitive){var count=0;for(var i=0;i<this.length;i++){if(caseSensitive){if(this[i]==value){count++;}}else{if(this[i].toString().toLowerCase()==value.toString().toLowerCase()){count++;}}}
return count;};Array.prototype.getIndexOfElem=function(value,callBack,caseSensitive){for(var i=0;i<this.length;i++){if(callBack){if(callBack(value,this[i])){return i;}}else if(caseSensitive){if(this[i]==value){return i;}}else{if(this[i].toString().toLowerCase()==value.toString().toLowerCase()){return i;}}}
return-1;};Array.prototype.removeElem=function(value,callBack,caseSensitive){for(var i=0;i<this.length;i++){if(callBack){if(callBack(value,this[i])){this.splice(i,1);return this;}}else if(caseSensitive){if(this[i]==value){this.splice(i,1);return this;}}else{if(this[i].toString().toLowerCase()==value.toString().toLowerCase()){this.splice(i,1);return this;}}}
return this;};Array.prototype.copy=function(){var copy=[];for(var i=0;i<this.length;i++){copy[i]=this[i];}
return copy;};Runner.apply(Function.prototype,{createCallback:function(){var args=arguments;var func=this;return function(){return func.apply(window,args);};},createDelegate:function(obj,args,appendArgs){var func=this;return function(){var callArgs=args||arguments;if(appendArgs===true){callArgs=Array.prototype.slice.call(arguments,0);callArgs=callArgs.concat(args);}else if(typeof appendArgs=="number"){callArgs=Array.prototype.slice.call(arguments,0);var applyArgs=[appendArgs,0].concat(args);Array.prototype.splice.apply(callArgs,applyArgs);}
return func.apply(obj||window,callArgs);};}});Runner.namespace('Runner.util');(function(){var createDelayed=function(hn,obj,scope){return function(){var argsArr=Array.prototype.slice.call(arguments,0);setTimeout(function(){hn.apply(scope,argsArr);},obj.delay||10);};};var createSingle=function(hn,e,fn,scope){return function(){e.removeListener(fn,scope);return hn.apply(scope,arguments);};};var createBuffered=function(hn,obj,scope){var task=new Runner.util.DelayedTask();return function(){task.delay(obj.buffer,hn,scope,Array.prototype.slice.call(arguments,0));};};Runner.util.Event=function(obj,name){this.name=name;this.obj=obj;this.listeners=[];};Runner.util.Event.prototype={createListener:function(fn,scope,obj){obj=obj||{};scope=scope||this.obj;var ls={fn:fn,scope:scope,options:obj};var hn=fn;if(obj.delay){hn=createDelayed(hn,obj,scope);}
if(obj.single){hn=createSingle(hn,this,fn,scope);}
if(obj.buffer){hn=createBuffered(hn,obj,scope);}
ls.fireFn=hn;return ls;},getListenerIndex:function(fn,scope){scope=scope||this.obj;var length=this.listeners.length,ls;for(var i=0;i<length;i++){ls=this.listeners[i];if(ls.fn==fn&&ls.scope==scope){return i;}}
return-1;},fire:function(){var scope,ls,length=this.listeners.length;if(length>0){this.firing=true;var argsArr=Array.prototype.slice.call(arguments,0);for(var i=0;i<length;i++){ls=this.listeners[i];if(ls.fireFn.apply(ls.scope||this.obj||window,arguments)===false){this.firing=false;return false;}}
this.firing=false;}
return true;},on:function(fn,scope,options){scope=scope||this.obj;if(!this.isListening(fn,scope)){ls=this.createListener(fn,scope,options);if(!this.firing){this.listeners.push(ls);}else{this.listeners=this.listeners.slice(0);this.listeners.push(ls);}}},isListening:function(fn,scope){return this.getListenerIndex(fn,scope)!=-1;},removeListener:function(fn,scope){var index;if((index=this.getListenerIndex(fn,scope))!=-1){if(!this.firing){this.listeners.splice(index,1);}else{this.listeners=this.listeners.slice(0);this.listeners.splice(index,1);}
return true;}
return false;},clearListeners:function(){this.listeners=[];}};})();Runner.util.Observable=Runner.extend(Runner.emptyFn,{filterOptRe:/^(?:scope|delay|buffer|single)$/,addEvents:function(obj){if(!this.events){this.events={};}
if(typeof obj=='string'){for(var i=0,a=arguments,v;v=a[i];i++){if(!this.events[a[i]]){this.events[a[i]]=true;}}}else{Runner.apply(this.events,obj);}},fireEvent:function(){if(this.eventsSuspended!==true){var ce=this.events[arguments[0].toLowerCase()];if(typeof ce=="object"){return ce.fire.apply(ce,Array.prototype.slice.call(arguments,1));}}
return true;},on:function(evName,fn,scope,obj){if(typeof evName=="object"){obj=evName;for(var event in obj){if(this.filterOptRe.test(event)){continue;}
if(typeof obj[event]=="function"){this.on(event,obj[event],obj.scope,obj);}else{this.on(event,obj[event].fn,obj[event].scope,obj[event]);}}
return;}
obj=(!obj||typeof obj=="boolean")?{}:obj;evName=evName.toLowerCase();var ce=this.events[evName]||true;if(typeof ce=="boolean"){ce=new Runner.util.Event(this,evName);this.events[evName]=ce;}
ce.on(fn,scope,obj);},un:function(evName,fn,scope){var ce=this.events[evName.toLowerCase()];if(typeof ce=="object"){ce.removeListener(fn,scope);}},purgeListeners:function(){for(var event in this.events){if(typeof this.events[event]=="object"){this.events[event].clearListeners();}}},suspendEvents:function(){this.eventsSuspended=true;},resumeEvents:function(){this.eventsSuspended=false;}});Runner.namespace('Runner.util');Runner.util.DelayedTask=function(fn,scope,args){var id=null,delay,time;var call=function(){var now=new Date().getTime();if(now-time>=delay){clearInterval(id);id=null;fn.apply(scope,args||[]);}};this.delay=function(newDelay,newFn,newScope,newArgs){if(id&&delay!=newDelay){this.cancel();}
delay=newDelay;time=new Date().getTime();fn=newFn||fn;scope=newScope||scope;args=newArgs||args;if(!id){id=setInterval(call,delay);}};this.cancel=function(){if(id){clearInterval(id);id=null;}};};Runner.util.ScriptLoader=Runner.extend(Runner.util.Observable,{cssFiles:[],jsFiles:[],constructor:function(cfg){Runner.util.ScriptLoader.superclass.constructor.call(this,cfg);this.addEvents('filesLoaded');this.on('filesLoaded',function(){if(Runner.pages){Runner.pages.PageManager.initPages();}},this,{single:true});},addJS:function(files){var isAdded=false;for(var i=0;i<files.length;i++){for(var j=0;j<this.jsFiles.length;j++){if(this.jsFiles[j].name==files[i]){isAdded=true;break;}}
if(!isAdded){this.jsFiles.push({name:files[i],isLoaded:false,requirements:Array.prototype.slice.call(arguments,1)});}
isAdded=false;}},loadCSS:function(files){for(var i=0;i<files.length;i++){var idx=this.cssFiles.getIndexOfElem(files[i],function(val,arrElem){if(val==arrElem.name){return true;}});if(idx!=-1&&this.cssFiles[idx].isLoaded){continue;}
this.cssFiles.push({name:files[i],isLoaded:true})
var head=$(document).find('head')[0];var css=document.createElement('link');css.setAttribute('rel','stylesheet');css.setAttribute('type','text/css');css.setAttribute('href',files[i]+".css");head.appendChild(css);}},load:function(){for(var i=0;i<this.jsFiles.length;i++){this.loadJS(i);}},loadJS:function(idx){if(!this.jsFiles[idx]){return false;}
if(this.jsFiles[idx].isLoaded){this.postLoad(idx);return true;}
if(!this.checkReq(this.jsFiles[idx])){return false;}
if(this.jsFiles[idx].isStarted){return false;}
this.jsFiles[idx].isStarted=true;var js=document.createElement('script');js.setAttribute('type','text/javascript');js.setAttribute('src',this.jsFiles[idx].name);var sl=this;if(Runner.isIE){js.onreadystatechange=function(){if(js.readyState=='complete'||js.readyState=='loaded'){sl.postLoad(idx);}};}else{js.onload=function(){sl.postLoad(idx);};}
document.getElementsByTagName('HEAD')[0].appendChild(js);return true;},checkReq:function(fileObj){for(var i=0;i<fileObj.requirements.length;i++){for(var j=0;j<this.jsFiles.length;j++){if(fileObj.requirements[i]==this.jsFiles[j].name&&!this.jsFiles[j].isLoaded){return false;}}}
return true;},postLoad:function(idx){this.jsFiles[idx].isLoaded=true;this.loadDependent(idx);var loadedAll=true;for(var i=0;i<this.jsFiles.length;i++){if(!this.jsFiles[i].isLoaded){loadedAll=false;break;}}
if(loadedAll){this.fireEvent('filesLoaded');}},loadDependent:function(idx){for(var i=0;i<this.jsFiles.length;i++){for(var j=0;j<this.jsFiles[i].requirements.length;j++){if(i!=idx&&this.jsFiles[i].requirements[j]==this.jsFiles[idx].name){this.loadJS(i);}}}}});Runner.util.ScriptLoader=new Runner.util.ScriptLoader();Runner.namespace('Runner.util.IEHelper');Runner.util.IEHelper.iframe=function(cfg){var cfg=cfg||{},id;if(cfg.constructor===Object){cfg.w=cfg.w||0,cfg.h=cfg.h||0,cfg.t=cfg.t||0,cfg.l=cfg.l||0,id=cfg.id||Runner.genId();}else{var el=cfg;id=Runner.genId();}
var iframe=$('#'+id);if(!iframe.length){$(document).find('body').append('<iframe src="javascript:false;" id="'+id+'" frameborder="1" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="background:white;position:absolute;display:block;opacity:0;filter:alpha(opacity=0);"></iframe>');iframe=$('#'+id);}
var iframeObj={move:function(t,l){if(t!==undefined&&l!==undefined){iframe.css('top',t+'px').css('left',l+'px');}
return this;},destroy:function(){iframe.remove();return this;},resize:function(w,h){if(w!==undefined&&h!==undefined){iframe.css('height',h).css('width',w);}
return this;},hide:function(){iframe.hide();return this;},show:function(){iframe.show();return this;},reset:function(coors){coors=coors||this.getPos()||cfg;this.move(coors.t,coors.l).resize(coors.w,coors.h).show();Runner.getZindex(iframe);return this;},getPos:function(){if(!el){this.getPos=function(){return false;}}else{this.getPos=function(){var posObj=getAbsolutePosition(el),coors={};coors.w=el.offsetWidth,coors.h=el.offsetHeight,coors.t=posObj.t,coors.l=posObj.l;return coors;}}
this.getPos();}}
return iframeObj.reset();}
Runner.util.IEHelper.selectsHider=function(el){var selToHide=[],elem=el;return{checkIntersection:function(selCoors,elCoors){if((Math.abs((elCoors.x-selCoors.x))<=(elCoors.w+selCoors.w)/2)&&(Math.abs((elCoors.y-selCoors.y))<=(elCoors.h+selCoors.h)/2)){return true;}},getCenter:function(coors){coors.x=coors.l+coors.w/2;coors.y=coors.t+coors.h/2;return coors;},hideSels:function(){for(var i=0;i<selToHide.length;i++){$(selToHide[i]).hide();}
return this;},showSels:function(){for(var i=0;i<selToHide.length;i++){$(selToHide[i]).show();}
return this;},getSelects:function(elPos){var elCoors=elPos||{},selToCheck=$('select');selToHide=[];if(!elPos){var pos=findPos(el);elCoors.l=pos[0];elCoors.t=pos[1];elCoors.w=el.offsetWidth;elCoors.h=el.offsetHeight;}
elCoors=this.getCenter(elCoors);var coors={};for(var i=0;i<selToCheck.length;i++){pos=findPos(selToCheck[i]);coors.l=pos[0];coors.t=pos[1];coors.w=selToCheck[i].offsetWidth;coors.h=selToCheck[i].offsetHeight;coors=this.getCenter(coors);if(this.checkIntersection(coors,elCoors)){selToHide.push(selToCheck[i]);}}
return selToHide;}}}