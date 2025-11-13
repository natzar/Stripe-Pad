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


        # Block aggresive bots
        if (BOT_BLOCKER) {
            // $error_msg = "Possible BOT detected - " . implode("<br>", $t);
            // include "app/themes/" . APP_THEME . "/error.php";
            // die();
            //  $Guardian = new BotBlocker(); // IT will die in case bot is detected
        }
        $this->log = log::singleton();
        $this->params = get_parameters();
        $this->view = new View();
        $this->view->set_isAuthenticated($this->isAuthenticated());
        $this->isAuthenticated = $this->isAuthenticated();
        $this->isSuperadmin = isset($_SESSION['user']) and isset($_SESSION['user']['group']) and $_SESSION['user']['group'] == "superadmin";

        # Maintenance Mode
        if ($this->is_maintenance_enabled() && $_SERVER['REQUEST_URI'] != "/maintenance") {
            header("Location: /maintenance");
            exit;
        }
    }

    /**
     * Method init
     *
     * @return void
     */
    public function init()
    {

        # Sanitize 'p' parameter to prevent injection
        # $actionName = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
        # Deprecated PHP 8

        $actionName = isset($_GET['p']) ? sanitize($_GET['p']) :  'index';

        # Url = Method = Does the url exist?
        if (!method_exists($this, $actionName)) {
            $this->error404();
        } else {
            $this->$actionName();
        }
    }
    # Default app home page
    public function index()
    {
        # check if user is authenticated
        // if ($this->isAuthenticated) {
        //     # Load Dashboard (main-first screen of your app for logged users)
        //     if ($this->isSuperadmin) {
        //         $this->superadmin();
        //     } else {
        //         $this->app();
        //     }
        // } else {
        //     # Redirect to login if not authenticated
        //     $this->home();
        // }
        // if ($this->isAuthenticated) {

        //     # Do here any logic your app needs
        //     # Include any library you need
        //     # $model = new model(); /models files are already available

        //     #example 
        //     $user = new usersModel();

        //     $this->view->show('dashboard.php', array(

        //         "user" => $_SESSION['user'],
        //         "example" => "Lorem ipsum sit dolor",
        //         "date" => Date("Y-m-d")
        //     ));
        // } else {
        //     $this->login();
        // }
        echo "Stripe Pad Index - nothing here. Go to /login or /signup";
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
     * Method signup
     *
     * @return void
     */
    public function signup()
    {

        $this->view->show("signup.php", array(), true);
    }

    /**
     * Method signup
     *
     * @return void
     */
    public function paywall()
    {

        $this->view->show("signup-paywall.php", array(), true);
    }


    /**
     * Method upgrade
     *
     * @return void
     */
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
            header("location: " . APP_URL);
            exit();
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
        // Al renderizar el login GET
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $this->view->show("login.php", $data, true);
    }

    /**
     * Default User's Profile
     * profile
     *
     * @return void
     */
    public function profile()
    {
        assert($_SESSION['user']);
        $users = new usersModel();
        $invoices = new invoicesModel();
        $data = array(
            "user" => $users->getById($_SESSION['user']['usersId']),
            "invoices" => $invoices->getByAccountsId($_SESSION['account']['accountsId']),
            "SEO_TITLE" => "Preferencias",
            "SEO_DESCRIPTION" => _("Manage your preferences and settings"),
            "breadcrumb" => array(array("label" => "Preferencias", "url" => "profile")),
        );

        $this->view->show("profile.php", $data, true);
    }

    /**
     * Account & Billing view
     */
    public function account()
    {
        assert($_SESSION['user']);
        $users = new usersModel();
        $invoices = new invoicesModel();
        $subscriptions = new subscriptionsModel();

        $usersId = $_SESSION['user']['usersId'];
        $accountsId = $_SESSION['account']['accountsId'];
        $data = array(
            "user" => $users->getById($usersId),
            "invoices" => $invoices->getByAccountsId($accountsId),
            "subscriptions" => $subscriptions->getByAccountsId($accountsId),
            "SEO_TITLE" => _("Account & Billing"),
            "SEO_DESCRIPTION" => _("Manage memberships, invoices, and payment preferences."),
            "breadcrumb" => array(array("label" => _("Account Settings"), "url" => "account")),
        );

        $this->view->show("account.php", $data, true);
    }

    /**
     * forgotPassword
     *
     * @return void
     */
    public function forgotPassword()
    {
        $data = array();
        $this->view->show("forgot-password.php", $data, true);
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
        if (strpos($email, "stripepad.com") > -1) header("location: " . APP_URL . "login");

        $users = new usersModel();
        # Make it friendly, if no db connection die with error
        if (is_null($users->db)) die("Stripe Pad: You need to set a database connection to make login/signup work");

        $users->sendResetPassword($email);
        $_SESSION['alerts'][] = _("New password sent to your inbox");
        header("location: " . APP_URL . "login");
    }


    /**
     * actionLogin
     *
     * @return void
     */
    public function actionLogin()
    {
        log::system("Login action called " . $this->params['email']);

        if (!isset($this->params['email']) or empty($this->params['email'])) die();

        if (!isset($this->params['password']) or empty($this->params['password'])) die();

        $users = new usersModel();

        // CSRF
        if (empty($this->params['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $this->params['csrf_token'])) {
            $_SESSION['errors'][] = _('Invalid request, try again');
            header("location: " . APP_URL . "login");
            return;
        }

        // 4) Rate-limit (IP + email)
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        // $key = "login_" . hash('sha256', strtolower($this->params['email']) . '|' . $ip);
        // $_SESSION[$key] = $_SESSION[$key] ?? ['count' => 0, 'until' => 0];

        // if (time() < $_SESSION[$key]['until']) {
        //     $_SESSION['errors'][] = "Demasiados intentos. Espera un poco y vuelve a intentarlo.";
        //     header("location: " . APP_URL . "login");
        //     return;
        // }

        # Login flow
        log::system("Login attempt for " . $this->params['email'] . " from IP " . $ip);

        if (!isset($_SESSION['login_attemp'])) $_SESSION['login_attemp'] = 0;

        $_SESSION['login_attemp']++;

        if ($_SESSION['login_attemp'] > 5) {
            $_SESSION['errors'][] = "Too many intents.";

            header("location: " . LANDING_URL);
        } else {
            $user = $users->find($this->params['email']);
            //     $pass =  password_hash($this->params['password'], PASSWORD_DEFAULT);

            if (!empty($user) and password_verify($this->params['password'], $user['password'])) {
                $this->createSession($user);
                $users->saveLastLogin($user['usersId']);

                log::system("Successful login for " . $this->params['email'] . " (" . $user['group'] . ") from IP " . $ip);

                if ($user['group'] == 'superadmin') {
                    header("location: " . ADMIN_URL . "dashboard");
                } else {
                    header("location: " . APP_URL);
                }
            } else {
                $_SESSION['errors'][] = "User or password not correct";
                log::system("Failed login for " . $this->params['email'] . " from IP " . $ip);


                header("location: " . LANDING_URL . "login");
            }
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

        # Make it friendly, if no db connection die with error
        if (is_null($users->db)) die("Stripe Pad: You need to set a database connection to make login/signup work");

        # shitty nonce
        if (!empty($_POST['hney'])) die();

        // not included by default : find a better way
        include_once CORE_PATH . "Classes/sp-emailvalidator.php";
        $emailValidator = new emailValidator();

        // verify valid email
        if (empty($this->params['email']) or !$emailValidator->isValid($this->params['email'])) {
            $_SESSION['errors'][] = _('Email not valid');
            header("location: " . LANDING_URL . "/signup");
            return;
        }

        if (isset($this->params['passwordConfirm']) and $this->params['password'] != $this->params['passwordConfirm']) {
            $_SESSION['errors'][] = "Passwords no coinciden";
            header("location: " . LANDING_URL . "/signup");
            return;
        }

        if (isset($this->params['privacy']) and empty($this->params['privacy'])) {
            $_SESSION['errors'][] = "You have to accept privacy policy";
            header("location: " . LANDING_URL . "/signup");
            return;
        }

        $user = $users->find($this->params['email']);
        if (empty($user)) {
            $user = $users->create($this->params['email']);
            $_SESSION['errors'][] = "The password of your account is in your email inbox";
            header("location: " . LANDING_URL . "/login");
        } else {
            $_SESSION['errors'][] = "The user already exists, please login";
            header("location: " . LANDING_URL . "/login");
        }
    }
    private function createSession($user, $saveLogin = true)
    {
        $_SESSION[APP_NAME] = 1;
        $_SESSION['login_attemp'] = 0;
        $_SESSION['user'] = $user;
        if ($user['group'] == 'superadmin') {
            $_SESSION['is_superadmin'] = true;
        }
        return true;
    }

    /**
     * isAuthenticated
     *
     * @return boolean
     */
    public function isAuthenticated()
    {

        $is_logged = !empty($_SESSION['user']) and isset($_SESSION[APP_NAME]);
        return $is_logged;
    }

    /**
     * actionLogout
     *
     * @return void
     */
    public function actionLogout()
    {
        session_destroy();
        header("location: " . LANDING_URL);
        exit(0);
    }


    /**
     * stripe_portal
     *
     * @return void
     */
    public function stripe_portal()
    {


        if (empty($_SESSION['account']['stripe_customer_id'])) {

            $_SESSION['errors'][] = "NOT_ENABLED, NO PURCHASE YET;";
            header("location: " . APP_URL . "/dashboard");
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
                header("location: " . APP_URL . "/dashboard");
            }
        }
    }

    public function invoice_pdf()
    {

        $invoices = new invoicesModel();
        $invoice = $invoices->getById($this->params['m']);
        if (empty($invoice) or $invoice['accountsId'] != $_SESSION['account']['accountsId']) {
            die("Invoice not found");
        }
        header("location: " . $invoices->pdf($this->params['m']));
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
        $surl = APP_URL . 'stripe_success';
        $curl = APP_URL . 'stripe_cancelled';


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
        $this->view->show('settings.php', []);
    }

    // Method to display the maintenance page
    public function maintenance()
    {
        $this->view->show('maintenance.php', []);
    }

    // Check if maintenance mode is active by checking the file existence
    public function is_maintenance_enabled()
    {
        return file_exists(ROOT_PATH . '.maintenance');
    }







    /* In case a method does not exist */
    public function error404()
    {
        //$this->path = APP_PATH . "views/";

        log::traffic('[404] ' . getCurrentUrl());
        header('HTTP/1.0 404 Not Found');
        $SEO_TITLE = "404 Not Found";
        $SEO_DESCRIPTION = "The page you are looking for does not exist.";
        $SEO_KEYWORDS = "404, not found, error";
        $HOOK_JS = '';

        $this->view->show('404.php', array());
    }

    # ¿?
    public function deadbeef()
    {
        die('deadbeef? #000000');
    }

    # SOCIAL LOGIN

    public function auth()
    {
        $social = new SocialLogin();
        if ($this->params['m'] == "callback") {
            $provider = $this->params['a'];
            $social->handleProviderCallback($provider);
        } else {
            $provider = $this->params['m'];
            $social->redirectToProvider($provider);
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
    public function bot_detected()
    {
        log::system("Bot detected: " . $_SERVER['REMOTE_ADDR']);

        $_SESSION['bot'] = true;
    }
}
