<?
/*
*
*		Webhook STRIPE
*		+charge.succeeded
*		+customer.subscription.created
*		+invoice.payment_succeeded
*
*
*
*
*/


	include dirname(__FILE__)."/../load.php";
	
	
	\Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
	$stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);
	      		
	$db = SPDO::singleton();
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$db->config = Config::singleton();
			
	$json = file_get_contents('php://input');	
	$event = json_decode($json);
	
	


    
	$metadata = $event->data->object->metadata;
    
    // Customer
    $customer = $customers->search(array("email" => $event->data->object->receipt_email));
	$email = $event->data->object->receipt_email;
	
	$event_id = $event->{'id'};
	$event = \Stripe\Event::retrieve($event_id); //$stripe->event->retrieve($event_id);
		
	// Cargo       		
    
    
    if ($event->type == "customer.subscription.created"){
    	//$dt->push('stripe-subscription-created');

    	// ob_start();
    	// print_r($metadata);
    	// $message = ob_get_clean();

    	// ENVIAR MAIL
    	// SETEAR WEB 
    	// CREAR TICKET INICIO
		
    	
    	mail("beto.phpninja@gmail.com", "Nueva Suscripción COUNTERIFY!", $json);

    }


function invoice_payment_received_body($invoice) {
  $subscription = $invoice->lines->data[0];
  $nickname = $subscription->plan->nickname;
  $start = format_stripe_timestamp($subscription->period->start);
  $end = format_stripe_timestamp($subscription->period->end);
  $total = format_stripe_amount($invoice->total);
  
  return <<<EOD
-------------------------------------------------
PAGO SUSCRIPCIÓN / FACTURA ENVIADA
Nickname: {$nickname}
Plan: {$subscription->plan->name}
Amount: {$total} (USD)
For service between {$start} and {$end}
-------------------------------------------------
EOD;
}


function payment_received_body($charge) {

	$email =$charge->receipt_email;
	$product = isset($charge->metadata->product_name) ? $charge->metadata->product_name : $charge->description;
	$amount = format_stripe_amount($charge->amount);
  return <<<EOD
A payment has been charged successfully. 
-------------------------------------------------
PAYMENT RECEIPT
{$product}
Email: {$email}
Amount: {$amount} (EUR)
-------------------------------------------------
EOD;
}






echo 'END';

