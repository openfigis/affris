var debug=false;
var removeflyframe;
function DisplayPage(event,page, control,field,tablename,category)
{
	flyid++;
	var id = flyid;
	
	var x,y;
	if($.browser.msie)
	{
		y = event.y;
		x = event.x;
	}
	else
	{
		y = event.clientY;
		x = event.clientX;
	}
	var params;
	var pagetype;
	if(page.indexOf("_add.")>0)
	{
		params={
			editType:"onthefly",
			id:id,
			rndval: Math.random(),
			editType: "onthefly",
			control: control,
			field: field,
			table: tablename,
			category: category
		};
		pagetype="add";
	}
	else if(page.indexOf("_list.")>0)
	{
		params={
			id:id,
			rndval: Math.random(),
			mode: "lookup",
			control: control,
			field: field,
			table: tablename,
			category: category,
			firsttime: 1
		};
		pagetype="list";
	}
	else
		return;
		
		
	$.get(page,	params,
		function(xml)
		{
			var i=xml.indexOf("\n");
			var js="";
			if(i>=0)
			{
				js = slashdecode(xml.substr(0,i));
				xml = xml.substr(i+1);
			}
			if(debug)
			{
				$(document.body).append("<textarea id=htm"+id+" cols=50 rows=10></textarea>");
				$("#htm"+id).text(xml);
			}
			DisplayFlyDiv(xml,js,id,control,x,y-20,pagetype);
		}
	);
	return false;
}

function RemoveFlyDiv(id, dontremoveiframe,type)
{
	$("#fly"+id).remove();	

	if(!dontremoveiframe)
	{
		removeflyframe = $("#flyframe" + id)[0];
		setTimeout('$(removeflyframe).remove()',1);
	}
	if(type=='save')
		attr();
	if(IsIE6())
		$("#fli"+id).remove();
	$("#shadow"+id).remove();
}
 
function DisplayFlyDiv(html,js,id,control,x,y,pagetype)
{
	window["postloadstep"+(id ? "_"+id : "")+"_worked"]=false;
	var w='width:inherit;';
	if(IsIE6())
		$(document.body).append("<iframe id='fli"+id+"' frameborder=\"0\" vspace=\"0\" hspace=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\" style='background:white; position:absolute;display:none;opacity:0;filter:alpha(opacity=0);' > </iframe>");
	if($.browser.msie)
		w = 'width:55%;';
	$(document.body).append("<div id='flycontainer"+id+"' style='position:absolute;'>"
		+"<div align=center pagetype='"+pagetype+"' id='fly"+id+"' style='"+w+"border:solid #434343 1px; background:white; background-repeat:no-repeat;overflow:hidden;'  control='"+control+"'  onmousedown='flydivonclick(this,"+id+");'></div></div>");
	var title="";
	var titlebar="<div id=display_fly"+id+" onmousedown='fly_mousedown_func(event,this.parentNode,"+id+")' class='blackshade' style='padding:5px 10px;border-bottom:solid black 1px;text-align:right;cursor:move;'><span style='float:left;'> "+title+"</span><img src='images/cross.gif' style='cursor:pointer;' onclick=\"RemoveFlyDiv('"+id+"');\"></div>";
	var container="<div id='flycontents"+id+"' style='padding: 0px 10px 10px 10px; margin:0 4px 4px 4px;overflow:auto;'>";
	var htm=titlebar+container+"</div>";
	$("#fly"+id).html(htm);
	$("#flycontents"+id).append(html);
	var flydiv=$("#fly"+id)[0];
	$(flydiv).css("top","-10000px");
	w = flydiv.offsetWidth;
	var h = flydiv.offsetHeight;
	var oW = document.body.offsetWidth*.55;
	var sH = screen.height*0.5;
	
	if(w > oW) 
		w = oW;
	if(h > sH) 
		h = sH;
	var flycontents = $("#flycontents"+id)[0];
	Wfcon = flycontents.offsetWidth;
	Hfcon = flycontents.offsetHeight;
	if((w > Wfcon || w < Wfcon) && Wfcon <= oW) 
		w = Wfcon;
	if((h > (Hfcon+35) || h < (Hfcon+35)) && Hfcon <= sH) 
		h = (Hfcon+35);
	
	x += document.body.scrollLeft;
	y += document.body.scrollTop;
	if(document.body.scrollLeft + document.body.clientWidth < x+w)
		x = document.body.scrollLeft + document.body.clientWidth - w-20;
	if(x < document.body.scrollLeft)
		x = document.body.scrollLeft+20;
	if(document.body.scrollTop + document.body.clientHeight < y+flydiv.offsetHeight)
		y = document.body.scrollTop + document.body.clientHeight - flydiv.offsetHeight-20;
	if(y < document.body.scrollTop)
		y = document.body.scrollTop+20;
		
	var color = $("#display_fly"+id).css("background-color");
	$(document.body).append("<div id='shadow"+id+"' style='position:absolute;display:none;background:#ccc;border:none;opacity:0.4;filter:alpha(opacity=40);left:"+(x+8)+";top:"+(y+8)+";width:"+w+";height:"+h+";'>\r\n"
								+"<table width=100% height=100% border=0 cellpadding=0 cellspacing=0 style='background:#666;'>\r\n"
								+" <tr>\r\n"
								+"  <td width='6' height='6' nowrap='nowrap' style='background:url(images/shadow_up_left.gif) top left no-repeat;'></td>\r\n"
								+"  <td style='background:url(images/shadow_up.gif) top right repeat-x;'></td>\r\n"
								+"	<td width='6' nowrap='nowrap' style='background:url(images/shadow_up_right.gif) top right no-repeat;'></td>\r\n"
								+" </tr>\r\n"
								+" <tr>\r\n"
								+"  <td width='6' nowrap='nowrap' style='background:url(images/shadow_left.gif) top left repeat-y;'>&nbsp</td>\r\n"
								+"  <td>&nbsp</td>\r\n"
								+"  <td width='6' nowrap='nowrap' style='background:url(images/shadow_right.gif) top right repeat-y;'>&nbsp</td>\r\n"
								+" </tr>\r\n"
								+" <tr>\r\n"
								+"  <td width='6' height='6' nowrap='nowrap' style='background:url(images/shadow_down_left.gif) left bottom no-repeat;'></td>\r\n"
								+"  <td height='6' style='background:url(images/shadow_down.gif) left bottom repeat-x;'></td>"
								+"  <td width='6' height='6' nowrap='nowrap' style='background:url(images/shadow_down_right.gif) right bottom no-repeat;'></td>\r\n"
								+" </tr>\r\n"
								+"</table>\r\n");								
	var shadow = $("#shadow"+id)[0];
	var style=$("#style")[0];
	if(!style)
	{
		$(document.body).append("<div id='style'></div>\r\n<style>\r\n"
								+".ui-resizable { position: relative; }\r\n"
								+".ui-resizable-handle { position: absolute; display: none; font-size: 0.1px; }\r\n"
								+".ui-resizable .ui-resizable-handle { display: block; }\r\n"
								+"body .ui-resizable-disabled .ui-resizable-handle { display: none; }\r\n"
								+"body .ui-resizable-autohide .ui-resizable-handle { display: none; }\r\n"
								+".ui-resizable-s { cursor: s-resize; height: 4px; width: 100%; bottom: 0px; left: 0px; background: "+color+" repeat-x scroll left top;border-top:1px solid #434343;}\r\n"
								+".ui-resizable-e { cursor: e-resize; width:4px; right: 0px; top: 23px; height:100%; background: "+color+" repeat-y scroll left top ; border-left:1px solid #434343;}\r\n"
								+".ui-resizable-w { cursor: w-resize; width:4px; left: 0px; top: 23px; height:100%; background: "+color+" repeat-y scroll right top; border-right:1px solid #434343;}\r\n"
								+".ui-resizable-se { cursor: se-resize; width: 4px; height: 4px; right: 0px; bottom: 0px; background: "+color+" no-repeat left top; border-left:1px solid "+color+";}\r\n"
								+".ui-resizable-sw { cursor: sw-resize; width: 4px; height: 4px; left: 0px; bottom: 0px;background: "+color+" no-repeat right top; border-right:1px solid "+color+";}\r\n"
								+"</style>\r\n");
	}
	if(IsIE6())
	{
		var flyframe = document.getElementById("fli"+id);
		$(flyframe).css("left","" + (x) + "px");
		$(flyframe).css("top",""+(y)+"px");
		$(flyframe).css("width","" + (w+8) + "px");
		$(flyframe).css("height",""+(h+8)+"px");
		$(flyframe).show();
	}
	var flycontainer = document.getElementById("flycontainer"+id); 
	$(document.body).append($(flydiv).remove());
	document.body.removeChild(flycontainer);
	$(flydiv).css("position","absolute");
	$(flydiv).css("left","" + (x) + "px");
	$(flydiv).css("top",""+(y)+"px");
	$(flydiv).css("width","" + (w) + "px");
	$(flydiv).css("height",""+(h)+"px");
	if(IsIE6())
	{
		$(flycontents).css("width",""+(w-9)+"px");
		$(flycontents).css("height",""+(h-29)+"px");
	}
	else{
			$(flycontents).css("width",""+(w-28)+"px");
			$(flycontents).css("height",""+(h-38)+"px");
		}
	$(shadow).css("display","block");
	flydivonclick(flydiv,id);
	if($.browser.mozilla)
	{
		clientHeight = window.innerHeight;
		clientWidth = window.innerWidth;
	}
	else{
			clientHeight = document.body.clientHeight;
			clientWidth = document.body.clientWidth;
		}
	$("#fly"+id).resizable(
	{
		handles: 's,e,w,se,sw',
		maxHeight: clientHeight,
		maxWidth: clientWidth,
		minWidth: 300,
		minHeight: 300,
		resize: function(e, ui)
		{
			$(shadow).css("left",ui.instance.position.left+8);
			$(shadow).css("top",ui.instance.position.top+8);
			$(shadow).css("width",ui.instance.size.width);
			$(shadow).css("height",ui.instance.size.height);
			if(IsIE6())
			{
				$(flyframe).css("left",ui.instance.position.left+2);
				$(flyframe).css("top",ui.instance.position.top+2);
				$(flyframe).css("width",ui.instance.size.width+6);
				$(flyframe).css("height",ui.instance.size.height+6);
				w = ui.instance.size.width-9;
				h = ui.instance.size.height-29;
			}
			else{
					w = ui.instance.size.width-28;
					h = ui.instance.size.height-38;
				}
			$(flycontents).css("width",""+w+"px");
			$(flycontents).css("height",""+h+"px");	 
		}
	});
	var io = createAddIframe(id,control);
	var form=$("form[@name=editform"+id+"]")[0];
	if(form!=undefined)
	{
		$("input[@type=text],input[@type=password],input[@type=hidden],input[@type=file],select",form).each(function(i)
		{
			if(this.type == "select-multiple")
				this.id = this.name.replace(/\[\]$/,"") + "_" + id;
			else	
				this.id = this.name + "_" + id;
		});
	}
	if(js.length)
	{
		if(debug)
		{
			$(document.body).append("<textarea id=txt"+id+" cols=50 rows=10> </textarea>");
			$("#txt"+id).text(js);
		}
		eval(js);
	}
}

function createAddIframe(id,control)
{
	//create frame
	var frameId = 'flyframe' + id;
//	iframe already exists - reset load counter only
	if($('#'+frameId).length)
	{
		delete $('#'+frameId).loadCount;
//		delete window.frames[frameId].loadCount;
		return;
	}
	if(window.ActiveXObject)
	{
		var iframetxt='<iframe style="position:absolute;opacity:0;filter:alpha(opacity=0);"'+ 
		'onload="if (typeof this.loadCount == \'undefined\'){this.loadCount = 0;return;} var ioDocument = window.frames[\''+frameId+'\'].document;'+
		'ProcessReturn(ioDocument,\''+control+'\','+id+');"'+
		'id="' + frameId + '" name="' + frameId + '" frameborder="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no"/>';
		var io = document.createElement(iframetxt);
	}
	else {
		var io = document.createElement('iframe');
		io.id = frameId;
		io.name = frameId;
		$(io).load(function()
		{
			if (typeof this.loadCount == 'undefined') 
			{
				this.loadCount = 0;
				return;
			}
			var ioDocument = $("#"+frameId).get(0).contentDocument;
			ProcessReturn(ioDocument,control,id);
		});
	}
	io.style.position = 'absolute';
	io.style.top = '-1000px';
	io.style.left = '-1000px';
	document.body.appendChild(io);
	return io;
}

function ProcessReturn(doc,control,id)
{
	if(debug)
	{
		$(document.body).append("<textarea id=err"+id+" cols=50 rows=10></textarea>");
		$("#err"+id).text(doc.body.innerHTML);
	}
	var pagetype=$("#fly"+id).attr("pagetype");
	var txt;
	if($("#data",doc).length)
		txt = $("#data",doc).text();
	else
		txt="error"+doc.body.innerHTML;
	if(txt.substr(0,5)=='added')
	{
		txt=txt.substr(5);
		var blocks=txt.split("\n");
		$.each(blocks,function(i,n){
			blocks[i] = slashdecode(n);
		});

		var fields=blocks[0].split("\n");
		$.each(fields,function(i,n){
			fields[i] = slashdecode(n);
			});
		var lookup = document.getElementById(control);
		if(lookup.tagName=='SELECT')
		{
			create_option(lookup,fields[1],fields[0]);
			if(!lookup.multiple)
				lookup.selectedIndex=lookup.options.length-1;
			else
				lookup.options[lookup.options.length-1].selected=true;
				
		}
		else
		{
			lookup.value=fields[0];
			document.getElementById("display_"+control).value=fields[1];
		}
		if(lookup.onchange)
			lookup.onchange();
		RemoveFlyDiv(id,false,'save');
		
	}
	else if(txt.substr(0,5)=='decli')
	{
		txt = txt.substr(5);
		var y = document.getElementById("fly"+id).offsetTop;
		var x = document.getElementById("fly"+id).offsetLeft;
		$("#data",doc).remove();
		RemoveFlyDiv(id,true);
		DisplayFlyDiv(doc.body.innerHTML,txt,id,control,x,y,pagetype);
	}
	else
	{
		txt = txt.substr(5);
		var y = document.getElementById("fly"+id).offsetTop;
		var x = document.getElementById("fly"+id).offsetLeft;
		RemoveFlyDiv(id,true);
		DisplayFlyDiv(txt,"",id,control,x,y,pagetype);
	}
}

function flydivonclick(div,id)
{
	var shadow=$("#shadow"+id)[0];
	if($.browser.msie)
	{
		div.style.zIndex=++zindex_max;
		shadow.style.zIndex=zindex_max;
		if(IsIE6())
		{
			var fli=$("#fli"+id)[0];
			fli.style.zIndex=zindex_max;
		}		
	}
	else{
			$(div).css("z-index",++zindex_max);
			$(shadow).css("z-index",zindex_max);
		}
}

var fly_mousedown=false;
var fly_offsetx,fly_offsety;
var fly_movingdiv;
var fly_initmove=false;


function fly_mousedown_func(e,div,id)
{
	if(!e)
		e=window.event;
	if(!fly_initmove)
	{
		document.body.oldmousemove=document.body.onmousemove;
		if($.browser.msie)
		{
			document.body.onmousemove = function()
			{
			  var e=window.event
			  var shadow = $("#shadow"+fly_movingdiv.id.substr(3))[0];
			  if(fly_mousedown)
			  {
				fly_movingdiv.style.left = ""+(e.x - fly_offsetx)+"px";
				shadow.style.left = ""+(e.x - fly_offsetx + 8)+"px";
				if(div.offsetTop!=0 && div.offsetTop > 0)
				{
				 fly_movingdiv.style.top = ""+(e.y - fly_offsety)+"px";
				 shadow.style.top = ""+(e.y - fly_offsety + 8)+"px";
				}
				else if(e.y!=0 && e.y > 0)
				{
				 fly_movingdiv.style.top = ""+e.y+"px";
				 shadow.style.top = ""+(e.y + 8)+"px";
				}
				else{
					 fly_movingdiv.style.top = "0px";
					 shadow.style.top = "8px";
					} 
				if(IsIE6())
				{
					var flyframe=document.getElementById("fli"+fly_movingdiv.id.substr(3));
					flyframe.style.left = ""+(e.x - fly_offsetx)+"px";
					if(div.offsetTop!=0 && div.offsetTop > 0)
					   flyframe.style.top = ""+(e.y - fly_offsety)+"px";
					else if(e.y!=0 && e.y > 0)
						 flyframe.style.top = ""+e.y+"px";
					else flyframe.style.top = "0px";	
				}
				
			  }
			  if(document.body.oldmousemove!=null)
				  document.body.oldmousemove();
			}
		}
		else
		{
			document.body.onmousemove = function(e)
			{
			  var shadow = $("#shadow"+fly_movingdiv.id.substr(3))[0];
			  if(fly_mousedown)
			  {
				fly_movingdiv.style.left = (e.clientX - fly_offsetx);
				$(shadow).css("left",(e.clientX - fly_offsetx + 8));
				if(div.offsetTop!=0 && div.offsetTop > 0)
				{
				 fly_movingdiv.style.top = (e.clientY - fly_offsety);
				 $(shadow).css("top",e.clientY - fly_offsety + 8);
				}
				else if(e.clientY!=0 && e.clientY > 0)
				{
				 fly_movingdiv.style.top = e.clientY;
				 $(shadow).css("top",e.clientY + 8);
				}
				else{
						fly_movingdiv.style.top = 0;
						$(shadow).css("top",8);
					}
			  }
			  if(document.body.oldmousemove!=null)
				  document.body.oldmousemove();
			}
		}
		document.body.oldmouseup=document.body.onmouseup;
		document.body.onmouseup=function()
		{
			fly_mousedown=false;
			if(document.body.oldmousemove)
				document.body.oldmousemove();
		}
		fly_initmove=true;
	}
	fly_mousedown=true;
	if($.browser.msie)
	{
		fly_offsetx = e.x - div.offsetLeft;
		if(div.offsetTop!=0 && div.offsetTop > 0)
		   fly_offsety = e.y - div.offsetTop;
		else if(e.clientY!=0 && e.y > 0)
		        fly_offsety = e.y;
		else fly_offsety = 0;
	}
	else
	{ 
		fly_offsetx = e.clientX - div.offsetLeft;
		if(div.offsetTop!=0 && div.offsetTop > 0)
		   fly_offsety = e.clientY - div.offsetTop;
		else if(e.clientY!=0 && e.clientY > 0)
		        fly_offsety = e.clientY;
		else fly_offsety = 0;
	}
	fly_movingdiv = div;	
}

var onthefly_included=true;
