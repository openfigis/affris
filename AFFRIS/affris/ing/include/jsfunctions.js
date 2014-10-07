
var jsfunctions_included=true;var cookieRoot="";window.CKEDITOR_BASEPATH='plugins/ckeditor/';if(!window.console||!window.console.log){window.console={log:function(){}};}
function findPos(obj){var objNew=obj;var curleft=0,curtop=0;var curleft=obj.offsetLeft
var curtop=obj.offsetTop
var curwidth=obj.offsetWidth
var curheight=obj.offsetHeight
if(obj.offsetParent){while(obj=obj.offsetParent){curleft+=obj.offsetLeft;curtop+=obj.offsetTop;}}
while(objNew=$(objNew).parent().get(0)){if($(objNew).tagName()!='body'){if($(objNew).scrollLeft())
curleft=curleft-$(objNew).scrollLeft();if($(objNew).scrollTop())
curtop=curtop-$(objNew).scrollTop();}else
break;}
return[curleft,curtop,curwidth,curheight];}
function myEncode(value)
{if(value){value=new String(value);value=value.replace(/:/g,"%3A");value=value.replace(/=/g,"%3D");value=value.replace(/&/g,"%26");value=value.replace(/\//g,"%2F");value=value.replace(/\?/g,"%3F");value=value.replace(/\s/g,"%20");value=value.replace(/\+/g,"%2B");value=value.replace(/#/g,"%23");}
return value;}
function getElementsByName_iefix(tag,name)
{var elem=document.getElementsByTagName(tag);var arr=new Array();for(var i=0,iarr=0;i<elem.length;i++){att=elem[i].getAttribute("name");if(att==name){arr[iarr]=elem[i];iarr++;}}
return arr;}
function stopLoadingForError()
{var lDivs,lConts;if(navigator.appName=="Microsoft Internet Explorer"){lDivs=getElementsByName_iefix("div","loadingDiv");lConts=getElementsByName_iefix("div","loadedContent");}else{lDivs=document.getElementsByName("loadingDiv");lConts=document.getElementsByName("loadedContent");}
for(var i=0;i<lDivs.length;i++)
lDivs[i].parentNode.removeChild(lDivs[i]);for(var j=0;j<lConts.length;j++)
{if($(lConts[j]).css("position")!="static")
{$(lConts[j]).css("position","static");$(lConts[j]).css("left","0px");}}}
$.fn.tagName=function()
{return this.get(0).tagName.toLowerCase();}
function DL_GetElementLeft(eElement){if(!eElement&&this)
{eElement=this;}
var DL_bIE=document.all?true:false;var nLeftPos=eElement.offsetLeft;var eParElement=eElement.offsetParent;while(eParElement!=null)
{if(DL_bIE){if(eParElement.tagName=="TD")
{nLeftPos+=eParElement.clientLeft;}}
nLeftPos+=eParElement.offsetLeft;eParElement=eParElement.offsetParent;}
return nLeftPos;}
function DL_GetElementTop(eElement)
{if(!eElement&&this)
{eElement=this;}
var DL_bIE=document.all?true:false;var nTopPos=eElement.offsetTop;var eParElement=eElement.offsetParent;while(eParElement!=null)
{if(DL_bIE)
{if(eParElement.tagName=="TD")
{nTopPos+=eParElement.clientTop;}}
nTopPos+=eParElement.offsetTop;eParElement=eParElement.offsetParent;}
return nTopPos;}
function getWindowDimensions()
{var myWidth=0,myHeight=0;if(typeof(window.innerWidth)=='number')
{myWidth=window.innerWidth;myHeight=window.innerHeight;}else if(document.documentElement&&(document.documentElement.clientWidth||document.documentElement.clientHeight)){myWidth=document.documentElement.clientWidth;myHeight=document.documentElement.clientHeight;}else if(document.body&&(document.body.clientWidth||document.body.clientHeight)){myWidth=document.body.clientWidth;myHeight=document.body.clientHeight;}
return[myWidth,myHeight];}
function getScrollXY(){var scrOfX=0,scrOfY=0;if(typeof(window.pageYOffset)=='number'){scrOfY=window.pageYOffset;scrOfX=window.pageXOffset;}else if(document.body&&(document.body.scrollLeft||document.body.scrollTop)){scrOfY=document.body.scrollTop;scrOfX=document.body.scrollLeft;}else if(document.documentElement&&(document.documentElement.scrollLeft||document.documentElement.scrollTop)){scrOfY=document.documentElement.scrollTop;scrOfX=document.documentElement.scrollLeft;}
return[scrOfX,scrOfY];}
function findCookieRoot()
{var cutFrom=document.location['pathname'].indexOf('/',1);cookieRoot=document.location['pathname'].substr(0,(cutFrom+1));}
function addOpenMenuItemIdToCookie(menuItemId)
{var openMenuItemIds=get_cookie('openMenuItemIds');if(openMenuItemIds)
{if(openMenuItemIds.indexOf(menuItemId)==-1)
openMenuItemIds+=";"+menuItemId;}
else
openMenuItemIds=menuItemId;set_cookie('openMenuItemIds',openMenuItemIds,'',cookieRoot,'','');toggleExpandCollapse();}
function removeOpenMenuFromCookie(menuItemId)
{var openMenuItemIds=get_cookie('openMenuItemIds');if(openMenuItemIds)
{openMenuItemIds=openMenuItemIds.replace((";"+menuItemId),"");openMenuItemIds=openMenuItemIds.replace(menuItemId,"");if(openMenuItemIds.indexOf(';')==0)
openMenuItemIds=openMenuItemIds.substr(1,openMenuItemIds.length);set_cookie('openMenuItemIds',openMenuItemIds,'',cookieRoot,'','');}
setTimeout(function(){toggleExpandCollapse();},500);}
function toggleExpandCollapse()
{var visibleLength=$("#mainmenu_block").find("ul[@id^=u]:visible").length,hiddenLength=$("#mainmenu_block").find("ul[@id^=u]:hidden").length;if(visibleLength==0&&hiddenLength>0&&$("img.pmimg").attr("src")=="include/img/plus.gif")
{$('a.plus_minus').empty();$('img.pmimg').attr('src','include/img/plus.gif');$('a.plus_minus').append('<img src=\"include/img/plus.gif\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_EXPAND_ALL);}
else if(visibleLength!=0&&hiddenLength==0&&$("img.pmimg").attr("src")=="include/img/minus.gif")
{$('a.plus_minus').empty();$('img.pmimg').attr('src','include/img/minus.gif');$('a.plus_minus').append('<img src=\"include/img/minus.gif\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_COLLAPSE_ALL);}}
function openMenuItemsOnLoad()
{findCookieRoot();var openMenuItemIds=get_cookie('openMenuItemIds');if(openMenuItemIds)
{var itemForOpenArr=openMenuItemIds.split(";");for(var i=0;i<itemForOpenArr.length;i++)
{var itemId=itemForOpenArr[i];$("#"+itemId).slideDown(1);var par=$("#"+itemId).parent();var parc=$('a.current').parent();if($('a.current',par).length&&$(par).attr('id')!=$(parc).attr('id'))
$(par).find('a:first').css('color',window.colorlink);$(par).find('img:first').attr("src","include/img/minus.gif");}}
toggleExpandCollapse();}
function Vmenu1()
{window.Max=0;var redrawFlag=0;$('.Vmenu1 ul li').hover(function()
{redrawFlag=1;var left=1,top=2,vscroll=0;if($(this).attr('class')!='hr')
$(this).addClass('menu_active');ul=$(this).find('ul:first:has(li)');if($(ul).length)
{$(ul).css('display','block');if(document.dir=='rtl'&&$.browser.msie)
{$(ul).find('li[@class=hr][@parent='+$(ul).attr('id')+']').each(function()
{$(this).hide();});}
ulW=$(ul)[0].offsetWidth;if($(this).attr('view')=='topitem')
{el=getAbsolutePosition(this,1);if(document.dir=='rtl')
window.Max=el.l-ulW;else
window.Max=el.l+el.w;if(!$.browser.msie)
{if(document.dir=='rtl')
window.Max=window.Max+10;else
window.Max=window.Max-10;}
window.first=0;}
if(!$.browser.msie&&($(ul)[0].offsetHeight+el.t)>document.body.clientHeight)
vscroll=10;if(!window.first)
{$(ul).css('left',''+(window.Max-vscroll)+'px');$(ul).css('top',''+(el.t)+'px');}
else{$(ul).css('top',''+$(this)[0].offsetTop+'px');if(document.dir=='rtl')
$(ul).css('right',''+($(this)[0].offsetWidth-vscroll)+'px');else
$(ul).css('left',''+($(this)[0].offsetWidth-vscroll)+'px');}
if(document.dir=='rtl')
{left=-2;if($.browser.msie)
{$(ul).find('li[@class=hr][@parent='+$(ul).attr('id')+']').each(function()
{$(this).css('width',''+ulW+'px');$(this).show();});if(!window.first)
{var idPar=$('div.Vmenu1').parent().parent().attr('id');if(!idPar||idPar.indexOf('left_block')==-1)
{left=-21;top=0;}}}}
window.first=1;$(ul).dropShadow({left:left,top:top,blur:2,opacity:0.4})
setTimeout(function(){if(redrawFlag)$(ul).redrawShadow();},150);if(IsIE6())
addiframe($(this));}},function()
{redrawFlag=0;if($(this).attr('class')!='hr')
$(this).removeClass('menu_active');ul=$(this).find('ul:first:has(li)');if($(ul).length)
{$(ul).css('display','none');$(ul).removeShadow();var id=$(this).attr('id');id=id.substr(2);if($('#ul'+id).length)
$("#frame_menu"+id).remove();}});$('.Vmenu1 li:has(ul:has(li))').find('a:first').each(function()
{if(!$('b',this).length)
{$(this).after('<b class="bmenu bmenu_simple">&nbsp;&raquo;</b>');$("b.bmenu_simple").css("color",$(this).css("color"));}});$('.Vmenu1 li[@view=topitem]:has(ul:has(a.current))').find("b:first").append("&nbsp;<b class='bmenu_current'>"+$("a.current").attr('title')+"</b>");$("b.bmenu_current").css("color",$("a.current").css("color"));$('.Vmenu1 ul li ul').addClass('submenu');}
function Vmenu2()
{var redrawFlag=0;window.colorlink=$("a.tablelinkssearch").css("color");$('.Vmenu2 ul li a').hover(function()
{if($(this).parent().attr('class')!='hr')
$(this).addClass('menu_active');},function()
{if($(this).parent().attr('class')!='hr')
$(this).removeClass('menu_active');});$('.Vmenu2 ul li ul').hide();$('li[@view=topitem]:has(ul:has(a.current))').find('a:first').css('color',$("a.current").css("color"));$('.Vmenu2 ul li:has(ul) span').bind('click',function()
{var par=$(this).parent();var parc=$('a.current').parent();$(par).find('ul:first').slideToggle();if($(this).find('img.pmimg').attr('src')=='include/img/plus.gif')
{addOpenMenuItemIdToCookie($(par).find('ul:first').attr("id"));$(this).find('img.pmimg').attr('src','include/img/minus.gif');if($('a.current',par).length&&$(par).attr('id')!=$(parc).attr('id'))
$(par).find('a:first').css('color',window.colorlink);$(par).find('ul:has(a.current)').each(function(parc)
{$(this).parent().find('img.pmimg:first').attr('src','include/img/minus.gif');if($('a.current',this).length&&$(this).parent().attr('id')!=$(parc).attr('id'))
$(this).parent().find('a:first').css('color',window.colorlink);addOpenMenuItemIdToCookie($(this).attr("id"));$(this).slideDown();});}
else{removeOpenMenuFromCookie($(par).find('ul:first').attr("id"));$(par).find('ul').each(function()
{removeOpenMenuFromCookie($(this).attr("id"));});$(this).find('img.pmimg').attr('src','include/img/plus.gif');if($('a.current',par).length&&$(par).attr('id')!=$(parc).attr('id'))
$(par).find('a:first').css('color',$("a.current").css("color"));}
return false;});if($('.Vmenu2 li[@view=topitem]:has(ul)').length&&$('.Vmenu2 ul:first').length)
{$('.Vmenu2_links').css('display','block');$('a.plus_minus').click(function()
{if(redrawFlag)
{$(this).parent().parent().find('ul li ul').slideUp('slow');$('a.plus_minus').empty();$('img.pmimg').attr('src','include/img/plus.gif');$('a.plus_minus').append('<img src=\"include/img/plus.gif\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_EXPAND_ALL);redrawFlag=0;delete_cookie('openMenuItemIds',cookieRoot,'');$(this).parent().parent().find('li:has(ul:has(a.current))').each(function()
{$(this).find('a:first').css('color',$("a.current").css("color"));});}
else{$(this).parent().parent().find('ul li ul').slideDown('slow');$('a.plus_minus').empty();$('img.pmimg').attr('src','include/img/minus.gif');$('a.plus_minus').append('<img src=\"include/img/minus.gif\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_COLLAPSE_ALL);redrawFlag=1;$(this).parent().parent().find('ul li ul').each(function()
{addOpenMenuItemIdToCookie($(this).attr("id"));});$(this).parent().parent().find('li:has(ul:has(a.current))').each(function()
{$(this).find('a:first').css('color',window.colorlink);});}
return false;});}
if($.browser.msie)
$('.Vmenu2 ul li').css('padding','5px 0');}
function Gmenu()
{window.Max=0;window.UlMax=0;window.LiMax=0;window.first=0;var redrawFlag=0;$('.Gmenu ul li').hover(function()
{var left=1;redrawFlag=1;if(!$(this).find('.main_item').length&&$(this).attr('class')!='hr')
$(this).addClass('menu_active');ul=$(this).find('ul:first:has(li)');if($(ul).length)
{window.UlMax=0;if($(this).attr('view')=='topitem')
{el=getAbsolutePosition(this,1);window.LiMax=el.w;window.first=0;}
$(ul).css('display','block');$(ul).find('li[@parent='+($(ul).attr('id'))+'] a').each(function()
{if(window.UlMax<$(this)[0].offsetWidth)
window.UlMax=$(this)[0].offsetWidth});if(!window.first&&window.UlMax<window.LiMax)
window.Max=window.LiMax;else
window.Max=window.UlMax;window.Max=window.Max+20;$(ul).css('width',''+window.Max+'px');if(!window.first)
{if(document.dir=='rtl')
$(ul).css('left',''+(el.l+(el.w-$(ul)[0].offsetWidth))+'px');else
$(ul).css('left',''+(el.l)+'px');$(ul).css('top',''+(el.t+el.h-1)+'px');}
else
$(ul).css('top',''+$(this)[0].offsetTop+'px');$(ul).find('li[@parent='+($(ul).attr('id'))+']').each(function()
{$(this).css('width',''+window.Max+'px');if(document.dir=='rtl')
$(this).find('ul:first').css('right',''+window.Max+'px');else
$(this).find('ul:first').css('left',''+window.Max+'px');});if(document.dir=='rtl')
{if($.browser.msie&&!window.first)
left=-21;else
left=-2;}
window.first=1;var top=2;if($.browser.msie){left=left+document.body.scrollLeft;top=top+document.body.scrollTop;}
$(ul).dropShadow({left:left,top:top,blur:2,opacity:0.4});setTimeout(function(){if(redrawFlag)$(ul).redrawShadow();},150);if(IsIE6())
addiframe($(this));}},function()
{redrawFlag=0;if(!$(this).find('.main_item').length&&$(this).attr('class')!='hr')
$(this).removeClass('menu_active');$(this).find('ul:first').css('display','none');$(this).find('ul:first').removeShadow();var id=$(this).attr('id');id=id.substr(2);if($('#ul'+id).length)
$("#frame_menu"+id).remove();});$('.Gmenu li:has(ul:has(li))').find('a:first').each(function()
{if(!$('b',this).length)
{$(this).after('<b class="bmenu bmenu_simple">&nbsp;&raquo;</b>');$("b.bmenu_simple").css("color",$(this).css("color"));}});$('.Gmenu li[@view=topitem]:has(ul:has(a.current))').find("b.bmenu:first").append("&nbsp;<b class='bmenu_current'>"+$("a.current").attr('title')+"</b>");$("b.bmenu_current").css("color",$("a.current").css("color"));if($(".Madrid").length)
{if(IsIE6())
{$('.Madrid b.xtop').each(function()
{$(this).attr("style","height:1px;width:"+($(this).parent()[0].offsetWidth)+"px");});$('.Gmenu').parent().append('&nbsp;');}}
else if($(".Paris").length)
{$('.Gmenu').parent().css('height','1px');if($.browser.msie)
$('.Gmenu').parent().append('&nbsp;');}
else if($('#menu_block>div.Gmenu').length)
{var h=0,w=0;var mtW=$('div.Gmenu')[0].offsetWidth;$('div.Gmenu li[@view=topitem]').each(function()
{w+=$(this)[0].offsetWidth;if(w>mtW)
{h+=$(this)[0].offsetHeight;w=$(this)[0].offsetWidth;}});$('#menu_block').css('height',''+(h+19)+'px');}
$('.Gmenu ul li ul li ul').css('top','0px');}
function addiframe(elem)
{var id=$(elem).attr('id');id=id.substr(2);if($('#ul'+id).length)
{var w=$('#ul'+id)[0].offsetWidth;var h=$('#ul'+id)[0].offsetHeight;var l=$('#ul'+id)[0].offsetLeft;var t=$('#ul'+id)[0].offsetTop;$(elem).append('<iframe src="javascript:false;" id="frame_menu'+id+'" frameborder="1" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="left:'+l+'px;top:'+t+'px;width:'+w+'px;height:'+h+'px;background:white;position:absolute;display:block;opacity:0;filter:alpha(opacity=0);" > </iframe>');}}
function IsIE6()
{var browserName=navigator.appName;var browserVer=parseInt(navigator.appVersion);if(browserName=="Microsoft Internet Explorer"&&browserVer<7)
return true;return false;}
function correctListHeight(mode)
{}
function getAbsolutePosition(el,i)
{i=(i==='undefined')?i=1:i;var r={l:el.offsetLeft,t:el.offsetTop,w:el.offsetWidth,h:el.offsetHeight};var bl=parseInt(jQuery.css(el,'borderLeftWidth'))||0;var bt=parseInt(jQuery.css(el,'borderTopWidth'))||0;var tagName=$(el).tagName();if(tagName=='table')
{if($(el).attr('cellpadding'))
{r.l-=$(el).attr('cellpadding');r.t-=$(el).attr('cellpadding');}}
if(jQuery.browser.safari)
{r.l+=bl;r.t+=bt;}
else if(jQuery.browser.mozilla||jQuery.browser.msie)
{if(tagName=='td')
{r.t+=bt;r.l+=bl;}
if(jQuery.browser.mozilla&&i>1&&jQuery.css(el,'overflow')!='visible')
{r.l+=bl;r.t+=bt;}}
if(el.offsetParent&&$(el).css('position')!='absolute')
{if($(el.offsetParent).css('position')!='absolute')
{if(tagName=='body'||tagName=='html')
{r.l-=parseInt(jQuery.css(el,'paddingLeft'))||0;r.t-=parseInt(jQuery.css(el,'paddingTop'))||0;}
else
var tmp=getAbsolutePosition(el.offsetParent,i++);r.l+=tmp.l;r.t+=tmp.t;}}
return r;}
jQuery.fn.bindFirst=function(evt,fn)
{var events=$(this).data('events');var handlers=[];for(var type in events)
{if(type==evt)
{for(var guid in events[type])
handlers.push(events[type][guid]);$(this).unbind(evt);$(this).bind(evt,function()
{fn();for(var i=0;i<handlers.length;i++)
handlers[i]();});break;}}
return $(this);}
function sort(e,url,useAjax,id)
{var ctrlPressed=0;if(parseInt(navigator.appVersion)>3)
{if(navigator.appName=="Netscape")
{var ua=navigator.userAgent;var isFirefox=(ua!=null&&(ua.indexOf("Firefox/")!=-1||ua.indexOf("Chrome/")!=-1));if((!isFirefox&&getNNVersionNumber()>=6)||isFirefox)
ctrlPressed=e.ctrlKey;else
ctrlPressed=((e.modifiers+32).toString(2).substring(3,6).charAt(1)=="1");}
else ctrlPressed=event.ctrlKey;if(ctrlPressed)
{url=url+'&ctrl=1';if(useAjax){return url;}else{var newPage="<scr"+"ipt language=\"JavaScript\">setTimeout(\'window.location.href=\""+url+"&ctrl=1\"\', 1);</scr"+"ipt>";document.write(newPage);document.close();}
return false;}}
return'';}
var flag_hint=0;var hspan=false;function addspan(e)
{if($.browser.msie)
{y_=e.y||e.pageY;x_=e.x||e.pageX;}
else
{y_=e.clientY;x_=e.clientX;}
flag_hint=1;hspan=$(document.body).find("span.hover_span")[0];timespan(x_,y_);}
function timespan(x_,y_)
{if(!hspan)
{$(document.body).append('<span class=\'hover_span\' style=\'position:absolute;display:none;font-size:9px;border:solid 1px #747474;background-color:#ffffe1;color:#000;white-space:pre;padding:2px;width:170;z-Index:1000;\'><b>'+Runner.lang.constants.TEXT_CTRL_CLICK+'</b></span>');hspan=$("span.hover_span")[0];}
if($.browser.mozilla)
{clientHeight=window.innerHeight;clientWidth=window.innerWidth;}
else{clientHeight=document.body.clientHeight;clientWidth=document.body.clientWidth;}
left=false;right=false;w_=hspan.offsetWidth;h_=hspan.offsetHeight;if(x_+w_>clientWidth)
{x_=clientWidth-w_;left=true;}
if(y_+h_>clientHeight)
{y_=clientHeight-h_;right=true;}
if(left&&right)
y_=clientHeight-h_;x_=x_+document.body.scrollLeft;y_=y_+document.body.scrollTop+20;$(hspan).css("left",""+x_+"px");$(hspan).css("top",""+y_+"px");if(flag_hint)$(hspan).css("display","inline");}
function delspan()
{if(hspan)
{$(hspan).css("display","none");flag_hint=0;}}
function movespan(e)
{if(hspan)
{if(hspan.style.display!="inline")
return false;hspan.style.left=(e.clientX||e.x)+document.body.scrollLeft;hspan.style.top=(e.clientY||e.y)+20+document.body.scrollTop;}}
function RunSearch(pid)
{var form,id='';if(pid){id=pid;form=document.forms['frmSearch'+id];}else{form=document.forms.frmSearch;}
form.a.value='search';form.SearchFor.value=document.getElementById('ctlSearchFor'+id).value;if(document.getElementById('ctlSearchField'+id)!=undefined){form.SearchField.value=$('#ctlSearchField'+id).val();}else{form.SearchField.value='';}
if(document.getElementById('ctlSearchOption'+id)!=undefined){form.SearchOption.value=$('#ctlSearchOption'+id).val();}else{form.SearchOption.value="Contains";}
form.submit();}
function GetGotoPageUrlString(nPageNumber,sUrlText)
{return"<a href='JavaScript:GotoPage("+nPageNumber+");' style='TEXT-DECORATION: none;'>"+sUrlText
+"</a>";}
function WritePagination(mypage,maxpages,id)
{var paginationHTML="";if(maxpages>1&&mypage<=maxpages)
{paginationHTML+="<table rows='1' cols='1' align='center' width='auto' border='0'>";paginationHTML+="<tr valign='center'><td align='center'>";var counterstart=mypage-9;if(mypage%10)
counterstart=mypage-(mypage%10)+1;var counterend=counterstart+9;if(counterend>maxpages)
counterend=maxpages;if(counterstart!=1)
paginationHTML+=GetGotoPageUrlString(1,"First")+"&nbsp;:&nbsp;"+GetGotoPageUrlString(counterstart-1,"Prev")+"&nbsp;";paginationHTML+="<b>[</b>";var pad="";var counter=counterstart;for(;counter<=counterend;counter++)
{if(counter!=mypage)
paginationHTML+="&nbsp;"+GetGotoPageUrlString(counter,pad+counter);else
paginationHTML+="&nbsp;<b>"+pad+counter+"</b>";}
paginationHTML+="&nbsp;<b>]</b>";if(counterend!=maxpages)
paginationHTML+="&nbsp;"+GetGotoPageUrlString(counterend+1,"Next")+"&nbsp;:&nbsp;"+GetGotoPageUrlString(maxpages,"Last");paginationHTML+="</td></tr></table>";$('#pagination'+id).html(paginationHTML);}}
var rowWithMouse=null;function gGetElementById(s){var o=(document.getElementById?document.getElementById(s):document.all[s]);return o==null?false:o;}
function rowUpdateBg(row,myId)
{row.className=(row==rowWithMouse)?'rowhighlited':((myId&1)?'':'shade');}
function rowRollover(myId,isInRow){var row=document.getElementById('tr_'+myId);rowWithMouse=(isInRow)?row:null;rowUpdateBg(row,myId);}
function BuildSecondDropDown(arr,SecondField,FirstValue)
{document.forms.editform.elements[SecondField].selectedIndex=0;document.forms.editform.elements[SecondField].options[0]=new Option(Runner.lang.constants.TEXT_PLEASE_SELECT,'');var i=1;for(ctr=0;ctr<arr.length;ctr+=3)
{if(FirstValue.toLowerCase()==arr[ctr+2].toLowerCase())
{document.forms.editform.elements[SecondField].options[i]=new Option(arr[ctr+1],arr[ctr]);i++;}}
document.forms.editform.elements[SecondField].length=i;if(i<3&&i>1&&!bLoading)
document.forms.editform.elements[SecondField].selectedIndex=1;else
document.forms.editform.elements[SecondField].selectedIndex=0;}
function SetSelection(FirstField,SecondField,FirstValue,SecondValue,arr)
{var ctr;BuildSecondDropDown(arr,SecondField,FirstValue);if(SecondValue==""&&document.forms.editform.elements[SecondField].length<3)
return;for(ctr=0;ctr<document.forms.editform.elements[SecondField].length;ctr++)
if(document.forms.editform.elements[SecondField].options[ctr].value.toLowerCase()==SecondValue.toLowerCase())
{document.forms.editform.elements[SecondField].selectedIndex=ctr;break;}}
function padDateValue(value,threedigits)
{if(!threedigits)
{if(value>9)
return''+value;return'0'+value;}
if(value>9)
{if(value>99)
return''+value;return'0'+value;}
return'00'+value;}
function getTimestamp()
{var ts="";var now=new Date();ts+=now.getFullYear();ts+=padDateValue(now.getMonth()+1,false);ts+=padDateValue(now.getDate(),false)+'-';ts+=padDateValue(now.getHours(),false);ts+=padDateValue(now.getMinutes(),false);ts+=padDateValue(now.getSeconds(),false);return ts;}
function addTimestamp(filename)
{var wpos=filename.lastIndexOf('.');if(wpos<0)
return filename+'-'+getTimestamp();return filename.substring(0,wpos)+'-'+getTimestamp()+filename.substring(wpos);}
function create_option(theselectobj,thetext,thevalue)
{theselectobj.options[theselectobj.options.length]=new Option(thetext,thevalue);}
function slashdecode(str)
{var out=new String();var pos=0;for(var i=0;i<str.length-1;i++)
{var c=str.charAt(i);if(c=='\\')
{out+=str.substr(pos,i-pos);pos=i+2;var c1=str.charAt(i+1);i++;if(c1=='\\'){out+="\\";}else if(c1=='r'){out+="\r";}else if(c1=='n'){out+="\n";}else{i--;pos-=2;}}}
if(pos<str.length)
out+=str.substr(pos);return out;}
var zindex_max=1;function print_time(h,m,s,format,hIsAM,convention,am,pm)
{var res=format;var isAM=hIsAM;if(convention==12&&h>12)
{h-=12;isAM=false;}
var hh=parseInt(h);if(isNaN(hh))
hh=0;var mm=parseInt(m);if(isNaN(mm))
mm=0;var ss=parseInt(s);if(isNaN(ss))
ss=0;if(hh<10)
hh="0"+hh.toString();if(mm<10)
mm="0"+mm.toString();if(ss<10)
ss="0"+ss.toString();res=res.replace(/mm/,mm);res=res.replace(/ss/,ss);res=res.replace(/m/,m);res=res.replace(/s/,s);res=res.toLowerCase();if(convention==12)
{var t=isAM?am:pm;res=res.replace(/hh/,hh);res=res.replace(/h/,h);res=res.replace(/t+/,t);}
else
{res=res.replace(/hh/,hh);res=res.replace(/h/,h);}
return res;}
function UnlockRecord(page,keys,sid,func)
{params={action:'unlock',keys:escape(keys),sid:sid,rndval:Math.random()};var xmlhttp=$.get(page,params,function(xml)
{});if(!func)
return;var mscount=0;tfunc=function()
{if(mscount>=600||xmlhttp.readyState>=2)
{func();return;}
mscount+=5;setTimeout(tfunc,5);}
tfunc();}
function ConfirmLock(page,table,keys,id,mode)
{params={action:'confirm',keys:escape(keys),rndval:Math.random()};$.get(page,params,function(xml)
{if(xml!='')
{var arrCntrl=Runner.controls.ControlManager.getAt(table);for(var i=0;i<arrCntrl.length;i++)
arrCntrl[i].setDisabled();$('#system_div'+id).html(xml);$('#center_block'+id).css('margin-top','60px');$('#system_div'+id).css('display','block');$('#saveButton'+id).attr('disabled','true');$('#saveButton'+id).css('background-color','#dcdcdc');clearInterval(window['timeid'+id]);}});}
function UnlockAdmin(page,table,keys,oldid,startEdit,pageid)
{params={action:'lockadmin',keys:escape(keys),startEdit:startEdit,oldid:oldid,rndval:Math.random()};$.get(page,params,function(xml)
{if(xml=='lock')
{var arrCntrl=Runner.controls.ControlManager.getAt(table);for(var i=0;i<arrCntrl.length;i++)
arrCntrl[i].setEnabled();$('#saveButton'+pageid).attr('disabled','');$('#saveButton'+pageid).attr('style','');$('#message_block'+pageid).empty();}
$('#system_div'+pageid).css('display','none');$('#center_block'+pageid).css('margin-top','0');});}
function UnlockRecordInline(page,keys,id)
{window.clearInterval(window["timeid"+id]);if(!keys)
return;var tmparr=new Array();var key,pos;key="";tmparr=keys.split("&");for(var i=0;i<tmparr.length;i++)
{pos=tmparr[i].indexOf("=");key=key+tmparr[i].substr(pos+1)+"&";}
key=key.substr(0,key.length-1);params={action:'unlock',keys:escape(key),rndval:Math.random()};$.get(page,params,function(xml)
{});}
function checkValidSimplePage(formname,tName)
{var arrCntrl=Runner.controls.ControlManager.getAt(tName);var form=$('#'+formname);var valRes=true;var isFocused=false;for(var i=0;i<arrCntrl.length;i++)
{var vRes=arrCntrl[i].validate();if(vRes.result)
{if(arrCntrl[i].getControlType()=='RTE'&&arrCntrl[i].useRTE)
{var clone=arrCntrl[i].getForSubmit();$(clone).prependTo(form);}}
else{valRes=false;if(!isFocused)
{arrCntrl[i].setFocus();isFocused=true;}}}
return valRes;}
function htmlSpecialChars(str,quote_style)
{str=str+"";str=str.replace(/&/ig,"&amp;");if(!quote_style||quote_style==1)
{str=str.replace(/\"/ig,"&quot;")
if(quote_style==1)
str=str.replace(/\'/ig,"&#039;")}
str=str.replace(/\>/ig,"&gt;");str=str.replace(/\</ig,"&lt;");return str;}
function getTableObj(id)
{var gBlock=getGridBlock(id);if(!gBlock)
return false;var tag=$(gBlock).tagName();var table;if(tag=='div')
table=$('table:first',gBlock);else if(tag=='table')
table=$(gBlock);else
return false;if(!$(table).length)
return false;else
return table;}
function getGridBlock(id)
{var gBlock=$("#grid_block"+id);if(!$(gBlock).length)
{gBlock=$("#resize_cell"+id);if(!$(gBlock).length)
return false;}
return gBlock;}
function getParentTableObj(id)
{var gBlock=getGridBlock(id);if(!gBlock)
return false;var tag=$(gBlock).tagName();var parent;if(tag=='div')
parent=gBlock;else if(tag=='table')
{parent=$(gBlock).parent();if($(parent).tagName()!='div')
return false;if($(parent).attr('id')!='grid_block'+id&&$(parent).attr('id')!='resize_cell'+id)
return false;}
else
return false;if(!$(parent).length)
return false;else
return parent;}
function setHoverForTR(tr,id,h,s,r)
{var table=getTableObj(id);if(!table)
return false;if(!tr)
{if(r)
tr='tr[@id^=yui-rec]';else
tr='tr[@id^=gridRow]';}
$(tr,table).each(function()
{$(this).hover(function()
{if(h)
$(this).addClass('rowhighlited');if(s)
$(this).addClass('rowselected');},function()
{if(h)
$(this).removeClass('rowhighlited');if(s)
$(this).removeClass('rowselected');});});}
function showErrorLockDelRec(id,lockRecIds)
{for(var i=0;i<lockRecIds.length;i++)
{var root=getTableObj(id);if(!root)
return false;var span=$("span[@id^=edit"+lockRecIds[i]+"_]:eq(0)",root);$('input[@id=check'+id+'_'+lockRecIds[i]+']').attr('checked','checked');createInlineError(lockRecIds[i],span,"Record can't be delete. It's editing by another user.");}}
function createInlineError(id,parElem,txt)
{if(!parElem)
return;$(parElem).children("div.error").remove();$(parElem).append("<div class=error><a href=# id=\"error_"+id+"\" style=\"white-space:nowrap;\">"+Runner.lang.constants.TEXT_INLINE_ERROR+" >></a></div>");$("#error_"+id)[0].onmouseover=function()
{var error=$("div.inline_error");if(!$(error).length)
{$(document.body).append("<div class=\"inline_error error\"></div>");error=$("div.inline_error");}
$(error).html(slashdecode(txt));$(error).onmouseover=function()
{this.show();}
var coors=findPos(this);coors[0]+=coors[2];coors[1]+=coors[3];$(error).css("top",coors[1]+"px");$(error).css("left",coors[0]+"px");$(error).css("z-index",100);$(error).show();};$("#error_"+id)[0].onmouseout=function()
{$("div.inline_error").hide();}}
function showHideSelectedButtons(id,type)
{if(!id)
return;if(!$('#record_controls'+id).length)
return;var cond=set='';if(type=='show'){cond='none';set='inline';}else if(type=='hide'){cond='inline';set='none';}else
return;var selectAllSpan=$("[@name = select_all"+id+"]").parent();var deleteSelectedSpan=$("[@name = delete_selected"+id+"]").parent();var printSelectedSpan=$("[@name = print_selected"+id+"]").parent();var exportSelectedSpan=$("[@name = export_selected"+id+"]").parent();if($(selectAllSpan).length&&$(selectAllSpan).css('display')==cond)
$(selectAllSpan).css('display',set);if($(deleteSelectedSpan).length&&$(deleteSelectedSpan).css('display')==cond)
$(deleteSelectedSpan).css('display',set);if($(printSelectedSpan).length&&$(printSelectedSpan).css('display')==cond)
$(printSelectedSpan).css('display',set);if($(exportSelectedSpan).length&&$(exportSelectedSpan).css('display')==cond)
$(exportSelectedSpan).css('display',set);}
function runLoading(id,root,mode)
{if(!root)
return;if(mode!=3)
{var size_root=[],loadLeft=loadTop=elLimitH=elFixedH=0;$(root).prepend(createLoadingForSimplePage(id));var loadMain=$("#load_main"+id);var loadfon=$("#load_fon"+id);if(IsIE6())
var frame=$("#frame_loading"+id);size_root=getWindowDimensions();if(!mode)
{loadLeft=size_root[0]/2-75;loadTop=size_root[1]/2-25;if(IsIE6())
{$(frame).css("width",""+size_root[0]+"px");$(frame).css("height",""+size_root[1]+"px");}}else{var el=getAbsolutePosition($(root)[0],1);$(loadfon).css("width",""+el.w+"px");$(loadfon).css("height",""+el.h+"px");if(IsIE6())
{$(frame).css("width",""+el.w+"px");$(frame).css("height",""+el.h+"px");}
elLimitW=(el.l+el.w)-size_root[0];elFixedW=el.w-elLimitW;loadLeft=elFixedW/2+(el.l-75);elLimitH=(el.t+el.h)-size_root[1];elFixedH=el.h-elLimitH;loadTop=elFixedH/2+(el.t-25);}
$(loadMain).css("left",""+loadLeft+"px");$(loadMain).css("top",""+loadTop+"px");$("#loading"+id)[0].className="load_go";}
else
$(root).prepend(getLoadingBlock(id,mode));}
function stopLoading(id,mode)
{$("#loading"+id).remove();if(mode==3)
{$("#loaded_content"+id).css('position','static');$("#loaded_content"+id).css('left','0px');}}
function getLoadingBlock(id,mode)
{return'<div id="loading'+id+'" name="loadingDiv" align = "center">'+'<img src="include/img/loading.gif" align="absmiddle">&nbsp;&nbsp;'+'<span class="load_text">Loading .....</span>'+'</div>';}
function createLoadingForSimplePage(id)
{var loadCode='<div class="load_hide" id="loading'+id+'" name="loadingDiv">'+'<style>'+'div.load_go {display:block;}'+'div.load_hide {display:none;}'+'#load_fon'+id+'{'+' position:absolute;'+' width:100%;'+' height:100%;'+' z-index:3000;'+' background-color:#000;'+' opacity: 0.20;'+' filter: alpha(opacity=20);}'+'#load_main'+id+'{'+' position:absolute;'+' z-index:4000;}'+'#load_main'+id+' div.load_block1{'+' width:150px;'+' height:50px;'+' cursor:auto;}'+'#load_main'+id+' div.load_block2 {padding:12px 0;}'+'#load_main'+id+' span.load_text{'+' margin-left:10px;'+' font-size:12px;'+' vertical-align:middle;'+' font-weight:bold;}'+
(IsIE6()?'#frame_loading'+id+'{'+' background:white;'+' position:absolute;'+' display:block;'+' opacity:0.0;'+' filter:alpha(opacity=0);'+' z-index:1000;}':'')+'</style>'+'<div id = "load_main'+id+'">'+' <table cellspacing="0" cellpadding="0" border="0">'+'  <tr>'+'   <td>'+'    <div class="load_block1" align="center">'+'     <div class="load_block2"><img src="include/img/loading.gif" align="absmiddle"><span class="load_text">Loading .....</span></div>'+'    </div>'+'   </td>'+'  </tr>'+' </table>'+'</div>'+
(IsIE6()?'<iframe src="javascript:false;" id="frame_loading'+id+'" frameborder="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>':'')+'<div id = "load_fon'+id+'"> </div>'+'</div>';return loadCode;}
function parse_datetime(str,dmy)
{if(str==null)
return null;var re=/\d+/g;var arr=str.match(re);var dt;if(arr==null||arr.length<3)
return null;while(arr.length<6)
arr[arr.length]=0;if(dmy==1)
dt=new Date(arr[2],arr[1]-1,arr[0],arr[3],arr[4],arr[5]);else if(dmy==0)
dt=new Date(arr[2],arr[0]-1,arr[1],arr[3],arr[4],arr[5]);else
dt=new Date(arr[0],arr[1]-1,arr[2],arr[3],arr[4],arr[5]);if(isNaN(dt))
return null;if(dmy==1&&(dt.getMonth()!=arr[1]-1||dt.getDate()!=arr[0]||dt.getFullYear()!=arr[2]))
return null;if(dmy==0&&(dt.getMonth()!=arr[0]-1||dt.getDate()!=arr[1]||dt.getFullYear()!=arr[2]))
return null;if(dmy==2&&(dt.getMonth()!=arr[1]-1||dt.getDate()!=arr[2]||dt.getFullYear()!=arr[0]))
return null;return dt;}
var calc508column=true;var s508td;var s508column=-1;function section508setEvents(pageid,focusedControl,setFocusInTD)
{var sObj=getTableObj(pageid);if(!sObj)
return false;if($(sObj).attr("s508table")==undefined)
{sObj.attr("s508table","true");setFocusFirstElement(sObj);}
var s508eventArrow=function(e)
{calc508column=true;if(e.which==40)
{calc508column=false;click_arrow(this,"next",s508column,sObj);}
else if(e.which==38)
{calc508column=false;click_arrow(this,"prev",s508column,sObj);}
else if(e.which==9)
calc508column=true;else
{calc508column=true;}}
var focusHandler=function()
{if(calc508column)
{s508column=getControlColumn(this);}}
sObj.find("td,th").find("input,a,textarea,select").each(function()
{if(!$(this).attr("event508"))
{$(this).attr("event508","true");$(this).bind("keydown",s508eventArrow);$(this).bind("focus",focusHandler);}});if(focusedControl)
{s508column=getControlColumn(focusedControl.spanContElem);}
if(setFocusInTD&&s508td)
{setTimeout(function(){$(s508td).find("input:first,a:first,textarea:first,select:first").focus();},100);$(s508td).find("a[@id^=ieditlink"+pageid+"_]").bind("keydown",function(e)
{if(e.altKey&&e.which==69)
{$(this).click();}});}}
function getControlColumn(control)
{var parentTr=find508tr(control);var parentTrFound=false;var tdObj;$(control).parents().each(function(k,elem)
{if(parentTrFound)
return;if(elem===parentTr)
parentTrFound=true;if($(elem).tagName()=="td")
tdObj=elem;});var numberTd=0;var colspanAttr="";var tdFound=false;$(parentTr).children().each(function(k,elem)
{if(elem===tdObj)
tdFound=true;if(tdFound)
return;numberTd++;colspanAttr=$(elem).attr("colspan");if(colspanAttr)
numberTd+=parseInt(colspanAttr)-1;});s508td=tdObj;return numberTd;}
function find508tr(control)
{var trObj;var mainTableFound=false;$(control).parents().each(function(k,elem){if(mainTableFound)
return;if($(elem).tagName()=="tr")
trObj=elem;if($(elem).attr("s508table")=="true")
mainTableFound=true;});return trObj;}
function click_arrow(control,param,colnum,table)
{var tr=$(find508tr(control));if(param=="next")
var trobj=$(tr).next();else
var trobj=$(tr).prev();while($(trobj).find("input,a,textarea,select").length==0&&$(trobj).get(0)||$(trobj).css("display")=="none")
if(param=="next")
trobj=$(trobj).next();else
trobj=$(trobj).prev();if(param=="prev"&&!$(trobj).get(0)&&$(tr).parents().tagName()=="tbody"&&$(table).find("thead").find("tr:visible,tr:first").length>0)
trobj=$(table).find("thead").find("tr:visible,tr:first");if(param=="next"&&!$(trobj).get(0)&&$(tr).parents().tagName()=="thead"&&$(table).find("tbody").find("tr:visible,tr:first").length>0)
trobj=$(table).find("tbody").find("tr:visible,tr:first");var altElem;var focusSet=false;if(colnum==-1)
$(trobj).find("input:first,a:first,textarea:first,select:first").focus();else
{$(trobj).children().each(function(k,elem){if($(elem).find("input:first,a:first,textarea:first,select:first").length>0)
{if(k<colnum&&altElem||!altElem)
altElem=elem;if(k==colnum)
{$(elem).find("input:first,a:first,textarea:first,select:first").focus();focusSet=true;}}});if(!focusSet&&altElem)
$(altElem).find("input:first,a:first,textarea:first,select:first").focus();}}
function setFocusFirst(sObj)
{sObj.find("td:first").find("input:first,a:first,textarea:first,select:first").focus();}
function setFocusFirstElement(sObj)
{sObj.find("tbody").find("tr:first").next().find("input:first,a:first,textarea:first,select:first").focus();}
function getURLParam(name)
{name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(window.location.href);if(results==null)
return"";else
return results[1];}
function s508pagination(pageid)
{var s508eventPagination=function(e)
{NumberPage=getURLParam("goto");if(NumberPage=="")
NumberPage=1;if(e.ctrlKey&&e.which==37)
{if(NumberPage>1)
{NumberPage--;eval("GotoPage"+pageid+"(NumberPage);");}
else
NumberPage=1;}
if(e.ctrlKey&&e.which==39)
{if(NumberPage<window.MaxWindowPage)
{NumberPage++;eval("GotoPage"+pageid+"(NumberPage);");}
else
NumberPage=window.MaxWindowPage;}}
$(document).bind("keydown",s508eventPagination);}
function s508jumpto(pageid)
{var s508eventJumpTo=function(e)
{if(e.altKey&&e.which==70)
{$("#ctlSearchFor"+pageid).focus();}
if(e.altKey&&e.which==77)
{$("#toplinks_block"+pageid).find("input:first,a:first,textarea:first,select:first").focus();}}
$(document).bind("keydown",s508eventJumpTo);}
function s508inlineEdit(pageid)
{$("a[@id^=ieditlink"+pageid+"_]").each(function()
{var parent_tr=$(this).parent("td").parent("tr");var record_id=this.id;parent_tr.find("input,a,textarea,select").each(function()
{$(this).bind("keydown",function(e)
{if(e.altKey&&e.which==69)
{$("#"+record_id).click();}});});});}
function cloneElements(jq)
{var cloneBoxes=[];jq.each(function(i,n){if(n.type=="checkbox"&&!n.checked)
return;var cln=$('<input type=hidden>');cln.attr('name',$(n).attr('name'));cln.val($(n).val());cloneBoxes.push(cln);});return cloneBoxes;}