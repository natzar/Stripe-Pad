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

use Stripe\Invoice;
use Stripe\StripeClient;

require __DIR__ . '/vendor/autoload.php';
require ('../config.php');

$stripe = new StripeClient(StripeSecret);


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
	
$settings = [];
$settings['products'] = $products;

// Json Output

echo json_encode($settings);
