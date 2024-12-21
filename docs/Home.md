Stripe Pad is an innovative PHP boilerplate designed to streamline the process of building Software as a Service (SaaS) applications in a WordPress Style. This comprehensive guide aims to provide you with all the necessary information to get started with Stripe Pad, from setting up your development environment to deploying your first SaaS application.

Stripe Pad combines modern PHP development practices with seamless integration of Stripe, a leading online payment processor, to provide a robust foundation for your SaaS projects. Whether you are a beginner just starting out in the world of web development or a seasoned developer looking to accelerate your SaaS product development, Stripe Pad offers the tools and flexibility you need.

In this documentation, you will find step-by-step instructions, best practices, and detailed explanations of Stripe-Pad's features and components. Our goal is to help you maximize the potential of Stripe-Pad and create efficient, scalable, and secure SaaS applications.

Thank you for choosing Stripe Pad. Feel free to use the issues tab if you need help.



## Features
* user management: login, signup, password recovery
* stripe: manage user subscriptions
* landing page: 
* private area: the place to insert your app
* themes: Basic theme is base-dark (Tailwind CSS)

## Dependencies
They are managed via composer
* Stripe
* PHPEmail
## Requirements
* PHP > 7.2

## Initial Setup
1. Download the latest version from the repository. https://github.com/natzar/Stripe-Pad/releases/tag/v.0.0.1-alpha
1. Extract the files to your preferred directory (htdocs)
1. Create database & import database.sql into your MySQL database.
1. Run composer install to install necessary dependencies.
## Configuration
* Optional: Create subdomains and point them to the respective folders: app, api, webhooks, and cdn.
* Set your application name, base URL, Stripe API Keys, Database settings and all configurations in config.php.
* Optional: Check .htaccess if you will be running in a /subfolder/ RedirectBase in /app/.htaccess and /api/.htaccess to match your localhost directory.

## Post-Configuration Steps

1. Set up a webhook from your Stripe dashboard to https://yourdomain.com/webhooks/stripe.php or webhooks.your-domain.com (in case you are using subdomains) to handle Stripe events.
1. Set up automatic deployment from a git repository/webhooks/deploy.php.
## Verification and Testing
Ensure the setup is correct by accessing the following:

* [Login Page](http://localhost/app) should open correctly.
* [API Endpoint](http://localhost/api) should display a 'not authenticated' message.
* Access your main landing or marketing page at the /web directory.
* Your custom application should reside in the /app folder.
* Your API endpoints will be located within the /api folder.



