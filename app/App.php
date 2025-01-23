<?php

/**
 *   Package Name: Stripe Pad
 *   File Description: Main Controller for custom app. Use this class to Override any core method /core/StripePad.php
 *   # Each method of this class can be accessed from //your-domain/app/{method}?params=params
 *   @author Beto Ayesa <beto.phpninja@gmail.com>
 *   @version 1.0.0
 *   @package StripePad
 *   @license GPL3
 *   @link https://github.com/natzar/stripe-pad
 * 
 *  
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   This file is part of Stripe Pad.
 *
 *   Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *   Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */


# Include Custom App helpers.php
if (file_exists(dirname(__FILE__) . "/helpers.php")) include_once(dirname(__FILE__) . "/helpers.php");

/**
 * Your Custom App
 * Default Routes for your SaaS
 */
class App extends StripePadController
{

	public function __construct()
	{
		parent::__construct(); // !important
	}

	/**
	 * index
	 * default main method
	 * @return void
	 */
	public function index()
	{
		# check if user is authenticated
		if ($this->isAuthenticated) {
			# Load Dashboard (main-first screen of your app for logged users)
			$this->app();
		} else {
			# Redirect to login if not authenticated, or to home or landing
			$this->home();
		}
	}

	/**
	 * app 
	 * (Private part entry point, registered users only)
	 * If a registered user logs in, this method will be called. MODIFY THIS FUNCTION.
	 * @return void
	 */
	public function app()
	{

		# Sample render of view with $data
		$data = array(
			"user" => $_SESSION['user'], # user->name, user->email, user->active (have paid 1/0)
			"date" => Date("Y-m-d"),
			"xyz" => 123
		);

		# show app/views/index.php passing $data
		$this->view->show('custom/index.php', $data);
	}

	/**
	 * home
	 * Main Public Website
	 * @return void
	 */
	public function home()
	{
		$data = array();
		$this->view->show("demo/homepage.php", $data);
	}


	/**
	 * Default User's Profile
	 * profile
	 *
	 * @return void
	 */
	public function profile()
	{
		$users = new usersModel();
		$invoices = new invoicesModel();
		$data = array(
			"user" => $users->getById($_SESSION['user']['usersId']),
			"invoices" => $invoices->getByUsersId($_SESSION['user']['usersId'])
		);

		$this->view->show("user/profile.php", $data, true);
	}

	/**
	 * tos
	 * Default terms of service url
	 * @return void
	 */
	public function tos()
	{
		$this->view->show('common/tos.php', array());
	}

	/**
	 * privacy
	 * Default privacy page
	 * @return void
	 */
	public function privacy()
	{
		$this->view->show('common/privacy.php', array());
	}
}
