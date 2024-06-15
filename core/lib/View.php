<?php

class View
{
	var $notification;
	var $path;
	var $isAuthenticated;
	
	function __construct(){
		
	}
	
	public function show($name = 'home.php', $vars = array(),$show_menu = true)
	{	
 		
		$isAuthenticated = $this->isAuthenticated;

        /* Template meta data */
		$page = $name;
		$base_url = APP_DOMAIN;
		$base_title =  APP_NAME;
		
        # Defaults (not empty)
		$HOOK_JS = '';
        $SEO_TITLE = SEO_TITLE; # Default Meta Title
        $SEO_DESCRIPTION = SEO_DESCRIPTION; # Default meta tag description
		
		/* Template Data */
		if(is_array($vars)) foreach ($vars as $key => $value) $$key = $value;
           	
	    /* TEMPLATE
	    ***********************/	
		$template = APP_PATH."themes/".APP_THEME."/".$name;
		
		if (file_exists($template) == false) {
			
			if (file_exists(APP_PATH."themes/".APP_THEME."/".$name)){
				$template = APP_PATH."themes/".APP_THEME."/".$name;
			}else{
				$this->error404();
			}
		}
		
		include APP_PATH."themes/".APP_THEME."/layout/header.php";		
		if ($show_menu){
			include APP_PATH."themes/".APP_THEME."/layout/menu.php";		
		}
    	include($template);
    	echo '<!-- Template StripePad: '.$template.' -->';

    	include APP_PATH."themes/".APP_THEME."/layout/footer.php";		
		echo '<!-- Powered by StripePad -->';
		if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
		if (isset($_SESSION['alerts'])) unset($_SESSION['alerts']);
	}

	public function error404(){
		header('HTTP/1.0 404 Not Found');
        $this->show('errors/404.php');
		
	}
}

?>