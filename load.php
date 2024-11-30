<?
/**
 * Package Name: Stripe Pad
 * File Description: Include this file anywhere to load all environment
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 */

# Include configuration file
require_once dirname(__FILE__).'/config.php';

# Defaults 
ini_set('log_errors', 1);
ini_set('error_log', APP_PATH.APP_NAME."-errors.log");

error_reporting(DEBUG_MODE ? E_ALL : 0);
ini_set('display_errors', DEBUG_MODE ? 1 : 0);
ini_set('display_startup_errors', DEBUG_MODE ? 1 : 0);

mb_internal_encoding(INTERNAL_ENCODING);
date_default_timezone_set(TIMEZONE); 
setlocale (LC_ALL, LOCALE_LANG); 
setlocale(LC_TIME, LOCALE_TIME); 

# Session 
if (PHP_SESSION_ACTIVE != session_status() and !headers_sent()){
    ini_set('session.cookie_lifetime', 3600 * 24 );
    ini_set('session.gc_maxlifetime', 3600 * 24 );
    session_set_cookie_params(3600 * 24);
    session_start();
}

# Include composer autoload
if (is_file(dirname(__FILE__)."/vendor/autoload.php")) require(dirname(__FILE__)."/vendor/autoload.php");

# Include base classes
include_once CORE_PATH."lib/ModelBase.php";
include_once CORE_PATH.'lib/SPDO.php';
include_once CORE_PATH.'lib/View.php';

# include all models from app dynamically
foreach (glob(dirname(__FILE__)."/app/models/*.php") as $filename)
{
    include $filename;
}

# Include Modules
include dirname(__FILE__)."/modules/requestBlocker/bot-blocker.php"; 
include dirname(__FILE__)."/modules/emailValidator/emailValidator.php"; 


# Helper functions
function isLocalhost() {
    // List of common localhost IP addresses
    $localhostIPs = array(
        '127.0.0.1',
        '::1',
    );

    // Check if we are running from the command line
    if (php_sapi_name() === 'cli' || defined('STDIN')) {
        // In CLI, assume localhost environment or implement additional logic as needed
        return true;
    }

    // Check if the server IP or remote IP is in the list of localhost IPs
    $serverAddr = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '';
    $remoteAddr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

    return in_array($serverAddr, $localhostIPs) || in_array($remoteAddr, $localhostIPs);
}


# Register fatal errors
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== NULL) {
        // Clear the output buffer to prevent previous output
        //ob_clean();

        // Custom error handling logic
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];

        $error_msg = date("d/m/Y H:i:s")." ".$errstr." [".$errno."]"." File: ".$errfile." // Line: ".$errline." ";
        file_put_contents(ROOT_PATH.APP_SLUG."-errors.log", $error_msg, FILE_APPEND);
       // echo $error_msg . '<br>';

        include ROOT_PATH."app/views/errors/error.php";
    } else {
        // Flush the buffer if there's no error
        //ob_end_flush();
        flush();
    }
});


# Capture any error to file
set_error_handler(function($errno, $errstr, $errfile, $errline ){
    $error_msg = Date("d/m/Y H:i:s")." ".$errstr." [". $errno."]"." File: ". $errfile. " // Linea: ".$errline." ";      
    @file_put_contents(ROOT_PATH.APP_SLUG."-errors.log", $error_msg);
    if (DEBUG_MODE){
        include ROOT_PATH."app/views/errors/error.php";
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
});