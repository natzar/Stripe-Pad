## Base Framework
![Stripe Pad Relations](https://www.stripepad.com/relations.png)

The base of Stripe Pad is structured as a simplistic MVC (Model-View-Controller) PHP application. 

* Find and add your models at app/models
* Find and add your views (templates) at app/themes/theme-name/
* Everything else where users makes requests to (api, webhooks, web (index.php), widget, cronjobs) could be considered the controllers.



## Core Components

Located within the 'core' directory, these essential classes include:

- **ModelBase**: Serves as the foundation for all model classes, incorporating database connection functionality.
- **View**: Manages template rendering and data handling.
- **SPDO**: Facilitates MySQL database connections.

Key environmental files include:

- **.htaccess**: Redirects URLs in the format `/a/b/c/d` to `index.php?p=a&m=b&i=c` (without physically redirecting). Additional parameters can be added for deeper navigation.
- **config.php**: Centralizes all settings, API keys, and secrets. It is exclusively included by `load.php`.
- **load.php**: Initializes the application by loading `config.php`, managing error handling, including all model files, and integrating composer packages.

For optimal security and organization, setting up dedicated domains or subdomains for different application aspects (such as cron jobs, core functionality, and CDN) is advised.

## Application (App)

index.php is the boilerplate, app/app.php it's an extended StripePad Class. You can override the parent methods.
All your application logic will be in app/app.php, public & private sides, is all there, all urls are defined there. 


### Landing Page

The 'landing' directory hosts all public-facing parts of your SaaS, including marketing content and user acquisition elements. To extend the landing page:

1. Create new HTML/PHP templates within `templates/landing/`.
2. Add corresponding methods to `app/app.php` for new pages, e.g., `public function about()`.
3. Implement the desired logic and view rendering within these new methods.

This setup enables straightforward routing from URLs to respective application methods and views.

### Your code goes here

Access to the core application features, such as the dashboard, is restricted to authenticated users. The dashboard acts as the entry point for logged-in users, hosting the primary functionality and data interactions of your SaaS solution. Start by modifying `dashboard.php` to tailor it to your application's needs.



## Cronjobs

This section is designated for scheduling and managing cronjobs. Scripts within the 'crons' directory should start by including `load.php`, initializing required models, and executing necessary tasks. These scripts can then be scheduled directly on the server.

## CDN

The 'cdn' directory is intended for static assets such as JavaScript, CSS, and images. Ideally, these should be served from a separate domain or subdomain to improve loading times and security.

## Database

Stripe Pad is built on a MySQL database encompassing three primary tables:

- **users**: Stores user information such as email, password, membership status, and timestamps.
- **payments**: Records payment transactions including Stripe payment IDs, user IDs, amounts, and timestamps.
- **blog**: Maintains blog post data including slugs, titles, bodies, and timestamps.

## Webhooks

Facilitate automated interactions with external systems:

- **deploy.php**: Configurable for automatic deployment via Bitbucket or Git hooks.
- **stripe.php**: Endpoint for receiving events from Stripe.




## API
API comes in 2 forms, v1 and v2.
* v1: just 1 endpoint user for 1 action (search, get info, whatever...)
* v2: API REST. You can instance here your models and return JSON responses

## Widget
In case you want to build a widget that users will insert in their websites, you can use this. 

## Modules
* EmailValidator
* Request Bot Blocker


The directory structure and setup described provide a comprehensive framework for developing and scaling your SaaS platform with Stripe Pad.
