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



if (!defined("CORE_PATH")) define('CORE_PATH',dirname(__FILE__)."/");

require(CORE_PATH."vendor/autoload.php");



include_once CORE_PATH."lib/ControllerBase.php";
include_once CORE_PATH."lib/ModelBase.php";
require_once CORE_PATH.'lib/Config.php'; //de configuracion
require_once CORE_PATH.'lib/SPDO.php';

require_once CORE_PATH.'config.php';


include_once CORE_PATH."lib/functions.php";	

foreach (glob(dirname(__FILE__)."/app/models*.php") as $filename)
{
    include $filename;
}

