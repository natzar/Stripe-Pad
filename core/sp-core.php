<?php

/**
 * StripePad
 */
class StripePad
{
    var $params;
    var $view;
    var $isAuthenticated;
    var $version = '0.1';


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

        $this->params = array();
        $filter = FILTER_SANITIZE_STRING;

        // Check if the key exists in the $_GET array
        if (isset($_GET)) {
            // Return the sanitized value using a specified filter
            // Default filter is FILTER_SANITIZE_STRING which removes tags and encode special characters
            foreach ($_GET as $k => $v) {
                if (filter_input(INPUT_GET, $k, $filter)) {
                    $this->params[$k] = $v;
                }
            }
        }
        if (isset($_POST)) {
            // Return the sanitized value using a specified filter
            // Default filter is FILTER_SANITIZE_STRING which removes tags and encode special characters
            foreach ($_POST as $k => $v) {
                if (filter_input(INPUT_POST, $k, $filter)) {
                    $this->params[$k] = $v;
                }
            }
        }

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

        # Login with Google
        // $client = new Google_Client();
        // $client->setClientId('YOUR_CLIENT_ID');
        // $client->setClientSecret('YOUR_CLIENT_SECRET');
        // $client->setRedirectUri('YOUR_REDIRECT_URI');
        // $client->addScope("email");
        // $client->addScope("profile");

        // $authUrl = $client->createAuthUrl();
        // echo "<a href='$authUrl'>Login with Google</a>";

        $this->view->show("user/login.php", $data, true);
    }
    public function profile()
    {
        $data = array();
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
        header("location: " . APP_DOMAIN . "forgotPassword?success=1");
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

        include CORE_PATH . "classes/EmailValidator.php";
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
        if ($saveLogin) $users->saveLastLogin($user);
    }


    public function GoogleLoginCallback()
    {
        if (isset($_GET['code'])) {
            // $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            // $_SESSION['access_token'] = $token;

            // // Get user info
            // $google_service = new Google_Service_Oauth2($client);
            // $data = $google_service->userinfo->get();

            // // Now you have $data which contains user info. You can save this info in your database.
            // // For demonstration purposes, we're just printing it.
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
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
}
