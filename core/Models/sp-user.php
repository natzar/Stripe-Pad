<?

/**
 * Package Name: Stripe Pad
 * File Description: UsersModel (collection of users)
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
	var $datatracker;



	public function __construct()
	{
		parent::__construct();
		//	$this->datatracker = datatrackerModel::singleton();
		include_once CORE_PATH . "orm/field.php";
	}


	public function create($email, $name = '', $group = 'customers')
	{
		$user = $this->find($email);
		$mails = new mailsModel();

		if (!empty($user)) {
			$_SESSION['errors'][] = "User already exists";
			return $user;
		} else {

			# Password here
			$password = $this->randomPassword();
			$sha1p = hash('sha256', $password);
			$consulta = $this->db->prepare("INSERT INTO users (name,email,password,`group`) VALUES (:name,:email,:pass,:group)");
			$consulta->bindParam(':name', $name);
			$consulta->bindParam(':email', $email);
			$consulta->bindParam(':pass', $sha1p);
			$consulta->bindParam(':group', $group);

			$consulta->execute();
			$user = $this->getById($this->getLastId());

			# Send welcome email
			$data = array("email" => $email, "name" => $name, "password" => $password);
			$subject = "[INFO] Welcome to " . APP_NAME;
			$mails->sendTemplate('welcome_user', $data, $email, $subject);

			return $user;
		}
	}

	public function update($id, $data)
	{
		$c = $this->db->prepare("UPDATE users set name=:name, email=:email where usersId = :cid");
		$c->bindParam(":cid", $id);

		$c->bindParam(":name", $data['name']);
		$c->bindParam(":email", $data['email']);

		# TO-DO password

		$c->execute();

		return $this->getById($id);
	}

	public function getAll()
	{
		$consulta = $this->db->prepare('SELECT * FROM users ');
		$consulta->execute();
		$aux2 = $consulta->fetchAll();

		return $aux2;
	}

	public function delete($params)
	{
		$consulta = $this->db->prepare("DELETE FROM users where usersId='" . $params['usersId'] . "'");
		$consulta->execute();
		if ($consulta->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * saveLastLogin
	 *
	 * @param  mixed $usersId
	 * @return void
	 */
	public function saveLastLogin($usersId)
	{
		$c = $this->db->prepare('UPDATE users set last_login = NOW() where usersId = :id');
		$c->bindParam(':id', $usersId);
		$c->execute();
	}

	/**
	 * resetPassword
	 *
	 * @param  mixed $usersId
	 * @return void
	 */
	public function resetPassword($usersId)
	{
		$new_password = $this->randomPassword();
		$sha1p = hash('sha256', $new_password);
		$c = $this->db->prepare('UPDATE users set password = :p where usersId = :id');
		$c->bindParam(':p', $sha1p);
		$c->bindParam(':id', $usersId);
		$c->execute();
		return $new_password;
	}

	public function sendResetPassword($email)
	{
		$user = $this->find($email);
		if (!empty($user)) {
			$new_password = $this->resetPassword($user['usersId']);
			$mails = new mailsModel();

			$subject = '[INFO] Password modificado';
			$data = [
				'persona_contacto' => $user['name'],
				'user' => $user['email'],
				'password' => $new_password,
			];

			//$this->datatracker->push('areaclientes-send-password-reset');
			$mails->sendTemplate('recover_password', $data, $user['email'], $subject);
		}
	}

	/**
	 * find
	 *
	 * @param  mixed $email
	 * @return void
	 */
	public function find($email)
	{
		$consulta = $this->db->prepare("SELECT * FROM users  WHERE users.email=:email limit 1");
		$consulta->bindParam(":email", $email);
		$consulta->execute();
		$aux2 =  $consulta->fetch();

		return $aux2;
	}


	/**
	 * @param User's $id 
	 * @return Array
	 */
	public function getById($id)
	{
		$consulta = $this->db->prepare("SELECT * FROM users  WHERE usersId=:id limit 1");
		$consulta->bindParam(":id", $id);
		$consulta->execute();
		$aux2 =  $consulta->fetch();
		return $aux2;
	}

	/**
	 * Generate Random String
	 * @return String
	 */
	private function randomPassword($length = 12)
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+-=[]{}|;:\'",.<>/?';
		$password = '';
		$alphaLength = strlen($alphabet) - 1;

		for ($i = 0; $i < $length; $i++) {
			$n = ord(random_bytes(1)) % $alphaLength;
			$password .= $alphabet[$n];
		}

		return $password;
	}

	public function getOrmDescription($table = "users")
	{

		return array(
			"table_label" => "Users",
			"default_order" => "name ASC",
			"fields" => array("name", "email", "last_login", "created", "updated"),
			"fields_to_show" =>  array("name", "email", "last_login", "created", "updated"),
			"fields_labels" =>  array("name", "email", "last_login", "created", "updated"),
			"fields_types" => array("literal", "email", "fechahora", "fechahora", "fechahora")
		);
	}
}
