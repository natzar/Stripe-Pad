<?php

/**
 * Package Name: Stripe Pad - Super Admin
 * File Description: Index.php (Admin)
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
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

# Load Environment
include_once  dirname(__FILE__) . '/../core/sp-load.php'; // 
include_once CORE_PATH . 'sp-core.php';

# Load Custom App
include_once dirname(__FILE__) . "/Admin.php";

# Sanitize 'p' parameter to prevent injection
# $actionName = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
# Deprecated PHP 8

$actionName = isset($_GET['p']) ? sanitize($_GET['p']) :  'index';


# Include admin/Admin.php that extends core/sp-core.php
$Admin = new Admin();
$Admin->init();
