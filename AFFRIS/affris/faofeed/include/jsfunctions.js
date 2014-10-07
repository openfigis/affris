var jsfunctions_included=true;
var flyid=1;
var cookieRoot = "";

/**
 * Cross browser element left absolute coordinate
 * @param {DOM element} eElement
 */
function DL_GetElementLeft(eElement){
	
   if (!eElement && this)                    // if argument is invalid
   {                                         // (not specified, is null or is 0)
      eElement = this;
	                        // and function is a method
   }
	
   var DL_bIE = document.all ? true : false; // initialize var to identify IE

   var nLeftPos = eElement.offsetLeft;       // initialize var to store calculations
   var eParElement = eElement.offsetParent;  // identify first offset parent element

   while (eParElement != null)
   {                                         // move up through element hierarchy
      if(DL_bIE){
         if(eParElement.tagName == "TD")     // if parent a table cell, then...
         {
            nLeftPos += eParElement.clientLeft; // append cell border width to calcs
         }
      }

      nLeftPos += eParElement.offsetLeft;    // append left offset of parent
      eParElement = eParElement.offsetParent; // and move up the element hierarchy

   }                                         // until no more offset parents exist
   return nLeftPos;                          // return the number calculated
}
/**
 * Cross browser element top absolute coordinate
 * @param {DOM element} eElement
 */
function DL_GetElementTop(eElement)
{
	
   if (!eElement && this)                    // if argument is invalid
   {                                         // (not specified, is null or is 0)
      eElement = this;                         // and function is a method
   }                                // identify the element as the method owner

   var DL_bIE = document.all ? true : false; // initialize var to identify IE

   var nTopPos = eElement.offsetTop;       // initialize var to store calculations
   var eParElement = eElement.offsetParent;  // identify first offset parent element

   while (eParElement != null)
   {                                         // move up through element hierarchy
      if(DL_bIE)
      {
         if(eParElement.tagName == "TD")     // if parent a table cell, then...
         {
            nTopPos += eParElement.clientTop; // append cell border width to calcs
         }
      }

      nTopPos += eParElement.offsetTop;    // append top offset of parent
      eParElement = eParElement.offsetParent; // and move up the element hierarchy

   }                                         // until no more offset parents exist
   return nTopPos;                          // return the number calculated
}

/**
 * Get client viewport dimensions
 */
function getWindowDimensions() 
{
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) 
  {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  return [ myWidth, myHeight ];
}

/**
 * Gets cross browser window scrolling
 */
function getScrollXY() {
  var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
    scrOfX = window.pageXOffset;
  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
    scrOfX = document.body.scrollLeft;
  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
    scrOfX = document.documentElement.scrollLeft;
  }
  return [ scrOfX, scrOfY ];
}


/**
 * reset RTE fields
 */
function resetEditors(){
	for (rteInd in window.rteIdArr){
		var rte = window.rteIdArr[rteInd];
		
		if (rte[0] == 'INNOVA'){
			resetInnova(rte[1]);
		}else if(rte[0] == 'FCK'){
			resetFCKE(rte[1]);
		}
	}
}
/**
 * Reseting changes for Innova editor
 * @param {string} id
 */
function resetInnova(id){
	
	var textAreaIdHead = 'value_';
	var iframeIdHead = 'idContentoEdit';
	
	// main iframe of the control have the same id
	var textAreaId = textAreaIdHead+id;
	var iframeId = iframeIdHead+id;
	// value of textarea - default value
	var textAreaVal = $('#'+textAreaId).contents().find('#'+textAreaId).val();	
	var iframeBody = $('#'+textAreaId).contents().find('#'+iframeId).contents().find('body');
	//reseting changes
	iframeBody.text(textAreaVal);
}
/**
 * Reseting changes for FCK editor
 * @param {string} id
 */
function resetFCKE(id){
	var inputHiddenHead = 'value_';
	var iframeIdHead = 'value_';
	var iframeIdTail = '___Frame';
	// inputHiddenId - id of DOM element which stored default value
	var inputHiddenId = inputHiddenHead+id;
	var iframeId = iframeIdHead+id+iframeIdTail;
	// value of inputHidden - default value
	var inputHiddenVal = $('#'+inputHiddenId).val();
	var iframeBody = $('#'+iframeId).contents().find('body').find('iframe').contents().find('body');
	//reseting changes
	iframeBody.text(inputHiddenVal);
}


function findCookieRoot()
{
	var cutFrom = document.location['pathname'].indexOf('/', 1);
	cookieRoot = document.location['pathname'].substr(0,(cutFrom+1));
}

// add opened menu id to cookie
function addOpenMenuItemIdToCookie(menuItemId)
{
	var openMenuItemIds = get_cookie('openMenuItemIds');
	if (openMenuItemIds)
	{
		if (openMenuItemIds.indexOf(menuItemId) == -1)
			openMenuItemIds += ";"+menuItemId;	
				
	}
	else
		openMenuItemIds = menuItemId;
	set_cookie('openMenuItemIds', openMenuItemIds, '', cookieRoot, '', '' );
	toggleExpandCollapse();
}
// remove opened menu id from cookie
function removeOpenMenuFromCookie(menuItemId)
{
	var openMenuItemIds = get_cookie('openMenuItemIds');
	if (openMenuItemIds)
	{
		openMenuItemIds = openMenuItemIds.replace((";"+menuItemId), "");
		openMenuItemIds = openMenuItemIds.replace(menuItemId, "");
		if(openMenuItemIds.indexOf(';')==0)
			openMenuItemIds = openMenuItemIds.substr(1,openMenuItemIds.length);
		set_cookie('openMenuItemIds', openMenuItemIds, '', cookieRoot, '', '' );
	}
	setTimeout("toggleExpandCollapse()",500);
}

// expand/collapse button control
function toggleExpandCollapse()
{
	var visibleLength = $("#mainmenu_block").find("ul[@id^=u]:visible").length,
	hiddenLength = $("#mainmenu_block").find("ul[@id^=u]:hidden").length;
	if (visibleLength == 0 && hiddenLength > 0 && $("img.pmimg").attr("src")=="include/img/plus.gif")
	{
		$('a.plus_minus').empty();
		$('img.pmimg').attr('src','include/img/plus.gif');
		$('a.plus_minus').append('<img src=\"include/img/plus.gif\" border=0> &nbsp;&nbsp;'+TEXT_EXPAND_ALL);	
	}
	else if (visibleLength != 0 && hiddenLength == 0 && $("img.pmimg").attr("src")=="include/img/minus.gif")
	{
		$('a.plus_minus').empty();
		$('img.pmimg').attr('src','include/img/minus.gif');
		$('a.plus_minus').append('<img src=\"include/img/minus.gif\" border=0> &nbsp;&nbsp;'+TEXT_COLLAPSE_ALL);
	}
}

// open menus on page load
function openMenuItemsOnLoad()
{
	findCookieRoot();
	var openMenuItemIds = get_cookie('openMenuItemIds');
	if (openMenuItemIds) 
	{
		var itemForOpenArr = openMenuItemIds.split(";");
		for (var i = 0; i < itemForOpenArr.length; i++) 
		{
			var itemId = itemForOpenArr[i];
			// show sometimes conficts with slideDown in Vmenu2()
			$("#"+itemId).slideDown(1);
			var par = $("#"+itemId).parent();
			var parc = $('a.current').parent();
			if($('a.current',par).length && $(par).attr('id')!=$(parc).attr('id'))
				$(par).find('a:first').css('color',window.colorlink);
			$(par).find('img:first').attr("src", "include/img/minus.gif");		
		}
	}
	toggleExpandCollapse();
}

//	For vertical menu on page
function Vmenu1()
{
	$('.Vmenu1 ul li').hover(
	function()
	{
		flag=1;
		var left=1;
		if($(this).attr('class')!='hr')
			$(this).addClass('menu_active');
		ul = $(this).find('ul:first:has(li)');
		if($(ul).length)
		{
			$(ul).css('display','block');
			window.Max=$(this)[0].offsetWidth;
			$(ul).css('left',''+(window.Max-10)+'px');
			if(IsIE6())
				left=-8;
			$(ul).dropShadow({left: left, top: 2, blur: 2, opacity: 0.4})
			setTimeout('if(flag) $(ul).redrawShadow()',150);
			if(IsIE6())
				addiframe($(this));
		}
	},
	function()
	{            
		flag=0;
		if($(this).attr('class')!='hr')
			$(this).removeClass('menu_active'); 
		ul = $(this).find('ul:first:has(li)');
		if($(ul).length)
		{
			$(ul).css('display','none'); 
			$(ul).removeShadow();
			var id = $(this).attr('id');
			id = id.substr(2);
			if($('#ul'+id).length)
				$("#frame_menu"+id).remove();
		}
	});    
	$('.Vmenu1 li:has(ul:has(li))').find('a:first').each(function()
	{
		if(!$('b',this).length)
		{
			$(this).after('<b class="bmenu bmenu_simple">&nbsp;&raquo;</b>');
			$("b.bmenu_simple").css("color",$(this).css("color"));
		}	
	});
	$('.Vmenu1 li[@view=topitem]:has(ul:has(a.current))').find("b:first").append("&nbsp;<b class='bmenu_current'>"+$("a.current").attr('title')+"</b>");
	$("b.bmenu_current").css("color",$("a.current").css("color"));
	$('.Vmenu1 ul li ul').addClass('submenu');
}
//	For vertical tree-like menu on page
function Vmenu2()
{
	window.colorlink = $("a.tablelinkssearch").css("color");
	$('.Vmenu2 ul li a').hover(
	function()
	{
		if($(this).parent().attr('class')!='hr')
			$(this).addClass('menu_active');
	},
	function()
	{
		if($(this).parent().attr('class')!='hr')
			$(this).removeClass('menu_active'); 
	}); 
	$('.Vmenu2 ul li ul').hide();
	$('li[@view=topitem]:has(ul:has(a.current))').find('a:first').css('color',$("a.current").css("color"));
	$('.Vmenu2 ul li:has(ul) span').bind('click',function()
	{
		var par = $(this).parent();
		var parc = $('a.current').parent();
		$(par).find('ul:first').slideToggle(); 
		if ($(this).find('img.pmimg').attr('src') == 'include/img/plus.gif') 
		{
			// add to cookie opened menu
			addOpenMenuItemIdToCookie($(par).find('ul:first').attr("id"));
			$(this).find('img.pmimg').attr('src', 'include/img/minus.gif');
			if($('a.current',par).length && $(par).attr('id')!=$(parc).attr('id'))
				$(par).find('a:first').css('color',window.colorlink);
			$(par).find('ul:has(a.current)').each(function(parc)
			{
				$(this).parent().find('img.pmimg:first').attr('src','include/img/minus.gif');
				if($('a.current',this).length && $(this).parent().attr('id')!=$(parc).attr('id'))
					$(this).parent().find('a:first').css('color',window.colorlink);
				addOpenMenuItemIdToCookie($(this).attr("id"));
				$(this).slideDown();
			});
		}
		else{
				// remove from cookie opened menu
				removeOpenMenuFromCookie($(par).find('ul:first').attr("id"));
				// remove all children from cookie
				$(par).find('ul').each(function()
				{
					removeOpenMenuFromCookie($(this).attr("id"));
				});
				$(this).find('img.pmimg').attr('src', 'include/img/plus.gif');
				if($('a.current',par).length && $(par).attr('id')!=$(parc).attr('id'))
					$(par).find('a:first').css('color',$("a.current").css("color"));
			}
		return false;
	});
	if($('.Vmenu2 li[@view=topitem]:has(ul)').length && $('.Vmenu2 ul:first').length)
	{
		$('.Vmenu2_links').css('display','block');
		$('a.plus_minus').click(function()
		{
		   if(flag)
		   {
				$(this).parent().parent().find('ul li ul').slideUp('slow');
				$('a.plus_minus').empty();
				$('img.pmimg').attr('src','include/img/plus.gif');
				$('a.plus_minus').append('<img src=\"include/img/plus.gif\" border=0> &nbsp;&nbsp;'+TEXT_EXPAND_ALL);
				flag = 0;
				// on collapse all, remove all ids from cookie
				delete_cookie('openMenuItemIds', cookieRoot, '');
				$(this).parent().parent().find('li:has(ul:has(a.current))').each(function()
				{
					$(this).find('a:first').css('color',$("a.current").css("color"));
				});
			}
		   else{
					$(this).parent().parent().find('ul li ul').slideDown('slow');
					$('a.plus_minus').empty();
					$('img.pmimg').attr('src','include/img/minus.gif');
					$('a.plus_minus').append('<img src=\"include/img/minus.gif\" border=0> &nbsp;&nbsp;'+TEXT_COLLAPSE_ALL);
					flag = 1;
					// on expand all add all ids to cookie
					$(this).parent().parent().find('ul li ul').each(function()
					{									
						addOpenMenuItemIdToCookie($(this).attr("id"));	
					});
					$(this).parent().parent().find('li:has(ul:has(a.current))').each(function()
					{
						$(this).find('a:first').css('color',window.colorlink);
					});	
				}
			return false; 
		});
	}	
	if($.browser.msie)
		$('.Vmenu2 ul li').css('padding','5px 0');	
}
//	For gorizonal menu on page	
function Gmenu()
{
	window.Max=0; 
	window.UlMax=0;
	window.LiMax=0;
	window.first=0;
	$('.Gmenu ul li').hover(
	function()
	{
		flag=1;
		if(!$(this).find('.main_item').length && $(this).attr('class')!='hr')
			$(this).addClass('menu_active');
		ul = $(this).find('ul:first:has(li)');
		if($(ul).length)
		{
			window.UlMax=0;
			if($(this).attr('view')=='topitem')
			{
				el = getAbsolutePosition(this,1);
				window.LiMax=el.w;
				window.first=0;
			}
			$(ul).css('display','block');
			$(ul).find('li[@parent='+($(ul).attr('id'))+'] a').each(function()
			{
				if(window.UlMax<$(this)[0].offsetWidth)
					window.UlMax=$(this)[0].offsetWidth
			});
			if(!window.first && window.UlMax < window.LiMax)
				window.Max=window.LiMax;
			else
				window.Max=window.UlMax;
			window.Max = window.Max+20;	
			$(ul).css('width',''+window.Max+'px');
			if(!window.first)
			{
				$(ul).css('left',''+el.l+'px');
				$(ul).css('top',''+(el.t+el.h-1)+'px');
			}
			else
				$(ul).css('top',''+$(this)[0].offsetTop+'px');
			$(ul).find('li[@parent='+($(ul).attr('id'))+']').each(function()
			{
				$(this).css('width',''+window.Max+'px');
				$(this).find('ul:first').css('left',''+window.Max+'px');
			});
			window.first=1;
			$(ul).dropShadow({left: 1, top: 2, blur: 2, opacity: 0.4});
			setTimeout('if(flag) $(ul).redrawShadow()',150);
			if(IsIE6())
				addiframe($(this));
		}	
	},
	function() 
	{
		flag=0;
		if(!$(this).find('.main_item').length && $(this).attr('class')!='hr')
			$(this).removeClass('menu_active'); 
		$(this).find('ul:first').css('display','none'); 
		$(this).find('ul:first').removeShadow();
		var id = $(this).attr('id');
		id = id.substr(2);
		if($('#ul'+id).length)
			$("#frame_menu"+id).remove();
	});	
	$('.Gmenu li:has(ul:has(li))').find('a:first').each(function()
	{
		if(!$('b',this).length)
		{	
			$(this).after('<b class="bmenu bmenu_simple">&nbsp;&raquo;</b>');
			$("b.bmenu_simple").css("color",$(this).css("color"));
		}
	});
	$('.Gmenu li[@view=topitem]:has(ul:has(a.current))').find("b.bmenu:first").append("&nbsp;<b class='bmenu_current'>"+$("a.current").attr('title')+"</b>");
	$("b.bmenu_current").css("color",$("a.current").css("color"));
	var top=0;
	if($(".Madrid").length)
	{
		if(IsIE6())
		{
			$('.Madrid b.xtop').each(function()
			{
				$(this).attr("style","height:1px;width:"+($(this).parent()[0].offsetWidth)+"px");
			});
			$('.Gmenu').parent().append('&nbsp;');
		}
	}
	else if($(".Paris").length)
	{
		$('.Gmenu').parent().css('height','1px');
		if($.browser.msie)
			$('.Gmenu').parent().append('&nbsp;');
	}
	else if($('#menu_block>div.Gmenu').length)
	{
		var h=0, w=0;
		var mtW = $('div.Gmenu')[0].offsetWidth;
		$('div.Gmenu li[@view=topitem]').each(function()
		{
			w += $(this)[0].offsetWidth;
			if(w>mtW)
			{
				h += $(this)[0].offsetHeight;
				w=$(this)[0].offsetWidth;
			}
		});
		$('#menu_block').css('height',''+(h+19)+'px');
	}	
	$('.Gmenu ul li ul li ul').css('top','0px');
}
//for add iframe for menu for IE6
function addiframe(elem)
{
	var id = $(elem).attr('id');
	id = id.substr(2);
	if($('#ul'+id).length)
	{
		var w = $('#ul'+id)[0].offsetWidth;
		var h = $('#ul'+id)[0].offsetHeight;
		var l = $('#ul'+id)[0].offsetLeft;
		var t = $('#ul'+id)[0].offsetTop;
		$(elem).append('<iframe id="frame_menu'+id+'" frameborder="1" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="left:'+l+'px;top:'+t+'px;width:'+w+'px;height:'+h+'px;background:white;position:absolute;display:block;opacity:0;filter:alpha(opacity=0);" > </iframe>');
	}		
}
function IsIE6()
{
	var browserName=navigator.appName;
	var browserVer=parseInt(navigator.appVersion); 
	if (browserName=="Microsoft Internet Explorer" && browserVer<7)
		return true;
	return false;
}
//for correct height of list relative to left block
function correctListHeight(mode)
{	
	var layout = $('div[@id^=height100]').attr('layout');
	var lblock, rblock;
	//console.log('mode=','---'+mode+'---grid_block---'+($('#grid_block')[0].offsetHeight));
	if(layout=='London')
	{
		rblock = $('#right_block')[0];
		if(mode=='inline')
			lblock = $('#grid_block')[0];
		else
			lblock = $('#left_block')[0];
	}
	else if(layout=='Rome')
	{
	
	}
	console.log('left-right','---'+$(lblock).length+'---'+$(rblock).length);
	if($(lblock).length && $(rblock).length)
	{
		var lefth = lblock.offsetHeight;
		var righth = rblock.offsetHeight;
		//console.log('left-right','---'+lefth+'---'+righth);
		if((lefth)>(righth+50))
		{
			$('#right_block').css('height',''+(lefth)+'px');
			$('div.list_table1').css('height',''+(lefth-3)+'px');
			$('div.list_table').css('height',''+(lefth-6)+'px');
		}
	}	
}
//get coordinat of element 
function getAbsolutePosition(el,i) 
{
	var r = {l: el.offsetLeft, t: el.offsetTop, w: el.offsetWidth, h: el.offsetHeight };
	//Add padding
	if(!jQuery.browser.msie)
	{
		r.l += parseInt(jQuery.css(el, 'paddingLeft')) || 0;
		r.t += parseInt(jQuery.css(el, 'paddingTop'))  || 0;
	}
	//Get borders
	var bl = parseInt(jQuery.css(el, 'borderLeftWidth')) || 0;
	var bt = parseInt(jQuery.css(el, 'borderTopWidth'))  || 0;
	var tagName = $(el).tagName();
	//All browses don't add table's cellpadding
	if(tagName=='table')
	{
		if($(el).attr('cellpadding')!=0)
		{
			r.l -= $(el).attr('cellpadding');
			r.t -= $(el).attr('cellpadding');
		}
	}	
	// Safari do not add the border for the element
	if(jQuery.browser.safari) 
	{
		r.l += bl;
		r.t += bt;
	}
	// Mozilla and IE don't add the border if 'td' has it
	else if (jQuery.browser.mozilla || jQuery.browser.msie) 
	{
		if(tagName=='td')
		{
			r.t += bt;
			r.l += bl;
		}
		// Mozilla removes the border if the parent has overflow property other than visible
		if (jQuery.browser.mozilla && i>1 && jQuery.css(el, 'overflow') != 'visible') 
		{
			r.l += bl;
			r.t += bt;
		}
	}
	if (el.offsetParent && $(el).css('position')!='absolute')
	{
		if($(el.offsetParent).css('position')!='absolute')
		{
			if (tagName == 'body' || tagName == 'html')
			{
				// Safari doesn't add the body margin for elments positioned with static or relative
				if (jQuery.browser.safari || (jQuery.browser.msie && jQuery.boxModel)) 
				{
					r.l += parseInt(jQuery.css(parent, 'marginLeft')) || 0;
					r.t += parseInt(jQuery.css(parent, 'marginTop'))  || 0;
				}
			}
			else
				var tmp = getAbsolutePosition(el.offsetParent,i++);
			r.l += tmp.l;
			r.t += tmp.t;
		}
	}
	return r;
}
//	To load js files or css files
function ScriptLoader(id)
{
	this.id=id;
	this.jsFiles=new Array();
	this.jsRequirements=new Array();

	this.loadCSS  = function (file)
	{
		if(window[file+'_loadedcss'])
			return;
		window[file+'_loaded_css']=true;
		var html_doc = document.getElementsByTagName('head')[0];
		var css = document.createElement('link');
		css.setAttribute('rel', 'stylesheet');
		css.setAttribute('type', 'text/css');
		css.setAttribute('href', "include/"+file+".css");
		html_doc.appendChild(css);
	}

	this.addJS = function(file,require)
	{
		var idx=this.jsFiles.length;
		this.jsFiles[idx]=file;
		var i;
//	add requirements
		var req=new Array();
		for(i=1;i<arguments.length;i++)
			req[req.length]=arguments[i];
		this.jsRequirements[idx]=req;
	};
	this.load = function()
	{
		var i;
		for(i=0;i<this.jsFiles.length;i++)
			this.loadJS(i);		
		if(!this.jsFiles.length)
			this.postLoadAll();
	};
	this.loadJS=function(idx)
	{
//	check requirements
		for(i=0;i<this.jsRequirements[idx].length;i++)
		{
			if(!window[this.jsRequirements[idx][i]+'_loadedjs'])
				return;
		}
//	check if file loaded already
		if(window[this.jsFiles[idx]+'_loadedjs'])
		{
			this.postLoad(idx);
			return;
		}
//	load file		
		var js = document.createElement('script');
		js.setAttribute('type', 'text/javascript');
		js.setAttribute('src', "include/"+this.jsFiles[idx]+".js");
		var sl = this;
//	add onload handler
		if($.browser.msie)
			js.onreadystatechange = function()	{
			
				if (js.readyState == 'complete' || js.readyState == 'loaded') 
				{
					sl.postLoad(idx); 
				}
			};
		else
				js.onload = function() {	
					sl.postLoad(idx);	
				};
		document.getElementsByTagName('HEAD')[0].appendChild(js);	
	}
	this.postLoad = function(idx)
	{
//	set postload variable
		window[this.jsFiles[idx]+'_loadedjs']=true;
//	exit if page postload function warked already
		if(window["postloadstep"+(this.id ? "_"+this.id : "")+"_worked"])
			return;
//	run dependent loads
		var i,j;
		for(i=0;i<this.jsRequirements.length;i++)
		{
			for(j=0;j<this.jsRequirements[i].length;j++)
			{
				if(this.jsRequirements[i][j]==this.jsFiles[idx])
				{
					this.loadJS(i);
					break;
				}
			}
		}
		this.postLoadAll();
	};
	this.postLoadAll = function()
	{
//	check if all files loaded 
		for(i=0;i<this.jsFiles.length;i++)
			if(!window[this.jsFiles[i]+'_loadedjs'])
				return;
		window["postloadstep"+(this.id ? "_"+this.id : "")+"_worked"]=true;
//	run postload function if it exists 
		if(window["postloadstep"+(this.id ? "_"+this.id : "")])
			eval("postloadstep"+(this.id ? "_"+this.id : "")+"();");
//	run added functions
		if(window["postloadpool"+this.id]!=undefined)
		{
			var pool=window["postloadpool"+this.id];
			for(i=0;i<pool.length;i++)
				pool[i]();
			window["postloadpool"+this.id]=undefined;
		}
	};
}

//For add script code to function postloadstep, that performed after loading all files
function AddScript2Postload(func,id)
{
	if(window["postloadstep"+(id ? "_"+id : "")+"_worked"])
	{
		func();
		return;
	}
	if(window["postloadpool"+id]==undefined)
		window["postloadpool"+id]=new Array();
	var pool = window["postloadpool"+id];
	pool[pool.length]=func;
}
//	To get data from RTEBasic or InnovaEditor
function getDataFromRTEInnova(iframe,useRTE)
{
	var doc,txt;
	if($.browser.msie)
	{
		doc = window.frames[$(iframe)[0].name].document;
		if(doc.forms[0].onsubmit!=null)
			doc.forms[0].onsubmit();
		
		if(useRTE=="RTE" || useRTE=="RTE_FLY")
			txt = $("input[@type=hidden]",doc)[0];
		else
			txt = $("textarea",doc)[0];
	}
	else{
			doc = $(iframe)[0].contentDocument;
			txt=doc.forms[0].onsubmit();
		}
	return txt;	
}
//	To set data from RTEBasic or InnovaEditor  for save it to base
function setDataFromRTEInnova(elem,useRTE,form,name,id)
{
	if(!name)
		iframe = $("iframe",elem);
	else
		iframe = elem;
	var txt = getDataFromRTEInnova(iframe,useRTE);
	if($.browser.msie)
	{
		if(!name)
			name = txt.name.substr(0,txt.name.length-1-(new String(id)).length);	
		$('<input type="text" name="' + name + '">').appendTo(form);
		if(useRTE=="RTE" || useRTE=="RTE_FLY")
			$("[@name="+name+"]",form).val($(txt).val());
		else
			$("[@name="+name+"]",form).val($(txt).text());
	}
	else{
			if(!name)
				name = "value_" + elem.id.substr(5+(new String(id)).length);
			$('<input type="hidden" name="' + name + '">').appendTo(form);
			$("[@name="+name+"]",form).val(txt);
		}
	return;
}
//	To set my added function on event \"onChange\" on the first place
jQuery.fn.bindFirst = function(evt, fn)
{
	var events = $(this).data('events');
	var handlers = [];
	for(var type in events) 
	{
		if(type == evt) 
		{
			for(var guid in events[type])
				handlers.push(events[type][guid]);
			$(this).unbind(evt);
			$(this).bind(evt,function()
			{
				fn();
				for(var i = 0; i < handlers.length; i++)
					handlers[i]();
			});
			break;
		}
	}
	return $(this);
}
// For add function on event onchange and on keypress
function change()
{
	$('#editform :input').each(function()
	{
		var type = $(this).attr('type');
		var tagName = $(this).tagName();
		if(type=='checkbox' || type=='radio')
			$(this).bind('click',click);
		else if(type=='text' || type=='password' || tagName=='textarea')
		{
			$(this).parent().append('<input type="hidden" id="change_'+$(this).attr('name')+'" >');
			$('#change_'+$(this).attr('name')).val($(this).val());
			$(this).bind('keyup',keyup);
		}
		else 
			$(this).bind('change',disbutton);
	});
}
function click()
{
	if($(this).attr('checked'))
		disbutton();
}
function keyup()
{
	var name = $(this).attr('name');
	var val_el = $(this).val();
	var val_ch = $('#change_'+name).val();
	if(val_el!=val_ch)
		disbutton();
}
function disbutton()
{
	if(flag_but==0)
	{
		attr();
		flag_but=1;
	}
}
$.fn.tagName = function() 
{
    return this.get(0).tagName.toLowerCase();;
}
//	For style disabled button prev and next
function attr()
{
	var prev = $('#prev')[0];
	var next = $('#next')[0];
	if(prev)
	{
		$(prev).css('background','#dcdcdc url(\"images/sortprev.gif\") center no-repeat');
		$(prev).css('color','#dcdcdc');
		$(prev).css('cursor','default');
		$(prev).attr('disabled','disabled');
	}
	if(next)
	{
		$(next).css('background','#dcdcdc url(\"images/sortnext.gif\") center no-repeat');
		$(next).css('color','#dcdcdc');
		$(next).css('cursor','default');
		$(next).attr('disabled','disabled');
	}
}
//	For multiple sorting 
function sort(e,url)
{
	var ctrlPressed = 0;
	if(parseInt(navigator.appVersion) > 3)
	{
		if (navigator.appName == "Netscape")
		{
			var ua = navigator.userAgent;
			var isFirefox = (ua != null && (ua.indexOf("Firefox/") != -1 || ua.indexOf("Chrome/") != -1));
			if ((!isFirefox && getNNVersionNumber() >= 6) || isFirefox) 
				ctrlPressed = e.ctrlKey;
			else ctrlPressed = ((e.modifiers+32).toString(2).substring(3,6).charAt(1)=="1");
		}
		else ctrlPressed = event.ctrlKey;
		if (ctrlPressed) 
		{
			var newPage = "<scr" + "ipt language=\"JavaScript\">setTimeout(\'window.location.href=\"" + url + "&ctrl=1\"\', 10);</scr" + "ipt>";
			document.write(newPage);
			document.close();
			return false;
		}
	}
	return true;
}

var flag_hint=0;
var hspan = false;
//	To add hints for multiple sorting
function addspan(e)
{
	if($.browser.msie)
	{
		y_ = e.y;
		x_ = e.x;
	}
	else
	{
		y_ = e.clientY;
		x_ = e.clientX;
	}
	flag_hint=1;	
	hspan = $(document.body).find("span.hover_span")[0];
	timespan(x_,y_);
}	
//	To  show hints it may take some time
function timespan(x_,y_)
{
	if(!hspan) 
	{
		$(document.body).append('<span class=\'hover_span\' style=\'position:absolute;display:none;font-size:9px;border:solid 1px #747474;background-color:#ffffe1;color:#000;white-space:pre;padding:2px;width:170;z-Index:1000;\'><b>'+TEXT_CTRL_CLICK+'</b></span>');
		hspan = $("span.hover_span")[0];
	}
	if ($.browser.mozilla)
	{
		clientHeight=window.innerHeight;
		clientWidth=window.innerWidth;
	}
	else{
			clientHeight=document.body.clientHeight;
			clientWidth=document.body.clientWidth;
		}
	left=false;
	right=false;
	w_ = hspan.offsetWidth;
	h_ = hspan.offsetHeight; 
	if(x_ + w_ > clientWidth)
	{
		x_ = clientWidth - w_;
		left=true;
	}
	if(y_ + h_ > clientHeight)
	{
		y_ = clientHeight - h_;
		right=true;
	}
	if(left&&right)
		y_ = clientHeight - h_;
	x_ = x_ + document.body.scrollLeft;
	y_ = y_ + document.body.scrollTop + 20;
	$(hspan).css("left", "" + x_ + "px");
	$(hspan).css("top", "" + y_ + "px");
	if(flag_hint) $(hspan).css("display", "inline");
}
//	To del hints for multiple sorting
function delspan()
{
	if(hspan)
	{
		$(hspan).css("display","none");
		flag_hint=0;
	}	
}
//	To moving hints for multiple sorting
function movespan(e)
{	
	if(hspan)
	{
		if( hspan.style.display != "inline" )
			return false;
		hspan.style.left = ( e.clientX || e.x ) + document.body.scrollLeft;
		hspan.style.top  = ( e.clientY || e.y ) + 20 + document.body.scrollTop;
	}
}


function RunSearch(pid)
{
	var form,id='';
	if(pid)
	{
		id=pid;
		form=document.forms['frmSearch'+id];
	}
	else
		form=document.forms.frmSearch;
	
	form.a.value = 'search'; 
	form.SearchFor.value = document.getElementById('ctlSearchFor'+id).value; 
	if(document.getElementById('ctlSearchField'+id)!=undefined)
		form.SearchField.value = $('#ctlSearchField'+id).val(); 
	if(document.getElementById('ctlSearchOption'+id)!=undefined)
		form.SearchOption.value = $('#ctlSearchOption'+id).val(); 
	else
		form.SearchOption.value = "Contains"; 
	form.submit();
}


function GetGotoPageUrlString (nPageNumber,sUrlText)
{
	return "<a href='JavaScript:GotoPage(" + nPageNumber + ");' style='TEXT-DECORATION: none;'>" + sUrlText 
	+ "</a>";
}

function WritePagination(mypage,maxpages)
{
	if (maxpages > 1 && mypage <= maxpages)
	{
			document.write("<table rows='1' cols='1' align='center' width='95%' border='0'>"); 
			document.write("<tr valign='center'><td align='center'>"); 
			var counterstart = mypage - 9; 
			if (mypage%10) counterstart = mypage - (mypage%10) + 1; 
 
			var counterend = counterstart + 9; 
			if (counterend > maxpages) counterend = maxpages; 
 
			if (counterstart != 1) document.write(GetGotoPageUrlString(1,TEXT_FIRST)+"&nbsp;:&nbsp;"+GetGotoPageUrlString(counterstart - 1,TEXT_PREVIOUS)+"&nbsp;"); 
 
			document.write("<b>[</b>"); 
		
		var pad="";
		var counter	= counterstart;
		for(;counter<=counterend;counter++)
		{
			if (counter != mypage) document.write("&nbsp;" + GetGotoPageUrlString(counter,pad + counter));
			else document.write("&nbsp;<b>" + pad + counter + "</b>");
		}
		document.write("&nbsp;<b>]</b>");
		if (counterend != maxpages) document.write("&nbsp;" + GetGotoPageUrlString (counterend + 1,TEXT_NEXT) + "&nbsp;:&nbsp;" + GetGotoPageUrlString(maxpages,TEXT_LAST))
			
		document.write("</td></tr></table>");		
	}
}


    var rowWithMouse = null;

    function gGetElementById(s) {
      var o = (document.getElementById ? document.getElementById(s) : document.all[s]);
      return o == null ? false : o;
    }

    function rowUpdateBg(row, myId) 
    {
        row.className = (row == rowWithMouse) ? 'rowselected' : ( (myId&1) ? '' : 'shade' );
    }

    function rowRollover(myId, isInRow) {
      // myId is our own integer id, not the DOM id
      // isInRow is 1 for onmouseover, 0 for onmouseout
      var row = document.getElementById('tr_' + myId);
      rowWithMouse = (isInRow) ? row : null;
      rowUpdateBg(row, myId);
    }



function BuildSecondDropDown(arr, SecondField, FirstValue)
{
	document.forms.editform.elements[SecondField].selectedIndex=0;

	document.forms.editform.elements[SecondField].options[0]=new Option(TEXT_PLEASE_SELECT,'');

	var i=1;
	for(ctr=0;ctr<arr.length;ctr+=3)
	{
		if (FirstValue.toLowerCase() == arr[ctr+2].toLowerCase())
		{
			document.forms.editform.elements[SecondField].options[i]=new Option(arr[ctr+1],arr[ctr]);
			i++;
		}
	}
	document.forms.editform.elements[SecondField].length=i;
	if(i<3 && i>1 && !bLoading)
		document.forms.editform.elements[SecondField].selectedIndex=1;
	else
		document.forms.editform.elements[SecondField].selectedIndex=0;
}

function SetSelection(FirstField, SecondField, FirstValue, SecondValue, arr)
{
	var ctr;

	BuildSecondDropDown(arr, SecondField, FirstValue);	 
	if(SecondValue=="" && document.forms.editform.elements[SecondField].length<3)
		return;
	for (ctr=0; ctr<document.forms.editform.elements[SecondField].length; ctr++)
	 if (document.forms.editform.elements[SecondField].options[ctr].value.toLowerCase() == SecondValue.toLowerCase() )
	 	 {
		  document.forms.editform.elements[SecondField].selectedIndex = ctr;
		  break;
		 }
}
function padDateValue(value,threedigits)
{
	if(!threedigits)
	{
		if(value>9)
			return ''+value;
		return '0'+value;
	}
	if(value>9)
	{
		if(value>99)
			return ''+value;
		return '0'+value;
	}
	return '00'+value;
}

function getTimestamp()
{
	var ts = "";
	var now = new Date();
	ts += now.getFullYear();
	ts+=padDateValue(now.getMonth()+1,false);
	ts+=padDateValue(now.getDate(),false)+'-';
	ts+=padDateValue(now.getHours(),false);
	ts+=padDateValue(now.getMinutes(),false);
	ts+=padDateValue(now.getSeconds(),false);
	return ts;
}

function addTimestamp(filename)
{
	var wpos=filename.lastIndexOf('.');
	if(wpos<0)
		return filename+'-'+getTimestamp();
	return filename.substring(0,wpos)+'-'+getTimestamp()+filename.substring(wpos);
}

function create_option( theselectobj, thetext, thevalue ) 
{
theselectobj.options[theselectobj.options.length]= new Option(thetext,thevalue);
}

function SetToFirstControl(name)
{
try {
	if(name)
	{
	    var form=document.forms[name];
		for(i=0; i < form.elements.length; i++)
		{
			if (form.elements[i].type == "hidden" || form.elements[i].disabled)
		  		continue;
	   	    form.elements[i].focus();
			break;
		}
		return;
	}
	var bFound = false;
	for (f=0; !bFound && f<document.forms.length; f++)
	{
	    var form=document.forms[f];
	    for(i=0; i < form.elements.length; i++)
	    {
			if (form.elements[i].type == "hidden" || form.elements[i].disabled)
		  		continue;
			form.elements[i].focus();
	        var bFound = true;
			break;
		}
    }
} catch(er) {} 
}

function slashdecode(str)
{
	var out = new String();
	var pos = 0;
	for ( var i = 0; i < str.length - 1; i++ )
	{
		var c = str.charAt(i);
		if( c == '\\' )
		{
			out += str.substr(pos,i-pos);
			pos = i + 2;
			var c1 = str.charAt(i+1);
			i++;
			if ( c1 == '\\' ) {
				out += "\\";
			} else if ( c1 == 'r' ) {
				out += "\r";
			} else if ( c1 == 'n') {
				out += "\n";
			} else {
				i--;
				pos-=2;
			}
		}
	}
	if ( pos < str.length )
		out += str.substr(pos);
	
	return out;
}

var zindex_max=1;

/////////////////////////////////////////////////////////////
function print_time(h, m, s, format, hIsAM, convention, am, pm)
{
	var res = format;
	var isAM = hIsAM;
	
	if(convention == 12 && h > 12)
	{
		h -= 12;
		isAM = false;
	}
	
	var hh = parseInt(h);
	if(isNaN(hh))
		hh = 0;	
	var mm = parseInt(m);
	if(isNaN(mm))
		mm = 0;	
	var ss = parseInt(s);
	if(isNaN(ss))
		ss = 0;
	if(hh < 10)
		hh = "0" + hh.toString();
	if(mm < 10)
		mm = "0" + mm.toString();
	if(ss < 10)
		ss = "0" + ss.toString();
		
	res = res.replace(/mm/, mm);
	res = res.replace(/ss/, ss);
	res = res.replace(/m/, m);
	res = res.replace(/s/, s);
	
	res = res.toLowerCase();
	if(convention == 12)
	{
		var t = isAM ? am : pm;
		res = res.replace(/hh/, hh);
		res = res.replace(/h/, h);
		res = res.replace(/t+/, t);
	}
	else
	{
		res = res.replace(/hh/, hh);
		res = res.replace(/h/, h);
	}
	
	return res;	
}
