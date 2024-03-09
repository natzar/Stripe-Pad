<?

require_once ("class.phpmailer.php");
require_once "class.smtp.php";

function sendEmail($to,$subject,$body){
	
	$mail = new PHPMailer();
	$mail->IsSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.your-server.de';                 // Specify main and backup server

	$mail->Port = 587;                                    // Set the SMTP port
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'hello@refboost.com';
	$mail->Password = 'fC58Iky658aeJ2VZ';                  // SMTP password
	$mail->SMTPSecure = 'tsl';     
	$mail->SetFrom("hello@refboost.com");		
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	$mail->AddAddress($to);
	$mail->Subject = $subject;
	$mail->AltBody = $body;
	$mail->MsgHTML($body); 
	if ($mail->send()) return true;
	return false;

}