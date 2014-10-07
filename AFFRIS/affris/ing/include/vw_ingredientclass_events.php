<?php 
class eventclass_vw_ingredientclass  extends eventsBase
{ 
	function eventclass_vw_ingredientclass()
	{
	// fill list of events
		$this->events["BeforeMoveNextList"]=true;


//	onscreen events

	}
// Captchas functions	

//	handlers

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				// List page: After record processed
function BeforeMoveNextList(&$data,&$row,&$record)
{

		if ($data["IisDetail"]==0){
$record["vw_fullingredientelementanalysis_dtable_link"]=false;
}

if ($data["IisDetail"]==0){
$record["vw_fullingredientproxanalysis_dtable_link"]=false;
}
if ($data["IisDetail"]==0){
$record["vw_ingredientspecassociation_dtable_link"]=false;
}

// Place event code here.
// Use "Add Action" button to add code snippets.
;		
} // function BeforeMoveNextList

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
//	onscreen events

} 
?>
