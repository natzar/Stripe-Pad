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

# Load Environment
require_once dirname(__FILE__).'/load.php'; // 

# Load Custom App
include dirname(__FILE__)."/app/App.php";

// Initialize session variables if not already set
if (!isset($_SESSION['errors'])) $_SESSION['errors'] = array();
if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = array();

// Sanitize 'm' parameter to prevent injection
$actionName = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
if (!$actionName) {
    $actionName = 'index'; // Default action
}

$App = new App();

if (!is_callable(array('App', $actionName))){
	$App->view->error404();
}else{
    $App->$actionName(); 
}







