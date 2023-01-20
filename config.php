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
# Debug Mode
define('DebugMode',true);
error_reporting(DebugMode ? E_ALL : E_NONE);
ini_set('display_errors', DebugMode ? 0 : 1);

# General
define('ProjectTitle','Stripe Pad');
define('Theme','grid');
define('AdminEmail','youremail@domain.com');

# Text
define('SiteHeader','Stripe Pad');
define('SiteSubHeader','lorem ipsum');

#Stripe
define('StripeKeyProd',''); // Production
define('StripeSecretProd',''); // Production
define('StripeKeyDev',''); // Development
define('StripeSecretDev',''); // Development
define('StripeKey',DebugMode ? StripeKeyDev : StripeKeyProd);
define('StripeSecret',DebugMode ? StripeSecretDev : StripeSecretProd);
define('CacheFilename',dirname(__FILE__).'/cache/data.json');


