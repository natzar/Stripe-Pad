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

# Session 
if (PHP_SESSION_ACTIVE != session_status() and !headers_sent()){
	ini_set('session.cookie_lifetime', 3600 * 24 );
	ini_set('session.gc_maxlifetime', 3600 * 24 );
	session_set_cookie_params(3600 * 24);
	session_start();
}

# Defaults 
error_reporting(DEBUG_MODE ? E_ALL : E_NONE);
ini_set('display_errors', DEBUG_MODE ? 0 : 1);
mb_internal_encoding(INTERNAL_ENCODING);
date_default_timezone_set(TIMEZONE); 
setlocale (LC_ALL, LOCALE_LANG); 
setlocale(LC_TIME, LOCALE_TIME); 

# Include composer autoload
if (is_file(dirname(__FILE__)."/vendor/autoload.php")) require(dirname(__FILE__)."/vendor/autoload.php");

# Include base classes
include_once CORE_PATH."ModelBase.php";
include_once CORE_PATH.'SPDO.php';
include_once CORE_PATH.'View.php';

# Capture any error to file
set_error_handler(function($errno, $errstr, $errfile, $errline ){
	$error_msg = Date("d/m/Y H:i:s")." ".$errstr." [". $errno."]"." File: ". $errfile. " // Linea: ".$errline." ";		
	@file_put_contents(APP_PATH.APP_NAME."-errors.log", $error_msg);
	if (DEBUG_MODE){
		echo $error_msg. '<br>';
   		throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
	}
});

# include all models from app dynamically
foreach (glob(dirname(__FILE__)."/app/models/*.php") as $filename)
{
    include $filename;
}

