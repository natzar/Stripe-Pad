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

# BASIC DETAILS

define('APP_NAME','Stripe Pad');
define('APP_LOGO','');
define('DEBUG_MODE',true);
define('APP_THEME','basic');

# EMAIL
define('SMTP_SERVER','');                // Specify main and backup server
define('SMTP_PORT','');
define('EMAIL_FROM', '');
define('EMAIL_PASSWORD', '');


if (isLocalhost()) {

    # Force Debug
    define('DEBUG_MODE',true);
    
    define('APP_DOMAIN','//localhost/chatleads/');
	define('APP_BASE_URL', 'http://localhost/chatleads/');
	define('API_BASE_URL', 'http://localhost/domain/api/');
	define('HOMEPAGE_URL', 'http://localhost/chatleads/');

	define('APP_TABLE_PREFIX','');
	define('APP_DB_HOST','');
	define('APP_DB','');
	define('APP_CDN', '');
	define('APP_DB_USER','');
	define('APP_DB_PASSWORD','');


} else {

	# Server / Production
    define('APP_DOMAIN','https://app.domain.com/');
	define('APP_BASE_URL', 'https://app.domain.com/');
	define('API_BASE_URL', 'https://api.domain.com/');
	define('HOMEPAGE_URL', 'https://domain.com');
	define('APP_CDN', 'https://cdn.domstry.com/');

	define('APP_TABLE_PREFIX','');
	define('APP_DB_HOST','');
	define('APP_DB','');
	define('APP_DB_USER','');
	define('APP_DB_PASSWORD','');
}

# Stripe 
define('APP_STRIPE_PUBKEY','');
define('APP_STRIPE_SECRETKEY','');
define('APP_STRIPE_WEBHOOK_SECRET','');

define('APP_STRIPE_PUBKEY_TEST','');
define('APP_STRIPE_SECRETKEY_TEST','');
define('APP_STRIPE_WEBHOOK_SECRET_TEST','');

define('APP_STRIPE_ACCOUNTCOUNTRY','ES');
define('APP_STRIPE_CURRENCY','eur');
define('APP_STRIPE_DEFAULTCOUNTRY','ES');


# PATHS
define('ROOT_PATH',dirname(__FILE__)."/");
define('CORE_PATH',dirname(__FILE__)."/core/");
define('APP_PATH',dirname(__FILE__)."/app/");
define('APP_UPLOAD_PATH',dirname(__FILE__).'/uploads/');

# ENVIRONMENT
define("INTERNAL_ENCODING","UTF-8");
define("TIMEZONE","Europe/Madrid");
define("LOCALE_LANG","'es_ES.ISO8859-1'");
define("LOCALE_TIME","spanish");

# EXTRAS - MODULES
define('COUNTERIFY_TOKEN','');


