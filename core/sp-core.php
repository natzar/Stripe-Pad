<?php

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
class StripePad
{
    var $params;
    var $view;
    var $isAuthenticated;
    var $isSuperadmin;
    var $version = '0.1';
    var $log;

    public function __construct()
    {
        // Initialize session variables if not already set
        if (!isset($_SESSION['errors'])) $_SESSION['errors'] = array();
        if (!isset($_SESSION['alerts'])) $_SESSION['alerts'] = array();

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
    }

    # Default app home page
    public function index()
    {
        # check if user is authenticated
        if ($this->isAuthenticated) {
            # Load Dashboard (main-first screen of your app for logged users)
            $this->app();
        } else {
            # Redirect to login if not authenticated
            $this->home();
        }
    }

    public function home()
    {
        echo 'default home, overwrite public function home.php in App.php';
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
        $this->view->show("user/signup.php", array(), true);
    }

    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        $data = array();

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
    public function profile()
    {
        $users = new usersModel();

        $data = array(
            "user" => $users->getById($_SESSION['user']['usersId'])
        );

        $this->view->show("user/profile.php", $data, true);
    }
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
        $email = $this->params['email'];
        $users = new usersModel();
        $users->sendResetPassword($email);
        $_SESSION['alerts'][] = "New password sent to your inbox";
        header("location: " . APP_DOMAIN . "login");
    }



    /**
     * actionLogin
     *
     * @return void
     */
    public function actionLogin()
    {

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

        if (!empty($_POST['huny'])) die();

        // not included by default : find a better way
        include_once CORE_PATH . "Classes/EmailValidator.php";
        $emailValidator = new emailValidator();

        // verify valid email
        if (!$emailValidator->isValid($this->params['email'])) {
            $_SESSION['errors'][] = ERR_EMAIL_NOT_VALID;
            header("location: " . APP_DOMAIN . "/signup");
            return;
        }

        if (empty($this->params['email'])) {
            $_SESSION['errors'][] = ERR_EMAIL_NOT_BLANK;
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
    protected function isAuthenticated()
    {

        return !empty($_SESSION['user']) and isset($_SESSION['app_' . APP_NAME . '_logged_in']);
    }

    public function actionLogout()
    {

        session_destroy();

        header("location: " . APP_DOMAIN);
        exit(0);
    }

    public function actionStripeSync()
    {
        $stripe = new StripePad_Stripe();
        $stripe->syncStripeCustomers();
        $stripe->syncStripeSubscriptions();
        $stripe->syncStripeInvoices();
        $stripe->syncStripeProducts();
        $_SESSION['alerts'][] = "Stripe Import Completed";
    }
    public function stripePortal()
    {
        if (empty($_SESSION['user']['stripe_customer_id'])):

            $_SESSION['errors'][] = "This section is not enabled for your user";
            header("location: " . APP_DOMAIN . "/dashboard");

        else:



            \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
            $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);

            try {
                // Authenticate your user.
                $session = \Stripe\BillingPortal\Session::create([
                    'customer' => $_SESSION['user']['stripe_customer_id'],
                    'return_url' => 'https://app.phpninja.net/dashboard',
                ]);
                header("Location: " . $session->url);
            } catch (Exception $e) {
                $_SESSION['errors'][] = $e->getMessage();
                header("location: " . APP_DOMAIN . "/dashboard");
            }


        // Redirect to the customer portal.


        endif;
    }
    /**
     * account
     *
     * @return void
     */
    public function account()
    {


        if (empty($_SESSION['user']['stripe_customer_id'])):

            $_SESSION['errors'][] = "NOT_ENABLED;";
            header("location: " . APP_DOMAIN . "/dashboard");

        else:


            require_once(CORE_PATH . 'vendor/stripe-php-7.77.0/init.php');
            \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
            $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);

            try {
                // Authenticate your user.
                $session = \Stripe\BillingPortal\Session::create([
                    'customer' => $_SESSION['user']['stripe_customer_id'],
                    'return_url' => 'https://xxxxx',
                ]);
                header("Location: " . $session->url);
            } catch (Exception $e) {
                $_SESSION['errors'][] = $e->getMessage();
                header("location: " . APP_DOMAIN . "/dashboard");
            }


        // Redirect to the customer portal.


        endif;
    }

    /**
     * stripe_create_session
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
        $customer = isset($_POST['customer']) ? $_POST['customer'] : array();
        $product = isset($_POST['product']) ? $_POST['product'] : array();

        $surl = 'https://';
        $curl = 'https://';


        if (isset($product['stripe_price_id'])) {
            $line_items = array(array(
                "price" => $product['stripe_price_id'],
                "quantity" => 1,
                "tax_rates" => array(APP_STRIPE_TAX_RATE)

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
        $product = $this->params['a'];
        $client = $this->params['i'];
        $data['customer'] = null;
        $data['cart'] = null;
        $data['product'] = null;

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
            $data['cart'] = $products->getCart($product);
            $data['customer'] = $customers->getByCustomersId($client);
            $data['product'] = $products->getProduct($product);
            $data['payment_type'] = 'catalog';
        } else {
            $data['store'] = $products->getProducts();
            $this->view->show('shop.php', $data, false);
            exit();
        }

        $this->view->show('checkout.php', $data, false);
    }

    public function products()
    {
        assert($_SESSION['user']['group'] == 'superadmin');
        $products = new productsModel();

        $data = [
            'products' => $products->getAll(),
        ];
        $this->view->show('staff/products.php', $data);
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
    public function superadmin()
    {
        $data = array(
            "log" => $this->log->getAll()
        );
        $this->view->show('superadmin/dashboard.php', $data);
    }

    /* SuperAdmin magic functions: Forms creation and Rows Inserting and updating. One day someone will come.
    ---------------------------------------*/


    /**
     * table
     * Part of Orm, it generates a table 
     * @return void
     */
    public function table()
    {
        //  assert($this->isSuperadmin == true);        
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
        $table = isset($this->params['m']) ? $this->params['m'] : -1;
        $rid = isset($this->params['a']) ? $this->params['a'] : -1;
        $op = isset($this->params['i']) ? $this->params['i'] : '';
        $form = new Orm();
        $data = $form->generateForm($table, $rid, $op);

        $this->view->show('superadmin/form.php', $data);
    }

    public function update()
    {
        $orm = new Orm();
        $rid = $this->params['rid'];
        $table = $this->params['table'];
        $return_url = isset($this->params['return_url']) and -1 != $this->params['return_url'] ? $this->params['return_url'] : $_SESSION['return_url'];

        if ($rid == -1) {
            $id = $orm->add($table);
        } else {
            $orm->edit($table, $rid);
        }

        header('location: ' . $return_url);
    }
}
