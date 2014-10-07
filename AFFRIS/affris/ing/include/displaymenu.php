<?php
	
	global $pageObject;
	$pageType = "";
	if(isset($pageObject))
		$pageType = $pageObject->pageType;
		
	$xt = new Xtempl();
	if(array_key_exists("custom1",$menuparams) && $menuparams["custom1"]=="horizontal")
	{
		$xt->assign("horizontal_typemenu",true);//horizontal type menu
		$xt->assign("tophorizontal_item",true);//top item for horizontal menu
		$xt->assign("simplehorizontal_item",true);//simple item for horizontal menu
		$horiz=true;
	}	
	else{
		$xt->assign("vertical_typemenu",true);//vertical type menu
		$xt->assign("topvertical_item",true);//top item for vertical menu
		$xt->assign("simplevertical_item",true);//simple item for vertical menu
		$horiz=false;
	}
		
	// create menu nodes arr
	$menuNodes = array();
	$menuNode = array();
	$menuNode["name"] = "";
	$menuNode["nameType"] = "Text";
	$menuNode["id"] = "1";
	$menuNode["parent"] = "0";
	$menuNode["style"] = "";
	$menuNode["href"] = "mypage.htm";
	$menuNode["params"] = "";
	$menuNode["table"] = "vw_ingredientclass";
	$menuNode["type"] = "Leaf";
	$menuNode["linkType"] = "Internal";
	$menuNode["pageType"] = "List";
	$menuNode["openType"] = "None";					 
	// set title		
			$menuNode["title"] = "Feed ingredient details";
	$menuNodes[] = $menuNode;	
	
	$menuNode = array();
	$menuNode["name"] = "";
	$menuNode["nameType"] = "Text";
	$menuNode["id"] = "2";
	$menuNode["parent"] = "0";
	$menuNode["style"] = "";
	$menuNode["href"] = "mypage.htm";
	$menuNode["params"] = "";
	$menuNode["table"] = "vw_fullingredientproxanalysis";
	$menuNode["type"] = "Leaf";
	$menuNode["linkType"] = "Internal";
	$menuNode["pageType"] = "List";
	$menuNode["openType"] = "None";					 
	// set title		
			$menuNode["title"] = "Proximate analysis of feed ingredient";
	$menuNodes[] = $menuNode;	
	
	$menuNode = array();
	$menuNode["name"] = "";
	$menuNode["nameType"] = "Text";
	$menuNode["id"] = "3";
	$menuNode["parent"] = "0";
	$menuNode["style"] = "";
	$menuNode["href"] = "mypage.htm";
	$menuNode["params"] = "";
	$menuNode["table"] = "vw_fullingredientelementanalysis";
	$menuNode["type"] = "Leaf";
	$menuNode["linkType"] = "Internal";
	$menuNode["pageType"] = "List";
	$menuNode["openType"] = "None";					 
	// set title		
			$menuNode["title"] = "Detailed nutrient composition analysis of feed ingredient";
	$menuNodes[] = $menuNode;	
	
	$menuNode = array();
	$menuNode["name"] = "Ingredients Spec. Association";
	$menuNode["nameType"] = "Text";
	$menuNode["id"] = "4";
	$menuNode["parent"] = "0";
	$menuNode["style"] = "";
	$menuNode["href"] = "mypage.htm";
	$menuNode["params"] = "";
	$menuNode["table"] = "vw_ingredientspecassociation";
	$menuNode["type"] = "Leaf";
	$menuNode["linkType"] = "Internal";
	$menuNode["pageType"] = "List";
	$menuNode["openType"] = "None";					 
	// set title		
			$menuNode["title"] = "Ingredients Spec. Association";
	$menuNodes[] = $menuNode;	
	
	
	// need to predefine vars
	$nullParent = NULL;
	$rootInfoArr = array("id"=>0, "href"=>"");
	// create treeMenu instance
	$menuRoot = new MenuItem($rootInfoArr, $menuNodes, $nullParent);
	// call xtempl assign, set session params
	$menuRoot->setMenuSession();
	$menuRoot->assignMenuAttrsToTempl($xt);
	$menuRoot->setCurrMenuElem($xt);
//	$menuRoot->clearMenuSession();
	
	$xt->assign("mainmenu_block",true);
	$rOrder = $xt->getReadingOrder();
	
	$mainmenu=array();
	if(isEnableSection508()) 
	{
		$mainmenu["begin"]="<a name=\"skipmenu\"></a>";
	}
//	Javascript code for menu on page
	$mainmenu["end"]='
	<script type="text/javascript" language="javascript" src="include/jquery.dropshadow.js"></script>';
		
	$countLinks=0;
	$countGroups=0;
	foreach($menuRoot->children as $ind=>$val)
	{
		if($val->showAsLink)
			$countLinks++;			
		if ($val->showAsGroup)
			$countGroups++;			
	}
	if(($pageType == PAGE_MENU) || $countLinks>1 || $countGroups>0)
	{
		$xt->assignbyref("mainmenu_block",$mainmenu);
		$xt->assign("mainmenustyle_block",true);
		$xt->assign("mainmenuiestyle_block",true);
		if(isset($menuparams["quickjump"]))
			$xt->display("mainmenu_quickjump.htm");
		elseif(array_key_exists("custom1",$menuparams) && $menuparams["custom1"]=="horizontal")
			$xt->display("mainmenu_horiz.htm");
		else
			$xt->display("mainmenu.htm");
	}
	//for add ao delete &nbsp; 
?>
