

#  Stripe Pad
[![License: GPL3](https://img.shields.io/github/license/natzar/Stripe-Pad)](https://github.com/natzar/Stripe-Pad/blob/main/LICENSE.md)
> 🚧 **Note**: This project is in early development. Use in production environments is not recommended.

**Stripe Pad** is a PHP boilerplate for rapid SaaS development with Stripe integration. It offers a minimalist approach to start, validate, and grow your SaaS application without the constraints of a particular framework.

It's also done for educatinal purposes, to get started with a pattern like MVC in PHP.

### Disclaimer

``` Not affiliated in any way with Stripe.com ```

## Features

- Direct storefront links to Stripe products.
- Webhooks management for Stripe events.
- Starter themes for quick customization.
- No database—only a Json cache file for faster deployment.

[📣 **Live Demo**](https://www.stripepad.com)

## Directory Structure

- **web**: Main landing/marketing page.
- **crons**: Scripts and cronjobs.
- **app**: Custom application code.
- **core**: Core files for database connections and templates.
- **webhooks**: Handlers for webhooks (default: Stripe and Bitbucket).
- **API**: Basic API functionality.
- **cdn**: Subdomain for static assets.

## Tech Stack

1. Php
2. Vanilla Js
3. Dependencies: Stripe Php Wrapper & Php Mailer only.
5. *Starter themes use Tailwind CSS via CDN*.

  

### [📣 See live demo here →](https://www.stripepad.com)

 
## DEMO
[📣 See live demo here →](https://www.stripepad.com)
![Stripe Pad Storefront](sample.png "List Theme")


## Getting Started, Installation

You just need Php and [Composer](https://getcomposer.org/download/) to install dependencies. It can work with apache or nginx.

```
  git clone https://github.com/natzar/stripe-pad.git
  cd stripe-pad/webhooks
  composer install
```

**Edit webhooks/config.php** file to match your environment settings.

```php
define('BaseUrl','//localhost/stripe-pad');
define('StripeKey','xxxxx');
define('Theme','list|grid'); 
```


**Open it in your browser**.
This demos the core functionality while staying as lean as possible, making it the perfect launchpad for new projects 🚀

```php
Browser: //localhost/stripe-pad/web
```
In the first run, cache/data.json won't exist, so your account details and products from your Stripe Account will be gathered and saved in /cache/data.json via webhooks/getStripeDetails.php. Keep reading to now more about [development internals](#development-internals)


## What Now? Usage & Customization 

Clone a starter theme, change the Theme at config.php and finish your landing page before publishing it.
```php
define('Theme','[Folder name of your new theme]');
```
You can fully edit the look and feel of the front-end as per your need. Best of luck validating your product idea, take in mind:

- Any customization should be done by editing themes files directly.
- If you modify code outside of /themes folder, please create a pull request.
- If you create a new theme, please share it creating a pull request.
- DebugMode also acts like a switch between Stripe Keys (live/test)
- Don't modify data.json as it will be overwritten if you ever add new products for example.



### In Production
When you are ready to publish it online:
- Add a webhook from https://dashboard.stripe.com/webhooks to https://yourdomain.com/webhooks/stripeNotifications.php to manage Stripe events.
- Check the actions and customize per your need at *webhooks/stripeNotifications.php*
- Remove cache/data.json every time you update your products or account settings 




## Development Internals

cache/data.json is what allows Stripe Pad to maintain the different components 100% decoupled and no database involved.
In case you want to clean cache, just remove the file.

The main index.html retrieves data from webhooks/stripeGetDetails.php, if cache/data.json exists it will just return it, if not it will communicate with Stripe and then store the result in cache/data.json for future calls.


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
| Php Webhooks to communicate with Stripe                                               |  ✅     |
| Basic Starter theme                                                |  ✅     |
| Documentation                                               | ⏳      |
| Stripe Webhooks complete integration                                               | ⏳      |

 - ✅ = Ready to use
- ⏳ = In progress




## How to contribute
If you haven't contributed to any open source project this is the perfect opportunity. The project is very simple and it is in early stage. 

To contribute via pull request, follow these steps:

1. Create an issue describing the feature you want to work on (Bugs, themes,  plugins, new features or webhooks).
2. Write your code, tests and documentation, and format them with ``black``
3. Create a pull request describing your changes

For more detailed instructions on how to contribute code, check out these [code contributor guidelines](CONTRIBUTING.md).

## License
Licensed under the GPL License, Version 3.0 [Copy of the license](LICENSE.txt).

## Author 
[Beto Ayesa](https://github.com/betoayesa) ([@betoayesa](https://twitter.com/betoayesa)), looking for contributors!


## Have an idea? Notice a bug? Need help?

I'd love to hear your feedback! Feel free to log an issue on our [GitHub issues page](https://github.com/natzar/Stripe-Pad/issues). If your question is more personal, [@betoayesa](https://www.twitter.com/betoayesa) is always open as well.

## Links

- Repository url: [www.stripepad.com](https://www.stripepad.com)
- [What is Stripe Pad & what it does](#stripe-pad)
- [How it works? Development internals](#development-internals)
- [How to contribute](#how-to-contribute)
- [License](#license)
