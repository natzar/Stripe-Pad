<?php

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
	var $path;
	/**
	 * isAuthenticated
	 *
	 * @var mixed
	 */
	var $isAuthenticated;
	/**
	 * log
	 *
	 * @var mixed
	 */
	var $log;

	function __construct() {}

	public function show($name = 'home.php', $vars = array(), $show_menu = true)
	{
		$this->log = log::singleton();
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
		if (is_array($vars)) foreach ($vars as $key => $value) $$key = $value;

		/* TEMPLATE
	    ***********************/
		$viewsFolder = APP_PATH . "views/";

		$template = $viewsFolder . $name;

		if (file_exists($template) == false) {

			$this->error404();
			exit;
		}

		include $viewsFolder . "layout/header.php";
		if ($show_menu) {
			if ($isAuthenticated) {
				include $viewsFolder . "layout/menu-private.php";
			} else {
				include $viewsFolder . "layout/menu-public.php";
			}
		}
		include($template);
		echo '<!-- Template StripePad: ' . $template . ' -->';

		include $viewsFolder . "layout/footer.php";
		echo '<!-- Powered by StripePad -->';
		$this->log->push(getCurrentUrl(), 'visit');
		if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
		if (isset($_SESSION['alerts'])) unset($_SESSION['alerts']);
	}

	public function error404()
	{
		$this->log->push(getCurrentUrl(), '404');
		header('HTTP/1.0 404 Not Found');
		$this->show('errors/404.php');
	}
}
