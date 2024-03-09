<?

ini_set('display_errors', 0); 
	ini_set('display_startup_errors', 0); 
	error_reporting(E_NONE);
if (!$_POST) die("PhpNinja Stripe Token Service");

//require APP_PATH.'/vendor/autoload.php';
require_once(dirname(__FILE__).'/../../core/load.php');
require_once(APP_PATH.'/../core/vendor/stripe-php-7.77.0/init.php');
require_once(APP_PATH.'/../core/models/customersModel.php');
//require_once(APP_PATH.'/../core/models/invoicesModel.php');

$dt = new datatrackerModel();
$dt->push("stripe-session",1);

\Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY); //APP_STRIPE_SECRETKEY);


$stripe = new \Stripe\StripeClient(
 APP_STRIPE_SECRETKEY
);


$items = $_POST['items'];
$customer = isset($_POST['customer']) ? $_POST['customer'] : array();
$product = isset($_POST['product']) ? $_POST['product'] : array();

$lang = isset($_POST['lang']) ? $_POST['lang'] : 'es';

$surl = 'https://app.phpninja.net/login?success=1';
$curl = 'https://www.phpninja.es/pedido-cancelado/';

switch($lang):
	case 'en':
		$surl = 'https://www.phpninja.net/thank-you-order-successful/';
		$curl = 'https://www.phpninja.net/order-cancel/';
		
	break;
endswitch;


if (isset($product['stripe_price_id'])){
	$line_items = array(array(
		"price" => $product['stripe_price_id'],
		"quantity" => 1,
		"tax_rates" => array('txr_1IYYgdA3z90NEC4euqBCba1L') //TESTING;: 
//		"tax_rates" => array('txr_1IiJI2A3z90NEC4eGR0I4pB2') 
	));
	 		
} else{
	$line_items = $items;
	$line_items[0]['tax_rates'] = array('txr_1IYYgdA3z90NEC4euqBCba1L'); //TESTING;: 
	$amount = floatval($line_items[0]['amount']) ;
	$line_items[0]['amount'] = number_format($amount,2,"","");

	$product['name'] = $items[0]['name'];
	$product['amount'] = $items[0]['amount'];
	$product['description'] = "No description";
	$product['productsId'] = -1;
	$product['stripe_price_id'] = -1;

}



$tax = $product['amount'] * 0.21;
$total = $product['amount'] + $tax;

				
$metadata = array( "language" => $lang, "product_name" => $product['name'], "product_description" => $product['description'],"product_id" => $product['productsId'], "price" => $product['stripe_price_id'], "product_price" => $product['amount'],"subtotal" => $product['amount'],  "quantity" => 1, "tax" => $tax, "total" => $total );




$params =[
//'billing_address_collection' => 'auto',
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

if (isset($product['product_stripe_id'])){
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



