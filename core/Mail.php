<?

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailsModel extends ModelBase
{
    var $emailValidator;

    public function __construct()
    {
        $this->emailValidator = new emailValidator();
    }

    public function send($to, $subject, $body)
    {

        if (empty(SMTP_SERVER)) {
            die("Set SMTP server in config.php");
        }

        if (!empty($to) and $this->emailValidator->isValid($to)):

            $mail = new PHPMailer();
            $mail->IsSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SMTP_SERVER;                // Specify main and backup server

            $mail->Port = SMTP_PORT;                                    // Set the SMTP port
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = SMTP_USER_EMAIL;
            $mail->Password = SMTP_PASSWORD;                  // SMTP password
            $mail->SMTPSecure = 'tsl';
            $mail->SetFrom(SMTP_GLOBAL_EMAIL_FROM);
            $mail->IsHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->AddAddress($to);
            $mail->Subject = $subject;
            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
            $mail->MsgHTML($body);

            return $mail->Send();

        endif;
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
		if (!file_exists(APP_PATH . "mails/" . $template . ".php")) die("Email could not be sent, template " . $template . " does not exist");
		include APP_PATH . "mails/header.php";
		include APP_PATH . "mails/" . $template . ".php";
		include APP_PATH . "mails/footer.php";
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
			"template" => $templateName,
			"data" => $data,
			"to" => $to,
			"subject" => $subject,
			"save" => true,
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
