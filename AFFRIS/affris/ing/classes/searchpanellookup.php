<?php
/**
 * Search panel builder for LIST_LOOKUP mode
 *
 */
class SearchPanelLookup extends SearchPanel {

	function SearchPanelLookup(&$params) 
	{
		parent::SearchPanel($params);
	}
	
	function searchAssign()
	{
		parent::searchAssign();		
		
		$searchGlobalParams = $this->searchClauseObj->getSearchGlobalParams();	
		$searchforAttrs = " size=\"15\" name=\"ctlSearchFor".$this->id."\" id=\"ctlSearchFor".$this->id."\"";
		$searchforAttrs.= " value=\"".htmlspecialchars($searchGlobalParams["simpleSrch"])."\"";
		
		if(!$this->searchClauseObj->isUsedSrch())
		{
			$searchforAttrs .= 'style="color: #C0C0C0;"';
		}
		
		$this->pageObj->xt->assign("searchfor_attrs", $searchforAttrs);
		$this->pageObj->xt->assign("searchform", true);
	}
	
}

?>