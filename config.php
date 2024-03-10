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
define('APP_SLUG','stripe-pad');
define('APP_LOGO','https://refboost.com/refboost-logo.png');
define('DEBUG_MODE',true);
define('APP_THEME','base-dark'); #folder name of your theme
define('SEO_TITLE','Stripe Pad · PHP Micro Saas Boilerplate');
define('SEO_DESCRIPTION','Stripe Pad · PHP Micro Saas Boilerplate');

define('BOT_BLOCKER',true);

# EMAIL
define('ADMIN_EMAIL','support@stripepad.com');
define('SMTP_SERVER','');                // Specify main and backup server
define('SMTP_PORT','');
define('EMAIL_FROM', 'support@stripepad.com');
define('EMAIL_PASSWORD', '');


if (isLocalhost()) { # Localhost
    define('APP_DOMAIN','//localhost/stripe-pad/');
	define('APP_BASE_URL', 'http://localhost/stripe-pad/');
	define('API_BASE_URL', 'http://localhost/stripe-pad/api/');
	define('HOMEPAGE_URL', 'http://localhost/stripe-pad/');

	define('APP_TABLE_PREFIX','');
	define('APP_DB_HOST','');
	define('APP_DB','');
	define('APP_CDN', 'http://localhost/stripe-pad/cdn/');
	define('APP_DB_USER','');
	define('APP_DB_PASSWORD','');
} else {    # Server / Production
    define('APP_DOMAIN','https://www.stripepad.com/');
	define('APP_BASE_URL', 'https://www.stripepad.com/');
	define('API_BASE_URL', 'https://www.stripepad.com/');
	define('HOMEPAGE_URL', 'https://www.stripepad.com');
	define('APP_CDN', 'https://www.stripepad.com/cdn/');

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
define('APP_STRIPE_TAX_RATE','');

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
define('OPENAI_CHATGPT_APIKEY','');

