<?
/**
 * Package Name: Stripe Pad
 * File Description: Global config file
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 
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

# App Name & Email
define('APP_NAME','Stripe Pad');
define('ADMIN_EMAIL','webmaster@domain.com');
define('APP_LOGO','../cdn/logo.png');

define('INTERNAL_ENCODING',"UTF-8");
define('TIMEZONE','Europe/Madrid'); 
define('LOCALE_LANG','es_ES.ISO8859-1'); 
define('LOCALE_TIME','spanish'); 

# Counterify.com 
define('COUNTERIFY_TOKEN','');

# Dual Environment, Dev / Prod
$localhostIPs = array('127.0.0.1','::1');

if (in_array($_SERVER['SERVER_ADDR'], $localhostIPs) || in_array($_SERVER['REMOTE_ADDR'], $localhostIPs)) {

	# Localhost / Development

    define('APP_DOMAIN','localhost/domain/app/');
	define('APP_BASE_URL', 'http://localhost/domain/app/');
	define('API_BASE_URL', 'http://localhost/domain/api/');
	define('HOMEPAGE_URL', 'http://localhost/domain/');

	define('APP_TABLE_PREFIX','');
	define('APP_DB_HOST','localhost');
	define('APP_DB','db name');
	define('APP_DB_USER','root');
	define('APP_DB_PASSWORD','');
	define('DEBUG_MODE',true);
} else {

	# Server / Production

    define('APP_DOMAIN','https://app.domain.com/');
	define('APP_BASE_URL', 'https://app.domain.com/');
	define('API_BASE_URL', 'https://api.domain.com/');
	define('HOMEPAGE_URL', 'https://domain.com');

	define('APP_TABLE_PREFIX','');
	define('APP_DB_HOST','');
	define('APP_DB','');
	define('APP_DB_USER','');
	define('APP_DB_PASSWORD','');
	define('DEBUG_MODE',false);
}

# Stripe

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

# PATHS
define('ROOT_PATH',dirname(__FILE__)."/");
define('CORE_PATH',dirname(__FILE__)."/core/");
define('APP_PATH',dirname(__FILE__)."/app/");
define('APP_UPLOAD_PATH',dirname(__FILE__).'/app/uploads/');



