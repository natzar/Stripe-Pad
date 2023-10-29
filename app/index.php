<?
/**
 * Package Name: Stripe Pad
 * File Description: Main Controller for custom app
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 */

# Load Environment
require_once dirname(__FILE__).'/../load.php'; 
	


# Each method of this class can be accessed from //your-domain/app/{method}?params=params

class App {
	var $params;
	var $view;
	
  /*  Admin Login
  ---------------------------------------*/
  	public function __construct(){
		$this->params = $_GET; // TO_DO: SECURITY, SANITIZE
        $this->view = new View();
		$this->view->isAuthenticated = $this->isAuthenticated();
    	
		// if (isset($this->params['m']) and $this->params['m'] != "cloneSession" and $this->params['m'] != "checkout"  and $this->params['m'] != "actionRecoverPassword" and $this->params['m'] != "forgotPassword"  and $this->params['m'] != "actionLogin" and $this->params['m'] != "actionSignup" and $this->params['m'] != "signup" and !$this->isAuthenticated()){
		// 	//$this->login();	
		// 	//exit();
		// }
		//	print_r($this->params);
  	}

  	#Default app home page
  	public function index(){      

  		# check if user is authenticated
		if ($this->isAuthenticated()){			
			# Load Dashboard (main-first screen of your app for logged users)
			$this->dashboard();
		}else{
			# Redirect to login if not authenticated
			$this->login();
		}
  	}
  	
  	# SAMPLE - Custom endpoint to send feedback by email
  	public function feedback(){
  		$msg = $_GET['msg'];
  		mail(ADMIN_EMAIL,"Feedback from ".APP_NAME,$msg);
  	}

  public function expiredDomains(){
  	$this->view->show('expired-domains.php',array());
  }
  public function main(){

  		// $stats = new statsModel();

  		// $totals = array("total"=>$stats->totalDomains(), "queue"=> $stats->totalQueue());

  	

		$this->view->show("app.php", array());
  }
  
  
	
	public function dashboard(){
		$data = array();		
		$this->view->show("dashboard.php",$data,true);		
	}

	public function sample(){
		$data = Array();         			
		$this->view->show("help.php", $data,true);
	}
	public function actionSample(){

	}
	public function signup(){
		$data = array();
		$this->view->show("signup.php",$data,true);
	}
	
	public function stripePortal(){
		 if (empty($_SESSION['user']['stripe_customer_id'])):
		 
		 	$_SESSION['errors'] = "Aún no tienes esta sección habilitada.";
		 	header ("location: ".APP_DOMAIN."/dashboard");
		 
		 else:
	
		 
		 	require_once(CORE_PATH.'vendor/stripe-php-7.77.0/init.php');
		 	\Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
			$stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);					
			
			try{
			// Authenticate your user.
			$session = \Stripe\BillingPortal\Session::create([
			  'customer' => $_SESSION['user']['stripe_customer_id'],
			  'return_url' => 'https://app.phpninja.net/dashboard',
			]);
						header("Location: " . $session->url);
			}catch(Exception $e){
							$_SESSION['errors'] = $e->getMessage();
		 	header ("location: ".APP_DOMAIN."/dashboard");
				
			}
			
			
			// Redirect to the customer portal.

	
		endif;

	}
  

	public function actionRecoverPassword(){
		$email = $this->params['email'];
		$customers = new customersModel();
		$customers->sendResetPassword($email);		
		header("location: /forgotPassword?success=1");
	}


	public function login(){      
		$data = Array();         

		# Login function

		# Login with Google
		// $client = new Google_Client();
		// $client->setClientId('YOUR_CLIENT_ID');
		// $client->setClientSecret('YOUR_CLIENT_SECRET');
		// $client->setRedirectUri('YOUR_REDIRECT_URI');
		// $client->addScope("email");
		// $client->addScope("profile");

		// $authUrl = $client->createAuthUrl();
		// echo "<a href='$authUrl'>Login with Google</a>";

   		$this->view->show("user/login.php", $data,true);
	}
  
    public function forgotPassword(){      
		$data = Array();         
		$this->view->show("forgot-password.php", $data,false);
  	}
  
  	public function actionLogin(){

  		$users = new usersModel();

        if (!isset($_SESSION['login_attemp'])) $_SESSION['login_attemp'] = 1;
        $_SESSION['login_attemp'] = 1;
		
		if ($_SESSION['login_attemp'] > 4){
				$_SESSION['errors'] = "Demasiados intentos.";    
        
        header ("location: ".APP_DOMAIN."/login");
		}else{
		
		
  		$user = $users->getByUserEmail($this->params['email']);

		$pass = sha1($this->params['password'])        	  ;

		if (!empty($user) and $user['password'] == $pass){
			$this->createSession($user);
			header ("location: ".APP_DOMAIN);
			exit();
		}

		$_SESSION['login_attemp']++;
       	$_SESSION['errors'] = "Usuario o Password incorrecto";    
        
        header ("location: ".APP_DOMAIN."/login");
        }
	}
  	
  	public function actionSignup(){
	 
  		$users = new usersModel();

  		if (!empty($_POST['huny'])) die();
  		
  		// TODO: Verify valid email
  		if (empty($this->params['email']) ){
  			$_SESSION['errors'] = "Email no puede estar en blanco";  	
  			header ("location: ".APP_DOMAIN."/signup");		
  			return;
  		}

/*
  		if ($this->params['password'] != $this->params['passwordConfirm']){
  			$_SESSION['errors'] = "Passwords no coinciden";  	
  			header ("location: ".APP_DOMAIN."/signup");		
  			return;
  		}
*/

  		// if (empty($this->params['privacy'])){
  		// 	$_SESSION['errors'] = "Tiene que aceptar la política de privacidad";  	
  		// 	header ("location: ".APP_DOMAIN."/signup");		
  		// 	return;
  		// }
  		/*
f (!empty( $customers->getCustomerByEmail($this->params['email']))){
	  		$_SESSION['errors'] = "El usuario ya existe, intenta loggearte.";
	  		 header ("location: ".APP_DOMAIN."/login");
	  		return;
  		}
*/

  		$users->selfServiceCreateCustomer($this->params);
  		
  		
  		$_SESSION['errors'] = "An email with login credentials have been sent, please follow instructions.";
	  	header ("location: ".APP_DOMAIN."/login");

  	}
	
	private function createSession($user,$saveLogin = true){
			$_SESSION['app_'.APP_NAME.'_logged_in'] = 1;
			$_SESSION['login_attemp'] = 0;
			$_SESSION['user'] = $user; 
	    $_SESSION['token'] = sha1($_SERVER['HTTP_USER_AGENT'].$user['email']);	

		if ($saveLogin) $users->saveLastLogin($user);
	}
  

  	public function GoogleLoginCallback(){
	  	if (isset($_GET['code'])) {
	    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	    $_SESSION['access_token'] = $token;

	    // Get user info
	    $google_service = new Google_Service_Oauth2($client);
	    $data = $google_service->userinfo->get();

	    // Now you have $data which contains user info. You can save this info in your database.
	    // For demonstration purposes, we're just printing it.
	    echo '<pre>';
	    print_r($data);
	    echo '</pre>';
		}
  	}

  	private function isAuthenticated(){
	  	
  	 	return !empty($_SESSION['user']) and isset($_SESSION['app_'.APP_NAME.'_logged_in']);
  }
  
   public function actionLogout(){

        session_destroy();    	
        
  		header ("location: ".APP_DOMAIN);
        exit(0);
   }
   
}

# Router

$actionName = 'index';
		
if(isset($_GET['m']) and !empty($_GET['m'] )) $actionName = $_GET['m'];

if (!isset($_SESSION['errors'])) $_SESSION['errors'] ="";
if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = "";

if (!is_callable(array('App', $actionName))){
	//View::error404();
}



$App = new App();
$App->$actionName(); 


