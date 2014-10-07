<?php

class ListPage_DPInline extends ListPage_Embed
{
	/**
	 * DP params
	 *
	 * @var string
	 */
	var $dpParams = "";
	/**
	 * Array of details preview master key
	 *
	 * @var integer
	 */
	var $dpMasterKey = array ();
	/**
	 * Short name of master table
	 *
	 * @var string
	 */
	var $masterShortTable = "";
	/**
	 * Master's form name
	 *
	 * @var string
	 */	
	var $masterFormName = "";
	/**
	 * Master's id use only for dpInline on list page
	 * (don't confuse with dpInline on add edit pages)
	 * @var string
	 */
	var $masterId = "";
	/**
	 * Constructor, set initial params
	 *
	 * @param array $params
	 */
	function ListPage_DPInline(&$params)
	{
		// copy properties to object
		//RunnerApply($this, $params);
		// call parent constructor
		parent::ListPage_Embed($params);
		$this->initDPInlineParams();
		$this->searchClauseObj->clearSearch();
		
		$this->jsSettings['tableSettings'][$this->tName]['mainMPageType'] = $this->mainMasterPageType;
		$this->jsSettings['tableSettings'][$this->tName]['masterPageType'] = $this->masterPageType;
		$this->jsSettings['tableSettings'][$this->tName]['masterTable'] = $this->masterTable;
		$this->jsSettings['tableSettings'][$this->tName]['firstTime'] = $this->firstTime;
		$this->jsSettings['tableSettings'][$this->tName]['strKey'] = $this->getStrMasterKey();
	}
	
	/**
	  * Init video 
	  * Use for dpInline only
	  */
	function initForDetailsPreview()
	{
		if($this->firstTime)
			return  "Runner.util.ScriptLoader.on('filesLoaded', function(){
						var dpInlObj = window['dpInline".$this->masterId."'];
						dpInlObj.setdpCntParse();
						//dpInlObj.initResize(".$this->id.",'".jsreplace($this->tName)."',".$this->firstTime.");
						//init maps object
						if(dpInlObj.prm.mainMPageType!=Runner.pages.constants.PAGE_ADD)
							dpInlObj.initMaps(".$this->id.",'".jsreplace($this->tName)."');
						if(dpInlObj.prm.mainMPageType!=Runner.pages.constants.PAGE_ADD)		
							dpInlObj.preInitMedia('".jsreplace($this->tName)."',".$this->id.",'".jsreplace($this->masterTable)."','".$this->masterPageType."',".$this->masterId.");
					}, this, {single: true});";
	}
	
	function addButtonHandlers()
	{
	
	}
	/**
      * Assigne Import Links or not
      *
	  * @return boolean
      */
	function importLinksAttrs() 
	{
		return true;
	}
	/**
      * Display master table info or not
      *
	  * @return boolean
      */
	function displayMasterTableInfo() 
	{
		return true;
	}
	/**
      * Process master key value
      * Set master key for create DPInline params
	  */
	function processMasterKeyValue() 
	{
		parent::processMasterKeyValue();
		for($i=1;$i<=count($this->masterKeysReq);$i++)
			$this->dpMasterKey[] = $this->masterKeysReq[$i];
	}
	/**
      * Initialization DPInline params
      * 
      */
	function initDPInlineParams()
	{
		$strkey="";
		for($i=0;$i<count($this->dpMasterKey);$i++)
			$strkey.="&masterkey".($i+1)."=".rawurlencode($this->dpMasterKey[$i]);
		$this->dpParams = "mode=listdetails&id=".$this->id."&mastertable=".rawurlencode($this->masterTable).$strkey.
							($this->masterId ? "&masterid=".$this->masterId : "").
							(($this->masterPageType==PAGE_EDIT || $this->masterPageType==PAGE_VIEW) ? "&masterpagetype=".$this->masterPageType : "").
							(($this->mainMasterPageType==PAGE_VIEW) ? "&mainmasterpagetype=".$this->mainMasterPageType : "");
	}
	/**
	 * Get string of master keys for dpInline on Edit page
	 */
	function getStrMasterKey()
	{
		$strkey = array();
		for($i=0;$i<count($this->dpMasterKey);$i++)
			$strkey[$i] = $this->dpMasterKey[$i];
		return $strkey;	
	}
	
	/**
	 * Set order links attribute for order on list page
	 *
	 * @param {string} $field - name field, which is ordering
	 * @param {string} $sort - how is filed ordering, "a" - asc or "d" - desc, default is "a"
	 */
	function setLinksAttr($field,$sort="")
	{
		if($this->masterPageType!=PAGE_ADD)
		{
			$href=$this->shortTableName."_list.php?orderby=".($sort!="" ? ($sort=="a" ? "d" : "a") : "a").$field."&".$this->dpParams;
			$orderlinkattrs="href=\"".$href."\" onclick=\"".$this->getLocation($href)."\"";
			return $orderlinkattrs;
		}
	}
	
	/**
	 * Get location for flyframe
	 */
	function getLocation($href,$ret = true)
	{
		return "window.frames['flyframe".$this->id."'].location='".$href."'; ".$this->addRunLoading().($ret ? " return false;" : "");	
	}
	
	/**
	 * show inline add link
	 * Add inline add attributes
	 */
	function inlineAddLinksAttrs()
	{
		//inline add link and attr
		if($this->masterPageType!=PAGE_VIEW && $this->mainMasterPageType!=PAGE_VIEW)
			parent::inlineAddLinksAttrs();
	}
	
	/**
      * Add common assign for current mode
      *
	  */
	function commonAssign()
	{
		parent::commonAssign();
			
		$this->xt->assign("left_block", false);
		//select all link and attr	
		if($this->masterPageType==PAGE_ADD || $this->masterPageType==PAGE_VIEW || $this->mainMasterPageType==PAGE_VIEW)
		{
			$this->xt->assign("selectall_link",false);
			$this->xt->assign("checkbox_column",false);
			$this->xt->assign("checkbox_header",false);
			$this->xt->assign("editselected_link",false);
			$this->xt->assign("delete_link",false);
			$this->xt->assign("saveall_link",false);
			if($this->masterPageType==PAGE_VIEW || $this->mainMasterPageType==PAGE_VIEW)
				$this->xt->assign("recordcontrols_block",false);
		}
		else{	
				//selectall link attrs
				$this->selectAllLinkAttrs();		
				
				//checkbox column	
				$this->checkboxColumnAttrs();
					
				//edit selected link and attr	
				$this->editSelectedLinkAttrs();	
				
				//save all link, attr, span	
				$this->saveAllLinkAttrs();
				
				//delete link and attr	
				$this->deleteSelectedLink();	
					
				if($this->masterPageType!=PAGE_EDIT)
				{	
					$searchPermis = $this->permis[$this->tName]['search'];
					$this->xt->assign("details_block", $searchPermis && $this->rowsFound );
					$this->xt->assign("pages_block", $searchPermis && $this->rowsFound );
				}	
			}
			
			if($this->masterPageType!=PAGE_VIEW && $this->mainMasterPageType!=PAGE_VIEW)
			{
				//inline edit column	
				$editPermis = $this->permis[$this->tName]['edit'];
				$this->xt->assign("inlineedit_column",$editPermis);
				
				//for list icons instead of list links
				$this->assignListIconsColumn($editPermis);
						
				//cancel all link, attr, span	
				$this->cancelAllLinkAttrs();
			}
			
			for($i=0;$i<count($this->allDetailsTablesArr);$i++) 
			{
				$permis = ($this->isGroupSecurity && $this->permis[$this->allDetailsTablesArr[$i]['dDataSourceTable']]['add'] && $this->permis[$this->allDetailsTablesArr[$i]['dDataSourceTable']]['search'])||(!$this->isGroupSecurity);	
				if($permis)
				{
					$this->xt->assign(GoodFieldName($this->tName)."_dtable_column", $permis);
					break;
				}
			}
	}
	
	/**
	 * Assign delete selected attrs
	 * 
	 */
	function deleteSelectedAttrs()
	{
		//$href = $this->shortTableName."_list.php?".$this->dpParams;
		$this->xt->assign("deleteselectedlink_attrs","name=\"delete_selected".$this->id."\" id=\"delete_selected".$this->id."\"  
							onclick=\"window['dpInline".($this->masterId ? $this->masterId : $this->id)."'].submitPreviewForm(".($this->masterId ? $this->id : "").")\"");	
	}
	
	
	/**
      * Display blocks after loaded template of page
      *
      */
	function displayAfterLoadTempl() 
	{
		parent::displayAfterLoadTempl();
		if($this->masterPageType!=PAGE_EDIT && $this->masterPageType!=PAGE_ADD && $this->masterPageType!=PAGE_VIEW)
		{
			echo'<div id="dpRecords'.$this->id.'" style="padding-top:2px;white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;';
			$this->xt->display_loaded("details_block");
			echo '&nbsp;&nbsp;';
			$this->xt->display_loaded("pages_block");
			echo'</div>';
		}
		echo '<div style="margin:10px 0;">';
		$this->xt->display_loaded("newrecord_controls");
		$this->xt->display_loaded("record_controls");
		echo'</div>';
		$this->xt->display_loaded("grid_block");
		$this->xt->display_loaded("pagination_block");
	}
	
	/**
      * Final build page
      *
	  */
	function prepareForBuildPage() 
	{	
		//orderlinkattrs for fields
		$this->orderLinksAttr();
		
		//Sorting fields
		if($this->masterPageType!=PAGE_ADD)
			$this->buildOrderParams();
		
		// delete record
		$this->deleteRecords();
		
		// build sql query
		$this->buildSQL();
		
		// build pagination block
		$this->buildPagination();
		
		// seek page must be executed after build pagination
		$this->seekPageInRecSet($this->querySQL);
		
		$this->setGoogleMapsParams($this->listFields);
		
		// fill grid data
		$this->fillGridData();
		
		// add common js code
		$this->addCommonJs();
		
		// add common html code
		$this->addCommonHtml();
		
		// Set common assign
		$this->commonAssign();
	}
	
	/**
      * Add loaded content div for dpInline and ajax reboot table
      *
	  */
	function addLoadedContentDiv($close=0)
	{
		$cl = '<div id = "loaded_content'.$this->id.'" ';
		if(!$this->listAjax)
			$cl .= 'name="loadedContent" ';
		if($this->masterPageType!=PAGE_EDIT && $this->masterPageType!=PAGE_ADD && $this->masterPageType!=PAGE_VIEW)
			$cl .= 'style="position:absolute; left:-10000px;" ';
		$cl .= ">";
		
		if($close)
			$cl .= '</div>';
		return $cl;	
	}
	
	/**
	  * Get code for stop Loading indicator
	  */
	function getStopLoading()
	{
		return "stopLoading(".$this->id.",".$this->mode.");";
	}
	
	/**
      * Show page method
      *
      */
	function showPage()
	{
		$this->BeforeShowList();
		$jsfiles = $this->PrepareJs();
		$jscode = "";
		$this->fillSetCntrlMaps();
		
		if ($this->masterPageType == PAGE_LIST ||  $this->masterPageType != PAGE_LIST && !$this->firstTime) 
		{
				$jscode = "var dpControls = '".jsreplace(my_json_encode($this->controlsHTMLMap))."';
						dpCntParse = JSON.parse(dpControls);";
		}
		
		if($this->firstTime)
		{
				if ($this->masterPageType == PAGE_LIST)
				{
						$jscode = " var dpSettings = '".jsreplace(my_json_encode($this->jsSettings))."';
									var dpSetParse = JSON.parse(dpSettings);".$jscode."							
									Runner.pages.PageSettings.addSettings('".jsreplace($this->tName)."', dpSetParse);".$jsfiles.$this->getStopLoading();			
						echo "<jscode>".str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$jscode)."</jscode>";
				}
		}
		else
		{
	  		if ($this->masterPageType != PAGE_LIST)
				{
					$jscode = " var dpSettings = '".jsreplace(my_json_encode($this->jsSettings))."';
							var dpSetParse = JSON.parse(dpSettings);".$jscode."							
							Runner.pages.PageSettings.addSettings('".jsreplace($this->tName)."', dpSetParse);".$jscode;
				}
				echo "<textarea id='data'>decli".$jscode.($this->recordsDeleted ? "/del/".$this->recordsDeleted : "")."</textarea>";
		}
						
		if(!$this->firstTime)
			echo "<textarea id=\"html\">";	
	
		if($this->firstTime && ($this->masterPageType==PAGE_EDIT || $this->masterPageType==PAGE_ADD || $this->masterPageType==PAGE_VIEW))
		{
			echo'<br><div id="dpShowHide'.$this->id.'" class="dpDiv" onClick = "dpInline'.$this->id.'.hideShowDetailPreview(this);">
						<img id="dpMinus'.$this->id.'" class="dpImg" border="0" src="include/img/minus.gif" valign="middle" alt="*" />
						<a name="dt'.$this->id.'" class="dt">'.$this->strCaption.'</a>
					</div>
				<div id="detailPreview'.$this->id.'" class="dpStyle">';
		}
		elseif($this->firstTime)
			echo $this->addLoadedContentDiv();
			
		$this->xt->load_template($this->templatefile);
		if(!$this->firstTime)
		{
			ob_start();
			$this->displayAfterLoadTempl();	
			$contents = ob_get_contents();
			ob_end_clean();
			echo htmlspecialchars($contents);
		}
		else
			$this->displayAfterLoadTempl();	
		
		if($this->firstTime && ($this->masterPageType==PAGE_EDIT || $this->masterPageType==PAGE_ADD || $this->masterPageType==PAGE_VIEW))
			echo'</div>';
		
		if(!$this->firstTime)
			echo "</textarea>";
	}
	
}
?>
