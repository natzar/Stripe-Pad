

#  Stripe Pad
[![License: GPL3](https://img.shields.io/github/license/natzar/Stripe-Pad)](https://github.com/natzar/Stripe-Pad/blob/main/LICENSE.md)
> 🚧 **Note**: This project is in early development. Use in production environments is not recommended.

PHP Micro SaaS Boilerplate with Stripe integration out of the box.

For Educational purposes. Get started with MVC in PHP.
**Stripe Pad** is a PHP boilerplate for rapid SaaS development with Stripe integration. It offers a minimalist approach to start, validate, and grow your SaaS application without the constraints of a particular framework.


### Disclaimer

``` Not affiliated in any way with Stripe.com ```

## Features

- Space for a marketing website (landing) & app (with authentication)
- MVC, 1 controller for the app and 1 for the api. Models shared between all controllers.
- Webhooks management for Stripe events.
- Divided in subdomains or subfolders
- PHP is the only requirement, how you build you app inside /app folder is up to you
- Easy to modify and customize




## Directory Structure

- **web**: Main landing/marketing page, the place for a ghost or wp installation.
- **crons**: Scripts and cronjobs.
- **app**: Custom application code.
- **core**: Core files for database connections and templates.
- **webhooks**: Handlers for webhooks (default: Stripe and Bitbucket).
- **API**: Basic API functionality.
- **cdn**: Subdomain for static assets.

## Tech Stack

Packed with basic stuff only.

1. Vanilla Php
2. Vanilla Js
3. Composer
5. Tailwind CDN

 


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
