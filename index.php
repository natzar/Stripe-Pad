<?
/* 
	Stripe Pad - Micro SaaS boilerplate
	Main Controller
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

require('config.php');

# Checking if minimum settings are ready

if (empty(StripeKey) or empty(StripeKeySecret)) die("Stripe credentials are empty. Edit config.php file an add theme");

if(!file_exists(CacheFilename)){ // Defined in config
	$data = file_get_contents('/webhooks/stripeGetSettings.php');
	file_put_contents(CacheFilename, $data);
}

$settings = json_decode(file_get_contents(CacheFilename)); //data read from json file	
include "themes/".Theme."/index.php";