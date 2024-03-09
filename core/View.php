<?php

class View
{
	var $notification;
	var $path;
	var $config;
	
	function __construct(){
		
	}
	
	public function show($name = 'home.php', $vars = array(),$show_menu = true)
	{	
 		
 		
		
		/* Template meta data */
		$page = $name;
		$base_url = APP_DOMAIN;
		$base_title =  APP_NAME;
		
		$HOOK_JS = '';

		
		/* Template Data */
		if(is_array($vars))
           foreach ($vars as $key => $value)           
                	$$key = $value;
           	
	/* TEMPLATE
	***********************/	
		$template = APP_PATH."templates/".$name;
		
		if (file_exists($template) == false) {
			
			if (file_exists(APP_PATH."templates/".$name)){
				$template = APP_PATH."templates/".$name;
			}else{
				$this->error404();
			}
		}
		


		include APP_PATH."templates/layout/header.php";		
		if ($show_menu){
			include APP_PATH."templates/layout/menu.php";		
		}
    	include($template);
    	echo '<!-- Template StripePad: '.$template.' -->';

    	include APP_PATH."templates/layout/footer.php";		
		
		if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
		if (isset($_SESSION['alerts'])) unset($_SESSION['alerts']);
	}
	static public function error404(){
		header('HTTP/1.0 404 Not Found');
		include APP_PATH."templates/layout/header.php";		
	    include APP_PATH."templates/errors/404.php";
   		include APP_PATH."templates/layout/footer.php";			
		return false;
	}
}

?>