<?

include "emailValidator.php";


$validator = new emailValidator();

$emails = ["hola@15meg4free.com","contacto@globalstudio.es","15meg4free.com","noreply@google.com","no-reply@google.com","betolopezayesa@hotmail.com","hola@phpninja.es","cacadevaca"];

foreach($emails as $email):
	$res = $validator->isValid($email) ? 'good' : 'bad';

	echo "The email ".$email." is ".$res.PHP_EOL;

endforeach;