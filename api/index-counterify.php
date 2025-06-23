<?
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
if($method == "OPTIONS") {
	http_response_code(200);
	
    die();
}

include "../app/load.php";

header('Content-type: application/json');

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
		
        # Default
        $this->params = $_GET;       
        
        if (count($_POST)){
			$this->data = json_decode(json_encode($_POST));
		}else{
			$this->data = json_decode(file_get_contents('php://input'),true);	
		}
		
  	}

    /* PUBLIC ONLY GET apikey = label = value */ 

    public function count(){

        if ($_SERVER['REQUEST_METHOD'] === 'GET' or $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->params = $_GET;
            $counter = new counterModel();

            if (!isset($this->params['apikey']) and !isset($this->params['label']) and !isset($this->params['value'])){
                die("Wrong number of parameters");
            }else{
                
                // find counter by label
                $counterId = $counter->findIdByLabel($this->params['label']);

                // If not exists create it
                if ($counterId < 0){                            
                    $counterId = $counter->create($this->params['label'])['countersId'];
                }           

                $output = $counter->fastcount($counterId, $this->params['value']);  
                http_response_code(200);
                echo json_encode(array("error" => false, "msg" => "Success adding ".$this->params['value']." to ".$this->params['label']));

            }

        }else{
            die("This will be reported ".$_SERVER['REMOTE_ADDR']);            
        }
    }
  
  	public function index(){      
	
  		//echo json_encode(array("index" => true));


		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			$this->counter();

		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			if (!empty($this->data['label'])){
                $this->counter();
            }else{
			 $this->group();
            }
			
		} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			http_response_code(404);
		
		} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			http_response_code(404);
			//$data = $datatracker->updateLabel($_SESSION['user']['usersId'],$data['id'], $data['kpi']);

						
		}

		// // Output in json
		// echo json_encode($data);		
		
	}
	public function group(){
		//TO-DO group/id/period

		$group = new groupModel();	
		$output = "";

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$output = $group->create($_SESSION['user']['usersId'], $this->data['label']);

		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->params['id'] = intval($this->params['id']);
			
			if (intval($this->params['id']) > -1 and !empty($this->params['period'])){
				// if period				
				$output = $group->get($this->params['id'],$this->params['period']);
			}else{
				$output = $group->all();
			}
			
		} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			
			$output = $group->delete($this->params['id']);			
		
		} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			
			$output = $group->update($this->params['id'], $this->data['label']);	
						
		}
		
		echo json_encode($output);

	}
	public function counter(){
		//$datatracker = new datatrackerModel();
		$counter = new counterModel();
		$output = array();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$counterId = null;

			if (empty($this->params['id'])){

				// find counter by label
				$counterId = $counter->findIdByLabel($this->data['label']);

				// If not exists create it
				if ($counterId < 0){							

					// Set Default group
					if (!isset($this->data['group'])) {
						$this->data['group'] = 0;
					}
					$counterId = $counter->create($this->data['label'], $this->data['group'])['countersId'];
				}			

			}else{
				$counterId = $this->params['id'];
			}
						

			$output = $counter->count($counterId, $this->data['count']);	

		} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {			

			if (empty($this->params['id'])){
				$output = $counter->all();			
			}else {
				$output = $counter->getWithHistory($this->params['id']);			
			}
			
			
		} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			
			$output = $counter->delete($this->params['id']);			
		
		} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			
			
			$output = $counter->update($this->params['id'], $this->data['label'], $this->data['groupsId'], $this->data['count']);
			//$data = $datatracker->updateLabel($_SESSION['user']['usersId'],$data['id'], $data['kpi']);

						
		}

		echo json_encode($output);
	}

	public function users(){

		$users = new usersModel();
		$data = $users->getChildren($_SESSION['user']['usersId']);

		echo json_encode($data);


	}
	
	private function isAuthenticated(){

		$token = null;
		$users = new usersModel();		    
	  	$headers = apache_request_headers();

		if (isset($headers['Authorization']) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
		    $token = $matches[1]; 
		} else if (isset($_POST['bearer']) and !empty($_POST['bearer'])) {
		    $token = $_POST['bearer'];
		} else if (isset($_GET['apikey']) and !empty($_GET['apikey'])){
            $token = $_GET['apikey'];
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


$actionName = 'index';
		
if(get_param('m') != -1) $actionName = get_param('m');

if (!isset($_SESSION['errors'])) $_SESSION['errors'] ="";
if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = "";

if (!is_callable(array('Api', $actionName))){
	header('HTTP/1.0 404 Not Found');
	die("404 Not Found");
	
	exit();
}

$App = new Api();
$App->$actionName(); 


