<?
ini_set('display_errors', 1); 
	ini_set('display_startup_errors', 1); 
	error_reporting(E_ALL);

require_once(dirname(__FILE__).'/../../core/load.php');
require_once(dirname(__FILE__).'/../../core/vendor/stripe-php-7.77.0/init.php');

	include_once $config->get('modelsFolder')."paymentsModel.php";
	include_once CORE_PATH."models/datatrackerModel.php";
	
	\Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY_TEST);
	$stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY_TEST);
	      		
$amount = 120.34;

				$stripe->invoiceItems->create([
				 
				  'amount' => number_format($amount, 2,"",""),
				  "description" => "Producto test",
				  "currency" => "eur",
				 "tax_rates" => array('txr_1IiJI2A3z90NEC4eGR0I4pB2') 
				]);
				
	      		
	      		$invoice = $stripe->invoices->create([
		  			'customer' => $event->data->object->customer,
		  			'collection_method' => 'send_invoice',
		  			'days_until_due' => 1
			
		  		]);

		  		print_r($invoice);