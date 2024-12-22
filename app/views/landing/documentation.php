<div class="relative px-10">
    <!-- Wrapper for the entire layout -->
    <div class="block flex min-h-screen text-gray-200 ">

        <!-- Sidebar: Navigation -->
        <aside class="sm:w-64  sm:px-8 sm:py-12 sm:fixed overflow-y-auto">
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Getting Started</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#quickstart" class="text-gray-400 hover:text-blue-500">Quickstart</a></li>
                <li><a href="documentation#install" class="text-gray-400 hover:text-blue-500">Installation</a></li>
                <li><a href="documentation#upgrade" class="text-gray-400 hover:text-blue-500">Upgrade Guide</a></li>

            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Core</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#components" class="text-gray-400 hover:text-blue-500">Introduction</a></li>
                <li><a href="documentation#routes" class="text-gray-400 hover:text-blue-500">Routes</a></li>
                <li><a href="documentation#models" class="text-gray-400 hover:text-blue-500">Models</a></li>
                <li><a href="documentation#users" class="text-gray-400 hover:text-blue-500">Users</a></li>
                <li><a href="documentation#mail" class="text-gray-400 hover:text-blue-500">Mail</a></li>
                <li><a href="documentation#webhook" class="text-gray-400 hover:text-blue-500">Webhooks</a></li>
                <li><a href="documentation#crons" class="text-gray-400 hover:text-blue-500">Crons</a></li>
                <li><a href="documentation#api" class="text-gray-400 hover:text-blue-500">Api</a></li>
                <li><a href="documentation#cdn" class="text-gray-400 hover:text-blue-500">CDN</a></li>

            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Customization</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#app" class="text-gray-400 hover:text-blue-500">Your App</a></li>
                <li><a href="documentation#landing" class="text-gray-400 hover:text-blue-500">Landing page</a></li>
            </ul>
            <h2 class="text-sm uppercase  font-semibold mb-5 text-gray-600">Extras</h2>
            <ul class="space-y-2 mb-10">
                <li><a href="documentation#blog" class="text-gray-400 hover:text-blue-500">Blog</a></li>
                <li><a href="documentation#widget" class="text-gray-400 hover:text-blue-500">Widget</a></li>
            </ul>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 pl-80 pr-32  text-gray-300 text-base pb-16">

            <p>Stripe Pad Version: <?= STRIPE_PAD_VERSION ?></p>
            <h2 id="quickstart" class="text-xl mt-10 uppercase">Quickstart</h2>

            <p>Stripe Pad is simple PHP SaaS boilerplate designed to streamline the process of building Software as a Service (SaaS) applications in a WordPress Style. This comprehensive guide aims to provide you with all the necessary information to get started with Stripe Pad, from setting up your development environment to deploying your first SaaS application.</p>
            <br>
            <h3>Quick install</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                $ git clone https://github.com/natzar/Stripe-Pad.git<br>
                $ composer install<br>
                $ import install/database.sql<br>
                $ edit config.php
            </blockquote><br>
            <h3>Requirements</h3>
            <blockquote class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">
                PHP 7.2<br>
                Composer<br>
                MySQL / MariaDB / SqlLite<br>
                SMTP server<br>
                Stripe Account<br>
            </blockquote>



            <hr class="border-1 border-gray-500 mt-10">

            <h2 id="install" class="text-xl mt-10 uppercase">Installation</h2>
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
            <section class="mt-4">
                <h3 class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">Initial Setup</h3>
                <ol class="list-decimal pl-8 space-y-2">
                    <li>Download the latest version from the repository. https://github.com/natzar/Stripe-Pad/releases/tag/v.0.0.1-alpha</li>
                    <li>Extract the files to your preferred directory (htdocs)</li>

                </ol>
            </section>

            <section class="mt-4">
                <h3 class="bg-gray-900 rounded-md text-white px-6 py-4 border-1 border-gray-700">Configuration</h3>
                <ol class="list-decimal pl-8 space-y-2">
                    <li>Set your application name, base URL, Stripe API Keys, Database settings and all configurations in <span class="bg-gray-700 text-red-300 p-1 rounded">config.php</span>.</li>

                    <li>Optional: Check .htaccess if you will be running in a /subfolder/ <code class="bg-gray-700 text-red-300 p-1 rounded">RedirectBase</code> in <span class="bg-gray-700 text-red-300 p-1 rounded">/app/.htaccess</span> and <span class="bg-gray-700 text-red-300 p-1 rounded">/api/.htaccess</span> to match your localhost directory.</li>
                    <li>Optional: Create subdomains and point them to the respective folders: app, api, webhooks, and cdn.</li>



                </ol>
            </section>

            <section class="mt-4">
                <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4 mb-4  rounded-full pl-8">Post-Configuration Steps</h3>
                <ol class="list-decimal pl-8 space-y-2">
                    <li>Run <span class="bg-gray-700 text-red-300 p-1 rounded">composer install</span> to install necessary dependencies.</li>

                    <li>Import <span class="bg-gray-700 text-red-300 p-1 rounded">database.sql</span> into your MySQL database.</li>

                    <li>Set up a webhook from your Stripe dashboard to <span class="bg-gray-700 text-red-300 p-1 rounded">https://yourdomain.com/webhooks/stripe.php</span> to handle Stripe events.</li>

                    <li>Set up automatic deployment from a git repository<span class="bg-gray-700 text-red-300 p-1 rounded">/webhooks/deploy.php</span>.</p>

                </ol>
            </section>

            npm install -D tailwindcss
            npx tailwindcss init
            app/css/build/compile-tailwind.sh


            <section class="mt-4">
                <h3 class="text-lg font-medium text-gray-100 bg-gray-800 p-4  rounded-full pl-8">Verification and Testing</h3>
                <p>Ensure the setup is correct by accessing the following:</p>
                <ul class="list-disc pl-8">
                    <li><a href="/app" class="text-blue-400 hover:text-blue-600">Login Page</a> should open correctly.</li>
                    <li><a href="/api" class="text-blue-400 hover:text-blue-600">API Endpoint</a> should display a 'not authenticated' message.</li>
                    <li>Access your main landing or marketing page at the <span class="bg-gray-700 text-red-300 p-1 rounded">/web</span> directory.</li>
                    <li>Your custom application should reside in the <span class="bg-gray-700 text-red-300 p-1 rounded">/app</span> folder.</li>
                    <li>Your API endpoints will be located within the <span class="bg-gray-700 text-red-300 p-1 rounded">/api</span> folder.</li>
                    <li>Models shared between all components are available for use across the application.</li>
                </ul>
            </section>
            <div class="mt-6">
                <!-- <a href="web/" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Landing Page</a>
        <a href="app/" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-full">Visit Your SaaS Login Page</a>
         --><a href="https://github.com/natzar/Stripe-Pad/issues" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-full">Get Support!</a>
            </div>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="upgrade" class="text-xl mt-10 uppercase">Upgrade Guide</h2>

            <p>To upgrade Stripe Pad you just need to replace core files</p>
            - Replace core folder with the new version<br>
            - replace load.php with the new version<br>
            <hr class="border-1 border-gray-500 mt-10">



            <h2 id="components" class="text-xl mt-10 uppercase">Components</h2>
            <p>The base of Stripe Pad is structured as a simplistic MVC (Model-View-Controller (1)) PHP application. </p>
            <p><img width="500" class="mx-auto" src="https://www.stripepad.com/relations.png" alt="Stripe Pad Relations"></p>

            <ul>
                <li>Find and add your models at app/models</li>
                <li>Find and add your views (templates) at app/views/</li>
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
            <hr class="border-1 border-gray-500 mt-10">

            <h2 id="routes" class="text-xl mt-10 uppercase">Routes</h2>
            <h2>Adding New URLs</h2>
            <p>To introduce new URLs to your application:</p>
            <ol>
                <li>Edit <code>app/themes/[your-theme]/app.php</code>.</li>
                <li>Add new methods corresponding to your desired URLs, for example, <code>public function faq() {}</code> which will make <code>https://your-domain.com/faq</code> accessible.</li>
            </ol>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="models" class="text-xl mt-10 uppercase">Models</h2>
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

            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="users" class="text-xl mt-10 uppercase">Users</h2>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="emails" class="text-xl mt-10 uppercase">Transactional Emails</h2>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="webhooks" class="text-xl mt-10 uppercase">Webhooks</h2>
            <p>Facilitate automated interactions with external systems:</p>
            <ul>
                <li><strong>deploy.php</strong>: Configurable for automatic deployment via Bitbucket or Git hooks.</li>
                <li><strong>stripe.php</strong>: Endpoint for receiving events from Stripe.</li>
            </ul>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="cronjobs" class="text-xl mt-10 uppercase">Cronjobs</h2>
            <p>This section is designated for scheduling and managing cronjobs. Scripts within the 'crons' directory should start by including <code>load.php</code>, initializing required models, and executing necessary tasks. These scripts can then be scheduled directly on the server.</p>
            <hr class="border-1 border-gray-500 mt-10">
            <h2 id="api" class="text-xl mt-10 uppercase">Api</h2>
            <p>API comes in 2 forms, v1 and v2.</p>
            <ul>
                <li>v1: just 1 endpoint user for 1 action (search, get info, whatever...)</li>
                <li>v2: Very Simple API REST. You can instance here your models and return JSON responses</li>
            </ul>

            <p> v3 is coming, Guzzle + REST</p>

            <hr class="border-1 border-gray-500 mt-10">





            <h2 id="cdn" class="text-xl mt-10 uppercase">CDN</h2>
            <h2>CDN</h2>
            <p>The 'cdn' directory is intended for static assets such as JavaScript, CSS, and images. Ideally, these should be served from a separate domain or subdomain to improve loading times and security.</p>
            <hr class="border-1 border-gray-500 mt-10">




            <h2 id="app" class="text-xl mt-10 uppercase">Your app</h2>
            <p>index.php is the boilerplate, app/app.php it's an extended StripePad Class. You can override the parent methods.
                All your application logic will be in app/app.php, public &amp; private sides, is all there, all urls are defined there. </p>

            <p>To enhance your dashboard functionality:</p>
            <ol>
                <li>In <code>app/app.php</code>, modify the <code>dashboard</code> method to include any necessary database data.</li>
                <li>Instantiate your model, call its methods, retrieve the data, and pass this data to the view.</li>
            </ol>
            <h2>Incorporating JavaScript Frameworks</h2>
            <p>If your application requires a JavaScript framework:</p>
            <ol>
                <li>Include the necessary <code>&lt;script&gt;</code> tags within the relevant PHP templates, particularly within <code>dashboard.php</code>.</li>
            </ol>
            <p>To create a new theme:</p>
            <ol>
                <li>Duplicate the <code>app/themes/basic-dark</code> directory. Rename the new directory to reflect the primary keyword of your niche, optimizing for SEO purposes.</li>
                <li>Your main file for customization will be <code>app/themes/[your-new-theme]/dashboard.php</code>.</li>
                <li>Update the configuration file <code>config.php</code> within your theme folder, setting <code>APP_THEME</code> to the name of your new folder.</li>
            </ol>
            <h2 id="landing" class="text-xl mt-10 uppercase">Landing Page</h2>
            <p>The 'landing' directory hosts all public-facing parts of your SaaS, including marketing content and user acquisition elements. To extend the landing page:</p>
            <ol>
                <li>Create new HTML/PHP templates within <code>templates/landing/</code>.</li>
                <li>Add corresponding methods to <code>app/app.php</code> for new pages, e.g., <code>public function about()</code>.</li>
                <li>Implement the desired logic and view rendering within these new methods.</li>
            </ol>
            <p>This setup enables straightforward routing from URLs to respective application methods and views.</p>
            <h3>Your code goes here</h3>
            <p>Access to the core application features, such as the dashboard, is restricted to authenticated users. The dashboard acts as the entry point for logged-in users, hosting the primary functionality and data interactions of your SaaS solution. Start by modifying <code>dashboard.php</code> to tailor it to your application's needs.</p>




            <h2 id="widget">Widget</h2>
            <p>In case you want to build a widget that users will insert in their websites, you can use this. </p>
            <h2>Modules</h2>
            <ul>
                <li>EmailValidator</li>
                <li>Request Bot Blocker</li>
            </ul>
            <p>The directory structure and setup described provide a comprehensive framework for developing and scaling your SaaS platform with Stripe Pad.</p>
            <h2>Getting Started</h2>
            <p>Follow the installation instructions to set up the environment on your local machine. Once you have everything running locally, you are ready to begin the development of your SaaS application.</p>



        </main>

        <!-- Right Sidebar: On-page navigation -->
        <nav class="w-48  py-12  inset-y-0 right-0 overflow-y-auto">

        </nav>
    </div>
</div>