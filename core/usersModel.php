<?
/**
 * Package Name: Stripe Pad
 * File Description: User Model.
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 */

class usersModel extends ModelBase
{

		public function getAll(){

				$consulta = $this->db->prepare("SELECT * FROM users ");
				$consulta->execute();
				$aux2 = $consulta->fetchAll();

				return $aux2;
		}
		
		public function getByBearer($token){
			
			$consulta = $this->db->prepare("SELECT * FROM users where bearer = :token limit 1");
			$consulta->bindParam(":token",$token);
			$consulta->execute();
			return $consulta->fetch();

		}
		
		public function getChildren($parentId){
			$q = $this->db->prepare("SELECT * FROM users where parentId = :usersId");
			$q->bindParam(":usersId",$parentId);
			$q->execute();

			return $q->fetchAll();
		}

		
		public function sendResetPassword($email){
		$customer = $this->getByCustomersEmail($email);
		if (!empty($customer)){
			$new_password = $this->resetPassword($customer['usersId']);
			include_once "mailsModel.php";
			$mails = new mailsModel();
			
			$customersId = $customer['usersId'];			
			
			$subject = "Nuevos Accesos Php Ninja";
			$data = array(
				"persona_contacto" => $customer['persona_contacto'],
				"user" => $customer['email'],
				"password" => $new_password
			);
			
			$this->datatracker->push("areaclientes-send-password-reset");
			$mails->sendTemplate('robot-password-recovery',$data,$customer['email'],$customer['persona_contacto'],$subject);
			
		}


	}
	
	public function sendEmailBienvenida($user){
		// Setear Password
		
		$subject = "Welcome to ".APP_NAME;

		$body ="Successful signup to ".APP_NAME.", Welcome to ".APP_NAME." modify this message, usersModel.php line 49";
		mail($user['email'],$subject,$body);

		
	}
	
	
	public function create($params){
		$email = $params['email'];
		$userExist = $this->userExist($email);
		
		if(!empty($userExist)){
			return $userExist;			
		}else{
			$new_password = hash('sha256',$params['password']);
			
						
			$customersId = 1; //$this->getLastInsertedId();
			//$bearer = sha1($email);

			
			$c = $this->db->prepare('INSERT INTO users (email,password,customersId) VALUES (:email,:password,:customersId)');
			$c->bindParam(':email',$email,PDO::PARAM_STR);        	   
			$c->bindParam(':password',$new_password,PDO::PARAM_STR);        	   
			$c->bindParam(':customersId',$customersId,PDO::PARAM_INT);        
			
			$c->execute();
								
			$c = $this->db->prepare('select * from users where usersId=(SELECT LAST_INSERT_ID()) limit 1');
			$c->execute();
			$user = $c->fetch();
			
			
			
			$bearer = hash('sha256',$user['customersId'].$user['usersId'].$user['email']);
			$c = $this->db->prepare("UPDATE users set bearer = :bearer where usersId = :usersId");
			$c->bindParam(':usersId',$user['usersId'],PDO::PARAM_STR); 
			$c->bindParam(':bearer',$bearer,PDO::PARAM_STR); 
			$c->execute();
			
			$this->sendEmailBienvenida($user);

			return $user;	
		}
	}
	
	private function userExist($email){
		$c = $this->db->prepare("SELECT * from users where email like :email  limit 1");		
		$c->bindParam(":email",$email);
		$c->execute();
		if ($c->rowCount() > 0) return $c->fetch();
		return array();
		
	}
	
	public function getByUserEmail($email){


				$consulta = $this->db->prepare("SELECT * FROM users  WHERE users.email=:email limit 1");
				$consulta->bindParam(":email",$email);
				$consulta->execute();
				$aux2 =  $consulta->fetch();

				return $aux2;

		}		
		

		public function getByUsersId($id){
				$consulta = $this->db->prepare("SELECT * FROM users  WHERE usersId=:id limit 1");
				$consulta->bindParam(":id",$id);
				$consulta->execute();
				$aux2 =  $consulta->fetch();
				return $aux2;
		}

		
		public function getFieldValueById($field,$id){


				$consulta = $this->db->prepare("SELECT $field FROM users  where users.usersId ='".$id."' limit 1");
				$consulta->execute();
				$c = $consulta->fetch();
				$aux2 = $c[$field];

				return $aux2;
		}
		
		public function getByField($field,$val){


				$consulta = $this->db->prepare("SELECT * FROM users  where users.".$field." ='".$val."' ");
				$consulta->execute();
				$aux2 = $consulta->fetchAll();
				$this->cache->set("users_".$field."_".$val,$aux2,600);
				return $aux2;
		}
	

		
		
		public function search($params){
			$aux = $this->cache->get("users_search_".$params['query']);
			if ($aux == null){
				$consulta = $this->db->prepare("SELECT * FROM users  where title like '%".$params['query']."%' ");
				$consulta->execute();
				$aux2= $consulta->fetchAll();			
				return $aux2;
			}
			return $aux;
		}
		
		
		public function add($params){
			$consulta = $this->db->prepare("INSERT INTO users (id,user_name,session_id,bot_id,chatlines,ip,referer,browser,date_logged_on,last_update,state) VALUES ('".$params['id']."','".$params['user_name']."','".$params['session_id']."','".$params['bot_id']."','".$params['chatlines']."','".$params['ip']."','".$params['referer']."','".$params['browser']."','".$params['date_logged_on']."','".$params['last_update']."','".$params['state']."')");
			$consulta->execute();
			if ($consulta->rowCount() > 0) return true;
			else return false;
		}

		public function edit($params){
			$consulta = $this->db->prepare("UPDATE users SET id = '".$params['id']."',user_name = '".$params['user_name']."',session_id = '".$params['session_id']."',bot_id = '".$params['bot_id']."',chatlines = '".$params['chatlines']."',ip = '".$params['ip']."',referer = '".$params['referer']."',browser = '".$params['browser']."',date_logged_on = '".$params['date_logged_on']."',last_update = '".$params['last_update']."',state = '".$params['state']."'  where usersId='".$params['id']."'");
			$consulta->execute();
			if ($consulta->rowCount() > 0) return true;
			else return false;
		}

		public function delete($params){
			$consulta = $this->db->prepare("DELETE FROM users where usersId='".$params['usersId']."'");
			$consulta->execute();
			if ($consulta->rowCount() > 0) return true;
			else return false;
		}
		
		public function saveLastLogin($user){
			$c = $this->db->prepare('UPDATE users set last_login = NOW() where usersId = :id');
			$c->bindParam(':id',$user['customersId'],PDO::PARAM_STR);        	   		
			$c->execute();
		}
		
		public function selfServiceCreateCustomer($params){
		$email = $params['email'];
		

		$user = $this->userExist($email);
		$passw = randomPassword();
		$sha1_passw = hash('sha256',$passw);

		if (!$user){
			$c = $this->db->prepare('INSERT INTO users (email,password) VALUES (:email,:password)');
			$c->bindParam(':email',$email,PDO::PARAM_STR);        	   
			$c->bindParam(':password',$sha1_passw,PDO::PARAM_STR);        	   
			$c->execute();
			
		} else {
			$c = $this->db->prepare('UPDATE users set password = :password where email = :email' );
			$c->bindParam(':email',$email,PDO::PARAM_STR);        	   
			$c->bindParam(':password',$sha1_passw,PDO::PARAM_STR);        	   
			$c->execute();
		}
		


		$body ="Welcome to Domstry,\n
		\n
		You can now login with email and password:\n
		email: ".$email."\n
		password: ".$passw."\n

		";
		mail($email, 'Welcome to Domstry', $body);
				

	}
    private function resetPassword($customersId){
        $new_password =randomPassword();
        $this->updateField('password', sha1($new_password),$customersId);
        return $new_password;
        }
        private function updateField($field,$value,$id){
        $c = $this->db->prepare("UPDATE customers set ".$field." = :p where customersId = :id");
        $c->bindParam(":p",$value);
        $c->bindParam(":id",$id);   
        $c->execute();
        }
	
}
