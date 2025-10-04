<?php

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

use StripePad\Exceptions;

# Include configuration file
if (!file_exists(dirname(__FILE__) . '/../sp-config.php')) {
    header("location: install");
    exit();
}
include_once dirname(__FILE__) . '/../sp-config.php';

# Defaults 
ini_set('log_errors', 1);
ini_set('error_log', ROOT_PATH . "logs/sp-errors.log");
error_reporting(DEBUG_MODE ? E_ALL : 1);
ini_set('display_errors', DEBUG_MODE ? 1 : 1);
ini_set('display_startup_errors', DEBUG_MODE ? 1 : 1);

# Locale
mb_internal_encoding(INTERNAL_ENCODING);
date_default_timezone_set(TIMEZONE);
putenv("LC_ALL=" . LOCALE_LANG);
setlocale(LC_ALL, LOCALE_LANG);

# Session 
if (PHP_SESSION_ACTIVE != session_status() and !headers_sent()) {
    ini_set('session.cookie_lifetime', 3600 * 24);
    ini_set('session.gc_maxlifetime', 3600 * 24);
    session_set_cookie_params(3600 * 24);
    session_start();
}

# Include composer autoload
if (is_file(dirname(__FILE__) . "/../vendor/autoload.php")) require(dirname(__FILE__) . "/../vendor/autoload.php");


# Include base classes
include_once CORE_PATH . "Exceptions/sp-exceptions.php";
include_once CORE_PATH . "sp-helpers.php";
# Include Custom App helpers.php
if (file_exists(dirname(__FILE__) . "/../app/helpers.php")) include_once(dirname(__FILE__) . "/../app/helpers.php");

include_once CORE_PATH . "Classes/sp-model-base.php";
include_once CORE_PATH . 'Classes/sp-spdo.php';
include_once CORE_PATH . "Classes/sp-emailvalidator.php";
include_once CORE_PATH . 'Classes/sp-view.php';
include_once CORE_PATH . 'Classes/php-pii.php';

include_once CORE_PATH . 'Models/sp-mail.php';
include_once CORE_PATH . 'Models/sp-user.php';
include_once CORE_PATH . 'Models/sp-cronjob.php';
include_once CORE_PATH . 'Models/sp-blog.php';
include_once CORE_PATH . 'Models/sp-counters.php';
include_once CORE_PATH . 'Models/sp-stripe.php';
include_once CORE_PATH . 'Models/sp-feedback.php';

include_once CORE_PATH . 'Models/sp-log.php';
include_once CORE_PATH . 'Models/sp-subscriptions.php';
include_once CORE_PATH . 'Models/sp-invoices.php';
include_once CORE_PATH . 'Models/sp-products.php';
include_once CORE_PATH . "Classes/sp-botblocker.php";

include_once CORE_PATH . "Services/sp-social-login.php";

include CORE_PATH . "orm/field.php";
# include all models from app dynamically
foreach (glob(APP_PATH . "models/*.php") as $filename) {
    include_once $filename;
}

foreach (glob(APP_PATH . "services/*.php") as $filename) {
    include_once $filename;
}



# Register fatal errors
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== NULL) {
        ob_clean(); // Uncomment this if output buffering is active

        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];


        $error_msg = "[FATAL ERROR] " . date("d/m/Y H:i:s") . "<br>" . $errstr . " [" . $errno . "]" . " File: " . $errfile . " // Line: " . $errline . " ";
        $_SESSION['errors'][] =  $error_msg;
        $logs = log::singleton();
        $logs->push("error", "system.error", $error_msg);



        exit();  // Ensure script termination after a fatal error
    } else {
        flush();  // This is applicable if output buffering is turned off
    }
    exit();
});


# Capture any error to file
set_error_handler(function ($errno, $errstr, $errfile, $errline) {

    $msg = date("d/m/Y H:i:s") . " " . $errstr . " [" . $errno . "]" . " File: " . $errfile . " // Line: " . $errline . " ";
    //  throw new StripePad\Exceptions\StripePadException($error_msg);
    $_SESSION['errors'][] =  $msg;
    $logs = log::singleton();
    $logs->push("error", "system.error", $msg);
    // include_once ROOT_PATH . "app/views/errors/error.php";

});
