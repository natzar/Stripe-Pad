<?
/*

	Php Ninja Load
                                                                                                                                                 
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


include_once CORE_PATH."classes/Request.php";
include_once CORE_PATH."classes/Domain.php";
include_once CORE_PATH."classes/CronJob.php";
include_once CORE_PATH."classes/Webpage.php";
include_once CORE_PATH."classes/Website.php";
include_once CORE_PATH."classes/Crawler.php";
include_once CORE_PATH."classes/Openai.php";
include_once CORE_PATH."classes/emailValidator/emailValidator.php";

include_once CORE_PATH."vendor/simplehtmldom_1_9_1/simple_html_dom.php";
include_once CORE_PATH.'vendor/php-whois-master/src/Phois/Whois/Whois.php';
include_once CORE_PATH.'models/documentosModel.php'; 	
	    
include_once CORE_PATH."vendor/uagent.php";
include_once CORE_PATH."models/pagespeedModel.php";
include_once CORE_PATH."models/documentsModel.php";
include_once CORE_PATH."models/timetablesModel.php";
include_once CORE_PATH."models/auditsModel.php";
include_once CORE_PATH."models/clonsModel.php";
include_once CORE_PATH."models/mailsModel.php";
include_once CORE_PATH."models/leadsModel.php";
include_once CORE_PATH."models/usersModel.php";
include_once CORE_PATH."models/suggestionsModel.php";
include_once CORE_PATH."models/ranktrackerModel.php";
include_once CORE_PATH."models/attachmentsModel.php";
include_once CORE_PATH."models/paymentsModel.php";
include_once CORE_PATH."models/spamsModel.php";
include_once CORE_PATH."models/credentialsModel.php";
include_once CORE_PATH."models/usersModel.php";
include_once CORE_PATH."models/websModel.php";
include_once CORE_PATH."models/logsModel.php";

include_once CORE_PATH."models/productsModel.php";
include_once CORE_PATH."models/ticketsModel.php";
require_once CORE_PATH."models/commentsModel.php";
require_once CORE_PATH."models/customersModel.php";

include CORE_PATH."classes/GAnalytics.php";

include_once CORE_PATH."lib/functions.php";	

