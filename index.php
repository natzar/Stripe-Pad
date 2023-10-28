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
require_once dirname(__FILE__).'/load.php'; //Archivo con configuraciones.
	



class App {
	var $params;
	var $view;
	
  /*  Admin Login
  ---------------------------------------*/
  public function __construct(){
		$this->params = gett();
        $this->view = new View();
		$this->view->isAuthenticated = $this->isAuthenticated();
    	
		// if (isset($this->params['m']) and $this->params['m'] != "cloneSession" and $this->params['m'] != "checkout"  and $this->params['m'] != "actionRecoverPassword" and $this->params['m'] != "forgotPassword"  and $this->params['m'] != "actionLogin" and $this->params['m'] != "actionSignup" and $this->params['m'] != "signup" and !$this->isAuthenticated()){
		// 	//$this->login();	
		// 	//exit();
		// }
	//	print_r($this->params);

  }
  public function index(){      
		if ($this->isAuthenticated()){
		//	$this->dashboard();
			echo 'authentic';
		}else{
			
			$this->main();
		}
  }
  public function feedback(){
  	$msg = $_GET['msg']; //print_r($_GET);
  	mail("beto.phpninja@gmail.com","mail feedback chatleads",$msg);
  }

  public function expiredDomains(){
  	$this->view->show('expired-domains.php',array());
  }
  public function main(){

  		// $stats = new statsModel();

  		// $totals = array("total"=>$stats->totalDomains(), "queue"=> $stats->totalQueue());

  	

		$this->view->show("app.php", array());
  }
  
  public function tag(){
  	if (!isset($this->params['a']) or empty($this->params['a'])) return $this->main();
  	$title = ucfirst(str_replace("-"," ",$this->params['a']));

  	$currentQuery = str_replace("Websites using","",$title);
  	$currentQuery = str_replace("domains","",$currentQuery);
  	$data = array(
  		"tag" => $this->params['a'],
  		"tag_human" => $title,
  		"currentQuery" => $currentQuery,
  		"hookBeforeApp" => '<h1 class="text-white font-bold">'.$title.'</h1><p>Find all domains matching "'.$title.'" in title, description, technologies or domain name </p>',
  		"SEO_TITLE" => $title,
  		"SEO_DESCRIPTION" => "Lorem ipsum sit dolor amet"
  	);
  	$this->view->show("app.php", $data);
  }
  // public function comment(){
	 //  $comments = new commentsModel();
	  
	 //  $comments->push('tickets',$this->params['objectid'],$this->params['comment']);
	  
	 //  header("location: ".$this->params['return_url']);
  // }

	
/*
  
  public function store(){
		
		$data = Array(

			"store" => $this->db->getProducts()
		);         	
		
		$this->view->show("store.php", $data);
	
	}
*/
// 	 public function quickview(){
// 	  $data = Array();         	
//     	$this->view->show("audit.php", $data,true);
//   }

// 	public function projects(){
// 		//$this->webs();
// 		$this->view->show("projects.php", array("customer" => $_SESSION['user']),true);
// 	}
	
	public function dashboard(){
		
		$data = array();
		
		$this->view->show("dashboard.php",$data,true);
		
	}

// 	public function ticket(){
		
// 		$webs = new websModel();

// 			$data = Array(
// 				"webs" => 		$webs->getByCustomersId($_SESSION['user']['customersId'])
				
// 		); 
// 		$this->view->show("ticket.php", $data,true);  

// 	}
// 	public function team(){
// 			$data = Array(
// 		); 
// 		$this->view->show("users.php", $data,true);  

// 	}
// 	public function webs(){
// 		$webs = new websModel();
// 		$products = new productsModel();
// 			$data = Array(
// 			"webs" => $webs->getByCustomersId($_SESSION['user']['customersId']),
//  			"store" => $products->getProducts()
// 		); 
// 		$this->view->show("webs.php", $data,true);  
// 	}
	
// /*
// 	  public function checkout_old(){
		
      
//     $data = Array("params" => $this->params);         

// 	$product = $this->params['a'];
// 	$client = $this->params['i'];
			
// 	if (!empty($product) and !empty($client)){
// 	$data['cart'] = $this->db->getCart($product);
// 	$data['customer'] = $this->db->getCustomer($client);
// 	$data['product'] = $this->db->getProduct($product);
// 	   $this->view->show("checkout.php", $data,false);
	  
// 	  }else{
// 	  	$aux = $this->db->getProducts();
// 	  	$ps = array();
// 	  	foreach($aux as $a):
// 	  		$ps[$a['category']][] = $a;	  	
// 	  	endforeach;
	  	
//  		$data['store'] = $ps;
//   $this->view->show("shop.php", $data,true);
// 	  ;
// 	  }


   
//   	}
// */
//   	  public function checkout(){
// 			$data = Array("params" => $this->params);         		
// 			$product = $this->params['a'];
// 			$client = $this->params['i'];
//   	  		$data['customer'] = null;
//   	  		$data['cart'] = null;
//   	  		$data['product'] = null;

// 			$products = new productsModel();
// 			$customers = new customersModel();

// 	  	  	if (isset($_GET['title']) and isset($_GET['amount'])){
// 	  	  		$data['cart'] = array(array(
// 		  	  		"name" => $this->params['title'],
// 		  	  		"amount" => $this->params['amount'],
// 		  	  		"currency" => "eur",
// 		  	  		"quantity" => 1
// 	  	  		));
	
// 	 	  		$data['payment_type'] = 'free';
		
// 			}else if(!empty($product) or !empty($client)){    
				
// 				$data['cart'] = $products->getCart($product);
// 				$data['customer'] = $customers->getByCustomersId($client);
// 				$data['product'] = $products->getProduct($product);
// 	 	  		$data['payment_type'] = 'catalog';
		  
// 			}else{
// 				$data['store'] =  $products->getProducts();
// 				$this->view->show("shop.php", $data,false);
// 				exit();
// 			}

// 	   $this->view->show("checkout.php", $data,false);

   
//   	}

// 	public function development(){
// 		$tickets = new ticketsModel();
// 		$customers = new customersModel();
		
// 		$data = Array(
// 			"jobs" => $tickets->getByCustomersId($_SESSION['user']['customersId']),
// 			"horas" =>$customers->getHoras($_SESSION['user']) 

// 		);         	
		
// 		$this->view->show("development.php", $data,true);
// 	}

// 	public function help(){
// 		$data = Array(
// 		);         	
		
// 		$this->view->show("help.php", $data,true);
// 	}

	
//     public function actionAddTicket(){


// 	     $tickets = new ticketsModel();	    	     
	     
// 	     $this->params['ticketsstatusId'] = 1;
// 	     $this->params['usersId'] = 1;
// 	     $this->params['customersId'] = $_SESSION['user']['customersId'];
// 	     $this->params['estado_actual'] = "";
// 	     $this->params['developersId'] = 1000;

// 	     $ticket = $tickets->create($this->params);
// 	    $filename = time() . ".webm";
	    
// 		if (isset($_FILES['PhpNinjaVideoWidget-file'])) {
		     
// 			$path = CORE_PATH."../app/uploads/recordings/";   
			
// 			if (move_uploaded_file($_FILES['PhpNinjaVideoWidget-file']['tmp_name'],$path.$filename)){
// 				$tickets->saveRecording(array("filename" => $filename, "ticketsId" => $ticket['ticketsId']));
// 				$file = 'https://app.phpninja.net/uploads/recordings/'.$filename;
// 				$this->params['description'] = '<video src="'.$file.'"></video>';
// 			} 
// 		 }
	     
// 	     $comments = new commentsModel();
// 	     $comments->push('tickets',$ticket['ticketsId'],$this->params['description'],0,0);

// 	     header ("location: ".APP_DOMAIN."/development");
//      }
     
      
// 	public function addWeb(){
// 		$data = Array(
// 		);         	
		
// 		$this->view->show("web-settings.php", $data,true);
// 	}
// 	public function editWeb(){
// 		$webId = $this->params['a'];
// 		$credentials = new credentialsModel();
		
// 		$aux = $credentials->getByWebsId($webId);
		
// 		$passw = array(
// 			"ftp"=> array("url"=> "","user" => "","pass" => ""),
// 			"hosting"=> array("url"=> "","user" => "","pass" => ""),
// 			"admin"=> array("url"=> "","user" => "","pass" => "")
			
			
// 			);
// 		foreach($aux as $c):
// 			switch($c['credentialstypeId']):
// 				case 1: // ftp
// 					$passw['ftp'] = array("url" => $c['url'], "user" => $c['user'], "pass" => $c['pass']);
// 				break;
// 				case 2:
// 					$passw['hosting'] = array("url" => $c['url'], "user" => $c['user'], "pass" => $c['pass']);				
// 				break;
// 				case 9: // admin
// 					$passw['admin'] = array("url" => $c['url'], "user" => $c['user'], "pass" => $c['pass']);
// 				break;
// 			endswitch;
// 		endforeach;
		
		
// 		$webs = new websModel();
		
// 		$data = array(
// 			"web" => $webs->getByWebsId($webId),
// 			"credentials" => $passw


// 		);
		
// 		if (empty($data['web'])) $_SESSION['errors'] = "No tienes permisos";

// 		$this->view->show("web-settings.php", $data,true);
// 	}


// 	public function job(){
// 		$ticketsId = $this->params['a'];
// 		$tickets = new ticketsModel();
// 		$users = new usersModel();
// 		$comments = new commentsModel();
		
// 		$ticket = $tickets->getByTicketsId($ticketsId);
// 		$data = array(
// 			"job" => $ticket,
// 			"comments" => $comments->getComments('tickets',$ticketsId),
// 			"developer" => $users->getByUsersId($ticket['developersId']),
// 			"author" => $users->getByUsersId($ticket['usersId'])
			
// 		);
		
// 		if (empty($data['job'])) $_SESSION['errors'] = "No tienes permisos";
// 		$this->view->show("job.php",$data);
// 	}
	
// 	public function web(){
		
// 		$webs = new websModel();
// 		$logs = new logsModel();		
// 		$audits = new auditsModel();
// 		$suggestions = new suggestionsModel();

// 		$webId = $this->params['a'];
		
// 		$tops = array("top1" => 0, "top3" => 0, "top10" => 0);
// 		$ranktracker = $webs->getRanktracker($webId);
		

//         foreach($ranktracker as $k => $rt): 
//               if(intval( $rt[0]) == 1) $tops['top1']++;
//               if(intval($rt[0])  > 1 and intval($rt[0]) < 4) $tops['top3']++;
//               if(intval($rt[0])  > 3 and intval($rt[0]) < 11) $tops['top10']++;
// 		endforeach;              
              
// 		$data = array(
// 			"web" => $webs->getWeb($webId),
// 			"analytics" => $webs->getAnalytics($webId),
// 			"audit" => $audits->getLastAudit($webId),			
// 			"ranktracker" => $ranktracker,			
// 			"tops" => $tops,
// 			"errors" => $logs->getAllErrors($webId),
// 			"suggestions" => $suggestions->getAllSuggestions($webId),
// 			"changelog" => $logs->getChangelog($webId),			
// 		);
		
		

		
// 		if (empty($data['web'])) $_SESSION['errors'] = "No tienes permisos";
// 		$this->view->show("web.php",$data);
// 		//echo json_encode($data);
// 	}
	public function signup(){
		$data = array(
			
		);
		$this->view->show("signup.php",$data,true);
	}
	
// 	 public function account(){
// 		 if (empty($_SESSION['user']['stripe_customer_id'])):
		 
// 		 	$_SESSION['errors'] = "Aún no tienes esta sección habilitada.";
// 		 	header ("location: ".APP_DOMAIN."/dashboard");
		 
// 		 else:
	
		 
// 		 	require_once(CORE_PATH.'vendor/stripe-php-7.77.0/init.php');
// 		 	\Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
// 			$stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);					
			
// 			try{
// 			// Authenticate your user.
// 			$session = \Stripe\BillingPortal\Session::create([
// 			  'customer' => $_SESSION['user']['stripe_customer_id'],
// 			  'return_url' => 'https://app.phpninja.net/dashboard',
// 			]);
// 						header("Location: " . $session->url);
// 			}catch(Exception $e){
// 							$_SESSION['errors'] = $e->getMessage();
// 		 	header ("location: ".APP_DOMAIN."/dashboard");
				
// 			}
			
			
// 			// Redirect to the customer portal.

	
// 		endif;

// 	}
  
// 	public function addMsg(){
// 	  $comments = new commentsModel();
// 	  $comments->push('customers',$this->params['customersId'],$this->params['body'],0,true);
// 	  header ("location: ".APP_DOMAIN."/dashboard");
// 	}
  
	public function actionRecoverPassword(){
		$email = $this->params['email'];
		$customers = new customersModel();
		$customers->sendResetPassword($email);
		
		
		
		header("location: /forgotPassword?success=1");
	}
//     public function actionAddWeb(){
// 	    $webs = new websModel();
// 		$credentials = new credentialsModel();
// 	      $web = $webs->addWeb($this->params);
// 	      if (!empty($web)){
// 	      foreach($this->params['credentials'] as $c){
// 		      if ($c['user'] != "")
// 		      $credentials->addCredentials($web['websId'],$c);		      
// 	      }
// 	      mail("equipo@phpninja.es","Nuevos credenciales añadidos para ".$web['url'],"Pues eso");
// 		  }


// 	      header ("location: ".APP_DOMAIN."/webs");
//       } 
//        public function actionUpdateWeb(){
// 	    $webs = new websModel();
// 	      $websId = $this->params['websId'];
// 	      $web = $webs->updateWeb($this->params);
// 	      $credentials = new credentialsModel();
// 	      $credentials->update($this->params['websId'], 2, $this->params['credentials'][0]);
// 	      $credentials->update($this->params['websId'], 1, $this->params['credentials'][1]);	      
// 	      $credentials->update($this->params['websId'], 9, $this->params['credentials'][2]);	      	      
//     	    //  mail("equipo@phpninja.es","Nuevos credenciales añadidos para ".$web['url'],"Pues eso");

// 	      header ("location: ".APP_DOMAIN."/editWeb/".$websId);
//       }      
      
      
      
//   public function actionUpdateUser(){
// 	      $customers = new customersModel();
// 	      $user = $customers->selfServiceUpdateCustomer($this->params);


// 	      header ("location: ".APP_DOMAIN."");
//       }      

  public function login(){
      
      $data = Array(
	     
	      
      );         

      

// $client = new Google_Client();
// $client->setClientId('YOUR_CLIENT_ID');
// $client->setClientSecret('YOUR_CLIENT_SECRET');
// $client->setRedirectUri('YOUR_REDIRECT_URI');
// $client->addScope("email");
// $client->addScope("profile");

// $authUrl = $client->createAuthUrl();
// echo "<a href='$authUrl'>Login with Google</a>";

      $this->view->show("login.php", $data,true);
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
  		
  		
  		$_SESSION['errors'] = "Te hemos enviado un email con los datos de acceso.";
	  	header ("location: ".APP_DOMAIN."/login");

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
  	
//   	public function generateNDA(){
  	
//   		$doc = new documentosModel();
//   		$doc->generateNDA($_SESSION['user']);
//   	}
 	
//  	public function cloneSession(){
 		
		
//  		$customers = new customersModel();

//  		$customer = $customers->getByCustomersId($this->params['cid']);

//  		if ($this->params['sec'] == sha1($customer['email'])){
//  		//	session_destroy();  
//  			$this->createSession($customer,false);
//  			header ("location: ".APP_DOMAIN);
//  			exit();
//  		}else{
//  			header("HTTP/1.0 404 Not Found"); 
//  			die();
//  		}
//  	}
   
}


$actionName = 'index';
		
if(get_param('m') != -1) $actionName = get_param('m');

if (!isset($_SESSION['errors'])) $_SESSION['errors'] ="";
if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = "";

if (!is_callable(array('App', $actionName))){
	//View::error404();
}



$App = new App();
$App->$actionName(); 


