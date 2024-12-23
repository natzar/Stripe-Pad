<?php

include_once "../../sp-load.php";

// Allow requests from
// Cross-domain issues, here!
header("Access-Control-Allow-Origin: " . APP_DOMAIN);

// Allow specific headers that your application might use
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

$init = microtime(true);

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$data['page'] = 0;

if (empty($data)) {
    die("Suspicious empty request");
}

// Enable simple cache: Generate a hash from the parameters
$hash = md5($json);
$cache_file = __DIR__ . "/cache/$hash.json";

// Check if the cache file exists
if (file_exists($cache_file)) {
    // Serve the cached response
    header('Content-Type: application/json; charset=utf-8');
    echo file_get_contents($cache_file);
    exit;
}

// Use MYSQL, models or elastic search to fill up $ouput array and return JSON response
$output = array();

$final = microtime(true);
$total_time = ($final - $init);
$output['total_time'] = number_format($total_time, 4, ".");

// JSON Response
header('Content-Type: application/json; charset=utf-8');
$json_response = json_encode($output);
file_put_contents($cache_file, $json_response);
echo $json_response;
