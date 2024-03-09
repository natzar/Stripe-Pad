<?
// Allow requests from both *.gphpninja.com and chatleads.net

header("Access-Control-Allow-Origin: *");

// Allow specific headers that your application might use
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
// Marca el inicio del script


// Coloca aquí el código cuyo tiempo de ejecución quieres medir

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
	die();
}
$tiempoInicio = microtime(true);
include_once "../load.php";

$leads = new LeadsModel();
$json = null;
$params = gett();
if (isset($_GET) and !empty($params)){
	$json = json_encode($params);
}else{
	$json = file_get_contents('php://input');			
}


$data = json_decode($json);

$data->page = 0;

if (empty($data)){
	die("Not Cool");
}
$r = $leads->getQuery($data);
//$r = array();
$search = new searchModel();
$search->saveQuery($r['where']);
unset($r['where']);

$tracker = datatrackerModel::singleton();  
$tracker->push('api-crawler-request');
	
header('Content-Type: application/json; charset=utf-8');


// Marca el final del script
$tiempoFinal = microtime(true);

// Calcula el tiempo de ejecución restando el tiempo de inicio del tiempo final
$tiempoEjecucion = ($tiempoFinal - $tiempoInicio) ;


$r['count_formated'] =  number_format($r['count'],0,".",",");
$r['time_formated'] =  number_format($tiempoEjecucion,4,".");

echo json_encode($r);		
		
	




