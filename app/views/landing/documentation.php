<div class="relative px-10">
    <!-- Wrapper for the entire layout -->
    <div class="block flex min-h-screen ">

        <!-- Sidebar: Navigation -->
        <aside class="w-64  px-8 py-12  overflow-y-auto">
            <h2 class="text-xl text-white font-semibold mb-10">Docs</h2>
            <ul class="space-y-2">
                <li><a href="#introduction" class="text-gray-400 hover:text-blue-500">Introduction</a></li>
                <li><a href="#installation" class="text-gray-400 hover:text-blue-500">Installation</a></li>
                <li><a href="#configuration" class="text-gray-400 hover:text-blue-500">Configuration</a></li>
                <li><a href="#customizing" class="text-gray-400 hover:text-blue-500">Customizing</a></li>
                <li><a href="#advanced-topics" class="text-gray-400 hover:text-blue-500">Advanced Topics</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 pl-32 pr-32 py-12 text-white text-base">

            <p>Stripe Pad is an innovative PHP boilerplate designed to streamline the process of building Software as a Service (SaaS) applications in a WordPress Style. This comprehensive guide aims to provide you with all the necessary information to get started with Stripe Pad, from setting up your development environment to deploying your first SaaS application.</p>
            <p>Stripe Pad combines modern PHP development practices with seamless integration of Stripe, a leading online payment processor, to provide a robust foundation for your SaaS projects. Whether you are a beginner just starting out in the world of web development or a seasoned developer looking to accelerate your SaaS product development, Stripe Pad offers the tools and flexibility you need.</p>
            <p>In this documentation, you will find step-by-step instructions, best practices, and detailed explanations of Stripe-Pad's features and components. Our goal is to help you maximize the potential of Stripe-Pad and create efficient, scalable, and secure SaaS applications.</p>
            <p>Thank you for choosing Stripe Pad. Feel free to use the issues tab if you need help.</p>
            <h2>Features</h2>
            <ul>
                <li>user management: login, signup, password recovery</li>
                <li>stripe: manage user subscriptions</li>
                <li>landing page: </li>
                <li>private area: the place to insert your app</li>
                <li>themes: Basic theme is base-dark (Tailwind CSS)</li>
            </ul>
            <h2>Dependencies</h2>
            <p>They are managed via composer</p>
            <ul>
                <li>Stripe</li>
                <li>PHPEmail
                    <h2>Requirements</h2>
                </li>
                <li>PHP &gt; 7.2</li>
            </ul>
            <h2>Initial Setup</h2>
            <ol>
                <li>Download the latest version from the repository. <a href="https://github.com/natzar/Stripe-Pad/releases/tag/v.0.0.1-alpha">https://github.com/natzar/Stripe-Pad/releases/tag/v.0.0.1-alpha</a></li>
                <li>Extract the files to your preferred directory (htdocs)</li>
                <li>Create database &amp; import database.sql into your MySQL database.</li>
                <li>Run composer install to install necessary dependencies.
                    <h2>Configuration</h2>
                    <ul>
                        <li>Optional: Create subdomains and point them to the respective folders: app, api, webhooks, and cdn.</li>
                        <li>Set your application name, base URL, Stripe API Keys, Database settings and all configurations in config.php.</li>
                        <li>Optional: Check .htaccess if you will be running in a /subfolder/ RedirectBase in /app/.htaccess and /api/.htaccess to match your localhost directory.</li>
                    </ul>
                </li>
            </ol>
            <h2>Post-Configuration Steps</h2>
            <ol>
                <li>Set up a webhook from your Stripe dashboard to <a href="https://yourdomain.com/webhooks/stripe.php">https://yourdomain.com/webhooks/stripe.php</a> or webhooks.your-domain.com (in case you are using subdomains) to handle Stripe events.</li>
                <li>Set up automatic deployment from a git repository/webhooks/deploy.php.
                    <h2>Verification and Testing</h2>
                    <p>Ensure the setup is correct by accessing the following:</p>
                </li>
            </ol>
            <ul>
                <li><a href="https://localhost/app">Login Page</a> should open correctly.</li>
                <li><a href="https://localhost/api">API Endpoint</a> should display a 'not authenticated' message.</li>
                <li>Access your main landing or marketing page at the /web directory.</li>
                <li>Your custom application should reside in the /app folder.</li>
                <li>Your API endpoints will be located within the /api folder.</li>
            </ul>
            <h2>Base Framework</h2>
            <p><img src="https://www.stripepad.com/relations.png" alt="Stripe Pad Relations"></p>
            <p>The base of Stripe Pad is structured as a simplistic MVC (Model-View-Controller) PHP application. </p>
            <ul>
                <li>Find and add your models at app/models</li>
                <li>Find and add your views (templates) at app/themes/theme-name/</li>
                <li>Everything else where users makes requests to (api, webhooks, web (index.php), widget, cronjobs) could be considered the controllers.</li>
            </ul>
            <h2>Core Components</h2>
            <p>Located within the 'core' directory, these essential classes include:</p>
            <ul>
                <li><strong>ModelBase</strong>: Serves as the foundation for all model classes, incorporating database connection functionality.</li>
                <li><strong>View</strong>: Manages template rendering and data handling.</li>
                <li><strong>SPDO</strong>: Facilitates MySQL database connections.</li>
            </ul>
            <p>Key environmental files include:</p>
            <ul>
                <li><strong>.htaccess</strong>: Redirects URLs in the format <code>/a/b/c/d</code> to <code>index.php?p=a&amp;m=b&amp;i=c</code> (without physically redirecting). Additional parameters can be added for deeper navigation.</li>
                <li><strong>config.php</strong>: Centralizes all settings, API keys, and secrets. It is exclusively included by <code>load.php</code>.</li>
                <li><strong>load.php</strong>: Initializes the application by loading <code>config.php</code>, managing error handling, including all model files, and integrating composer packages.</li>
            </ul>
            <p>For optimal security and organization, setting up dedicated domains or subdomains for different application aspects (such as cron jobs, core functionality, and CDN) is advised.</p>
            <h2>Application (App)</h2>
            <p>index.php is the boilerplate, app/app.php it's an extended StripePad Class. You can override the parent methods.
                All your application logic will be in app/app.php, public &amp; private sides, is all there, all urls are defined there. </p>
            <h3>Landing Page</h3>
            <p>The 'landing' directory hosts all public-facing parts of your SaaS, including marketing content and user acquisition elements. To extend the landing page:</p>
            <ol>
                <li>Create new HTML/PHP templates within <code>templates/landing/</code>.</li>
                <li>Add corresponding methods to <code>app/app.php</code> for new pages, e.g., <code>public function about()</code>.</li>
                <li>Implement the desired logic and view rendering within these new methods.</li>
            </ol>
            <p>This setup enables straightforward routing from URLs to respective application methods and views.</p>
            <h3>Your code goes here</h3>
            <p>Access to the core application features, such as the dashboard, is restricted to authenticated users. The dashboard acts as the entry point for logged-in users, hosting the primary functionality and data interactions of your SaaS solution. Start by modifying <code>dashboard.php</code> to tailor it to your application's needs.</p>
            <h2>Cronjobs</h2>
            <p>This section is designated for scheduling and managing cronjobs. Scripts within the 'crons' directory should start by including <code>load.php</code>, initializing required models, and executing necessary tasks. These scripts can then be scheduled directly on the server.</p>
            <h2>CDN</h2>
            <p>The 'cdn' directory is intended for static assets such as JavaScript, CSS, and images. Ideally, these should be served from a separate domain or subdomain to improve loading times and security.</p>
            <h2>Database</h2>
            <p>Stripe Pad is built on a MySQL database encompassing three primary tables:</p>
            <ul>
                <li><strong>users</strong>: Stores user information such as email, password, membership status, and timestamps.</li>
                <li><strong>payments</strong>: Records payment transactions including Stripe payment IDs, user IDs, amounts, and timestamps.</li>
                <li><strong>blog</strong>: Maintains blog post data including slugs, titles, bodies, and timestamps.</li>
            </ul>
            <h2>Webhooks</h2>
            <p>Facilitate automated interactions with external systems:</p>
            <ul>
                <li><strong>deploy.php</strong>: Configurable for automatic deployment via Bitbucket or Git hooks.</li>
                <li><strong>stripe.php</strong>: Endpoint for receiving events from Stripe.</li>
            </ul>
            <h2>API</h2>
            <p>API comes in 2 forms, v1 and v2.</p>
            <ul>
                <li>v1: just 1 endpoint user for 1 action (search, get info, whatever...)</li>
                <li>v2: API REST. You can instance here your models and return JSON responses</li>
            </ul>
            <h2>Widget</h2>
            <p>In case you want to build a widget that users will insert in their websites, you can use this. </p>
            <h2>Modules</h2>
            <ul>
                <li>EmailValidator</li>
                <li>Request Bot Blocker</li>
            </ul>
            <p>The directory structure and setup described provide a comprehensive framework for developing and scaling your SaaS platform with Stripe Pad.</p>
            <h2>Getting Started</h2>
            <p>Follow the installation instructions to set up the environment on your local machine. Once you have everything running locally, you are ready to begin the development of your SaaS application.</p>
            <h2>Customizing Your Theme</h2>
            <p>To create a new theme:</p>
            <ol>
                <li>Duplicate the <code>app/themes/basic-dark</code> directory. Rename the new directory to reflect the primary keyword of your niche, optimizing for SEO purposes.</li>
                <li>Your main file for customization will be <code>app/themes/[your-new-theme]/dashboard.php</code>.</li>
                <li>Update the configuration file <code>config.php</code> within your theme folder, setting <code>APP_THEME</code> to the name of your new folder.</li>
            </ol>
            <h2>Incorporating JavaScript Frameworks</h2>
            <p>If your application requires a JavaScript framework:</p>
            <ol>
                <li>Include the necessary <code>&lt;script&gt;</code> tags within the relevant PHP templates, particularly within <code>dashboard.php</code>.</li>
            </ol>
            <h2>Modifying the Dashboard</h2>
            <p>To enhance your dashboard functionality:</p>
            <ol>
                <li>In <code>app/app.php</code>, modify the <code>dashboard</code> method to include any necessary database data.</li>
                <li>Instantiate your model, call its methods, retrieve the data, and pass this data to the view.</li>
            </ol>
            <h2>Adding New URLs</h2>
            <p>To introduce new URLs to your application:</p>
            <ol>
                <li>Edit <code>app/themes/[your-theme]/app.php</code>.</li>
                <li>Add new methods corresponding to your desired URLs, for example, <code>public function faq() {}</code> which will make <code>https://your-domain.com/faq</code> accessible.</li>
            </ol>
            <h2>Interacting with the Database</h2>
            <h3>Creating Models</h3>
            <p>Instead of embedding SQL directly within your controllers or views, utilize models:</p>
            <ol>
                <li>
                    <p>Models serve as adapters for your MySQL queries. Create a new model by duplicating an existing one and adding new methods as needed.</p>
                </li>
                <li>
                    <p>For example, create a method within your model:</p>
                    <pre><code class="language-php">public function getById($id) {
// Your SQL query logic here
}</code></pre>
                </li>
                <li>
                    <p>In <code>app.php</code>, use the model to fetch data:</p>
                    <pre><code class="language-php">$sales = new salesModel();
echo $sales-&gt;getById(4);</code></pre>
                </li>
            </ol>
            <p>This approach keeps your application organized and maintains a separation of concerns between your database logic and your application logic.</p>
            <div id="introduction" class="mb-12">
                <h1 class="text-3xl font-bold mb-4">Introduction</h1>
                <p>Explanation of what Stripe Pad is and how it can be used in various scenarios.</p>
                ## Structure

                Space to insert your code:
                - **crons**: Scripts and cronjobs.
                - **app**: Custom application code &amp; landing page. All HTML is here.
                - **cdn**: Subdomain for static assets.

                These are core files, they will break with an update:
                - **core**: Core files for database connections and templates.
                - **webhooks**: Handlers for webhooks (default: Stripe and Bitbucket).
                - **API**: Basic API functionality.

                ![Relations between components](https://www.stripepad.com/relations.png)

                ## Features

                - Public: Landing page
                - Private: User Profile, Your App
                - MVC. Controllers, Models shared between all controllers, and JSON + templates for the views part.
                - Webhooks management for Stripe events.
                - Divided in subdomains or subfolders
                - PHP is the only requirement, how you build you app inside /app folder is up to you
                - Easy to modify and customize




                ### Tech Stack

                Packed with basic stuff only.

                1. Php. MVC style, no framework.
                2. Vanilla Js &amp; jQuery, just to open/close mobile menu
                3. Composer, to install stripe and email dependencies

                Basic theme uses Tailwind. 100% optional. You can edit /app folder completely.


            </div>
            <div id="installation" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Installation</h2>
                <p>To get started with Stripe Pad, follow these steps to ensure a proper setup:</p>
                <ol class="list-decimal pl-4">
                    <li>Ensure your system meets all required dependencies: PHP 7.4+, Composer, and MySQL.</li>
                    <li>Clone the repository from GitHub:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>git clone https://github.com/yourusername/stripe-pad.git</code></pre>
                    <li>Install all Composer dependencies:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>composer install</code></pre>
                    <li>Copy the sample configuration file and modify it according to your environment:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>cp .env.example .env</code></pre>
                    <li>Generate your application key:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>php artisan key:generate</code></pre>
                    <li>Run the database migrations and seed the database:</li>
                    <pre class="bg-gray-700 text-white p-2 rounded"><code>php artisan migrate --seed</code></pre>
                    <li>You are now ready to start your Stripe Pad application.</li>
                </ol>
            </div>

            <div id="configuration" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Configuration</h2>
                <p>Configuring Stripe Pad is essential to tailor the software to your specific needs. Follow the steps below to configure your installation properly:</p>
                <ol class="list-decimal pl-4">
                    <li>Set environment variables in the <code>.env</code> file. This includes database settings, API keys, and other operational parameters that Stripe Pad relies on.</li>
                    <li>Adjust the application settings in the admin panel:</li>
                    <ul class="list-disc pl-8">
                        <li>API configurations</li>
                        <li>User management settings</li>
                        <li>Payment and billing options</li>
                    </ul>
                    <li>For advanced users, delve into the <code>config/app.php</code> file to set up:</li>
                    <ul class="list-disc pl-8">
                        <li>Locale and timezone settings</li>
                        <li>Service providers</li>
                        <li>Class aliases for ease of development</li>
                    </ul>
                </ol>
            </div>

            <div id="customizing" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Customizing</h2>
                <p>Stripe Pad allows for extensive customization to meet the unique demands of your project. Here are some ways you can customize your setup:</p>
                <ol class="list-decimal pl-4">
                    <li>Themes: Change the visual appearance by modifying or creating new themes.</li>
                    <li>Modules: Enhance functionality by developing new modules or modifying existing ones.</li>
                    <li>Integrations: Integrate with third-party services for enhanced capabilities.</li>
                </ol>
                <p>For more detailed instructions on customizing each aspect, refer to the developer guides provided in the subsequent sections.</p>
            </div>

            <div id="advanced-topics" class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Advanced Topics</h2>
                <p>For those looking to get the most out of Stripe Pad, exploring advanced topics is crucial. This section covers:</p>
                <ul class="list-disc pl-4">
                    <li>Performance optimization techniques</li>
                    <li>Security best practices</li>
                    <li>Automated testing and continuous integration setups</li>
                    <li>Detailed API documentation</li>
                </ul>
                <p>Each topic is covered in depth to provide you with the knowledge needed to optimize your use of Stripe Pad.</p>
            </div>

        </main>

        <!-- Right Sidebar: On-page navigation -->
        <nav class="w-48 bg-gray-800 py-12  inset-y-0 right-0 overflow-y-auto">

        </nav>
    </div>
</div>