
/*
+-------------------------------------------------------------------------------+
| Copyright (c) 2006-2007 Andrew G. Samoilov, Alexey Kornilov 			|
| Universal Data Solutions inc.							|
| All rights reserved.                                                  	|
|                                                                       	|
| Redistribution and use in source and binary forms, with or without    	|
| modification, are permitted provided that the following conditions    	|
| are met:                                                              	|
|                                                                       	|
|  Redistributions of source code must retain the above copyright      		|
|   notice, this list of conditions and the following disclaimer.       	|
|  Redistributions in binary form must reproduce the above copyright   		|
|   notice, this list of conditions and the following disclaimer in the 	|
|   documentation and/or other materials provided with the distribution.	|
|                                                                       	|
| THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS     	|
| "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     	|
| LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR  	|
| A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  	|
| OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, 	|
| SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      	|
| LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 	|
| DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY  	|
| THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   	|
| (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE  	|
| OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  	|
+-------------------------------------------------------------------------------+
*/


//var pics = new Array();
var timeoutID = 0;
var gTop;
var gLeft;

var arrStates = new Array('AL','AK','AS','AZ','AR','CA','CO','CT','DE','DC','FM','FL','GA','GU',
'HI','ID','IL','IN','IA','KS','KY','LA','ME','MH','MD','MA','MI','MN','MS','MO','MT','NE','NV',
'NH','NJ','NM','NY','NC','ND','MP','OH','OK','OR','PW','PA','PR','RI','SC','SD','TN','TX','UT',
'VT','VI','VA','WA','WV','WI','WY');


function InlineEditing(tablename,ext,apageid)
{
	this.pageid="";
	this.root = document.body;
	if(apageid)
	{
		this.pageid+=apageid;
		this.root = $("#fly"+this.pageid)[0];
	}
	this.root=$("[@name=maintable]",this.root)[0];
	this.edit_link=tablename+"_edit."+ext;
	this.add_link=tablename+"_add."+ext;
	this.view_link=tablename+"_view."+ext;

this.updatesaveall = function()
{
	if($("a[@id^=save_]",this.root).length)
	{
		if($("[@name=saveall_edited"+this.pageid+"]").parent().css("display")=="none")
		{
			$("[@name=saveall_edited"+this.pageid+"]").parent().css("display","inline");
			$("[@name=revertall_edited"+this.pageid+"]").parent().css("display","inline");
			$("[@name=edit_selected"+this.pageid+"]").parent().css("display","none");
		}
	}
	else
	{
		if($("[@name=saveall_edited"+this.pageid+"]").parent().css("display")!="none")
		{
			$("[@name=saveall_edited"+this.pageid+"]").parent().css("display","none");
			$("[@name=revertall_edited"+this.pageid+"]").parent().css("display","none");
			$("[@name=edit_selected"+this.pageid+"]").parent().css("display","inline");
		}
	}
	$("#addmessage"+this.pageid).hide();
}
	
this.inlineAdd = function(tempid)
{
	var pageid=this.pageid;
	if(!$(".addarea"+pageid).length)
		return;
	var inlineObject=this;
	$(this.root).show();
	$("[@name=notfound_message"+pageid+"]").hide();
	$("#record_controls"+pageid).show();
	var htext = "";
	var hclass = "";
	var hstyle = "";
	var lastelement=$(".addarea"+pageid+":last");
	$(".addarea"+pageid).each(function(i) {
		var row = $(this).clone();
		$(row)[0].className="addarea"+tempid;
		
		$("*",row).each(function(j) {
			if ( this.id == "editlink_add"+pageid ) {
				this.id = "editlink" + tempid;
				$(this).hide();
			} else if( this.id == "ieditlink_add"+pageid ) {
				this.id = "ieditlink" + tempid;
				hclass = $(this).attr("class");
				hstyle = $(this).attr("style");				
				$(this).hide();
			} else if ( this.id == "copylink_add"+pageid ) {
				this.id = "copylink" + tempid;
				$(this).hide();
			} else if ( this.id == "check_add"+pageid ) {
				this.id = "check" + tempid;
				$(this).hide();
			} else if ( this.id == "viewlink_add"+pageid ) {
				this.id = "viewlink" + tempid;
				$(this).hide();
			} else if(this.id.substr(0,7)=="master_" && this.id.substr(this.id.length-4-pageid.length)=="_add"+pageid) {
				this.id=this.id.substr(0,this.id.length-4-pageid.length)+tempid;
				$(this).hide();
			} else if(this.id.substr(0,4+pageid.length)=="add"+pageid+"_") {
				this.id="edit"+tempid+'_'+this.id.substr(4+pageid.length);
			}
		});
		
		$(row).insertAfter(lastelement);
		$(row).show();
	});
	
	var self = $("#ieditlink"+tempid);
	/* change the word Edit for images "Save" and "Revert" */
	if ( $(self).length )
	{		
		htext = $("#ieditlink"+tempid).html();
		mySetOuterHTML(self,'<span id="ieditlink'+tempid+'"><a class="saveEditing" href="#" title="'+TEXT_SAVE+'" id="save_'+tempid+'"><img src="images/ok.gif" border="0" /></a>&nbsp;&nbsp;<a class="revertEditing" href="#" title="'+TEXT_CANCEL+'" id="revert_'+tempid+'"><img src="images/cancel.gif" border="0" /></a></span>');
		$("#ieditlink"+tempid)[0].revertText=htext;
		$("#ieditlink"+tempid)[0].revertClass=hclass;
		$("#ieditlink"+tempid)[0].revertStyle=hstyle;
	}
	this.makeControlsEditable(tempid, "", "add");
	this.updatesaveall();
	$('#gridHeaderTr').show();
	return false;
}

this.inlineEdit = function(record_id,record_key) 
{
	var self = $("#ieditlink"+record_id);
	var inlineObject=this;
	
	/* highlighting edited record */
	$(self).parents("tr").addClass("highlight_row");

	/* change the word Edit for images "Save" and "Revert" */
	if($(self).length)
	{
		var htext = $("#ieditlink"+record_id).html();
		var hclass = $("#ieditlink"+record_id).attr("class");
		var hstyle = $("#ieditlink"+record_id).attr("style");
		mySetOuterHTML(self,'<span id="ieditlink'+record_id+'"><a class="saveEditing" href="#" title="'+TEXT_SAVE+'" id="save_'+record_id+'"><img src="images/ok.gif" border="0" /></a>&nbsp;&nbsp;<a class="revertEditing" href="#" title="'+TEXT_CANCEL+'" id="revert_'+record_id+'"><img src="images/cancel.gif" border="0" /></a></span>');
		$("#ieditlink"+record_id)[0].revertText=htext;
		$("#ieditlink"+record_id)[0].revertClass=hclass;
		$("#ieditlink"+record_id)[0].revertStyle=hstyle;
	}
	$("span[@id^=edit"+record_id+"_]").each(function(i){
		this.revert = this.innerHTML;
	});
	this.updatesaveall();
	/* load HTML controls */
	this.makeControlsEditable(record_id, record_key, "edit");
	return false;
}

this.makeControlsEditable = function (id, key, type) 
{
	var inlineObject=this;
	var controls = new Array();
	var fields = new Array();
	var types = new Array();
	var jscode = "";
	var server_url;
	server_url = ( type == "edit"  ) ? this.edit_link+'?'+key : this.add_link;
	var params=	{	rndval: Math.random(),
			recordID: id,
			editType: "inline",
			browser: $.browser.msie ? "ie" : ""
		};
	if(this.lookuptable && this.lookupfield && this.categoryvalue)
	{
		params.table=this.lookuptable;
		params.field=this.lookupfield;
		params.category=this.categoryvalue;
	}
	
	$.get(server_url,
		params,
		function(xml){	
			window["postloadstep"+(id ? "_"+id : "")+"_worked"]=false;
			var pos=xml.indexOf("<edit_controls>");
			if(pos>0)
				xml=xml.substr(pos);
			var pos1,pos2;
			var oldpos=0;
			while((pos=xml.indexOf("<control",oldpos))>=0)
			{
				pos1=xml.indexOf(">",pos);
				if(pos1<0)
					break;
				pos2=xml.indexOf("</control>",pos1);
				if(pos2<0)
					break;
				var tag=xml.substr(pos,pos1-pos+1);
				var attrpos=tag.indexOf("field=\"");
				if(attrpos<0)
					break;
				attrpos+=7;
				var quotpos=tag.indexOf("\"",attrpos);
				if(quotpos<0)
					break;
				controls[controls.length]=xml.substr(pos1+1,pos2-pos1-1);
				fields[fields.length]=tag.substr(attrpos,quotpos-attrpos);
				attrpos=tag.indexOf("type=\"");
				if(attrpos>0)
				{
					attrpos+=6;
					quotpos=tag.indexOf("\"",attrpos);
				}
				if(attrpos>0 && quotpos>0)
					types[types.length]=tag.substr(attrpos,quotpos-attrpos);
				else
					types[types.length]="";
				oldpos=pos2+10;
			}
			pos=xml.indexOf("<jscode>");
			pos1=xml.indexOf("</jscode>");
			if(pos>=0 && pos1>=0)
				jscode=xml.substr(pos+8,pos1-pos-8);
			

			$.each(controls,function(i,n)
			{
				var span = $("#edit"+id+"_"+fields[i]);
				if ( !$(span).length) 
					return;
				$(span).html(n);
				if(types[i]=="FCK" || types[i]=="Innova" || types[i]=="RTE")
				{
					$(span).attr("type",types[i]);
				}
				else
				{
					$("input[@type=text],input[@type=password],input[@type=hidden],input[@type=file],select",span).each(function(i)
					{
						if ( this.type == "select-multiple"  ) 
						{
							this.id = this.name.replace(/\[\]$/,"") + "_" + id;
						} 
						else{
								this.id = this.name + "_" + id;
							}
					});
					$("img",span).each(function(i)
					{
						if(this.id!=undefined && this.id.substr(0,7)=='trigger')
							return;
						this.id = "img_"+this.name.substr(6) + "_" + id;
						if($(this)[0].tagName=='IMG' && $(this)[0].src.indexOf("?")>=0)
							$(this)[0].src = $(this)[0].src + "&rndVal=" + Math.random();
					});
				}
			//set cursor to the first element
				if(!i)
				{
					var firstelement=$("input[@type=text],input[@type=password],input[@type=file],select",span);
					if(firstelement.length)
						firstelement[0].focus();
				}
			});
			jscode = jscode.replace(/&gt;/ig,"\>");
			jscode = jscode.replace(/&lt;/ig,"\<");
			jscode = jscode.replace(/&amp;/ig,"&");			
			eval(jscode);
			
			if ( type == "add" ) 
			{
				/* save icon click handler */
				$('a[@id=save_'+id+']').click(function()
				{
					if(eval("inlineAddValid"+id+".validate();")) 
					{
						inlineObject.submitInputContent( id, "", "add");
					}
				});

				/* revert icon click handler */
				$('a[@id=revert_'+id+']').click(function()
				{
					$(".addarea"+id).each(function(i)
					{
						$(this).remove();
						inlineObject.updatesaveall();
						if($("[@name=saveall_edited"+inlineObject.pageid+"]").css("display")=="none")
							if($("#usermessage")[0]!=undefined)
								$("#usermessage").html("");
					});
				});			
			} 
			else{			
					/* save icon click handler */
					$('a[@id=save_'+id+']').click(function()
					{
						if(eval("inlineEditValid"+id+".validate();"))
						{
							inlineObject.submitInputContent(id, key, "edit");
						}
					});

					/* revert icon click handler */
					$('a[@id=revert_'+id+']').click(function()
					{		
						$("span[@id^=edit"+id+"_]").each(function(i)
						{
							this.innerHTML = this.revert;
						});
						var htext=this.parentNode.revertText;
						var hclass=this.parentNode.revertClass;
						var hstyle=this.parentNode.revertStyle;
						mySetOuterHTML($(this.parentNode)[0],'<a href="'+inlineObject.edit_link+'?'+key+'" id="ieditlink'+id+'"></a>');
						$("#ieditlink"+id).click(function()
						{ 
							return inlineObject.inlineEdit(id,key); 
						});
						$("#ieditlink"+id).html(htext);
						$("#ieditlink"+id).attr("class",hclass);
						$("#ieditlink"+id).attr("style",hstyle);
						inlineObject.updatesaveall();
						if($("[@name=saveall_edited"+inlineObject.pageid+"]").css("display")=="none")
							if($("#usermessage")[0]!=undefined)
								$("#usermessage").html("");
						$(this).parents("tr").removeClass("highlight_row");
						$("#check"+id).attr("checked",false);
					});			
				}			
		});
}

this.picRefresh = function (id)
{
	$("span[@id^=edit"+id+"]").each(function(i) {
		var rndVal = new Date().getTime();
		$('img',this).each(function()
		{ 
			if(this.src.indexOf("?")>=0)
				this.src+="&rndVal=" + rndVal; 
		});
	});
}

this.submitInputContent = function (id, key, type)
{
	gTop=document.body.scrollTop;
	gLeft=document.body.scrollLeft;
	if($("#usermessage")[0]!=undefined)
		$("#usermessage").html("");
	var value_key = key.split(/&|=/g);
	
	var io = this.createUploadIframe(id, type);
	var form = this.createUploadForm(id, type);
	
	if(type == "edit") 
	{
		for ( i = 0; i < value_key.length; i=i+2 ) 
		{
			$('<input type="hidden" name="'+value_key[i]+'" />').appendTo(form);
			$(form)[0].elements[value_key[i]].value=unescape(value_key[i+1]);
		}
	}
	$("span[@id^=edit"+id+"_]").each(function(i)
	{ 	
		var span=this;
//////Innova or RTE		
		if(($(span).attr("type")=="Innova" || $(span).attr("type")=="RTE") && $("iframe",span).length)
		{
			setDataFromRTEInnova(span,$(span).attr("type"),form,'',id);
			return;
		}
//////FCKEditor		
		if($(span).attr("type")=="FCK")
		{
			var txt = $("input[@type=hidden][@name^=value_]",span);
			if(!txt.length)
				return;
			var name = $(txt)[0].name;
			try
		    {
		        if(typeof(FCKeditorAPI) == "object")
	    	        FCKeditorAPI.GetInstance($(txt)[0].name).UpdateLinkedField();
		    }
		    catch(err) {}
		}
		
		if ( $.browser.msie ) 
		{
			$("[@type=file]",this).each(function()
			{
				$(this).appendTo(form);
				$(this).clone().appendTo(span);
			});
			$("[@type=hidden],[@type=text],[@type=password],[@type=radio][@checked]",this).each(function()
			{
				var name = this.name;
				if ( this.type == 'radio' || $(span).attr("type")=="FCK")
					name = this.name.substr(0,this.name.length-1-(new String(id)).length);
				$('<input type="text" name="' + name + '">').appendTo(form);
				$("[@name="+name+"]",form).val(this.value);

			});
			$("textarea",this).each(function()
			{
				$('<textarea name="'+this.name+'"></textarea>').appendTo(form);
				$("[@name="+this.name+"]",form)[0].innerText=this.value;

			});
		} 
		else{
				$("[@type=hidden],[@type=text],[@type=password],[@type=file],[@type=radio][@checked]",this).each(function()
				{
					$(this).clone().appendTo(form);
					if ( this.name!=undefined && (this.type == 'radio' || $(span).attr("type")=="FCK"))
						$(form)[0].elements[$(form)[0].elements.length-1].name=this.name.substr(0,this.name.length-1-(new String(id)).length);
				});
				$("textarea",this).each(function()
				{
					$('<textarea name="'+this.name+'"></textarea>').appendTo(form);
					$("[@name="+this.name+"]",form).text(this.value);
				});
			}
		$("select",this).each(function()
		{
			var name = this.name;
			if(!this.multiple)
			{
				$('<input type="text" name="' + name + '">').appendTo(form);
				$("[@name="+name+"]",form).val(this.value);
			}
			else
			{
//	multiple select				
				for(i=0;i<this.options.length;i++)
				{
					if(!this.options[i].selected)
						continue;
					var input = $('<input type="text" name="' + name + '">');
					$(input).val(this.options[i].value);
					$(input).appendTo(form);
				}
			}
		});
		$("[@type=checkbox]",this).each(function(i){
			if ( this.checked == true ) {
				$('<input type="hidden" value="'+(this.value?this.value:'on')+'" name="'+this.name+'">').appendTo(form);
			}
			//else {
			//	$('<input type="hidden" value="off" name="'+this.name+'">').appendTo(form);
			//}
		});	
	});
	$(form)[0].submit();
	setTimeout('$("#uploadForm'+id+'").remove()',500);
}


this.setInputContent = function(txt, id, type) 
{
	var inlineObject=this;
	window.scrollTo(gLeft,gTop);

	var new_edit_id = "";
	var new_copy_id = "";
	
	if( txt.substr(0,5) == "error" )
	{
		$("span[@id^=edit"+id+"_]:eq(0)").children("div.error").remove();
		
		$("span[@id^=edit"+id+"_]:eq(0)").append("<div class=error><br/><a href=# id=\"error_" + id + "\" style=\"white-space:nowrap;\">"+TEXT_INLINE_ERROR+" >></a></div>");
		$("#error_"+id)[0].onmouseover=function()
		{
			$("#inline_error").html(slashdecode(txt.substr(5)));

			var coors = findPos(this);
			coors[0] += coors[2];
			$("#inline_error").css("top",coors[1] + "px");
			$("#inline_error").css("left",coors[0] + "px");

			$("#inline_error").show();
		};
		$("#error_"+id)[0].onmouseout=function()
		{
			$("#inline_error").hide();
		}
		
		if ($.browser.msie)
		{
			//set all file radion buttons to '0' - keep
			$("span[@id^=edit"+id+"_]")
			{
				$("input[@type=radio][@name^=type_]",this).each(function(i){
					if($(this)[0].value=='file0' || $(this)[0].value=='upload0')
						$(this)[0].checked=true;
				});

			}
		}
		return;
	}
	else if( txt.substr(0,5) == "decli" )
	{
		$("span[@id^=edit"+id+"_]:eq(0)").children("div.error").remove();
		if ($.browser.msie)
		{
			//set all file radion buttons to '0' - keep
			$("span[@id^=edit"+id+"_]")
			{
				$("input[@type=radio][@name^=type_]",this).each(function(i){
					if($(this)[0].value=='file0' || $(this)[0].value=='upload0')
						$(this)[0].checked=true;
				});

			}
		}
		if($("#usermessage")[0]!=undefined && txt.substr(5).length)
			$("#usermessage").append("<br>"+slashdecode(txt.substr(5)));
		return;
	}

	else if(txt.substr(0,5)!="saved" && txt.substr(0,5)!="savnd")
		return;
	var havedata=true;
	if(txt.substr(0,5)=="savnd")
		havedata=false;
	txt = txt.substr(5);

	var blocks=txt.split("\n");
	$.each(blocks,function(i,n){
		blocks[i] = slashdecode(n);
	});

	while(blocks.length<7)
		blocks[blocks.length]="";
	
	var keys = blocks[0].split("\n");
	keys.splice(keys.length-1,1);
	$.each(keys,function(i,n){
		keys[i] = slashdecode(n);
	});
	
	var values = blocks[1].split("\n");
	values.splice(values.length-1,1);
	$.each(values,function(i,n){
		values[i] = slashdecode(n);
	});
	
	var fields = blocks[2].split("\n");
	fields.splice(fields.length-1,1);
	$.each(fields,function(i,n){
		fields[i] = slashdecode(n);
	});

	var rawvalues = blocks[3].split("\n");
	rawvalues.splice(rawvalues.length-1,1);
	$.each(rawvalues,function(i,n){
		rawvalues[i] = slashdecode(n);
	});
	while(rawvalues.length<values.length)
		rawvalues[rawvalues.length]="";

	var detailtables = blocks[4].split("\n");
	detailtables.splice(detailtables.length-1,1);
	$.each(detailtables,function(i,n){
		detailtables[i] = slashdecode(n);
	});

	var detailkeys = blocks[5].split("\n");
	detailkeys.splice(detailkeys.length-1,1);
	$.each(detailkeys,function(i,n){
		detailkeys[i] = slashdecode(n);
	});
	
	var usermessage=slashdecode(blocks[6]);
	if($("#usermessage")[0]!=undefined && usermessage.length)
		$("#usermessage").append("<br>"+slashdecode(usermessage));
	
	$.each(values,function(i,n){
		var span = $("#edit"+id+"_"+fields[i]);
		if ( $(span)[0] != undefined ) 
		{
			$(span).html(n);
			$(span).attr("val",rawvalues[i]);
		}
	});

	$.each(detailtables,function(i,n){
		var ahref = $("#master"+"_"+n+id);
		if ( $(ahref)[0] != undefined ) 
		{
			var pos=$(ahref)[0].href.indexOf("?");
			$(ahref)[0].href=$(ahref)[0].href.substr(0,pos+1)+detailkeys[i];
			if(havedata)
				$(ahref).show();
			else
				$(ahref).hide();
		}
	});
	
	$.each(keys,function(i,n){
		new_edit_id += "editid"+(i+1)+"="+n+"&";
		new_copy_id += "copyid"+(i+1)+"="+n+"&";
	});

	new_edit_id = new_edit_id.substr(0,new_edit_id.length-1);
	new_copy_id = new_copy_id.substr(0,new_copy_id.length-1);
		
	
	if($("#ieditlink"+id).length)
	{
		var htext=$("#ieditlink"+id)[0].revertText;
		var hclass=$("#ieditlink"+id)[0].revertClass;
		var hstyle=$("#ieditlink"+id)[0].revertStyle;
//		$("#ieditlink"+id).replaceWith('<a href="'+inlineObject.edit_link+'?'+new_edit_id+'" id="ieditlink'+id+'" onclick="return inlineEdit('+id+',\''+new_edit_id+'\');"></a>');
		mySetOuterHTML($("#ieditlink"+id)[0],'<a href="'+inlineObject.edit_link+'?'+new_edit_id+'" id="ieditlink'+id+'"></a>');
		$("#ieditlink"+id).click(function(){
			return inlineObject.inlineEdit(id,new_edit_id);
		});
		if ( !havedata ) { htext=""; }
		$("#ieditlink"+id).html(htext);
		$("#ieditlink"+id).attr("class",hclass);
		$("#ieditlink"+id).attr("style",hstyle);
	}
	this.updatesaveall();
	$("a[@id=editlink"+id+"]").attr('href',inlineObject.edit_link+'?'+new_edit_id);
	$("a[@id=viewlink"+id+"]").attr('href',inlineObject.view_link+'?'+new_edit_id);
	$("a[@id=copylink"+id+"]").attr('href',inlineObject.add_link+'?'+new_edit_id);
	
	if(havedata)
	{
		$("a[@id=editlink"+id+"]").show();
		$("a[@id=viewlink"+id+"]").show();
		$("a[@id=copylink"+id+"]").show();
		$("input[@id=check"+id+"]").show();
	}
		else
	{
		$("a[@id=editlink"+id+"]").hide();
		$("a[@id=viewlink"+id+"]").hide();
		$("a[@id=copylink"+id+"]").hide();
		$("input[@id=check"+id+"]").hide();
	}
//	$(line).removeClass("highlight_row");
	
	var keyblock="";
	for ( i = 0; i < keys.length; i++ ) 
	{
		if(keyblock.length)
			keyblock+="&";
		keyblock+=keys[i];
	}
	if($("#check"+id).length)
	{
		$("#check"+id).val(keyblock);
		$("#check"+id)[0].checked=false;
	}
	
	setTimeout('inlineEditing'+this.pageid+'.picRefresh('+id+')', 500);
	this.calcTotals();
	//	do user-defined actions
	if(this.afterRecordEdited)
		this.afterRecordEdited(id);
}


this.createUploadIframe = function (id, type)
{
	var inlineObject=this;
	//create frame
	var frameId = 'uploadFrame' + id;
    
    if ( window.ActiveXObject ) {
		var io = document.createElement('<iframe onload="if (typeof this.loadCount == \'undefined\') { this.loadCount = 0;	} this.loadCount++; if (this.loadCount > 0) { var ioDocument = window.frames[\''+frameId+'\'].document; if(!$(\'#data\',ioDocument).length) { inlineEditing'+this.pageid+'.setInputContent(\'error\'+ioDocument.body.innerHTML, \''+id+'\', \''+type+'\'); }else {inlineEditing'+this.pageid+'.setInputContent($(\'#data\',ioDocument)[0].innerText, \''+id+'\', \''+type+'\'); } document.body.removeChild(this); }" id="' + frameId + '" name="' + frameId + '" />');
	}
    else {
		var io = document.createElement('iframe');
		io.id = frameId;
		io.name = frameId;
		$(io).load(function(){
			if (typeof this.loadCount == 'undefined') {
				this.loadCount = 0;
			}
			this.loadCount++;
			if (this.loadCount > 0 && this.contentDocument.body.innerHTML!='') {
					var ioDocument = $("#"+frameId).get(0).contentDocument;
					if(!$('#data',ioDocument).length)
						inlineObject.setInputContent( "error"+ioDocument.body.innerHTML, id, type );
					else
						inlineObject.setInputContent( $("#data",ioDocument).text(), id, type );
					setTimeout('$("#'+frameId+'").remove()',500);
				}
		});
	}
    io.style.position = 'absolute';
    io.style.top = '-1000px';
    io.style.left = '-1000px';
	document.body.appendChild(io);

	return io;
}

this.createUploadForm =  function (id, type)
{
	var frameId = 'uploadFrame' + id;
	var formId = 'uploadForm' + id;
	var server_url = ( type == "edit"  ) ? this.edit_link : this.add_link;
	
	var form = $('<form  action="' + server_url + '" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data"></form>');	
	if ( type == "edit" ) {
		$('<input type="hidden" name="a" value="edited">').appendTo(form);
	} else {
		$('<input type="hidden" name="a" value="added">').appendTo(form);	
	}
	$('<input type="hidden" name="editType" value="inline">').appendTo(form);
	$('<input type="hidden" name="recordID" value="' + id + '">').appendTo(form);
	if(this.lookuptable && this.lookupfield && this.categoryvalue)
	{
		$('<input type="hidden" name="table" >').appendTo(form);
		$('<input type="hidden" name="field" >').appendTo(form);
		$('<input type="hidden" name="category" >').appendTo(form);
		$('input[@name=table]',form).val(this.lookuptable);
		$('input[@name=field]',form).val(this.lookupfield);
		$('input[@name=category]',form).val(this.categoryvalue);
	}
	
	
	//set attributes
	$(form).css('position', 'absolute');
	$(form).css('top', '-1200px');
	$(form).css('left', '-1200px');
	$(form).attr('target', frameId);
	$(form).appendTo('body');
	
	return form;
}

this.calcTotals = function()
{
	var root=this.root;
	var inlineObject=this;
	$("span[@id^=total"+this.pageid+"_]",root).each( function(i) 
	{
		var type=$(this).attr("type");
		var field=$(this)[0].id.substr(6);
		var format=$(this).attr("format");
		var total=0;
		var count=0;
		var day=hor=min=sec=nhor=nsec=nmin=avhor=avmin=avsec=0;
		$("span[@id^=edit][@id$=_"+field+"]",root).each( function(j) {
			var val=$(this).attr("val");
			if(!isNaN(val))
			{
				total+=new Number(val);
				count++;
			}
			else if(val!="")
			{	
				if(format=='Time')
				{
					var pr=val.split(":");
					if(pr.length==3)
					{
						nsec=sec+parseInt(pr[2],10);
						if(nsec>59)
						{	
							sec=nsec-60;
							min+=1;
						}
						else sec+=parseInt(pr[2],10);
						nmin=min+parseInt(pr[1],10);  
						if(nmin>59)
						{
							min=nmin-60;
							hor+=1;	
						}
						else min+=parseInt(pr[1],10);
						hor+=parseInt(pr[0],10);
					}	
				}
				count++;
			}
		});
		if(type=="TOTAL")
		{
			if(format=='Time')
			{
				if(hor>23)
				{
					day=inlineObject.round(new Number(hor/24).toString());
					hor=hor-day*24;
				}
				$(this).html((day>0 ? day+'d ' : '')+(hor==0 ? '00' : hor)+':'+(min>9 ? min : (min==0 ? '00' :'0'+min))+':'+(sec>9 ? sec : (sec==0 ? '00' : '0'+sec)));
			} 
			else
				$(this).html(new Number(total).toString());
		}
		else if(type=="AVERAGE")
		{
			if(count)
			{
				if(format=='Time')
				{
					avhor=Math.round(hor/count);
					if(avhor>23)
					{
						day=inlineObject.round(new Number(avhor/24).toString());
						avhor=avhor-day*24;
					}
					avmin=Math.round(min/count);
					avsec=Math.round(sec/count);
					$(this).html((day>0 ? day+'d ' : '')+(avhor==0 ? '00' : avhor)+':'+(avmin>9 ? avmin : (avmin==0 ? '00' : '0'+avmin))+':'+(avsec>9 ? avsec : (avsec==0 ? '00' : '0'+avsec)));
				}
				else
					$(this).html(new Number(total/count).toString());
			}
			else
				$(this).html("");
		}
		else if(type=="COUNT")
		{
			$(this).html(new Number(count).toString());
		}
	});
	
}

this.round = function(str)
{
	var rez='';
	
	if(str.length>1)
	{
		str=str.split('.');
		rez+=str[0];
	}
	else rez+=str;	
	return rez;
}
}



function mySetOuterHTML(self,str)
{
	if($.browser.msie)
		$(self)[0].outerHTML=str;
	else
	{	
		var r = $(self)[0].ownerDocument.createRange();
		r.setStartBefore($(self)[0]);
		var df = r.createContextualFragment(str);
		$(self)[0].parentNode.replaceChild(df, $(self)[0]);
	}
}
var inlineedit_included=true;
