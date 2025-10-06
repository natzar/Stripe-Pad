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


/**
 * Your Custom App
 * @ this controller by default extends StripePadController located at core/sp-core.php
 * 
 * Each method of this class can be accessed from //your-domain/{method}
 * $this->params contains all get/post params
 * App.php is just the main and solo controller of your custom app. 
 * Create service end points or just urls for your public and private pages. 
 * Old skool, php sevver side rendering, as less javascript as possible.
 */


/* Define here landing (public) and app (private, registered users only) routes as class methods */

class StripePad_Landing extends StripePadController
{
    var $isAuthenticated = false;

    public function __construct()
    {
        // This calls the parent constructor (important)
        //
        // Add a method for each route you want to create
        // Each method of this class can be accessed from //your-domain/{method}

        parent::__construct(); // !important

        # Some default values for views
        $this->view->set_views_path(LANDING_PATH . "views/");
        $this->view->set_isAuthenticated(false);
    }

    /**
     * index
     * default main method
     * @return void
     */
    public function index()
    {
        # Redirect to login if not authenticated, or to home or landing
        $this->home();
    }



    /**
     * home
     * Main Public Website
     * @return void
     */
    public function home()
    {
        $this->view->show("demo/homepage.php", array());
    }
    public function contact()
    {
        $data = array(
            "SEO_TITLE" => ""
        );
        $this->view->show("custom/contact_sales.php", $data);
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
        $this->view->show('common/privacy.php', array("variable" => "value", "something" => "you want to send to the view"));
    }
    public function pricing()
    {
        $this->view->show('landing/pricing.php', array());
    }
    public function faq()
    {
        $this->view->show('landing/faq.php', array());
    }
    public function use_cases()
    {
        $this->blog();
        //		$this->view->show('common/privacy.php', array());
    }
    public function impressum()
    {
        $data = array();
        $this->view->show("common/impressum.php", $data);
    }
}
