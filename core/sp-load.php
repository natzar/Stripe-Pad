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
bindtextdomain('messages', ROOT_PATH . 'locale');
bind_textdomain_codeset('messages', 'UTF-8');
textdomain('messages');
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

include_once CORE_PATH . "sp-model-base.php";

# Include Custom App helpers.php
if (file_exists(dirname(__FILE__) . "/../app/helpers.php")) include_once(dirname(__FILE__) . "/../app/helpers.php");


# include all core dynamically # Fix!
foreach (glob(CORE_PATH . "lib/*.php") as $filename) {
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

        log::system("error", "system.error", $error_msg);

        echo 'FATAL error occurred. Please check the logs.';

        // exit();  // Ensure script termination after a fatal error
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
    log::system("error", "system.error", $msg);
    // include_once ROOT_PATH . "app/views/errors/error.php";
    if (DEBUG_MODE)     echo $msg; // 'axlhoa';
});
