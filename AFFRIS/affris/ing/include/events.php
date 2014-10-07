<?php 
class eventsBase
{
	var $events = array();
	var $captchas = array();
	function exists($event) 
	{ 
		return (array_key_exists($event,$this->events)!==FALSE);
	}
	
	function existsCAPTCHA($page)
	{
		return (array_key_exists($page,$this->captchas)!==FALSE);
	}
	
	function callCAPTCHA(&$pageObject)
	{
		if($pageObject->pageType == "add")
			$this->displayCaptchaOnAdd();
		elseif($pageObject->pageType == "edit")
			$this->displayCaptchaOnEdit();
		elseif($pageObject->pageType == "register")
			$this->displayCaptchaOnRegister();
	}
}

class class_GlobalEvents extends eventsBase
{ 
	function class_GlobalEvents()
	{
	// fill list of events
		$this->events["AfterSuccessfulLogin"]=true;


//	onscreen events


		}
// Captchas functions	
//	handlers

		
		
		
		
		
		
				// After successful login
function AfterSuccessfulLogin($username,$password,&$data)
{

		
//**********  Redirect to another page  ************
header("Location: anypage.php");
exit();



// Place event code here.
// Use "Add Action" button to add code snippets.
;		
} // function AfterSuccessfulLogin

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

//	onscreen events
} 
?>
