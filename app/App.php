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
 * Default Routes for your SaaS
 */

class App extends StripePadController
{
	var $isAuthenticated = false;

	public function __construct()
	{
		parent::__construct(); // !important

		# Some default values for views
		$defaults = array();

		$this->view->isAuthenticated = $this->isAuthenticated = $this->isAuthenticated();

		if (isset($this->params['p']) and strstr($this->params['p'], "app_") and !$this->isAuthenticated) {
			header("location: " . APP_DOMAIN . "login");
			return;
		}

		$this->view->set_defaults($defaults);
	}

	/**
	 * index
	 * default main method
	 * @return void
	 */
	public function index()
	{
		# check if user is authenticated
		if ($this->isAuthenticated()) {
			# Load Dashboard (main-first screen of your app for logged users)
			$this->app();
		} else {
			# Redirect to login if not authenticated, or to home or landing
			$this->home();
		}
	}

	/**
	 * app 
	 * (Private part entry point, registered users only)
	 * If a registered user logs in, this method will be called. MODIFY THIS FUNCTION.
	 * @return void
	 */
	public function app() // DASHBOARD
	{

		# Sample render of view with $data
		$data = array(
			"SEO_TITLE" => "xyz",
			"SEO_DESCRIPTION" => "xyz",
			"breadcrumb" => array(array("label" => "Inicio", "url" => "#")),
			"user" => $_SESSION['user'],

		);

		# show app/views/index.php passing $data
		$this->view->show('custom/index.php', $data);
	}

	/**
	 * home
	 * Main Public Website
	 * @return void
	 */
	public function home()
	{
		$this->view->show("demo/homepage.php", array());
	}
	public function contact()
	{
		$data = array(
			"SEO_TITLE" => ""
		);
		$this->view->show("custom/contact_sales.php", $data);
	}

	/**
	 * Default User's Profile
	 * profile
	 *
	 * @return void
	 */
	public function profile()
	{
		assert($_SESSION['user']);
		$users = new usersModel();
		$invoices = new invoicesModel();
		$data = array(
			"user" => $users->getById($_SESSION['user']['usersId']),
			"invoices" => $invoices->getByUsersId($_SESSION['user']['usersId']),
			"SEO_TITLE" => "Preferencias",
			"SEO_DESCRIPTION" => "Desde aquí es posible gestionar todos los datos de la cuenta",
			"breadcrumb" => array(array("label" => "Preferencias", "url" => "profile")),
		);

		$this->view->show("user/profile.php", $data, true);
	}

	/**
	 * tos
	 * Default terms of service url
	 * @return void
	 */
	public function tos()
	{
		$this->view->show('common/tos.php', array());
	}

	/**
	 * privacy
	 * Default privacy page
	 * @return void
	 */
	public function privacy()
	{
		$this->view->show('common/privacy.php', array());
	}
	public function pricing()
	{
		$this->view->show('landing/pricing.php', array());
	}
	public function faq()
	{
		$this->view->show('landing/faq.php', array());
	}
	public function use_cases()
	{
		$this->blog();
		//		$this->view->show('common/privacy.php', array());
	}
	public function app_simulator()
	{
		$contacts = new contactsModel();
		$this->view->show('custom/simulator.php', array(
			"SEO_TITLE" => "Simulador",
			"SEO_DESCRIPTION" => "Haz las pruebas que necesites con el simulador. Copia y pega aquí algún correo que te haya enviado un cliente, haz pruebas con distintos tipos de mensajes y observa cómo responde el sistema. ",
			"breadcrumb" => array(
				array("label" => "Simulador", "url" => "app_simulator")
			),
			"contact_category" => $contacts->get_categories()
		));
	}

	public function app_service()
	{
		assert($_SESSION['agent']);
		if ($this->params['m'] == 'emails' and !empty($this->params['a'])) { // app_service/emails/*
			$emails = new emailsModel();
			$ids = json_decode(file_get_contents('php://input'), true)['ids'] ?? null;

			if (is_null($ids)) die("Error: No ids provided");
			assert(in_array($this->params['a'], array("archive", "delete", "mark_as_spam")));
			$agentsId = $_SESSION['agent']['agentsId'];
			foreach ($ids as $id) {
				try {
					if ($emails->{$this->params['a']}($id, $agentsId)) {
						echo json_encode(array("success" => "true", "message" => "Completed successfully"));
					}
				} catch (Exception $e) {
					echo json_encode(array("status" => "error", "message" => "Invalid action"));
				}
			}
		} else { // deberia ser url /app_service/agent

			// Ajax call to modify
			//daily_newsltter, weekly_newslteter, copy (0, cc, bcc), status (0, manual, auto pilot 2)
			$agent = new agentsModel();
			$allowed = array('daily_newsletter', 'weekly_newsletter', 'copy', 'status', 'param', 'value');
			if (!isset($this->params['value'])) $this->params['value'] = 0;
			$r = $agent->update_setting($_SESSION['agent']['agentsId'], $this->params['param'], $this->params['value']);
			//Risky business
			$_SESSION['agent'][$this->params['param']] = $this->params['value'];

			echo json_encode($r);
		}
	}

	public function demo()
	{
		$this->view->show('landing/demo.php', array());
	}
	public function app_conversations()
	{

		$table = "emails"; //$this->params['m'];
		$emails = new emailsModel();
		$agents = new agentsModel();
		$super_agent = $agents->get_all_details($this->agentsId);
		$contacts = new contactsModel();

		if (isset($this->params['m']) and !empty($this->params['m'])) {

			if (isset($this->params['a']) and !empty($this->params['a'])) {
				// DETALLE de conversacion
				$es = $emails->get_conversation($this->params['a']);
				$data = [

					'SEO_TITLE' => $es[0]['subject'],
					'SEO_DESCRIPTION' => 'Historial de todas las conversaciones mantenidas y emails enviados y recibidos',
					'breadcrumb' => array(
						array("label" => "Emails", "url" => "app_conversations")
					),
					'items' => $es,
					'contact' => $contacts->get_by_id($es[0]['contactsId']),
					'table_label' => 'Emails',
					"super_agent" => $super_agent
				];

				$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
				$this->view->show('custom/emails_detail.php', $data);
			} else {

				$data = [

					'SEO_TITLE' => 'Emails - ' . ucfirst($this->params['m']),
					'SEO_DESCRIPTION' => 'Historial de todas las conversaciones mantenidas y emails enviados y recibidos',
					'folder' => $this->params['m'],
					'breadcrumb' => array(
						array("label" => "Emails Emails", "url" => "app_conversations")
					),
					'items' => $emails->get_by_status($this->params['m'], $this->agentsId),

					'table_label' => 'Emails'
				];

				$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
				$this->view->show('custom/emails.php', $data);
			}
		} else {
			$itemsFinal = null;
			$items_head = $emails->getItemsHead($table);

			$itemsFinal = $emails->get_by_status('replied', $this->agentsId);

			$data = [

				'SEO_TITLE' => 'Emails',
				'SEO_DESCRIPTION' => 'Historial de todas las conversaciones mantenidas y emails enviados y recibidos',
				'breadcrumb' => array(
					array("label" => "Emails Recibidos", "url" => "app_conversations")
				),
				'items_head' => $items_head,
				'items' => $itemsFinal,
				'HOOK_JS' => $emails->table_js($table),
				'table' => $table,
				'folder' => 'inbox',
				'table_label' => $emails->getTableAttribute($table, 'table_label')
			];

			$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
			$this->view->show('custom/emails.php', $data);
		}
	}
	public function app_settings()
	{
		$s = new agentsModel();
		$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
		$this->view->show('custom/settings.php', array(
			"SEO_TITLE" => "Configuración de las Respuestas ",
			"SEO_DESCRIPTION" => "Emilia  responderá los emails entrantes en el buzón de correo configurado, siguiendo los ajustes e instrucciones siguientes:",
			"breadcrumb" => array(
				array("label" => "Configuración Respuestas Automáticas", "url" => "app_settings")
			),
			"secretario" => $s->get_by_id($this->agentsId),
		));
	}

	public function app_scenarios()
	{
		assert(isset($_SESSION['agent']['agentsId']));
		$CS = new scenariosModel();
		$table = "scenarios";
		$itemsFinal = null;
		$data = $CS->getOrmDescription();

		if (isset($this->params['m']) and !empty($this->params['m'])) {

			$rid = isset($this->params['m']) ? $this->params['m'] : -1;
			$op = isset($this->params['i']) ? $this->params['i'] : '';

			$data = $CS->generateForm($table, $rid, $op);
			$data['SEO_TITLE'] = "Modificar Escenario";
			$data['SEO_DESCRIPTION'] = 'Un escenario es exitoso si se recolectan todos los datos obligatorios del mismo. En ese caso, se le notificará por correo con un resumen completo de la conversación, en caso contrario, no se le molestará.';
			//	$fields = $data['fields'];
			$data["breadcrumb"] = array(array("label" => "Escenarios", "url" => "app_scenarios"));
			$this->view->show('superadmin/form.php', $data);
		} else {

			$data = [
				'SEO_TITLE' => 'Escenarios',
				'SEO_DESCRIPTION' => "Un escenario es cada una de las situaciones en las que nos podemos encontrar respondiendo tus emails. Aquí puedes definir los distintos escenarios para que podamos saber como responder y qué acciones tomar en cada situación o escenario.",
				"breadcrumb" => array(array("label" => "Escenarios", "url" => "app_scenarios")),
				'items_head' => $CS->getItemsHead(),
				'items' => $CS->get_by_agentsId($this->agentsId),
				'HOOK_JS' => $CS->table_js($table),
				'table' => $table,
				'table_label' => $CS->getTableAttribute($table, 'table_label')
			];

			$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
			$this->view->show('superadmin/table.php', $data);
		}
	}

	public function app_delete_row()
	{
		$params = gett();

		$table = $params['table'];
		$id = $params['rid'];

		$model = $table . 'Model';
		$instance = new $model();

		$instance->deleteRow($table, $id);
		echo '1';
	}

	public function app_agent()
	{

		$table = 'agents';
		$rid = $this->agentsId;
		$op = '';
		$form = new agentsModel();
		$data = $form->generateForm($table, $rid, $op);
		$data['SEO_TITLE'] = "Ajustes Agente";
		$data['SEO_DESCRIPTION'] = "Todo el contexto que necesita Emilio para responder a tus emails. ";
		$data['breadcrumb'] = array(array("label" => $data['SEO_TITLE'], "url" => "app_agent"));
		$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
		$this->view->show('superadmin/form.php', $data);
	}

	public function app_integrations()
	{
		$this->view->show('custom/integrations.php', array(
			'SEO_TITLE' => 'Integraciones',
			'SEO_DESCRIPTION' => "Plantilles d'email per a la teva empresa"
		));
	}

	public function app_faq()
	{
		$items = new Orm();

		$table = "faq"; //$this->params['m'];

		$itemsFinal = null;
		$items_head = $items->getItemsHead($table);
		$fields = $items->getTableAttribute($table, 'fields');

		$itemsFinal = $items->getAll($table);

		$data = [
			'SEO_TITLE' => 'Preguntas y Respuestas',
			'SEO_DESCRIPTION' => "Plantilles d'email per a la teva empresa",
			'items_head' => $items_head,
			'items' => $itemsFinal,
			'HOOK_JS' => $items->table_js($table),
			'table' => $table,
			'table_label' => $items->getTableAttribute($table, 'table_label')
		];

		$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
		$this->view->show('superadmin/table.php', $data);

		//		$this->view->show('custom/scenario.php', array());
	}


	public function app_contacts()
	{
		$CS = new contactsModel();

		$table = "contacts"; //$this->params['m'];

		$itemsFinal = null;


		$data = $CS->getOrmDescription();

		if (isset($this->params['m']) and !empty($this->params['m'])) {

			$rid = isset($this->params['m']) ? $this->params['m'] : -1;
			$op = isset($this->params['i']) ? $this->params['i'] : '';

			$data = $CS->generateForm($table, $rid, $op);
			$data['SEO_TITLE'] = "Modificar Contacto";
			$data['SEO_DESCRIPTION'] = 'Datos del contacto';
			//	$fields = $data['fields'];
			$data["breadcrumb"] = array(array("label" => "Contactos", "url" => "app_contacts"));
			$this->view->show('superadmin/form.php', $data);
		} else {





			$data = [
				'SEO_TITLE' => _("Contactos"),
				'SEO_DESCRIPTION' => "Listado de contactos conocidos",
				"breadcrumb" => array(
					array("label" => "Contactos", "url" => "app_contacts")
				),
				'items_head' => $CS->getItemsHead(),
				'items' => $CS->get_by_agentsId($this->agentsId),
				'HOOK_JS' => $CS->table_js($table),
				'table' => $table,
				'table_label' => $CS->getTableAttribute($table, 'table_label')
			];

			$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
			$this->view->show('superadmin/table.php', $data);
		}
	}

	// public function app_documents()
	// {
	// 	$items = new Orm();

	// 	$table = "documents"; //$this->params['m'];

	// 	$itemsFinal = null;
	// 	$items_head = $items->getItemsHead($table);
	// 	$fields = $items->getTableAttribute($table, 'fields');

	// 	if (isset($this->params['i']) and in_array($this->params['i'], $fields)) {
	// 		$params = ['table' => $table, $this->params['i'] => $this->params['z']];
	// 		$itemsFinal = $items->search($params);
	// 	} else {
	// 		$itemsFinal = $items->getAll($table);
	// 	}
	// 	$data = [
	// 		'SEO_TITLE' => _('Documents'),
	// 		'SEO_DESCRIPTION' => "Plantilles d'email per a la teva empresa",
	// 		'items_head' => $items_head,
	// 		'items' => $itemsFinal,
	// 		'HOOK_JS' => $items->table_js($table),
	// 		'table' => $table,
	// 		'table_label' => $items->getTableAttribute($table, 'table_label')
	// 	];

	// 	$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
	// 	$this->view->show('superadmin/table.php', $data);
	// }
	// public function app_calendar()
	// {
	// 	$items = new Orm();

	// 	$table = "events"; //$this->params['m'];

	// 	$itemsFinal = null;
	// 	$items_head = $items->getItemsHead($table);
	// 	$fields = $items->getTableAttribute($table, 'fields');

	// 	if (isset($this->params['i']) and in_array($this->params['i'], $fields)) {
	// 		$params = ['table' => $table, $this->params['i'] => $this->params['z']];
	// 		$itemsFinal = $items->search($params);
	// 	} else {
	// 		$itemsFinal = $items->getAll($table);
	// 	}
	// 	$data = [
	// 		'SEO_TITLE' => "Calendario",
	// 		'SEO_DESCRIPTION' => "Plantilles d'email per a la teva empresa",
	// 		'items_head' => $items_head,
	// 		'items' => $itemsFinal,
	// 		'HOOK_JS' => $items->table_js($table),
	// 		'table' => $table,
	// 		'table_label' => $items->getTableAttribute($table, 'table_label')
	// 	];

	// 	$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
	// 	$this->view->show('superadmin/table.php', $data);
	// }
	// public function app_products()
	// {
	// 	$items = new Orm();

	// 	$table = "products"; //$this->params['m'];

	// 	$itemsFinal = null;
	// 	$items_head = $items->getItemsHead($table);
	// 	$fields = $items->getTableAttribute($table, 'fields');

	// 	if (isset($this->params['i']) and in_array($this->params['i'], $fields)) {
	// 		$params = ['table' => $table, $this->params['i'] => $this->params['z']];
	// 		$itemsFinal = $items->search($params);
	// 	} else {
	// 		$itemsFinal = $items->getAll($table);
	// 	}
	// 	$data = [

	// 		'items_head' => $items_head,
	// 		'items' => $itemsFinal,
	// 		'HOOK_JS' => $items->table_js($table),
	// 		'table' => $table,
	// 		'table_label' => $items->getTableAttribute($table, 'table_label')
	// 	];

	// 	$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
	// 	$this->view->show('superadmin/table.php', $data);
	// }
	// public function app_employees()
	// {
	// 	$items = new Orm();

	// 	$table = "employees"; //$this->params['m'];

	// 	$itemsFinal = null;
	// 	$items_head = $items->getItemsHead($table);
	// 	$fields = $items->getTableAttribute($table, 'fields');

	// 	if (isset($this->params['i']) and in_array($this->params['i'], $fields)) {
	// 		$params = ['table' => $table, $this->params['i'] => $this->params['z']];
	// 		$itemsFinal = $items->search($params);
	// 	} else {
	// 		$itemsFinal = $items->getAll($table);
	// 	}
	// 	$data = [

	// 		'items_head' => $items_head,
	// 		'items' => $itemsFinal,
	// 		'HOOK_JS' => $items->table_js($table),
	// 		'table' => $table,
	// 		'table_label' => $items->getTableAttribute($table, 'table_label')
	// 	];

	// 	$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
	// 	$this->view->show('superadmin/table.php', $data);
	// }
	// public function app_templates()
	// {
	// 	$items = new Orm();

	// 	$table = "templates"; //$this->params['m'];

	// 	$itemsFinal = null;
	// 	$items_head = $items->getItemsHead($table);
	// 	$fields = $items->getTableAttribute($table, 'fields');
	// 	$itemsFinal = $items->getByCompany($table);
	// 	$data = [

	// 		'SEO_TITLE' => ucfirst($table),
	// 		'SEO_DESCRIPTION' => "Plantilles d'email per a la teva empresa",
	// 		'items_head' => $items_head,
	// 		'items' => $itemsFinal,
	// 		'HOOK_JS' => $items->table_js($table),
	// 		'table' => $table,
	// 		'table_label' => $items->getTableAttribute($table, 'table_label')
	// 	];



	// 	$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
	// 	$this->view->show('superadmin/table.php', $data);
	// }
	public function app_help()
	{
		$this->view->show('custom/help.php', array(
			'SEO_TITLE' => "Ayuda",
			'SEO_DESCRIPTION' => "Plantilles d'email per a la teva empresa"
		));
	}

	public function app_config_inbox()
	{
		assert(isset($_SESSION['agent']['agentsId']));
		$inboxes = new inboxesModel();
		$this->view->show('custom/config_inbox.php', array(
			'SEO_TITLE' => "Conexión E-mail",
			'SEO_DESCRIPTION' => "Configura la conexión de tu buzón de correo para que el Agente pueda leer y responder tus emails. Es recomendable utilizar una cuenta de correo dedicada a la gestión de los emails de tu empresa, para evitar problemas de seguridad y privacidad.",
			"breadcrumb" => array(
				array("label" => "Conexión E-mail", "url" => "app_config_inbox")
			),
			"inbox" => $inboxes->get_by_agentsId($this->agentsId),
			"HOOK_JS" => "Emilio.prevent_losses_of_data($('#mailbox-form'));"
		));
	}

	public function app_preview()
	{
		if (empty($this->params['missatge'])) {

			echo json_encode(array("ok" => false, "msg" => 'Empty!'));
		}

		$s = new agentsModel();
		$agent = $s->get_all_details($this->agentsId);
		$email = array(
			"body" => $this->params['missatge'],
			"emailsId" => 0,
			"from_email" => "jgutierrez.test@gmail.com",
			"subject" => "Hola!",

		);

		$contact = array(
			"contactsId" => 99999,
			"name" => "Juan Gutiérrez",
			"email" => "jgutierrez.test@gmail.com",
			"contacts_category_label" => $this->params['contact'],
			"info" => ""
		);

		// CASO DE EXITO 
		$success_data = null;

		$classify = EmailClassifier::classify_email($email, $agent, $contact);

		if (empty($classify['response']) or $classify['response'] == "spam" or $classify['response'] == "unknown") {
			$email['scenariosId'] = -1;
			$email['status'] = 'unknown';
		} else {
			$email['scenariosId'] = intval($classify['response']);
			$scenarios = new scenariosModel();
			$scenario = $scenarios->get_by_id($email['scenariosId']);
			//	$success_data = EmailData::extract($email, $agent, $scenario);
		}

		$response = EmailWriter::write_response($email, $agent, $contact);
		echo json_encode(array("ok" => true, "escenari" => $classify['response'], "resposta" => $response['response'], "data" => $success_data));
	}

	public function app_change_account()
	{
		// SECURITY
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
	public function app_test_mail_server()
	{
		$type = $_POST['type'] ?? null;

		if ($type === 'smtp') {
			echo $this->testSMTP(
				$_POST['snd_host'] ?? '',
				$_POST['snd_port'] ?? 587,
				$_POST['snd_user'] ?? '',
				$_POST['snd_pass'] ?? '',
				$_POST['snd_secure'] ?? 'tls',
				$_POST['snd_test_to'] ?? ''
			);
		} elseif ($type === 'imap') {
			echo $this->testIMAP(
				$_POST['rcv_host'] ?? '',
				$_POST['rcv_port'] ?? 143,
				$_POST['rcv_user'] ?? '',
				$_POST['rcv_pass'] ?? '',
				$_POST['rcv_proto'] ?? 'imap'
			);
		} else {
			echo "Tipus de test no especificat.";
		}
	}
	// Funció SMTP
	function testSMTP($host, $port, $user, $pass, $secure, $to)
	{
		//require_once 'vendor/autoload.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->Host = $host;
			$mail->SMTPAuth = true;
			$mail->Username = $user;
			$mail->Password = $pass;
			$mail->SMTPSecure = $secure === 'none' ? '' : $secure;
			$mail->Port = (int)$port;

			$mail->setFrom($user, 'Test SMTP');
			$mail->addAddress($to);
			$mail->Subject = 'Test Correos Salientes';
			$mail->Body = 'Muy buenas, la connexión SMTP está correcta.';

			$mail->send();
			return "✅ Todo correcto.";
		} catch (Exception $e) {
			return "❌ Error SMTP: " . $mail->ErrorInfo;
		}
	}

	// Funció IMAP
	function testIMAP($host, $port, $user, $pass, $proto)
	{
		try {
			$imapPath = "{" . $host . ":" . $port . "/" . $proto . "/ssl/novalidate-cert}INBOX";

			// Suprimir warnings con @; evaluaremos el resultado manualmente
			$imap = @imap_open($imapPath, $user, $pass, OP_HALFOPEN);

			// Si imap_open() devolvió false, lanzamos nuestra propia excepción
			if ($imap === false) {
				throw new RuntimeException(imap_last_error());
			}

			imap_close($imap);
			echo '✅ Login correcto';
		} catch (RuntimeException $e) {
			// Credenciales incorrectas u otro problema de autenticación
			echo '❌ Login fallido: ' . $e->getMessage();
		} catch (Throwable $e) {
			// Cualquier otro error inesperado
			echo '🚫 Error inesperado: ' . $e->getMessage();
		}





		// log::system('Testing IMAP connection', 'info');

		// $inbox = @imap_open($mailbox, $user, $pass);
		// if ($inbox) {
		// 	imap_close($inbox);
		// 	return "✅ Todo correcto";
		// } else {
		// 	echo "❌ Error $proto: " . imap_last_error();
		// 	return "❌ Error $proto: " . imap_last_error();
		// }
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


	// Called from demo.php form
	public function demo_apply()
	{
		assert(isset($this->params['email']) and !empty($this->params['email']));
		$validator = new emailValidator();
		$mails = new mailsModel();
		$msg = "";
		foreach ($this->params as $k => $v) {
			$msg .=  $k . " => " . $v . "<br>";
		}
		if (!$validator->isValid($this->params['email'])) {
			$_SESSION['errors'][] = _('Email no valido');
		} else {
			$_SESSION['alerts'][] = _('Solicitud recibida. Revisaremos la información y nos pondremos en contacto por email en 24-48h');
			$params = array(
				"body" => $msg,
				"to" => ADMIN_EMAIL,
				"subject" => "New DEMO Requested"
			);

			$mails->internal($params['subject'], $params['body']);
		}

		header("location: " . $_SERVER['HTTP_REFERER']);
	}
	public function app_set_scenario()
	{
		// emailsID, scenariosID
		$emails = new emailsModel();

		if ($emails->edit(array(
			"emailsId" => $this->params['emailsId'],
			"scenariosId" => $this->params['scenariosId']
		))) {

			$_SESSION['alerts'][] = "Escenario asignado satisfactoriamente";
		} else {
			$_SESSION['errors'][] = "Ha ocurrido un error inesperado";
		}
		$_SESSION['alerts'][] = "Escenario asignado correctamente";
		//header("location: " . $_SERVER['HTTP_REFERER']);
		header("location: " . APP_DOMAIN . "app_conversations/unknown");
	}
	public function app_send_manual_email()
	{
		$emailsId = $this->params['emailsId'];
		assert(isset($emailsId) and !empty($emailsId));
		$emails = new emailsModel();
		$agents = new agentsModel();
		$inboxes = new inboxesModel();
		$users = new usersModel();

		$email = $emails->get_by_id($emailsId);
		assert($email['agentsId'] == $_SESSION['agent']['agentsId']);
		assert($email['status'] == 'out');
		$agent = $agents->get_by_id($email['agentsId']);
		$inbox = $inboxes->get_by_agentsId($agent['agentsId']);
		$counters = new CountersModel('agent', $agent['agentsId']);
		$usersId = $agents->get_users_with_access($agent['agentsId']);
		$owners = array();

		foreach ($usersId as $item) {
			$owners[] = $users->get_by_id($item['usersId']);
		}

		$message_id = EmailSend::send_email($email, $inbox, $agent, $owners);
		$emails->edit(array("emailsId" => $this->params['emailsId'], "agentsId" => $_SESSION['agent']['agentsId'], "status" => "sent", "message_id" => $message_id));
		//echo json_encode(array("success" => true));
		$_SESSION['alerts'][] = "Email enviado correctamente";
		header("location: " . $_SERVER['HTTP_REFERER']);
	}
	public function app_move_email_spam()
	{
		$emails = new emailsModel();
		$emails->edit(array("emailsId" => $this->params['emailsId'], "agentsId" => $_SESSION['agent']['agentsId'], "status" => "send_now"));
		$_SESSION['alerts'][] = "Email movido a spam correctamente";
		header("location: " . APP_DOMAIN . "app_conversations/unknown");
		echo json_encode(array("success" => true));
	}
}
