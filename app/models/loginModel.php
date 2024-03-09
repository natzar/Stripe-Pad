<?php
class loginModel extends ModelBase
{
	
    public function logout(){

        session_destroy();
    	$config = Config::singleton();
  		header ("location: ".$config->get('base_url'));
        exit(0);
    }
     function loginSuccess($user){
        $config = Config::singleton();            
        $_SESSION['initiated'] = true;        
        $_SESSION['user']['clientsId'] = $user['clientsId'];
        $_SESSION['user']['name'] = $user['name'];

        $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT'].$config->get('base_title'));	
        header ("location: ".$config->get('base_url').'admin/table/activity');
    }
    function loginError(){
        	$config = Config::singleton();
        $_SESSION['login_attemp']++;
        $_SESSION['errors'] = "Usuario o Password incorrecto";
    //    print_r($_SESSION);
        header ("location: ".$_SESSION['return_url']);
    }
	public function login($user,$pass,$admin = false)
	{   
	    	
    	$config = Config::singleton();
        if (!isset($_SESSION['login_attemp'])) $_SESSION['login_attemp'] = 1;
		// Uncheck security
	$_SESSION['login_attemp'] = 0;
	 
	 if ($_SESSION['login_attemp'] < 4){        	
		if ($admin){ // ADMIN USER       	
    	   $pass = sha1($pass);
    	   $c =  $this->db->prepare('SELECT * FROM '.$config->get('db_prefix').'clients where email = :user and password = :password limit 1');
                  	   
    	   $c->bindParam(':password',$pass);        	   
    	   $c->bindParam(':user',$user,PDO::PARAM_STR);
    	   $c->execute();
    	   $user = $c->fetch();
       
       
    	   if (!isset($user['clientsId'])){
    	       $this->loginError();
    	   }else{
    	       $this->loginSuccess($user);
    	   }
    	}else{ // APP USEr

    	   $pass = sha1($pass);
    	          
    	       $c =  $this->db->prepare('SELECT users.*,clients.name as client_name FROM '.$config->get('db_prefix').'users JOIN clients ON (users.clientsId = clients.clientsId) where users.email = :user and users.password = :password limit 1');
                  	   
    	   $c->bindParam(':password',$pass);        	   
    	   $c->bindParam(':user',$user,PDO::PARAM_STR);
    	   $c->execute();
    	   $user = $c->fetch();
       
    	   if (!isset($user['usersId'])){
    	       header ("location: ".$_SESSION['return_url']);
    	   }else{
               // $_SESSION['initiated'] = true;        
                $_SESSION['user']['clientsId'] = $user['clientsId'];
                $_SESSION['user']['client'] = $user['client_name'];
                $_SESSION['user']['usersId'] = $user['usersId'];
                $_SESSION['user']['name'] = $user['name'];
                $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT'].$config->get('base_title'));
                 header ("location: /app/app/");	
    	   }
           } 					
	   }else{
	   
	       header ("location: ".$_SESSION['return_url']);
	   } 
    }
}