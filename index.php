<?
/* 
	Stripe Pad - Micro SaaS boilerplate
	Main Controller
    Copyright (C) 2023 Beto Ayesa

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    This file is part of Stripe Pad.

	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
*/

class StripePad{
	var $params;
	var $view;
    var $isAuthenticated;
    var $version = '0.1';
	
  /*  Admin Login
  ---------------------------------------*/
  public function __construct(){
		$this->params = gett();
        $this->view = new View();
		$this->view->isAuthenticated = $this->isAuthenticated = $this->isAuthenticated();

    	

		// if (isset($this->params['m']) and $this->params['m'] != "cloneSession" and $this->params['m'] != "checkout"  and $this->params['m'] != "actionRecoverPassword" and $this->params['m'] != "forgotPassword"  and $this->params['m'] != "actionLogin" and $this->params['m'] != "actionSignup" and $this->params['m'] != "signup" and !$this->isAuthenticated()){
		// 	//$this->login();	
		// 	//exit();
		// }
	//	print_r($this->params);

  }

  	
  
	public function actionRecoverPassword(){
		$email = $this->params['email'];
		$customers = new customersModel();
		$customers->sendResetPassword($email);
		
		
		
		header("location: /forgotPassword?success=1");
	}

  public function actionLogin(){

  		$users = new usersModel();
        if (!isset($_SESSION['login_attemp'])) $_SESSION['login_attemp'] = 1;
        $_SESSION['login_attemp'] = 1;
		
		if ($_SESSION['login_attemp'] > 4){
				$_SESSION['errors'] = "Demasiados intentos.";    
        
        header ("location: ".APP_DOMAIN."/login");
		}else{
		
		
  		$user = $users->find($this->params['email']);

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

  		if (isset($this->params['passwordConfirm']) and $this->params['password'] != $this->params['passwordConfirm']){
  			$_SESSION['errors'] = "Passwords no coinciden";  	
  			header ("location: ".APP_DOMAIN."/signup");		
  			return;
  		}

  		if (isset($this->params['privacy']) and empty($this->params['privacy'])){
  			$_SESSION['errors'] = "You have to accept privacy policy";  	
  		 	header ("location: ".APP_DOMAIN."/signup");		
  		 	return;
  		}
 
        $user = $users->find($this->params['email']);
        if ($user == null){
  		    $user = $users->create($this->params);
            $users->sendWelcomeEmail($user);
          		
  		
  		    $_SESSION['errors'] = "The password of your account is in your email inbox";
	  	    header ("location: ".APP_DOMAIN."/login");
        } else {
            $_SESSION['errors'] = "El usuario ya existe, intenta loggearte.";
            header ("location: ".APP_DOMAIN."/login");
        }

  }
  private function createSession($user,$saveLogin = true){
  		$_SESSION['app_'.APP_NAME.'_logged_in'] = 1;
  		$_SESSION['login_attemp'] = 0;
  		$_SESSION['user'] = $user; 
        $_SESSION['HTTP_USER_AGENT'] = sha1($_SERVER['HTTP_USER_AGENT'].$user['email']);	
// 		$customers = new customersModel();
// 		if ($saveLogin) $customers->saveLastLogin($user);
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
    //   public function account(){
//       if (empty($_SESSION['user']['stripe_customer_id'])):
         
//          $_SESSION['errors'] = "Aún no tienes esta sección habilitada.";
//          header ("location: ".APP_DOMAIN."/dashboard");
         
//       else:
    
         
//          require_once(CORE_PATH.'vendor/stripe-php-7.77.0/init.php');
//          \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
//          $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);                   
            
//          try{
//          // Authenticate your user.
//          $session = \Stripe\BillingPortal\Session::create([
//            'customer' => $_SESSION['user']['stripe_customer_id'],
//            'return_url' => 'https://app.phpninja.net/dashboard',
//          ]);
//                      header("Location: " . $session->url);
//          }catch(Exception $e){
//                          $_SESSION['errors'] = $e->getMessage();
//          header ("location: ".APP_DOMAIN."/dashboard");
                
//          }
            
            
//          // Redirect to the customer portal.

    
//      endif;

//  }
  

   
}


# START UP

require_once dirname(__FILE__).'/load.php'; //Archivo con configuraciones.
include dirname(__FILE__)."/app/app.php";

// Initialize session variables if not already set
if (!isset($_SESSION['errors'])) $_SESSION['errors'] = "";
if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = "";

// Sanitize 'm' parameter to prevent injection
$actionName = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_STRING);
if (!$actionName) {
    $actionName = 'index'; // Default action
}

if (!is_callable(array('App', $actionName))){
	View::error404();
}



$App = new App();
$App->$actionName(); 


