<?
/*

	Stripe Pad Load
                                                                                                                                                 
*/    

if (PHP_SESSION_ACTIVE != session_status() and !headers_sent()){
	ini_set('session.cookie_lifetime', 3600 * 24 );
	ini_set('session.gc_maxlifetime', 3600 * 24 );
	session_set_cookie_params(3600 * 24);
	session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', '1');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Madrid'); 
setlocale (LC_ALL, 'es_ES.ISO8859-1'); 
setlocale(LC_TIME, 'spanish'); 

require_once dirname(__FILE__).'/config.php';

if (is_file(dirname(__FILE__)."/vendor/autoload.php")) require(CORE_PATH."vendor/autoload.php");

include_once CORE_PATH."ControllerBase.php";
include_once CORE_PATH."ModelBase.php";
require_once CORE_PATH.'Config.php'; //de configuracion
require_once CORE_PATH.'SPDO.php';
require CORE_PATH.'View.php';

if (DEBUG_MODE){
	set_error_handler(function($errno, $errstr, $errfile, $errline ){
		
		$error_msg = Date("d/m/Y H:i:s")." ".$errstr." [". $errno."]"." File: ". $errfile. " // Linea: ".$errline." ";		
		file_put_contents(APP_PATH.APP_NAME."-errors.log", $error_msg);
		echo $error_msg. '<br>';
	   // throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
	});
}

include_once CORE_PATH."functions.php";	

foreach (glob(dirname(__FILE__)."/app/models/*.php") as $filename)
{
    include $filename;
}

