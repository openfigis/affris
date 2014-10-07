<?php
class MembersPage extends ListPage_Simple 
{	
	/**
	 * Groups array from DB
	 *
	 * @var array
	 */
	var $groups = array();
	var $groupFullChecked = array();
	/**
	 * Members array from DB
	 *
	 * @var array
	 */	
	var $members = array();
	/**
	 * If sort by group - number of group, else false
	 *
	 * @var int
	 */
	var $sortByGroup = false;
	/**
	 * Sort order for group sorting
	 *
	 * @var string
	 */
	var $sortOrder = "";
	/**
	 * How users col should be sorted
	 * D for desc, A for ASC
	 *
	 * @var string
	 */
	var $userOrderBy = "";
	
	var $addSaveButtons = false;
	
	/**
	 * Contructor
	 *
	 * @param array $params
	 * @return MembersPage
	 */
	function MembersPage(&$params) 
	{		
		// call parent
		parent::ListPage_Simple($params);
		// template file name
		$this->templatefile = "admin_members_list.htm";	
		
		$this->listAjax = false;
	}
	/**
	 * Override, add admin_members specific assignments
	 *
	 */
	function commonAssign() 
	{	
		// call parent
		parent::commonAssign();
		// add additional assignments
		$this->xt->assign("add_headcheckbox","id=\"add\" onclick=\"var chk=this.checked; $('input[@id^=cbadd_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("edt_headcheckbox","id=\"edt\" onclick=\"var chk=this.checked; $('input[@id^=cbedt_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("del_headcheckbox","id=\"del\" onclick=\"var chk=this.checked; $('input[@id^=cbdel_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("lst_headcheckbox","id=\"lst\" onclick=\"var chk=this.checked; $('input[@id^=cblst_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("exp_headcheckbox","id=\"exp\" onclick=\"var chk=this.checked; $('input[@id^=cbexp_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("imp_headcheckbox","id=\"imp\" onclick=\"var chk=this.checked; $('input[@id^=cbimp_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
		$this->xt->assign("adm_headcheckbox","id=\"adm\" onclick=\"var chk=this.checked; $('input[@id^=cbadm_]').each(function() {if(this.style.display=='') this.checked=chk;});\"");
						
		$this->xt->assign("addgroup_attrs","onclick=\"\$('#addarea').show();\$('#groupname')[0].focus(); \$('#groupname').val(makename('"."newgroup"."'));\$('#gmessage').html(TEXT_AA_ADD_NEW_GROUP);renameidx=-1;\"");
		$this->xt->assign("delgroup_attrs","id=\"delgroup\" onclick=\"deletegroup();\"");
		$this->xt->assign("rengroup_attrs","onclick=\"\$('#addarea').show();\$('#groupname')[0].focus();var gr=document.getElementById('group'); \$('#groupname').val(gr.options[gr.selectedIndex].text);\$('#gmessage').html(TEXT_AA_RENAMEGROUP);renameidx=gr.selectedIndex;\"");
		$this->xt->assign("groupname_attrs","onblur=\"if(renameidx<0) this.value=makename(this.value);\" onkeydown=\"e=event; if(!e) e = window.event; if (e.keyCode != 13) return true; e.cancel = true; save(\$('#groupname').val()); return false;\"");
		$this->xt->assign("savegroup_attrs","onclick=\"save(\$('#groupname').val());\"");
		$this->xt->assign("cancelgroup_attrs","onclick=\"\$('#addarea').hide(); if(renameidx>=0) \$('#groupname').val('');\"");
		
		if ($this->addSaveButtons)
		{
			$this->xt->assign("recordcontrols_block",true);
			$this->xt->assign("savebuttons_block",true);
			$this->xt->assign("savebutton_attrs", "id=\"saveButton".$this->id."\"");
			$this->xt->assign("resetbutton_attrs", "id=\"resetButton".$this->id."\"");		
		}
		
		$this->xt->assign("toplinks_block",true);
		$this->xt->assign("search_records_block",true);
		$this->xt->assign("username",htmlspecialchars($_SESSION["UserID"]));
		$this->xt->assign("shiftstyle_block",true);
		$this->xt->assign("security_block",true);
		$this->xt->assign("left_block",true);		
				
		$userheaderlink_attrs = "href=\"".$this->tName."_list.php?orderby=";
		if($this->sortByGroup !== false || $this->userOrderBy != "A")
			$userheaderlink_attrs.="A";
		else
			$userheaderlink_attrs.="D";
		$userheaderlink_attrs.="\"";
		$this->xt->assign("userheaderlink_attrs",$userheaderlink_attrs);
		
		if($this->sortByGroup === false)
		{
			if($this->userOrderBy == "A")
				if($this->is508)
					$this->xt->assign("users_orderimg","<img src=\"images/up.gif\" alt=\" \" border=0>");
				else
					$this->xt->assign("users_orderimg","<img src=\"images/up.gif\" border=0>");
			else if($this->userOrderBy == "D")
				if($this->is508)
					$this->xt->assign("users_orderimg","<img src=\"images/down.gif\" alt=\" \" border=0>");
				else
					$this->xt->assign("users_orderimg","<img src=\"images/down.gif\" border=0>");
		}
		
		$this->xt->assign("menu_block",true);
	}	
	
	
	/**
	 * save member assignments
	 *
	 */
	function save() 
	{
		if(postvalue("a")=="save")
		{
			$useridx=0;
			foreach(postvalue("username") as $user)
			{
				$useridx++;
				//	delete records which are not needed
				$sql="delete from `ugmembers` where UserName='".db_addslashes($user)."'";
				if($user==$_SESSION["UserID"])
					$sql.=" and GroupID<>-1";
				db_exec($sql,$this->conn);
				if(count($_POST["cb_".$useridx]))
				{
					$glist="";
					foreach(@$_POST["cb_".$useridx] as $g)
					{
						if($g<0)
						{
							if($user==$_SESSION["UserID"] && $g==-1)
								continue;
							$sql="insert into `ugmembers` (UserName,GroupID) values ('".htmlspecialchars($user)."',".$g.")";
							db_exec($sql,$this->conn);
						}
						else
						{
							if($glist!="")
								$glist.=",";
							$glist.=$g;
						}
					}
					if($glist!="")
					{
						$sql="insert into `ugmembers` (UserName,GroupID) select '".htmlspecialchars($user)."',GroupID from `uggroups` where GroupID in (".$glist.")";
						db_exec($sql,$this->conn);
					}
				}
			}
		}
	}
	
	/**
	 * Fills grid rows and headers
	 *
	 */
	function fillGridData() 
	{							
		//	fill $rowInfo array
		$rowInfo = array();	
		//	add grid data
		$shade = false;
		$data = $this->beforeProccessRow();
		// like usual grid data fill 
		while($data && ($this->sortByGroup !== false || $this->recNo <= $this->pageSize || $this->pageSize==-1))
		{
			$row=array();
			
			$row["rowattrs"] = "";
			if(! $shade) 
			{
				$row["rowattrs"] .= "class='shade'";
				$shade = true;
			} 
			else 
				$shade = false;
			
			$row["rowattrs"].= " rowid=\"".$this->recNo."\"";
			$row["grid_record"]=array();
			$row["grid_record"]["data"]=array();
		
			//	create checkboxes		
			$member_indexes=array();
			foreach($this->members as $idx=>$m)
			{
				if($m[1]==$data["user"])
					$member_indexes[]=$idx;
			}
			$rowgroups=array();
			$userfullchecked=true;
			foreach($this->groups as $idx=>$g)
			{
				$checked=false;
				$smarty_group=array();
				foreach($member_indexes as $i)
				{
					if($this->members[$i][0]==$g[0])
					{
						$checked=true;
						break;
					}
				}
				$smarty_group["groupbox_attrs"]="name=\"cb_".$this->recNo."[]\" value=\"".$g[0]."\"";
				$smarty_group["checked"]=0;
				if(!$checked)
				{
					$userfullchecked=false;
					$groupfullchecked[$idx]=false;
				}
				else
				{
					$groupfullchecked[$idx]=true;
					$smarty_group["groupbox_attrs"].=" checked";
					$smarty_group["checked"]=1;
				}
				$smarty_group["group"]=$g[0];
				$rowgroups[]=$smarty_group;
			}
			$row["usergroup_boxes"]=array("data"=>$rowgroups);
			$usercheckbox_attrs="";
			if($userfullchecked)
				$usercheckbox_attrs.=" checked";
			$row["begin"]="<input type=hidden name=\"username[]\" value=\"".htmlspecialchars($data["user"])."\">";
			$row["username"]=htmlspecialchars($data["user"]);
			$row["user"]=$data["user"];
			$usercheckbox_attrs.=" name=\"user_".htmlspecialchars($data["user"])."\"";
			$usercheckbox_attrs.=" onclick=\"var ch=document.getElementsByName('cb_'+\$(this).attr('rowid')+'[]');
				for(i=0;i<ch.length;i++)
					ch[i].checked=this.checked;
				return true;\"";
			if($this->sortByGroup === false)
				$usercheckbox_attrs.= " rowid=".$this->recNo;
			$row["usercheckbox_attrs"]=$usercheckbox_attrs;
			$row["recNo"] = $this->recNo; 
			$this->recNo++;
	
	//	assign row spacings for vertical layout
			$row["grid_rowspace"]=true;
			$row["grid_recordspace"] = array("data"=>array());
			for($i=0;$i<$this->colsOnPage*2-1;$i++)
				$row["grid_recordspace"]["data"][]=true;
			
			if($this->eventExists("BeforeMoveNextList"))
				$this->eventsObject->BeforeMoveNextList($data,$row,$record);
			$rowInfo[]=$row;
			
			$data = $this->beforeProccessRow();
			
		}
		
		// fill headers array
		foreach($this->groups as $g)
		{
			$smartyGroups[]=array("groupname"=>htmlspecialchars($g[1]),
				"groupheaderlink_attrs"=>"href=\"".$this->tName."_list.php?orderby=a".$g[0]."\"",
				"groupheaderbox_attrs"=>"name=\"".$g[0]."\" onclick=\"var chk = this.checked; \$('input[@type=checkbox][@value\='+this.name+'][@name^=cb_]').each( function(){this.checked=chk;})\""
			);
		}
		// fill group checkbox attrs
		foreach($smartyGroups as $idx=>$g)
		{
			if(isset($groupfullchecked[$idx]) && $groupfullchecked[$idx])
			{
				$smartyGroups[$idx]["groupheaderbox_attrs"].=" checked";				
			}
		}
		// add sort arrow to groups
		$this->sortGroups($smartyGroups);		
		// sort by group header
		$this->doSortByGroup($rowInfo);	
		// assign grid rows		
		$this->xt->assign_loopsection("grid_row", $rowInfo);
		// assign grid headers
		$this->xt->assign_loopsection("usergroup_header", $smartyGroups);
		
		if (count($rowInfo))
		{
			$this->addSaveButtons = true;
		}
		
	}
	/**
	 * For group array sorting
	 *
	 * @param link $rowInfo
	 */	
	function DPOrderUsers(&$rowInfo)
	{
		// deal with global vars
		global $sortgroup, $sortorder;
		$sortgroup = $this->sortByGroup;
		$sortorder = $this->sortOrder;
	
		sortMembers($rowInfo);
	}
	
	/**
	 * Fill members array from DB, call after save
	 *
	 */
	function fillMembers() 
	{
		//	select members list		
		$trs = db_query("select UserName,GroupID from `ugmembers` order by UserName,GroupID",$this->conn);
		while($tdata = db_fetch_numarray($trs))
		{
			$this->members[] = array($tdata[1],$tdata[0]);
		}
	}
	
	/**
	 * Fill groups array from DB, call after save
	 *
	 */
	function fillGroups() 
	{
		$this->groups[]=array(-1,"<"."Admin".">");
		$this->groupFullChecked[]=true;
		
		$trs = db_query("select GroupID,Label from `uggroups` order by Label",$this->conn);
		while($tdata = db_fetch_numarray($trs))
		{
			$this->groups[]=array($tdata[0],$tdata[1]);
			$this->groupFullChecked[]=true;
		}
	}
	/**
	 * Sort rows headers by group
	 *
	 * @param link $smartyGroups
	 */
	function sortGroups(&$smartyGroups) 
	{
		//		assign sort links
		foreach($this->groups as $i=>$g)
		{
			if($this->sortByGroup==$g[0] && $this->sortOrder=="a")
			{
				$smartyGroups[$i]["groupheaderlink_attrs"]="href=\"".$this->tName."_list.php?orderby=d".$g[0]."\"";
				if($this->is508)
					$smartyGroups[$i]["groupheader_img"] = "<img src=\"images/up.gif\" alt=\" \" border=0>";
				else
					$smartyGroups[$i]["groupheader_img"] = "<img src=\"images/up.gif\" border=0>";
			}
			elseif($this->sortByGroup==$g[0] && $this->sortOrder=="d")
			{				
				if($this->is508)
					$smartyGroups[$i]["groupheader_img"] = "<img src=\"images/down.gif\" alt=\" \" border=0>";
				else
					$smartyGroups[$i]["groupheader_img"] = "<img src=\"images/down.gif\" border=0>";
			}
				
		}
	}
	
	
	function prepareForResizeColumns()
	{
		return true;
	}
	
	
	/**
	 * PRG rule, to avoid POSTDATA resend
	 * call after save
	 *
	 */
	function rulePRG() 
	{		
		if(no_output_done() && (postvalue("a")=="save"/* || count($this->selectedRecs)*/)) 
		{
			// redirect, add a=return param for saving SESSION
			header("Location: ".$this->shortTableName."_".$this->getPageType().".php?a=return");
			// turned on output buffering, so we need to stop script
			exit();
		}
	}
	/**
	 * Parse session
	 *
	 */
	function setSessionVariables() 
	{
		// call parent
		parent::setSessionVariables();
		// order vars are simple
		if(!@$_SESSION[$this->sessionPrefix."_orderby"] || $this->userOrderBy == "A" || $this->userOrderBy == "D")
		{
			$this->sortByGroup = false;
		}
		$this->sortByGroup = substr($_SESSION[$this->sessionPrefix."_orderby"],1);
		$this->sortOrder = substr($_SESSION[$this->sessionPrefix."_orderby"], 0, 1);

		if(@$_SESSION[$this->sessionPrefix."_orderby"]=="D")
		{
			$this->userOrderBy = "D";
		}else{
			$this->userOrderBy = "A";
		}
	}
	
	/**
	 * Sort rows by groups
	 *
	 * @param link $rowInfo
	 */
	function doSortByGroup(&$rowInfo) 
	{		
		if ($this->sortByGroup!==false)
		{
			$this->DPOrderUsers($rowInfo);
			
		// apply pagination
			$firstindex=$this->pageSize*($this->myPage-1);
			for($i=0;$i<$firstindex;$i++)
				array_shift($rowInfo);
			if(count($rowInfo)>$this->pageSize)
				array_splice($rowInfo,$this->pageSize);
			$this->recNo=1;
			for($i=0;$i<count($rowInfo);$i++)
			{
				$rowInfo[$i]["usercheckbox_attrs"].= " rowid=".$this->recNo;
				for($j=0;$j<count($rowInfo[$i]["usergroup_boxes"]["data"]);$j++)
				{
					$rowInfo[$i]["usergroup_boxes"]["data"][$j]["groupbox_attrs"]="name=\"cb_".$this->recNo."[]\" value=\"".$rowInfo[$i]["usergroup_boxes"]["data"][$j]["group"]."\"";
					if($rowInfo[$i]["usergroup_boxes"]["data"][$j]["checked"])
						$rowInfo[$i]["usergroup_boxes"]["data"][$j]["groupbox_attrs"].=" checked";
				}
				$this->recNo++;
			}
		}
	}
	/**
	 * Build order query only for users header
	 *
	 */
	function buildOrderParams() 
	{
		if($this->userOrderBy == "D")
		{
			$this->strOrderBy = "Order by 2 desc";
		}else{
			$this->strOrderBy = "Order by 2 asc";
		}
	}	
		
	/**
	 * Main function, call to build page
	 * Do not change methods call oreder!!
	 *
	 */
	function prepareForBuildPage() 
	{
		// save recs
		$this->save();
		// PRG rule, to avoid POSTDATA resend
		$this->rulePRG();	
		//Sorting fields
		$this->buildOrderParams();
		// fill data
		$this->fillMembers();
		$this->fillGroups();
		// build sql query
		$this->buildSQL();
		// build pagination block
		$this->buildPagination();
		// seek page must be executed after build pagination
		if ($this->sortByGroup===false)
			$this->seekPageInRecSet($this->querySQL);					
		else
			$this->recSet = db_query($this->querySQL, $this->conn);
		// fill grid data
		$this->fillGridData();
		// build search panel
		$this->buildSearchPanel("adv_search_panel");
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
	 * show page at the end of its proccess, depending on mode
	 *
	 */
	function showPage() 
	{
		$this->xt->display($this->templatefile);
	}
}

?>