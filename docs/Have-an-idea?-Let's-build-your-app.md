
## Getting Started

Follow the installation instructions to set up the environment on your local machine. Once you have everything running locally, you are ready to begin the development of your SaaS application.

## Customizing Your Theme

To create a new theme:

1. Duplicate the `app/themes/basic-dark` directory. Rename the new directory to reflect the primary keyword of your niche, optimizing for SEO purposes.
2. Your main file for customization will be `app/themes/[your-new-theme]/dashboard.php`.
3. Update the configuration file `config.php` within your theme folder, setting `APP_THEME` to the name of your new folder.

## Incorporating JavaScript Frameworks

If your application requires a JavaScript framework:

1. Include the necessary `<script>` tags within the relevant PHP templates, particularly within `dashboard.php`.

## Modifying the Dashboard

To enhance your dashboard functionality:

1. In `app/app.php`, modify the `dashboard` method to include any necessary database data.
2. Instantiate your model, call its methods, retrieve the data, and pass this data to the view.

## Adding New URLs

To introduce new URLs to your application:

1. Edit `app/themes/[your-theme]/app.php`.
2. Add new methods corresponding to your desired URLs, for example, `public function faq() {}` which will make `http://your-domain.com/faq` accessible.

## Interacting with the Database

### Creating Models

Instead of embedding SQL directly within your controllers or views, utilize models:

1. Models serve as adapters for your MySQL queries. Create a new model by duplicating an existing one and adding new methods as needed.
2. For example, create a method within your model:

   ```php
   public function getById($id) {
       // Your SQL query logic here
   }
   ```

3. In `app.php`, use the model to fetch data:

   ```php
   $sales = new salesModel();
   echo $sales->getById(4);
   ```

This approach keeps your application organized and maintains a separation of concerns between your database logic and your application logic.