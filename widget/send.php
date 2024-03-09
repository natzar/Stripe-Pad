<?
include "cors.php";
include "bd.php";
include "lib/emailValidator/emailValidator.php";
include "lib/send_email.php";

// check if ajax, not secure  but ...
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{    
	//die();
}


//$json = file_get_contents('php://input');

$data = $_POST;

// Validate emails
$validator = new EmailValidator();

$result = array("success" => true, "emails" => array(), "msg" => "Thank you");
$allok = true;

// VALIDAR EMAILS
foreach($data['friends'] as $friend){
	$status = true;
	if (!$validator->isValid($friend)){
		$status = false;
		$allok = false;

	}

	$result['emails'][]= array("email" => $friend, "valid" => $status);
}

// SUCCESS OR ERROR
if (!$allok) {
	$result['success'] = false;
	$result['msg'] = "Some emails seems to not be valid";

}else{

	// SAVE REFERRALS & send emails
	$q = $bd->prepare("SELECT * from users where hash = :e limit 1" );
	$q->bindParam(":e",$data['id']);
	$q->execute();
	$widget = $q->fetch();
	$settings = json_decode($widget['settings'],true);



	// REFERRAL MAIN
	$q = $bd->prepare("INSERT INTO leads (usersId,name,email) VALUES (:uid,:name,:email)");
	$q->bindParam(":uid",$widget['usersId']);
	$q->bindParam(":name",$data['name']);
	$q->bindParam(":email",$data['email']);
	$q->execute();

	$parent = $bd->lastInsertId();

	$pixel = "<img style='width:0px;height:0px;' width='0' height='0' src='https://refboost.com/widget/read.php?id=".$parent."'>";
	
	$settings['body_main'] = str_replace("{{name}}", $data['name'], $settings['body_main']);
	$body = nl2br($settings['body_main']).$pixel;

	// send email completion
	sendEmail($data['email'],"Your discount from ".$settings['url'], $body);
	
	// FRIENDS
	
	foreach($data['friends'] as $friend){
		
		$q = $bd->prepare("INSERT INTO leads (usersId,email,parent) VALUES (:uid,:email,:parent) ");
		$q->bindParam(":uid",$widget['usersId']);
		$q->bindParam(":email",$friend);
		$q->bindParam(":parent",$parent);
		$q->execute();

		$id = $bd->lastInsertId();

		$pixel = "<img style='width:0px;height:0px;' width='0' height='0' src='https://refboost.com/widget/read.php?id=".$id."'>";
		
		$settings['body_friends'] = str_replace("{{name}}", $data['name'], $settings['body_friends']);
		$body = nl2br($settings['body_friends']).$pixel;
		$to = $friend;
		$subject = "¿Have you met ".$settings['url']."?";

		sendEmail($to,$subject,$body);

	}

	//
	$body = "Hi from Refboost<br>
	<br>
		".$data['name']." ".$data['email']." has referred ".count($data['friends'])." friends!<br><br>To get all captured leads upgrade to premium<br><br>
-----<br>
https://Refboost.com Robot

		";
	sendEmail($widget['email'],"New Referrals from refboost",$body);
}

echo json_encode($result);