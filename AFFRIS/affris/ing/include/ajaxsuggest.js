
var cur=-1;var suggestValues=new Array();var lookupValues=new Array();var masterDetails={flag:"",counter:0,show:false}
var isLookupError=false;var RollDetailsLink={timeout:null,showPopup:function(obj,str)
{clearTimeout(this.timeout);if($('#master_details').css("display")=='none'||(str!=undefined&&str!=masterDetails.flag))
{this.timeout=setTimeout(function()
{masterDetails.flag=str;masterDetails.show=true;masterDetails.counter++;$.get(str,{counter:masterDetails.counter,rndVal:(new Date().getTime())},function(txt)
{if(!masterDetails.show)
return;var str=txt.split("counterSeparator");if(masterDetails.counter==str[1])
{if($.browser.msie)
str[0]='<iframe id="iframe" style="position:absolute;border:none;left:-1px;top:-1px;filter:alpha(opacity=0);z-index:-1;"></iframe>'+str[0];$("#master_details").html(str[0]);}
setLyr(obj,"master_details");$("#master_details").css("display","block");var preview=$("#master_details").get(0);Left_Top(preview);});},200);}},hidePopup:function()
{masterDetails.show=false;if($('#master_details').css("display")=='none')
{clearTimeout(this.timeout);}
else{this.timeout=setTimeout(function()
{$("#master_details").css("display","none");$("#master_details").html("");},10);}}}
$(document).click(function(){DestroySuggestDiv();});function Left_Top(preview){if(!masterDetails.show){return;}
var scrollBarWidth=16;var objectOffsetFromBorders=2;var oLeft=preview.offsetLeft;var oTop=preview.offsetTop;var oWidth=preview.offsetWidth;var oHeight=preview.offsetHeight;var dimArr=getWindowDimensions();var clientWidth=dimArr[0];var clientHeight=dimArr[1];var scrollArr=getScrollXY();var scrollX=scrollArr[0];var scrollY=scrollArr[1];var viewBottomX=clientWidth+scrollX;var elementBottomX=oLeft+oWidth;if(elementBottomX>viewBottomX){var newLeft=oLeft-(elementBottomX-viewBottomX)-objectOffsetFromBorders;newLeft-=scrollBarWidth;if(newLeft<0){newLeft=0;}
$(preview).css("left",""+newLeft+"px");}
var viewBottomY=clientHeight+scrollY;var elementBottomY=oTop+oHeight;if(elementBottomY>viewBottomY){var newTop=oTop-(elementBottomY-viewBottomY)-objectOffsetFromBorders;newTop-=scrollBarWidth;if(newTop<0){newTop=0;}
$(preview).css("top",""+newTop+"px");}
$("#iframe").css("width",""+oWidth+"px");$("#iframe").css("height",""+oHeight)+"px";}
function IsInArray(array,value,caseSensitive)
{var i;for(i=0;i<array.length;i++){if(caseSensitive){if(array[i]==value){return true;}}else{if(array[i].toLowerCase()==value.toLowerCase()){return true;}}}
return false;};function DestroySuggestDiv()
{cur=-1;$("#search_suggest").html("");$("#search_suggest").css({visibility:"hidden"});$("#search_suggest_iframe").remove();}
function PtInBox(oElement)
{var bFlag=false;var el=$("#search_suggest")[0];var left=findPos(oElement)[0];var top=findPos(oElement)[1];var width=findPos(oElement)[2];var height=findPos(oElement)[3];if(left>=el.offsetLeft&&left<=(el.offsetLeft+el.offsetWidth)&&top>=el.offsetTop&&top<=(el.offsetTop+el.offsetHeight)){bFlag=true;}
if((left+width)>=el.offsetLeft&&(left+width)<=(el.offsetLeft+el.offsetWidth)&&top>=el.offsetTop&&top<=(el.offsetTop+el.offsetHeight)){bFlag=true;}
if(left>=el.offsetLeft&&left<=(el.offsetLeft+el.offsetWidth)&&(top+height)>=el.offsetTop&&(top+height)<=(el.offsetTop+el.offsetHeight)){bFlag=true;}
if((left+width)>=el.offsetLeft&&(left+width)<=(el.offsetLeft+el.offsetWidth)&&(top+height)>=el.offsetTop&&(top+height)<=(el.offsetTop+el.offsetHeight)){bFlag=true;}
if((left<=el.offsetLeft&&(left+width)>=(el.offsetLeft+el.offsetWidth))&&((el.offsetTop+el.offsetHeight)>=top&&el.offsetTop<=(top+height))){bFlag=true;}
if(bFlag){return true;}
return false;}
function setLyr(obj,lyr)
{var coors=findPos(obj);if(lyr=='master_details')coors[0]+=(coors[2]+5);if(lyr=='search_suggest')coors[1]+=coors[3];$("#"+lyr).css("top",coors[1]+"px");$("#"+lyr).css("left",coors[0]+"px");}
function moveUp(oElement,searchType)
{if($("#search_suggest").children().length>0&&cur>=-1)
{cur--;if(cur==-2){cur=$("#search_suggest").children().length-1;oElement.focus();}
for(var i=0;i<$("#search_suggest").children().length;i++)
{if(i==cur)
{$("#search_suggest").children().get(i).className="suggest_link_over";oElement.value=suggestValues[cur].replace(/\<(\/b|b)\>/gi,"");}
else
{$("#search_suggest").children().get(i).className="suggest_link";}}}}
function moveDown(oElement,searchType)
{if($("#search_suggest").children().length>0&&cur<($("#search_suggest").children().length))
{cur++;for(var i=0;i<$("#search_suggest").children().length;i++)
{if(i==cur)
{$("#search_suggest").children().get(i).className="suggest_link_over";oElement.value=suggestValues[cur].replace(/\<(\/b|b)\>/gi,"");}
else
{$("#search_suggest").children().get(i).className="suggest_link";}}
if(cur==($("#search_suggest").children().length)){cur=-1;oElement.focus();}}}
function suggestOver(div_value)
{$("div.suggest_link_over").each(function(){this.className='suggest_link';});div_value.className='suggest_link_over';cur=div_value.id.substring(10);}
function suggestOut(div_value)
{div_value.className='suggest_link';}
function listenEvent(oEvent,oElement,searchController)
{oEvent=window.event||oEvent;var iKeyCode=oEvent.keyCode;switch(iKeyCode)
{case 38:moveUp(oElement);break;case 40:moveDown(oElement);break;case 13:DestroySuggestDiv();searchController.submitSearch();break;case 9:DestroySuggestDiv();break;}
return true;}
function setSearch(inputName,value)
{if(setSearch.arguments[2]=='lookup'){isLookupError=false;var helement=$("#"+inputName.substring(8)+setSearch.arguments[4])[0];$("#"+inputName+setSearch.arguments[4]).removeClass("highlight");$("#"+inputName+setSearch.arguments[4]).val(value);if($(helement).val()!=setSearch.arguments[3])
{$(helement).val(setSearch.arguments[3]);$(helement).change();}}
else
$("input[@type=text][@name="+inputName+"]").val(value);DestroySuggestDiv();}
function searchSuggest(oEvent,oElement,searchType,SUGGEST_TABLE,id)
{if(typeof id=='undefined'){id=1;}
oEvent=window.event||oEvent;var iKeyCode=oEvent.keyCode;var legalKeys=[8,32,46,191,192,222];var sType="";switch(searchType)
{case"ordinary":var fieldForSearch=$("select#ctlSearchField");if(!fieldForSearch.length){fieldForSearch=$("#simpleSrchFieldsCombo"+id);}
if(fieldForSearch.length){fieldForSearch=fieldForSearch.val();}else{fieldForSearch='';}
var sType=$("#ctlSearchOption");if(!sType.length){sType=$("#simpleSrchFieldsCombo"+id);}
if(sType.length){sType=sType.val();}
break;case"advanced":var fieldForSearch=oElement.name.substring(6);if($("[@name=asearchopt_"+fieldForSearch+"]").length)
sType=$("[@name=asearchopt_"+fieldForSearch+"]").val();break;case"advanced1":var fieldForSearch=oElement.name.substring(7);if($("[@name=asearchopt_"+fieldForSearch+"]").length)
sType=$("[@name=asearchopt_"+fieldForSearch+"]").val();break;}
if(((iKeyCode>=65)&&(iKeyCode<=90))||((iKeyCode>=48)&&(iKeyCode<=57))||((iKeyCode>=96)&&(iKeyCode<=111))||IsInArray(legalKeys,iKeyCode,true)){cur=-1;$.get(SUGGEST_TABLE,{searchFor:oElement.value,searchField:(fieldForSearch?fieldForSearch:''),rndVal:(new Date().getTime()),start:(sType=="Starts with ..."?1:0),searchType:searchType},function(txt){suggestOkIndicator=txt.indexOf('suggest_success')==0;txt=txt.substr('suggest_success'.length);if(txt&&suggestOkIndicator){if(Runner.isIE6){$(document).find('body').append('<iframe src="javascript:false;" id="search_suggest_iframe" frameborder="1" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="background:white;position:absolute;display:block;opacity:0;filter:alpha(opacity=0);"></iframe>');suggestFrame=$("#search_suggest_iframe");suggestFrame.css("top",$("#search_suggest").css("top"));suggestFrame.css("left",$("#search_suggest").css("left"));suggestFrame.css("width",$("#search_suggest").css("width"));suggestFrame.css("height",$("#search_suggest").css("height"));}
$("#search_suggest").css({visibility:"visible"});}else{DestroySuggestDiv();}
$("#search_suggest").html("");if($.browser.msie)
$("#search_suggest")[0].style.zIndex=++zindex_max;else
$("#search_suggest").css("z-index",++zindex_max);var str=txt.split("\n");for(var i=0,j=0;i<str.length-1;i++,j++){var suggest='<div id="suggestDiv'+i+'" style="cursor:pointer;" onmouseover="suggestOver(this);" ';suggest+='onmouseout="suggestOut(this);" ';suggest+='onclick="setSearch(\''+oElement.name+'\',suggestValues['+j+'].replace(/\\<(\\/b|b)\\>/gi,\'\'));" ';suggest+='class="suggest_link">'+str[i]+'</div>';$(suggest).appendTo("#search_suggest");suggestValues[j]=str[i];}});}
setLyr(oElement,"search_suggest");}
function searchSuggest_new(oEvent,ctrl,srchTypeCombo,searchType,suggestUrl)
{oEvent=window.event||oEvent;var iKeyCode=oEvent.keyCode;var legalKeys=[8,32,46,191,192,222];var fieldForSearch=ctrl.fieldName;var ctrlTable=ctrl.table,ctrlField=ctrl.fieldName,ctrlId=ctrl.id,ctrlInd=ctrl.ctrlInd;var sType=(srchTypeCombo.length?srchTypeCombo.val():'');if(((iKeyCode>=65)&&(iKeyCode<=90))||((iKeyCode>=48)&&(iKeyCode<=57))||((iKeyCode>=96)&&(iKeyCode<=111))||IsInArray(legalKeys,iKeyCode,true)){cur=-1;$.get(suggestUrl,{searchFor:ctrl.getValue(),searchField:fieldForSearch,rndVal:(new Date().getTime()),start:(sType=="Starts with ..."?1:0),searchType:searchType},function(txt){suggestOkIndicator=txt.indexOf('suggest_success')==0;txt=txt.substr('suggest_success'.length);if(txt&&suggestOkIndicator){if(Runner.isIE6){$(document).find('body').append('<iframe src="javascript:false;" id="search_suggest_iframe" frameborder="1" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="background:white;position:absolute;display:block;opacity:0;filter:alpha(opacity=0);"></iframe>');suggestFrame=$("#search_suggest_iframe");suggestFrame.css("top",$("#search_suggest").css("top"));suggestFrame.css("left",$("#search_suggest").css("left"));suggestFrame.css("width",$("#search_suggest").css("width"));suggestFrame.css("height",$("#search_suggest").css("height"));}
$("#search_suggest").css({visibility:"visible"});}else{DestroySuggestDiv();return;}
$("#search_suggest").html("");if($.browser.msie)
$("#search_suggest")[0].style.zIndex=++zindex_max;else
$("#search_suggest").css("z-index",++zindex_max);var str=txt.split("\n");for(var i=0,j=0;i<str.length-1;i++,j++){var div=document.createElement('DIV');suggestValues[j]=str[i];$(div).attr('id','suggestDiv'+i).css('cursor','pointer').addClass('suggest_link').html(str[i]);$(div).bind('mouseover',function(e){suggestOver(this);});$(div).bind('mouseout',function(e){suggestOut(this);});div.valueIndex=j;$(div).bind('click',function(e){ctrl.setValue(suggestValues[this.valueIndex].replace(/<(\/b|b)>/gi,''));DestroySuggestDiv();});$(div).appendTo("#search_suggest");}});}
setLyr(ctrl.getDispElem().get(0),"search_suggest");}