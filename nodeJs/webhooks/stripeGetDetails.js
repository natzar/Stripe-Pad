const stripe = require('stripe')(StripeSecret);

let settings = {};

// Retrieve account details
const accounts = await stripe.accounts.list({ limit: 1 });
settings.account = await stripe.accounts.retrieve(accounts.data[0].id);

// Retrieve all products
const products = (await stripe.products.list({ limit: 300 })).data;