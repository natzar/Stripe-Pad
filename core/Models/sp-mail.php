<?

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailsModel extends ModelBase
{
	var $emailValidator;
	var $log;

	public function __construct()
	{
		parent::__construct();
		$this->log = log::singleton();

		// Fix include email validator
		include_once CORE_PATH . "Classes/EmailValidator.php";
		$this->emailValidator = new emailValidator();
	}

	private function send($params)
	{

		if (empty(SMTP_SERVER)) {
			die("Set SMTP server in config.php");
		}

		if (empty($params['to'])) return false; //("Falta destino");

		if (!$this->emailValidator->isValid($params['to'])) return false;

		if (empty($params['tag'])) $params['tag'] = "Default";
		if (empty($params['from_name'])) $params['from_name'] = APP_NAME;
		if (empty($params['to_name'])) $params['to_name'] = "";

		if (empty($params['from'])) $params['from'] =  SMTP_GLOBAL_EMAIL_FROM;

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer();
		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->Host = SMTP_SERVER;                // Specify main and backup server
		$mail->SMTPDebug = 0;
		$mail->Port = SMTP_PORT;                                    // Set the SMTP port
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = SMTP_USER_EMAIL;
		$mail->Password = SMTP_PASSWORD;                  // SMTP password
		$mail->SMTPSecure = 'tls';                             // Set the SMTP port
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		$mail->CharSet = "UTF-8";
		$mail->Mailer = "smtp";
		$mail->SMTPKeepAlive = true;
		// Comment if you prefer no-reply!
		$mail->addReplyTo(ADMIN_EMAIL, APP_NAME);


		$mail->SetFrom($params['from'], $params['from_name']);

		// Destination
		if (strstr($params['to'], ";")) {
			$aux = explode(";", $params['to']);
			foreach ($aux as $email) {
				$mail->AddAddress(trim($email));
			}
		} else {
			$mail->AddAddress($params['to']);
		}

		if (!empty($_FILES['attach_file'])) {
			if (count($_FILES['attach_file']) > 0 and !empty($_FILES['attach_file']['name'][0])) {
				for ($ct = 0; $ct < count($_FILES['attach_file']['tmp_name']); $ct++) {
					$mail->AddAttachment($_FILES['attach_file']['tmp_name'][$ct], $_FILES['attach_file']['name'][$ct]);
				}
			}
		}

		if (!empty($params['attachments'])) {

			for ($ct = 0; $ct < count($params['attachments']); $ct++) {
				$mail->AddAttachment($params['attachments'][$ct]['file'], $params['attachments'][$ct]['filename']);
			}
		}

		$mail->Subject = ($params['subject']);
		$mail->AltBody = strip_tags($params['body']);
		$mail->MsgHTML($params['body']);

		if ($mail->Send()) {
			return true;
		}
		$mail = null;
		return false;
	}


	private function loadTemplate($template, $data)
	{

		// $t = $this->db->prepare("SELECT * from emailtemplates where subject = :template limit 1");
		// $t->bindParam(":template",$template);

		// $t->execute();
		// $ts = $t->fetch();
		// $body = $ts['body'];

		#var_export $data before template, so template uses $phpvars and just it.
		ob_start();
		if (!file_exists(ROOT_PATH . "mails/" . $template . ".php")) die("Email could not be sent, template " . $template . " does not exist");
		include ROOT_PATH . "mails/header.php";
		include ROOT_PATH . "mails/" . $template . ".php";
		include ROOT_PATH . "mails/footer.php";
		$body = ob_get_contents();
		//$body = nl2br($body);
		ob_clean();



		return replaceTemplateValues($body, $data);
	}

	private function isReply($params)
	{

		//	if ($params['from'] == "hola@phpninja.es") return array();
		if ($params['from'] == "robot@phpninja.es") return array();

		$q = $this->db->prepare("SELECT * FROM comments where object = :obj and objectid = :objid and message_id is not null and usersId IN (0,1,3,1000) order by created DESC limit 3");
		$q->bindParam(":obj", $params['object']);
		$q->bindParam(":objid", $params['objectid']);
		$q->execute();

		return $q->fetchAll();
	}

	public function sendTemplate($templateName, $data, $to, $subject, $attachments = array())
	{

		return $this->send(array(
			"body" => $this->loadTemplate($templateName, $data),
			"to" => $to,
			"subject" => $subject,
			"attachments" => $attachments
		));
	}
	public function internal($subject, $msg)
	{
		return $this->send(array(
			"body" => $msg,
			"to" =>  "beto.phpninja@gmail.com",
			"tag" => "internal",
			"subject" => $subject,
		));
	}

	function replaceTemplateValues($body, $p)
	{

		foreach ($p as $k => $v) {
			if ($k == "persona_contacto") { // Sin apellidossi
				$v = explode(" ", $v);
				$v = $v[0];
			}
			$body = str_replace("{{" . $k . "}}", $v, $body);
		}

		if (isset($p['persona_contacto'])) {
			$body = str_replace("{{persona_contacto_completo}}", $p['persona_contacto'], $body);
		}



		$weekdays = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
		$body = str_replace("{{dia_semana}}", $weekdays[date("w")], $body);

		$body = str_replace("{{fecha_completa}}", Date("d/m/Y H:i:s"), $body);

		$body = str_replace("{{fecha}}", Date("d/m/Y"), $body);

		$body = str_replace(" ,", Date(","), $body);

		// Prevent errors
		$body = preg_replace('/\\{{2}(.*)\\}{2}/', '', $body);
		return $body;
	}
}
