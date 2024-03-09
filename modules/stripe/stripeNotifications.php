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

require './vendor/autoload.php';
require ('config.php');

$stripe = new StripeClient(StripeSecret);
			
$json = file_get_contents('php://input');	
$event = json_decode($json);

// TO-DO: Webhook key check

$event_id = $event->{'id'};
$event = $stripe->event->retrieve($event_id);
if (!isset($event->type)) die("Stripe Response Error: No event to retrieve");

$emailCustomer = $event->data->object->receipt_email;

if ($event->type == 'charge.succeeded') {

}else if ($event->type == 'invoice.payment_succeeded') {

}else if ($event->type == "customer.subscription.created"){
    	
}

mail(AdminEmail, ProjectTitle." · ".$event->type, $json):




