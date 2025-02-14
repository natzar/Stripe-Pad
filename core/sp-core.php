<?php

use StripePad\Exceptions\PermissionsException;

/**
 * Package Name: Stripe Pad
 * File Description: Main Controller
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

/**
 * StripePad
 */



class StripePadController
{
    var $params;
    var $view;
    var $isAuthenticated = false;
    var $isSuperadmin = false;
    var $log;

    public function __construct()
    {
        // Initialize session variables if not already set
        if (!isset($_SESSION['errors'])) $_SESSION['errors'] = array();
        if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = array();

        # Maintenance Mode
        if ($this->is_maintenance_enabled() && $_SERVER['REQUEST_URI'] != "/maintenance") {
            header("Location: /maintenance");
            exit;
        }
        # Block aggresive bots
        if (BOT_BLOCKER && $t = requestBlocker()) {
            $error_msg = "Possible BOT detected - " . implode("<br>", $t);
            include "app/themes/" . APP_THEME . "/error.php";
            die();
        }
        $this->log = log::singleton();
        $this->params = get_parameters();
        $this->view = new View();
        $this->view->isAuthenticated = $this->isAuthenticated = $this->isAuthenticated();
        $this->isSuperadmin = isset($_SESSION['user']) and isset($_SESSION['user']['group']) and $_SESSION['user']['group'] == "superadmin";
    }

    # Default app home page
    public function index()
    {
        # check if user is authenticated
        if ($this->isAuthenticated) {
            # Load Dashboard (main-first screen of your app for logged users)
            if ($this->isSuperadmin) {
                $this->superadmin();
            } else {
                $this->app();
            }
        } else {
            # Redirect to login if not authenticated
            $this->home();
        }
    }

    public function home()
    {
        echo 'default home, overwrite public function home.php in App.php';
    }

    public function comingsoon()
    {
        $this->view->show("common/coming-soon.php", array(), true);
    }
    /**
     * Blog
     * Manages general blog view + post (1) view
     * @return void
     */
    public function blog()
    {
        $blog = new blogModel();
        if (!empty($this->params['m'])): // there is a slug = there is a selected post 
            $slug = $this->params['m'];

            $data = $blog->getBySlug($slug);
            $data['SEO_TITLE'] = $data['title'] . " - " . APP_NAME;
            $data['SEO_DESCRIPTION'] = truncate(strip_tags($data['body']));
            $this->view->show('blog/post.php', $data);
        else: // show all

            $data = array("items" => $blog->getAll());
            $this->view->show('blog/index.php', $data);
        endif;
    }

    /**
     * App: This method will be overwritten by app/App.php
     *
     * @return void
     */
    public function app()
    {
        if ($this->isAuthenticated) {

            # Do here any logic your app needs
            # Include any library you need
            # $model = new model(); /models files are already available

            #example 
            $user = new usersModel();

            $this->view->show('dashboard.php', array(

                "user" => $_SESSION['user'],
                "example" => "Lorem ipsum sit dolor",
                "date" => Date("Y-m-d")
            ));
        } else {
            $this->login();
        }
    }


    public function signup()
    {
        if ($this->isAuthenticated) {
            return $this->app();
        }
        $this->view->show("user/signup.php", array(), true);
    }

    public function upgrade()
    {
        if (!$this->isAuthenticated) {
            throw new PermissionsException("You need to be logged in");
        }
        $products = new productsModel();
        $data = array(
            "products" => $products->getAll()

        );

        $this->view->show('user/upgrade.php', $data);
    }

    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        $data = array();

        if ($this->isAuthenticated) {
            return $this->app();
        }
        # Login function
        if (!empty(GOOGLE_CLIENT_ID)) {
            # Login with Google
            $client = new Google_Client();
            $client->setClientId(GOOGLE_CLIENT_ID);
            $client->setClientSecret(GOOGLE_CLIENT_SECRET);
            $client->setRedirectUri(GOOGLE_REDIRECT_URI);
            $client->addScope("email");
            $client->addScope("profile");

            $data['google_auth_url'] = $client->createAuthUrl();
        }
        $this->view->show("user/login.php", $data, true);
    }

    /**
     * forgotPassword
     *
     * @return void
     */
    public function forgotPassword()
    {
        $data = array();
        $this->view->show("user/forgot-password.php", $data, true);
    }

    /**
     * actionRecoverPassword
     *
     * @return void
     */
    public function actionRecoverPassword()
    {
        if (!isset($this->params['email']) or empty($this->params['email'])) die();
        $email = $this->params['email'];
        # Demo
        if (strpos($email, "stripepad.com") > -1) header("location: " . APP_DOMAIN . "login");

        $users = new usersModel();
        $users->sendResetPassword($email);
        $_SESSION['alerts'][] = _("New password sent to your inbox");
        header("location: " . APP_DOMAIN . "login");
    }



    /**
     * actionLogin
     *
     * @return void
     */
    public function actionLogin()
    {
        if (!isset($this->params['email']) or empty($this->params['email'])) die();
        if (!isset($this->params['password']) or empty($this->params['password'])) die();

        $users = new usersModel();
        if (!isset($_SESSION['login_attemp'])) $_SESSION['login_attemp'] = 1;
        $_SESSION['login_attemp'] = 1;

        if ($_SESSION['login_attemp'] > 4) {
            $_SESSION['errors'][] = "Too many intents.";

            header("location: " . APP_DOMAIN . "/login");
        } else {
            $user = $users->find($this->params['email']);
            $pass =  hash('sha256', $this->params['password']);

            if (!empty($user) and $user['password'] == $pass) {
                $this->createSession($user);
                header("location: " . APP_DOMAIN);
                exit();
            }

            $_SESSION['login_attemp']++;
            $_SESSION['errors'][] = "User or password not correct";

            header("location: " . APP_DOMAIN . "/login");
        }
    }
    /**
     * actionSignup
     *
     * @return void
     */
    public function actionSignup()
    {

        $users = new usersModel();

        if (!empty($_POST['hney'])) die();

        // not included by default : find a better way
        include_once CORE_PATH . "Classes/EmailValidator.php";
        $emailValidator = new emailValidator();

        // verify valid email
        if (empty($this->params['email']) or !$emailValidator->isValid($this->params['email'])) {
            $_SESSION['errors'][] = _('Email not valid');
            header("location: " . APP_DOMAIN . "/signup");
            return;
        }

        if (isset($this->params['passwordConfirm']) and $this->params['password'] != $this->params['passwordConfirm']) {
            $_SESSION['errors'][] = "Passwords no coinciden";
            header("location: " . APP_DOMAIN . "/signup");
            return;
        }

        if (isset($this->params['privacy']) and empty($this->params['privacy'])) {
            $_SESSION['errors'][] = "You have to accept privacy policy";
            header("location: " . APP_DOMAIN . "/signup");
            return;
        }

        $user = $users->find($this->params['email']);
        if (empty($user)) {
            $user = $users->create($this->params['email']);
            $_SESSION['errors'][] = "The password of your account is in your email inbox";
            header("location: " . APP_DOMAIN . "/login");
        } else {
            $_SESSION['errors'][] = "The user already exists, please login";
            header("location: " . APP_DOMAIN . "/login");
        }
    }
    private function createSession($user, $saveLogin = true)
    {
        $_SESSION['app_' . APP_NAME . '_logged_in'] = 1;
        $_SESSION['login_attemp'] = 0;
        $_SESSION['user'] = $user;
        $_SESSION['HTTP_USER_AGENT'] = hash('sha256', ($_SERVER['HTTP_USER_AGENT'] . $user['email']));
        $users = new usersModel();
        if ($saveLogin) $users->saveLastLogin($user['usersId']);
    }


    public function GoogleLoginCallback()
    {
        if (isset($_GET['code'])) {
            $client = new Google_Client();
            $client->setClientId(GOOGLE_CLIENT_ID);
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access_token'] = $token;

            // Get user info
            $google_service = new Google_Service_Oauth2($client);
            $data = $google_service->userinfo->get();

            // Now you have $data which contains user info. You can save this info in your database.
            // For demonstration purposes, we're just printing it.
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
    }

    /**
     * isAuthenticated
     *
     * @return boolean
     */
    protected function isAuthenticated()
    {
        return !empty($_SESSION['user']) and isset($_SESSION['app_' . APP_NAME . '_logged_in']);
    }

    /**
     * actionLogout
     *
     * @return void
     */
    public function actionLogout()
    {
        session_destroy();
        header("location: " . APP_DOMAIN);
        exit(0);
    }

    /**
     * actionStripeSync
     *
     * @return void
     */
    public function actionStripeSync()
    {
        $stripe = new Stripe();
        $stripe->syncStripeCustomers();
        $stripe->syncStripeSubscriptions();
        $stripe->syncStripeInvoices();
        $stripe->syncStripeProducts();
        $_SESSION['alerts'][] = _("Stripe Import Completed");

        // ~ Redirection
        $this->superadmin();
    }

    /**
     * stripe_portal
     *
     * @return void
     */
    public function stripe_portal()
    {


        if (empty($_SESSION['user']['stripe_customer_id'])) {

            $_SESSION['errors'][] = "NOT_ENABLED, NO PURCHASE YET;";
            header("location: " . APP_DOMAIN . "/dashboard");
        } else {
            \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
            //$stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);
            try {
                // Authenticate your user.
                $session = \Stripe\BillingPortal\Session::create([
                    'customer' => $_SESSION['user']['stripe_customer_id'],
                    'return_url' => 'https://xxxxx',
                ]);

                // Redirect to stripe portal
                header("Location: " . $session->url);
            } catch (Exception $e) {
                $_SESSION['errors'][] = $e->getMessage();
                header("location: " . APP_DOMAIN . "/dashboard");
            }
        }
    }

    /**
     * stripe_create_session // CHECKOUT!!
     *
     * @return void
     */
    public function stripe_create_session()
    {

        if (!$_POST) die("Stripe Pad - Stripe Token Service");

        \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);

        $stripe = new \Stripe\StripeClient(
            APP_STRIPE_SECRETKEY
        );

        $items = $_POST['items'];
        $user = isset($_POST['user']) ? $_POST['user'] : array();
        $product = isset($_POST['product']) ? $_POST['product'] : array();

        #TODO: multiple products
        $product = $product[0];
        $surl = APP_DOMAIN . 'stripe_success';
        $curl = APP_DOMAIN . 'stripe_cancelled';


        if (isset($product['stripe_price_id'])) {
            $line_items = array(array(
                "price" => $product['stripe_price_id'],
                "quantity" => 1,
                // "tax_rates" => array(APP_STRIPE_TAX_RATE)

            ));
        } else {
            $line_items = $items;
            $line_items[0]['tax_rates'] = array(APP_STRIPE_TAX_RATE);
            $amount = floatval($line_items[0]['amount']);
            $line_items[0]['amount'] = number_format($amount, 2, "", "");

            $product['name'] = $items[0]['name'];
            $product['amount'] = $items[0]['amount'];
            $product['description'] = "No description";
            $product['productsId'] = -1;
            $product['stripe_price_id'] = -1;
        }

        $tax = $product['amount'] * 0.21;
        $total = $product['amount'] + $tax;
        $metadata = array("product_name" => $product['name'], "product_description" => $product['description'], "product_id" => $product['productsId'], "price" => $product['stripe_price_id'], "product_price" => $product['amount'], "subtotal" => $product['amount'],  "quantity" => 1, "tax" => $tax, "total" => $total);


        $params = [
            'billing_address_collection' => 'required',
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'success_url' => $surl,
            'allow_promotion_codes' => true,

            'tax_id_collection' => [
                'enabled' => true,

            ],
            'mode' => 'payment',
            'cancel_url' => $curl,
            'payment_intent_data' => array("metadata" => $metadata)

        ];

        if (isset($product['product_stripe_id'])) {
            $params['automatic_tax'] = array('enabled' => true);
        }

        if (!empty($product['interval'])) {
            $params['mode'] = 'subscription';
            $params['payment_method_types'] = ['card'];
            $params['subscription_data'] = $params['payment_intent_data'];
            unset($params['payment_intent_data']);
        }

        $session = \Stripe\Checkout\Session::create($params);
        echo json_encode($session);
    }


    public function checkout()
    {
        $data = ['params' => $this->params];
        $product = $this->params['m'];
        $client = $this->params['a'];
        $data['user'] = null;
        $data['cart'] = null;
        $data['product'] = null;
        $users = new usersModel();
        $products = new productsModel();
        //     $customers = new customersModel();

        if (isset($_GET['title']) and isset($_GET['amount'])) {
            $data['cart'] = [[
                'name' => $this->params['title'],
                'amount' => $this->params['amount'],
                'currency' => 'eur',
                'quantity' => 1,
            ]];

            $data['payment_type'] = 'free';
        } elseif (!empty($product) or !empty($client)) {
            $data['cart'] = $products->getById($product);
            $data['user'] = $users->find($client);
            $data['product'] = $products->getById($product);
            $data['payment_type'] = 'catalog';
        } else {
            $data['store'] = $products->getAll();
            $this->view->show('shop.php', $data, false);
            exit();
        }

        $this->view->show('stripe/checkout.php', $data, false);
    }


    public function reports()
    {
        $data = array();
        $this->view->show('superadmin/reports.php', $data);
    }
    public function system()
    {
        $data = array();
        $this->view->show('superadmin/system.php', $data);
    }

    /* Modules */

    // Method to handle form submission
    public function submit_newsletter_signup()
    {
        $email = $_POST['email'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Handle invalid email
            echo "Please enter a valid email address.";
            return;
        }

        // Assuming NewsletterModel extends modelBase and handles DB
        $newsletterModel = new NewsletterModel();
        $newsletterModel->addSubscriber($email);

        $_SESSION['alerts'][] = "Thank you for subscribing!";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    // App.php
    public function settings()
    {
        $this->view->show('user/settings.php', []);
    }

    // Method to display the maintenance page
    public function maintenance()
    {
        $this->view->show('common/maintenance.php', []);
    }

    // Check if maintenance mode is active by checking the file existence
    public function is_maintenance_enabled()
    {
        return file_exists(ROOT_PATH . '.maintenance');
    }






    /* SuperAdmin magic functions: Forms creation and Rows Inserting and updating. One day someone will come.
    ---------------------------------------*/

    public function superadmin()
    {
        if (!$this->isSuperadmin) {
            throw new StripePad\Exceptions\PermissionsException('Not superadmin');
        }
        $data = array(
            "log" => $this->log->getAll(),
            "counters" => $this->log->get_counters(),
            "online_visitors" => $this->log->get_online_visitors_count()
        );
        $this->view->show('superadmin/dashboard.php', $data);
    }

    /**
     * table
     * Part of Orm, it generates a table 
     * @return void
     */
    public function table()
    {
        if (!$this->isSuperadmin) {
            throw new StripePad\Exceptions\PermissionsException('Not superadmin');
        }

        $items = new Orm();

        $table = $this->params['m'];

        $itemsFinal = null;
        $items_head = $items->getItemsHead($table);
        $fields = $items->getTableAttribute($table, 'fields');
        $user_group = $_SESSION['user']['group'];

        if (isset($this->params['i']) and in_array($this->params['i'], $fields)) {
            $params = ['table' => $table, $this->params['i'] => $this->params['z']];
            $itemsFinal = $items->search($params);
        } else {
            $itemsFinal = $items->getAll($table);
        }

        $data = [/* "table_label" => $table_label, */
            'title' => "BackOffice | $table",
            'items_head' => $items_head,
            'items' => $itemsFinal,
            'HOOK_JS' => $items->table_js($table),
            'table' => $table,
            'table_label' => $items->getTableAttribute($table, 'table_label'),
            'notification' => isset($this->params['i']) and $this->params['i'] != -1 ? 'Se ha guardado correctamente' : '',
        ];

        $_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
        $this->view->show('superadmin/table.php', $data);
    }


    public function form()
    {
        if (!$this->isSuperadmin) {
            throw new StripePad\Exceptions\PermissionsException('Not superadmin');
        }

        $table = isset($this->params['m']) ? $this->params['m'] : -1;
        $rid = isset($this->params['a']) ? $this->params['a'] : -1;
        $op = isset($this->params['i']) ? $this->params['i'] : '';
        $form = new Orm();
        $data = $form->generateForm($table, $rid, $op);

        $this->view->show('superadmin/form.php', $data);
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        if (!$this->isSuperadmin) {
            throw new StripePad\Exceptions\PermissionsException('Not superadmin');
        }
        $orm = new Orm();
        $rid = $this->params['rid'];
        $table = $this->params['table'];

        $return_url = $_SESSION['return_url'];

        if (isset($this->params['return_url']) and -1 != $this->params['return_url']) {
            $return_url = $this->params['return_url'];
        }

        if ($rid == -1) {
            $id = $orm->add($table, $this->params);
        } else {
            $orm->edit($table, $rid, $this->params);
        }

        header('location: ' . $return_url);
    }
    # ¿?
    public function deadbeef(){
        die('deadbeef? #000000');
    }
    
    # SOCIAL LOGIN

    // Redirect to provider for authentication
    public function redirectToProvider($provider)
    {
        $client = $this->getOAuthClient($provider);
        header('Location: ' . $client->getAuthorizationUrl());
        exit;
    }

    // Handle provider callback
    public function handleProviderCallback($provider)
    {
        try {
            $client = $this->getOAuthClient($provider);
            $token = $client->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
            $userDetails = $client->getResourceOwner($token);

            // Assuming UserModel handles database interactions
            $userModel = new UserModel();
            $user = $userModel->findOrCreateUser($userDetails, $provider);
            // Login the user
            $_SESSION['user_id'] = $user['id'];
            header('Location: /dashboard');
        } catch (\Exception $e) {
            $_SESSION['errors'][] = "Failed to authenticate with $provider. Please try again.";
            header('Location: /login');
        }
        exit;
    }

    private function getOAuthClient($provider)
    {
        switch ($provider) {
            case 'google':
                return new \League\OAuth2\Client\Provider\Google([
                    'clientId'          => 'your-google-client-id',
                    'clientSecret'      => 'your-google-client-secret',
                    'redirectUri'       => 'https://your-domain.com/handleProviderCallback/google',
                ]);
            case 'facebook':
                return new \League\OAuth2\Client\Provider\Facebook([
                    'clientId'          => 'your-facebook-client-id',
                    'clientSecret'      => 'your-facebook-client-secret',
                    'redirectUri'       => 'https://your-domain.com/handleProviderCallback/facebook',
                    'graphApiVersion'   => 'v2.10',
                ]);
                // Add more providers as needed
        }
    }
    
    // Stripe 

    public function stripe_success()
    {
        $data = array();
        $this->view->show("stripe/success-checkout.php", $data, true);
    }

    public function stripe_cancelled()
    {
        $data = array();

        $this->view->show("stripe/cancelled-checkout.php", $data, true);
    }
}
