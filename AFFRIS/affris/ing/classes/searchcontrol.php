<?php
/**
 * Base class for all search control builders
 *
 */
class SearchControl {
			
	var $tName = '';
	var $globSrchParams = array();
	var $getSrchPanelAttrs = array();
	var $dispNoneStyle = 'style="display: none;"';
	var $pageObj = null;
	var $searchClauseObj = false;
	var $id = 1;
	
	
	function SearchControl($id, $tName='', &$searchClauseObj, &$pageObj)
	{
		$this->tName = $tName;
		
		$this->searchClauseObj = $searchClauseObj;		
		$this->getSrchPanelAttrs = $this->searchClauseObj->getSrchPanelAttrs();
		$this->globSrchParams = $this->searchClauseObj->getSearchGlobalParams();
		$this->id = $id;
		$this->pageObj = &$pageObj;				
	}
		
	function getCtrlParamsArr($fName, $recId, $fieldNum=0, $value, $renderHidden = false, $isCached=true) 
	{
		$fType = GetEditFormat($fName, $this->tName);	
			
		if ($fType == EDIT_FORMAT_TEXT_AREA
			|| $fType == EDIT_FORMAT_PASSWORD
			|| $fType == EDIT_FORMAT_HIDDEN
			|| $fType == EDIT_FORMAT_READONLY
			|| $fType == EDIT_FORMAT_FILE)
			$format=EDIT_FORMAT_TEXT_FIELD;
		else 
			$format = $fType;
				
		$control = array();
		$control["params"] = array();
		$control["func"]="xt_buildeditcontrol";
		$control["params"]["field"]=$fName;
		$control["params"]["mode"]="search";
		$control["params"]["id"]=$recId;
		$control["params"]["fieldNum"]=$fieldNum;		
		$control["params"]["format"]=$format;
		$control["params"]["pageObj"]=$this->pageObj;
		
		$ctrlsMap = array('controls'=>array());
		$ctrlsMap['controls']['fieldName'] = $fName;
		$ctrlsMap['controls']['mode'] = MODE_SEARCH;
		$ctrlsMap['controls']['editFormat'] = $format;
		$ctrlsMap['controls']['id'] = $recId;
		$ctrlsMap['controls']['ctrlInd'] = $fieldNum;
		$ctrlsMap['controls']["hidden"] = $renderHidden || $isCached;
		$ctrlsMap['controls']["table"] = $this->tName;
		
		$vals = array($fName => $value);
		$preload = $this->pageObj->fillPreload($fName, $vals);
		if($preload!==false)
			$ctrlsMap["controls"]['preloadData'] = $preload;
		
		$this->pageObj->fillControlsMap($ctrlsMap);
						
		$additionalCtrlParams = array();
		$additionalCtrlParams['hidden'] = $renderHidden || $isCached;
				
		$control["params"]["additionalCtrlParams"]=$additionalCtrlParams;
		
		$control["params"]["value"]= $value;
		
		return $control;
	}
	
	function getSecCtrlParamsArr($fName, $recId, $fieldNum=0, $value, $renderHidden = false, $isCached=true) 
	{
		
		$fType = GetEditFormat($fName, $this->tName);	
		
		if ($this->isNeedSecondCtrl($fName))
			return $this->getCtrlParamsArr($fName, $recId, ($fieldNum+1), $value, $renderHidden, $isCached);
		else 
			return false;
	}
	
	function isNeedSecondCtrl($fName)
	{
		
		$fType = GetEditFormat($fName, $this->tName);	
		
		if ($fType == EDIT_FORMAT_DATE || $fType == EDIT_FORMAT_TIME || $fType == EDIT_FORMAT_TEXT_FIELD || $fType == EDIT_FORMAT_TEXT_AREA
			 || $fType == EDIT_FORMAT_PASSWORD || $fType == EDIT_FORMAT_HIDDEN || $fType == EDIT_FORMAT_READONLY)
		{			 	
			return true;
		}
		else 
		{
			return false;
		}		
	}
	
	function getSimpleSearchTypeCombo($selOpt, $not) {
		$options="";
		$options.="<OPTION VALUE=\"Contains\" ".(($selOpt=="Contains" && !$not)?"selected":"").">"."Contains"."</option>";
		$options.="<OPTION VALUE=\"Equals\" ".(($selOpt=="Equals" && !$not)?"selected":"").">"."Equals"."</option>";
		$options.="<OPTION VALUE=\"Starts with\" ".(($selOpt=="Starts with" && !$not)?"selected":"").">"."Starts with"."</option>";
		$options.="<OPTION VALUE=\"More than\" ".(($selOpt=="More than" && !$not)?"selected":"").">"."More than"."</option>";
		$options.="<OPTION VALUE=\"Less than\" ".(($selOpt=="Less than" && !$not)?"selected":"").">"."Less than"."</option>";
		$options.="<OPTION VALUE=\"Empty\" ".(($selOpt=="Empty" && !$not)?"selected":"").">"."Empty"."</option>";
		return $options;
	}
	
	
	function getCtrlSearchTypeOptions($fName, $selOpt, $not) 
	{
		if (strlen($fName))
		{
			$fType = GetEditFormat($fName, $this->tName);	
		}
		else 
		{
			$fType = EDIT_FORMAT_TEXT_FIELD;
		}
			
		$options="";
		
		if ($fType == EDIT_FORMAT_DATE || $fType == EDIT_FORMAT_TIME)
		{
			$options.="<OPTION VALUE=\"Equals\" ".(($selOpt=="Equals" && !$not)?"selected":"").">"."Equals"."</option>";
			$options.="<OPTION VALUE=\"More than\" ".(($selOpt=="More than" && !$not)?"selected":"").">"."More than"."</option>";
			$options.="<OPTION VALUE=\"Less than\" ".(($selOpt=="Less than" && !$not)?"selected":"").">"."Less than"."</option>";
			$options.="<OPTION VALUE=\"Between\" ".(($selOpt=="Between" && !$not)?"selected":"").">"."Between"."</option>";
			$options.="<OPTION VALUE=\"Empty\" ".(($selOpt=="Empty" && !$not)?"selected":"").">"."Empty"."</option>";
		}
		elseif ($fType == EDIT_FORMAT_LOOKUP_WIZARD)
		{
			if (Multiselect($fName, $this->tName)){
				$options.="<OPTION VALUE=\"Contains\" ".(($selOpt=="Contains" && !$not)?"selected":"").">"."Contains"."</option>";	
			}else{
				$options.="<OPTION VALUE=\"Equals\" ".(($selOpt=="Equals" && !$not)?"selected":"").">"."Equals"."</option>";	
			}
		}
		elseif ($fType == EDIT_FORMAT_TEXT_FIELD || $fType == EDIT_FORMAT_TEXT_AREA || $fType == EDIT_FORMAT_PASSWORD 
					|| $fType == EDIT_FORMAT_HIDDEN || $fType == EDIT_FORMAT_READONLY)
		{
			$options.="<OPTION VALUE=\"Contains\" ".(($selOpt=="Contains" && !$not)?"selected":"").">"."Contains"."</option>";
			$options.="<OPTION VALUE=\"Equals\" ".(($selOpt=="Equals" && !$not)?"selected":"").">"."Equals"."</option>";
			$options.="<OPTION VALUE=\"Starts with\" ".(($selOpt=="Starts with" && !$not)?"selected":"").">"."Starts with"."</option>";
			$options.="<OPTION VALUE=\"More than\" ".(($selOpt=="More than" && !$not)?"selected":"").">"."More than"."</option>";
			$options.="<OPTION VALUE=\"Less than\" ".(($selOpt=="Less than" && !$not)?"selected":"").">"."Less than"."</option>";
			$options.="<OPTION VALUE=\"Between\" ".(($selOpt=="Between" && !$not)?"selected":"").">"."Between"."</option>";
			$options.="<OPTION VALUE=\"Empty\" ".(($selOpt=="Empty" && !$not)?"selected":"").">"."Empty"."</option>";
		}
		else
			$options.="<OPTION VALUE=\"Equals\" ".(($selOpt=="Equals" && !$not)?"selected":"").">"."Equals"."</option>";
		
		return $options;
	}
	
	function getCtrlSearchType($fName, $recId, $fieldNum=0, $selOpt, $not, $renderHidden=false) 
	{
		$searchtype = '<SELECT id="'.$this->getSearchOptionId($fName, $recId).'" NAME="'.$this->getSearchOptionId($fName, $recId).'" SIZE=1 '.($renderHidden || !$this->getSrchPanelAttrs['ctrlTypeComboStatus'] ? 'style="display: none;"' : '').'>';
		$searchtype .= $this->getCtrlSearchTypeOptions($fName, $selOpt, $not);
		$searchtype .= "</SELECT>";
		
		return $searchtype;		
	}
	
	function getSearchOptionId($fName, $recId) {
		return 'srchOpt_'.$recId.'_'.GoodFieldName($fName);
	}
	
	
	function getNotBox($fName, $recId, $not){	
		$notbox = 'id="not_'.$recId.'_'.GoodFieldName($fName).'"';
		if($not)
			$notbox .=" checked";
			
		return $notbox;
	}
	
	
	function  getDelButtonHtml($fName, $recId)
	{		
		$html = '<img style="visibility: hidden;" id = "'.$this->getDelButtonId($fName, $recId).'" ctrlId="'.$recId.'" fName="'.$fName.'" class="searchPanelButton" src="images/search/closeRed.gif" alt="'."Delete control".'">';
		return $html;
	}
	
	function getDelButtonId($fName, $recId) {
		return 'delCtrlButt_'.$recId.'_'.GoodFieldName($fName);
	}
	
	function getSearchRadio()
	{	
		$resArr = array();
		// search panel radio button assign
		$resArr['all_checkbox_label'] = array(0=>'', 1=>'');
		$resArr['any_checkbox_label'] = array(0=>'', 1=>'');		
		
		if(isEnableSection508())
		{
			$resArr['all_checkbox_label'] = array(0=>"<label for=\"all_checkbox\">", 1=>"</label>");
			$resArr['any_checkbox_label'] = array(0=>"<label for=\"any_checkbox\">", 1=>"</label>");			
		}
		
		$id508l="id=\"all_checkbox\" ";
		$id508n="id=\"any_checkbox\" ";
		
		$resArr['all_checkbox']	= $id508l;
		$resArr['any_checkbox']	= $id508n;
		
		$resArr['all_checkbox'] .= "value=\"and\" ";
		$resArr['any_checkbox'] .= "value=\"or\" ";
		
		
		if(isset($this->globSrchParams['srchTypeRadio']) && $this->globSrchParams['srchTypeRadio']=="or")
		{
			$resArr['any_checkbox'] .=" checked";
		}
		else
		{
			$resArr['all_checkbox'] .=" checked";
		}
		
		
		return $resArr;
	}
	
	function getFilterDivId($recId, $fName)
	{
		return 'filter_'.$recId.'_'.GoodFieldName($fName);
	}
	
	function getCtrlComboContId($recId, $fName)
	{
		return 'searchType_'.$recId.'_'.GoodFieldName($fName);
	}
	
	
	function buildSearchCtrlBlockArr($recId, $fName, $ctrlInd, $opt, $not, $isChached, $val1, $val2)
	{		
		$srchCtrlBlock = array();
		$srchCtrlBlock['searchcontrol'] = $this->getCtrlParamsArr($fName, $recId, $ctrlInd, $val1, false, $isChached);	
		// create second control, if need it
		$renderHidden = strtolower($opt)!='between' && strtolower($opt)!='not between';
		$srchCtrlBlock['searchcontrol1'] = $this->getSecCtrlParamsArr($fName, $recId, $ctrlInd, $val2, $renderHidden, $isChached);	
		
		
		$srchCtrlBlock['secCtrlCont_attrs'] = '';//(strtolower($opt)!='between' && strtolower($opt)!='not between' ? 'style="display: none;"' : '');		
		// del button
		$srchCtrlBlock['delCtrlButt'] = $this->getDelButtonHtml($fName, $recId);		
		// one control with options container attr
		$filterDivId = $this->getFilterDivId($recId, $fName);
		$srchCtrlBlock['filterDiv_attrs'] = ($isChached ? $this->dispNoneStyle : '').' id="'.$filterDivId.'" ';
		$srchCtrlBlock['fName'] = $fName;
		// combo with attrs
		$srchCtrlBlock['searchtype'] = $this->getCtrlSearchType($fName, $recId, $ctrlInd, $opt, $not);		
		$srchCtrlBlock['srchTypeCont_attrs'] = 'id="'.$this->getCtrlComboContId($recId, $fName).'"';
		$srchCtrlBlock['srchTypeCont_attrs'] .= ($this->getSrchPanelAttrs['ctrlTypeComboStatus'] ? '' : 'style="display: none;"');
		// checkbox attrs
		$srchCtrlBlock['notbox'] = $this->getNotBox($fName, $recId, $not);
		$srchCtrlBlock['fLabel'] = GetFieldLabel(GoodFieldName($this->tName),GoodFieldName($fName));
						
		return $srchCtrlBlock;
	}
}

?>