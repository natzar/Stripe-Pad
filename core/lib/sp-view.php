<?php

use StripePad\Exceptions\ViewException;

/**
 * View
 */
class View
{
	/**
	 * notification
	 *
	 * @var mixed
	 */
	var $notification;
	/**
	 * path
	 *
	 * @var mixed
	 */
	var $path = APP_PATH . 'views/';
	/**
	 * isAuthenticated
	 *
	 * @var mixed
	 */
	var $isAuthenticated = false;
	/**
	 * log
	 *
	 * @var mixed
	 */
	var $current_url;

	var $hide_menu = false;
	function __construct()
	{
		$this->current_url = getCurrentUrl();
	}

	function set_views_path($path)
	{
		$this->path = $path;
	}

	function hide_menu()
	{
		$this->hide_menu = true;
	}
	function set_isAuthenticated($val)
	{
		$this->isAuthenticated = $val;
	}

	public function show($name = 'custom/home.php', $vars = array(), $show_menu = true)
	{

		/* INITIALIZE
	    ***********************/
		## Strings
		$isAuthenticated = $this->isAuthenticated;
		/* Template meta data */
		$page = $name;
		$base_url = LANDING_URL;
		$base_title =  APP_NAME;
		$hookBeforeApp = '';
		# Defaults (not empty)
		$HOOK_JS = '';
		$SEO_TITLE = SEO_TITLE; # Default Meta Title
		$SEO_DESCRIPTION = SEO_DESCRIPTION; # Default meta tag description
		$SEO_KEYWORDS = ""; //SEO_KEYWORDS; # Default meta tag keywords

		/* Template Data */
		if (is_array($vars)) foreach ($vars as $key => $value) $$key = $value;

		/* TEMPLATE
	    ***********************/
		$template = $this->path . $name;

		if (DEBUG_MODE) {
			echo '<!-- Template StripePad: ' . $template . ' -->';
		}



		include $this->path . "layout/header.php";
		if (!$this->hide_menu) include $this->path . "layout/menu.php";
		if (file_exists($template) == false) {
			log::system("View Error 404: " . $template);
			include $this->path . '404.php';
		} else {
			include($template);
		}
		include $this->path . "layout/footer.php";

		//echo '<!-- Powered by StripePad {STRIPE_PAD_VERSION}-->';

		log::traffic('[Pageview] ' . getCurrentUrl() . '-' . get_masked_ip());
		if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
		if (isset($_SESSION['alerts'])) unset($_SESSION['alerts']);
	}
}
