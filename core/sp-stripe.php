<?

/* 
	Stripe Pad - PHP SaaS boilerplate
	Stripe.com Wrapper
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

use Stripe\Invoice;
use Stripe\StripeClient;

class StripePad_Stripe extends ModelBase
{

    function __construct()
    {
        \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY_TEST);
    }

    function create_checkout_session()
    {
        if (!$_POST) die("PhpNinja Stripe Token Service");

        \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY); //APP_STRIPE_SECRETKEY);


        $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);


        $items = $_POST['items'];
        $customer = isset($_POST['customer']) ? $_POST['customer'] : array();
        $product = isset($_POST['product']) ? $_POST['product'] : array();

        $lang = isset($_POST['lang']) ? $_POST['lang'] : 'es';

        $surl = 'https://app.phpninja.net/login?success=1';
        $curl = 'https://www.phpninja.es/pedido-cancelado/';

        switch ($lang):
            case 'en':
                $surl = 'https://www.phpninja.net/thank-you-order-successful/';
                $curl = 'https://www.phpninja.net/order-cancel/';

                break;
        endswitch;


        if (isset($product['stripe_price_id'])) {
            $line_items = array(array(
                "price" => $product['stripe_price_id'],
                "quantity" => 1,
                "tax_rates" => array(APP_STRIPE_TAX_RATE)

            ));
        } else {
            $line_items = $items;
            $line_items[0]['tax_rates'] = array(APP_STRIPE_TAX_RATE); //TESTING;: 
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


        $metadata = array("language" => $lang, "product_name" => $product['name'], "product_description" => $product['description'], "product_id" => $product['productsId'], "price" => $product['stripe_price_id'], "product_price" => $product['amount'], "subtotal" => $product['amount'],  "quantity" => 1, "tax" => $tax, "total" => $total);




        $params = [
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

    function create_invoice()
    {


        $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);

        $amount = 120.34;

        $stripe->invoiceItems->create([

            'amount' => number_format($amount, 2, "", ""),
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
    }

    function get_account_settings()
    {
        # Checking if minimum settings are ready
        $stripeData = [];

        $stripe = new StripeClient(APP_STRIPE_SECRETKEY);

        // Retrieve account details
        $accounts = $stripe->accounts->all(['limit' => 1]);

        if (!isset($accounts->data[0]->id)) die("Some error ocurred while connecting to Stripe");

        $stripeData['account'] = $stripe->accounts->retrieve($accounts->data[0]->id, []);

        // Retrieve all products

        $products =  $stripe->products->all(['limit' => 300])->data;

        // Create Payment Links, if they don't exist

        // for ($i=0;$i<count($products);$i++){
        // 	$products[$i]->price= array();
        // 	if($products[$i]->default_price){
        // 		$price = $stripe->prices->retrieve($products[$i]->default_price);

        // 		$products[$i]->price[] = array("amount" => $price->unit_amount, "link" => $stripe->paymentLinks->create(
        // 			['line_items' => [['price' => $products[$i]->default_price, 'quantity' => 1]]]
        // 			));

        // 	}else{

        // 		$prices = $stripe->prices->all(['limit' => 3, 'product' => $products[$i]->id]);
        // 		foreach($prices->data as $price){
        // 			$products[$i]->price[] = array("amount" => $price->unit_amount, "link" => $stripe->paymentLinks->create(
        // 			['line_items' => [['price' => $price->id, 'quantity' => 1]]]
        // 			));
        // 		}
        // 	}
        // }

        $stripeData['products'] = $products;

        // Json Output

        echo json_encode($stripeData);
    }


    function simple_create_sesion()
    {
        $id = time();
        $line_items = array();
        \Stripe\Stripe::setApiKey(APP_STRIPE_SECRETKEY);
        $metadata = $_POST;
        $totalLines =  $metadata['count'];

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[


                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' =>  '0001',
                    'product_data' => [
                        "name" => $metadata['name'],
                        'description' => " CSV files with " . $totalLines . " rows. Each row include all details from each domain",
                        'images' => [],
                    ],
                ],
                'quantity' => $totalLines,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://domstry.com/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://domstry.com/browse',
            'billing_address_collection' => 'auto',
            'payment_intent_data' => array("metadata" => $metadata),
            'allow_promotion_codes' => true,

            'tax_id_collection' => [
                'enabled' => true,

            ],
            'payment_method_types' => ['card'],
        ]);




        echo json_encode($session);
    }

    public function syncStripeSubscriptions()
    {
        $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);
        $subscriptions = $stripe->subscriptions->all(['limit' => 100]);

        foreach ($subscriptions->autoPagingIterator() as $subscription) {
            $stmt = $this->db->prepare("REPLACE INTO subscriptions (usersId, productsId, active, start_date, end_date, created, updated) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
            $stmt->execute([
                $subscription->customer, // Assuming `usersId` maps to Stripe's `customer` ID
                $subscription->items->data[0]->price->product, // Assuming `productsId` maps to Stripe's product ID associated with the price
                $subscription->status == 'active' ? 1 : 0,
                date('Y-m-d', $subscription->current_period_start),
                date('Y-m-d', $subscription->current_period_end)
            ]);
        }
    }
    public function syncStripeInvoices()
    {
        $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);
        $invoices = $stripe->invoices->all(['limit' => 100]);

        foreach ($invoices->autoPagingIterator() as $invoice) {
            $stmt = $this->db->prepare("REPLACE INTO invoices (invoicesId, stripe_payment_id, usersId, subtotal, vat, total, created, updated) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
            $stmt->execute([
                $invoice->id,
                $invoice->payment_intent,
                $invoice->customer, // Assuming `usersId` maps to Stripe's `customer` ID
                $invoice->subtotal,
                $invoice->tax,
                $invoice->total
            ]);
        }
    }
    public function syncStripeProducts()
    {
        $stripe = new \Stripe\StripeClient(APP_STRIPE_SECRETKEY);
        $products = $stripe->products->all(['limit' => 100]);

        foreach ($products->autoPagingIterator() as $product) {
            $stmt = $this->db->prepare("REPLACE INTO products (stripe_product_id, name, description, visible, created, updated) VALUES (?, ?, ?, ?, NOW(), NOW())");
            $stmt->execute([
                $product->id,
                $product->name,
                $product->description,
                $product->active ? 1 : 0
            ]);
        }
    }
}
