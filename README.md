

#  Stripe Pad
[![License: GPL3](https://img.shields.io/github/license/natzar/Stripe-Pad)](https://github.com/natzar/Stripe-Pad/blob/main/LICENSE.md)


**Stripe Pad** is a PHP boilerplate for rapid SaaS development with Stripe integration. It offers a minimalistic approach to start, validate, and grow your SaaS application without the constraints of a particular framework.


For Educational purposes. Get started with MVC in PHP.

![Relations between components](https://stripepad.com/open-graph.png)

### Disclaimer

``` Not affiliated in any way with Stripe.com ```

## Features

- Public: Landing page
- Private: User Profile, Your App
- MVC. Controllers, Models shared between all controllers, and JSON + templates for the views part.
- Webhooks management for Stripe events.
- Divided in subdomains or subfolders
- PHP is the only requirement, how you build you app inside /app folder is up to you
- Easy to modify and customize



## Structure

Space to insert your code:
- **crons**: Scripts and cronjobs.
- **app**: Custom application code & landing page. All HTML is here.
- **cdn**: Subdomain for static assets. 

These are core files, they will break with an update:
- **core**: Core files for database connections and templates.
- **webhooks**: Handlers for webhooks (default: Stripe and Bitbucket).
- **API**: Basic API functionality.

![Relations between components](https://www.stripepad.com/relations.png)

### Tech Stack

Packed with basic stuff only.

1. Php. MVC style, no framework.
2. Vanilla Js & jQuery, just to open/close mobile menu
3. Composer, to install stripe and email dependencies

Basic theme uses Tailwind. 100% optional. You can edit /app folder completely.

 

## Getting Started, Installation

```
  git clone https://github.com/natzar/stripe-pad.git
  cd stripe-pad/
  composer install
```

After clone or downloading files, just visit //localhost/stripe-pad in your browser and follow instructions.


```php
Browser: //localhost/stripe-pad/
```

Find full installation instructions [here](https://www.stripepad.com/installation)


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

## Other Resources
SVG icons: https://heroicons.com/
