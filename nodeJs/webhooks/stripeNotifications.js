/*

You should import the required modules like express, nodemailer, and json.
You should also check your Webhook secret key in the webhook event.
You should also check the mail() function, that is not supported in nodejs, you can use some library like nodemailer to send the email.

*/

const stripe = require('stripe')(StripeSecret);

const json = await require('express').json();
const event = JSON.parse(json);

// TO-DO: Webhook key check

const event_id = event.id;
const event = await stripe.events.retrieve(event_id);
if (!event.type) throw new Error("Stripe Response Error: No event to retrieve");

const emailCustomer = event.data.object.receipt_email;

if (event.type === 'charge.succeeded') {

} else if (event.type === 'invoice.payment_succeeded') {

} else if (event.type === "customer.subscription.created") {

}

require('nodemailer').createTransport().sendMail({
from: 'youremail@example.com',
to: AdminEmail,
subject: ProjectTitle + ' · ' + event.type,
text: json
});


