

  
[![License: GPL3](https://img.shields.io/badge/License-GPL3-yellow.svg)](https://github.com/slinkity/slinkity/blob/main/LICENSE.md)
[![License: GPL3](https://img.shields.io/github/stars/natzar/Stripe-Pad?style=social`)](https://github.com/natzar/Stripe-Pad/blob/main/LICENSE.md)


![Twitter: betoayesa](https://img.shields.io/twitter/follow/betoayesa?label=Follow)](https://twitter.com/betoayesa)
![Stripe Pad Storefront](open-graph.png "Stripe Pad Sample Image")
By 
[Beto Ayesa](https://github.com/betoayesa) ([@betoayesa](https://twitter.com/betoayesa)), looking for contributors!



  
#  Stripe Pad

> 🚧 **This project is heavily under construction!** 🚧 As excited as you may be, we don't recommend this early alpha for production use. Still, give it a try if you want to have some fun and don't mind.

[Stripe Pad](https://stripepad.com) is the simplest way to start selling your Stripe products and subscriptions. It is a Php package that helps you sell your products quickly and easily. It connects to your Stripe account and acts as an UI for selling your products. The main objective is to be an ideal option to launch fast and validate ideas without being attached to any framework or library so if your idea is succesful you don't have to rewrite much. Themes can be build in any way you need, being independent of the core. There is no database, just a Json file.You can think of Stripe pad as a public UI for your Stripe Account. 

Once installed, your frontstore will be ready to:

- 🚀 **Show your products to visitors with direct links to Stripe.** like React for writing page templates and layout templates. Turn an existing `.html` or `.liquid` file into a `.jsx` file, and you're off to the componentized races.
- 🔖 **Manage webhooks calls from Stripe** in case you want to hook actions after a new subscription or payment is done.
- 💧 **Customization** clone any of the starter themes to build your landing page. The Signup button could link directly to a product payment process at Stripe.

### [📣 Find our full announcement post here →](https://www.indiehackers.com/post/stripe-pad-a-storefront-a-micro-saas-boilerplate-for-your-stripe-php-or-nodejs-2579dd2504)

## Technologies used

It's a very simple and rudimentary architecture on purpose, less code, less debt, less long-term commitment. The focus is on the short-term, in providing a fast website with Stripe integration to validate a business or product idea, while having a starting point that doesn't make you lose time, when starting up or later.

1. Php
2. Vanilla Js

*Starter themes use Tailwind CSS via CDN*.
 
### Dependencies
Dependencies are managed via composer. The challenge is maintain it with as less dependencies as posible.

- Stripe Php Wrapper
- Php Mailer



## Starter Themes Samples
![Stripe Pad Storefront](sample2.png "Grid Theme")

![Stripe Pad Storefront](sample.png "List Theme")


## Getting Started, Installation

You just need Php and [Composer](https://getcomposer.org/download/) to install dependencies. It can work with apache or nginx.

```
  git clone https://github.com/natzar/stripe-pad.git
  cd stripe-pad
  composer install
```

**Edit config.php** file to match your environment settings.

```php
define('BaseUrl','//localhost/stripe-pad');
define('StripeKey','xxxxx');
define('Theme','list|grid'); 
```


**Open it in your browser**.
This demos the core functionality while staying as lean as possible, making it the perfect launchpad for new projects 🚀

```php
Browser: //localhost/stripe-pad
```
In the first run, cache/data.json won't exist, so your account details and products from your Stripe Account will be gathered and saved in /cache/data.json via webhooks/getStripeDetails.php. Keep reading to now more about [development internals](#development-internals)


## What Now? Usage & Customization 

Clone a starter theme, change the Theme at config.php and finish your landing page before publishing it.
```php
define('Theme','[Folder name of your new theme]');
```
You can fully edit the look and feel of the front-end as per your need. Best of luck validating your product idea, take in mind:

- Any customization should be done by editing the files directly.
- If you modify code outside of /themes folder please create a pull request.
- If you create a new theme, please share it! Create a pull request.
- Don't modify basic themes, clone one of them and start your "landing" from there.
- DebugMode also acts like a switch between Stripe Keys (live/test)
- Don't modify data.json as it will be overwritten if you ever add new products for example.



### In Production
When you are ready to publish it online:
- Add a webhook from https://dashboard.stripe.com/webhooks to https://yourdomain.com/webhooks/stripeNotifications.php to manage Stripe events.
- Check the actions and customize per your need at *webhooks/stripeNotifications.php*
- Remove cache/data.json every time you update your products or account settings 




## Development Internals
The main index.php includes the theme files defined in config.php, in case cache folder is empty, data will be retrieved from webhooks/stripeGetDetails.php and store the json in cache/data.json right before including index.php file from selected theme, which will receive $stripeData array with all account and product details.

In case you want to clean cache, just remove the file.


### Themes 
The front, html/css for the landing that will showcase your offerings are inside /themes folder. Each theme uses the $stripeData array that is the result of decoding cache/data.json. There are 2 themes to showcase functionality, both use tailwind CDN for the CSS.

**$stripeData** associative array is passed to all themes, it is the array to make data from Stripe available to theme files.
- $stripeData['**account**']: Account details depends on your settings and type of Stripe account
- $stripeData['**products**']: Array with your products

Nothing more, from here is up to you.

### Webhooks 

To keep it simple, the cache/data.json is all the back the front needs. Data from is Stripe is processed via the webhooks, and will be stored in that file, no database.  That will allow to have webhook in diferent languages (Php/Nodejs to start with) in the coming future. 

- **stripeGetDetails.php**, this file is called by index.php when cache/data.json is not found, before loading theme's files.
- **stripeNotifications.php**, Manage notifications from Stripe after setting up a new webhook in your Stripe account. Payment received, subscription creation, invoice paid, ...

### Plugins
Nothing yet. Plugins are components that can be shared between themes.


## Roadmap &Feature set

This project is still in early alpha, so we have many features soon to come! Starter themes covers a majority of features we support today. The road to a micro saas boilerplate based in Stripe to launch and validate new ideas fast. For reference, here's our complete roadmap of current and upcoming features:

| Feature                                                                               | Status    |
|---------------------------------------------------------------------------------------|-----------|
| Complete README.md file |  ✅     |
| Basic Php Webhooks to gather data from Stripe                                               |  ✅     |
| Basic Starter theme to show products from Stripe                                               |  ✅     |
| Load data.json via Js from themes                                               | ⏳      |
| Add typical sections to start themes (features, faq, contact...)                                                                       | ⏳        |
| User Private Area (after successful signup & login), the gateway to become a new ideas boilerplate to launch fast                                                                 | ⏳         |
| Admin Private Area (user & payments management)                                                                     | ⏳         |
| Add Default Transactional Emails. Payments, Sign up, ...                                                        |⏳        |
| Add User management, logins, signups, lost password.                                        | ⏳      |
| Add event in webhooks to clear cache after a product or Stripe account details have been updated                                          | ⏳         |
|  Webhooks written in NodeJs as an alternative. *I'm afraid Php won't be so popular*                                       | ⏳         |
 - ✅ = Ready to use
- ⏳ = In progress




## How to contribute
If you haven't contributed to any open source project this is the perfect opportunity. 

To contribute via pull request, follow these steps:

1. Create an issue describing the feature you want to work on (Bugs, themes,  plugins, new features or webhooks).
2. Write your code, tests and documentation, and format them with ``black``
3. Create a pull request describing your changes

For more detailed instructions on how to contribute code, check out these [code contributor guidelines](CONTRIBUTING.md).

## License
Licensed under the GPL License, Version 3.0
Copyright 2023 Beto Ayesa. [Copy of the license](LICENSE.txt).

## Disclaimer

``` Not affiliated in any way with Stripe.com ```


## Have an idea? Notice a bug? Need help?

I'd love to hear your feedback! Feel free to log an issue on our [GitHub issues page](https://github.com/natzar/Stripe-Pad/issues). If your question is more personal, [@betoayesa](https://www.twitter.com/betoayesa) is always open as well.

## Links

- Repository url: [www.stripepad.com](https://www.stripepad.com)
- [What is Stripe Pad & what it does](#stripe-pad)
- [How it works? Development internals](#development-internals)
- [How to contribute](#how-to-contribute)
- [License](#license)
