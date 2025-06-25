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
	var $log;

	var $currentUrl;

	var $defaults = [];

	function __construct()
	{
		$this->log = log::singleton();


		// bindtextdomain('messages', ROOT_PATH . 'locale/' . $lang . '/LC_MESSAGES/');
		// bind_textdomain_codeset('messages', 'UTF-8');  // Make sure to set UTF-8 encoding if necessary
		// textdomain('messages');
	}
	function set_defaults($defs)
	{
		if (!empty($this->defaults)) {
			$this->defaults = array_merge($this->defaults, $defs);
		} else {
			$this->defaults = $defs;
		}
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
		$viewsFolder = APP_PATH . "views/";

		$template = $viewsFolder . $name;

		if (file_exists($template) == false) {
			throw new ViewException(ViewException::TPL_NOT_FOUND . " " . $template);
		}

		if (DEBUG_MODE) {
			echo '<!-- Template StripePad: ' . $template . ' -->';
		}

		if ($this->isAuthenticated) {
			include $viewsFolder . "layout/private/header.php";
			include $viewsFolder . "layout/private/menu-private.php";


			include($template);
			include $viewsFolder . "layout/private/footer.php";
		} else {
			include $viewsFolder . "layout/public/header.php";
			include $viewsFolder . "layout/public/menu-public.php";
			include($template);
			include $viewsFolder . "layout/public/footer.php";
		}

		echo '<!-- Powered by StripePad {STRIPE_PAD_VERSION}-->';

		$this->log->push(str_replace(APP_DOMAIN, '/', getCurrentUrl()), 'pageview', get_masked_ip());
		if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
		if (isset($_SESSION['alerts'])) unset($_SESSION['alerts']);
	}

	static function error404()
	{
		$viewsFolder = APP_PATH . "views/";
		$log = log::singleton();
		$log->push(getCurrentUrl(), '404');
		header('HTTP/1.0 404 Not Found');

		include $viewsFolder . "layout/public/header.php";
		include $viewsFolder . "layout/public/menu-public.php";
		include $viewsFolder . 'errors/404.php';
		include $viewsFolder . "layout/public/footer.php";
	}
}
