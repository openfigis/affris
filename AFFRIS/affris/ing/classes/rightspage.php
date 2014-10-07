<?php
/**
 * Class for display admin_rights_list  
 *
 */
class RightsPage extends ListPage  
{
	/**
	 * Array of non admin tables
	 *
	 * @var array
	 */
	var $nonAdminTablesArr = array();
	/**
	 * Array of non admin tables rights
	 *
	 * @var array
	 */
	var $nonAdminTablesRightsArr = array();
	/**
	 * Array with groups data from DB
	 *
	 * @var array
	 */
	var $groupsArr = array();
	/**
	 * Array of smarty groups
	 *
	 * @var array
	 */
	var $smartyGroups = array();
	
	/**
	 * Contructor
	 *
	 * @param array $params
	 * @return RightsPage
	 */
	function RightsPage(&$params)
	{
		// copy properties to object
		//RunnerApply($this, $params);		
		parent::RunnerPage($params);
		
		//fill session variables
		$this->setSessionVariables();
		
		// Set language params, if have more than one language
		$this->setLangParams();
		
		// get permissions 
		$this->permis[$this->tName]= $this->getPermissions();	
		
		$this->is508 = isEnableSection508();	
		
		// template file name
		$this->templatefile = "admin_rights_list.htm";		
		
		$this->DPOrderTables($this->nonAdminTablesArr);
		
		$this->fillGroupsArr();
	}
	
	function fillGroupsArr() {
		//	select groups list
		$this->groupsArr[]=array(-1, "<"."Admin".">");
		$this->groupsArr[]=array(-2, "<"."Default".">");
		$this->groupsArr[]=array(-3, "<"."Guest".">");
				
		
		$trs = db_query("select GroupID,Label from `uggroups` order by Label", $this->conn);
		
		while($tdata = db_fetch_numarray($trs))
		{
			$this->groupsArr[]=array($tdata[0],$tdata[1]);
		}
	}
	/**
	 * Fill and prepare rights array
	 * Call it only after save new data, for get fresh data
	 *
	 */
	function fillSmartyAndRights() 
	{
		foreach($this->groupsArr as $g)
		{
			$sg=array();
			$sg["group_attrs"] = "value=\"".$g[0]."\"";
			$sg["groupname"]=htmlspecialchars($g[1]);
			if($g[0]==postvalue("group"))
				$sg["group_attrs"].=" selected";
			$this->smartyGroups[]=$sg;
			foreach($this->nonAdminTablesArr as $t)
				$this->nonAdminTablesRightsArr[$t[0]][$g[0]]="";
		}
	}
	/**
	 * Fill rights array
	 * Call it only after save new data, for get fresh data
	 *
	 */
	function getRights() 
	{
		$trs = db_query("select GroupID,TableName,AccessMask from `ugrights` order by GroupID", $this->conn);
		while($tdata = db_fetch_numarray($trs))
		{
			if(!array_key_exists($tdata[1],$this->nonAdminTablesRightsArr))
				continue;
			if(!array_key_exists((int)$tdata[0],$this->nonAdminTablesRightsArr[$tdata[1]]))
				continue;
			$this->nonAdminTablesRightsArr[$tdata[1]][$tdata[0]]=$tdata[2];
		}
	}
	
	/**
	 * Prepare JS arrays with groups and tables data
	 *
	 */
	function addJsGroupsAndRights() 
	{
		$this->jsSettings['tableSettings'][$this->tName]['rightsTables'] = array();
		$this->jsSettings['tableSettings'][$this->tName]['rightsGroups'] = array();
		
		$tindex=0;		
		$gindex=0;
		
		foreach($this->groupsArr as $grp)
		{
			$this->jsSettings['tableSettings'][$this->tName]['rightsGroups'][$gindex] = $grp[0];
			$gindex++;
		}
		
		foreach($this->nonAdminTablesArr as $tbl)
		{
			$this->jsSettings['tableSettings'][$this->tName]['rightsTables'][$tindex] = GoodFieldName($tbl[0]);
			$tindex++;
		}
	}
	
	
	function commonAssign() 
	{
		
		$this->xt->assign("grouplist_attrs","size=".count($this->groupsArr)." onchange=\"fillboxes(this.options[this.selectedIndex].value);\" name=\"group\" id=\"group\"");
		$this->xt->assign_loopsection("groups", $this->smartyGroups);
			
		
		parent::commonAssign();
		
		$this->xt->assign("add_headcheckbox","id=\"add\" onclick=\"var chk=this.checked; $('input[@id^=cbadd_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("edt_headcheckbox","id=\"edt\" onclick=\"var chk=this.checked; $('input[@id^=cbedt_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("del_headcheckbox","id=\"del\" onclick=\"var chk=this.checked; $('input[@id^=cbdel_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("lst_headcheckbox","id=\"lst\" onclick=\"var chk=this.checked; $('input[@id^=cblst_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("exp_headcheckbox","id=\"exp\" onclick=\"var chk=this.checked; $('input[@id^=cbexp_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("imp_headcheckbox","id=\"imp\" onclick=\"var chk=this.checked; $('input[@id^=cbimp_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("adm_headcheckbox","id=\"adm\" onclick=\"var chk=this.checked; $('input[@id^=cbadm_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		
		
		if ($this->createLoginPage)
		{
			$this->xt->assign("userid",htmlspecialchars($_SESSION["UserID"]));
		}
		$this->xt->assign("addgroup_attrs","onclick=\"\$('#addarea').show();\$('#groupname')[0].focus(); \$('#groupname').val(makename('"."newgroup"."'));\$('#gmessage').html(TEXT_AA_ADD_NEW_GROUP);renameidx=-1;\"");
		$this->xt->assign("delgroup_attrs","id=\"delgroup\" onclick=\"deletegroup();\"");
		$this->xt->assign("rengroup_attrs","onclick=\"\$('#addarea').show();\$('#groupname')[0].focus();var gr=document.getElementById('group'); \$('#groupname').val(gr.options[gr.selectedIndex].text);\$('#gmessage').html(TEXT_AA_RENAMEGROUP);renameidx=gr.selectedIndex;\"");
		$this->xt->assign("groupname_attrs","onblur=\"if(renameidx<0) this.value=makename(this.value);\" onkeydown=\"e=event; if(!e) e = window.event; if (e.keyCode != 13) return true; e.cancel = true; save(\$('#groupname').val()); return false;\"");
		$this->xt->assign("savegroup_attrs","onclick=\"save(\$('#groupname').val());\"");
		$this->xt->assign("cancelgroup_attrs","onclick=\"\$('#addarea').hide(); if(renameidx>=0) \$('#groupname').val('');\"");
		
		$this->xt->assign("recordcontrols_block",true);
		$this->xt->assign("savebuttons_block",true);
		$this->xt->assign("savebutton_attrs","onclick=\"document.forms.frmAdmin.submit();\"");
		$this->xt->assign("resetbutton_attrs","onclick=\"document.forms.frmAdmin.reset();\"");		
		
		$this->xt->assign_section("rights_block",
			"<form method=\"POST\" action=\"admin_rights_list.php\" name=\"frmAdmin\" id=\"frmAdmin\">
			<input type=\"hidden\" id=\"a\" name=\"a\" value=\"save\">",
			"</form>");
		
		
		$this->xt->assign("grid_block",true);
		$this->xt->assign("toplinks_block",true);
		$this->xt->assign("search_records_block",true);
		$this->xt->assign("username",htmlspecialchars($_SESSION["UserID"]));
		$this->xt->assign("shiftstyle_block",true);
		$this->xt->assign("security_block",true);
		$this->xt->assign("left_block",true);
		
		$this->xt->assign("menu_block",true);
	}
	/**
	 * Sort tables array
	 *
	 * @param unknown_type $tables
	 */
	function DPOrderTables(&$tables)
	{
		sortTables($tables);
	}
	
	/**
	 * Save edited rights, call it first
	 *
	 */
	function save() 
	{
		if(postvalue("a")=="save")
		{
			foreach(postvalue("table") as $table)
			{
				//	delete records which are not needed
				$gtable=GoodFieldName($table);
				$sql="delete from `ugrights` where TableName='".db_addslashes($table)."'";
				db_exec($sql,$this->conn);
				foreach($this->groupsArr as $grp)
				{
					$mask="";
					if(@$_POST["cbadd_".$gtable."_".$grp[0]])
						$mask.="A";
					if(@$_POST["cbedt_".$gtable."_".$grp[0]])
						$mask.="E";
					if(@$_POST["cbdel_".$gtable."_".$grp[0]])
						$mask.="D";
					if(@$_POST["cblst_".$gtable."_".$grp[0]])
						$mask.="S";
					if(@$_POST["cbexp_".$gtable."_".$grp[0]])
						$mask.="P";
					if(@$_POST["cbimp_".$gtable."_".$grp[0]])
						$mask.="I";
					if(@$_POST["cbadm_".$gtable."_".$grp[0]])
						$mask.="M";
					if($mask)
						db_exec("insert into `ugrights` (TableName,GroupID,AccessMask) values ('".db_addslashes($table)."',".$grp[0].",'".$mask."')",$this->conn);
				}
			}
		}
	}
	
	
	/**
	 * Fills info in array about grid.
	 *
	 * @param array $rowInfoArr array with total info, that assignes grid
	 */
	function fillGridShowInfo(&$rowInfoArr) 
	{
		//	fill $rowInfoArr array
		$rowInfoArr = array();
		$shade=false;
		$recno=1;
		$editlink="";
		$copylink="";
	
		foreach($this->nonAdminTablesArr as $tbl)
		{
			$row=array();
			$row["begin"]="<input type=hidden name=\"table[]\" value=\"".htmlspecialchars($tbl[0])."\">";
			if($tbl[0]==$tbl[1])
				$row["tablename"]=htmlspecialchars($tbl[0]);
			else
				$row["tablename"]=htmlspecialchars($tbl[1])."&nbsp;(".htmlspecialchars($tbl[0]).")";
				
			$row["tablecheckbox_attrs"]="id=\"".GoodFieldName($tbl[0])."\" onclick=\"
			var chk=this.checked;
			$('input[@id^=cbadd_'+this.id+'_]').each( function() {if(this.style.display=='') this.checked=chk;});
			$('input[@id^=cbedt_'+this.id+'_]').each( function() {if(this.style.display=='') this.checked=chk;});
			$('input[@id^=cbdel_'+this.id+'_]').each( function() {if(this.style.display=='') this.checked=chk;});
			$('input[@id^=cblst_'+this.id+'_]').each( function() {if(this.style.display=='') this.checked=chk;});
			$('input[@id^=cbexp_'+this.id+'_]').each( function() {if(this.style.display=='') this.checked=chk;});
			$('input[@id^=cbimp_'+this.id+'_]').each( function() {if(this.style.display=='') this.checked=chk;});
			$('input[@id^=cbadm_'+this.id+'_]').each( function() {if(this.style.display=='') this.checked=chk;});
			\"";
						
			$row["rowattrs"] = "";
			if(!$shade) 
			{
				$row["rowattrs"] .= "class='shade'";
				$shade = true;
			} 
			else 
				$shade = false;
			$row["rowattrs"].= " rowid=\"0\"";
						
			$sgroups=array();
			
			foreach($this->groupsArr as $g)
			{
				$group = array();
				$mask = $this->nonAdminTablesRightsArr[$tbl[0]][$g[0]];
				// add display none style if group not Admin, because at page load, admin rights are shown
				$styleDispNone = $g[0] == -1 ? "" : ' style="display: none;" ';
				
				$checked=((strpos($mask,"A")!==FALSE))?" checked":"";				
				$group["add_checkbox"] = $styleDispNone." id=\"cbadd_".GoodFieldName($tbl[0])."_".$g[0]."\"".$checked." name=\"cbadd_".GoodFieldName($tbl[0])."_".$g[0]."\"";
				
				$checked=((strpos($mask,"E")!==FALSE))?" checked":"";
				$group["edt_checkbox"] = $styleDispNone." id=\"cbedt_".GoodFieldName($tbl[0])."_".$g[0]."\"".$checked." name=\"cbedt_".GoodFieldName($tbl[0])."_".$g[0]."\"";
				
				$checked=((strpos($mask,"D")!==FALSE))?" checked":"";
				$group["del_checkbox"] = $styleDispNone." id=\"cbdel_".GoodFieldName($tbl[0])."_".$g[0]."\"".$checked." name=\"cbdel_".GoodFieldName($tbl[0])."_".$g[0]."\"";
				
				$checked=((strpos($mask,"S")!==FALSE))?" checked":"";
				$group["lst_checkbox"] = $styleDispNone." id=\"cblst_".GoodFieldName($tbl[0])."_".$g[0]."\"".$checked." name=\"cblst_".GoodFieldName($tbl[0])."_".$g[0]."\"";
				
				$checked=((strpos($mask,"P")!==FALSE))?" checked":"";
				$group["exp_checkbox"] = $styleDispNone." id=\"cbexp_".GoodFieldName($tbl[0])."_".$g[0]."\"".$checked." name=\"cbexp_".GoodFieldName($tbl[0])."_".$g[0]."\"";
				
				$checked=((strpos($mask,"I")!==FALSE))?" checked":"";
				$group["imp_checkbox"] = $styleDispNone." id=\"cbimp_".GoodFieldName($tbl[0])."_".$g[0]."\"".$checked." name=\"cbimp_".GoodFieldName($tbl[0])."_".$g[0]."\"";
				
				$checked=((strpos($mask,"M")!==FALSE))?" checked":"";
				$group["adm_checkbox"] = $styleDispNone." id=\"cbadm_".GoodFieldName($tbl[0])."_".$g[0]."\"".$checked." name=\"cbadm_".GoodFieldName($tbl[0])."_".$g[0]."\"";
				
				$sgroups[]=$group;
			}
			$row["add_groupboxes"]=array("data"=>$sgroups);
			$row["edt_groupboxes"]=&$row["add_groupboxes"];
			$row["del_groupboxes"]=&$row["add_groupboxes"];
			$row["lst_groupboxes"]=&$row["add_groupboxes"];
			$row["exp_groupboxes"]=&$row["add_groupboxes"];
			$row["imp_groupboxes"]=&$row["add_groupboxes"];
			$row["adm_groupboxes"]=&$row["add_groupboxes"];
			$rowInfoArr[]=$row;
		}
		
	}
	/**
	 * Fill premissions grid
	 *
	 */
	function fillGridData() 
	{
		//	fill $rowinfo array
		$rowInfo = array();
		$this->fillGridShowInfo($rowInfo);
		$this->xt->assign_loopsection("grid_row", $rowInfo);
	}
	/**
	 * Fill session vars, override parent
	 *
	 */
	function setSessionVariables() 
	{
		if(@$_REQUEST["orderby"])
			$_SESSION[$strTableName."_orderby"]=@$_REQUEST["orderby"];
		
		if(@$_REQUEST["pagesize"])
		{
			$_SESSION[$strTableName."_pagesize"]=@$_REQUEST["pagesize"];
			$_SESSION[$strTableName."_pagenumber"]=1;
		}
		
		if(@$_REQUEST["goto"])
			$_SESSION[$strTableName."_pagenumber"]=@$_REQUEST["goto"];
	}
	
	
	/**
	 * Main function, call to build page
	 * Do not change methods call oreder!!
	 *
	 */
	function prepareForBuildPage() 
	{		
		// save changes
		$this->save();			
		// PRG rule, to avoid POSTDATA resend
		$this->rulePRG();	
		// prepare array, only after save, for get new data
		$this->fillSmartyAndRights();
		// get rights, only after save, for fresh data
		$this->getRights();
		// fill grid data
		$this->fillGridData();
		// add common js code
		$this->addCommonJs();
		// add common html code
		$this->addCommonHtml();
		// Set common assign
		$this->commonAssign();
		// build admin block		
		$this->assignAdmin();
	}
	
	/**
	 * PRG rule, to avoid POSTDATA resend
	 * call after save
	 *
	 */
	function rulePRG() 
	{		
		if(no_output_done() && postvalue("a")=="save") 
		{
			$getParams = '';
			if (postvalue('group'))
			{
				$getParams = '?group='.postvalue('group');
			}
			// redirect, add a=return param for saving SESSION
			header("Location: ".$this->shortTableName."_".$this->getPageType().".php".$getParams);
			// turned on output buffering, so we need to stop script
			exit();
		}
	}
	
	/**
	 * show page at the end of its proccess, depending on mode
	 *
	 */
	function showPage() 
	{
		$this->xt->display($this->templatefile);
	}
	/**
	 * Adds HTML and JS
	 *
	 */
	function addCommonHtml() 
	{
		$this->body["begin"] .= "<script type=\"text/javascript\" src=\"include/jquery.js\"></script>";
		$this->body["begin"] .= "<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";

		
		if ($this->debugJSMode === true)
		{
			/*$this->body["begin"].="<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
				$this->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
		}
		else
			$this->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
		
		
		if ($this->isDisplayLoading)
		{
			$this->body["begin"] .= "<script type=\"text/javascript\">runLoading(".$this->id.",document.body,0);</script>"; 
			$this->getStopLoading();
		}
				
		$this->body["begin"] .= "<style>INPUT.button_dis{
		                  background: gainsboro;
						  color: ffffff;
						 }</style>";
		
		//$this->body['end'] = "<script>".$this->PrepareJS()."</script>";
		
		// assign body end
		$this->body['end'] = array();
		$this->body['end']["method"] = "assignBodyEnd";		
		$this->body['end']["object"] = &$this;	
	}
	
	function prepareForResizeColumns()
	{
		return true;
	}
	
	/**
	 * Add js files and scripts
	 *
	 */
	function addCommonJs() {
		// call parent if need RunnerJS API 
		RunnerPage::addCommonJs();
		
		$this->addJsGroupsAndRights();		
	}
	
}

?>