<?
/* 
	Stripe Pad - Micro SaaS boilerplate
    Config file
    Copyright (C) 2023 Beto Ayesa

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    This file is part of Stripe Pad.

	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
*/

define('APP_PATH',CORE_PATH."/");
define('APP_NAME','Counterify');
define('APP_LOGO','');
define('DEBUG_MODE',true);
define('CORE_PATH',dirname(__FILE__));

define('APP_UPLOAD_PATH',CORE_PATH.'/uploads/');
define('APP_THEME','basic');

error_reporting(DEBUG_MODE ? E_ALL : E_NONE);
ini_set('display_errors', DEBUG_MODE ? 0 : 1);


function isLocalhost() {
    // List of common localhost IP addresses
    $localhostIPs = array(
        '127.0.0.1',
        '::1',
    );

    // Check if the server IP or remote IP is in the list of localhost IPs
    return in_array($_SERVER['SERVER_ADDR'], $localhostIPs) || in_array($_SERVER['REMOTE_ADDR'], $localhostIPs);
}

if (isLocalhost()) {
    define('APP_DOMAIN','localhost/domain/app/');
	define('APP_BASE_URL', 'http://localhost/domain/app/');
	define('API_BASE_URL', 'http://localhost/domain/api/');
	define('HOMEPAGE_URL', 'http://localhost/domain/');

	define('APP_TABLE_PREFIX','');
	define('APP_DB_HOST','localhost');
	define('APP_DB','db name');
	define('APP_DB_USER','root');
	define('APP_DB_PASSWORD','');

} else {

	// PRODUCTION ENVIRONMENT

    define('APP_DOMAIN','https://app.domain.com/');
	define('APP_BASE_URL', 'https://app.domain.com/');
	define('API_BASE_URL', 'https://api.domain.com/');
	define('HOMEPAGE_URL', 'https://domain.com');

	define('APP_TABLE_PREFIX','');
	define('APP_DB_HOST','');
	define('APP_DB','');
	define('APP_DB_USER','');
	define('APP_DB_PASSWORD','');

}

/* STRIPE */

define('STRIPE_PUB_PROD','');
define('STRIPE_SEC_PROD','');
define('STRIPE_WEBHOOK_PROD','');

define('STRIPE_WEBHOOK_TEST','');
define('STRIPE_PUB_TEST','');
define('STRIPE_SEC_TEST','');

define('APP_STRIPE_PUBKEY',STRIPE_PUB_PROD);
define('APP_STRIPE_SECRETKEY',STRIPE_SEC_PROD);
define('APP_STRIPE_WEBHOOK_SECRET',STRIPE_WEBHOOK_PROD);

define('APP_STRIPE_PUBKEY_TEST',STRIPE_PUB_TEST);
define('APP_STRIPE_SECRETKEY_TEST',STRIPE_SEC_TEST);
define('APP_STRIPE_WEBHOOK_SECRET_TEST',STRIPE_WEBHOOK_TEST);


define('APP_STRIPE_ACCOUNTCOUNTRY','ES');
define('APP_STRIPE_CURRENCY','eur');
define('APP_STRIPE_DEFAULTCOUNTRY','ES');

# Debug Mode

if (DEBUG_MODE){
	set_error_handler(function($errno, $errstr, $errfile, $errline ){
		
		$error_msg = Date("d/m/Y H:i:s")." ".$errstr." [". $errno."]"." File: ". $errfile. " // Linea: ".$errline." ";		
		file_put_contents(APP_NAME."-errors.log", $error_msg);
	    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
	});
}



