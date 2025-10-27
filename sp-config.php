<?php

/**
 * Package Name: Stripe Pad
 * File Description: Global config file
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/thingsnearyou
 * 
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This file is part of Stripe Pad.
 *
 *	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */

# BASIC DETAILS
define('DEBUG_MODE', true);
define('APP_NAME', 'Stripe Pad');
define('APP_SLUG', 'stripepad'); // no spaces, lowercase, cannot contain any of the following '=,;.[ \t\r\n\013\014'
define('APP_LOGO', '');
define('SEO_TITLE', 'Stripe Pad · PHP Micro Saas Boilerplate');
define('SEO_DESCRIPTION', 'Stripe Pad · PHP Micro Saas Boilerplate');
define('SEO_KEYWORDS', 'php stripe boilerplate, php micro saas, stripe pad, stripe payment, php stripe payment, stripe integration, php microservice, php saas boilerplate');

# STORAGE
define("APP_STORAGE", "sqlite"); // Options: sqlite / mysql

# ENCODING & TIMEZONE
define("INTERNAL_ENCODING", "UTF-8");
define("TIMEZONE", "Europe/Madrid"); // Check https://www.php.net/manual/en/timezones.php


# LANGUAGE
// Define the default language and supported languages
// Add any other languages you want to support, e.g., ['de', 'es', 'fr']
define('LANGUAGES', ['en']);

$locale = get_locale();
define("LOCALE_LANG", $locale);
define("LOCALE_TIME", $locale);

# SECURITY
define('APP_SECRET_KEY', '[Generate secret key, used for encryption functions]');
define('BOT_BLOCKER', false); # Enable bot blocker if you have too many requests


define('APP_COOKIE_DOMAIN', ''); // Set to your domain to share cookies across subdomains, e.g., '.yourdomain.com'. Leave empty for default behavior.

# PATHS
define('ROOT_PATH', dirname(__FILE__) . "/");
define('CORE_PATH', dirname(__FILE__) . "/core/");
define('APP_PATH', dirname(__FILE__) . "/app/");
define('LANDING_PATH', dirname(__FILE__) . "/landing/");
define('ADMIN_PATH', dirname(__FILE__) . "/admin/");
define('APP_UPLOAD_PATH', dirname(__FILE__) . '/uploads/');

# Same sp-config.php file for localhost and production
# Detect if we are running on localhost or on a server
if (isLocalhost()) { # Localhost

	define('LANDING_URL', 'http://localhost/stripe-pad/');
	define('APP_URL', 'http://localhost/stripe-pad/app/');
	define('ADMIN_URL', 'http://localhost/stripe-pad/admin/');
	define('API_URL', 'http://localhost/stripe-pad/api/');
	define('APP_CDN', LANDING_URL . 'cdn/');

	# MYSQL ONLY - Adjust your mysql database details here
	define('APP_TABLE_PREFIX', '');
	define('APP_DB_HOST', '');
	define('APP_DB', '');
	define('APP_DB_USER', '');
	define('APP_DB_PASSWORD', '');
} else {    # Server / Production


	define('LANDING_URL', 'https://demo.stripepad.com/');
	define('APP_URL', 'https://demo.stripepad.com/');
	define('ADMIN_URL', 'https://demo.stripepad.com/');
	define('API_URL', 'https://domain.com');
	define('APP_CDN', 'https://demo.stripepad.com/cdn/');

	# MYSQL ONLY - Adjust your mysql database details here
	define('APP_TABLE_PREFIX', '');
	define('APP_DB_HOST', '');
	define('APP_DB', '');
	define('APP_DB_USER', '');
	define('APP_DB_PASSWORD', '');
}

# EMAIL SMTP
define('ADMIN_EMAIL', '');
define('SMTP_SERVER', '');                // Specify smtp server
define('SMTP_PORT', 587);
define('SMTP_GLOBAL_EMAIL_FROM', ''); // Set Email from address
define('SMTP_USER_EMAIL', ''); // Set user name / email for SMTP
define('SMTP_PASSWORD', ''); // Set password for SMTP user

# Stripe 
define('APP_STRIPE_PUBKEY', '');
define('APP_STRIPE_SECRETKEY', '');

define('APP_STRIPE_WEBHOOK_SECRET', '');

define('APP_STRIPE_PUBKEY_TEST', '');
define('APP_STRIPE_SECRETKEY_TEST', '');
define('APP_STRIPE_WEBHOOK_SECRET_TEST', '');

define('APP_STRIPE_ACCOUNTCOUNTRY', 'ES');
define('APP_STRIPE_CURRENCY', 'eur');
define('APP_STRIPE_DEFAULTCOUNTRY', 'ES');
define('APP_STRIPE_TAX_RATE', '');

# GOOGLE
define('GOOGLE_CLIENT_ID', '');
define('GOOGLE_CLIENT_SECRET', '');
define('GOOGLE_REDIRECT_URI', '');

# OPENAI
define('OPENAI_CHATGPT_APIKEY', ''); // platform.openai.com






# Helper functions
function isLocalhost()
{
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

/**
 * Method get_locale (Get Current Language from the environment)
 *
 * @return void
 */
function get_locale()
{
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		// If the user has set a language via ?lang=, use that; otherwise, use the browser's language preference.
		// If neither is set, default to English ('en').
		// Get language from ?lang= OR browser (default: 'en')

		$accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ??  LANGUAGES[0];
		$lang_from_browser = substr($accept, 0, 2);
		$lang_from_query = isset($_GET['lang']) ? htmlspecialchars($_GET['lang'], ENT_QUOTES, 'UTF-8') : null;
		$user_lang = strtolower($lang_from_query ?? $lang_from_browser);
	} else {
		$user_lang = LANGUAGES[0]; // Default to English if no language is set
	}

	// Use only supported languages, fallback to English
	$lang = in_array($user_lang, LANGUAGES) ? $user_lang :  LANGUAGES[0];
	// Convert to locale format (e.g., "es_ES.utf8", "en_EN.utf8")
	$locale = strtoupper($lang) . '_' . strtoupper($lang) . '.utf8';

	return $locale;
}
# Stripe Pad Version
include_once dirname(__FILE__) . "/core/sp-version.php";
