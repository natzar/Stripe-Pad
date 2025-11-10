<?php

/**
 *   Package Name: Stripe Pad
 *   File Description: Main Controller for custom app. Use this class to Override any core method /core/StripePad.php
 *   # Each method of this class can be accessed from //your-domain/app/{method}?params=params
 *   @author Beto Ayesa <beto.phpninja@gmail.com>
 *   @version 1.0.0
 *   @package StripePad
 *   @license GPL3
 *   @link https://github.com/natzar/stripe-pad
 * 
 *  
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   This file is part of Stripe Pad.
 *
 *   Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *   Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */


/**
 * Your Custom App
 * @ this controller by default extends StripePadController located at core/sp-core.php
 * 
 * Each method of this class can be accessed from //your-domain/{method}
 * $this->params contains all get/post params
 * App.php is just the main and solo controller of your custom app. 
 * Create service end points or just urls for your public and private pages. 
 * Old skool, php sevver side rendering, as less javascript as possible.
 */




class App extends StripePadController
{
	var $isAuthenticated = false;
	var $accountsId = null; // Current account ID, 1 user can have > 1 accounts

	public function __construct()
	{
		parent::__construct(); // !important

		// We're in APP (private area) so we need to check if user is authenticated
		$this->isAuthenticated = $this->isAuthenticated();
		# Some default values for views
		$this->view->set_views_path(APP_PATH . "views/");
		$this->view->set_isAuthenticated($this->isAuthenticated);

		if (!$this->isAuthenticated) {
			header("location: " . LANDING_URL . "login");
			// die don't continue. All methods are for registered users only
			exit;
		} else {
			$this->view->isAuthenticated = true;
			$c = new accountsModel();
			$cs = $c->get_accounts_by_usersId($_SESSION['user']['usersId']);

			if (!isset($_SESSION['account'])) {
				$_SESSION['account'] = $c->get_by_id($cs[0]['accountsId']);
			}

			if (!isset($_SESSION['user']['accounts'])) {
				$_SESSION['user']['accounts'] = $cs;
			}
			$this->accountsId = $_SESSION['account']['accountsId'];
			$this->view->set_defaults(array(
				'accounts' => $_SESSION['user']['accounts'],
				'account' => $_SESSION['account']
			));
		}
	}

	/**
	 * app 
	 * (Private part entry point, registered users only)
	 * If a registered user logs in, this method will be called. MODIFY THIS FUNCTION.
	 * @return void
	 */
	public function index() // DASHBOARD
	{

		# Sample render of view with $data
		$data = array(
			"SEO_TITLE" => "xyz",
			"SEO_DESCRIPTION" => "xyz",
			"breadcrumb" => array(array("label" => "Inicio", "url" => "#")),
			"user" => $_SESSION['user'],

		);

		# show app/views/index.php passing $data
		$this->view->show('index.php', $data);
	}

	public function bitcoin()
	{
		require_once APP_PATH . 'services/BitcoinTracker.php';

		$tracker = new BitcoinTracker();
		$snapshot = $tracker->getSnapshot();

		$data = [
			"SEO_TITLE" => "Bitcoin Tracker",
			"SEO_DESCRIPTION" => "Live Bitcoin price and quick reference chart.",
			"breadcrumb" => [
				["label" => "Dashboard", "url" => APP_URL],
				["label" => "Bitcoin Tracker", "url" => "bitcoin"],
			],
			"tracker" => $snapshot,
			"currency" => $tracker->getCurrency(),
		];

		$this->view->show('bitcoin.php', $data);
	}


	public function upgrade()
	{
		if (!$this->isAuthenticated) {
			throw new PermissionsException("You need to be logged in");
		}
		$products = new productsModel();
		$data = array(
			"products" => $products->getAll()

		);

		$this->view->show('upgrade.php', $data);
	}


	public function help()
	{
		$this->view->show('help.php', array(
			"SEO_TITLE" => "Help",
			"SEO_DESCRIPTION" => "Get help and support.",
			"breadcrumb" => array(
				array("label" => "Help", "url" => "help")
			),

		));
	}


	public function app_settings()
	{

		$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
		$this->view->show('custom/settings.php', array(
			"SEO_TITLE" => "Configuración de las Respuestas ",
			"SEO_DESCRIPTION" => "Emilia  responderá los emails entrantes en el buzón de correo configurado, siguiendo los ajustes e instrucciones siguientes:",
			"breadcrumb" => array(
				array("label" => "Configuración Respuestas Automáticas", "url" => "app_settings")
			),

		));
	}

	public function app_change_account()
	{
		// SECURITY
		// Fix agents = other accounts under same user ownsership or access

		$c = new agentsModel();
		$cs = $c->get_agents_by_user($_SESSION['user']['usersId']);
		$aux = [];
		foreach ($cs as $x):
			$aux[] = $x['agentsId'];
		endforeach;

		if (!in_array($this->params['m'], $aux)) {
			$this->view->show('custom/error.php', array("msg" => "No tens permisos per accedir a aquesta empresa"));
			return;
		}
		$company = $c->getById($this->params['m']);
		$_SESSION['agent'] = $company;
		//$this->app();
		header("location: " . APP_DOMAIN);
	}

	public function app_new_account()
	{
		//print_r($this->params);
		if (isset($this->params['agent_organization']) and !empty($this->params['agent_organization'])) {
			$agents = new agentsModel();
			$_SESSION['alerts'][] = "Nuevo agente añadido";
			$new_agent = $agents->create($this->params['agent_organization'], $_SESSION['user']['usersId']);


			$_SESSION['user']['agents'] =  $agents->get_agents_by_user($_SESSION['user']['usersId']);

			header("location: " . APP_DOMAIN . 'app_change_account/' . $new_agent['agentsId']);
			return;
		}
		$this->view->show('custom/new_account.php', array(
			'SEO_TITLE' => "Añadir Agente Nuevo",
			'SEO_DESCRIPTION' => "Añade un nuevoo agente a tu cuenta para gestionar otro buzón de correo."
		));
	}

	public function form()
	{



		$table = isset($this->params['m']) ? $this->params['m'] : -1;
		$rid = isset($this->params['a']) ? $this->params['a'] : -1;
		$op = isset($this->params['i']) ? $this->params['i'] : '';
		$modelName = $table . 'Model';
		$form = new $modelName();

		$data = $form->generateForm($table, $rid, $op);
		$data['SEO_TITLE'] = 'Añadir nuevo ';
		$data['SEO_DESCRIPTION'] = 'Añade un nuevo ' . ucfirst($table) . ' a la base de datos';
		$data["breadcrumb"] = array("label" => ucfirst($table), "url" => "app_" . $table);
		if ($rid != -1) {
			$data['SEO_TITLE'] = ucfirst($table) . ' #' . $rid;
			$data['SEO_DESCRIPTION'] = "sp-core.php linea 659"; //Created " . strftime(" %d %B %Y %H:%M", strtotime($data['created'])) . " - Updated: " . strftime(" %d %B %Y %H:%M", strtotime($data['updated']));
		}

		$this->view->show('superadmin/form.php', $data);
	}
}
