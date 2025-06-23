<?

include "load.php";

class App {
	
	var $params;
	var $view;
	var $bearer;
	
	public function __construct(){
		$this->params = gett();
        $this->view = new View();
		
		if (!isset($_SESSION['lang'])){
			$_SESSION['lang'] = 'en';
		}
    	
		if ($this->params['m'] != "cloneSession" and $this->params['m'] != "checkout"  and $this->params['m'] != "actionRecoverPassword" and $this->params['m'] != "forgotPassword"  and $this->params['m'] != "actionLogin" and $this->params['m'] != "actionSignup" and $this->params['m'] != "signup" and !$this->isAuthenticated()){
			$this->login();	
			exit();
		}else{
		//	$this->bearer = sha1($_SESSION['user']['customersId'].$_SESSION['user']['usersId'].$_SESSION['user']['email']);
		}

  	}
  
  	public function index(){      
		if ($this->isAuthenticated()){
			$this->dashboard();
		}else{
			$this->login();
		}
	}
	
	public function settings(){
		$this->view->show('app/settings.php',array());
	}

	// public function integrations(){
	// 	$this->view->show('app/integrations.php',array());
	// }

	public function export(){

		

		$counters = new counterModel();
		assert(isset($_GET['a']));
		assert(isset($_SESSION['user']['usersId']));

		$counter = $counters->get($_GET['a']);
		if ($counter['usersId'] == $_SESSION['user']['usersId']){

			$data = $counters->getWithHistory($_GET['a']);
		
			// TO-DO: history to columns
			$filename = $counter['label']."-".Date("Y-m-d").".csv";

			$this->CSV($filename, $data);
		} else {
			die("Not authorized");
		}
	}

	public function CSV($filename = "counterify.csv", $data = array()){

		// Set headers for CSV file download
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');

		// Create a file handle for output stream
		$output = fopen('php://output', 'w');

		
		// Write data rows to output stream
		fputcsv($output, array("YearWeek", "Count"));
		foreach ($data['history'] as $row) {
			$row = array_reverse($row);
			$row = array_values($row);
		    fputcsv($output, $row);
		}

		// Close output stream
		fclose($output);

	}
	
  	
	public function dashboard(){
		
		$users = new usersModel();
				
	
		$data = array(
			"user" => $_SESSION['user'],
			
			"alerts" => array()
			
			
		);
		
		$this->view->show("app.php",$data,true);
		
	}

/*
	  	  public function checkout(){
			$data = Array("params" => $this->params);         		
			$product = $this->params['a'];
			$client = $this->params['i'];
  	  		$data['customer'] = null;
  	  		$data['cart'] = null;
  	  		$data['product'] = null;

			$products = new productsModel();
			$customers = new customersModel();

	  	  	if (isset($_GET['title']) and isset($_GET['amount'])){
	  	  		$data['cart'] = array(array(
		  	  		"name" => $this->params['title'],
		  	  		"amount" => $this->params['amount'],
		  	  		"currency" => "eur",
		  	  		"quantity" => 1
	  	  		));
	
	 	  		$data['payment_type'] = 'free';
		
			}else if(!empty($product) or !empty($client)){    
				
				$data['cart'] = $products->getCart($product);
				$data['customer'] = $customers->getByCustomersId($client);
				$data['product'] = $products->getProduct($product);
	 	  		$data['payment_type'] = 'catalog';
		  
			}else{
				$data['store'] =  $products->getProducts();
				$this->view->show("shop.php", $data,false);
				exit();
			}

	   $this->view->show("checkout.php", $data,false);

   
  	}
*/

		public function signup(){

		  return $this->login();
		// $data = array();
		//  $this->view->show("signup.php",$data,false);
	}
	
	 public function account(){
		 if (empty($_SESSION['user']['stripe_customer_id'])):
		 
		 	$_SESSION['errors'] = "Aún no tienes esta sección habilitada.";
		 	header ("location: ".APP_BASE_URL);
		 
		 else:
	
		 
		 	require_once(CORE_PATH.'vendor/stripe-php-7.77.0/init.php');
		 	\Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
			$stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);					
			
			try{
			// Authenticate your user.
			$session = \Stripe\BillingPortal\Session::create([
			  'customer' => $_SESSION['user']['stripe_customer_id'],
			  'return_url' => APP_BASE_URL
			]);
						header("Location: " . $session->url);
			}catch(Exception $e){
							$_SESSION['errors'] = $e->getMessage();
		 	header ("location: ".APP_BASE_URL);
				
			}
			
			
			// Redirect to the customer portal.

	
		endif;

	}
    
	public function actionRecoverPassword(){
		$email = $this->params['email'];
		$users = new usersModel();
		$users->sendResetPassword($email);		
		header("location: ".APP_BASE_URL."forgotPassword?success=1");
	}
    public function login(){
      
      $data = Array(
	     
	      
      );         

      $this->view->show("login.php", $data,false);
  }
  
    public function forgotPassword(){
      
      $data = Array();         

      $this->view->show("forgot-password.php", $data,false);
  }
  public function actionLogin(){


        if (!isset($_SESSION['login_attemp'])) $_SESSION['login_attemp'] = 1;
        $_SESSION['login_attemp'] = 1;
		
		if ($_SESSION['login_attemp'] > 4){
				$_SESSION['errors'] = "Demasiados intentos.";    
        
        header ("location: ".APP_BASE_URL."login");
		}else{
		// TODO SECURITY
		$users = new usersModel();
		
        $user = $users->getByUserEmail($this->params['email']);

		$pass = sha1($this->params['password'])        	  ;

		if (!empty($user) and $user['password'] == $pass){
			$this->createSession($user);
			header ("location: ".APP_BASE_URL);
			exit();
		}

		$_SESSION['login_attemp']++;
       	$_SESSION['errors'] = "User or password not valid. ¿Forgot password?";    
        
        header ("location: ".APP_BASE_URL."login");
        }


  }
  public function actionSignup(){
	 
  		

  		if (!empty($_POST['huny'])) die();
  		
  	// TODO: Verify valid email
  		if (empty($this->params['email']) ){
  			$_SESSION['errors'] = "Email is required";  	
  			header ("location: ".APP_BASE_URL."signup");		
  			return;
  		}

  		if ($this->params['password'] != $this->params['passwordConfirm']){
  			$_SESSION['errors'] = "Passwords does not match";	
  			header ("location: ".APP_BASE_URL."/signup");		
  			return;
  		}

  		if (empty($this->params['privacy'])){
  			$_SESSION['errors'] = "Tiene que aceptar la política de privacidad";  	
  			header ("location: ".APP_BASE_URL."signup");		
  			return;
  		}
  		$users = new usersModel();
  		
  		if (!empty( $users->getByUserEmail($this->params['email']))){
	  		$_SESSION['errors'] = "The user already exists";
	  		 header ("location: ".APP_BASE_URL."login");
	  		return;
  		}
  		
  		$users = new usersModel();
  		$users->create($this->params);
  		
  		mail("beto.phpninja@gmail.com","New Counterify User", json_encode($this->params));
  		
  		$_SESSION['alerts'] = "Signup successful";
	  	header ("location: ".APP_BASE_URL."login");

  }
  private function createSession($user,$saveLogin = true){
  		$_SESSION['app_phpninja_logged_in'] = 1;
  		$_SESSION['login_attemp'] = 0;
  		$_SESSION['user'] = $user; 
        $_SESSION['HTTP_USER_AGENT'] = sha1($_SERVER['HTTP_USER_AGENT'].$user['email']);	
		$users = new usersModel();
		if ($saveLogin) $users->saveLastLogin($user);
  }
  


  private function isAuthenticated(){
	  	
  	 	if (!empty($_SESSION['user']) and isset($_SESSION['app_phpninja_logged_in'])){
	  	 	return true;
	  	}else{
		  	 //Check bearer
		  	 
		  	 
		  	 
		  	 $headers = apache_request_headers();
			if (isset($headers['Authorization']) && preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
			    $token = $matches[1];
			    // Do something with the token...
			    return true;
			} else {
			    // Handle missing or invalid Authorization header...
			    return false;
			}
	  	 }
  }
  
   public function actionLogout(){

        session_destroy();    	
  		header ("location: ".APP_BASE_URL);
        exit(0);
   }
  	
     
}


$actionName = 'index';
		
if(get_param('m') != -1) $actionName = get_param('m');

if (!isset($_SESSION['errors'])) $_SESSION['errors'] ="";
if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = "";

if (!is_callable(array('App', $actionName))){
	View::error404();
	exit();
}

$App = new App();
$App->$actionName(); 


