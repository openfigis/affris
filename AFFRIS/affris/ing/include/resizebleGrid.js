
function createTable(div,table,tName,id,firstTime)
{var num_cell=0,id_cell=0;var fields={fields:[]};var myColumnDefs=new Array();var initCookies=new Array();var notInclTd=new Array();var trClasses=new Array();var listIcons=false;var colRowSpan=false;var aligns={th:[],td:[]};var styles={tr:[],td:[]};var ieditcont={th:[],td:[]};$("#"+table+" tr:eq(0)").find('th').each(function()
{if($.browser.msie){cspan=this.colspan;rspan=this.rowspan;}else{cspan=$(this).attr('colspan');rspan=$(this).attr('rowspan');}
if(cspan||rspan){colRowSpan=true;return false;}
if(isClassNameAvailable(this.className))
{fields.fields[id_cell]="column"+id_cell;var content=$(this).html();if(!YAHOO.util.Cookie.get(tName))
{var obj={key:'column'+id_cell,label:content,width:this.offsetWidth,resizeable:true,sortable:false};myColumnDefs[id_cell]=obj;initCookies[initCookies.length]=this.offsetWidth;}
else{var tablecookie=YAHOO.util.Cookie.get(tName);tablecookie=YAHOO.lang.JSON.parse(tablecookie);var obj={key:'column'+id_cell,label:content,width:tablecookie[id_cell],resizeable:true,sortable:false};myColumnDefs[id_cell]=obj;}
aligns.th[id_cell]=this.align;ieditcont.th[id_cell]=($(this).attr('ieditcont')!=undefined?$(this).attr('ieditcont'):"");id_cell++;}
else
notInclTd[notInclTd.length]=num_cell;num_cell++;});if(colRowSpan)
return false;initCookies=YAHOO.lang.JSON.stringify(initCookies);if(!YAHOO.util.Cookie.get(tName))
YAHOO.util.Cookie.set(tName,initCookies);YAHOO.example.Data={areacodes:[]};var tableObj=$("#"+table);$("tr[@id^=addarea],tr[@id^=gridRow],[@rowid=totals]",tableObj).each(function(i)
{var trClassName=$(this).attr('class');trClasses[i]=trClassName;styles.tr[i]=($(this).attr('style')?$(this).attr('style'):'');if(!$('td[@class^=headerlistdown]',this).length)
{var areaCodes={};var lenData=YAHOO.example.Data.areacodes.length;var num_cell=0,id_cell=0;$('td',this).each(function(j)
{if($.browser.msie){cspan=this.colspan;rspan=this.rowspan;}else{cspan=$(this).attr('colspan');rspan=$(this).attr('rowspan');}
if(cspan||rspan){colRowSpan=true;return false;}
if($(this).parent().attr('id')!=undefined)
{var st=true;for(var k=0;k<notInclTd.length;k++)
{if(num_cell==notInclTd[k])
st=false;}
if(st)
{areaCodes[myColumnDefs[id_cell].key]=$(this).html();styles.td[j]=($(this).attr('style')?$(this).attr('style'):'');if(!i)
{aligns.td[id_cell]=this.align;ieditcont.td[id_cell]=($(this).attr('ieditcont')!=undefined?$(this).attr('ieditcont'):"");if(!listIcons)
{var tdClassName=$(this).attr('class');if(tdClassName)
{if(tdClassName.indexOf('listIcons')!=-1)
listIcons=true;}}}
id_cell++;}
num_cell++;}});if(colRowSpan)
return false;YAHOO.example.Data.areacodes[lenData]=areaCodes;}});if(colRowSpan)
return false;YAHOO.firstTime=firstTime;YAHOO.numCell=num_cell-1;YAHOO.example.MultipleFeatures=function()
{var myDataSource=new YAHOO.util.DataSource(YAHOO.example.Data.areacodes);myDataSource.responseType=YAHOO.util.DataSource.TYPE_JSARRAY;myDataSource.responseSchema=fields;YAHOO.myDataSource=myDataSource;var myConfigs={draggableColumns:false};var myDataTable=new YAHOO.widget.DataTable(div,myColumnDefs,myDataSource,myConfigs,firstTime);setTHTDAttr(id,aligns,styles,ieditcont,listIcons);setTRClasses(id,trClasses);myDataTable.addListener("columnResizeEvent",function(params)
{var nCount=YAHOO.widget.DataTable._nCount;var value=new String(params["column"]);var num=parseInt(value.substr(23));var tablecookie=YAHOO.util.Cookie.get(tName);tablecookie=YAHOO.lang.JSON.parse(tablecookie);var updateCookie=new Array();var len=tablecookie.length;if(!YAHOO.firstTime)
num=num-len*(nCount-1);for(var i=0;i<len;i++){if(i==num)
tablecookie[i]=params["width"];updateCookie[i]=tablecookie[i];}
updateCookie=YAHOO.lang.JSON.stringify(updateCookie);YAHOO.util.Cookie.set(tName,updateCookie);});return{oDS:myDataSource,oDT:myDataTable};}();}
function isClassNameAvailable(name)
{var arrClassNames=new Array(),avail=false;;arrClassNames=name.split(" ");if(arrClassNames.length)
{for(var i=0;i<arrClassNames.length;i++)
{if(arrClassNames[i]=="headerlist"||arrClassNames[i]=="blackshade"||arrClassNames[i]=="headerlist_right2"||arrClassNames[i]=="headerlist_right_M")
{avail=true;break;}}
return avail;}
else
return false;}
function setTHTDAttr(id,aligns,styles,ieditcont,listIcons)
{var table=getTableObj(id);if(!table)
return false;$('th',table).each(function(i)
{this.align=aligns.th[i];if(ieditcont.th[i])
$(this).attr('ieditcont',ieditcont.th[i]);});$('tr[@id^=yui-rec]',table).each(function(i)
{$(this).attr('style',styles.tr[i]);$('td[@class^=yui-dt]',this).each(function(j)
{this.align=aligns.td[j];if(ieditcont.td[j])
$(this).attr('ieditcont',ieditcont.td[j]);$(this).attr('style',styles.td[j]);if(!j&&listIcons)
{var newTdClass=$(this).attr('class');newTdClass+=' listIcons';$(this)[0].className=newTdClass;}});});}
function setTRClasses(id,trClasses)
{var table=getTableObj(id);if(!table)
return false;$('.yui-dt-data tr[@id^=yui-rec]',table).each(function(i)
{this.className=trClasses[i];});}
function prepareForCreateTable(param)
{var old_table=getTableObj(param.id);if(!old_table)
return;var id_table=$(old_table).attr('id');$(document.body).attr('class','yui-skin-sam');if(!id_table)
{$(old_table).attr('id','tabledata'+param.id);id_table='tabledata'+param.id;}
createTable($(old_table).parent().attr('id'),id_table,param.tName,param.id,param.firstTime);setHoverForTR(false,param.id,Runner.pages.PageSettings.getTableData(param.tName,"isUseHighlite",false),Runner.pages.PageSettings.getTableData(param.tName,"listIcons",false),Runner.pages.PageSettings.getTableData(param.tName,"isUseResize",false));var table=getTableObj(param.id);if((param.useInlineAdd||param.showAddInPopup)&&param.permisAdd)
{if(!table)
return false;var addArea=$('.yui-dt-data tr:first',table);$(addArea).attr('id','addarea'+param.id);addArea.hide();if(!param.numRows)
$(table).hide();}}
function inlineAddIfUseResize(id)
{var table=getTableObj(id)
if(!table)
return false;var yuiRec=$('.yui-dt-data tr:first',table);if(!$(yuiRec).length)
return false;else if($(yuiRec).css('display')=='none')
{$(table).show();return{'id':$(yuiRec).attr('id'),'name':"yui-rec-add"};}
else
return false}