<?
/**
 * Package Name: Stripe Pad API
 * File Description: This file handles a basic API with authentication
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 *
 */

# CORS

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, X-API-KEY, Origin, Authorization, X-Requested-With, Content-Type, Content-Length, Accept-Encoding, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
	http_response_code(200);	
    die();
}

# Include Stripe Pad Environment
include "../app/load.php";


class Api {
	
	var $params;
	var $view;
	var $bearer;	
	var $data;

	public function __construct(){
		       
		if (!$this->isAuthenticated()){
			header("HTTP/1.1 401 Unauthorized");
			die("401 Not authorized");
			exit();
		}
		$this->params = $_GET;

		if (count($_POST)){
			$this->data = $_POST;
		}else{
			$this->data = json_decode(file_get_contents('php://input'),true);	
		}
		

  	}
  	
  	# /api/

  	public function index(){      
	
  		$model = new sampleModel();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			$this->counter();

		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			
			$this->group();
			
		} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			http_response_code(404);
		
		} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			http_response_code(404);
			//$data = $datatracker->updateLabel($_SESSION['user']['usersId'],$data['id'], $data['kpi']);

						
		}

		// Output in json
		echo json_encode($data);		
		
	}
	
	# /api/sample endpoint

  	public function sample(){      
	
  		$model = new sampleModel();

  		# Request Method

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			$model->counter();

		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			
			$model->group();
			
		} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			http_response_code(404);
		
		} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			http_response_code(404);
						
		}

		// // Output in json
		// echo json_encode($data);		
		
	}
	
	private function isAuthenticated(){

		$token = null;
		$users = new usersModel();		    
	  	$headers = apache_request_headers();

	  	# Authentication via toke bearer

		if (isset($headers['Authorization']) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
		    $token = $matches[1]; 
		} else if (isset($_POST['bearer']) and !empty($_POST['bearer'])) {
		    $token = $_POST['bearer'];
		}

		if (is_null($token)) return false;

		$user = $users->getByBearer($token);
		
		if (!empty($user)){			
			$this->bearer = $token;
			$_SESSION['user'] = $user;			
			return true;
		} else {
			return false;
		}
	}

     
}

# Default Method
$actionName = 'index';

if($_GET['m'] != -1) $actionName = $_GET['m'];

if (!is_callable(array('Api', $actionName))){
	header('HTTP/1.0 404 Not Found');
	die("404 Not Found");	
	exit();
}

# Response will be in JSON
header('Content-type: application/json');

$App = new Api();
$App->$actionName(); 


