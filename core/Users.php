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

	public function getAll()
	{

		$consulta = $this->db->prepare("SELECT * FROM users ");
		$consulta->execute();
		$aux2 = $consulta->fetchAll();

		return $aux2;
	}

	public function getByBearer($token)
	{

		$consulta = $this->db->prepare("SELECT * FROM users where bearer = :token limit 1");
		$consulta->bindParam(":token", $token);
		$consulta->execute();
		return $consulta->fetch();
	}



	public function sendResetPassword($email)
	{
		$user = $this->find($email);
		if (!empty($user)) {
			$new_password = $this->resetPassword($user['usersId']);

			$mails = new mailsModel();

			$subject = "Nuevos Accesos {APP_NAME}";
			$data = array(
				"persona_contacto" => $user['name'],
				"user" => $user['email'],
				"password" => $new_password
			);


			$mails->sendTemplate('robot-password-recovery', $data, $user['email'], $user['name'], $subject);
		}
	}

	public function sendWelcomeEmail($user)
	{
		// Setear Password

		$subject = "Welcome to " . APP_NAME;

		$body = "Successful signup to " . APP_NAME . ", Welcome to " . APP_NAME . " modify this message, usersModel.php line 49";

		// $body = "Welcome to Domstry,\n
		// \n
		// You can now login with email and password:\n
		// email: " . $email . "\n
		// password: " . $passw . "\n

		// ";
		// mail($email, 'Welcome to Domstry', $body);


		mail($user['email'], $subject, $body);
	}


	public function create($email, $name = "")
	{

		$find = $this->find($email);

		if (!empty($find)) {
			return $find;
		} else {
			$password = randomPassword();
			$new_password = hash('sha256', $password);

			$c = $this->db->prepare('INSERT INTO users (name,email,password) VALUES (:name, :email,:password)');
			$c->bindParam(':email', $email, PDO::PARAM_STR);
			$c->bindParam(':password', $new_password, PDO::PARAM_STR);
			$c->bindParam(':name', $name, PDO::PARAM_STR);

			$c->execute();

			$c = $this->db->prepare('select * from users where usersId=(SELECT LAST_INSERT_ID()) limit 1');
			$c->execute();
			$user = $c->fetch();



			$bearer = hash('sha256', $user['usersId'] . $user['email']);
			$c = $this->db->prepare("UPDATE users set bearer = :bearer where usersId = :usersId");
			$c->bindParam(':usersId', $user['usersId'], PDO::PARAM_STR);
			$c->bindParam(':bearer', $bearer, PDO::PARAM_STR);
			$c->execute();

			$user['password'] = $password;

			$this->sendWelcomeEmail($user);

			return $user;
		}
	}


	public function find($email)
	{


		$consulta = $this->db->prepare("SELECT * FROM users  WHERE users.email=:email limit 1");
		$consulta->bindParam(":email", $email);
		$consulta->execute();
		$aux2 =  $consulta->fetch();

		return $aux2;
	}


	public function getById($id)
	{
		$consulta = $this->db->prepare("SELECT * FROM users  WHERE usersId=:id limit 1");
		$consulta->bindParam(":id", $id);
		$consulta->execute();
		$aux2 =  $consulta->fetch();
		return $aux2;
	}


	public function update($params)
	{
		$consulta = $this->db->prepare("UPDATE users SET id = '" . $params['id'] . "',user_name = '" . $params['user_name'] . "',session_id = '" . $params['session_id'] . "',bot_id = '" . $params['bot_id'] . "',chatlines = '" . $params['chatlines'] . "',ip = '" . $params['ip'] . "',referer = '" . $params['referer'] . "',browser = '" . $params['browser'] . "',date_logged_on = '" . $params['date_logged_on'] . "',last_update = '" . $params['last_update'] . "',state = '" . $params['state'] . "'  where usersId='" . $params['id'] . "'");
		$consulta->execute();
		if ($consulta->rowCount() > 0) return true;
		else return false;
	}

	public function delete($params)
	{
		$consulta = $this->db->prepare("DELETE FROM users where usersId='" . $params['usersId'] . "'");
		$consulta->execute();
		if ($consulta->rowCount() > 0) return true;
		else return false;
	}

	public function saveLastLogin($user)
	{
		$c = $this->db->prepare('UPDATE users set last_login = NOW() where usersId = :id');
		$c->bindParam(':id', $user['customersId'], PDO::PARAM_STR);
		$c->execute();
	}



	private function resetPassword($usersId)
	{
		$new_password = randomPassword();
		$sha1p = sha1($new_password);

		$c = $this->db->prepare("UPDATE users set password= :p where usersId = :id");
		$c->bindParam(":p", $sha1p);
		$c->bindParam(":id", $usersId);
		$c->execute();

		return $new_password;
	}
}
