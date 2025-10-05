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

	function __construct()
	{
		$this->current_url = getCurrentUrl();
	}

	function set_views_path($path)
	{
		$this->path = $path;
	}
	function set_isAuthenticated($val)
	{
		$this->isAuthenticated = $val;
	}

	public function show($name = 'custom/home.php', $vars = array(), $show_menu = true)
	{
		try {
			$this->renderTemplate($name, $vars, $show_menu);
		} catch (ViewException $e) {
		}
	}

	public function renderTemplate($name, $vars, $show_menu)
	{
		/* INITIALIZE
	    ***********************/
		## Strings
		$isAuthenticated = $this->isAuthenticated;
		/* Template meta data */
		$page = $name;
		$base_url = APP_DOMAIN;
		$base_title =  APP_NAME;
		$hookBeforeApp = '';
		# Defaults (not empty)
		$HOOK_JS = '';
		$SEO_TITLE = SEO_TITLE; # Default Meta Title
		$SEO_DESCRIPTION = SEO_DESCRIPTION; # Default meta tag description
		$SEO_KEYWORDS = ""; //SEO_KEYWORDS; # Default meta tag keywords
		/* Template Data */
		foreach ($this->defaults as $key => $value) $$key = $value;
		if (is_array($vars)) foreach ($vars as $key => $value) $$key = $value;

		/* TEMPLATE
	    ***********************/


		$template = $this->path . $name;

		if (file_exists($template) == false) {
			throw new ViewException(ViewException::TPL_NOT_FOUND . " " . $template);
		}

		if (DEBUG_MODE) {
			echo '<!-- Template StripePad: ' . $template . ' -->';
		}

		include $this->path . "layout/header.php";
		include $this->path . "layout/menu-public.php";
		include($template);
		include $this->path . "layout/footer.php";

		// if ($this->isAuthenticated) {
		// 	include $this->path . "layout/private/header.php";
		// 	include $this->path . "layout/private/menu-private.php";


		// 	include($template);
		// 	include $this->path . "layout/private/footer.php";
		// } else {

		// }

		//echo '<!-- Powered by StripePad {STRIPE_PAD_VERSION}-->';

		log::traffic('[Pageview] ' . getCurrentUrl() . '-' . get_masked_ip());
		if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
		if (isset($_SESSION['alerts'])) unset($_SESSION['alerts']);
	}

	static function error404()
	{
		//$this->path = APP_PATH . "views/";
		$log = log::singleton();
		$log->push(getCurrentUrl(), '404');
		header('HTTP/1.0 404 Not Found');
		$SEO_TITLE = "404 Not Found";
		$SEO_DESCRIPTION = "The page you are looking for does not exist.";
		$SEO_KEYWORDS = "404, not found, error";
		$HOOK_JS = '';
		include $this->path . "layout/public/header.php";
		include $this->path . "layout/public/menu-public.php";
		include $this->path . 'errors/404.php';
		include $this->path . "layout/public/footer.php";
	}
}
