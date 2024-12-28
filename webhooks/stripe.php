<?
/* 
	Stripe Pad - Micro SaaS boilerplate
	API - Internal and webhook calls from Stripe
    Copyright (C) 2023 Beto Ayesa

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    This file is part of Stripe Pad.

	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
*/

include dirname(__FILE__) . "/../core/sp-load.php";
/**
 * 	StripeWebhook
 * 
 *	+charge.succeeded
 *	+customer.subscription.created
 *	+invoice.payment_succeeded
 * 
 */

class StripeWebhook
{
	var $event;
	var $metadata;
	var $customers;
	var $stripe;
	var $customer;
	var $users;
	var $user;
	var $productDetails = [];

	public function __construct()
	{
		$json = file_get_contents('php://input');
		$this->users = new usersModel();
		$this->stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);
		$this->event = json_decode($json);

		echo 'Hi Stripe!';

		$this->user = array(
			"name" => "", //$this->event->data->object->customer_name,
			"email" => $this->event->data->object->receipt_email,
			"stripe_customer_id" => $this->event->data->object->customer
		);

		$this->metadata = $this->event->data->object->metadata;

		$user_exists = $this->users->find($this->user);

		if (empty($user_exists)) { // New Customer
			$this->user = $this->users->create($this->customer['email']);
			#$this->customer = $this->customers->create($user['usersId'], $this->customer['name'], $address = "", $nif = "", $location = "", $country = "", $email = "", $stripe_customer_id = "", $url = "", $language = "", $source = "") {
			#$this->users->create($this->user['usersId'], $this->user['name'], "", "", "", "", $this->user['email'], $this->user['stripe_customer_id'], "", "", "");
		} else { // Customer exists
			$this->user = $user_exists;
			if (empty($this->users['stripe_customer_id']))
				$this->users->setField('users', $this->user['usersId'], 'stripe_customer_id', $this->user['stripe_customer_id']);
		}

		$this->process_event();
	}

	private function process_event()
	{

		//$invoices = new invoicesModel();		
		$mails = new mailsModel();

		echo $this->event->type . "\n";
		switch ($this->event->type):
			case 'customer.subscription.updated':
				/* */

				break;
			case 'customer.subscription.deleted':
				/* */

				break;
			case 'customer.subscription.created':

				// $subject = "[INFO] Servicio Contratado Php Ninja";
				// $data = array(
				// 	"persona_contacto" => $this->customer['persona_contacto'],
				// 	"user" => $this->customer['email'],
				// );

				// # TO-DO: Manntenimiento o Hosting ?

				// $mails->sendTemplate('subscription_created', $data, $this->customer['email'], $subject);
				// $mails->internal("Nuevo Plan! y nuevo usuario en area de clientes", $this->customer['email']);
				// //$this->datatracker->push("areaclientes-send-bienvenida-plan");
				break;
			case 'charge.succeeded':
				$chargeId = $this->event->data->object->id;
				$charge = $this->stripe->charges->retrieve($chargeId);
				$total = $charge->amount;
				$currency = $charge->currency;
				$description = $charge->description;
				// Retrieve the PaymentIntent associated with the charge
				$paymentIntentId = $charge->payment_intent;
				$paymentIntent = $this->stripe->paymentIntents->retrieve($paymentIntentId);

				// Attempt to retrieve the Subscription associated with the PaymentIntent (if any)
				$subscriptionId = $paymentIntent->subscription;

				if ($subscriptionId) {
					// Retrieve the subscription object
					$subscription = $this->stripe->subscriptions->retrieve($subscriptionId);

					// Extract product details from subscription items
					foreach ($subscription->items->data as $item) {
						$price = $this->stripe->prices->retrieve($item->price->id);
						$product = $this->stripe->products->retrieve($price->product);
						$this->productDetails[] = [
							'product_id' => $product->id,
							'product_name' => $product->name,
							'price_id' => $price->id,
							'price' => $price->unit_amount,
							'currency' => $price->currency,
							'quantity' => $item->quantity,
							'product_description' => $product->description,
						];
					}
				} else {
					// If no subscription, check for available information in PaymentIntent
					foreach ($paymentIntent->charges->data as $chargeItem) {
						if (!empty($chargeItem->metadata['product_id'])) {
							$productId = $chargeItem->metadata['product_id'];
							$priceId = $chargeItem->metadata['price_id'];

							$price = $this->stripe->prices->retrieve($priceId);
							$product = $this->stripe->products->retrieve($price->product);

							$this->productDetails[] = [
								'product_id' => $product->id,
								'product_name' => $product->name,
								'price_id' => $price->id,
								'price' => $price->unit_amount,
								'currency' => $price->currency,
								'quantity' => 1, // Default to 1 if not available
								'product_description' => $product->description,
							];
						}
					}
				}

				$amount = $this->event->data->object->metadata->subtotal ? $this->event->data->object->metadata->subtotal : $this->event->data->object->amount / 100;
				$amount = number_format($amount, 2, ".", "");
				//$dt->push('stripe-amount',$amount);

				# Make Invoice
				// $subtotal = $this->productDetails[0]['price'];
				// $tax = $total - $subtotal;

				// $invoice = array(
				// 	"date" => Date("Y-m-d"),
				// 	"cart" => $this->productDetails[0]['product_name'] . " - " . $this->productDetails[0]['product_description'], //array("item" => isset($metadata->product_name) ? $metadata->product_name : "Mantenimiento Web Completo"),
				// 	"customersId" => $this->customer['customersId'],
				// 	"paymentsId" => $paymentId,
				// 	"subtotal" => $subtotal / 100,
				// 	"iva" => $tax / 100, //$params['tax'],
				// 	"total" => $total / 100,
				// 	"payment_method" => 'stripe',
				// 	"customer" => $this->customer
				// );
				// print_r($invoice);
				// $invoice =  $invoices->create($invoice);

				break;
		endswitch;
	}
}

$w = new StripeWebhook();
echo 'End';
