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
if (!file_exists(dirname(__FILE__) . '/sp-config.php')) {
    header("location: install");
    exit();
}
include_once dirname(__FILE__) . '/sp-config.php';

# Defaults 
ini_set('log_errors', 1);
ini_set('error_log', APP_PATH . APP_NAME . "-errors.log");

error_reporting(DEBUG_MODE ? E_ALL : 1);
ini_set('display_errors', DEBUG_MODE ? 1 : 1);
ini_set('display_startup_errors', DEBUG_MODE ? 1 : 1);

mb_internal_encoding(INTERNAL_ENCODING);
date_default_timezone_set(TIMEZONE);
setlocale(LC_ALL, LOCALE_LANG);
setlocale(LC_TIME, LOCALE_TIME);

# Session 
if (PHP_SESSION_ACTIVE != session_status() and !headers_sent()) {
    ini_set('session.cookie_lifetime', 3600 * 24);
    ini_set('session.gc_maxlifetime', 3600 * 24);
    session_set_cookie_params(3600 * 24);
    session_start();
}

# Include composer autoload
if (is_file(dirname(__FILE__) . "/vendor/autoload.php")) require(dirname(__FILE__) . "/vendor/autoload.php");

# Include base classes
include_once CORE_PATH . "sp-errors.php";
include_once CORE_PATH . "sp-helpers.php";
include_once CORE_PATH . "classes/sp-model-base.php";
include_once CORE_PATH . 'classes/sp-spdo.php';
include_once CORE_PATH . 'classes/sp-view.php';
include_once CORE_PATH . 'models/sp-mail.php';
include_once CORE_PATH . 'models/sp-user.php';
include_once CORE_PATH . "classes/BotBlocker.php";

# include all models from app dynamically
foreach (glob(APP_PATH . "models/*.php") as $filename) {
    include_once $filename;
}




# Register fatal errors
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== NULL) {
        // Clear the output buffer to prevent previous output
        //ob_clean();

        // Custom error handling logic
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];

        $error_msg = date("d/m/Y H:i:s") . " " . $errstr . " [" . $errno . "]" . " File: " . $errfile . " // Line: " . $errline . " ";
        @file_put_contents(ROOT_PATH . "sp-errors.log", $error_msg, FILE_APPEND);
        // echo $error_msg . '<br>';

        include_once ROOT_PATH . "app/views/errors/error.php";
    } else {
        // Flush the buffer if there's no error
        //ob_end_flush();
        flush();
    }
});


# Capture any error to file
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $error_msg = Date("d/m/Y H:i:s") . " " . $errstr . " [" . $errno . "]" . " File: " . $errfile . " // Linea: " . $errline . " ";
    @file_put_contents(ROOT_PATH . "sp-errors.log", $error_msg);
    if (DEBUG_MODE) {
        //   include_once ROOT_PATH . "app/views/errors/error.php";
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
});
