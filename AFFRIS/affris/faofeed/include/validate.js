var validate_included=true;
var arrStates = new Array('AL','AK','AS','AZ','AR','CA','CO','CT','DE','DC','FM','FL','GA','GU',
'HI','ID','IL','IN','IA','KS','KY','LA','ME','MH','MD','MA','MI','MN','MS','MO','MT','NE','NV',
'NH','NJ','NM','NY','NC','ND','MP','OH','OK','OR','PW','PA','PR','RI','SC','SD','TN','TX','UT',
'VT','VI','VA','WA','WV','WI','WY');
					
// -----------------------------------------------------------------------------
// define - Call this function in the beginning of the page. I.e. onLoad.
// n = name of the input field (Required)
// type= IsRequired, IsNumeric, IsEmail, IsZipCode, IsDate, IsTime, IsPhoneNumber,
//IsMoney, IsPassword (Required), IsSSN, IsState, IsCC
// -----------------------------------------------------------------------------
/**
 * detecting validation object for compatibility with shopping cart 
 * on older versions of phprunner
 */
function detectValObj(){
	if (addValid){
		return addValid;
	}else if(editValid){
		return editValid;		
	}else{
		return false;
	}
}

/**
 * for compatibility with older versions
 * Add validation to the field
 * 
 * @param {string} valFieldName
 * @param {string} valType
 * @param {string} fieldName
 */
function define(valFieldName,valType,fieldName){
	
	var valObj = detectValObj();
	
	if(!valObj){
		return false;
	}
	
	var elem = document.editform[valFieldName];

	if (valObj.isInList(elem) == -1){
		valObj.add(elem, valType, '', '');
	}
}
/**
 * Removing validation from the field
 * @param {string} valFieldName
 */
function undefine(valFieldName){
	
	var valObj = detectValObj();

	if(!valObj){
		return false;
	}

	var elem = document.getElementById(valFieldName);

	var par = $(elem).parent();
	$('div',par).remove('.error');
	
	valObj.remove(elem);
	
}


function validation() 
{
	this.checkObjects = new Array();
	this.isValid = true;

	/**
	 * Checks, if there exists second validation for this element with type = 'IsRequired'
	 * @param {dom element} element
	 */
	this.isAllowEmptyValueForRegExp = function(element){
		
		if(element==undefined){
			return false;
		}
		
		for(var j=0;j<this.checkObjects.length;j++){			
			if (this.checkObjects[j][0]==element && this.checkObjects[j][1]=='IsRequired'){					
				return false;
			}
		}
		return true;	
	}

	this.isInList = function(element){
		if(element!=undefined)
		{			
			for(i=0;i<this.checkObjects.length;i++){			
				if (this.checkObjects[i][0]==element){					
					return i;
				}
			}
			return -1;			
		}
	}
	
	this.remove = function(element){		
		var elemInd = this.isInList(element);
		if (elemInd != -1){
			this.checkObjects.splice(elemInd,1);
		}	
	}

	this.add = function(element,type,useRTE,cblist) 
	{	
		if(element!=undefined)
		{
			len = this.checkObjects.length;
			this.checkObjects[len] = [element, type, useRTE, cblist];
		}	
	}

	this.addRegex = function(element,type,regex,message,messagetype) 
	{	
		if(element!=undefined)
		{
			len = this.checkObjects.length;
			this.checkObjects[len] = [element, type, "", "", regex, message, messagetype];
		}
	}
	
	this.validate = function()
	{
		var isValid =true;
		var name_elem_pred = "";
		for(i=0;i<this.checkObjects.length;i++)
		{	
			var elem = this.checkObjects[i][0];
			var type = this.checkObjects[i][1];
			var useRTE = this.checkObjects[i][2];
			var cblist = this.checkObjects[i][3];
			var regex = this.checkObjects[i][4];
			var message = this.checkObjects[i][5];
			var messagetype = this.checkObjects[i][6];
			var par = $(elem).parent();
			name_elem = $(elem).attr('name');
			if(!useRTE && (elem == undefined || name_elem == undefined))
				continue;			
							
//if  use FCKEditor in all pages, when 'elem' - this is hidden element 'input', on 'id' which we receive data from FCKEditor
			if(useRTE=='FCK')
				sVal = this.FCK(elem);		
//else if use Innova or RTE Editors on the pages InlineAdd or InlineEdit, then 'elem' - this is element 'span', where we find element 'iframe'			
			else if((useRTE=='INNOVA' || useRTE=='RTE') && $("iframe",elem).length)
			{
				var iframe = $("iframe",elem);
				name_elem = $(iframe).attr("name");
				par = elem;				
				sVal = this.INNRTE(iframe,useRTE);
			}
//else if use Innova or RTE Editors on the page Add or Add_OnTheFly or Edit, then 'elem' - this is element 'iframe'			
			else if(useRTE=='INNOVA_FLY' || useRTE=='RTE_FLY')
				sVal = this.INNRTE(elem,useRTE);
//else use standart type or user type of validation
			else if(cblist=='CBList')
			{
				type = "IsRequiredCBList";
				sVal = par;
			}
			else if(type=='IsMatchPasswords')
				sVal=i;
			else
				sVal = $(elem).val();
			if(sVal==undefined)
				sVal='';
			if (type == undefined) 
				continue;
			var valid;
			var js;
			if (type=="Regular expression"){
				
				// check if field can be empty
				var allowEmpty = false;
				if (sVal.length == 0 && this.isAllowEmptyValueForRegExp(elem)){
					allowEmpty = true;
				}
				
				js = "if (typeof window[type] == 'function') valid = isValidRegex(sVal,regex,message,messagetype,allowEmpty);" +
					"else valid = this.isValidRegex(sVal,regex,message,messagetype,allowEmpty);";
			}			
			else
			{
				js = "if (typeof window[type] == 'function') valid = "+type+"(sVal);"+
					 "else valid = this."+type+"(sVal);";
			}
			eval(js);
			if(valid)
			{	
				if(name_elem!=name_elem_pred)
					$("div",par).remove(".error");
				$(par).append('<div class="error">'+valid+'</div>');
				isValid = false;
			}
			else if(name_elem!=name_elem_pred)
				$("div",par).remove(".error");
			name_elem_pred = name_elem;
		}	
		return isValid;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	this.FCK = function(elem)
	{
		var val;
		var id_elem = $(elem).attr('id');
		var fckval = FCKeditorAPI.GetInstance(id_elem);
		if(fckval==undefined)
			fckval = FCKeditorAPI.GetInstance(name_elem);
		if(fckval!=undefined)
			val = fckval.GetXHTML();
		else 
			val = $(elem).val();
		return val;		
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	this.INNRTE = function(iframe,useRTE)
	{
		var txt = getDataFromRTEInnova(iframe,useRTE);
		if($.browser.msie)
		{
			if(useRTE=="RTE" || useRTE=="RTE_FLY")
				val = $(txt).val();
			else
				val = $(txt).text();
		}
		else
			val = txt;
		return val;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsRequired = function(sVal)
	{
		var regexp = /.+/;
		if(typeof(sVal)!='string')
			sVal = sVal.toString();
		if(!sVal.match(regexp)) 
			return TEXT_INLINE_FIELD_REQUIRED;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsRequiredCBList = function(sVal)
	{
		if(sVal!=undefined)
		{
			if(!$('input[@checked]',sVal).length)
				return TEXT_INLINE_FIELD_REQUIRED;
		}
	}		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsNumeric = function(sVal)
	{
		sVal = sVal.replace(/,/g,"");
		if(isNaN(sVal)) 
			return TEXT_INLINE_FIELD_NUMBER;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsPassword = function(sVal)
	{
		var regexp1 = /^password$/;
		var regexp2 = /.{4,}/;
		if(sVal.match(/.+/)) 
		{
			if(sVal.match(regexp1))
				return TEXT_INLINE_FIELD_PASSWORD1;
			else if(!sVal.match(regexp2)) 
				return TEXT_INLINE_FIELD_PASSWORD2;					
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	this.IsMatchPasswords = function(sVal)
	{
		if(typeof(sVal)=='number')
		{
			var pas1 = $(this.checkObjects[sVal][0]).val();
			var pas2 = $(this.checkObjects[sVal-1][0]).val();
			if(pas1!='' && pas2!='' && pas1!=pas2)
			{
				$(this.checkObjects[sVal][0]).attr('value','');
				return TEXT_INLINE_MATCH_PASSWORDS;
			}
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsEmail = function(sVal)
	{
		var regexp = /^[A-z0-9_-]+([.][A-z0-9_-]+)*[@][A-z0-9_-]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return TEXT_INLINE_FIELD_EMAIL;
	} 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsMoney = function(sVal)
	{
		var regexp = /^(\d*)\.?(\d*)$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return TEXT_INLINE_FIELD_CURRENCY;
	}  
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsZipCode = function(sVal)
	{
		var regexp = /^\d{5}([\-]\d{4})?$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return TEXT_INLINE_FIELD_ZIPCODE;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsPhoneNumber = function(sVal)
	{
		var regexp = /^\(\d{3}\)\s?\d{3}\-\d{4}$/;		
		var stripped = sVal.replace(/[\(\)\.\-\ ]/g, '');    
		if(sVal.match(/.+/) && (isNaN(parseInt(stripped)) || stripped.length != 10) ) 
			return TEXT_INLINE_FIELD_PHONE;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsState = function(sVal)
	{
		if(sVal.match(/.+/) && !arrStates.inArray(sVal,false) ) 
			return TEXT_INLINE_FIELD_STATE;
	} 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsSSN = function(sVal)
	{
		// 123-45-6789 or 123 45 6789
		var regexp = /^\d{3}(-|\s)\d{2}(-|\s)\d{4}$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return TEXT_INLINE_FIELD_SSN;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsCC = function(sVal)
	{
		//Visa, Master Card, American Express
		var regexp = /^((4\d{3})|(5[1-5]\d{2}))(-?|\040?)(\d{4}(-?|\040?)){3}|^(3[4,7]\d{2})(-?|\040?)\d{6}(-?|\040?)\d{5}/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return TEXT_INLINE_FIELD_CC;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsTime = function(sVal)
	{
		if(sVal.match(/.+/) ) 
		{
			var regexp = /\d+/g;
			var arr = sVal.match(regexp);
			var bFlag = true;
			if(arr==null || arr.length > 3)  
				bFlag = false; 
			while(bFlag && arr.length < 3) 
				arr[arr.length] = 0; 
			if( bFlag && (arr[0]<0 || arr[0]>23 || arr[1]<0 || arr[1]>59 || arr[2]<0 || arr[2]>59) ) 
				bFlag = false; 
			if(!bFlag) 
				return TEXT_INLINE_FIELD_TIME;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	this.IsDate = function(sVal)
	{
		var fmt = "";
		switch (locale_dateformat) 
		{
			case 0 :
					fmt="MDY";
			break;
			case 1 : 
					fmt="DMY";
			break;	
			default:
					fmt="YMD";
			break;				
		};
		if(sVal.match(/.+/) && !this.isValidDate(sVal,fmt)) 
			return TEXT_INLINE_FIELD_DATE;			
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	this.isValidRegex = function(sVal, regex, message, messagetype, allowEmpty) 
	{
		if (allowEmpty){
			return;
		}
		
		var re;
		try
		{
			re = new RegExp(regex);
		}
		catch(e)
		{
			return;
		}
		
		if(!re.test(sVal) || re.exec(sVal)[0] != sVal)
		{
			if(messagetype == 'Text')
			{
				return message;
			}
			else
			{
				return GetCustomLabel(message);
			}
		}
	}	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				
			
	this.isValidDate = function(dateStr, format) 
	{
		if (format == null) 
			format = "MDY"; 
		format = format.toUpperCase();
		if (format.length != 3)  
			format = "MDY"; 
		if ((format.indexOf("M") == -1) || (format.indexOf("D") == -1) || (format.indexOf("Y") == -1) ) 
			format = "MDY"; 
		if (format.substring(0, 1) == "Y") 
		{ // If the year is first
			var reg1 = /^\d{2}(\-|\/|\.)\d{1,2}\1\d{1,2}$/
			var reg2 = /^\d{4}(\-|\/|\.)\d{1,2}\1\d{1,2}$/
		} 
		else if (format.substring(1, 2) == "Y") 
		{ // If the year is second
			var reg1 = /^\d{1,2}(\-|\/|\.)\d{2}\1\d{1,2}$/
			var reg2 = /^\d{1,2}(\-|\/|\.)\d{4}\1\d{1,2}$/
		} 
		else{ // The year must be third
				var reg1 = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{2}$/
				var reg2 = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/
			}
		// If it doesn't conform to the right format (with either a 2 digit year or 4 digit year), fail
		if ((reg1.test(dateStr) == false) && (reg2.test(dateStr) == false)) 
			return false; 
		var parts = dateStr.split(RegExp.$1); // Split into 3 parts based on what the divider was
		// Check to see if the 3 parts end up making a valid date
		if (format.substring(0, 1) == "M") 
			var mm = parts[0];  
		else if (format.substring(1, 2) == "M") 
			var mm = parts[1];  
		else	
			var mm = parts[2]; 
		if (format.substring(0, 1) == "D") 
			var dd = parts[0];  
		else if (format.substring(1, 2) == "D") 
			var dd = parts[1]; 
		else	
			var dd = parts[2]; 
		if (format.substring(0, 1) == "Y") 
			var yy = parts[0];  
		else if (format.substring(1, 2) == "Y") 
			var yy = parts[1];  
		else 
			var yy = parts[2]; 
		if (parseFloat(yy) <= 50) 
			yy = (parseFloat(yy) + 2000).toString();
		if (parseFloat(yy) <= 99) 
			yy = (parseFloat(yy) + 1900).toString(); 
		var dt = new Date(parseFloat(yy), parseFloat(mm)-1, parseFloat(dd), 0, 0, 0, 0);
		if (parseFloat(dd) != dt.getDate()) 
			return false; 
		if (parseFloat(mm)-1 != dt.getMonth()) 
			return false; 
	   return true;
	}		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
