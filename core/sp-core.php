<?php

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
        $customers = new customersModel();

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
    public function invoices()
    {
        assert($_SESSION['user']['group'] == 'superadmin');
        $invoices = new invoicesModel();

        $data = [
            'invoices' => $invoices->getLast100(),
        ];
        $this->view->show('staff/invoices.php', $data);
    }

    public function newInvoice()
    {
        assert($_SESSION['user']['group'] == 'superadmin');
        $invoices = new invoicesModel();

        $data = [
            'invoices' => $invoices->getLast100(),
        ];
        $this->view->show('invoice/invoice.php', $data);
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
    public function table()
    {
        //  assert($this->isSuperadmin == true);

        $items = new Orm();
        $table = isset($this->params['a']) and $this->params['a'] != -1 ? $this->params['a'] : '';
        $_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
        $itemsFinal = null;
        $items_head = $items->getItemsHead($table);
        $fields = $items->getTableAttribute($table, 'fields');
        $user_group = $_SESSION['user']['group'];

        if (in_array($this->params['i'], $fields)) {
            $params = ['table' => $table, $this->params['i'] => $this->params['z']];
            $itemsFinal = $items->search($params);
        } else {
        }

        if (is_null($itemsFinal)) {
            $itemsFinal = $items->getAll($table);
        }

        $data = [/* "table_label" => $table_label, */
            'title' => "BackOffice | $table",
            'items_head' => $items_head,
            'items' => $itemsFinal,
            'HOOK_JS' => $items->js($table),
            'table' => $table,
            'table_label' => $items->getTableAttribute($table, 'table_label'),
            'notification' => $this->params['i'] != -1 ? 'Se ha guardado correctamente' : '',
        ];

        $this->view->show('superadmin/table.php', $data);
    }

    /* Forms creation and Rows Inserting and updating
    ---------------------------------------*/

    public function form()
    {

        $logs = new logsModel();
        $form = new formModel();
        $table = $this->params['a'];
        $rid = $this->params['i'];
        $op = $this->params['m'];

        $form->getTableDescription();

        if ($rid == '') {
            $rid = -1;
        }
        $form_html = '';
        $raw = ($rid != -1) ? $form->getFormValues($table, $rid) : '';
        $SIDEDATA = new sidedataModel();

        for ($i = 0; $i < count($fields); ++$i) {
            if ($fields[$i] != $table . 'Id' and $fields[$i] != 'updated' and $fields[$i] != 'created') {
                $not_dev_fields = ['customersId', 'usersId', 'websId', 'prioritysId', 'name', 'customersstatusId', 'developersId', 'tickettypeId', 'minutes_estimated', 'description', 'test', 'informe_inicial', 'tasks', 'date_start', 'date_end'];
                $not_client_fields = ['usersId', 'developersId'];

                if ($table == 'tickets' and $rid != -1 and $_SESSION['user']['group'] == 'developersx' and in_array($fields[$i], $not_dev_fields)) {
                    $VALUE = isset($raw[$fields[$i]]) ? $raw[$fields[$i]] : '';
                    if (!in_array($fields[$i], ['ticketsstatusId', 'developersId', 'usersId', 'tickettypeId'])) {
                        $field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $VALUE, $table, $rid);
                        $form_html .= '<strong>' . ucfirst($fields_labels[$i]) . '</strong><br>';
                        if ($fields_types[$i] == 'tinymce') {
                            $form_html .= trim($field_aux->value) . '<br><br>';
                        } else {
                            $form_html .= trim($field_aux->view()) . '<br><br>';
                        }
                    }
                    $form_html .= "<input type='hidden' id='" . $fields[$i] . "' name='" . $fields[$i] . "' value='" . $VALUE . "'>";

                    //                    }else if ($table == "tickets"  and $_SESSION['user']['group'] == 'clientsmanager' and in_array($fields[$i],$not_client_fields)){
                    /*
                                if ($fields[$i] == "usersId"){

                                }
*/

                    /*
                                $VALUE = isset($raw[$fields[$i]]) ? $raw[$fields[$i]] : '';
                                $field_aux = new $fields_types[$i]($fields[$i],$fields_labels[$i],$fields_types[$i],$VALUE,$table,$rid);
                                $aux = $field_aux->view();
                                $form_html .= "<strong>".ucfirst($fields_labels[$i])."</strong><br>";
                                if ($aux == "...")
                                    $form_html .=  $raw[$fields[$i]]."<br><br>";
                                else
                                    $form_html .= $aux."<br><br>";

*/
                } else {
                    $form_html .= "<div class='form-group'><label class='form-label text-xs text-gray-500'>";
                    $form_html .= ucfirst($fields_labels[$i]);
                    $form_html .= '</label>';
                    // added to provide hints about the field
                    if (isset($field_hints) and $field_hints[$i] != '') {
                        $form_html .= '<span class="help">e.g. "' . $field_hints[$i] . '"</span>';
                    }
                    $form_html .= "<div class='controls'>";
                    if (!class_exists($fields_types[$i])) {
                        exit('La clase ' . $fields_types[$i] . ' no existe');
                    }
                    $VALUE = isset($raw[$fields[$i]]) ? $raw[$fields[$i]] : '';
                    $field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $VALUE, $table, $rid);
                    $form_html .= $field_aux->bake_field();
                    $form_html .= '</div>';
                    $form_html .= ' </div>';
                }
            }
        }

        $data = [/* "table_label" => $table_label, */
            'title' => "BackOffice | $table",
            'form' => $form_html,
            'HOOK_JS' => $form->js($table),
            'table' => $table,
            'raw' => $raw,
            'SIDEDATA' => $SIDEDATA->load($raw),
            'op' => '',
            'rid' => $rid,
            'table_label' => $table_label,
        ];

        $this->view->show('superadmin/form.php', $data, $show_top_footer);
    }

    public function update()
    {
        $form = new formModel();
        $rid = $this->params['rid'];
        $table = $this->params['table'];
        $return_url = -1 != $this->params['return_url'] ? $this->params['return_url'] : $_SESSION['return_url'];

        if ($rid == -1) {
            $id = $form->add($table);
        } else {
            $form->edit($table, $rid);
        }

        header('location: ' . $return_url);
    }
}
