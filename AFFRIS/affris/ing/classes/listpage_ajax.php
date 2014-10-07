<?php
/**
 * Class for list page with mode ajax
 *
 */
class ListPage_Ajax extends ListPage_Simple 
{
	/**
	 * Constructor, set initial params
	 *
	 * @param array $params
	 */	
	function ListPage_Ajax(&$params) 
	{
		// call parent constructor
		parent::ListPage ($params);	
	}
	/**
	 * Add common assign for ajax mode on list page
	 */	
	function commonAssign() 
	{
		$this->xt->assign("id", $this->id);
		//search permissions
		$searchPermis = $this->permis[$this->tName]['search'];
		$this->xt->assign("details_block", $searchPermis && $this->rowsFound );
		$this->xt->assign("pages_block", $searchPermis && $this->rowsFound );
		$this->xt->assignbyref("body", $this->body);
		//$this->xt->assign("left_block", true);		
		
		$this->addAssignForGrid();
						
		if ($this->isDispGrid())
			$this->xt->assign_section("grid_block", '', '');

	}
	
	/**
	 * Add common html code for ajax mode on list page
	 */	
	function addCommonHtml() 
	{
		return true;
	}
	
	/**
	 * Add common javascript code for ajax mode on list page
	 */	
	function addCommonJs()
	{
		$this->addJsForGrid();
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
      * Show page method
      *
      */
	function showPage()
	{
		$this->BeforeShowList();
		$this->xt->load_template($this->templatefile);
		
		$returnJSON = array("success"=>true, "html"=>array(), 'idStartFrom'=>$this->flyId);
		
		$this->fillSetCntrlMaps();
		$returnJSON['controlsMap'] = $this->controlsHTMLMap;
		$returnJSON['settings'] = $this->jsSettings;
		
		$returnJSON['html']['details'] = $this->xt->fetch_loaded("details_block");
		$returnJSON['html']['pages'] = $this->xt->fetch_loaded("pages_block");
		$returnJSON['html']['grid'] = $this->xt->fetch_loaded("grid_block");
		$returnJSON['html']['pagination'] = $this->xt->fetch_loaded("pagination_block");
		$returnJSON['html']['message'] = $this->xt->fetch_loaded("message_block");
		
		echo my_json_encode($returnJSON);
	}

}
?>