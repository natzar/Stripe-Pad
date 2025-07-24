<?php
/*
*
*		Counterify API
*	
*
*
*
*
*
*/
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, X-API-KEY, Origin, Authorization, X-Requested-With, Content-Type, Content-Length, Accept-Encoding, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
	http_response_code(200);

	die();
}

include dirname(__FILE__) . "/../../core/sp-load.php";

header('Content-type: application/json');

class Api
{

	var $params;
	var $view;
	var $bearer;
	var $data;
	var $agent;
	public function __construct()
	{

		if (!$this->isAuthenticated()) {
			header("HTTP/1.1 401 Unauthorized");
			die("401 Not authorized");
			exit();
		}
		$this->data = array();
		if (count($_GET)) {
			$this->data = array_merge($this->data, $_GET);
		}
		if (count($_POST)) {
			$this->data = array_merge($this->data, $_POST);
		}
		if ($aux = file_get_contents('php://input')) {
			if (!is_null($aux) && !empty($aux) && is_string($aux)) {
				$aux = json_decode($aux, true);
				if (is_array($aux)) {
					$this->data = array_merge($this->data, $aux);
				}
			}
		}
	}

	public function index()
	{

		//echo json_encode(array("index" => true));

		echo 'xindex';
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			http_response_code(404);
		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			http_response_code(404);
		} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			http_response_code(404);
		} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			http_response_code(404);
			//$data = $datatracker->updateLabel($_SESSION['user']['usersId'],$data['id'], $data['kpi']);


		}

		// // Output in json
		// echo json_encode($data);		

	}
	public function contact()
	{
		echo 'xcontact';
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$contacts = new contactsModel();
			$this->data['agentsId'] = $this->agent['agentsId'];

			$output = $contacts->add($this->data);
			echo json_encode($output);
		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			http_response_code(404);
		}
	}
	public function email()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$emails = new emailsModel();
			$this->data['agentsId'] = $this->agent['agentsId'];
			$contacts = new contactsModel();
			$contact = $contacts->get_by_email($this->data['from_email'], $this->agent['agentsId']);
			$this->data['contactsId'] = $contact['contactsId'];
			$this->data['status'] = 'new';
			$this->data['folder'] = 'inbox';
			$this->data['scenariosId'] = null;
			$this->data['message_id'] = 0;
			$output = $emails->add($this->data);
			echo json_encode($output);
		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			http_response_code(404);
		}
	}

	private function isAuthenticated()
	{

		$token = null;
		$agents = new agentsModel();
		$headers = apache_request_headers();

		if (isset($headers['Authorization']) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
			$token = $matches[1];
		} else if (isset($_POST['bearer']) and !empty($_POST['bearer'])) {
			$token = $_POST['bearer'];
		} else if (isset($_GET['bearer']) and !empty($_GET['bearer'])) {
			$token = $_GET['bearer'];
		}

		if (is_null($token)) return false;

		$agent = $agents->get_by_bearer($token);

		if (!empty($agent)) {
			$this->agent = $agent;
			$this->bearer = $token;
			//$_SESSION['user'] = $user;
			return true;
		} else {
			return false;
		}
	}
}


$actionName = 'index';
$params = get_parameters();

if ($params['m'] != -1) $actionName = $params['m'];

//if (!isset($_SESSION['errors'])) $_SESSION['errors'] = "";
//if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = "";

$App = new Api();
if (!is_callable(array($App, $actionName))) {
	echo 'not';
	header('HTTP/1.0 404 Not Found');
	die("404 Not Found");

	exit();
}


$App->$actionName();
